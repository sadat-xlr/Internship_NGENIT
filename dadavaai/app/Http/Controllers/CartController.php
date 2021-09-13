<?php

namespace App\Http\Controllers;

use App\Product;
use App\Service;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    
    
    //service cart

    public function serviceIndex( Request $request)
    {
        // Get cart data
        $service_carts = Session::get('service_cart');

        if ($request->redeem_point) {

            Session::put('redeem_point', null);

            if (!Session::has('CLIENT_ID')) {
                return redirect('/cart')->with('error', 'You Have to Sign in First to redeem points');
            }

            $client_id = \Illuminate\Support\Facades\Session::get('CLIENT_ID');
            $client = \App\Client::find($client_id);
            
            $points = \App\Clientpoint::where('client_id',$client_id)->get();

            $totalPoint = 0;
            $totalRedeem = 0;

            foreach ($points as $tPoint)
            {
                $totalPoint += $tPoint->po_point + $tPoint->shared_ref_point + $tPoint->new_friend_purchase_point + $tPoint->pro_review_ref_point;
                $totalRedeem += $tPoint->redeem;
            }

            $availablePoint = $totalPoint - $totalRedeem;

            if ($availablePoint >= $request->redeem_point) {
               Session::put('redeem_point', $request->redeem_point);
            }
            
        }
        
        return view('client.serviceCart', compact('service_carts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function serviceStore(Request $request)
    {
        // return response()->json($request);
        
        
        $warning = null;
        
        if (Session::get('cart')) {
            // Set the session again
            session()->put('cart', null);
            $warning = 'you can not add product and service at a time. product is clear from cart';
        }
        
        // Get cart data
        $service_carts = Session::get('service_cart');

        // Check if cart is empty
        if ($service_carts != NULL){
            foreach($service_carts as $subKey => $subArray){
                if($subArray['service_id'] == $request->id){
                    // Return error message
                    return response()->json(array('error' => 'This service already exists in your cart!'));
                }
            }
        }

        // Set data to session
        $data = array('qty' => $request->qty,'hour' => $request->hour, 'service_id' => $request->id);
        Session::push('service_cart', $data);

        // Get the service
        $service = Service::find($request->id);

        // Return success message
        
        if ($warning) {
            return response()->json(['service'=> $service, 'warning'=>$warning]);
        }else
            return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function serviceUpdate(Request $request)
    {
        // Find the Cart & update it
        $service_carts = Session::get('service_cart', []);

        // Loop over each cart data
        foreach ($service_carts as &$service_cart) {
            // If found the intended
            if ($service_cart['service_id'] == $request->id) {
                // Update it's value

                if ($request->qty) {
                    $service_cart['qty'] = $request->qty;
                }
                

                if ($request->hour) {
                    $service_cart['hour'] = $request->hour;
                }


            }
        }

        // Update cart data
        Session::put('service_cart',$service_carts);

        // return response
        return response()->json(Session::get('service_cart'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function serviceDestroy(Request $request)
    {        
        // Find the cart
        $service_carts = session()->pull('service_cart'); // Second argument is a default value

        if(($key = array_search($request->id, array_column($service_carts, 'service_id'))) !== false) {
            // Delete it from the session
            unset($service_carts[$key]);
        }

        // Reset the array index
        $service_carts = array_values($service_carts);

        // Set the session again
        session()->put('service_cart', $service_carts);

        return response()->json();
    }
    
    //product cart    

    public function index( Request $request)
    {
        // Get cart data
        $carts = Session::get('cart');

        //redeem point
        if ($request->redeem_point) {

            Session::put('redeem_point', null);

            if (!Session::has('CLIENT_ID')) {
                return redirect('/cart')->with('error', 'You Have to Sign in First to redeem points');
            }

            $client_id = \Illuminate\Support\Facades\Session::get('CLIENT_ID');
            $client = \App\Client::find($client_id);
            
            $point = \App\Clientpoint::where('client_id',$client_id)->first();

            $totalPoint = 0;
            $totalRedeem = 0;

            $totalPoint = $point->po_point + $point->shared_ref_point + $point->new_friend_purchase_point + $point->pro_review_ref_point;
            $totalRedeem = $point->redeem;
            

            $availablePoint = $totalPoint - $totalRedeem;

            if ($availablePoint >= $request->redeem_point) {
               Session::put('redeem_point', $request->redeem_point);
            }else {

                return redirect('/cart')->with('error', ' Not enough point available ');

            }
            
        }

        //new friend purchase point
        if ($request->reference_mail) {

            Session::put('reference_mail', null);

            if (!Session::has('CLIENT_ID')) {
                return redirect('/cart')->with('error', 'You Have to Sign in First to use reference');
            }

            $client_id = \Illuminate\Support\Facades\Session::get('CLIENT_ID');
            $client = \App\Client::find($client_id);
            
            if (count($client->order)<1) {

                $referred_client = \App\Client::select('email')->where('email', $request->reference_mail)->first();

                if ($referred_client) {

                    Session::put('reference_mail', $request->reference_mail);

                } else {

                    return redirect('/cart')->with('error', ' No user find with this email ');

                }          
                
            }
            else
            {
                return redirect('/cart')->with('error', 'You only use this on your first order');
            }
            
        }
        
        return view('client.cart', compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $warning = null;
        
        if (Session::get('service_cart')) {
            // Set the session again
            session()->put('service_cart', null);
            $warning = 'you can not add product and service at a time. Service is clear from cart';
        }
        
        
        // Get cart data
        $carts = Session::get('cart');

        // Check if cart is empty
        if ($carts != NULL){
            foreach($carts as $subKey => $subArray){
                if($subArray['product_id'] == $request->id){
                    // Return error message
                    return response()->json(array('error' => 'This product already exists in your cart!'));
                }
            }
        }

        // Set data to session
        $data = array('qty' => $request->qty, 'product_id' => $request->id);
        Session::push('cart', $data);

        // Get the product
        $product = Product::with('image')->with('deal')->find($request->id);

        // Return success message
        if ($warning) {
            return response()->json(['product'=> $product, 'warning'=>$warning]);
        }else
            return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Find the Cart & update it
        $carts = Session::get('cart', []);

        // Loop over each cart data
        foreach ($carts as &$cart) {
            // If found the intended
            if ($cart['product_id'] == $request->id) {
                // Update it's value
                $cart['qty'] = $request->qty;
            }
        }

        // Update cart data
        Session::put('cart',$carts);

        // return response
        return response()->json(Session::get('cart'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {        
        // Find the cart
        $carts = session()->pull('cart'); // Second argument is a default value

        if(($key = array_search($request->id, array_column($carts, 'product_id'))) !== false) {
            // Delete it from the session
            unset($carts[$key]);
        }

        // Reset the array index
        $carts = array_values($carts);

        // Set the session again
        session()->put('cart', $carts);

        return response()->json();
    }
}
