<?php

namespace App\Http\Controllers;

use App\Toprequest;
use Illuminate\Http\Request;

class ToprequestController extends Controller
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
        // Get all banners
        $topRequests = Toprequest::all()->sortByDesc('id');
        return view('admin.topRequest', compact('topRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return view
        return view('admin.addTopRequest');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request);
        
        // Create instance of Banner model & assign form value then save to database
        $topRequest = new Toprequest();
        $topRequest->label1 = $request->label1;
        $topRequest->label2 = $request->label2;
        $topRequest->label3 = $request->label3;
        $topRequest->label4 = $request->label4;
        $topRequest->label5 = $request->label5;
        $topRequest->label6 = $request->label6;
        $topRequest->label_url1 = $request->label_url1;
        $topRequest->label_url2 = $request->label_url2;
        $topRequest->label_url3 = $request->label_url3;
        $topRequest->label_url4 = $request->label_url4;
        $topRequest->label_url5 = $request->label_url5;
        $topRequest->label_url6 = $request->label_url6;
        $topRequest->save();

        return redirect()->back()->with('success', 'Top request added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Toprequest  $toprequest
     * @return \Illuminate\Http\Response
     */
    public function show(Toprequest $toprequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Toprequest  $toprequest
     * @return \Illuminate\Http\Response
     */
    public function edit(Toprequest $toprequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Toprequest  $toprequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        // Find the banner
        $topRequest = Toprequest::find($id);

        $topRequest->label1 = $request->label1;
        $topRequest->label2 = $request->label2;
        $topRequest->label3 = $request->label3;
        $topRequest->label4 = $request->label4;
        $topRequest->label5 = $request->label5;
        $topRequest->label6 = $request->label6;
        $topRequest->label_url1 = $request->label_url1;
        $topRequest->label_url2 = $request->label_url2;
        $topRequest->label_url3 = $request->label_url3;
        $topRequest->label_url4 = $request->label_url4;
        $topRequest->label_url5 = $request->label_url5;
        $topRequest->label_url6 = $request->label_url6;
        $topRequest->save();

        return response()->json($topRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Toprequest  $toprequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the banner
        $topRequest = Toprequest::find($id);

        // Delete from database
        $topRequest->delete();

        return response()->json($topRequest);
    }
}
