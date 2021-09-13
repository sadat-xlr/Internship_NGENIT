<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partnership;

class PartnershipController extends Controller
{
    public function partnership()
    {
        return view('informative.partnership.partnership');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'company_name'    =>  'required',
            'company_website' =>  'required',
            'primary_product' =>  'required',
            'primary_business'=>  'required',
            'selling_item'    =>  'required',
            'contact_name'    =>  'required',
            'job_title'       =>  'required',
            'contact_email'   =>  'required',
            'contact_phone'   =>  'required',
        ]);

        $registred_company = Partnership::where('contact_email', $request->contact_email)->first();
        if ($registred_company) {
            return redirect()->back()->with('error', 'This email already used, Use another email');
        }

        $partnership = new Partnership();
        $partnership->company_name          =    $request->company_name;
        $partnership->company_website       =    $request->company_website;
        $partnership->company_address       =    $request->company_address;
        $partnership->city                  =    $request->city;  
        $partnership->zip_code              =    $request->zip_code;
        $partnership->country               =    $request->country;
        $partnership->fy_revenue            =    $request->fy_revenue;
        $partnership->projected_fy_revenue  =    $request->projected_fy_revenue;
        $partnership->employee              =    $request->employee;
        $partnership->primary_product       =    $request->primary_product;
        $partnership->primary_business      =    $request->primary_business;
        $partnership->selling_item          =    $request->selling_item;
        $partnership->referred              =    $request->referred;
        $partnership->contact_name          =    $request->contact_name;
        $partnership->job_title             =    $request->job_title;
        $partnership->contact_email         =    $request->contact_email;
        $partnership->contact_phone         =    $request->contact_phone;

        if ($partnership->save()) {
            // Send the mail
            Mail::send([], [], function($message) use ($request, $partnership) {
                $message->from('no-replay@techfocusltd.com');
            
                $message->to($partnership->contact_email);
                $message->subject('Partnership registration complete for '.$partnership->company_name);
                $message->setBody($partnership->contact_name.' You complete the partnership registration on behalf of '.$partnership->company_name, 'text/html');
            });

            return redirect()->back()->with('success', 'Successfully registered');
        }else{
            return redirect()->back()->with('error', 'Somthing wrong');
        }
        
        
    }
}
