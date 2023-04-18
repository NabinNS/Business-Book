<?php

namespace App\Http\Controllers;

use App\Models\AccountLedger;
use App\Models\CustomerLedger;
use Illuminate\Http\Request;

class VatController extends Controller
{
    public function indexPage()
    {
        $currentYear = date('Y');

        $partyMonthlyCredit = AccountLedger::selectRaw('YEAR(date) year, MONTH(date) month, SUM(credit) total_credit')
            ->whereRaw('YEAR(date) = ?', [$currentYear])
            ->groupBy('year', 'month')
            // ->orderBy('year', 'desc')
            ->orderBy('month')
            ->get();

        $customerMonthlyCredit = CustomerLedger::selectRaw('YEAR(date) year, MONTH(date) month, SUM(debit) total_credit')
            ->whereRaw('YEAR(date) = ?', [$currentYear])
            ->groupBy('year', 'month')
            // ->orderBy('year', 'desc')
            ->orderBy('month')
            ->get();
        return view('vat.vat', compact('partyMonthlyCredit','customerMonthlyCredit'));
    }
}
