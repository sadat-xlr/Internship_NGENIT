<?php

namespace App\Http\Controllers;

use App\Guestmessage;
use Illuminate\Http\Request;
use Session;

class GuestMessageController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth',['except'=>['create','store']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
        $contactMessages    =   Guestmessage::orderBy('created_at', 'asc')->get();
        return view('admin.informative.guestQuery.allQuery')->with('contactMessages',$contactMessages);
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
        
        $contact    =   new Guestmessage;
        $contact->name  =   $request->name;
        $contact->email =   $request->email;
        $contact->phoneNumber =   $request->phoneNumber;
        $contact->subject   =   $request->subject;
        $contact->message   =   $request->message;
        $contact->status    =   0;
        
        if($contact->save()){
			Session::put('success', 'Message send successfully.');
			return back();
		}else{
			Session::put('error', 'Message not send');
			return back();
		}

    }

    public function showGuestQuery($id){
        $query = Guestmessage::FindOrFail($id);
        $query->status = 1;
        $query->save();
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guestmessage  $guestmessage
     * @return \Illuminate\Http\Response
     */
    public function queryReply($id)
    {
        $query = Guestmessage::FindOrFail($id);
        $query->status = 1;
        $query->save();
        return view('admin.informative.guestQuery.queryReply')->with('query', $query);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guestmessage  $guestmessage
     * @return \Illuminate\Http\Response
     */
    public function edit(Guestmessage $guestmessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guestmessage  $guestmessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guestmessage $guestmessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guestmessage  $guestmessage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guestQuery   =   Guestmessage::find($id);
        $guestQuery->delete();
        return back();
    }
}
