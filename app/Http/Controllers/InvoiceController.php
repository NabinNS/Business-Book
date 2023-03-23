<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function quotation()
    {
        return view('invoices.quotation');
    }
    public function saveQuotation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'billno' => 'required|unique:quotations,bill_no',
            'product' => 'required',
            'quantity' => 'required',
            'rate' => 'required'
        ]);
        foreach ($request->product as $key => $value) {
            Quotation::create([
                'customer_name' => $request->name,
                'bill_no' =>  $request->billno,
                'date' => $request->date ?? Carbon::now(),
                'product_name' => $value,
                'quantity' => $request->quantity[$key],
                'rate' => $request->rate[$key]
            ]);
        }
        return redirect('/quotation')->with('success', 'Quotation saved successfully');
    }
    public function updateQuotation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'billno' => 'required',
            'product' => 'required',
            'quantity' => 'required',
            'rate' => 'required'
        ]);
        Quotation::where('bill_no', $request->billno)->delete();
        foreach ($request->product as $key => $value) {
            Quotation::create([
                'customer_name' => $request->name,
                'bill_no' =>  $request->billno,
                'date' => $request->date ?? Carbon::now(),
                'product_name' => $value,
                'quantity' => $request->quantity[$key],
                'rate' => $request->rate[$key]
            ]);
        }
        return redirect('/quotationrecord')->with('success', 'Quotation updated successfully');
    }
    public function quotationRecord()
    {
        $quotations = Quotation::select('bill_no', 'customer_name')
            ->groupBy('bill_no', 'customer_name')
            ->orderBy('bill_no')
            ->get();
        return view('invoices.quotationrecord', compact('quotations'));
    }
    public function quotationRecordDetail($billno, $customername)
    {
        $quotationdetails = Quotation::where('bill_no', $billno)->get();
        $date = Quotation::where('bill_no', $billno)->pluck('date')->firstOrFail(); 
        return view('invoices.quotationdetail', compact('quotationdetails', 'billno', 'customername','date'));
    }
    public function pdfQuotation($billno, $customername)
    {
        $quotationdetails = Quotation::where('bill_no', $billno)->get();
        $date = Quotation::where('bill_no', $billno)->pluck('date')->firstOrFail();    
        // return view('invoices.pdfquotation', compact('quotationdetails', 'billno', 'customername','date'));

        $pdf = PDF::loadView('invoices.pdfquotation', compact('quotationdetails', 'billno', 'customername','date'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download($customername . '.pdf');
    }
}
