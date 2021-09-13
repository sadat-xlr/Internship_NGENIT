<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Color;
use App\Size;
use Carbon\Carbon;
use Response;
use Validator;
use App\Deal;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DealController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authenticate')->except('allDeals');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all deals
        $deals = Deal::all()->sortByDesc('id');

        // Get all products
        $products = Product::all()->sortByDesc('id');

        return view('admin.deals', compact('deals', 'products'));
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
            'discount_value' => 'required',
            'valid_until' => 'required',
            'product_id' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of deal model & assign form value then save to database
            $deals = new Deal();
            $deals->discount_value = $request->discount_value;
            $deals->valid_until = $request->valid_until;
            $deals->save();

            foreach ($request->product_id as $product){
                $deals->products()->attach($product);
            }

            return response()->json(['deal' => $deals->toArray(), 'products' => $deals->products]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function show(Deal $deal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function edit(Deal $deal)
    {
        // Get the offer
        $deal = Deal::find($deal->id);

        // Get all products
        $products = Product::all()->sortByDesc('id');

        return view('admin.editDeal', compact('deal', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deal $deal)
    {
        $deals = Deal::find($deal->id);
        $deals->discount_value = $request->discount_value;
        $deals->valid_until = $request->valid_until;
        $deals->save();

        // Detach previous products
        $deals->products()->detach();

        foreach ($request->product_id as $product){
            $deals->products()->attach($product);
        }

        return redirect()->back()->with('success', 'Deal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deal $deal)
    {
        // Find the deal & delete it
        Deal::find($deal->id)->delete();

        return response()->json();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allDeals()
    {
        // Get all offers
        $deals = Deal::where('valid_until', '>=', Carbon::now())->paginate(9);

        // Get all categories
        $categories = Category::all();

        // Get all brands
        $brands = Brand::all();

        // Get all sizes
        $sizes = Size::all();

        // Get all colors
        $colors = Color::all();

        // Get all newProducts
        $newProducts = Product::orderBy('id', 'desc')
            ->take(36)
            ->get();

        // Return view
        return view('dealProducts', compact('deals', 'categories', 'sizes', 'colors', 'brands', 'newProducts'));
    }
}
