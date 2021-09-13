<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Color;
use App\Size;
use Carbon\Carbon;
use Response;
use Validator;
use App\Offer;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class OfferController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authenticate')->except('allOffers');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all offers
        $offers = Offer::all()->sortByDesc('id');

        // Get all products
        $products = Product::all()->sortByDesc('id');

        return view('admin.offers', compact('offers', 'products'));
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
            // Create instance of brand model & assign form value then save to database
            $offers = new Offer();
            $offers->discount_value = $request->discount_value;
            $offers->valid_until = $request->valid_until;
            $offers->save();

            foreach ($request->product_id as $product){
                $offers->products()->attach($product);
            }

            return response()->json(['offer' => $offers->toArray(), 'products' => $offers->products]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        // Get the offer
        $offer = Offer::find($offer->id);

        // Get all products
        $products = Product::all()->sortByDesc('id');

        return view('admin.editOffer', compact('offer', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $offers = Offer::find($offer->id);
        $offers->discount_value = $request->discount_value;
        $offers->valid_until = $request->valid_until;
        $offers->save();

        // Detach previous products
        $offers->products()->detach();

        foreach ($request->product_id as $product){
            $offers->products()->attach($product);
        }

        return redirect()->back()->with('success', 'Offer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        // Find the offer & delete it
        Offer::find($offer->id)->delete();

        return response()->json();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allOffers()
    {
        // Get all offers
        $offers = Offer::where('valid_until', '>=', Carbon::now())->paginate(9);

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
        return view('offerProducts', compact('offers', 'categories', 'sizes', 'colors', 'brands', 'newProducts'));
    }
}
