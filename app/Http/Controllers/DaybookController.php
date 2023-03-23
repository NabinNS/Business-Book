<?php

namespace App\Http\Controllers;

use App\Models\AccountLedger;
use Illuminate\Http\Request;

class DaybookController extends Controller
{
    public function daybookPage(){


        return view('daybook.daybook');
    }
}
