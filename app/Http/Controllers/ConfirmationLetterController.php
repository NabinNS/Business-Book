<?php

namespace App\Http\Controllers;

use App\Models\AccountRemainingBalance;
use App\Models\CompanyDetails;
use App\Models\CustomerDetail;
use Illuminate\Http\Request;

class ConfirmationLetterController extends Controller
{
    public function indexPage()
    {
        return view('confirmation.choosingpage');
    }
    public function viewList($name)
    {
        if ($name == 'parties') {
            $lists = CompanyDetails::orderBy('company_name')->get();
            return view('confirmation.listingnames', compact('lists', 'name'));
        } elseif ($name == 'customers') {
            $lists = CustomerDetail::orderBy('customer_name')->get();
            return view('confirmation.listingnames', compact('lists', 'name'));
        }

        abort(404); //for showing page not found if wrong url entered
    }
    public function viewPartiesConfirmation($name)
    {
        $currentYear = date('Y');
        $fiscalYear = ($currentYear) . '/' . ($currentYear+1);
        $partyDetail = CompanyDetails::where('company_name', $name)->firstOrFail();
        $remainingBalance = $partyDetail->accountRemainingBalance->amount;
        $partyLedgers = $partyDetail->accountLedger;
        $totalAmtWithVat = $partyLedgers->sum('credit');
        return view('confirmation.partiesconfirmation', compact('totalAmtWithVat', 'partyDetail','fiscalYear','remainingBalance'));
    }
    public function viewCustomersConfirmation($name)
    {
        $currentYear = date('Y');
        $fiscalYear = ($currentYear) . '/' . ($currentYear+1);
        $customerDetail = CustomerDetail::where('customer_name',$name)->firstOrFail();
        $remainingBalance = $customerDetail->customerRemainingBalance->amount;
        $customerLedger = $customerDetail->customerledger;
        $totalAmtWithVat = $customerLedger->sum('debit');
        return view('confirmation.customerconfirmation',compact('totalAmtWithVat','remainingBalance','customerDetail','fiscalYear'));
    }
}
