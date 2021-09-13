<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ContactController;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // Check if email already exists
        $subscribe = Subscription::where('email', $request->email)->first();
        if ($subscribe){
            return redirect()->back()->with(['error' => 'This email already exists! Please try again with a different email.']);
        }

        // Create instance of Subscription model & assign form value then save to database
        $subscribes = new Subscription();
        $subscribes->email = $request->email;
        

        $title= '<h3>Welcome to <a href="dadavaai.com">dadavaai.com</a></h3>';
        $content    =   'You have successfully subscribed for our newsletter. From now you will get upto date info about our products.';
        // Send the mail
        Mail::send('emails.subscribNotification', ['title' =>$title,'content'=> $content], function($message) use ($request) {
            //use no-reply mail id here
            $message->from('no-reply@dadavaai.com');
            $message->to($request->email);
            $message->subject('Greeting for newsletter subscription');
        });
       

        // return response()->json($subscribes);
        if ($subscribes->save()) {

            $contact_email = $request->email;
            $contact_json = array(
                "lead_score"=>"",
                "star_value"=>"",
                "tags"=>"subscriber",
                "properties"=>array(
                  array(
                    "name"=>"first_name",
                    "value"=>"",
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
                      "value"=>"",
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


            return redirect()->back()->with('success', 'You have successfully subscribed for our newsletter. From now you will get upto date info about our products.');
        } else {
            return redirect()->back()->with('error', 'Subcription not compleated Done');

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe(Request $request)
    {
        $subscribe = Subscription::where('email', $request->email)->first();


        if ($subscribe){
            $subscribe->delete();
            return redirect()->back()->with(['success' => 'unsubscription done']);
        } else {
            return redirect()->back()->with(['error' => 'email address not found']);

        }
        

    }
}
