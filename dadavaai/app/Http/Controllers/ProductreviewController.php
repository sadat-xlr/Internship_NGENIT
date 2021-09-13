<?php

namespace App\Http\Controllers;

use Session;
use Response;
use Validator;
use App\Client;
use App\Productreview;
use App\Clientpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductreviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        if(Session::get('CLIENT_ID'))
        {
	        // Validate form data
	        $rules = array(
	            'rating' => 'required',
	            'review' => 'required',
	            'product_id' => 'required',
	        );

	        $validator = Validator::make ( Input::all(), $rules);
	        if ($validator->fails()){
	            return Response::json(['error'=> $validator->getMessageBag()->toarray()]);
	        }

	        // Get the client
	        $client = Client::find(Session::get('CLIENT_ID'));

	        // Create an instace of Productreview & assign form data then save to database
	        $review = new Productreview();
	        $review->review = $request->review;
	        $review->rating = $request->rating;
	        $review->product_id = $request->product_id;
	        $review->client_id = $client->id;

	        if ($review->save()) {
		        //for review point
	        	
	            $clientPoint = Clientpoint::where('client_id', $client->id)->first();
                if ($clientPoint) {

                	$clientPoint->pro_review_ref_point += 1;
		            $clientPoint->client_id = $client->id;
		            $clientPoint->save();
                    
                } else {

	                $clientPoint = new Clientpoint;
		            $clientPoint->pro_review_ref_point = 1;
		            $clientPoint->client_id = $client->id;
		            $clientPoint->save();
                } 


	        }

	        // Return json response
	        return response()->json(['success'=>'Thanks for your rating', 'review'=>$review]);
		}
		else
		{
			return Response::json(['error'=>['error'=> 'Sign in required <br> <a  href="#login-popup" data-toggle="modal" style="color: yellow;"><u>click here to sign in</u></a>']]);
		}

    }
}
