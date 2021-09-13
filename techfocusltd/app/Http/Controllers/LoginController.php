<?php

namespace App\Http\Controllers;

use App\Salesman;
use Session;
use Response;
use Validator;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    // Authinticate salesman
    public function sales_login(Request $request){
        // Validate form data
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors' => $validator->getMessageBag()->toarray()));
        }

        // Authorizes Salesman
        $salesman = Salesman::where('email', $request->email)
            ->where('password', md5($request->password))
            ->first();

        if($salesman){
            Session::put('salesman_id', $salesman->id);
            Session::put('salesman_name', $salesman->salesmanName);
            return response()->json($salesman);
        }else{
            return Response::json(array('errors' => array('response' => 'Invalid E-mail or Password or both ! ')));
        }
    }

	// Logout client
	public function sales_logout(Request $request){
		// Clear the user session
		Session::put('salesman_id', NULL);
		Session::put('salesman_name', NULL);
		
		// Redirect user to home page
		return redirect('/home');
	}

    // Login register view
    public function login_view(){
        // Return Login register page
        return view('client_login');
    }
}
