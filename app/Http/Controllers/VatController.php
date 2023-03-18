<?php

namespace App\Http\Controllers;

use App\Models\AccountLedger;
use App\Models\CustomerLedger;
use Illuminate\Http\Request;

class VatController extends Controller
{
    public function indexPage()
    {
        //     $currentYear = date('Y');
        //     $partyMonthlyCredit = AccountLedger::selectRaw('YEAR(date) year, MONTH(date) month, SUM(credit) total_credit')
        //         ->whereRaw('YEAR(date) = ?', [$currentYear])
        //         ->groupBy('year', 'month')
        //         ->orderBy('year', 'desc')
        //         ->orderBy('month', 'desc')
        //         ->get();
        //     $customerMonthlyCredit = CustomerLedger::selectRaw('YEAR(date) year, MONTH(date) month, SUM(debit) total_credit')
        //         ->whereRaw('YEAR(date) = ?', [$currentYear])
        //         ->groupBy('year', 'month')
        //         ->orderBy('year', 'desc')
        //         ->orderBy('month', 'desc')
        //         ->get();

        // foreach ($customerMonthlyCredit as $credit) {
        //         $monthName = date('F', mktime(0, 0, 0, $credit->month, 1, 2000));
        //         echo $monthName . ' ' . $credit->year . ': ' . $credit->total_credit . '<br>';
        //     }


        //     foreach ($partyMonthlyCredit as $credit) {
        //         $monthName = date('F', mktime(0, 0, 0, $credit->month, 1, 2000));
        //         echo $monthName . ' ' . $credit->year . ': ' . $credit->total_credit . '<br>';
        //     }

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

        // foreach ($partyMonthlyCredit as $credit) {
        //     $monthName = date('F', mktime(0, 0, 0, $credit->month, 1, 2000));
        //     $partyCredit = $credit->total_credit;

        //     // Find the corresponding customer credit for the same month and year
        //     $customerCredit = 0;
        //     foreach ($customerMonthlyCredit as $customer) {
        //         if ($customer->month == $credit->month && $customer->year == $credit->year) {
        //             $customerCredit = $customer->total_credit;
        //             break;
        //         }
        //     }
        //     echo $partyCredit.'-' .$customerCredit;
        //     $difference = $partyCredit - $customerCredit;
        //     echo $monthName . ' ' . $credit->year . ': ' . $difference . '<br>';
        // }


        // dd($purchaseInformation);

        return view('vat.vat', compact('partyMonthlyCredit','customerMonthlyCredit'));
    }
}
