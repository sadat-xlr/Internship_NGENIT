<?php

namespace App\Http\Controllers;

use App\Clientpoint;
use App\Client;
use Session;
use Illuminate\Http\Request;

class ClientpointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pointHistory()
    {
        $client_id = Session::get('CLIENT_ID');
        $client = Client::where('id', $client_id)->first();

        $points = Clientpoint::where('client_id',$client_id)->orderBy('created_at', 'Desc')->groupBy('created_at')->paginate(10);

        return view('client.account.pointHistory', compact('points'));
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
     * @param  \App\Clientpoint  $clientpoint
     * @return \Illuminate\Http\Response
     */
    public function show(Clientpoint $clientpoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clientpoint  $clientpoint
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientpoint $clientpoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientpoint  $clientpoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientpoint $clientpoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientpoint  $clientpoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientpoint $clientpoint)
    {
        //
    }
}
