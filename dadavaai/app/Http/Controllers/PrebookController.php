<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

use App\Preorderpayment;
use Carbon\Carbon;
use Response;
use Validator;
use Session;
use App\Prebook;
use App\Product;
use App\Preorder;
use App\Payment;
use App\Client;
use App\Billingaddress;
use App\Shippingaddress;
use App\Mail\PreOrderPlaced;


class PrebookController extends Controller
{
    
    public function remainingPaymentSuccess(Request $request)
    {
        try {
            $preorder_id = '';

            
            //client information
            $client = Client::find(Session::get('CLIENT_ID'));

            
    
            $val_id=urlencode($_POST['val_id']);
            $store_id=urlencode("jarat5e6dad879bd4c");
            $store_passwd=urlencode("jarat5e6dad879bd4c@ssl");
            $requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");
    
            $handle = \curl_init();
            curl_setopt($handle, CURLOPT_URL, $requested_url);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC
    
            $result = curl_exec($handle);
    
            $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    
            if($code == 200 && !( curl_errno($handle)))
            {
    
                # TO CONVERT AS ARRAY
                # $result = json_decode($result, true);
                # $status = $result['status'];
    
                # TO CONVERT AS OBJECT
                $result = json_decode($result);
    
                # TRANSACTION INFO
                $status = $result->status;
                $tran_date = $result->tran_date;
                $tran_id = $result->tran_id;
                $val_id = $result->val_id;
                $amount = $result->amount;
                $store_amount = $result->store_amount;
                $bank_tran_id = $result->bank_tran_id;
                $card_type = $result->card_type;
    
                # EMI INFO
                $emi_instalment = $result->emi_instalment;
                $emi_amount = $result->emi_amount;
                $emi_description = $result->emi_description;
                $emi_issuer = $result->emi_issuer;
    
                # ISSUER INFO
                $card_no = $result->card_no;
                $card_issuer = $result->card_issuer;
                $card_brand = $result->card_brand;
                $card_issuer_country = $result->card_issuer_country;
                $card_issuer_country_code = $result->card_issuer_country_code;
    
                # API AUTHENTICATION
                $APIConnect = $result->APIConnect;
                $validated_on = $result->validated_on;
                $gw_version = $result->gw_version;
    
                //find order
                $preorder_id = $request->value_a;
    
                $payment = new Payment;
                $payment->paymentOption =   $request->payment_option;
                $payment->amount        =   $amount;
                $payment->store_amount  =   $store_amount;
                $payment->card_type     =   $card_type;
                $payment->tran_id       =   $tran_id;
                $payment->bank_tran_id  =   $bank_tran_id;
                $payment->card_no       =   $card_no;
                $payment->card_issuer   =   $card_issuer;
                $payment->save();
                
                $preorderPayment = new Preorderpayment;
                $preorderPayment->payment_id = $payment->id;
                $preorderPayment->preorder_id = $preorder_id;
                $preorderPayment->save();
    
            } else {
    
                echo "Failed to connect with SSLCOMMERZ";
            }
    
            if ($preorder_id != null) {
    
                $preorder = Preorder::find($preorder_id);
                $prebook = Prebook::find($preorder->prebook_id);
                
                // Send order details to sales by E-mail
                // Mail::to('dadavaai.world@gmail.com')->send(new PreOrderPlaced($preorder, $prebook));

                $title  = ' Payment complete for Pre order #'.$preorder_id;
                $query  = "Payment complete . If you have any questions, Call us (+880) 1971424220.";
                // Send the mail
                Mail::send('emails.preorderPaymentComplete', ['title' =>$title,'content'=> $query], function($message) use ($preorder) {
                    $message->from('dadavaai.world@gmail.com');
                    $message->to($preorder->client->email);

                    $message->subject('Pre order payment complete');
                });


                return redirect('client-preorder-history')->with('success', 'Payment Complete');

                return view('client.order.preOrderSuccess', compact('preorder', 'prebook', 'client'));
            } 

        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }

        
    }
    

    /** remaining payment for pre book**/

    public function remainingPayment(Request $request)
    {
        
        try {
            // Get the client
            $client_id = Session::get('CLIENT_ID');
            $client = Client::find($client_id);


            //payment
            $preOrder = Preorder::findOrFail($request->preorder_id);
            $prebook = Prebook::findOrFail($preOrder->prebook_id);

            $paid_amount = 0;
                                                       
            foreach($preOrder->preorderPayments as $preorderPayment)
            {
                $paid_amount += $preorderPayment->payment->amount;
            }

            $paid_amount += $preOrder->payment->amount;


            $haveToPay  =  $preOrder->totalAmount - $paid_amount;
            
            $remainingPayment = false;

            /* PHP */
            $post_data = array();
            $post_data['store_id'] = "jarat5e6dad879bd4c";
            $post_data['store_passwd'] = "jarat5e6dad879bd4c@ssl";
            $post_data['total_amount'] = $haveToPay;
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
            // $post_data['success_url'] = "http://localhost/new_sslcz_gw/success.php";
            $post_data['success_url'] = url('/')."/pre-order-remaining-payment-success";

            $post_data['fail_url'] = url('/')."/pre-order-failed?preorder_id=$preOrder->id&remainingPayment=$remainingPayment";
            $post_data['cancel_url'] = url('/')."/pre-order-cancle?preorder_id=$preOrder->id&remainingPayment=$remainingPayment";
            # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

            # EMI INFO
            $post_data['emi_option'] = "1";
            $post_data['emi_max_inst_option'] = "9";
            $post_data['emi_selected_inst'] = "9";

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $client->clientName;
            $post_data['cus_email'] = $client->email;
            $post_data['cus_add1'] = "Dhaka";
            $post_data['cus_add2'] = "Dhaka";
            $post_data['cus_city'] = "Dhaka";
            $post_data['cus_state'] = "Dhaka";
            $post_data['cus_postcode'] = "1000";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = $client->phone;
            $post_data['cus_fax'] = "01711111111";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "testjaratb85n";
            $post_data['ship_add1 '] = "Dhaka";
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_country'] = "Bangladesh";


            # OPTIONAL PARAMETERS
            $post_data['value_a'] = $preOrder->id;
            $post_data['value_b'] = "ref002";
            $post_data['value_c'] = '';
            $post_data['value_d'] = "ref004";

            # CART PARAMETERS
            $post_data['cart'] = json_encode(array(
                array("product"=>"DHK TO BRS AC A1","amount"=>"200.00"),
                array("product"=>"DHK TO BRS AC A2","amount"=>"200.00"),
                array("product"=>"DHK TO BRS AC A3","amount"=>"200.00"),
                array("product"=>"DHK TO BRS AC A4","amount"=>"200.00")
            ));
            $post_data['product_amount'] = "100";
            $post_data['vat'] = "5";
            $post_data['discount_amount'] = "5";
            $post_data['convenience_fee'] = "3";


            # REQUEST SEND TO SSLCOMMERZ
            $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

            $handle = \curl_init();
            curl_setopt($handle, CURLOPT_URL, $direct_api_url );
            curl_setopt($handle, CURLOPT_TIMEOUT, 30);
            curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($handle, CURLOPT_POST, 1 );
            curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


            $content = curl_exec($handle );

            $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

            if($code == 200 && !( curl_errno($handle))) {
                curl_close( $handle);
                $sslcommerzResponse = $content;
            } else {
                curl_close( $handle);
                echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
                exit;
            }

            # PARSE THE JSON RESPONSE
            $sslcz = json_decode($sslcommerzResponse, true );

            if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
                    # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                    # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
                echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
                # header("Location: ". $sslcz['GatewayPageURL']);
                exit;
            } else {
                echo "JSON Data parsing error!";
            }
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage())->withInput();
        }

    }


    
    public function preOrderDetails($id)
    {
        $preorder =Preorder::find($id);
        $prebook = 0;

        if($preorder->prebook_id){
            $prebook = Prebook::find($preorder->prebook_id);
        }
        return view('admin.preOrderInvoice', compact('preorder', 'prebook'));
    }

    public function preorderList()
    {
        $preOrders =Preorder::all();
        return view('admin.preOrderList', compact('preOrders'));
    }

    public function preoredCancle(Request $request)
    {
        
        if ($request->remainingPayment == false) {
            return redirect('client-preorder-history')->with('error', 'Payment Cancled');
        }


        $preorder_id = $request->preorder_id;
        $prebook_id = $request->prebook_id;

        if ($preorder_id) {
            $preorder = Preorder::find($preorder_id);
            $preorder->delete();
        }
        

        if ($request->prebook_id) {
            
            $prebook = Prebook::find($prebook_id );
            return redirect('prebook-form/'.$prebook->id)->with('error', 'Payment Cancled');

            return redirect()->route('ondemand-checkout',['quotation_id' => $request->quotation_id]);
        }
    }
    public function preoredFailed(Request $request)
    {
        if ($request->remainingPayment == false) {
            return redirect('client-preorder-history')->with('error', 'Payment Failed');
        }
        $preorder_id = $request->preorder_id;
        $prebook_id = $request->prebook_id;


        if ($preorder_id) {
            $preorder = Preorder::find($preorder_id);
            $preorder->delete();
        }
        

        if ($request->prebook_id) {
            
            $prebook = Prebook::find($prebook_id);
            return redirect('prebook-form/'.$prebook->id)->with('error', 'Payment Failed');

            return redirect()->route('ondemand-checkout',['quotation_id' => $request->quotation_id]);
        }
    }

    public function preorderSuccess(Request $request)
    {
        
        $preorder_id = '';
        $prebook_id = '';
        //client information
        $client = Client::find(Session::get('CLIENT_ID'));

        $val_id=urlencode($_POST['val_id']);
        $store_id=urlencode("jarat5e6dad879bd4c");
        $store_passwd=urlencode("jarat5e6dad879bd4c@ssl");
        $requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");

        $handle = \curl_init();
        curl_setopt($handle, CURLOPT_URL, $requested_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

        $result = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if($code == 200 && !( curl_errno($handle)))
        {

            # TO CONVERT AS ARRAY
            # $result = json_decode($result, true);
            # $status = $result['status'];

            # TO CONVERT AS OBJECT
            $result = json_decode($result);

            # TRANSACTION INFO
            $status = $result->status;
            $tran_date = $result->tran_date;
            $tran_id = $result->tran_id;
            $val_id = $result->val_id;
            $amount = $result->amount;
            $store_amount = $result->store_amount;
            $bank_tran_id = $result->bank_tran_id;
            $card_type = $result->card_type;

            # EMI INFO
            $emi_instalment = $result->emi_instalment;
            $emi_amount = $result->emi_amount;
            $emi_description = $result->emi_description;
            $emi_issuer = $result->emi_issuer;

            # ISSUER INFO
            $card_no = $result->card_no;
            $card_issuer = $result->card_issuer;
            $card_brand = $result->card_brand;
            $card_issuer_country = $result->card_issuer_country;
            $card_issuer_country_code = $result->card_issuer_country_code;

            # API AUTHENTICATION
            $APIConnect = $result->APIConnect;
            $validated_on = $result->validated_on;
            $gw_version = $result->gw_version;

            //find order
            $preorder_id = $request->value_a;
            $prebook_id = $request->value_c;

            $payment = new Payment;
            $payment->paymentOption =   $request->payment_option;
            $payment->amount        =   $amount;
            $payment->store_amount  =   $store_amount;
            $payment->card_type     =   $card_type;
            $payment->tran_id       =   $tran_id;
            $payment->bank_tran_id  =   $bank_tran_id;
            $payment->card_no       =   $card_no;
            $payment->card_issuer   =   $card_issuer;
            $payment->save();
            
            $preorder = Preorder::find($preorder_id);
            $preorder->payment_id = $payment->id;
            $preorder->save();

            // echo "value_a".$order_id;

        } else {

            echo "Failed to connect with SSLCOMMERZ";
        }

        if ($prebook_id != null) {

            $prebook = Prebook::find($prebook_id);

            // Send order details to client by E-mail
            Mail::to($client->email)->send(new PreOrderPlaced($preorder, $prebook));
            // Send order details to sales by E-mail
            Mail::to('dadavaai.world@gmail.com')->send(new PreOrderPlaced($preorder, $prebook));
            return view('client.order.preOrderSuccess', compact('preorder', 'prebook', 'client'));
        } 
        
    }
    

    
    /**
     * Store Ondemand Order resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function preOrderStore(Request $request)
    {
        
        // Get the client
        $client_id = Session::get('CLIENT_ID');
        $client = Client::find($client_id);

        //partial payment
        // $partial_payment = $request->partial_payment;

        // Check if agreed to terms condition
        if(!isset($request->terms)){
            return redirect()->back()->with('error', 'Please agree with the terms and conditions to continue.');
        }

        // Check if billing is different
        if(!isset($request->change_billing_address)){
            // Check if client's billing is specified
            if (!$client->billing){
                return redirect()->back()->with('error', 'Your profile\'s billing address is not specified. Please check the box "Change" and fill up the form with your billing details.');
            }
            // Check if shipping is different
            if(!isset($request->change_shipping_address)){
                // Check if client's shipping is specified
                if (!$client->shipping){
                    return redirect()->back()->with('error', 'Your profile\'s shipping address is not specified. Please check the box "Change" and fill up the form with your shipping details.');
                }

            }else{

                // Validate form data
                $rules = array(
                    'shipEmail' => 'required',
                    'shipPhone' => 'required',
                    'shipZipCode' => 'required',
                    'shipCountry' => 'required',
                    'shipDivision' => 'required',
                    'shipTown' => 'required',
                    'shipAddress' => 'required',
                );

                $validator = Validator::make ( Input::all(), $rules);
                if ($validator->fails()){
                    return redirect()->back()->with('error', 'Please give the full Shipping Address.');
                }

                $shippingAddress = Shippingaddress::where('client_id', $client_id)->first();

                if ($shippingAddress) {

                    $shippingAddress->name     =   $request->shipName;
                    $shippingAddress->address  =   $request->shipAddress;
                    $shippingAddress->town     =   $request->shipTown;
                    $shippingAddress->country  =   $request->shipCountry;
                    $shippingAddress->division =   $request->shipDivision;
                    $shippingAddress->zipCode  =   $request->shipZipCode;
                    $shippingAddress->phone    =   $request->shipPhone;
                    $shippingAddress->email    =   $request->shipEmail;
                    $shippingAddress->client_id =  $client_id;
                    $shippingAddress->save();

                } else {
                    // Create instance of Shipping model & assign form value then save to database
                    $shippingAddress = new Shippingaddress;
                    $shippingAddress->name     =   $request->shipName;
                    $shippingAddress->address  =   $request->shipAddress;
                    $shippingAddress->town     =   $request->shipTown;
                    $shippingAddress->country  =   $request->shipCountry;
                    $shippingAddress->division =   $request->shipDivision;
                    $shippingAddress->zipCode  =   $request->shipZipCode;
                    $shippingAddress->phone    =   $request->shipPhone;
                    $shippingAddress->email    =   $request->shipEmail;
                    $shippingAddress->client_id =  $client_id;
                    $shippingAddress->save();
                }
            }
        }else{
            
            // Validate form data
            $rules = array(
                'billEmail' => 'required',
                'billPhone' => 'required',
                'billZipCode' => 'required',
                'billCountry' => 'required',
                'billDivision' => 'required',
                'billTown' => 'required',
                'billAddress' => 'required',
            );

            $validator = Validator::make ( Input::all(), $rules);
            if ($validator->fails()){
                return redirect()->back()->with('error', 'Please give the full Billing Address.');
            }

            $billingAddress = Billingaddress::where('client_id', $client_id)->first();

            if ($billingAddress) {
                $billingAddress->name     =   $request->billName;
                $billingAddress->address  =   $request->billAddress;
                $billingAddress->town     =   $request->billTown;
                $billingAddress->country  =   $request->billCountry;
                $billingAddress->division =   $request->billDivision;
                $billingAddress->zipCode  =   $request->billZipCode;
                $billingAddress->phone    =   $request->billPhone;
                $billingAddress->email    =   $request->billEmail;
                $billingAddress->client_id =  $client_id;
                $billingAddress->save();
            } else {
                // Create instance of Billing model & assign form value then save to database
                $billingAddress = new Billingaddress;
                $billingAddress->name     =   $request->billName;
                $billingAddress->address  =   $request->billAddress;
                $billingAddress->town     =   $request->billTown;
                $billingAddress->country  =   $request->billCountry;
                $billingAddress->division =   $request->billDivision;
                $billingAddress->zipCode  =   $request->billZipCode;
                $billingAddress->phone    =   $request->billPhone;
                $billingAddress->email    =   $request->billEmail;
                $billingAddress->client_id =  $client_id;
                $billingAddress->save();
            }
            
            // Check if shipping is different
            if(!isset($request->change_shipping_address)){
                // Check if client's shipping is specified
                if (!$client->shipping){
                    return redirect()->back()->with('error', 'Your profile\'s shipping address is not specified. Please check the box "Change" and fill up the form with your shipping details.');
                }
            }else{

                // Validate form data
                $rules = array(
                    'shipEmail' => 'required',
                    'shipPhone' => 'required',
                    'shipZipCode' => 'required',
                    'shipCountry' => 'required',
                    'shipDivision' => 'required',
                    'shipTown' => 'required',
                    'shipAddress' => 'required',
                );

                $validator = Validator::make ( Input::all(), $rules);
                if ($validator->fails()){
                    return redirect()->back()->with('error', 'Please give the full Shipping Address.');
                }

                // Validate form data
                $rules = array(
                    'shipEmail' => 'required',
                    'shipPhone' => 'required',
                    'shipZipCode' => 'required',
                    'shipCountry' => 'required',
                    'shipDivision' => 'required',
                    'shipTown' => 'required',
                    'shipAddress' => 'required',
                );

                $validator = Validator::make ( Input::all(), $rules);
                if ($validator->fails()){
                    return redirect()->back()->with('error', 'Please give the full Shipping Address.');
                }

                $shippingAddress = Shippingaddress::where('client_id', $client_id)->first();

                if ($shippingAddress) {

                    $shippingAddress->name     =   $request->shipName;
                    $shippingAddress->address  =   $request->shipAddress;
                    $shippingAddress->town     =   $request->shipTown;
                    $shippingAddress->country  =   $request->shipCountry;
                    $shippingAddress->division =   $request->shipDivision;
                    $shippingAddress->zipCode  =   $request->shipZipCode;
                    $shippingAddress->phone    =   $request->shipPhone;
                    $shippingAddress->email    =   $request->shipEmail;
                    $shippingAddress->client_id =  $client_id;
                    $shippingAddress->save();

                } else {
                    // Create instance of Shipping model & assign form value then save to database
                    $shippingAddress = new Shippingaddress;
                    $shippingAddress->name     =   $request->shipName;
                    $shippingAddress->address  =   $request->shipAddress;
                    $shippingAddress->town     =   $request->shipTown;
                    $shippingAddress->country  =   $request->shipCountry;
                    $shippingAddress->division =   $request->shipDivision;
                    $shippingAddress->zipCode  =   $request->shipZipCode;
                    $shippingAddress->phone    =   $request->shipPhone;
                    $shippingAddress->email    =   $request->shipEmail;
                    $shippingAddress->client_id =  $client_id;
                    $shippingAddress->save();
                }
            }
        }

        $currentTime = \Carbon\Carbon::now()->format('d-m-Y');
        $price = 0;
        $shipping = 100;
        $vatTax = 7.5;
        // $client = '';
        // if (Session::get('CLIENT_ID')) {
        //     $client_id = Session::get('CLIENT_ID');
        //     $client = \App\Client::where('id', $client_id)->first();
        // }

        $prebook = Prebook::find($request->prebook_id);

        $product = $prebook->product;
        $salePrice = $product->regularPrice;

        if ($product->discount){
            if ($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                $proPrice = $salePrice-(($salePrice*($product->deal->discount_value + $product->discount))/100);
            
            else
                $proPrice = $salePrice-(($salePrice*$product->discount)/100);
        }
        else{
            if ($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                $proPrice = $salePrice-(($salePrice*$product->deal->discount_value)/100);
            else
                $proPrice = $product->regularPrice;
        }

        //payment

        $unitPrice  =  $proPrice;
        $price      += $unitPrice;
        $discount   =  $prebook->prebook_discount;
        $orderTotal =  $price - $discount +($price * ($vatTax/100)) + $shipping;
        $haveToPay  =  $orderTotal *($prebook->amount_to_pay/100);


        $preOrder = new Preorder;

        if ($client) {

            // $preOrder->payment_id = $payment->id;
            $preOrder->prebook_id = $request->prebook_id;
            $preOrder->client_id  = $client_id;
            $preOrder->totalAmount  = $orderTotal;
            $preOrder->save();

        } else {
            return redirect('client-login-register')->with('error', 'If you are not a registered user please do registration or login');
        }



        /* PHP */
        $post_data = array();
        $post_data['store_id'] = "jarat5e6dad879bd4c";
        $post_data['store_passwd'] = "jarat5e6dad879bd4c@ssl";
        $post_data['total_amount'] = $haveToPay;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
        // $post_data['success_url'] = "http://localhost/new_sslcz_gw/success.php";
        $post_data['success_url'] = url('/')."/pre-order-success";

        $post_data['fail_url'] = url('/')."/pre-order-failed?preorder_id=$preOrder->id&prebook_id=$prebook->id";
        $post_data['cancel_url'] = url('/')."/pre-order-cancle?preorder_id=$preOrder->id&prebook_id=$prebook->id";
        # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

        # EMI INFO
        $post_data['emi_option'] = "1";
        $post_data['emi_max_inst_option'] = "9";
        $post_data['emi_selected_inst'] = "9";

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $client->clientName;
        $post_data['cus_email'] = $client->email;
        $post_data['cus_add1'] = "Dhaka";
        $post_data['cus_add2'] = "Dhaka";
        $post_data['cus_city'] = "Dhaka";
        $post_data['cus_state'] = "Dhaka";
        $post_data['cus_postcode'] = "1000";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $client->phone;
        $post_data['cus_fax'] = "01711111111";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "testjaratb85n";
        $post_data['ship_add1 '] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_country'] = "Bangladesh";


        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $preOrder->id;
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = $prebook->id;
        $post_data['value_d'] = "ref004";

        # CART PARAMETERS
        $post_data['cart'] = json_encode(array(
            array("product"=>"DHK TO BRS AC A1","amount"=>"200.00"),
            array("product"=>"DHK TO BRS AC A2","amount"=>"200.00"),
            array("product"=>"DHK TO BRS AC A3","amount"=>"200.00"),
            array("product"=>"DHK TO BRS AC A4","amount"=>"200.00")
        ));
        $post_data['product_amount'] = "100";
        $post_data['vat'] = "5";
        $post_data['discount_amount'] = "5";
        $post_data['convenience_fee'] = "3";


        # REQUEST SEND TO SSLCOMMERZ
        $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

        $handle = \curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url );
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1 );
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


        $content = curl_exec($handle );

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if($code == 200 && !( curl_errno($handle))) {
            curl_close( $handle);
            $sslcommerzResponse = $content;
        } else {
            curl_close( $handle);
            echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
            exit;
        }

        # PARSE THE JSON RESPONSE
        $sslcz = json_decode($sslcommerzResponse, true );

        if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
                # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
            echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
            # header("Location: ". $sslcz['GatewayPageURL']);
            exit;
        } else {
            echo "JSON Data parsing error!";
        }

    }


    public function prebookForm($id)
    {
        $prebook = Prebook::find($id);
        return view('client.prebook.prebookForm',compact('prebook'));
    }


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all offers
        $prebooks = Prebook::all()->sortByDesc('id');

        // Get all products
        $products = Product::all()->sortByDesc('id');

        return view('admin.prebook', compact('prebooks', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        // Validate form data
        $rules = array(
            'product_id' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of brand model & assign form value then save to database
            $prebook = new Prebook;
            $prebook->launching_date = $request->launching_date;
            $prebook->details = $request->details;
            $prebook->prebook_discount = $request->prebook_discount;
            $prebook->amount_to_pay = $request->amount_to_pay;
            $prebook->product_id = $request->product_id;
            $prebook->save();
            return response()->json($prebook);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prebook = Prebook::find($id);
        $relatedProducts = Product::where('minicategory_id', $prebook->product->minicategory_id)->get();

        $deal = \App\Deal::inRandomOrder()->take(1)->first();
        return view('client.prebook.prebook', compact('prebook', 'relatedProducts', 'deal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        // Validate form data
        $rules = array(
            'product_id' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of brand model & assign form value then save to database
            $prebook = Prebook::find($id);
            $prebook->launching_date = $request->launching_date;
            $prebook->details = $request->details;
            $prebook->prebook_discount = $request->prebook_discount;
            $prebook->amount_to_pay = $request->amount_to_pay;
            $prebook->product_id = $request->product_id;
            $prebook->save();
            return response()->json($prebook);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get the product & delete it
        $prebook = Prebook::find($id);

        // Delete the product
        $prebook->delete();

        return response()->json();
    }
}
