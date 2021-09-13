<?php

namespace App\Http\Controllers;

use App\Client;
use App\Plan;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('salesman_auth')->except('index');
        $this->middleware('authenticate')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // Create new instance of plan model apply formdata then save to db
        $plan = new Plan();
        $plan->month = $request->month;
        $plan->year = $request->year;
        $plan->date = $request->date;
        $plan->marketingType = $request->marketingType;
        $plan->status = $request->status;
        $plan->product = $request->product;
        $plan->details = $request->details;
        $plan->solution = $request->solution;
        $plan->client_id = $request->client_id;
        $plan->minicategory_id = $request->minicategory_id;
        $plan->salesman_id = Session::get('salesman_id');
        $plan->comments = $request->comments;
        $plan->save();

        // Get client
        $client = Client::with('contactpeople')->find($request->client_id);

        // Get subcategory
        $subcategory = Subcategory::with('category')->find($request->subcategory_id);


        return response()->json(['plan' => $plan, 'client' => $client, 'subcategory' => $subcategory]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        // Get plan
        $plan = Plan::find($plan->id);

        return response()->json($plan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        // Create new instance of plan model apply formdata then save to db
        $plan = Plan::find($plan->id);
        $plan->month = $request->month;
        $plan->year = $request->year;
        $plan->date = $request->date;
        $plan->marketingType = $request->marketingType;
        $plan->status = $request->status;
        $plan->product = $request->product;
        $plan->details = $request->details;
        $plan->solution = $request->solution;
        $plan->client_id = $request->client_id;
        $plan->minicategory_id = $request->minicategory_id;
        $plan->comments = $request->comments;
        $plan->save();

        // Get client
        $client = Client::with('contactpeople')->find($request->client_id);

        // Get subcategory
        $subcategory = Subcategory::with('category')->find($request->category_id);


        return response()->json(['plan' => $plan, 'client' => $client, 'subcategory' => $subcategory]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        // Delete plan
        Plan::destroy($plan->id);

        return response()->json();
    }
}
