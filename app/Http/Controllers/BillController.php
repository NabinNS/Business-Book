<?php

namespace App\Http\Controllers;

use App\Models\CompanyDetails;
use Illuminate\Http\Request;

class BillController extends Controller
{
    //
    public function BillPage()
    {
        $names = CompanyDetails::orderBy('company_name')->get();
        return view('bill',compact('names'));
    }
}
