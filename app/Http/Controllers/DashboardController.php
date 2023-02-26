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
            $parties = AccountRemainingBalance::all()->sum('amount');
            $customers = CustomerRemainingBalance::all()->sum('amount');
            $purchases = AccountLedger::all()->sum('credit');
            $sales = CustomerLedger::all()->sum('debit');
      
           
            return view('dashboard',compact('customers','parties','purchases','sales'));
        }

        return redirect("/")->withSuccess('You are not allowed to access');
    }
    
}
