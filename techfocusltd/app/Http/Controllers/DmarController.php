<?php

namespace App\Http\Controllers;

use App\Dmar;
use App\Minicategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DmarController extends Controller
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
        // Create new instance of dmar model apply formdata then save to db
        $dmar = new Dmar();
        $dmar->status = $request->status;
        $dmar->area = $request->area;
        $dmar->date = $request->date;
        $dmar->clientType = $request->clientType;
        $dmar->sector_id = $request->sector_id;
        $dmar->product = $request->product;
        $dmar->companyName = $request->companyName;
        $dmar->acitivity = $request->acitivity;
        $dmar->current_status = $request->current_status;
        $dmar->solution = $request->solution;
        $dmar->contact = $request->contact;
        $dmar->minicategory_id = $request->minicategory_id;
        $dmar->salesman_id = Session::get('salesman_id');
        $dmar->comment_by_sales = $request->comment_by_sales;
        $dmar->save();


        return response()->json($dmar);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dmar  $dmar
     * @return \Illuminate\Http\Response
     */
    public function show(Dmar $dmar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dmar  $dmar
     * @return \Illuminate\Http\Response
     */
    public function edit(Dmar $dmar)
    {
        // Find dmar model apply formdata then save to db
        $dmar = Dmar::find($dmar->id);

        // Get minicategory
        $minicategory = Minicategory::with('subcategory')->find($dmar->minicategory_id);


        return response()->json(['dmar' => $dmar, 'minicategory' => $minicategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dmar  $dmar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dmar $dmar)
    {
        // Find dmar model apply formdata then save to db
        $dmar = Dmar::find($dmar->id);
        $dmar->status = $request->status;
        $dmar->area = $request->area;
        $dmar->date = $request->date;
        $dmar->clientType = $request->clientType;
        $dmar->sector_id = $request->sector_id;
        $dmar->product = $request->product;
        $dmar->companyName = $request->companyName;
        $dmar->acitivity = $request->acitivity;
        $dmar->current_status = $request->current_status;
        $dmar->solution = $request->solution;
        $dmar->contact = $request->contact;
        $dmar->minicategory_id = $request->minicategory_id;
        $dmar->comment_by_sales = $request->comment_by_sales;
        $dmar->save();


        return response()->json($dmar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dmar  $dmar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dmar $dmar)
    {
        // Get the resource & delete it
        Dmar::destroy($dmar->id);

        return response()->json();
    }
}
