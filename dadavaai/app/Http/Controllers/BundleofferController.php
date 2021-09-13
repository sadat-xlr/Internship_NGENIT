<?php

namespace App\Http\Controllers;

use App\Bundleoffer;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;

class BundleofferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all offers
        $bundleOffers = Bundleoffer::all()->sortByDesc('id');

        // Get all products
        $products = Product::all()->sortByDesc('id');

        return view('admin.bundleOffers', compact('bundleOffers', 'products'));
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
            $bundleoffer = new Bundleoffer;
            $bundleoffer->qty_start = $request->qty_start;
            $bundleoffer->qty_end = $request->qty_end;
            $bundleoffer->discount = $request->discount;
            $bundleoffer->product_id = $request->product_id;
            $bundleoffer->save();
            return response()->json($bundleoffer);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bundleoffer  $bundleoffer
     * @return \Illuminate\Http\Response
     */
    public function show(Bundleoffer $bundleoffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bundleoffer  $bundleoffer
     * @return \Illuminate\Http\Response
     */
    public function edit(Bundleoffer $bundleoffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bundleoffer  $bundleoffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Create instance of brand model & assign form value then save to database
        $bundleoffer = Bundleoffer::find($id);
        $bundleoffer->qty_start = $request->qty_start;
        $bundleoffer->qty_end = $request->qty_end;
        $bundleoffer->discount = $request->discount;
        $bundleoffer->product_id = $request->product_id;
        $bundleoffer->save();
        return response()->json($bundleoffer);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bundleoffer  $bundleoffer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get the product & delete it
        $bundleOffer = Bundleoffer::find($id);

        // Delete the product
        $bundleOffer->delete();

        return response()->json();
    }
}
