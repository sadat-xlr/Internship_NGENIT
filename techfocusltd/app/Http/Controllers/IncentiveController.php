<?php

namespace App\Http\Controllers;

use App\Incentive;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class IncentiveController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authenticate');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all incentive
        $incentives = Incentive::all()->sortByDesc('id');

        return view('admin.incentive', compact('incentives'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Incentive  $incentive
     * @return \Illuminate\Http\Response
     */
    public function show(Incentive $incentive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Incentive  $incentive
     * @return \Illuminate\Http\Response
     */
    public function edit(Incentive $incentive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Incentive  $incentive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incentive $incentive)
    {
        // Get the Incentive
        $incentive = Incentive::find($incentive->id);
        $incentive->is_paid = $request->is_paid;
        $incentive->save();

        return response()->json($incentive);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Incentive  $incentive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incentive $incentive)
    {
        // Get Incentive & destroy it
        Incentive::destroy($incentive->id);

        return response()->json();
    }
}
