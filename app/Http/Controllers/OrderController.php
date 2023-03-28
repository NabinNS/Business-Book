<?php

namespace App\Http\Controllers;

use App\Models\CompanyDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList()
    {
        $companyNames = CompanyDetails::all()->pluck('company_name');
        return view('order.orderlist', compact('companyNames'));
    }
    public function orderDetail($companyname, Request $request)
    {
              
        $companyInformation = CompanyDetails::where('company_name', $companyname)->firstOrFail();
        $orderNames = $companyInformation->order;
        return view('order.orderdetail', compact('companyname','orderNames'));
    }
    public function saveOrderDetail($companyname, Request $request)
    { 
        $companyInformation = CompanyDetails::where('company_name', $companyname)->firstOrFail();
        $companyInformation->order()->create([
            'name' => $request->productname,
            'quantity' => $request->quantity,
        ]);
        return redirect('/orderdetails/' . $companyname)->with('success', 'Order record successfull');
        
    }
}
