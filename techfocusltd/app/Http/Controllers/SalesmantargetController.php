<?php

namespace App\Http\Controllers;

use App\Salesman;
use Response;
use Validator;
use App\Salesmantarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SalesmantargetController extends Controller
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
        // Get all salesmen
        $salesmen = Salesman::all()->sortByDesc('id');

        // Get all salesmen target
        $salesmentarget = Salesmantarget::all()->sortByDesc('id');

        return view('admin.salesmantargets', compact('salesmen', 'salesmentarget'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get all salesmen
        $salesmen = Salesman::all()->sortByDesc('id');

        // return add form view
        return view('admin.addTarget', compact('salesmen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salesmentarget = new Salesmantarget();
        $salesmentarget->salesman_id = $request->salesman_id;
        $salesmentarget->quarter = $request->quarter;
        $salesmentarget->sales_target = $request->sales_target;
        $salesmentarget->month = $request->month;
        $salesmentarget->year = $request->year;
        $salesmentarget->new_client_target = $request->new_client_target;
        $salesmentarget->existing_client_target = $request->existing_client_target;
        $salesmentarget->physical_mkt = $request->physical_mkt;
        $salesmentarget->phone_mkt = $request->phone_mkt;
        $salesmentarget->social_mkt = $request->social_mkt;
        $salesmentarget->email_mkt = $request->email_mkt;
        $salesmentarget->save();

        return redirect()->back()->with('success', 'Salesman target added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salesmantarget  $salesmantarget
     * @return \Illuminate\Http\Response
     */
    public function show(Salesmantarget $salesmantarget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salesmantarget  $salesmantarget
     * @return \Illuminate\Http\Response
     */
    public function edit(Salesmantarget $salesmantarget)
    {
        // Find the target
        $salesmentarget = Salesmantarget::find($salesmantarget->id);

        return response()->json($salesmentarget);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salesmantarget  $salesmantarget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salesmantarget $salesmantarget)
    {
        // Find the target
        $salesmentarget = Salesmantarget::find($salesmantarget->id);
        $salesmentarget->salesman_id = $request->salesman_id;
        $salesmentarget->quarter = $request->quarter;
        $salesmentarget->sales_target = $request->sales_target;
        $salesmentarget->month = $request->month;
        $salesmentarget->year = $request->year;
        $salesmentarget->new_client_target = $request->new_client_target;
        $salesmentarget->existing_client_target = $request->existing_client_target;
        $salesmentarget->physical_mkt = $request->physical_mkt;
        $salesmentarget->phone_mkt = $request->phone_mkt;
        $salesmentarget->social_mkt = $request->social_mkt;
        $salesmentarget->email_mkt = $request->email_mkt;
        $salesmentarget->save();

        return response()->json($salesmentarget);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salesmantarget  $salesmantarget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salesmantarget $salesmantarget)
    {
        // Find the target
        $salesmentarget = Salesmantarget::find($salesmantarget->id)->delete();

        return response()->json();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function targets()
    {
        // Get all salesmen target
        $salesmentarget = Salesmantarget::all()->sortByDesc('id');

        return view('admin.targets', compact('salesmentarget'));
    }
}
