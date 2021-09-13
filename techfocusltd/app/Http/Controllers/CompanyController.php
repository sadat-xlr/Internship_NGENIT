<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Brand;
use App\Category;
use App\Product;
use App\Cart;
use App\Industry;
use App\Technology;
use App\About;
use App\Contact;
use App\Partner;
use App\Message;
use App\Siteinfo;
use Session;

// Company Controller
class CompanyController extends Controller
{
	// Insert a new message  
	public function addMessage(Request $request){
		
		// return response()->json($request);
		// Validate form data 
		$validatedData = $this->validate($request, [
        'firstName' => 'required',
        'country' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'subject' => 'required',
        'comment' => 'required',
		]);
		
		$message = new Message;
		// $message->name = $request->firstName." ".$request->lastName;
		$message->name = $request->firstName;
		$message->email = $request->email;
		$message->phone = $request->phone;
		$message->subject = $request->subject;
		$message->message = $request->comment;
		$message->save();

        // Send the mail
        Mail::send([], [], function($message) use ($request) {
            $message->from($request->email);
			$message->to('techfocusltd@gmail.com');
			// $message->to('shuvo.ngenit@gmail.com');
            $message->subject($request->subject);
            $message->setBody($request->comment.' From '.$request->country, 'text/html');
        });
		
		if($message){
			return redirect()->back()->with('success', 'Thanks for your message. We will contact you as soon as possible.');
		}else{
			return redirect()->back()->with('error', 'Failed!');
		}
	}
	
	// Loads allMessages view 
	public function allMessages(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Message::all();
		return view('admin.allMessages', ['messages' => $result]);
	}
	
	// Delete message
	public function deleteMessage($mesID){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Message::find($mesID)->delete();
				
		if($result){
			Session::put('success', 'Message deleted successfully.');
			return redirect('/allMessages');
		}else{
			Session::put('error', 'Message deletion failed!');
			return redirect('/allMessages');
		}
	}
	
	// Loads about view 
	public function about(){
		$result = About::all();
		$partners = Partner::all();
		
		return view('about', [
			'partners' => $partners,
			'abouts' => $result
		]);
	}
	
	// Loads addAbout view 
	public function addAbout(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.addAbout');
	}
	
	// Add about info and redirect to addAbout view 
	public function insertAbout(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'description' => 'required'
		]);
		
		// Create instance of About model & assign form value then save to database
		$about = new About;
		$about->description = $request->description;
		$about->save();
		
		/* Checks if data is saved to database. If so, redirect to addAbout page with success message. Otherwise, redirect to addAbout page with error message */
		if($about){
			Session::put('success', 'About added successfully.');
			return redirect('/addAbout');
		}else{
			Session::put('error', 'About addition failed!');
			return redirect('/addAbout');
		}
	}
	
	// Loads allAbout view 
	public function allAbout(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = About::all();
		return view('admin.allAbout', ['abouts' => $result]);
	}
	
	// Loads editAbout view
	public function editAbout($aboutId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = About::where('id', $aboutId)
               ->get();
		return view('admin.editAbout', [
		'abouts' => $result,
		'id' => $aboutId
		]);
	}
	
	// Update about & loads editAbout view with success or error message
	public function updateAbout(Request $request, $aboutId){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'description' => 'required'
		]);
		
		// Find the about & assign form value then save to database
		$about = About::find($aboutId);
		$about->description = $request->description;
		$about->save();
		
		/* Checks if data is saved to database. If so, redirect to editAbout page with success message. Otherwise, redirect to editAbout page with error message */
		if($about){
			Session::put('success', 'About updated successfully.');
			return redirect('/editAbout/'.$aboutId);
		}else{
			Session::put('error', 'About update failed!');
			return redirect('/editAbout/'.$aboutId);
		}	
	}
	
	// Delete about
	public function deleteAbout($aboutId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = About::find($aboutId)->delete();
				
		if($result){
			Session::put('success', 'About deleted successfully.');
			return redirect('/aboutInfo');
		}else{
			Session::put('error', 'About deletion failed!');
			return redirect('/aboutInfo');
		}
	}
	
	// Loads contact view 
	public function contact(){
		$contacts = Contact::all();
		$siteinfos = Siteinfo::all();
		
		return view('contact', [
		'contacts' => $contacts,
		'siteinfos' => $siteinfos,
		]);
	}
	
	// Loads addContact view 
	public function addContact(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.addContact');
	}
	
	// Add about info and redirect to addContact view 
	public function insertContact(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'address' => 'required',
        'phone1' => 'required',
        'phone2' => 'required',
        'email' => 'required|email',
		]);
		
		// Create instance of Contact model & assign form value then save to database
		$contact = new Contact;
		$contact->address = $request->address;
		$contact->phone1 = $request->phone1;
		$contact->phone2 = $request->phone2;
		$contact->email = $request->email;
		$contact->save();
		
		/* Checks if data is saved to database. If so, redirect to addContact page with success message. Otherwise, redirect to addContact page with error message */
		if($contact){
			Session::put('success', 'Contact added successfully.');
			return redirect('/addContact');
		}else{
			Session::put('error', 'Contact addition failed!');
			return redirect('/addContact');
		}
	}
	
	// Loads allContacts view 
	public function allContacts(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Contact::all();
		return view('admin.allContacts', ['contacts' => $result]);
	}
	
	// Loads editContact view
	public function editContact($contactId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Contact::where('id', $contactId)
               ->get();
		return view('admin.editContact', [
		'contacts' => $result,
		'id' => $contactId
		]);
	}
	
	// Update about & loads editContact view with success or error message
	public function updateContact(Request $request, $contactId){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'address' => 'required',
        'phone1' => 'required',
        'phone2' => 'required',
        'email' => 'required|email',
		]);
		
		// Find the Contact & assign form value then save to database
		$contact = Contact::find($contactId);
		$contact->address = $request->address;
		$contact->phone1 = $request->phone1;
		$contact->phone2 = $request->phone2;
		$contact->email = $request->email;
		$contact->save();
		
		/* Checks if data is saved to database. If so, redirect to editContact page with success message. Otherwise, redirect to editContact page with error message */
		if($contact){
			Session::put('success', 'Contact updated successfully.');
			return redirect('/editContact/'.$contactId);
		}else{
			Session::put('error', 'Contact update failed!');
			return redirect('/editContact/'.$contactId);
		}	
	}
	
	// Delete Contact
	public function deleteContact($contactId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Contact::find($contactId)->delete();
				
		if($result){
			Session::put('success', 'Contact deleted successfully.');
			return redirect('/allContacts');
		}else{
			Session::put('error', 'Contact deletion failed!');
			return redirect('/allContacts');
		}
	}
}
