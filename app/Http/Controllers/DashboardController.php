<?php

namespace App\Http\Controllers;

use App\Models\AccountLedger;
use App\Models\AccountRemainingBalance;
use App\Models\CustomerLedger;
use App\Models\CustomerRemainingBalance;
use App\Models\StockDetail;
use App\Models\StockRemainingBalance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            $currentYear = date('Y');
            //Dashboard summary results 
            $parties = AccountRemainingBalance::all()->sum('amount');
            $customers = CustomerRemainingBalance::all()->sum('amount');
            $purchases = AccountLedger::all()->sum('credit');
            $sales = CustomerLedger::all()->sum('debit');
            //chat js datas
            // Retrieve purchase data for a given year
            // Retrieve purchase data for a given year
            $purchaseData = AccountLedger::selectRaw('DATE_FORMAT(date, "%M") as month_name, MONTH(date) as month_number, SUM(credit) as total')
                ->whereRaw('YEAR(date) = ?', [$currentYear])
                ->groupBy('month_name', 'month_number')
                ->orderBy('month_number')
                ->get();

            // Retrieve sales data for a given year
            $salesData = CustomerLedger::selectRaw('DATE_FORMAT(date, "%M") as month_name, MONTH(date) as month_number, SUM(debit) as total')
                ->whereRaw('YEAR(date) = ?', [$currentYear])
                ->groupBy('month_name', 'month_number')
                ->orderBy('month_number')
                ->get();

            // Retrieve cash out data for a given year
            $cashOutData = AccountLedger::selectRaw('DATE_FORMAT(date, "%M") as month_name, MONTH(date) as month_number, SUM(debit) as total')
                ->whereRaw('YEAR(date) = ?', [$currentYear])
                ->groupBy('month_name', 'month_number')
                ->orderBy('month_number')
                ->get();

            // Retrieve cash in data for a given year
            $cashInData = CustomerLedger::selectRaw('DATE_FORMAT(date, "%M") as month_name, MONTH(date) as month_number, SUM(credit) as total')
                ->whereRaw('YEAR(date) = ?', [$currentYear])
                ->groupBy('month_name', 'month_number')
                ->orderBy('month_number')
                ->get();

            // unsettled cheque results
            $companyCheque = AccountLedger::where('cheque_status', 'unsettled')
                ->select('acc_id', 'date', 'debit', 'company_details_id')
                ->get();
            $customerCheque = CustomerLedger::where('cheque_status', 'unsettled')
                ->select('customerledger_id', 'date', 'credit', 'customer_detail_id')
                ->get();
            $unsettledCheques = $companyCheque->concat($customerCheque)->sortBy('date');
            // dd($unsettledCheques);
            //unsettled bill results
            $customerBills = CustomerLedger::where('bill_status', 'unpaid')
                ->select('customerledger_id','date', 'receipt_no', 'debit', 'customer_detail_id')
                ->get();
            //low limit results
            $stocks = StockRemainingBalance::join('stock_details', 'stock_remaining_balances.stock_detail_id', '=', 'stock_details.id')
                ->select('stock_details.stock_name', 'stock_remaining_balances.quantity', 'stock_details.limit')
                ->whereRaw('stock_details.limit - stock_remaining_balances.quantity > 0')
                ->get();



            return view('dashboard', compact('customers', 'parties', 'purchases', 'sales', 'unsettledCheques', 'purchaseData', 'salesData', 'cashOutData', 'cashInData', 'customerBills', 'stocks'));
        }

        return redirect("/")->withSuccess('You are not allowed to access');
    }
    public function updateChequeRecord($from, $id)
    {
        if ($from == 'customer') {
            $record = CustomerLedger::find($id);
        } else {
            $record = AccountLedger::find($id);
        }

        if ($record) {
            $record->cheque_status = 'settled';
            $record->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => 'Record not found']);
        }
    }
    public function updateBillRecord($id)
    {
        $record = CustomerLedger::find($id);
        if ($record) {
            $record->bill_status = 'paid';
            $record->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => 'Record not found']);
        }
    }
}
