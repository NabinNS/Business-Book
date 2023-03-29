<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\CompanyDetails;
use App\Models\Order;
use Illuminate\Http\Request;
use Mail;

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
        return view('order.orderdetail', compact('companyname', 'orderNames'));
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
    public function orderMail($companyname)
    {
        $companyInformation = CompanyDetails::where('company_name', $companyname)->firstOrFail();
        $orderNames = $companyInformation->order;
        Mail::to("nabin@gmail.com")->send(new OrderMail($orderNames));
        $companyInformation->order()->delete();
        return back()->with('success', 'We have e-mailed your password reset link!');
    }
    public function destroy($id)
    {
        $orderName = Order::findOrFail($id);
        $orderName->delete();

        return redirect()->back();
    }
}
