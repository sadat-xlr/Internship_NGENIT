<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Brand;
use App\Category;
use App\Product;
use App\Cart;
use App\Industry;
use App\Technology;
use Session;

// Help Controller
class HelpController extends Controller
{
	// Loads faq view 
	public function faq(){
		return view('faq');
	}
	
	// Loads store-location view 
	public function storeLocation(){
		return view('store-location');
	}
	
	// Loads order-tracking view 
	public function orderTracking(){
		return view('order-tracking');
	}
	
	// Loads term-condition view 
	public function termCondition(){
		return view('term-condition');
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function showOrder(Request $request)
    {
        // Check for valid customer
        $customer = Customer::where('email', $request->billing)->first();

        if (!$customer){
            return redirect()->back()->with('error', 'There is no order associated with this email!');
        }

        // Check for valid order id
        $orders = Order::where(['id' => $request->order_id, 'customer_id' => $customer->id])->first();

        if (!$orders){
            return redirect()->back()->with('error', 'There is no order associated with this email and order id combination!');
        }

        // Get the order
        $order = Order::find($request->order_id);

        return view('orderDetails', ['order' => $order]);
    }
}
