<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ContactController;

use App\Offer;
use App\Bundleoffer;
use App\Product;
use App\Client;
use App\Billingaddress;
use App\Shippingaddress;
use App\Order;
use App\Preorder;
use App\Prebook;
use App\Mail\VerifyMail;
use App\Mail\RecoveryMail;
use App\Mail\PasswordChangeNotificationMail;
use Validator;
use Response;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;



class ClientController extends Controller
{


    // To show previous delivery history
    public function paymentHistory(){
            
        try{
            $client_id = Session::get('CLIENT_ID');
            $client = Client::where('id', $client_id)->first();

            $preOrders = Preorder::where('client_id',$client_id)->orderBy('created_at', 'Desc')->get();

            $orders = Order::where('client_id',$client_id)->orderBy('created_at', 'Desc')->paginate(10);

            return view('client.account.paymentHistory', compact('orders','preOrders'));
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }


    }

    

    // To show previous delivery history
    public function deliveryHistory(){
        try{    
            $client_id = Session::get('CLIENT_ID');
            $client = Client::where('id', $client_id)->first();

            $currentOrders = Order::where('client_id',$client_id)
                                    ->where('status','!=', 8)
                                    ->orderBy('created_at', 'Desc')->get();

            $orders = Order::where('client_id',$client_id)
                            ->where('status', 8)
                            ->orderBy('created_at', 'Desc')->paginate(10);

            
            return view('client.account.deliveryHistory', compact('orders','currentOrders'));
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
    }
    



    /**
     * client offers view
     */
    public function clientOffers()
    {
        try{ 
            $promo   =   count(Product::select('id')->where('promotion', true)->where('published', false)->get());
            $occasion   =   count(Product::select('id')->where('occasion', true)->where('published', false)->get());
            $b_g   =   count(Product::select('id')->where('buy_get', true)->where('published', false)->get());
            $discount   =   count(Product::select('id')->where('discount', '!=', null)->where('published', false)->get());
            $deal   =   count(Product::select('id')->where('deal_id', '!=', null)->where('published', false)->get());
            $bundleOffer   =   count(Bundleoffer::select('product_id')->distinct()->get());
            $clearance   =   count(Product::select('id')->where('clearance', true)->where('published', false)->get());
            $preBooking   =   count(Prebook::select('product_id')->distinct()->get());

            $currentTime = Carbon::now()->format('h:m:s');
            $luckyToday = count(Offer::where('valid_until','>=', $currentTime)->where('status', true)->get()); 


            
            $emi   =   count(Product::select('id')->where('promotion', true)->where('published', false)->get());
            $hotDeal   =   count(Product::select('id')->where('promotion', true)->where('published', false)->get());
            $free   =   count(Product::select('id')->where('promotion', true)->where('published', false)->get());

            $randomLuckyToday = Offer::where('valid_until','>=', $currentTime)->where('status', true)->inRandomOrder()->first(); 
            $randomPreBooking   =   Prebook::inRandomOrder()->first();
            

            return view('client.account.offer', compact('promo', 'occasion', 'b_g', 'discount', 'deal', 'bundleOffer', 'preBooking', 'clearance', 'luckyToday', 'randomLuckyToday', 'currentTime', 'randomPreBooking'));
        
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }

    }

    
    /**
     * forgot password view
     */
    public function changePassword()
    {
        return view('client.account.changePassword');
    }

    /**
     * forgot password confirm
     */
    public function confirmChangePassword(Request $request)
    {
        try{
            $client_id = Session::get('CLIENT_ID');
            $client = Client::where('id', $client_id)->first();

            if ($client->password == md5($request->old_password)) {

                if ($request->new_password == $request->confirm_password) {

                    
                    $client->password = md5($request->new_password);
                    $client->save();

                    $password['old_password'] = $request->old_password;
                    $password['new_password'] = $request->new_password;

                    // Send notification by E-mail
                    Mail::to($client->email)->send(new PasswordChangeNotificationMail($client, $password));

                    return redirect('/client-dashboard')->with('success', 'You successfully change you password. Check mail to see details.');

                } else {

                    return redirect('client-change-password')->with('error', 'Your new password and confirm password is not same');
                }

            } else {
                return redirect('client-change-password')->with('error', 'Your Old Password is not correct');
            }
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
    }    



    /**
     * forgot password view
     */
    public function forgotPassword()
    {
        return view('client.forgotPassword');
    }

    /**
     * forgot password email verify
     */
    public function recoveryEmailVerify( Request $request)
    {
        try{
            if ($request->email) {
                $client = Client::where('email', $request->email)->first();

                if ($client) {

                    $password['password'] = str_random(6);
                    $client->password = md5($password['password']);
                    $client->save();

                    // Send notification by E-mail
                    Mail::to($client->email)->send(new RecoveryMail($password));

                    return redirect('/forgot-password')->with('success', 'A mail send to your email address with new password');

                } else {
                    return redirect('/forgot-password')->with('error', 'There is no account with the email you provided.');
                }
                

                # code...
            } else {
                return view('client.forgotPassword');
            } 
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }  
    }

    public function showInvoice($order_id)
    {
        // Get the order & update
        $order = Order::find($order_id);


        return view('client.invoice', compact('order'));
    }

    // To show previous order history
    public function orderHistory(){
        try{    
            $client_id = Session::get('CLIENT_ID');
            $client = Client::where('id', $client_id)->first();

            $currentOrders = Order::where('client_id',$client_id)
                                    ->where('status','!=', 8)
                                    ->orderBy('created_at', 'Desc')->get();

            $orders = Order::where('client_id',$client_id)->orderBy('created_at', 'Desc')->paginate(10);
            return view('client.account.orderHistory', compact('orders','currentOrders'));
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
    }
    

    // To show previous preOrder history
    public function preOrder(){
        try{
            $client_id = Session::get('CLIENT_ID');
            $client = Client::where('id', $client_id)->first();

            $preOrders = Preorder::where('client_id',$client_id)->orderBy('created_at', 'Desc')->paginate(10);
            return view('client.account.preOrderHistory', compact('preOrders'));
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
    }    

    //pre  order invoice
    public function preOrderInvoice($preorder_id)
    {
        try{    
            $client_id = Session::get('CLIENT_ID');
            $client = Client::where('id', $client_id)->first();
            // Get the order & update
            $preorder = Preorder::find($preorder_id);
            $prebook = 0;

            if($preorder->prebook_id){
                $prebook = Prebook::find($preorder->prebook_id);
            }

            return view('client.preOrderInvoice', compact('client', 'prebook', 'preorder'));
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
    }

    
    // Authinticate client
    public function login(Request $request){

        try{
            // Validate form data 
            $rules = array(
            'email' => 'required|email',
            'password' => 'required',
            );
            
            $validator = Validator::make ( Input::all(), $rules);
            if ($validator->fails()){
                return response()->json(['error' => $validator->getMessageBag()->toarray()]);
            }
            
            // Checks if the account is activated
            $client = Client::where('email', $request->email)
            ->where('status', '0')
            ->first();
            if($client){
                if($request->ajax()){
                    return response()->json(array('error' =>'Your E-mail is not verified! Please check your E-mail & click on the link in the mail to activate your account. Thank you.'));
                }
                return redirect('/client-login-register')->with('error','Your E-mail is not verified! Please check your E-mail & click on the link in the mail to activate your account. Thank you.');

            }
            
            // Authorizes client
            $client = Client::where('email', $request->email)
            ->where('password', md5($request->password))
            ->first();

            if($client){
                Session::put('CLIENT_ID', $client->id);
                Session::put('CLIENT_Name', $client->clientName);
                Session::put('CLIENT_Email', $client->email);
                
                if($request->ajax()){
                    return response()->json(['client' => $client, 'success' => 'successfully loged in']);
                }
                return redirect('/client-dashboard')->with('success','successfully login');


            }else{ 
                
                if($request->ajax()){
                    // return response()->json(array('error' => 'Invalid E-mail or Password or both ! '));
                    return response()->json(['error' => 'Invalid E-mail or Password or both ! ']);
                }
                return redirect('/client-login-register')->with('error','Invalid E-mail or Password or both !');
            }
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
    }

    // Logout client
    public function logout(Request $request){
        // Clear the user session
        Session::put('CLIENT_ID', NULL);
        Session::put('CLIENT_Name', NULL);
        Session::put('CLIENT_Email', NULL);

        // Redirect user to home page
        return redirect('/');
    }


    // To show payment method 
    public function paymentMethod(){
        $client_id = Session::get('CLIENT_ID');
        $client = Client::where('id', $client_id)->first();
        return view('client.account.paymentMethod', compact('client', $client));
    }

    /**
     * Store client payment method.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function payment_store(Request $request)
    {
        // Get the client
        $payment = Clientpayment::where('client_id', Session::get('ID'))->first();

        // if already has one update it. Otherwise create new instance
        if (!$payment){
            // Create new instance of payment
            $payment = new Clientpayment();
            $payment->client_id = Session::get('ID');
        }

        // Assign null to every field
        $payment->accNo = null;
        $payment->acc_name = null;
        $payment->bank_name = null;

        // Assign payment method
        $payment->paymentMethod = $request->paymentMethod;

        // Check payment method
        if ($request->paymentMethod == 0){
            // Validate form data
            $rules = array(
                'bkash_number' => 'required',
            );

            $payment->accNo = $request->bkash_number;
            $payment->bank_name = 'BRAC Bank';
        }elseif ($request->paymentMethod == 1){
            // Validate form data
            $rules = array(
                'rocket_number' => 'required',
            );

            $payment->accNo = $request->rocket_number;
            $payment->bank_name = 'Dutch-Bangla Bank';
        }elseif ($request->paymentMethod == 2){
            // Validate form data
            $rules = array(
                'bacs_acc_name' => 'required',
                'bacs_acc_no' => 'required',
                'bacs_bank_name' => 'required',
            );

            $payment->acc_name = $request->bacs_acc_name;
            $payment->accNo = $request->bacs_acc_no;
            $payment->bank_name = $request->bacs_bank_name;
        }

        if (isset($rules)){
            $validator = Validator::make ( Input::all(), $rules);
            if ($validator->fails()){
                return Response::json(array('errors' => $validator->getMessageBag()->toarray()));
            }
        }

        // Assign form value then save to database
        $payment->save();

        // Return json response
        return response()->json($payment);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $client = Client::where('id', Session::get('CLIENT_ID'))->first();

            return view('client.account.clientDashboard')->with( 'client', $client);
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerView()
    {
        try{

            if($client = Client::where('id', Session::get('CLIENT_ID'))->first())
            {
                return redirect('/client-dashboard');
            }
            return view('client.account.registerView');
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        if($client = Client::where('id', Session::get('CLIENT_ID'))->first())
        {
            return redirect('/client-dashboard');
        }
        return view('client.account.loginRegister');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{   
            // Validate form data
            $rules = array(
                'email' => 'required|email',
                'password' => 'required',
            );

            $validator = Validator::make ( Input::all(), $rules);
            if ($validator->fails()){
                return response()->json(array('error' => $validator->getMessageBag()->toarray()));
            }

            // Checks if the email exists
            $cmrCheck = Client::where('email', $request->email)->get();
            if(!$cmrCheck->isEmpty()){
                return response()->json(array('error' =>'This E-mail already exists! Please try with a different E-mail.'));
            }

            // Create instance of Client model & assign form value then save to database
            $client = new Client;
            $client->clientName = $request->clientName;
            $client->address = $request->address;
            $client->city = $request->city;
            $client->country = $request->country;
            $client->division = $request->division;
            $client->zipCode = $request->zipCode;
            $client->phone = $request->phone;

            $client->email = $request->email;
            $client->password = md5($request->password);
            $client->token = str_random(40);

            /* Checks if data is saved to database. If so, redirect back with success message. Otherwise, redirect back with error message */
            if($client->save()){
                // Send verification link by E-mail
                Mail::to($client->email)->send(new VerifyMail($client));

                //agail crm

                $address = array(
                    "address"=>$request->address,
                    "city"=>$request->city,
                    "state"=>$request->division,
                    "country"=>$request->country
                );
                $contact_email = $request->email;
                $contact_json = array(
                    "lead_score"=>"80",
                    "star_value"=>"5",
                    "tags"=>array("client"),
                    "properties"=>array(
                      array(
                        "name"=>"first_name",
                        "value"=>$request->name,
                        "type"=>"SYSTEM"
                      ),
                      array(
                        "name"=>"last_name",
                        "value"=>"",
                        "type"=>"SYSTEM"
                      ),
                      array(
                        "name"=>"email",
                        "value"=>$contact_email,
                        "type"=>"SYSTEM"
                      ),  
                      array(
                          "name"=>"title",
                          "value"=>"",
                          "type"=>"SYSTEM"
                      ),
                      array(
                          "name"=>"address",
                          "value"=>json_encode($address),
                          "type"=>"SYSTEM"
                      ),
                      array(
                          "name"=>"phone",
                          "value"=>$request->phone,
                          "type"=>"SYSTEM"
                      ),
                      array(
                          "name"=>"TeamNumbers",  
                          "value"=>"",
                          "type"=>"CUSTOM"
                      ),
                      array(
                          "name"=>"Date Of Joining",
                          "value"=>"",		
                          "type"=>"CUSTOM"
                      )
                      
                    )
                );
                  
                $contact_json = json_encode($contact_json);
                $crm = new ContactController;
        
                $crm->curl_wrap("contacts", $contact_json, "POST", "application/json");
                

                return response()->json(array('success' => 'Congratulations! You have successfully registered. We have send you an E-mail. Please check that E-mail & click on the link in the mail to activate your account. Thank you.'));
            }else{
                return response()->json(array('error' => array('response' => 'Registration failed!')));
            }
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
    }

    public function useAddress(Request $request)
    {
        
        try{
            $client_id = Session::get('CLIENT_ID');
            $client = Client::where('id', $client_id)->first();
            $billingAddress = Billingaddress::where('client_id', $client_id)->first();
            $shippingAddress = Shippingaddress::where('client_id', $client_id)->first();

            if ($request->shipping == true && $request->billing == true) {

                if($billingAddress)
                {
                    $billingAddress->name = $client->clientName;
                    $billingAddress->address = $client->address;
                    $billingAddress->town = $client->city;
                    $billingAddress->country = $client->country;
                    $billingAddress->division = $client->division;
                    $billingAddress->zipCode = $client->zipCode;
                    $billingAddress->phone = $client->phone;
                    $billingAddress->email = $client->email;
                    $billingAddress->save();
                    
                }else{
                    
                    $billingAddress = new Billingaddress;
                    $billingAddress->name = $client->clientName;
                    $billingAddress->address = $client->address;
                    $billingAddress->town = $client->city;
                    $billingAddress->country = $client->country;
                    $billingAddress->division = $client->division;
                    $billingAddress->zipCode = $client->zipCode;
                    $billingAddress->phone = $client->phone;
                    $billingAddress->email = $client->email;
                    $billingAddress->client_id = $client_id;
                    $billingAddress->save();
                    
                }

                if($shippingAddress)
                {
                    $shippingAddress->name = $client->clientName;
                    $shippingAddress->address = $client->address;
                    $shippingAddress->town = $client->city;
                    $shippingAddress->country = $client->country;
                    $shippingAddress->division = $client->division;
                    $shippingAddress->zipCode = $client->zipCode;
                    $shippingAddress->phone = $client->phone;
                    $shippingAddress->email = $client->email;
                    $shippingAddress->save();
                    
                }else{
                    
                    $shippingAddress = new Shippingaddress;
                    $shippingAddress->name = $client->clientName;
                    $shippingAddress->address = $client->address;
                    $shippingAddress->town = $client->city;
                    $shippingAddress->country = $client->country;
                    $shippingAddress->division = $client->division;
                    $shippingAddress->zipCode = $client->zipCode;
                    $shippingAddress->phone = $client->phone;
                    $shippingAddress->email = $client->email;
                    $shippingAddress->client_id = $client_id;
                    $shippingAddress->save();
                    
                }
                return redirect()->back()->with('success', 'Information updated');
            }

            if ($request->shipping == true ) {

                
                if ($client) {
                    
                    if($shippingAddress)
                    {
                        $shippingAddress->name = $client->clientName;
                        $shippingAddress->address = $client->address;
                        $shippingAddress->town = $client->city;
                        $shippingAddress->country = $client->country;
                        $shippingAddress->division = $client->division;
                        $shippingAddress->zipCode = $client->zipCode;
                        $shippingAddress->phone = $client->phone;
                        $shippingAddress->email = $client->email;
                        $shippingAddress->save();
                        
                    }else{
                        
                        $shippingAddress = new Shippingaddress;
                        $shippingAddress->name = $client->clientName;
                        $shippingAddress->address = $client->address;
                        $shippingAddress->town = $client->city;
                        $shippingAddress->country = $client->country;
                        $shippingAddress->division = $client->division;
                        $shippingAddress->zipCode = $client->zipCode;
                        $shippingAddress->phone = $client->phone;
                        $shippingAddress->email = $client->email;
                        $shippingAddress->client_id = $client_id;
                        $shippingAddress->save();
                        
                    }

                    return redirect()->back()->with('success', 'Information updated');
                }
                else
                {
                    return redirect()->back()->with('error', 'your address was not specified');
                }
            }

            if ($request->billing == true) {

                
                if ($client) {
                    
                    if($billingAddress)
                    {
                        $billingAddress->name = $client->clientName;
                        $billingAddress->address = $client->address;
                        $billingAddress->town = $client->city;
                        $billingAddress->country = $client->country;
                        $billingAddress->division = $client->division;
                        $billingAddress->zipCode = $client->zipCode;
                        $billingAddress->phone = $client->phone;
                        $billingAddress->email = $client->email;
                        $billingAddress->save();
                        
                    }else{
                        
                        $billingAddress = new Billingaddress;
                        $billingAddress->name = $client->clientName;
                        $billingAddress->address = $client->address;
                        $billingAddress->town = $client->city;
                        $billingAddress->country = $client->country;
                        $billingAddress->division = $client->division;
                        $billingAddress->zipCode = $client->zipCode;
                        $billingAddress->phone = $client->phone;
                        $billingAddress->email = $client->email;
                        $billingAddress->client_id = $client_id;
                        $billingAddress->save();
                        
                    }

                    return redirect()->back()->with('success', 'Information updated');
                }
                else
                {
                    return redirect()->back()->with('error', 'your address was not specified');
                }

            }
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function address()
    {
        try{
            $client_id = Session::get('CLIENT_ID');
            $client = Client::where('id', $client_id)->first();

            $billingAddress = Billingaddress::where('client_id',$client_id)->first();
            $shippingAddress = Shippingaddress::where('client_id',$client_id)->first();
            return view('client.account.address', compact('client', 'billingAddress', 'shippingAddress'));
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function editAddress(Request $request)
    {
        try{
            $client_id = Session::get('CLIENT_ID');
            $client = Client::where('id', $client_id)->first();
            
            $client->clientName = $request->clientName;
            $client->address = $request->address;
            $client->city = $request->city;
            $client->country = $request->country;
            $client->division = $request->division;
            $client->zipCode = $request->zipCode;
            $client->phone = $request->phone;
            $client->email = $request->email;
            $client->save();
            
            return response()->json(['client' => $client, 'success' => 'Information updated']);
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function billingAddress(Request $request)
    {
        try{
            $client_id = Session::get('CLIENT_ID');
            $billingAddress = Billingaddress::where('client_id', $client_id)->first();

            if($billingAddress)
            {
                $billingAddress->name = $request->name;
                $billingAddress->address = $request->address;
                $billingAddress->town = $request->town;
                $billingAddress->country = $request->country;
                $billingAddress->division = $request->division;
                $billingAddress->zipCode = $request->zipCode;
                $billingAddress->phone = $request->phone;
                $billingAddress->email = $request->email;
                $billingAddress->save();
                
                return response()->json(['billingAddress' => $billingAddress, 'success' => 'Information updated']);
            }else{
                
                $billingAddress = new Billingaddress;
                $billingAddress->name = $request->name;
                $billingAddress->address = $request->address;
                $billingAddress->town = $request->town;
                $billingAddress->country = $request->country;
                $billingAddress->division = $request->division;
                $billingAddress->zipCode = $request->zipCode;
                $billingAddress->phone = $request->phone;
                $billingAddress->email = $request->email;
                $billingAddress->client_id = $client_id;
                $billingAddress->save();
                
                return response()->json(['billingAddress' => $billingAddress, 'success' => 'Information addesd']);
            }
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function shippingAddress(Request $request)
    {
        try{
            $client_id = Session::get('CLIENT_ID');
            $shippingAddress = Shippingaddress::where('client_id', $client_id)->first();

            if($shippingAddress)
            {
                $shippingAddress->name = $request->name;
                $shippingAddress->address = $request->address;
                $shippingAddress->town = $request->town;
                $shippingAddress->country = $request->country;
                $shippingAddress->division = $request->division;
                $shippingAddress->zipCode = $request->zipCode;
                $shippingAddress->phone = $request->phone;
                $shippingAddress->email = $request->email;
                $shippingAddress->save();
                
                return response()->json(['shippingAddress' => $shippingAddress, 'success' => 'Information updated']);
            }else{
                
                $shippingAddress = new Shippingaddress;
                $shippingAddress->name = $request->name;
                $shippingAddress->address = $request->address;
                $shippingAddress->town = $request->town;
                $shippingAddress->country = $request->country;
                $shippingAddress->division = $request->division;
                $shippingAddress->zipCode = $request->zipCode;
                $shippingAddress->phone = $request->phone;
                $shippingAddress->email = $request->email;
                $shippingAddress->client_id = $client_id;
                $shippingAddress->save();
                
                return response()->json(['shippingAddress' => $shippingAddress, 'success' => 'Information addesd']);
            }
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    /**
     * verify client.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function verifyUser($token)
    {
        try{    
            $verifyUser = Client::where('token', $token)->first();
            if(isset($verifyUser)){
                if(!$verifyUser->status) {
                    $verifyUser->status = 1;
                    $verifyUser->save();
                    $status = "Your e-mail is verified. You can now login.";
                }else{
                    $status = "Your e-mail is already verified. You can now login.";
                }
            }else{
                return redirect('/client-login-register')->with('error', "Sorry your email cannot be identified.");
            }

            return redirect('/client-login-register')->with('success', $status);
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }
    }
}
