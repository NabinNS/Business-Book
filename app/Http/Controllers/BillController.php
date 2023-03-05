<?php

namespace App\Http\Controllers;

use App\Models\CompanyDetails;
use App\Models\CustomerDetail;
use App\Models\StockCategory;
use App\Models\StockDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BillController extends Controller
{
    //
    public function BillPage($billtype)
    {
        if ($billtype == "purchase") {
            $names = CompanyDetails::orderBy('company_name')->get();
        }
        if ($billtype == "sales") {
            $names = CustomerDetail::orderBy('customer_name')->get();
        }
        $productnames = StockDetail::orderBy('stock_name')->get();
        return view('bill', compact('names', 'productnames', 'billtype'));
    }
    public function billingRecord(Request $request, $billtype)
    {
        //   dd($request->all());

        $request->validate([
            'productname' => 'required|exists:stock_details,stock_name',
            'quantity' => 'required',
            'billingname' => 'required',
            'totalamt' => 'required',
            'billno' => 'required|unique:stock_ledgers,receipt_no'
        ]);
        if ($billtype == "purchase") {
            $companyInformation = CompanyDetails::where('company_name', $request->billingname)->firstOrFail();
            $companyInformation->accountRemainingBalance()->increment('amount', $request->totalamt);
            $companyInformation->accountLedger()->create([
                'date' => $request->date ?? Carbon::now(),
                'receipt_no' => $request->billno,
                'particulars' => 'purchase by ' . $request->transactiontype,
                'credit' => $request->totalamt
            ]);

            if ($request->transactiontype == "cash") {
                $companyInformation->accountRemainingBalance()->decrement('amount', $request->totalamt);
                $companyInformation->accountLedger()->create([
                    'date' => $request->date ?? Carbon::now(),
                    'receipt_no' => $request->billno,
                    'particulars' => $request->transactiontype,
                    'debit' => $request->totalamt
                ]);
            }

            foreach ($request->productname as $key => $value) {
                $stockInformation = StockDetail::where('stock_name', $value)->firstOrFail();
                $stockInformation->stockRemainingBalance()->increment('quantity', $request->quantity[$key]);
                $stockInformation->stockledger()->create([
                    'date' => $request->date ?? Carbon::now(),
                    'particulars' => 'purchase',
                    'receipt_no' => $request->billno,
                    'quantity' => $request->quantity[$key],
                    'rate' => $request->rate[$key],
                ]);
            }

            return redirect('/parties/viewledger/' . $request->billingname)->with('success', 'Purchase bill recorded successfully');
        } else {

            $customerDetail = CustomerDetail::where('customer_name', $request->billingname)->firstOrFail();
            $customerDetail->customerRemainingBalance()->increment('amount', $request->totalamt);
            $customerDetail->customerledger()->create([
                'date' => $request->date ?? Carbon::now(),
                'receipt_no' => $request->billno,
                'particulars' => 'sales by ' . $request->transactiontype,
                'debit' => $request->totalamt
            ]);

            if ($request->transactiontype == "cash") {
                $customerDetail->customerRemainingBalance()->decrement('amount', $request->totalamt);
                $customerDetail->customerledger()->create([
                    'date' => $request->date ?? Carbon::now(),
                    'receipt_no' => $request->billno,
                    'particulars' => $request->transactiontype,
                    'credit' => $request->totalamt
                ]);
            }
            return redirect('/customers/viewledger/' . $request->billingname)->with('success', 'Sales bill recorded successfully');
        }
    }
    public function returnBack()
    {
       
    }



    //     public function updateStock(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'productname' => ['required', 'array'],
    //         'productname.*' => ['required', 'string'],
    //         'quantity' => ['required', 'array'],
    //         'quantity.*' => ['required', 'numeric', 'min:1'],
    //         'rate' => ['required', 'array'],
    //         'rate.*' => ['required', 'numeric', 'min:0'],
    //         'billno' => ['required', 'string'],
    //         'date' => ['nullable', 'date'],
    //     ]);

    //     DB::transaction(function () use ($validatedData) {
    //         foreach ($validatedData['productname'] as $key => $value) {
    //             $stockInformation = StockDetail::where('stock_name', $value)->firstOrFail();
    //             $quantity = $validatedData['quantity'][$key];
    //             $rate = $validatedData['rate'][$key];
    //             $existingRecord = $stockInformation->stockledger()->where('receipt_no', $validatedData['billno'])->first();

    //             if ($existingRecord) {
    //                 // Update existing record with new values
    //                 $existingRecord->quantity = $quantity;
    //                 $existingRecord->rate = $rate;
    //                 $existingRecord->save();
    //             } else {
    //                 // Create new record with supplied values
    //                 $stockInformation->stockRemainingBalance()->increment('quantity', $quantity);
    //                 $stockInformation->stockledger()->create([
    //                     'date' => $validatedData['date'] ?? now(),
    //                     'particulars' => 'purchase',
    //                     'receipt_no' => $validatedData['billno'],
    //                     'quantity' => $quantity,
    //                     'rate' => $rate,
    //                 ]);
    //             }
    //         }
    //     });
    // }

}
