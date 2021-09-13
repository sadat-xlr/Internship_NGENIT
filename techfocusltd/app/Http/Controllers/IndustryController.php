<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Brand;
use App\Category;
use App\Product;
use App\Cart;
use App\Industry;
use App\Technology;
use Session;

class IndustryController extends Controller
{
	// Loads addIndustry view 
	public function addIndustry(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.addIndustry');
	}
	
	// Insert new Industry
	public function insertIndustry(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'industryName' => 'required'
		]);
		
		// Create instance of Industry model & assign form value then save to database
		$industry = new Industry;
		$industry->industryName = $request->industryName;
		$industry->save();
		
		/* Checks if data is saved to database. If so, redirect to addIndustry page with success message. Otherwise, redirect to addIndustry page with error message */
		if($industry){
			Session::put('success', 'Industry added successfully.');
			return redirect('/addIndustry');
		}else{
			Session::put('error', 'Industry addition failed!');
			return redirect('/addIndustry');
		}
	}
	
	// Loads allIndustries view 
	public function allIndustries(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Industry::all();
		return view('admin.allIndustries', ['industries' => $result]);
	}
	
	// Loads editIndustry view
	public function editIndustry($IndustryId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Industry::where('id', $IndustryId)
               ->get();
		return view('admin.editIndustry', [
		'industries' => $result,
		'id' => $IndustryId
		]);
	}
	
	// Update Industry & loads editIndustry view with success or error message
	public function updateIndustry(Request $request, $IndustryId){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'industryName' => 'required'
		]);
		
		// Create instance of Industry model & assign form value then save to database
		$Industry = Industry::find($IndustryId);
		$Industry->industryName = $request->industryName;
		$Industry->save();
		
		/* Checks if data is saved to database. If so, redirect to editIndustry page with success message. Otherwise, redirect to editIndustry page with error message */
		if($Industry){
			Session::put('success', 'Industry updated successfully.');
			return redirect('/editIndustry/'.$IndustryId);
		}else{
			Session::put('error', 'Industry update failed!');
			return redirect('/editIndustry/'.$IndustryId);
		}	
	}
	
	// Delete Industry
	public function deleteIndustry($IndustryId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Industry::find($IndustryId)->delete();
				
		if($result){
			Session::put('success', 'Industry deleted successfully.');
			return redirect('/all-industries');
		}else{
			Session::put('error', 'Industry deletion failed!');
			return redirect('/all-industries');
		}
	}
}
