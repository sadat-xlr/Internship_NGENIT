<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Message;
use App\Mydeal;
use App\Order;
use App\Orderdetail;
use App\Productcomment;
use App\Salesmantarget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\User;
use App\Siteinfo;
use App\Partner;
use Session;

// Admin Controller
class AdminController extends Controller
{
	// Loads admin login view 
	public function index(){
		return view('admin.login');
	}
	
	// Loads admin dashboard view 
	public function dashboard(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}

		$orders = Order::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', '=', Carbon::now()->year)->count();
		$customers = Customer::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', '=', Carbon::now()->year)->count();
		$messages = Message::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', '=', Carbon::now()->year)->count();
		$comments = Productcomment::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', '=', Carbon::now()->year)->count();
        $orderDetails = Orderdetail::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', '=', Carbon::now()->year)->get();

        $target = Salesmantarget::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', '=', Carbon::now()->year)->sum('sales_target');
        $quoteValue = Mydeal::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', '=', Carbon::now()->year)->sum('pq_value');

		$sum = 0;
        foreach ($orderDetails as $orderDetail){
            $sum += $orderDetail->product->price;
        }

        $sum = $sum + $quoteValue;

		return view('admin.index', compact('orders', 'sum', 'quoteValue', 'target', 'customers', 'messages', 'comments'));
	}
	
	/* Authorizes the admin login process. Redirect to admin login page (if provided data is not valid) or to admin dashboard page (if provided data is valid) */
	public function loginAuth(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
		'email' => 'required|email',
        'password' => 'required',
		]);
		
		// Authorizes user
		$user = User::where('adminEmail', $request->email)
		->where('password', md5($request->password))
		->first();
		
		if($user){
			Session::put('Name', $user->adminName);
			Session::put('Image', $user->adminImage);
			Session::put('level', $user->accessLabel);
			return redirect('/dashboard');
		}else{
			Session::put('error', 'Invalid E-mail or Password or both !'); 
			return redirect('/administration');
		}
	}
	
	// Destroy the Session & Redirect to admin login page
	public function logout(){
		Session::put('Name', NULL);
		Session::put('Image', NULL);
		Session::put('level', NULL);
		return redirect('/administration');
	}
	
	// Loads add siteinfo view 
	public function siteinfo(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.siteinfo');
	}		
	
	// Add a info and redirect to siteinfo view 
	public function addInfo(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'title' => 'required',
        'facebook' => 'required',
        'twitter' => 'required',
        'instagram' => 'required',
        'pinterest' => 'required',
        'googleplus' => 'required',
        'dribbble' => 'required',
        'copyright' => 'required',
		]);
		
		// Create instance of Brand model & assign form value then save to database
		$siteinfo = new Siteinfo;
		$siteinfo->title = $request->title;
		$siteinfo->facebook = $request->facebook;
		$siteinfo->twitter = $request->twitter;
		$siteinfo->instagram = $request->instagram;
		$siteinfo->pinterest = $request->pinterest;
		$siteinfo->googleplus = $request->googleplus;
		$siteinfo->dribbble = $request->dribbble;
		$siteinfo->copyright = $request->copyright;
		$siteinfo->save();
		
		/* Checks if data is saved to database. If so, redirect to siteinfo page with success message. Otherwise, redirect to siteinfo page with error message */
		if($siteinfo){
			Session::put('success', 'Info added successfully.');
			return redirect('/siteinfo');
		}else{
			Session::put('error', 'Info addition failed!');
			return redirect('/siteinfo');
		}
	}
	
	// Loads allInfo view
	public function allInfo(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Siteinfo::all();
		return view('admin.allInfo', ['data' => $result]);
	}
	
	// Loads editInfo view
	public function editInfo($infoId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Siteinfo::where('id', $infoId)
               ->get();
		return view('admin.editInfo', [
		'data' => $result,
		'id' => $infoId
		]);
	}
	
	// Update info and redirect to editInfo view 
	public function updateInfo(Request $request, $infoId){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'title' => 'required',
        'facebook' => 'required',
        'twitter' => 'required',
        'instagram' => 'required',
        'pinterest' => 'required',
        'googleplus' => 'required',
        'dribbble' => 'required',
        'copyright' => 'required',
		]);
		
		// Find the siteinfo model & assign form value then save to database
		$siteinfo = Siteinfo::find($infoId);
		$siteinfo->title = $request->title;
		$siteinfo->facebook = $request->facebook;
		$siteinfo->twitter = $request->twitter;
		$siteinfo->instagram = $request->instagram;
		$siteinfo->pinterest = $request->pinterest;
		$siteinfo->googleplus = $request->googleplus;
		$siteinfo->dribbble = $request->dribbble;
		$siteinfo->copyright = $request->copyright;
		$siteinfo->save();
		
		/* Checks if data is saved to database. If so, redirect to editInfo page with success message. Otherwise, redirect to editInfo page with error message */
		if($siteinfo){
			Session::put('success', 'Info updated successfully.');
			return redirect('/editInfo/'.$infoId);
		}else{
			Session::put('error', 'Info update failed!');
			return redirect('/editInfo/'.$infoId);
		}
	}
	
	// Delete Info
	public function deleteInfo($infoId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Siteinfo::find($infoId)->delete();
				
		if($result){
			Session::put('success', 'Info deleted successfully.');
			return redirect('/allInfo');
		}else{
			Session::put('error', 'Info delete failed!');
			return redirect('/allInfo');
		}
	}
	
	// Redirect to add user page
	public function addUser(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.addUser');
	}
	
	// Add a new user in database & Redirect to add user page
	public function insertUser(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'adminName' => 'required',
		'adminEmail' => 'required|email',
        'adminImage' => 'required|image|mimes:png,jpg,jpeg|max:25',
        'password' => 'required',
		]);
		
		// Handel image upload 
		
		// Checks if the file exists
		if ($request->hasFile('adminImage')){
			// Get file name with extension
			$fileNameWithExt = $request->file('adminImage')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('adminImage')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('adminImage')->storeAs('public/images/admin', $fileNameToStore);    
		}else{
			Session::put('error', 'User addition failed!');
			return Redirect::to('/addUser');
		}

		// Create instance of User model & assign form value then save to database
		$User = new User;
		$User->adminName = $request->adminName;
		$User->adminEmail = $request->adminEmail;
		$User->accessLabel = $request->accessLabel;
		$User->password = md5($request->password);
		$User->adminImage = $fileNameToStore;
		$User->save();
		
		
		/* Checks if data is saved to database. If so, redirect to addUser page with success message. Otherwise, redirect to addUser page with error message */
		if($User){
			Session::put('success', 'Admin added successfully.');
			return redirect('/addUser');
		}else{
			Session::put('error', 'Admin addition failed!');
			return redirect('/addUser');
		}
	}
	
	// Loads allUsers view
	public function allUsers(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = User::all();
		return view('admin.allUsers', ['users' => $result]);
	}
	
	// Loads editUser view
	public function editUser($userId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = User::where('id', $userId)
               ->get();
		return view('admin.editUser', [
		'users' => $result,
		'id' => $userId
		]);
	}
	
	// Update user & loads editUser view with success or error message
	public function updateUser(Request $request, $userId){
		// Validate form
		$validatedData = $this->validate($request, [
        'adminName' => 'required',
		'adminEmail' => 'required|email',
        'adminImage' => 'image|mimes:png,jpg,jpeg|max:25',
        'password' => 'required',
		]);
						
		// Handel image upload 
		
		// Checks if the file exists. If exists upload new image, delete the previous image from directory and update database with new data
		if ($request->hasFile('adminImage')){
			// Get file name with extension
			$fileNameWithExt = $request->file('adminImage')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('adminImage')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('adminImage')->storeAs('public/images/admin', $fileNameToStore); 

			// Find the user model & assign form value then save to database
			$User = User::find($userId);
			// Get AdminImage & delete it from the directory
			Storage::delete('public/images/admin/'.$User->adminImage);
			$User->adminName = $request->adminName;
			$User->adminEmail = $request->adminEmail;
			$User->accessLabel = $request->accessLabel;
			$User->password = md5($request->password);
			$User->adminImage = $fileNameToStore;
			$User->save();
				
			/* Checks if data is updated to database. If so, redirect to editAdmin page with success message. Otherwise, redirect to editAdmin page with error message */
			if($User){
				Session::put('success', 'Admin updated successfully.');
				return redirect('/editUser/'.$userId);
			}else{
				Session::put('error', 'Admin update failed!');
				return redirect('/editUser/'.$userId);
			}			
		}
		
		// If image not selected update without editing the AdminImage field
		else{
			// Find the Admin & assign form value then save to database
			$User = User::find($userId);
			$User->adminName = $request->adminName;
			$User->adminEmail = $request->adminEmail;
			$User->accessLabel = $request->accessLabel;
			$User->password = md5($request->password);
			$User->save();
				
			/* Checks if data is updated to database. If so, redirect to editAdmin page with success message. Otherwise, redirect to editAdmin page with error message */
			if($User){
				Session::put('success', 'Admin updated successfully.');
				return redirect('/editUser/'.$userId);
			}else{
				Session::put('error', 'Admin update failed!');
				return redirect('/editUser/'.$userId);
			}
		}	
	}
	
	// Delete Admin
	public function deleteUser($userId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = User::find($userId);
		// Get AdminImage & delete it from the directory
		Storage::delete('public/images/admin/'.$result->adminImage);
		$result->delete();
				
		if($result){
			Session::put('success', 'Admin deleted successfully.');
			return redirect('/all-user');
		}else{
			Session::put('error', 'Admin delete failed!');
			return redirect('/all-user');
		}
	}
	
	// Loads addPartner view 
	public function addPartner(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.addPartner');
	}
	
	// Add a new partner in database & Redirect to addPartner page
	public function insertPartner(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'companyName' => 'required',
        'logo' => 'required|image|mimes:png,jpg,jpeg|max:25',
		]);
		
		// Handel image upload 
		
		// Checks if the file exists
		if ($request->hasFile('logo')){
			// Get file name with extension
			$fileNameWithExt = $request->file('logo')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('logo')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('logo')->storeAs('public/images/partner', $fileNameToStore);    
		}else{
			Session::put('error', 'Partner addition failed!');
			return Redirect::to('/addPartner');
		}

		// Create instance of Partner model & assign form value then save to database
		$partner = new Partner;
		$partner->companyName = $request->companyName;
		$partner->logo = $fileNameToStore;
		$partner->save();
		
		
		/* Checks if data is saved to database. If so, redirect to addPartner page with success message. Otherwise, redirect to addPartner page with error message */
		if($partner){
			Session::put('success', 'Partner added successfully.');
			return redirect('/addPartner');
		}else{
			Session::put('error', 'Partner addition failed!');
			return redirect('/addPartner');
		}
	}
	
	// Loads allPartners view
	public function allPartners(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Partner::all();
		return view('admin.allPartners', ['partners' => $result]);
	}
	
	// Loads editPartner view
	public function editPartner($partnerId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Partner::where('id', $partnerId)
               ->get();
		return view('admin.editPartner', [
		'partners' => $result,
		'id' => $partnerId
		]);
	}
	
	// update partner in database & Redirect to editPartner page
	public function updatePartner(Request $request, $partnerId){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'companyName' => 'required',
        'logo' => 'image|mimes:png,jpg,jpeg|max:25',
		]);
		
		// Handle image upload 
		
		// Checks if the file exists. If exists upload new image, delete the previous image from directory and update database with new data
		if ($request->hasFile('logo')){
			// Get file name with extension
			$fileNameWithExt = $request->file('logo')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('logo')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('logo')->storeAs('public/images/partner', $fileNameToStore);
			
			// Find the Partner & assign form value then save to database
			$partner = Partner::find($partnerId);
			// Get logo & delete it from the directory
			Storage::delete('public/images/partner/'.$partner->logo);
			$partner->companyName = $request->companyName;
			$partner->logo = $fileNameToStore;
			$partner->save();
			
			/* Checks if data is saved to database. If so, redirect to editPartner page with success message. Otherwise, redirect to editPartner page with error message */
			if($partner){
				Session::put('success', 'Partner updated successfully.');
				return redirect('/editPartner/'.$partnerId);
			}else{
				Session::put('error', 'Partner update failed!');
				return redirect('/editPartner/'.$partnerId);
			}
		}
		
		// If image not selected update without editing the logo field
		else{
			// Find the Partner & assign form value then save to database
			$partner = Partner::find($partnerId);
			$partner->companyName = $request->companyName;
			$partner->save();
			
			
			/* Checks if data is saved to database. If so, redirect to editPartner page with success message. Otherwise, redirect to editPartner page with error message */
			if($partner){
				Session::put('success', 'Partner updated successfully.');
				return redirect('/editPartner/'.$partnerId);
			}else{
				Session::put('error', 'Partner update failed!');
				return redirect('/editPartner/'.$partnerId);
			}
		}
	}
	
	// Delete partner
	public function deletePartner($partnerId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		// Find the Partner 
		$result = Partner::find($partnerId);
		// Get logo & delete it from the directory
		Storage::delete('public/images/partner/'.$result->logo);
		$result->delete();
				
		if($result){
			Session::put('success', 'Partner deleted successfully.');
			return redirect('/all-partners');
		}else{
			Session::put('error', 'Partner delete failed!');
			return redirect('/all-partners');
		}
	}
}
