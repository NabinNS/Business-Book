<?php

namespace App\Http\Controllers;

use App\Models\AccountLedger;
use App\Models\CustomerLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DaybookController extends Controller
{
    public function daybookPage()
    {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $partyDetails = AccountLedger::whereBetween('date', [$startDate, $endDate]);
        $customerDetails = CustomerLedger::whereBetween('date', [$startDate, $endDate]);

        $totalPurchase = $partyDetails->sum('credit');
        $totalCashPaid = $partyDetails->sum('debit');
        $totalSales = $customerDetails->sum('debit');
        $totalCashReceived = $customerDetails->sum('credit');

        $mergedDetails = $partyDetails->union($customerDetails);
        $sortedDetails = $mergedDetails->orderBy('date')->paginate(10);
        return view('daybook.daybook', compact('sortedDetails', 'startDate', 'endDate'));
    }
    public function viewDayBook(Request $request)
    {
        $startDate = $request->from;
        $endDate = $request->to;
            $partyDetails = AccountLedger::whereBetween('date', [$startDate, $endDate]);
            $customerDetails = CustomerLedger::whereBetween('date', [$startDate, $endDate]);
            $mergedDetails = $partyDetails->union($customerDetails);
            $sortedDetails = $mergedDetails->orderBy('date')->paginate(10);
        return view('daybook.daybook', compact('sortedDetails', 'startDate', 'endDate'));
    }
}
