<?php

namespace App\Http\Controllers;

use App\Models\AccountRemainingBalance;
use App\Models\CompanyDetails;
use App\Models\CustomerDetail;
use App\Models\UserCompany;
use PDF;
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
        $fiscalYear = ($currentYear) . '/' . ($currentYear + 1);
        $partyDetail = CompanyDetails::where('company_name', $name)->firstOrFail();
        $remainingBalance = $partyDetail->accountRemainingBalance->amount;
        $partyLedgers = $partyDetail->accountLedger;
        $totalAmtWithVat = $partyLedgers->sum('credit');
        $companyName = UserCompany::first();
        return view('confirmation.partiesconfirmation', compact('totalAmtWithVat', 'partyDetail', 'fiscalYear', 'remainingBalance','companyName'));
    }
    public function viewCustomersConfirmation($name)
    {

        $currentYear = date('Y');
        $fiscalYear = ($currentYear) . '/' . ($currentYear + 1);
        $customerDetail = CustomerDetail::where('customer_name', $name)->firstOrFail();
        $remainingBalance = $customerDetail->customerRemainingBalance->amount;
        $customerLedger = $customerDetail->customerledger;
        $totalAmtWithVat = $customerLedger->sum('debit');
        $companyName = UserCompany::first();
        return view('confirmation.customerconfirmation', compact('totalAmtWithVat', 'remainingBalance', 'customerDetail', 'fiscalYear','companyName'));
    }

    public function pdfCustomerDownload($name)
    {
        $currentYear = date('Y');
        $fiscalYear = ($currentYear) . '/' . ($currentYear + 1);
        $customerDetail = CustomerDetail::where('customer_name', $name)->firstOrFail();
        $remainingBalance = $customerDetail->customerRemainingBalance->amount;
        $customerLedger = $customerDetail->customerledger;
        $totalAmtWithVat = $customerLedger->sum('debit');
        $companyName = UserCompany::first();

        $pdf = PDF::loadView('confirmation.pdf-customer-confirmation', compact('totalAmtWithVat', 'remainingBalance', 'customerDetail', 'fiscalYear','companyName'))->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->download('pdfview.pdf');
        return $pdf->download($customerDetail->customer_name . '.pdf');
    }

    public function pdfPartyDownload($name)
    {

        $currentYear = date('Y');
        $fiscalYear = ($currentYear) . '/' . ($currentYear + 1);
        $partyDetail = CompanyDetails::where('company_name', $name)->firstOrFail();
        $remainingBalance = $partyDetail->accountRemainingBalance->amount;
        $partyLedgers = $partyDetail->accountLedger;
        $totalAmtWithVat = $partyLedgers->sum('credit');
        $companyName = UserCompany::first();

        $pdf = PDF::loadView('confirmation.pdf-party-confirmation', compact('totalAmtWithVat', 'remainingBalance', 'partyDetail', 'fiscalYear','companyName'))->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->download('pdfview.pdf');
        return $pdf->download($partyDetail->company_name . '.pdf');
    }
    public function pdfPartyDownloadd($name)
    {

        $currentYear = date('Y');
        $fiscalYear = ($currentYear) . '/' . ($currentYear + 1);
        $partyDetail = CompanyDetails::where('company_name', $name)->firstOrFail();
        $remainingBalance = $partyDetail->accountRemainingBalance->amount;
        $partyLedgers = $partyDetail->accountLedger;
        $totalAmtWithVat = $partyLedgers->sum('credit');

        return view('confirmation.pdf-party-confirmation', compact('totalAmtWithVat', 'remainingBalance', 'partyDetail', 'fiscalYear'));

    }
}
