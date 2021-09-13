<?php

namespace App\Http\Controllers;


use App\Cart;
use Session;
use Response;
use Validator;
use App\Product;
use App\Discount;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DiscountController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authenticate')->except('applyCoupon');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all discounts
        $discounts = Discount::all()->sortByDesc('id');

        // Get all categories
        $categories = Category::all();

        // Get all products
        $products = Product::select('id', 'productName')->get();

        return view('admin.allDiscounts', compact('discounts', 'categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get all categories
        $categories = Category::all();

        // Get all products
        $products = Product::select('id', 'productName')->get();

        // Return create view
        return view('admin.addCoupons', compact( 'categories', 'products'));
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
            'coupon_code' => 'required',
            'discount_value' => 'required',
            'valid_from' => 'required',
            'valid_until' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails())
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));

        // Create instance of coupon model $ assaign formdata
        $discount = new Discount();

        // Check if product include is set
        if (isset($request->product_id)) {
            // Parse to json data
            $product_id = json_encode($request->product_id);

            // Assign value to discount object
            $discount->product_id = $product_id;
        }

        // Check if product exclude is set
        else if (isset($request->exclude_product_id)) {
            // Parse to json data
            $exclude_product_id = json_encode($request->exclude_product_id);

            // Assign value to discount object
            $discount->exclude_product_id = $exclude_product_id;
        }

        // Check if category include is set
        if (isset($request->category_id)) {
            // Parse to json data
            $category_id = json_encode($request->category_id);

            // Assign value to discount object
            $discount->category_id = $category_id;
        }

        // Check if category exclude is set
        else if (isset($request->exclude_category_id)) {
            // Parse to json data
            $exclude_category_id = json_encode($request->exclude_category_id);

            // Assign value to discount object
            $discount->exclude_category_id = $exclude_category_id;
        }

        $discount->coupon_code = $request->coupon_code;
        $discount->discount_unit = $request->discount_unit;
        $discount->discount_value = $request->discount_value;
        $discount->valid_from = $request->valid_from;
        $discount->valid_until = $request->valid_until;
        $discount->minimum_order_value = $request->minimum_order_value;
        $discount->maximum_order_value = $request->maximum_order_value;
        $discount->maximum_discount_amount = $request->maximum_discount_amount;
        $discount->is_redeem_allowed = $request->is_redeem_allowed;
        $discount->is_free_shipping_active = $request->is_free_shipping_active;
        $discount->limit_per_coupon = $request->limit_per_coupon;
        $discount->limit_per_client = $request->limit_per_client;
        $discount->save();

        // Return json response data
        return redirect()->back()->with('success', 'Coupon added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        // Get the coupon
        $discount = Discount::find($discount->id);

        // Get all categories
        $categories = Category::all();

        // Get all products
        $products = Product::select('id', 'productName')->get();

        return view('admin.editDiscount', compact('discount', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        // Find the coupon model $ assaign formdata
        $discount = Discount::find($discount->id);

        // Check if product include is set
        if (isset($request->product_id)) {
            // Parse to json data
            $product_id = json_encode($request->product_id);

            // Assign value to discount object
            $discount->product_id = $product_id;
        }

        // Check if product exclude is set
        if (isset($request->exclude_product_id)) {
            // Parse to json data
            $exclude_product_id = json_encode($request->exclude_product_id);

            // Assign value to discount object
            $discount->exclude_product_id = $exclude_product_id;
        }

        // Check if category include is set
        if (isset($request->category_id)) {
            // Parse to json data
            $category_id = json_encode($request->category_id);

            // Assign value to discount object
            $discount->category_id = $category_id;
        }

        // Check if category exclude is set
         if (isset($request->exclude_category_id)) {
            // Parse to json data
            $exclude_category_id = json_encode($request->exclude_category_id);

            // Assign value to discount object
            $discount->exclude_category_id = $exclude_category_id;
        }

        $discount->coupon_code = $request->coupon_code;
        $discount->discount_unit = $request->discount_unit;
        $discount->discount_value = $request->discount_value;
        $discount->valid_from = $request->valid_from;
        $discount->valid_until = $request->valid_until;
        $discount->minimum_order_value = $request->minimum_order_value;
        $discount->maximum_order_value = $request->maximum_order_value;
        $discount->maximum_discount_amount = $request->maximum_discount_amount;
        $discount->is_redeem_allowed = $request->is_redeem_allowed;
        $discount->is_free_shipping_active = $request->is_free_shipping_active;
        $discount->limit_per_coupon = $request->limit_per_coupon;
        $discount->limit_per_client = $request->limit_per_client;
        $discount->save();

        // Return json response data
        return redirect()->back()->with('success', 'Coupon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        //  FInd the discount
        $discount = Discount::find($discount->id)->delete();

        return response()->json();
    }

    /**
     * Apply coupon.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function applyCoupon(Request $request)
    {
        // Validate form data
        $rules = array(
            'coupon_code' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails())
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));

        //  FInd the discount
        $discount = Discount::where('coupon_code', $request->coupon_code)->first();

        // If not found return error message
        if (!$discount){
            return response()->json(array('errors'=> 'This coupon does not exists!'));
        }

        // Check for coupon validation_from date
        if (Carbon::now() < $discount->valid_from){
            return response()->json(array('errors'=> 'This coupon is not valid yet!'));
        }

        // Check for coupon validation_untill date
        if (Carbon::now() > $discount->valid_until){
            return response()->json(array('errors'=> 'This coupon validity has expired!'));
        }

        // Get no of usage of this coupon
        $coupon_count = $discount->client();

        // Check for limit per coupon
        if ($discount->limit_per_coupon != null){
            if ($coupon_count->count() >= $discount->limit_per_coupon){
                return response()->json(array('errors'=> 'This coupon limit has exceeded!'));
            }
        }

        // Check for Minimum spend
        if ($discount->minimum_order_value != null){
            if ($request->price < $discount->minimum_order_value){
                return response()->json(array('errors'=> 'Minimum spend limit for this coupon is not satisfied! Minimum spend limit is TK-'.$discount->minimum_order_value.'.'));
            }
        }

        // Check for Maximum spend
        if ($discount->maximum_order_value != null){
            if ($request->price > $discount->maximum_order_value){
                return response()->json(array('errors'=> 'Maximum spend limit for this coupon is exceeded! Maximum spend limit is TK-'.$discount->maximum_order_value.'.'));
            }
        }

        // Get cart data
        $carts = Cart::where('sId', Session::getId())->get();

        // Check for fixed products
        if ($discount->product_id != null){
            foreach($carts as $cart){
                if(array_search($cart->product->id, json_decode($discount->product_id)) === false){
                    // Return error message
                    return response()->json(array('errors' => 'This coupon is not applicable for products of your cart!'));
                }
            }
        }

        // Check for excluded products
        if ($discount->exclude_product_id != null){
            foreach($carts as $cart){
                if(array_search($cart->product->id, json_decode($discount->product_id)) !== false){
                    // Return error message
                    return response()->json(array('errors' => 'This coupon is not valid for products of your cart!'));
                }
            }
        }

        // Array declaration
        $ids = array();

        // Get product ids
        foreach ($carts as $value){
            array_push($ids, $value->product->id);
        }

        // Find cart products
        $products = Product::find($ids);

        // Check for fixed categories
        if ($discount->category_id != null){
            foreach($products as $product){
                if(array_search($product->category_id, json_decode($discount->category_id)) === false){
                    // Return error message
                    return response()->json(array('errors' => 'This coupon is not applicable for products of your cart!'));
                }
            }
        }

        // Check for excluded categories
        if ($discount->exclude_category_id != null){
            foreach($products as $product){
                if(array_search($product->category_id, json_decode($discount->exclude_category_id)) !== false){
                    // Return error message
                    return response()->json(array('errors' => 'This coupon is not valid for products of your cart!'));
                }
            }
        }

        // Set coupon id in session
        Session::put('coupon_id', $discount->id);
    }
}
