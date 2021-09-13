<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ContactController;

use App\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Response;
use Validator;

class QueryController extends Controller
{



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
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'g-recaptcha-response' => 'reCaptcha'
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            // return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return redirect()->back()->with(array('errors'=> $validator->getMessageBag()));
        }

        else{
            // Create instance of Contact model & assign form value then save to database
            $query = new Query;
            $query->name = $request->name;
            $query->phone = $request->phone_number;
            $query->message = $request->message;
            $query->email = $request->email;

            
            if ($query->save()) {

                $title= $request->title.' related query';
                // Send the mail
                Mail::send('emails.query', ['title' =>$title,'content'=> $query->message], function($message) use ($query) {
                    //use no-reply mail id here
                    $message->from($query->email);
                    // $message->to('dadavaai.world@gmail.com');
                    $message->to('dadavaai.world@gmail.com');

                    $message->subject('Query');
                });

                //agail crm

                // $address = array(
                //     "address"=>"Avenida Álvares Cabral 1777",
                //     "city"=>"Belo Horizonte",
                //     "state"=>"Minas Gerais",
                //     "country"=>"Brazil"
                // );
                $contact_email = $query->email;
                $contact_json = array(
                    "lead_score"=>"",
                    "star_value"=>"",
                    "tags"=>array($request->title,"query"),
                    "properties"=>array(
                      array(
                        "name"=>"first_name",
                        "value"=>$query->name,
                        "type"=>"SYSTEM"
                      ),
                      array(
                        "name"=>"last_name",
                        "value"=>"",
                        "type"=>"SYSTEM"
                      ),
                      array(
                        "name"=>"email",
                        "value"=>$contact_email,
                        "type"=>"SYSTEM"
                      ),  
                      array(
                          "name"=>"title",
                          "value"=>"",
                          "type"=>"SYSTEM"
                      ),
                      array(
                          "name"=>"address",
                        //   "value"=>json_encode($address),
                            "value"=>"",
                          "type"=>"SYSTEM"
                      ),
                      array(
                          "name"=>"phone",
                          "value"=>$query->phone,
                          "type"=>"SYSTEM"
                      ),
                      array(
                          "name"=>"TeamNumbers",  
                          "value"=>"",
                          "type"=>"CUSTOM"
                      ),
                      array(
                          "name"=>"Date Of Joining",
                          "value"=>"",		
                          "type"=>"CUSTOM"
                      )
                      
                    )
                );
                  
                $contact_json = json_encode($contact_json);
                $crm = new ContactController;
        
                $crm->curl_wrap("contacts", $contact_json, "POST", "application/json");
                

                return redirect()->back()->with('success', 'Message send successfully');
            } else {
                return redirect()->back()->with('error', 'Oparetion failed');
            }
            

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = Query::find($id);
        return view('admin.queryReply', compact('query'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function edit(Query $query)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Query $query)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function destroy(Query $query)
    {
        //
    }
}
