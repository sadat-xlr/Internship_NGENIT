<?php

namespace App\Http\Controllers;

use Response;
use Validator;
use App\Deal;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DealController extends Controller
{
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
        // $products = Product::all()->sortByDesc('id');

        return view('admin.deals', compact('deals'));
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
            // 'product_id' => 'required',
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

            // foreach ($request->product_id as $product){
            //     $deals->products()->attach($product);
            // }

            // return response()->json(['deal' => $deals->toArray(), 'products' => $deals->products]);
            return response()->json(['deal' => $deals->toArray()]);

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $deals = Deal::find($id);
        $deals->discount_value = $request->discount_value;
        $deals->valid_until = $request->valid_until;
        $deals->save();

        // Detach previous products
        // $deals->products()->detach();

        // foreach ($request->product_id as $product){
        //     $deals->products()->attach($product);
        // }

        // return response()->json(['deal' => $deals->toArray(), 'products' => $deals->products]);
        return response()->json(['deal' => $deals->toArray()]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the deal & delete it
        Deal::find($id)->delete();

        return response()->json();
    }
}
