<?php

namespace App\Http\Controllers;

use App\Serviceorder;
use App\Mail\ServiceOrderPlaced;
use App\Service;
use App\Trackingdate;
use App\Clientpoint;
use App\Vendorpayment;
use App\Vendordelivery;
use App\Vendorproduct;
use App\Vendorproductorder;
use App\Quotation;
use App\Ondemand;
use App\Ondemandorder;
use App\Order;
use App\Client;
use App\Billing;
use App\Shipping;
use App\Payment;
use App\Orderdetail;
use App\Clientpayment;
use App\Product;
use App\Mail\OrderPlaced;
use App\Mail\OrderReceived;
use App\Mail\OndemandOrderPlaced;
use App\Mail\Deliverynotification;
use Illuminate\Http\Request;
use Session;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;



class OrderController extends Controller
{
        /**
     * checkout page for ondemand/rfq
     *
     * @return \Illuminate\Http\Response
     */
    public function serviceCheckout(Request $request)
    {
        // Get cart data
        $service_carts = Session::get('service_cart');

        // If cart is empty then return back with error message
        if ($service_carts == null){
            return redirect()->back()->with('error', 'your cart is empty! Please add product to cart to purchase them.');
        }

        // Find client
        $client_id = Session::get('CLIENT_ID');
        $client = Client::find($client_id);

        return view('client.serviceCheckout', compact('client'));
    }

    /**
     * Store Ondemand Order resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function serviceOrderStore(Request $request)
    {
        $price = 0;
        $shipping_charge = 0;
        $vatTax = 0;
        $currentTime = \Carbon\Carbon::now()->format('d-m-Y');

        // Get the client
        $client = Client::find(Session::get('CLIENT_ID'));
        // Get cart data
        $service_carts = Session::get('service_cart');
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

            // Create instance of Billing model & assign form value then save to database
            $billing = new Billing();
            $billing->name      = $client->billing->name;
            $billing->address   = $client->billing->address;
            $billing->town      = $client->billing->town;
            $billing->country   = $client->billing->country;
            $billing->division  = $client->billing->division;
            $billing->zipCode   = $client->billing->zipCode;
            $billing->phone     = $client->billing->phone;
            $billing->email     = $client->billing->email;

            // Check if shipping is different
            if(!isset($request->change_shipping_address)){
                // Check if client's shipping is specified
                if (!$client->shipping){
                    return redirect()->back()->with('error', 'Your profile\'s shipping address is not specified. Please check the box "Change" and fill up the form with your shipping details.');
                }

                // Create instance of Shipping model & assign form value then save to database
                $shipping = new Shipping();
                $shipping->name     =   $client->shipping->name;
                $shipping->address  =   $client->shipping->address;
                $shipping->town     =   $client->shipping->town;
                $shipping->country  =   $client->shipping->country;
                $shipping->division =   $client->shipping->division;
                $shipping->zipCode  =   $client->shipping->zipCode;
                $shipping->phone    =   $client->shipping->phone;
                $shipping->email    =   $client->shipping->email;

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
                

                // Create instance of Shipping model & assign form value then save to database
                $shipping = new Shipping();
                $shipping->name     =   $request->shipName;
                $shipping->address  =   $request->shipAddress;
                $shipping->town     =   $request->shipTown;
                $shipping->country  =   $request->shipCountry;
                $shipping->division =   $request->shipDivision;
                $shipping->zipCode  =   $request->shipZipCode;
                $shipping->phone    =   $request->shipPhone;
                $shipping->email    =   $request->shipEmail;
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

            // Create instance of Billing model & assign form value then save to database
            $billing = new Billing();
            $billing->name     =   $request->billName;
            $billing->address  =   $request->billAddress;
            $billing->town     =   $request->billTown;
            $billing->country  =   $request->billCountry;
            $billing->division =   $request->billDivision;
            $billing->zipCode  =   $request->billZipCode;
            $billing->phone    =   $request->billPhone;
            $billing->email    =   $request->billEmail;


            // Check if shipping is different
            if(!isset($request->change_shipping_address)){
                // Check if client's shipping is specified
                if (!$client->shipping){
                    return redirect()->back()->with('error', 'Your profile\'s shipping address is not specified. Please check the box "Change" and fill up the form with your shipping details.');
                }

                // Create instance of Shipping model & assign form value then save to database
                $shipping = new Shipping();
                $shipping->name     =   $client->shipping->name;
                $shipping->address  =   $client->shipping->address;
                $shipping->town     =   $client->shipping->town;
                $shipping->country  =   $client->shipping->country;
                $shipping->division =   $client->shipping->division;
                $shipping->zipCode  =   $client->shipping->zipCode;
                $shipping->phone    =   $client->shipping->phone;
                $shipping->email    =   $client->shipping->email;
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

                // Create instance of Shipping model & assign form value then save to database
                $shipping = new Shipping();
                $shipping->name     =   $request->shipName;
                $shipping->address  =   $request->shipAddress;
                $shipping->town     =   $request->shipTown;
                $shipping->country  =   $request->shipCountry;
                $shipping->division =   $request->shipDivision;
                $shipping->zipCode  =   $request->shipZipCode;
                $shipping->phone    =   $request->shipPhone;
                $shipping->email    =   $request->shipEmail;
            }
        }

        // Create instance of Order model & assign form value then save to database
        $order = new Order;
        $order->client_id = Session::get('CLIENT_ID');
        $order->save();

        // Loop over each cart item
        foreach($service_carts as $service_cart){
            // Create instance of OrderDetails model & assign form value then save to database
            $serviceOrder = new Serviceorder;
            $serviceOrder->quantity = $service_cart['qty'];
            $serviceOrder->hour = $service_cart['hour'];
            $serviceOrder->service_id = $service_cart['service_id'];
            $serviceOrder->order_id = $order->id;

            $serviceOrder->save();

            $service = Service::find($service_cart['service_id']);
            $salePrice = $service->regularPrice;

            if ($service->discount){
                $proPrice = $salePrice-(($salePrice*$service->discount)/100);
            }
            else{
                $proPrice = $service->regularPrice;
            }

            $unitPrice = $service_cart['qty'] * $service_cart['hour'] * $proPrice;
            $price += $unitPrice;

        }


        // Save billing and shipping details
        // Save shipping details
        if (isset($shipping)){
            $shipping->order_id = $order->id;
            $shipping->save();
        }

        // Save billing details
        if (isset($billing)){
            $billing->order_id = $order->id;
            $billing->save();
        }

        //payment

        $orderTotal = $price + $shipping_charge + $vatTax;

        if ($request->payment_method == 1) {

            // 'cash on delivery'
            $redeem_point = Session::get('redeem_point');

            $payment = new Payment;
            $payment->paymentOption =   $request->payment_method;
            $payment->amount        =   0;
            $payment->store_amount  =   0;
            $payment->save();

            $order->payment_id = $payment->id;
            $order->totalAmount = $orderTotal;
            $order->save();

            if ($redeem_point) {

                $clientRedeemPoint = Clientpoint::where('client_id', $client->id)->first();
                if ($clientRedeemPoint) {

                    $clientRedeemPoint->redeem =  $clientRedeemPoint->redeem + $redeem_point;
                    $clientRedeemPoint->save();
                } else {

                    $clientRedeemPoint = new Clientpoint;
                    $clientRedeemPoint->redeem = $redeem_point;
                    $clientRedeemPoint->client_id = $client->id;
                    $clientRedeemPoint->save();
                } 

                Session::put('redeem_point', null);
            }

            // Unset carts & coupon
            Session::put('service_cart', null);

            // foreach ($order->serviceOrder as $serviceOrder) {
            //     $vendorProduct = Vendorproduct::where('product_id', $orderDetail->product_id)->first();
            //     if ($vendorProduct) {
            //         $vendorProductOrder = new Vendorproductorder;
            //         $vendorProductOrder->product_id = $vendorProduct->product_id;
            //         $vendorProductOrder->qty = $orderDetail->quantity;
            //         $vendorProductOrder->order_id = $order->id;
            //         $vendorProductOrder->vendor_id = $vendorProduct->vendor_id;

                    
            //         $product = Product::find($orderDetail->product_id);
            //         $salePrice = $product->regularPrice;

            //         if ($product->discount){
            //             $proPrice = $salePrice-(($salePrice*$product->discount)/100);
            //         }
            //         else{
            //             $proPrice = $product->regularPrice;
            //         }

                    

            //         $unitPrice = $orderDetail->quantity * $proPrice;
            //         $commission = ($unitPrice* $vendorProduct->vendor->commission)/100;
            //         $vendorProductOrder->totalPrice = $unitPrice-$commission;


                    
            //         $vendorProductOrder->save();

            //         $vendorPayment = Vendorpayment::where('order_id', $order->id)
            //                                     ->where('vendor_id', $vendorProduct->vendor_id)
            //                                     ->first();
            //         $vendorDelivery = Vendordelivery::where('order_id', $order->id)
            //                                     ->where('vendor_id', $vendorProduct->vendor_id)
            //                                     ->first();

            //         if($vendorDelivery == null) {
            //             $vendorDelivery            = new Vendordelivery;
            //             $vendorDelivery->order_id  = $order->id;
            //             $vendorDelivery->vendor_id = $vendorProduct->vendor_id;
            //             $vendorDelivery->save();
            //         }

            //         if($vendorPayment == null) {
            //             $vendorPayment            = new Vendorpayment;
            //             $vendorPayment->order_id  = $order->id;
            //             $vendorPayment->vendor_id = $vendorProduct->vendor_id;
            //             $vendorPayment->save();
            //         }
            //     }
            // }

            // Send order details to client by E-mail
            Mail::to($client->email)->send(new ServiceOrderPlaced($order));
            // Send order details to sales by E-mail
            Mail::to('dadavaai.world@gmail.com')->send(new ServiceOrderPlaced($order));

            return view('client.order.serviceOrderSuccess', compact('order','redeem_point'));


        }
    }


    public function cancle(Request $request)
    {
        
        $order_id = $request->order_id;

        if ($order_id) {
            $order = Order::find($order_id);
            $order->delete();
        }


        if ($request->quotation_id) {
            return redirect()->route('ondemand-checkout',['quotation_id' => $request->quotation_id]);
        } else {
            return redirect('checkout')->with('success', $request->value_d);
        }
        

        return redirect('checkout');
    }

    public function failed(Request $request)
    {
        
        $order_id = $request->order_id;

        if ($order_id) {
            $order = Order::find($order_id);
            $order->delete();
        }
        

        if ($request->quotation_id) {
            return redirect()->route('ondemand-checkout',['quotation_id' => $request->quotation_id]);
        } else {
            return redirect('checkout');
        }
    }

    public function success(Request $request)
    {
        
        $order_id = '';
        $quotation_id = '';
        //client information
        $client = Client::find(Session::get('CLIENT_ID'));
        $redeem_point = Session::get('redeem_point');
        $reference_mail = Session::get('reference_mail');

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
            $order_id = $request->value_a;         
            $quotation_id = $request->value_c;

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

            $order = Order::find($order_id);
            $order->payment_id = $payment->id;
            // $order->totalAmount = $amount;
            $order->save();

            $trackDate = New Trackingdate;
            $trackDate->step_1 = $order->created_at;
            $trackDate->step_5 = $order->updated_at->addDays(7);
            $trackDate->order_id = $order->id;
            $trackDate->save();

            
            //purchase  point
            if ($amount >= 1000) {
                $point = ($amount/1000)*2;
                $clientPoint = Clientpoint::where('client_id', $client->id)->first();
                if ($clientPoint) {
                    $clientPoint->po_point += $point;
                    $clientPoint->save();
                } else {
                    $clientPoint = new Clientpoint;
                    $clientPoint->po_point = $point;
                    $clientPoint->client_id = $client->id;
                    $clientPoint->save();
                }                
            }
            //redeem point
            if ($redeem_point) {

                $clientRedeemPoint = Clientpoint::where('client_id', $client->id)->first();
                if ($clientRedeemPoint) {

                    $clientRedeemPoint->redeem += $redeem_point;
                    $clientRedeemPoint->save();
                } else {

                    $clientRedeemPoint = new Clientpoint;
                    $clientRedeemPoint->redeem = $redeem_point;
                    $clientRedeemPoint->client_id = $client->id;
                    $clientRedeemPoint->save();
                }  
                Session::put('redeem_point', null);
            }

            //new friend purchase point
            if ($reference_mail) {

                $clientReferencePoint = Clientpoint::where('client_id', $client->id)->first();

                if ($clientReferencePoint) {

                    $clientReferencePoint->new_friend_purchase_point += 1;
                    $clientReferencePoint->save();
                } else {

                    $clientReferencePoint = new Clientpoint;
                    $clientReferencePoint->new_friend_purchase_point = 1;
                    $clientReferencePoint->client_id = $client->id;
                    $clientReferencePoint->save();
                }  
                Session::put('reference_mail', null);
            }
            


            // echo "value_a".$order_id;

        } else {

            echo "Failed to connect with SSLCOMMERZ";
        }

        if ($quotation_id != null) {

            $quotation = Quotation::find($quotation_id);
            $quotation->confirmation = true;
            $quotation->save();

            $ondemand = Ondemand::find($quotation->ondemand_id);
            $ondemand->status = false;
            $ondemand->save();

            // Send order details to client by E-mail
            Mail::to($client->email)->send(new OndemandOrderPlaced($order, $quotation));
            // Send order details to sales by E-mail
            Mail::to('dadavaai.world@gmail.com')->send(new OndemandOrderPlaced($order, $quotation));
            return view('client.order.ondemandOrderSuccess', compact('order', 'quotation'));

        } else {
            // Unset carts & coupon
            Session::put('cart', null);

            foreach ($order->orderDetails as $orderDetail) {
                $vendorProduct = Vendorproduct::where('product_id', $orderDetail->product_id)->first();
                if ($vendorProduct) {
                    $vendorProductOrder = new Vendorproductorder;
                    $vendorProductOrder->product_id = $vendorProduct->product_id;
                    $vendorProductOrder->qty = $orderDetail->quantity;
                    $vendorProductOrder->order_id = $order->id;
                    $vendorProductOrder->vendor_id = $vendorProduct->vendor_id;

                    // how much vendor got 
                    $product = Product::find($orderDetail->product_id);
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

                    if ($product->bundleOffers) {
                        foreach ($product->bundleOffers as  $bundleOffer) {
                            if ($orderDetail->quantity >= $bundleOffer->qty_start) {
                                $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                            }
                        }
                    }

                    $unitPrice = $orderDetail->quantity * $proPrice;
                    $commission = ($unitPrice* $vendorProduct->vendor->commission)/100;
                    $vendorProductOrder->totalPrice = $unitPrice-$commission;


                    // save the order
                    $vendorProductOrder->save();

                    $vendorPayment = Vendorpayment::where('order_id', $order->id)
                                                ->where('vendor_id', $vendorProduct->vendor_id)
                                                ->first();
                    $vendorDelivery = Vendordelivery::where('order_id', $order->id)
                                                ->where('vendor_id', $vendorProduct->vendor_id)
                                                ->first();

                    if($vendorDelivery == null) {
                        $vendorDelivery            = new Vendordelivery;
                        $vendorDelivery->order_id  = $order->id;
                        $vendorDelivery->vendor_id = $vendorProduct->vendor_id;
                        $vendorDelivery->save();
                    }

                    if($vendorPayment == null) {
                        $vendorPayment            = new Vendorpayment;
                        $vendorPayment->order_id  = $order->id;
                        $vendorPayment->vendor_id = $vendorProduct->vendor_id;
                        $vendorPayment->save();
                    }
                }
            }

            // Send order details to client by E-mail
            Mail::to($client->email)->send(new OrderPlaced($order));
            // Send order details to sales by E-mail
            Mail::to('dadavaai.world@gmail.com')->send(new OrderReceived($order));

            return view('client.order.orderSuccess', compact('order','redeem_point'));
        }
        
    }
    
    
    public function orderStatus( Request $request)
    {
        $orderId    = $request->order_id;
        $email      = $request->email;
        
        if ($orderId && $email) {

            $order = Order::find($orderId);
            if ($order) {
                # find clien email id
                $clientEmail = $order->client->email;
                    #check email id
                if ($clientEmail == $email ) {
    
                    return view('client.orderStatus', compact('order'));
    
                }else{
                    return redirect()->back()->with('error', 'Email id not matched');
                }

            } else {
                # return not found message
                return redirect()->back()->with('error', 'Order not found');
            }
           
        }


    }

    
    // track order form view
    public function orderTrack()
    {
        return view('client.orderTrack');
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all orders
        $orders = Order::orderBy('created_at', 'DESC')->get();
        return view('admin.orders', compact('orders'));
    }

    /**
     * checkout page for ondemand/rfq
     */
    public function ondemandCheckout(Request $request)
    {
        
        // Get ondemand data
        // $ondemand = Ondemand::find($ondemand_id);
        $quotation = Quotation::find($request->quotation_id);

        // If ondemand is empty then return back with error message
        if ($quotation == null){
            return redirect()->back()->with('error', 'Your request is not valid');
        }

        $price = $quotation->price + ($quotation->price*(20/100));

        if ($price < 100){
            return redirect()->back()->with('error', 'The minimum amount to checkout is 100 TK. ! Your cart doesn\'t satisfy minimum amount.');
        }

        // Find client
        $client_id = Session::get('CLIENT_ID');
        $client = Client::find($client_id);
        

        return view('client.ondemandCheckout', compact('client', 'quotation'));
    }

    /**
     * Store Ondemand Order resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ondemandOrderStore(Request $request)
    {
        
        $quotation_id = $request->quotation_id;

        // Get cart data
        $quotation = Quotation::find($quotation_id);


        $price = $quotation->price + ($quotation->price*(20/100));

        $shipping_charge = 100;
        $vatTax = 7.5;
        $currentTime = \Carbon\Carbon::now()->format('d-m-Y');



        // Get the client
        $client = Client::find(Session::get('CLIENT_ID'));

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

            // Create instance of Billing model & assign form value then save to database
            $billing = new Billing();
            $billing->name      = $client->billing->name;
            $billing->address   = $client->billing->address;
            $billing->town      = $client->billing->town;
            $billing->country   = $client->billing->country;
            $billing->division  = $client->billing->division;
            $billing->zipCode   = $client->billing->zipCode;
            $billing->phone     = $client->billing->phone;
            $billing->email     = $client->billing->email;

            // Check if shipping is different
            if(!isset($request->change_shipping_address)){
                // Check if client's shipping is specified
                if (!$client->shipping){
                    return redirect()->back()->with('error', 'Your profile\'s shipping address is not specified. Please check the box "Change" and fill up the form with your shipping details.');
                }

                // Create instance of Shipping model & assign form value then save to database
                $shipping = new Shipping();
                $shipping->name     =   $client->shipping->name;
                $shipping->address  =   $client->shipping->address;
                $shipping->town     =   $client->shipping->town;
                $shipping->country  =   $client->shipping->country;
                $shipping->division =   $client->shipping->division;
                $shipping->zipCode  =   $client->shipping->zipCode;
                $shipping->phone    =   $client->shipping->phone;
                $shipping->email    =   $client->shipping->email;

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
                

                // Create instance of Shipping model & assign form value then save to database
                $shipping = new Shipping();
                $shipping->name     =   $request->shipName;
                $shipping->address  =   $request->shipAddress;
                $shipping->town     =   $request->shipTown;
                $shipping->country  =   $request->shipCountry;
                $shipping->division =   $request->shipDivision;
                $shipping->zipCode  =   $request->shipZipCode;
                $shipping->phone    =   $request->shipPhone;
                $shipping->email    =   $request->shipEmail;
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

            // Create instance of Billing model & assign form value then save to database
            $billing = new Billing();
            $billing->name     =   $request->billName;
            $billing->address  =   $request->billAddress;
            $billing->town     =   $request->billTown;
            $billing->country  =   $request->billCountry;
            $billing->division =   $request->billDivision;
            $billing->zipCode  =   $request->billZipCode;
            $billing->phone    =   $request->billPhone;
            $billing->email    =   $request->billEmail;


            // Check if shipping is different
            if(!isset($request->change_shipping_address)){
                // Check if client's shipping is specified
                if (!$client->shipping){
                    return redirect()->back()->with('error', 'Your profile\'s shipping address is not specified. Please check the box "Change" and fill up the form with your shipping details.');
                }

                // Create instance of Shipping model & assign form value then save to database
                $shipping = new Shipping();
                $shipping->name     =   $client->shipping->name;
                $shipping->address  =   $client->shipping->address;
                $shipping->town     =   $client->shipping->town;
                $shipping->country  =   $client->shipping->country;
                $shipping->division =   $client->shipping->division;
                $shipping->zipCode  =   $client->shipping->zipCode;
                $shipping->phone    =   $client->shipping->phone;
                $shipping->email    =   $client->shipping->email;
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

                // Create instance of Shipping model & assign form value then save to database
                $shipping = new Shipping();
                $shipping->name     =   $request->shipName;
                $shipping->address  =   $request->shipAddress;
                $shipping->town     =   $request->shipTown;
                $shipping->country  =   $request->shipCountry;
                $shipping->division =   $request->shipDivision;
                $shipping->zipCode  =   $request->shipZipCode;
                $shipping->phone    =   $request->shipPhone;
                $shipping->email    =   $request->shipEmail;
            }
        }

        // Create instance of Order model & assign form value then save to database
        $order = new Order;
        $order->client_id = Session::get('CLIENT_ID');
        // $order->payment_id = $payment->id;
        // $order->discount_id = Session::get('coupon_id');
        $order->save();

        // Create instance of ondemandOrder model & assign form value then save to database
        $ondemandOrder = new Ondemandorder;
        $ondemandOrder->ondemand_id = $quotation->ondemand->id;
        $ondemandOrder->order_id = $order->id;
        $ondemandOrder->save();


        // Save billing and shipping details
        // Save shipping details
        if (isset($shipping)){
            $shipping->order_id = $order->id;
            $shipping->save();
        }

        // Save billing details
        if (isset($billing)){
            $billing->order_id = $order->id;
            $billing->save();
        }

        //payment


        $vatTax = $price * ($vatTax/100);
        $orderTotal = $price + $shipping_charge + $vatTax;

        /* PHP */
        $post_data = array();
        $post_data['store_id'] = "jarat5e6dad879bd4c";
        $post_data['store_passwd'] = "jarat5e6dad879bd4c@ssl";
        $post_data['total_amount'] = $orderTotal;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
        // $post_data['success_url'] = "http://localhost/new_sslcz_gw/success.php";
        $post_data['success_url'] = url('/')."/order-success";

        $post_data['fail_url'] = url('/')."/order-failed?quotation_id=$quotation->id&order_id=$order->id";
        $post_data['cancel_url'] = url('/')."/order-cancle?quotation_id=$quotation->id&order_id=$order->id";
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
        $post_data['value_a'] = $order->id;
        $post_data['value_b '] = "ref002";
        $post_data['value_c'] = $quotation->id;
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


        // Check if payment update is set
        if (isset($request->payment_update)){
            // Get client payment method
            $payment_method = Clientpayment::where('client_id', Session::get('CLIENT_ID'))->first();

            // Check if has
            if (!$payment_method){
                // If no create new instance
                $payment_method = new Clientpayment();
            }

            // Assign form value then save to database
            $payment_method->paymentMethod = $request->payment_method;

            // Check payment method
            if ($request->payment_method == 0){
                $payment_method->accNo = $request->bkash_number;
                $payment_method->bank_name = 'BRAC Bank';
            }elseif ($request->payment_method == 1){
                $payment_method->accNo = $request->rocket_number;
                $payment_method->bank_name = 'Dutch-Bangla Bank';
            }elseif ($request->payment_method == 2){
                $payment_method->acc_name = $request->bank_payment_account_name;
                $payment_method->accNo = $request->bank_payment_account_number;
                $payment_method->bank_name = $request->bank_payment_bank_name;
            }

            $payment_method->client_id = Session::get('CLIENT_ID');
            $payment_method->save();
        }

        // Unset carts & coupon
        // Session::put('cart', null);

        // Send order details to client by E-mail
        // Mail::to($client->email)->send(new OrderPlaced($order));
        // Send order details to sales by E-mail
        // Mail::to('shuvo.ngenit@gmail.com')->send(new OrderPlaced($order));

        // return view('client.order', compact('order'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        // Get cart data
        $carts = Session::get('cart');

        // If cart is empty then return back with error message
        if ($carts == null){
            return redirect()->back()->with('error', 'your cart is empty! Please add product to cart to purchase them.');
        }

        $price = 0;
        foreach($carts as $cart){
            $product = \App\Product::find($cart['product_id']);
            $salePrice = $product->salePrice;

            if(isset($salePrice) && $salePrice != 0)
                $proPrice = $salePrice;
            else
                $proPrice = $product->regularPrice;

            $unitPrice = $cart['qty'] * $proPrice;
            $price += $unitPrice;
        }

        if ($price < 100){
            return redirect()->back()->with('error', 'The minimum amount to checkout is 100 TK. ! Your cart doesn\'t satisfy minimum amount.');
        }

        // Find client
        $client_id = Session::get('CLIENT_ID');
        $client = Client::find($client_id);
        

        return view('client.checkout', compact('client'));
    }

    /**
     * This store is used for regular order .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return redirect()->back()->with('error', 'System is under development');

        $price = 0;
        $shipping_charge = 100;
        $vatTax = 7.5;
        $currentTime = \Carbon\Carbon::now()->format('d-m-Y');

        // Get cart data
        $carts = Session::get('cart');

        // Get the client
        $client = Client::find(Session::get('CLIENT_ID'));

        //partial payment
        $partial_payment = $request->partial_payment;

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

            // Create instance of Billing model & assign form value then save to database
            $billing = new Billing();
            $billing->name      = $client->billing->name;
            $billing->address   = $client->billing->address;
            $billing->town      = $client->billing->town;
            $billing->country   = $client->billing->country;
            $billing->division  = $client->billing->division;
            $billing->zipCode   = $client->billing->zipCode;
            $billing->phone     = $client->billing->phone;
            $billing->email     = $client->billing->email;

            // Check if shipping is different
            if(!isset($request->change_shipping_address)){
                // Check if client's shipping is specified
                if (!$client->shipping){
                    return redirect()->back()->with('error', 'Your profile\'s shipping address is not specified. Please check the box "Change" and fill up the form with your shipping details.');
                }

                // Create instance of Shipping model & assign form value then save to database
                $shipping = new Shipping();
                $shipping->name     =   $client->shipping->name;
                $shipping->address  =   $client->shipping->address;
                $shipping->town     =   $client->shipping->town;
                $shipping->country  =   $client->shipping->country;
                $shipping->division =   $client->shipping->division;
                $shipping->zipCode  =   $client->shipping->zipCode;
                $shipping->phone    =   $client->shipping->phone;
                $shipping->email    =   $client->shipping->email;

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
                

                // Create instance of Shipping model & assign form value then save to database
                $shipping = new Shipping();
                $shipping->name     =   $request->shipName;
                $shipping->address  =   $request->shipAddress;
                $shipping->town     =   $request->shipTown;
                $shipping->country  =   $request->shipCountry;
                $shipping->division =   $request->shipDivision;
                $shipping->zipCode  =   $request->shipZipCode;
                $shipping->phone    =   $request->shipPhone;
                $shipping->email    =   $request->shipEmail;
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

            // Create instance of Billing model & assign form value then save to database
            $billing = new Billing();
            $billing->name     =   $request->billName;
            $billing->address  =   $request->billAddress;
            $billing->town     =   $request->billTown;
            $billing->country  =   $request->billCountry;
            $billing->division =   $request->billDivision;
            $billing->zipCode  =   $request->billZipCode;
            $billing->phone    =   $request->billPhone;
            $billing->email    =   $request->billEmail;


            // Check if shipping is different
            if(!isset($request->change_shipping_address)){
                // Check if client's shipping is specified
                if (!$client->shipping){
                    return redirect()->back()->with('error', 'Your profile\'s shipping address is not specified. Please check the box "Change" and fill up the form with your shipping details.');
                }

                // Create instance of Shipping model & assign form value then save to database
                $shipping = new Shipping();
                $shipping->name     =   $client->shipping->name;
                $shipping->address  =   $client->shipping->address;
                $shipping->town     =   $client->shipping->town;
                $shipping->country  =   $client->shipping->country;
                $shipping->division =   $client->shipping->division;
                $shipping->zipCode  =   $client->shipping->zipCode;
                $shipping->phone    =   $client->shipping->phone;
                $shipping->email    =   $client->shipping->email;
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

                // Create instance of Shipping model & assign form value then save to database
                $shipping = new Shipping();
                $shipping->name     =   $request->shipName;
                $shipping->address  =   $request->shipAddress;
                $shipping->town     =   $request->shipTown;
                $shipping->country  =   $request->shipCountry;
                $shipping->division =   $request->shipDivision;
                $shipping->zipCode  =   $request->shipZipCode;
                $shipping->phone    =   $request->shipPhone;
                $shipping->email    =   $request->shipEmail;
            }
        }

        // Create instance of Order model & assign form value then save to database
        $order = new Order;
        $order->client_id = Session::get('CLIENT_ID');
        // $order->payment_id = $payment->id;
        // $order->discount_id = Session::get('coupon_id');
        $order->save();

        // Loop over each cart item
        foreach($carts as $cart){
            // Create instance of OrderDetails model & assign form value then save to database
            $orderDetails = new Orderdetail;
            $orderDetails->quantity = $cart['qty'];
            $orderDetails->product_id = $cart['product_id'];
            $orderDetails->order_id = $order->id;
            $orderDetails->save();


            $product = Product::find($cart['product_id']);
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

            if ($product->bundleOffers) {
                foreach ($product->bundleOffers as  $bundleOffer) {
                    if ($cart['qty'] >= $bundleOffer->qty_start) {
                        $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                    }
                }
            }

            $unitPrice = $cart['qty'] * $proPrice;
            $price += $unitPrice;

        }

        // Save billing and shipping details
        // Save shipping details
        if (isset($shipping)){
            $shipping->order_id = $order->id;
            $shipping->save();
        }

        // Save billing details
        if (isset($billing)){
            $billing->order_id = $order->id;
            $billing->save();
        }

        //payment


        $vatTax = $price * ($vatTax/100);

        $redeem_point = 0;
        $redeem_point = Session::get('redeem_point');

        $orderTotal = $price + $shipping_charge + $vatTax - $redeem_point;


        if ($request->payment_method == 1) {

            // 'cash on delivery'
            $redeem_point = Session::get('redeem_point');

            $payment = new Payment;
            $payment->paymentOption =   $request->payment_method;
            $payment->amount        =   0;
            $payment->store_amount  =   0;
            $payment->save();

            $order->payment_id = $payment->id;
            $order->totalAmount = $orderTotal;
            $order->save();

            $trackDate = New Trackingdate;
            $trackDate->step_1 = $order->created_at;
            $trackDate->step_5 = $order->updated_at->addDays(7);
            $trackDate->order_id = $order->id;
            $trackDate->save();

            
            // if ($orderTotal >= 1000) {
            //     $point = ($orderTotal/1000)*2;
            //     $clientPoint = Clientpoint::where('client_id', $client->id);
            //     if ($clientPoint) {
            //         dd($clientPoint->po_point);
            //         $clientPoint->po_point = $clientPoint->po_point + $point;
            //         $clientPoint->save();
            //     } else {
            //         $clientPoint = new Clientpoint;
            //         $clientPoint->po_point = $point;
            //         $clientPoint->client_id = $client->id;
            //         $clientPoint->save();
            //     }                
            // }

            if ($redeem_point) {

                $clientRedeemPoint = Clientpoint::where('client_id', $client->id);
                if ($clientRedeemPoint) {

                    $clientRedeemPoint->redeem =  $clientRedeemPoint->redeem + $redeem_point;
                    $clientRedeemPoint->save();
                } else {

                    $clientRedeemPoint = new Clientpoint;
                    $clientRedeemPoint->redeem = $redeem_point;
                    $clientRedeemPoint->client_id = $client->id;
                    $clientRedeemPoint->save();
                } 

                Session::put('redeem_point', null);
            }

            // Unset carts & coupon
            Session::put('cart', null);

            foreach ($order->orderDetails as $orderDetail) {
                $vendorProduct = Vendorproduct::where('product_id', $orderDetail->product_id)->first();
                if ($vendorProduct) {
                    $vendorProductOrder = new Vendorproductorder;
                    $vendorProductOrder->product_id = $vendorProduct->product_id;
                    $vendorProductOrder->qty = $orderDetail->quantity;
                    $vendorProductOrder->order_id = $order->id;
                    $vendorProductOrder->vendor_id = $vendorProduct->vendor_id;

                    // how much vendor got 
                    $product = Product::find($orderDetail->product_id);
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

                    if ($product->bundleOffers) {
                        foreach ($product->bundleOffers as  $bundleOffer) {
                            if ($orderDetail->quantity >= $bundleOffer->qty_start) {
                                $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                            }
                        }
                    }

                    $unitPrice = $orderDetail->quantity * $proPrice;
                    $commission = ($unitPrice* $vendorProduct->vendor->commission)/100;
                    $vendorProductOrder->totalPrice = $unitPrice-$commission;


                    // save the order
                    $vendorProductOrder->save();

                    $vendorPayment = Vendorpayment::where('order_id', $order->id)
                                                ->where('vendor_id', $vendorProduct->vendor_id)
                                                ->first();
                    $vendorDelivery = Vendordelivery::where('order_id', $order->id)
                                                ->where('vendor_id', $vendorProduct->vendor_id)
                                                ->first();

                    if($vendorDelivery == null) {
                        $vendorDelivery            = new Vendordelivery;
                        $vendorDelivery->order_id  = $order->id;
                        $vendorDelivery->vendor_id = $vendorProduct->vendor_id;
                        $vendorDelivery->save();
                    }

                    if($vendorPayment == null) {
                        $vendorPayment            = new Vendorpayment;
                        $vendorPayment->order_id  = $order->id;
                        $vendorPayment->vendor_id = $vendorProduct->vendor_id;
                        $vendorPayment->save();
                    }
                }
            }


            // Send order details to client by E-mail
            Mail::to($client->email)->send(new OrderPlaced($order));
            // Send order details to sales by E-mail
            Mail::to('dadavaai.world@gmail.com')->send(new OrderPlaced($order));

            return view('client.order.orderSuccess', compact('order','redeem_point'));


        } else {


            // SSLCOMMERZ
            /* PHP */
            $post_data = array();
            $post_data['store_id'] = "jarat5e6dad879bd4c";
            $post_data['store_passwd'] = "jarat5e6dad879bd4c@ssl";
            $post_data['total_amount'] = $orderTotal;
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
            // $post_data['success_url'] = "http://localhost/new_sslcz_gw/success.php";
            // $post_data['success_url'] = "http://127.0.0.1:8000/order-success";
            // $post_data['fail_url'] = "http://127.0.0.1:8000/order-failed?order_id=$order->id";
            // $post_data['cancel_url'] = "http://127.0.0.1:8000/order-cancle?order_id=$order->id";

            $post_data['success_url'] = url('/')."/order-success";
            $post_data['fail_url'] = url('/')."/order-failed?order_id=$order->id";
            $post_data['cancel_url'] = url('/')."/order-cancle?order_id=$order->id";
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
            $post_data['value_a'] = $order->id;
            $post_data['value_b '] = "ref002";
            $post_data['value_c'] = "";
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
        
        // Unset carts & coupon
        // Session::put('cart', null);

        // Send order details to client by E-mail
        // Mail::to($client->email)->send(new OrderPlaced($order));
        // Send order details to sales by E-mail
        // Mail::to('shuvo.ngenit@gmail.com')->send(new OrderPlaced($order));

        // return view('client.order', compact('order'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get the order & update
        $order = Order::find($id);
        

        if (count($order->orderDetails)>0){
            return view('admin.invoice', compact('order'));
        }elseif(count($order->serviceOrders)>0)
        {
            return view('admin.serviceInvoice', compact('order'));
        }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Get the order & update 
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();

        $tracking = Trackingdate::where('order_id', $order->id)->first();
        if ($order->status == 0)
        {
            $tracking->step_1 = $order->updated_at;
        }

        if ($order->status == 1 || $order->status == 2)
        {
            $tracking->step_2 = $order->updated_at;
        }

        if ($order->status == 3 || $order->status == 4 || $order->status == 5 || $order->status == 6)
        {
            $tracking->step_3 = $order->updated_at;
        }

        if ($order->status == 7)
        {
            $tracking->step_4 = $order->updated_at;
        }

        if ($order->status == 8 && $request->delivery_date == null)
        {
            $tracking->step_5 = $order->updated_at;
            Mail::to($order->client->email)->send(new Deliverynotification($order));
        }


        //for set tentative delivery date
        if ($request->delivery_date)
        {
            $tracking->step_5 = $request->delivery_date;
        }


        $tracking->save();

        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get the order
        Order::find($id)->delete();

        return response()->json();
    }
}
