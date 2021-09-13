<?php

namespace App\Http\Controllers;

use Response;
use Validator;
use App\MembershipType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MembershipTypeController extends Controller
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
        // Get all Membership
        $memberships = MembershipType::all();

        return view('admin.allMembership', compact('memberships'));
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
            'discount_value' => 'required',
            'valid_until' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of MembershipType model & assign form value then save to database
            $membership = new MembershipType();
            $membership->membership_type = $request->membership_type;
            $membership->discount_unit = $request->discount_unit;
            $membership->discount_value = $request->discount_value;
            $membership->is_free_shipping_active = $request->is_free_shipping_active;
            $membership->valid_until = $request->valid_until;
            $membership->save();

            return response()->json($membership);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function show(MembershipType $membershipType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function edit(MembershipType $membershipType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MembershipType $membershipType)
    {
        // Validate form data
        $rules = array(
            'discount_value' => 'required',
            'valid_until' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of MembershipType model & assign form value then save to database
            $membership = MembershipType::find($membershipType->id);
            $membership->membership_type = $request->membership_type;
            $membership->discount_unit = $request->discount_unit;
            $membership->discount_value = $request->discount_value;
            $membership->is_free_shipping_active = $request->is_free_shipping_active;
            $membership->valid_until = $request->valid_until;
            $membership->save();

            return response()->json($membership);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MembershipType $membershipType)
    {
        // Get the membership
        $membership = MembershipType::find($membershipType->id)->delete();

        return response()->json();
    }
}
