<?php

namespace App\Http\Controllers;

use App\Models\AccountLedger;
use App\Models\CustomerLedger;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DaybookController extends Controller
{
    public function daybookPage()
    {

        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $partyDetails = AccountLedger::whereBetween('date', [$startDate, $endDate])
            ->select('acc_id', 'particulars', 'receipt_no', 'date', 'debit', 'credit', 'company_details_id')
            ->get();
        $totalPurchase = $partyDetails->sum('credit');
        $totalCashPaid = $partyDetails->sum('debit');
        $customerDetails = CustomerLedger::whereBetween('date', [$startDate, $endDate])
            ->select('customerledger_id', 'date', 'particulars', 'receipt_no', 'debit', 'credit', 'customer_detail_id')
            ->get();
        $totalSales = $customerDetails->sum('debit');
        $totalCashReceived = $customerDetails->sum('credit');
        $sortedDetails = $partyDetails->concat($customerDetails)->sortBy('date');
        // dd($sortedDetails);
        return view('daybook.daybook', compact('sortedDetails', 'startDate', 'endDate', 'totalPurchase', 'totalCashPaid', 'totalSales', 'totalCashReceived'));
    }
    public function viewDayBook(Request $request)
    {
        $startDate = $request->from;
        $endDate = $request->to;
        $totalPurchase = 0;
        $totalCashPaid = 0;
        $totalSales = 0;
        $totalCashReceived = 0;
        if ($request->option == "All") {
            $partyDetails = AccountLedger::whereBetween('date', [$startDate, $endDate])
                ->select('acc_id', 'particulars', 'date', 'debit', 'credit', 'company_details_id')
                ->get();
            $totalPurchase = $partyDetails->sum('credit');
            $totalCashPaid = $partyDetails->sum('debit');
            $customerDetails = CustomerLedger::whereBetween('date', [$startDate, $endDate])
                ->select('customerledger_id', 'date', 'particulars', 'debit', 'credit', 'customer_detail_id')
                ->get();
            $totalSales = $customerDetails->sum('debit');
            $totalCashReceived = $customerDetails->sum('credit');
            $sortedDetails = $partyDetails->concat($customerDetails)->sortBy('date');
        } elseif ($request->option == "Parties") {
            $mergedDetails = AccountLedger::whereBetween('date', [$startDate, $endDate])
                ->select('acc_id', 'particulars', 'date', 'debit', 'credit', 'company_details_id')
                ->get();;
            $sortedDetails = $mergedDetails->sortBy('date');
            $totalPurchase = $mergedDetails->sum('credit');
            $totalCashPaid = $mergedDetails->sum('debit');
        } else {
            $mergedDetails = CustomerLedger::whereBetween('date', [$startDate, $endDate])
                ->select('customerledger_id', 'date', 'particulars', 'debit', 'credit', 'customer_detail_id')
                ->get();
            $sortedDetails = $mergedDetails->sortBy('date');
            $totalSales = $mergedDetails->sum('debit');
            $totalCashReceived = $mergedDetails->sum('credit');
        }
        return view('daybook.daybook', compact('sortedDetails', 'startDate', 'endDate', 'totalPurchase', 'totalCashPaid', 'totalSales', 'totalCashReceived'));
    }
}
