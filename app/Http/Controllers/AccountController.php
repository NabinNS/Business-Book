<?php

namespace App\Http\Controllers;

use App\Models\AccountLedger;
use App\Models\AccountRemainingBalance;
use App\Models\AccountsSummary;
use App\Models\CompanyDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function partiesHandler()
    {
        //get all the details of the account summaries
        $accountremainingbalances = AccountRemainingBalance::orderBy('company_name')->get();
        //get the name details of the first company stored in accountsummaries

        if ($accountremainingbalances->count() > 0) {
            $companyDetail = CompanyDetails::find($accountremainingbalances->first()->company_details_id);
            $accountledgers = $companyDetail->accountLedger;
            return view('accounts.parties', compact('accountremainingbalances', 'companyDetail', 'accountledgers'));
        } else {
            return view('accounts.emptyparty');
        }
    }
    public function addNewParty(Request $request)
    {
        $request->validate([
            'companyname' => 'required|unique:company_details,company_name',
            'vatnumber' => 'nullable|min:7|max:9',
            'phonenumber' => 'nullable|min:7',
            'emailaddress' => 'nullable|email'
        ]);

        $companyInformation = CompanyDetails::create([
            'company_name' => $request->companyname,
            'vat_number' => $request->vatnumber,
            'phone_number' => $request->phonenumber,
            'address' => $request->address,
            'email_address' => $request->emailaddress,
            'opening_balance' => $request->openingbalance ?? 0,
            'date' => $request->date ?? Carbon::now()
        ]);
        $companyInformation->accountRemainingBalance()->create([
            'company_id' => $companyInformation->id,
            'date' => $request->date ?? Carbon::now(),
            'company_name' => $request->companyname,
            'amount' => $request->openingbalance ?? 0
        ]);
        return redirect('/parties')->with('success', 'New party added successfully');
    }
    public function partiesCash(Request $request)
    {

        $request->validate([
            'companyname' => 'required|exists:company_details,company_name',
            'amount' => 'required'
        ]);
        $companyInformation = CompanyDetails::where('company_name', $request->companyname)->firstOrFail();
        $companyInformation->accountRemainingBalance()->decrement('amount', $request->amount);
        $companyInformation->accountLedger()->create([
            'date' => $request->date ?? Carbon::now(),
            'receipt_no' => $request->voucherno,
            'particulars' => $request->type,
            'debit' => $request->amount

        ]);

        return redirect('/parties/' . $request->companyname)->with('success', 'Cash payment recorded successfully');
    }
    public function partiesPurchase(Request $request)
    {
        $request->validate([
            'companyname' => 'required|exists:company_details,company_name',
            'amount' => 'required'
        ]);
        $companyInformation = CompanyDetails::where('company_name', $request->companyname)->firstOrFail();
        $companyInformation->accountRemainingBalance()->increment('amount', $request->amount);
        $companyInformation->accountLedger()->create([
            'date' => $request->date ?? Carbon::now(),
            'receipt_no' => $request->billno,
            'particulars' => 'purchase by ' . $request->Purchasetype,
            'credit' => $request->amount

        ]);

        if ($request->Purchasetype == "cash") {
            $companyInformation->accountRemainingBalance()->decrement('amount', $request->amount);
            $companyInformation->accountLedger()->create([
                'date' => $request->date ?? Carbon::now(),
                'receipt_no' => $request->voucherno,
                'particulars' => $request->Paymenttype,
                'debit' => $request->amount
            ]);

        }
        return redirect('/parties/' . $request->companyname)->with('success', 'Purchase bill recorded successfully');
    }
    public function viewLedger($companyname)
    {
        $accountremainingbalances = AccountRemainingBalance::orderBy('company_name')->get();
        $companyDetail = CompanyDetails::where('company_name', $companyname)->firstOrFail();
        $accountledgers = $companyDetail->accountLedger;
        return view('accounts.parties', compact('accountremainingbalances', 'companyDetail', 'accountledgers'));
    }
}
