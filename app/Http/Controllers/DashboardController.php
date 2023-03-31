<?php

namespace App\Http\Controllers;

use App\Models\AccountLedger;
use App\Models\AccountRemainingBalance;
use App\Models\CustomerLedger;
use App\Models\CustomerRemainingBalance;
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
                ->select('date', 'debit', 'company_details_id')
                ->get();
            $customerCheque = CustomerLedger::where('cheque_status', 'unsettled')
                ->select('date', 'credit', 'customer_detail_id')
                ->get();
            $unsettledCheques = $companyCheque->concat($customerCheque)->sortBy('date');
            //unseeted bill results
            $customerBills = CustomerLedger::where('bill_status', 'unpaid')
                ->select('date', 'receipt_no','debit', 'customer_detail_id')
                ->get();

            return view('dashboard', compact('customers', 'parties', 'purchases', 'sales', 'unsettledCheques', 'purchaseData', 'salesData', 'cashOutData', 'cashInData','customerBills'));
        }

        return redirect("/")->withSuccess('You are not allowed to access');
    }
}
