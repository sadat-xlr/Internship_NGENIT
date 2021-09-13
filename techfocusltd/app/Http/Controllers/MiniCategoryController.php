<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Subcategory;
use App\Category;
use App\Minicategory;
use Session;

class MiniCategoryController extends Controller
{
    // Get minicategories associated with subcategory 
	public function getMiniCat($subCatId){
		$miniCategories = Minicategory::where('subcategory_id', $subCatId)->pluck('miniCategoryName','id')->toArray();
		
		$data = "<option value=''>--Select Minicategory--</option>";
		foreach($miniCategories as $key => $miniCategories)
		{
			$data .= "<option value='$key'>$miniCategories</option>";
		}
		return $data;
	}
	
	// Loads addMiniCategory view 
	public function addMiniCategory(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		$result = Category::all();
		
		return view('admin.addMiniCategory', [
		'categories' => $result
		]);
	}	
	
	// Insert new miniCategory
	public function insertMiniCategory(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'miniCategoryName' => 'required'
		]);
		
		// Create instance of miniCategory model & assign form value then save to database
		$Minicategory = new Minicategory;
		$Minicategory->miniCategoryName = $request->miniCategoryName;
		$Minicategory->subcategory_id = $request->subcategory_id;
		$Minicategory->save();
		
		/* Checks if data is saved to database. If so, redirect to addMiniCategory page with success message. Otherwise, redirect to addMiniCategory page with error message */
		if($Minicategory){
			Session::put('success', 'Minicategory added successfully.');
			return redirect('/addMiniCategory');
		}else{
			Session::put('error', 'Minicategory addition failed!');
			return redirect('/addMiniCategory');
		}
	}
	
	// Loads allMiniCategories view 
	public function allMiniCategories(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Minicategory::all();
		return view('admin.allMiniCategories', ['miniCategories' => $result]);
	}
	
	// Loads editMiniCategory view
	public function editMiniCategory($miniCatId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$categories = Category::all();
		$result = Minicategory::where('id', $miniCatId)
               ->get();
		return view('admin.editMiniCategory', [
		'miniCategories' => $result,
		'categories' => $categories,
		'id' => $miniCatId
		]);
	}
	
	// Update Minicategory & loads editMiniCategory view with success or error message
	public function updateMiniCategory(Request $request, $miniCatId){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'miniCategoryName' => 'required'
		]);
		
		// Find the Minicategory & assign form value then save to database
		$Minicategory = Minicategory::find($miniCatId);
		$Minicategory->miniCategoryName = $request->miniCategoryName;
		$Minicategory->subcategory_id = $request->subcategory_id;
		$Minicategory->save();
		
		/* Checks if data is saved to database. If so, redirect to editMiniCategory page with success message. Otherwise, redirect to editMiniCategory page with error message */
		if($Minicategory){
			Session::put('success', 'Minicategory updated successfully.');
			return redirect('/editMiniCategory/'.$miniCatId);
		}else{
			Session::put('error', 'Minicategory update failed!');
			return redirect('/editMiniCategory/'.$miniCatId);
		}	
	}
	
	// Delete deleteMiniCategory
	public function deleteMiniCategory($miniCatId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Minicategory::find($miniCatId)->delete();
				
		if($result){
			Session::put('success', 'Minicategory deleted successfully.');
			return redirect('/all-miniCategories');
		}else{
			Session::put('error', 'Minicategory deletion failed!');
			return redirect('/all-miniCategories');
		}
	}
}
