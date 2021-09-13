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

class TechnologyController extends Controller
{
	// Loads addTechnology view 
	public function addTechnology(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.addTechnology');
	}		
	
	// Insert new Technology
	public function insertTechnology(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'technologyName' => 'required',
        'description' => 'required'
		]);
		
		// Create instance of Technology model & assign form value then save to database
		$Technology = new Technology;
		$Technology->technologyName = $request->technologyName;
		$Technology->description = $request->description;
		$Technology->save();
		
		/* Checks if data is saved to database. If so, redirect to addTechnology page with success message. Otherwise, redirect to addTechnology page with error message */
		if($Technology){
			Session::put('success', 'Technology added successfully.');
			return redirect('/addTechnology');
		}else{
			Session::put('error', 'Technology addition failed!');
			return redirect('/addTechnology');
		}
	}
	
	// Loads allTechnologies view 
	public function allTechnologies(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Technology::all();
		return view('admin.allTechnologies', ['technologies' => $result]);
	}
	
	// Loads editTechnology view
	public function editTechnology($TechnologyId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Technology::where('id', $TechnologyId)
               ->get();
		return view('admin.editTechnology', [
		'technologies' => $result,
		'id' => $TechnologyId
		]);
	}
	
	// Update Technology & loads editTechnology view with success or error message
	public function updateTechnology(Request $request, $TechnologyId){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'technologyName' => 'required',
		'description' => 'required'
		]);
		
		// Find the Technology model & assign form value then save to database
		$Technology = Technology::find($TechnologyId);
		$Technology->technologyName = $request->technologyName;
		$Technology->description = $request->description;
		$Technology->save();
		
		/* Checks if data is saved to database. If so, redirect to editTechnology page with success message. Otherwise, redirect to editTechnology page with error message */
		if($Technology){
			Session::put('success', 'Technology updated successfully.');
			return redirect('/editTechnology/'.$TechnologyId);
		}else{
			Session::put('error', 'Technology update failed!');
			return redirect('/editTechnology/'.$TechnologyId);
		}	
	}
	
	// Delete Technology
	public function deleteTechnology($TechnologyId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Technology::find($TechnologyId)->delete();
				
		if($result){
			Session::put('success', 'Technology deleted successfully.');
			return redirect('/all-technologies');
		}else{
			Session::put('error', 'Technology deletion failed!');
			return redirect('/all-technologies');
		}
	}
}
