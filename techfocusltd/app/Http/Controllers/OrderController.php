<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Discount;
use App\Industry;
use App\Mail\OrderPlaced;
use App\Shipping;
use App\Technology;
use Illuminate\Support\Facades\Mail;
use Session;
use App\Order;
use App\Payment;
use App\Product;
use App\Orderdetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authenticate')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all orders
        $orders = Order::all()->sortByDesc('id');

        return view('admin.allOrders', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Checks if logged in
        if (!\Session::has('ID')){
            return redirect('/login');
        }

        // Get the order
        $order = Order::find($id);

        return view('orderDetails', ['order' => $order]);
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

        return view('admin.invoice', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // Get the order & update
        $order = Order::find($request->id);
        $order->status = $request->status;
        $order->save();

        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Get the order
        Order::find($request->id)->delete();

        return response()->json();
    }
}
