<?php

namespace App\Http\Controllers;

use App\Vendor;
use Session;
use Illuminate\Http\Request;

class RfqController extends Controller
{
    

    public function rfqs()
    {
	   	//Rfq or ondemand  notification for each vendors
	    $vendor_id = Session::get('VENDOR_ID');
	    $vendor = Vendor::where('id', $vendor_id)->first();
	    $rfqs = $vendor->ondemands;
	    return view('vendor.rfqs', compact('rfqs'));
    }



}
