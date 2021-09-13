<?php

namespace App\Http\Controllers;

use App\Client;
use App\Contactperson;
use App\MembershipType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
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
        // Get the id of prime membership type
        $membership_type = MembershipType::select('id')->where('membership_type', '0')->get()->toArray();

        // Create new instance of Client model apply formdata then save to db
        $client = new Client();
        $client->companyName = $request->companyName;
        $client->status = $request->status;
        $client->area = $request->area;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->cell_office = $request->cell_office;
        $client->email_office = $request->email_office;
        $client->web = $request->web;
        $client->comments = $request->comments;
        $client->membership_type_id = $membership_type[0]['id'];
        $client->subsector_id = $request->subsector_id;
        $client->salesman_id = Session::get('salesman_id');
        $client->save();

        // Create new instance of Contactperson model apply formdata then save to db
        foreach ($request->contactPersonName as $key => $value) {
            $contactpeople = new Contactperson();
            $contactpeople->contactPersonName = $value;
            $contactpeople->designation = $request->designation[$key];
            $contactpeople->department = $request->department[$key];
            $contactpeople->cell = $request->cell[$key];
            $contactpeople->client_id = $client->id;
            $contactpeople->save();
        }

        // Get contactpeople by client id
        $contactpeople = Contactperson::where('client_id', $client->id)->get();


        return response()->json(['client' => $client, 'contactpeople' => $contactpeople]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        // Get contactpeople by client id
        $contactpeople = Contactperson::where('client_id', $client->id)->get();

        return response()->json($contactpeople);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        // Find Client model apply formdata then save to db
        $client = Client::find($client->id);
        $client->companyName = $request->companyName;
        $client->status = $request->status;
        $client->area = $request->area;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->cell_office = $request->cell_office;
        $client->email_office = $request->email_office;
        $client->web = $request->web;
        $client->comments = $request->comments;
        $client->subsector_id = $request->subsector_id;
        $client->save();

        // destroy previous Contactperson
        Contactperson::where('client_id', $client->id)->delete();

        // Find Contactperson model apply formdata then save to db
        foreach ($request->contactPersonName as $key => $value) {
            $contactpeople = new Contactperson();
            $contactpeople->contactPersonName = $value;
            $contactpeople->designation = $request->designation[$key];
            $contactpeople->department = $request->department[$key];
            $contactpeople->cell = $request->cell[$key];
            $contactpeople->client_id = $client->id;
            $contactpeople->save();
        }

        // Get contactpeople by client id
        $contactpeople = Contactperson::where('client_id', $client->id)->get();


        return response()->json(['client' => $client, 'contactpeople' => $contactpeople]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        // Find client
        Client::destroy($client->id);

        return response()->json();
    }
}
