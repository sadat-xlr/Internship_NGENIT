<?php

namespace App\Http\Controllers;

use App\Client;
use App\Draft;
use App\Subscription;
use Illuminate\Http\Request;

class DraftController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all drafts
        $drafts = Draft::orderBy('id', 'desc')->simplePaginate(15);
        $total = Draft::all()->count();

        return view('admin.drafts', compact('drafts', 'total'));
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
        // Check if email is set
        if (empty($request->mailto) && empty($request->email) && empty($request->subject) && empty($request->mailbody)){
            return response()->json(['errors' => 'Please fill out at least one field!']);
        }

        // Array declaration
        $emails = array();

        // Check if mailto field is set
        if (isset($request->mailto)){
            // Get emails & explode them by comma
            $emails_temp = explode(';', $request->mailto);
            foreach($emails_temp as $key => $value){
                array_push($emails, $value);
            }
        }

        // Check if client mail field is set
        if (isset($request->email)){
            // Check if client mail field is set to all
            if ($key = array_search('All', $request->email) !== false){
                // Get all clients & subscription email
                $clients = Client::all();
                $subscription = Subscription::all();

                // Get emails by looping over
                foreach ($clients as $client){
                    array_push($emails, $client->email);
                }
                foreach ($subscription as $subscription){
                    array_push($emails, $subscription->email);
                }
            }else{
                foreach($request->email as $key => $value){
                    array_push($emails, $value);
                }
            }
        }

        // Store to sentbox
        $draft = new Draft();
        $draft->mail_to = json_encode($emails);
        $draft->subject = $request->subject;
        $draft->mail_body = $request->mailbody;
        $draft->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  Get the draft
        $draft = Draft::find($id);

        // Get all clients & subscription email
        $clients = Client::all();
        $subscription = Subscription::all();

        return view('admin.showDraft', compact('draft', 'clients', 'subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function edit(Draft $draft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Check if email is set
        if (empty($request->mailto) && empty($request->email) && empty($request->subject) && empty($request->mailbody)){
            return response()->json(['errors' => 'Please fill out at least one field!']);
        }

        // Array declaration
        $emails = array();

        // Check if mailto field is set
        if (isset($request->mailto)){
            // Get emails & explode them by comma
            $emails_temp = explode(';', $request->mailto);
            foreach($emails_temp as $key => $value){
                array_push($emails, $value);
            }
        }

        // Check if client mail field is set
        if (isset($request->email)){
            // Check if client mail field is set to all
            if ($key = array_search('All', $request->email) !== false){
                // Get all clients & subscription email
                $clients = Client::all();
                $subscription = Subscription::all();

                // Get emails by looping over
                foreach ($clients as $client){
                    array_push($emails, $client->email);
                }
                foreach ($subscription as $subscription){
                    array_push($emails, $subscription->email);
                }
            }else{
                foreach($request->email as $key => $value){
                    array_push($emails, $value);
                }
            }
        }

        // Store to sentbox
        $draft = Draft::find($id);
        $draft->mail_to = json_encode($emails);
        $draft->subject = $request->subject;
        $draft->mail_body = $request->mailbody;
        $draft->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id, Request $request)
    {
        // Get the mail $ delete it
        Draft::destroy($id);

        return response()->json();
    }
}
