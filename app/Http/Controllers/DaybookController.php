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
        $partyDetails = AccountLedger::whereBetween('date', [$startDate, $endDate]);
        $totalPurchase = $partyDetails->sum('credit');
        $totalCashPaid = $partyDetails->sum('debit');
        $customerDetails = CustomerLedger::whereBetween('date', [$startDate, $endDate]);
        $totalSales = $customerDetails->sum('debit');
        $totalCashReceived = $customerDetails->sum('credit');
        $mergedDetails = $partyDetails->unionAll($customerDetails);
        $sortedDetails = $mergedDetails->orderBy('date')->paginate(10);
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
            $partyDetails = AccountLedger::whereBetween('date', [$startDate, $endDate]);
            $customerDetails = CustomerLedger::whereBetween('date', [$startDate, $endDate]);
            $partyDetails = AccountLedger::whereBetween('date', [$startDate, $endDate]);
            $totalPurchase = $partyDetails->sum('credit');
            $totalCashPaid = $partyDetails->sum('debit');

            $customerDetails = CustomerLedger::whereBetween('date', [$startDate, $endDate]);
            $totalSales = $customerDetails->sum('debit');
            $totalCashReceived = $customerDetails->sum('credit');

            $mergedDetails = $partyDetails->union($customerDetails);
            $sortedDetails = $mergedDetails->orderBy('date')->paginate(10);
        } elseif ($request->option == "Parties") {
            $mergedDetails = AccountLedger::whereBetween('date', [$startDate, $endDate]);
            $sortedDetails = $mergedDetails->orderBy('date')->paginate(10);
            $totalPurchase = $mergedDetails->sum('credit');
            $totalCashPaid = $mergedDetails->sum('debit');
        } else {
            $mergedDetails = CustomerLedger::whereBetween('date', [$startDate, $endDate]);
            $sortedDetails = $mergedDetails->orderBy('date')->paginate(10);
            $totalSales = $mergedDetails->sum('debit');
            $totalCashReceived = $mergedDetails->sum('credit');
        }
        return view('daybook.daybook', compact('sortedDetails', 'startDate', 'endDate', 'totalPurchase', 'totalCashPaid', 'totalSales', 'totalCashReceived'));
    }
}
