<?php

namespace App\Http\Controllers;

use App\Models\AccountLedger;
use App\Models\CustomerLedger;
use DB;
use Illuminate\Http\Request;

class VatBillController extends Controller
{
    public function purchaseMonths()
    {
        $currentYear = date('Y');
        $purchasemonths = AccountLedger::selectRaw('DATE_FORMAT(date, "%M") as month_name, MONTH(date) as month_number, SUM(credit) as total')
            ->whereRaw('YEAR(date) = ?', [$currentYear])
            ->groupBy('month_name', 'month_number')
            ->orderBy('month_number')
            ->get();
        return view('Bills.purchasemonths', compact('purchasemonths'));
    }
    public function purchaseDetails($month)
    {

        $purchasebills = AccountLedger::whereMonth('date', '=', $month)
            ->whereNotNull('credit')
            ->get();
            $monthName = date('F', mktime(0, 0, 0, $month, 1));

        return view('Bills.purchasebill', compact('purchasebills','monthName'));
    }
    public function salesMonths()
    {
        $currentYear = date('Y');
        $salesmonths = CustomerLedger::selectRaw('DATE_FORMAT(date, "%M") as month_name, MONTH(date) as month_number, SUM(debit) as total')
            ->whereRaw('YEAR(date) = ?', [$currentYear])
            ->groupBy('month_name', 'month_number')
            ->orderBy('month_number')
            ->get();
        return view('Bills.salesmonths', compact('salesmonths'));
    }
    public function salesDetails($month)
    {

        $salesbills = CustomerLedger::whereMonth('date', '=', $month)
            ->whereNotNull('debit')
            ->get();
            $monthName = date('F', mktime(0, 0, 0, $month, 1));

        return view('Bills.salesbill', compact('salesbills','monthName'));
    }
}
