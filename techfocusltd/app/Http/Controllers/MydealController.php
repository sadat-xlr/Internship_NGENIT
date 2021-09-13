<?php

namespace App\Http\Controllers;

use App\Incentive;
use App\Minicategory;
use App\Mydeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MydealController extends Controller
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
        // Create new instance of mydeal model apply formdata then save to db
        $mydeal = new Mydeal();
        $mydeal->quarter = $request->quarter;
        $mydeal->pqr = $request->pqr;
        $mydeal->date = $request->date;
        $mydeal->pq_value = $request->pq_value;
        $mydeal->client_id = $request->client_id;
        $mydeal->current_status = $request->current_status;
        $mydeal->closing_status = $request->closing_status;
        $mydeal->probability_status = $request->probability_status;
        $mydeal->probability_reason = $request->probability_reason;
        $mydeal->category_product = $request->category_product;
        $mydeal->category_solution = $request->category_solution;
        $mydeal->final_status = $request->final_status;
        $mydeal->project_status = $request->project_status;
        $mydeal->minicategory_id = $request->minicategory_id;
        $mydeal->salesman_id = Session::get('salesman_id');
        $mydeal->comments_by_sales = $request->comments_by_sales;
        $mydeal->comments_by_manager = $request->comments_by_manager;
        $mydeal->save();

        // Create new instance of incentive model apply formdata then save to db
        $incentive = new Incentive();
        $incentive->sales_value = $request->pq_value;
        $incentive->incentive_value = $request->pq_value * 0.1;
        $incentive->is_paid = false;
        $incentive->salesman_id = Session::get('salesman_id');
        $incentive->mydeal_id = $mydeal->id;
        $incentive->save();


        return response()->json($mydeal);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mydeal  $mydeal
     * @return \Illuminate\Http\Response
     */
    public function show(Mydeal $mydeal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mydeal  $mydeal
     * @return \Illuminate\Http\Response
     */
    public function edit(Mydeal $mydeal)
    {
        // Find deal model apply formdata then save to db
        $mydeal = Mydeal::find($mydeal->id);

        // Get minicategory
        $minicategory = Minicategory::with('subcategory')->find($mydeal->minicategory_id);


        return response()->json(['deal' => $mydeal, 'minicategory' => $minicategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mydeal  $mydeal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mydeal $mydeal)
    {
        // Find mydeal model apply formdata then save to db
        $mydeal = Mydeal::find($mydeal->id);
        $mydeal->quarter = $request->quarter;
        $mydeal->pqr = $request->pqr;
        $mydeal->date = $request->date;
        $mydeal->pq_value = $request->pq_value;
        $mydeal->client_id = $request->client_id;
        $mydeal->current_status = $request->current_status;
        $mydeal->closing_status = $request->closing_status;
        $mydeal->probability_status = $request->probability_status;
        $mydeal->probability_reason = $request->probability_reason;
        $mydeal->category_product = $request->category_product;
        $mydeal->category_solution = $request->category_solution;
        $mydeal->final_status = $request->final_status;
        $mydeal->project_status = $request->project_status;
        $mydeal->minicategory_id = $request->minicategory_id;
        $mydeal->comments_by_sales = $request->comments_by_sales;
        $mydeal->comments_by_manager = $request->comments_by_manager;
        $mydeal->save();


        return response()->json($mydeal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mydeal  $mydeal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mydeal $mydeal)
    {
        // Get the deal & delete it
        Mydeal::destroy($mydeal->id);

        return response()->json();
    }
}
