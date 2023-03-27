<?php

namespace App\Http\Controllers;

use App\Models\CompanyDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList(){
        $companyNames = CompanyDetails::all()->pluck('company_name');
        return view('order.orderlist',compact('companyNames'));
    }
    public function orderDetail(){
        dd('ok');
    }
}
