<?php

namespace App\Http\Controllers;

use Response;
use Validator;
use App\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PolicyController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('allPolicies');
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all about info
        $policies = Policy::all();

        // Return view
        return view('admin.policies', compact('policies'));
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
            'topic' => 'required',
            'policy_description' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails())
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));

        else {
            $policies = new Policy();
            $policies->topic = $request->topic;
            $policies->description = $request->policy_description;
            $policies->save();
            return response()->json($policies);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
        // Find the About & update it
        $policy = Policy::find ($request->id);
        $policy->description = $request->description;
        $policy->topic = $request->topic;
        $policy->save();
        return response()->json($policy);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $policy = Policy::find ($id)->delete();
        return response()->json();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allPolicies()
    {
        // Get all about info
        $policies = Policy::all();

        // Return view
        return view('client.policy', compact('policies'));
    }
}
