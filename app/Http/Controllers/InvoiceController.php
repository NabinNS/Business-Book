<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function quotation(){
        return view('invoices.quotation');
    }
}
