<?php

namespace App\Http\Controllers;

use App\Models\AccountLedger;
use App\Models\AccountRemainingBalance;
use App\Models\CustomerLedger;
use App\Models\CustomerRemainingBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            //Dashboard summary results 
            $parties = AccountRemainingBalance::all()->sum('amount');
            $customers = CustomerRemainingBalance::all()->sum('amount');
            $purchases = AccountLedger::all()->sum('credit');
            $sales = CustomerLedger::all()->sum('debit');
            // unsettled cheque results
            $companyCheque = AccountLedger::where('cheque_status', 'unsettled')
                ->select('date', 'debit', 'company_details_id')
                ->get();

            $customerCheque = CustomerLedger::where('cheque_status', 'unsettled')
                ->select('date', 'credit', 'customer_detail_id')
                ->get();
            $unsettledCheques = $companyCheque->concat($customerCheque)->sortBy('date');

            return view('dashboard', compact('customers', 'parties', 'purchases', 'sales', 'unsettledCheques'));
        }

        return redirect("/")->withSuccess('You are not allowed to access');
    }
}
