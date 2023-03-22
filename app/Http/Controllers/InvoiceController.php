<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        return view('invoices.quotationdetail', compact('quotationdetails', 'billno', 'customername'));
    }
}
