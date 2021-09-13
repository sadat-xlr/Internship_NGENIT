<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Session;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
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
        // Get all clients
        $clients = Customer::all()->sortByDesc('id');

        // Return view
        return view('admin.allClients', compact('clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $client)
    {
        // Get the client
        $client = Customer::find(Session::get('ID'));
        $client->customerName = $request->customerName;
        $client->phone = $request->phone;
        $client->city = $request->city;
        $client->division = $request->division;
        $client->country = $request->country;
        $client->address = $request->address;
        $client->company = $request->company;
        $client->zipCode = $request->zipCode;
        $client->office_phone = $request->office_phone;
        $client->office_email = $request->office_email;
        $client->save();

        // Return json data
        return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Customer $client)
    {
        // Get the client & delete it
        $client = Customer::find($request->id)->delete();

        // Return json response
        return response()->json();
    }

    /**
     * Update client password.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function updatePass(Request $request)
    {
        // Validate form data
        $rules = array(
            'password' => 'required',
            'oldpassword' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors' => $validator->getMessageBag()->toarray()));
        }

        // Get the client
        $client = Customer::find(Session::get('ID'));

        if ($client->password != md5($request->oldpassword)){
            // Return json response
            return response()->json(['errors' => ['error' => 'Password did not match!']]);
        }

        // Upadate password
        $client->password = md5($request->password);
        $client->save();

        // Return json response
        return response()->json();
    }
}
