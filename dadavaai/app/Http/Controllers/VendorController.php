<?php

namespace App\Http\Controllers;

use App\Vendorpayment;
use App\Vendordelivery;
use App\Vendorproduct;
use App\Quotation;
use App\Ondemand;
use App\Vendor;
use App\Productprovide;
use App\Category;
use App\Mail\VendorMailVerify;
use App\Mail\RecoveryMail;
use App\Mail\PasswordChangeNotificationMail;
use Validator;
use Response;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class VendorController extends Controller
{
    

    //
    public function accountDetails()
    {
        $vendor_id = Session::get('VENDOR_ID');
        $vendor = Vendor::where('id', $vendor_id)->first();
        
        return view('vendor.accountDetails', compact( 'vendor'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate form data
        $rules = array(
            'vendor_name'     => 'required|string',
            'vendor_phone'    => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return response()->json(array('error' => $validator->getMessageBag()->toarray()));
        }


        $vendor = Vendor::where('id', Session::get('VENDOR_ID'))->first();
        if ($vendor) {
            $vendor->vendorName = $request->vendor_name;
            $vendor->phone = $request->vendor_phone;
            $vendor->storeName = $request->store_name;
            $vendor->address = $request->vendor_address;
            $vendor->city = $request->vendor_city;
            $vendor->country = $request->vendor_country;
            $vendor->zipCode = $request->vendor_zipCode;

            if($vendor->save()){
            return redirect()->back()->with('success', 'Congratulations! You have been updated successfully. Thank you.');
           
            }else{
                return redirect()->back()->with('error', 'failed');
            }
        }
        else{
            return redirect()->back()->with('error', 'failed! user not found');
        }
        
    }

    /**
     * forgot password view
     */
    public function changePassword()
    {
        return view('vendor.changePassword');
    }

    /**
     * forgot password confirm
     */
    public function confirmChangePassword(Request $request)
    {
        $vendor = Vendor::where('id', Session::get('VENDOR_ID'))->first();
        if ($vendor->password == md5($request->old_password)) {
            if ($request->new_password == $request->confirm_password) {

                $vendor->password = md5($request->new_password);
                $vendor->save();

                $password['old_password'] = $request->old_password;
                $password['new_password'] = $request->new_password;

                // Send notification by E-mail
                Mail::to($vendor->email)->send(new PasswordChangeNotificationMail($vendor, $password));

                return redirect('/vendor-dashboard')->with('success', 'You successfully change you password. Check mail to see details.');

            } else {

                return redirect('/vendor-change-password')->with('error', 'Your new password and confirm password is not same');
            }

        } else {

            
            return redirect('/vendor-change-password')->with('error', 'Your Old Password is not correct');

        }
    } 


    /**
     * forgot password view
     */
    public function forgotPassword()
    {
        return view('vendor.forgotPassword');
    }

    /**
     * forgot password email verify
     */
    public function recoveryEmailVerify( Request $request)
    {
        
        if ($request->email) {
            $vendor = Vendor::where('email', $request->email)->first();

            if ($vendor) {

                $password['password'] = str_random(6);
                $vendor->password = md5($password['password']);
                $vendor->save();

                // Send notification by E-mail
                Mail::to($vendor->email)->send(new RecoveryMail($password));

                return redirect('/vendor-forgot-password')->with('success', 'A mail send to your email address with new password');

            } else {
                return redirect('/vendor-forgot-password')->with('error', 'There is no account with the email you provided.');
            }
            

            # code...
        } else {
            return view('vendor.forgotPassword');
        }   
    }


    public function ondemandInvoice(Request $request)
    {
        $ondemand = Ondemand::find($request->ondemand_id);

        $vendor_id = Session::get('VENDOR_ID');
        $vendor = Vendor::where('id', $vendor_id)->first();

        $order = $ondemand->ondemandOrder->order;
        $quotation = Quotation::where('confirmation', true)
                                ->where('ondemand_id', $ondemand->id)
                                ->where('vendor_id', $vendor->id)
                                ->first();

        return view('vendor.ondemandInvoice', compact('order', 'quotation', 'vendor'));
    }

    public function productProvideDelete($id)
    {
        $productProvide = Productprovide::where('id', $id)->first();
        $productProvide->delete();
        return response()->json('deleted');
    }

    public function productProvideStore(Request $request)
    {
        // Validate form data
        $rules = array(
            'category_id'     => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return response()->json(array('error' => $validator->getMessageBag()->toarray()));
        }

        $vendor_id = Session::get('VENDOR_ID');
        $vendor = Vendor::where('id', $vendor_id)->first();
        if ($vendor) {
            $productProvide = new Productprovide;
            $productProvide->category_id = $request->category_id;
            $productProvide->subcategory_id = $request->subcategory_id;
            $productProvide->minicategory_id = $request->minicategory_id;
            $productProvide->vendor_id       = $vendor->id;

            $productProvide->save();

            return response()->json($productProvide);
        }else
        {
            return response()->json('Not a valid user');
        }

    }

    public function productProvideUpdate(Request $request, $id)
    {
        // Validate form data
        $rules = array(
            'category_id'     => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return response()->json(array('error' => $validator->getMessageBag()->toarray()));
        }

        $vendor_id = Session::get('VENDOR_ID');
        $vendor = Vendor::where('id', $vendor_id)->first();
        $productProvide = Productprovide::where('id', $id)->first();
        if ($vendor && $productProvide) {
            $productProvide->category_id = $request->category_id;
            $productProvide->subcategory_id = $request->subcategory_id;
            $productProvide->minicategory_id = $request->minicategory_id;
            $productProvide->vendor_id       = $vendor->id;

            $productProvide->save();

            return response()->json($productProvide);
        }else
        {
            return response()->json('Not a valid user');
        }

    }
   
    //which type of product vendor provide
    public function productProvide()
    {
        $vendor_id = Session::get('VENDOR_ID');
        $vendor = Vendor::where('id', $vendor_id)->first();
        $productProvide = ProductProvide::where('vendor_id', $vendor->id)->first();
        $categories = Category::all();
        return view('vendor.productProvide', compact( 'categories', 'productProvide'));
    }


    // Authinticate vendor
    public function login(Request $request){

        // Validate form data 
        $rules = array(
        'vendor_email' => 'required|email',
        'vendor_password' => 'required',
        );
        
        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return response()->json(array('error' => $validator->getMessageBag()->toarray()));
        }
        
        // Checks if the account is activated
        $vendor = Vendor::where('email', $request->vendor_email)
        ->where('status', '0')
        ->first();
        if($vendor){
            if($request->ajax()){
                return response()->json(array('error' =>'Your E-mail is not verified! Please check your E-mail & click on the link in the mail to activate your account. Thank you.'));
            }
            return redirect('/vendor-login')->with('error','Your E-mail is not verified! Please check your E-mail & click on the link in the mail to activate your account. Thank you.');

        }
        
        // Authorizes vendor
        $vendor = Vendor::where('email', $request->vendor_email)
        ->where('password', md5($request->vendor_password))
        ->first();

        if($vendor){
            Session::put('VENDOR_ID', $vendor->id);
            Session::put('VENDOR_Name', $vendor->vendorName);
            Session::put('VENDOR_Email', $vendor->email);
            
            if($request->ajax()){
                return response()->json(['vendor' => $vendor, 'success' => 'successfully loged in']);
            }
            return redirect('/vendor-dashboard')->with('success','successfully login');


        }else{ 
            if($request->ajax()){
                return response()->json(array('error' => 'Invalid E-mail or Password or both ! '));
            }
            return redirect('/vendor-login')->with('error','Invalid E-mail or Password or both !');
        }
    }

    // Logout vendor
    public function logout(Request $request){
        // Clear the user session
        Session::put('VENDOR_ID', NULL);
        Session::put('VENDOR_Name', NULL);
        Session::put('VENDOR_Email', NULL);

        // Redirect user to home page
        return redirect('/vendor-login');
    }    


    /**
     * verify vendor.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function verifyVendor($token)
    {
        $verifyVendor = Vendor::where('token', $token)->first();
        if(isset($verifyVendor)){
            if(!$verifyVendor->status) {
                $verifyVendor->status = 1;
                $verifyVendor->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/vendor-registration')->with('error', "Sorry your email cannot be identified.");
        }

        return redirect('/vendor-login')->with('success', $status);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        return view('vendor.login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registration()
    {
        return view('vendor.registration');
    }

    /**
     * This is for vendor dashboard
     */
    public function index()
    {
        $vendor = Vendor::where('id', Session::get('VENDOR_ID'))->first();

        //for rfqs status
        $totalRfs = count($vendor->ondemands);
        $totalPendingRfqs = 0;

        foreach($vendor->ondemands as $totalPendingRfq)
        {
            if($totalPendingRfq->status == true)
            {
                $totalPendingRfqs++;
            }
        }

        //for order status

        $totalOrders = count($vendor->vendorProductOrders);
        $totalPendingOrders = 0;
        $totalSales = 0;
        $paymentRecieved = 0;

        foreach($vendor->vendorProductOrders as $orderForVendor)
        {

            $deliveryStatus = Vendordelivery::where('order_id', $orderForVendor->order_id)
                                            ->where('vendor_id', $orderForVendor->vendor_id)
                                            ->first(); 

            //for count pending delivery                                
            if($deliveryStatus->status == 0)
            {
                $totalPendingOrders++;
            }

            //for count total sales

            if($deliveryStatus->status == 2 && $deliveryStatus->acknowledgement == 1)
            {
                $totalSales += $orderForVendor->totalPrice;
            }


            //for total payment recived

            $vendorPayment  = Vendorpayment::where('order_id', $orderForVendor->order_id)
                                            ->where('vendor_id', $orderForVendor->vendor_id)
                                            ->first();


            if($vendorPayment->status == 2 && $vendorPayment->acknowledgement == 1)
            {
                $paymentRecieved += $vendorPayment->paidAmount;
            }


        }


        //for delivery status

        $totalDelivered    = count(Vendordelivery::where('vendor_id', $vendor->id)->where('status','!=',0)->groupBy('order_id')->get());

        $totalPendingDelivery    = count(Vendordelivery::where('vendor_id', $vendor->id)->where('status',0)->groupBy('order_id')->get());

        //for product status
        $totalProducts = count(Vendorproduct::where('vendor_id', $vendor->id)->get());



        return view('vendor.dashboard', compact('vendor', 'totalRfs', 'totalPendingRfqs', 'totalOrders', 'totalPendingOrders', 'totalDelivered', 'totalPendingDelivery', 'totalProducts', 'totalSales', 'paymentRecieved'));
    }


    /**
     * This is for create vendor account
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form data
        $rules = array(
            'vendor_name'     => 'required|string',
            'vendor_email'    => 'required|email',
            'vendor_password' => 'required',
            'vendor_phone'    => 'required',

        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return response()->json(array('error' => $validator->getMessageBag()->toarray()));
        }

        // Checks if the email exists
        $cmrCheck = Vendor::where('email', $request->vendor_email)->get();
        if(!$cmrCheck->isEmpty()){
            // return response()->json(array('error' =>'This E-mail already exists! Please try with a different E-mail.'));
            return redirect()->back()->with('error', "This E-mail already exists! Please try with a different E-mail.");
        }

        if ($request->vendor_password !== $request->retype_password) {
            return redirect()->back()->with('error', "password not matched");
        }

        // Create instance of vendor model & assign form value then save to database
        $vendor = new Vendor;
        $vendor->vendorName = $request->vendor_name;
        $vendor->phone = $request->vendor_phone;

        $vendor->email = $request->vendor_email;
        $vendor->password = md5($request->vendor_password);
        $vendor->token = str_random(40);
        $vendor->commission = 10;

        $vendor->save();
        // Send verification link by E-mail
        Mail::to($vendor->email)->send(new VendorMailVerify($vendor));

        /* Checks if data is saved to database. If so, redirect back with success message. Otherwise, redirect back with error message */
        if($vendor){
            return redirect('/vendor-login')->with('success', 'Congratulations! You have successfully registered. We have send you an E-mail. Please check that E-mail & click on the link in the mail to activate your account. Thank you.');
            // return response()->json(array('success' => 'Congratulations! You have successfully registered. We have send you an E-mail. Please check that E-mail & click on the link in the mail to activate your account. Thank you.'));
        }else{
            return response()->json(array('error' => array('response' => 'Registration failed!')));
        }
        
    }


    /**
     * Display all vendor in admin panel
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function vendorList()
    {

        $vendors = Vendor::paginate(20);
        return view('admin.vendors', compact('vendors'));
    }

    /**
     * Display all vendor in admin panel
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function vendorCommission(Request $request)
    {

        
        $vendor = Vendor::where('id', $request->vendor_id)->first();
        $vendor->commission = $request->commission;
        $vendor->save();

        return response()->json($vendor);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
