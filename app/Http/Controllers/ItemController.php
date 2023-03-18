<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use DB;
use PDF;

class ItemController extends Controller
{
    public function pdfview(Request $request)
    {
        $items = DB::table("customer_ledgers")->get();

        view()->share('items',$items);


        if($request->has('download')){
            $pdf = PDF::loadView('pdfview');
            return $pdf->download('pdfview.pdf');
        }


        return view('pdfview');
    }
}
