<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;
use App\Contact;

class ContactController extends Controller
{
    

    //use for agile crm
    public function curl_wrap($entity, $data, $method, $content_type) {

        $AGILE_DOMAIN = 'jara-ecommerce';
        $AGILE_USER_EMAIL ='admin@jaratraders.com';
        $AGILE_REST_API_KEY= '8tilc5s9c1u2bba6sd7otghj0j';

        if ($content_type == NULL) {
            $content_type = "application/json";
        }
        
        $agile_url = "https://" . $AGILE_DOMAIN . ".agilecrm.com/dev/api/" . $entity;

        $ch = \curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, true);
        switch ($method) {
            case "POST":
                $url = $agile_url;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case "GET":
                $url = $agile_url;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                break;
            case "PUT":
                $url = $agile_url;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case "DELETE":
                $url = $agile_url;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default:
                break;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type:$content_type;", 'Accept:application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $AGILE_USER_EMAIL . ':' . $AGILE_REST_API_KEY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    
    
    public function contactForm(){
        $contact = Contact::first();
        return view('client.contact', compact('contact'));
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();

        return view('admin.contacts', [
            'contacts' => $contacts
        ]);
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
            'address' => 'required',
            'phone1' => 'required',
            'email' => 'required|email',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of Contact model & assign form value then save to database
            $contact = new Contact;
            $contact->address = $request->address;
            $contact->phone1 = $request->phone1;
            $contact->phone2 = $request->phone2;
            $contact->email = $request->email;
            $contact->save();

            return response()->json($contact);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the Contact model & assign form value then save to database
        $contact = Contact::find($request->id);
        $contact->address = $request->address;
        $contact->phone1 = $request->phone1;
        $contact->phone2 = $request->phone2;
        $contact->email = $request->email;
        $contact->save();

        return response()->json($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Contact::find ($id)->delete();
        return response()->json();
    }
}
