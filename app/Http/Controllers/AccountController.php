<?php

namespace App\Http\Controllers;

use App\Models\AccountLedger;
use App\Models\AccountRemainingBalance;
use App\Models\AccountsSummary;
use App\Models\CompanyDetails;
use App\Models\CustomerDetail;
use App\Models\CustomerLedger;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function partiesHandler()
    {
        //get all the details of the account summaries
        // $accountremainingbalances = AccountRemainingBalance::orderBy('company_name')->get();
        //get the name details of the first company stored in accountsummaries

        $accountremainingbalances = CompanyDetails::orderBy('company_name')->get();
        if ($accountremainingbalances->count() > 0) {
            $companyDetail = CompanyDetails::find($accountremainingbalances->first()->id);
            $accountledgers = $companyDetail->accountLedger;
            return view('accounts.parties', compact('accountremainingbalances', 'companyDetail', 'accountledgers'));
        } else {
            return view('accounts.emptyparty', ['request' => 'party']);
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
            'amount' => $request->openingbalance ?? 0
        ]);
        return redirect('/parties/viewledger/' . $request->companyname)->with('success', 'New party added successfully');
    }
    public function partiesCash(Request $request)
    {
        $request->validate([
            'companyname' => 'required|exists:company_details,company_name',
            'amount' => 'required'
        ]);
        $companyInformation = CompanyDetails::where('company_name', $request->companyname)->firstOrFail();
        $companyInformation->accountRemainingBalance()->decrement('amount', $request->amount);

        $data = [
            'date' => $request->date ?? Carbon::now(),
            'receipt_no' => $request->voucherno,
            'particulars' => $request->type,
            'debit' => $request->amount,
        ];

        if ($request->type == 'cheque') {

            $data['cheque_status'] = 'unsettled';
        }
        $companyInformation->accountLedger()->create($data);

        return redirect('/parties/viewledger/' . $request->companyname)->with('success', 'Cash payment recorded successfully');
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
            $data = [
                'date' => $request->date ?? Carbon::now(),
                'receipt_no' => $request->voucherno,
                'particulars' => $request->Paymenttype,
                'debit' => $request->amount,
            ];

            if ($request->Paymenttype == 'cheque') {
                $data['cheque_status'] = 'unsettled';
            }


            $companyInformation->accountRemainingBalance()->decrement('amount', $request->amount);
            $companyInformation->accountLedger()->create($data);
        }
        return redirect('/parties/viewledger/' . $request->companyname)->with('success', 'Purchase bill recorded successfully');
    }
    public function viewLedger($companyname)
    {
        // $accountremainingbalances = AccountRemainingBalance::orderBy('company_name')->get();
        $accountremainingbalances = CompanyDetails::orderBy('company_name')->get();
        $companyDetail = CompanyDetails::where('company_name', $companyname)->firstOrFail();
        $accountledgers = $companyDetail->accountLedger;
        return view('accounts.parties', compact('accountremainingbalances', 'companyDetail', 'accountledgers'));
    }
    public function editPartyLedgerDetails($id, $companyname)
    {
        $accountledger = AccountLedger::find($id);
        dd($accountledger);
    }
    public function editPartyDetails(Request $request)
    {
        $request->validate([

            'vatnumber' => 'nullable|min:7|max:9',
            'phonenumber' => 'nullable|min:7',
            'emailaddress' => 'nullable|email'
        ]);
        $partydetails = CompanyDetails::find($request->companyID);
        $partydetails->accountRemainingBalance()->decrement('amount', $partydetails->opening_balance);

        $partydetails->update([
            'company_name' => $request->companyname,
            'vat_number' => $request->vatnumber,
            'phone_number' => $request->phonenumber,
            'address' => $request->address,
            'email_address' => $request->emailaddress,
            'opening_balance' => $request->openingbalance ?? 0,
            'date' => $request->date ?? Carbon::now()
        ]);
        // $partydetails->accountRemainingBalance()->decrement('amount', $partydetails->opening_balance);
        $partydetails->accountRemainingBalance()->increment('amount', $request->openingbalance);
        return redirect('/parties/viewledger/' . $request->companyname)->with('success', 'Party detail updated succesfully');
    }
    public function deleteParty($id)
    {
        CompanyDetails::find($id)->delete();
        return redirect()->route('parties');
    }
    public function editPartyTransaction(Request $request)
    {
        $accountledger = AccountLedger::find($request->id);
        $partydetails = CompanyDetails::where('company_name', $request->companyname)->first();

        if ($request->type == 'purchase') {
            $accountledger->update([
                'receipt_no' => $request->billno,
                'date' => $request->date,
                'credit' => $request->amount,
            ]);
        } else {
            $accountledger->update([
                'receipt_no' => $request->billno,
                'date' => $request->date,
                'debit' => $request->amount,
            ]);
        }

        $remainingBalance = $partydetails->calculateRemainingBalance() + $partydetails->opening_balance;

        $partydetails->accountRemainingBalance()->update(['amount' => $remainingBalance]);

        return redirect()->back()->with('success', 'Update Successful');
    }


    /*
    *
    Customer controller 
    *
    */
    public function customerhandler()
    {
        $customerremainingbalances = CustomerDetail::orderBy('customer_name')->get();
        if ($customerremainingbalances->count() > 0) {
            $customerDetail = CustomerDetail::find($customerremainingbalances->first()->id);
            $customerledgers = $customerDetail->customerledger;

            return view('accounts.customers', compact('customerremainingbalances', 'customerDetail', 'customerledgers'));
        } else {
            return view('accounts.emptyparty', ['request' => 'customer']);
        }
    }
    public function addNewCustomer(Request $request)
    {
        $request->validate([
            'customername' => 'required',
            'vatnumber' => 'nullable|min:7|max:9',
            'phonenumber' => 'nullable|min:7',
            'emailaddress' => 'nullable|email'
        ]);

        $customerinformation = CustomerDetail::create([
            'customer_name' => $request->customername,
            'vat_number' => $request->vatnumber,
            'phone_number' => $request->phonenumber,
            'address' => $request->address,
            'email_address' => $request->emailaddress,
            'opening_balance' => $request->openingbalance ?? 0,
            'date' => $request->date ?? Carbon::now()
        ]);
        $customerinformation->customerRemainingBalance()->create([
            'company_id' => $customerinformation->id,
            'date' => $request->date ?? Carbon::now(),
            'amount' => $request->openingbalance ?? 0
        ]);
        return redirect('/customers/viewledger/' . $request->customername)->with('success', 'New party added successfully');
    }

    public function viewCustomerLedger($customername)
    {
        $customerremainingbalances = CustomerDetail::orderBy('customer_name')->get();
        $customerDetail = CustomerDetail::where('customer_name', $customername)->firstOrFail();
        $customerledgers = $customerDetail->customerledger;
        return view('accounts.customers', compact('customerremainingbalances', 'customerDetail', 'customerledgers'));
    }
    public function customerCash(Request $request)
    {
        $request->validate([
            'customername' => 'required|exists:customer_details,customer_name',
            'amount' => 'required'
        ]);
        $customerDetail = CustomerDetail::where('customer_name', $request->customername)->firstOrFail();
        $customerDetail->customerRemainingBalance()->decrement('amount', $request->amount);
        $data = [
            'date' => $request->date ?? Carbon::now(),
            'receipt_no' => $request->voucherno,
            'particulars' => $request->type,
            'credit' => $request->amount
        ];
        if ($request->type == 'cheque') {

            $data['cheque_status'] = 'unsettled';
        }
        $customerDetail->customerledger()->create($data);

        return redirect('/customers/viewledger/' . $request->customername)->with('success', 'Cash payment recorded successfully');
    }
    public function customerSales(Request $request)
    {
        $request->validate([
            'customername' => 'required|exists:customer_details,customer_name',
            'amount' => 'required'
        ]);
        $customerDetail = CustomerDetail::where('customer_name', $request->customername)->firstOrFail();
        $customerDetail->customerRemainingBalance()->increment('amount', $request->amount);
        $customerDetail->customerledger()->create([
            'date' => $request->date ?? Carbon::now(),
            'receipt_no' => $request->billno,
            'particulars' => 'sales by ' . $request->Salestype,
            'debit' => $request->amount,
            'bill_status' => $request->Salestype == "cash" ? "paid" : "unpaid"
        ]);
        if ($request->Salestype == "cash") {


            $data = [
                'date' => $request->date ?? Carbon::now(),
                'receipt_no' => $request->billno,
                'particulars' => $request->Paymenttype,
                'credit' => $request->amount,
            ];

            if ($request->Paymenttype == 'cheque') {
                $data['cheque_status'] = 'unsettled';
            }


            $customerDetail->customerRemainingBalance()->decrement('amount', $request->amount);


            $customerDetail->customerledger()->create($data);
        }
        return redirect('/customers/viewledger/' . $request->customername)->with('success', 'Sales bill recorded successfully');
    }
    public function editCustomerDetails(Request $request)
    {

        $request->validate([
            'customername' => 'required',
            'vatnumber' => 'nullable|min:7|max:9',
            'phonenumber' => 'nullable|min:7',
            'emailaddress' => 'nullable|email'
        ]);
        $customerDetail = CustomerDetail::find($request->customerID);
        $customerDetail->customerRemainingBalance()->decrement('amount', $customerDetail->opening_balance);
        $customerDetail->update([
            'customer_name' => $request->customername,
            'vat_number' => $request->vatnumber,
            'phone_number' => $request->phonenumber,
            'address' => $request->address,
            'email_address' => $request->emailaddress,
            'opening_balance' => $request->openingbalance ?? 0,
            'date' => $request->date ?? Carbon::now()
        ]);

        $customerDetail->customerRemainingBalance()->increment('amount',  $request->openingbalance);
        return redirect('/customers/viewledger/' . $request->customername)->with('success', 'Party detail updated succesfully');
    }
    public function deleteCustomer($id)
    {
        CustomerDetail::find($id)->delete();
        return redirect()->route('customers');
    }
    public function editCustomerTransaction(Request $request)
    {
        $accountledger = CustomerLedger::find($request->id);
        $customerdetails = CustomerDetail::where('customer_name', $request->customername)->first();

        if ($request->type == 'sales') {
            $accountledger->update([
                'receipt_no' => $request->billno,
                'date' => $request->date,
                'debit' => $request->amount,
            ]);
        } else {
            $accountledger->update([
                'receipt_no' => $request->billno,
                'date' => $request->date,
                'credit' => $request->amount,
            ]);
        }

        $remainingBalance = $customerdetails->calculateRemainingBalance() + $customerdetails->opening_balance;

        $customerdetails->customerRemainingBalance()->update(['amount' => $remainingBalance]);

        return redirect()->back()->with('success', 'Update Successful');
    }
}
