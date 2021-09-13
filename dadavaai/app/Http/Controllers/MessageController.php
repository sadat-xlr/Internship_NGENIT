<?php

namespace App\Http\Controllers;

use App\Message;
use App\Client;
use Validator;
use Response;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
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
    
        if($request->ajax()){

            if ($request->message_id) {

                $message = Message::where('id', $request->message_id)->first();
                $message->status = 1;
                $message->save();

                //reply

                $reply            = new Message();
                $reply->message   = $request->chat;
                $reply->client_id = $request->client_id;
                $reply->owner     = 0;
                $reply->status    = 1;
                $reply->save();
                return response()->json($message);

                
            }else {

                $client_id = Session::get('CLIENT_ID');
                $client = Client::where('id', $client_id)->first();

                $message            = new Message();
                $message->message   = $request->chat;
                $message->client_id = $client->id;
                $message->owner     = 1;
                $message->save();
            }


        
            return response()->json($message);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
