<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Subcategory;
use App\Category;
use Session;
use Response;

class SubCategoryController extends Controller
{
    // Loads addSubCategory view 
	public function addSubCategory(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		$result = Category::all();
		
		return view('admin.addSubCategory', [
		'categories' => $result
		]);
	}

	// Get subcategories associated with category 
	public function getSubCat($catId){
		$subCategories = Subcategory::where('category_id', $catId)->pluck('categoryName','id')->toArray();
		
		$data = "<option value=''>--Select Subcategory--</option>";
		foreach($subCategories as $key => $subCategory)
		{
			$data .= "<option value='$key'>$subCategory</option>";
		}
		return $data;
	}	
	
	// Insert new SubCategory
	public function insertSubCategory(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'categoryName' => 'required'
		]);
		
		// Create instance of SubCategory model & assign form value then save to database
		$SubCategory = new Subcategory;
		$SubCategory->categoryName = $request->categoryName;
		$SubCategory->category_id = $request->category_id;
		$SubCategory->save();
		
		/* Checks if data is saved to database. If so, redirect to addSubCategory page with success message. Otherwise, redirect to addSubCategory page with error message */
		if($SubCategory){
			Session::put('success', 'SubCategory added successfully.');
			return redirect('/addSubCategory');
		}else{
			Session::put('error', 'SubCategory addition failed!');
			return redirect('/addSubCategory');
		}
	}
	
	// Loads allSubCategories view 
	public function allSubCategories(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Subcategory::all();
		return view('admin.allSubCategories', ['subCategories' => $result]);
	}
	
	// Loads editSubCategory view
	public function editSubCategory($SubCategoryId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$categories = Category::all();
		$result = Subcategory::where('id', $SubCategoryId)
               ->get();
		return view('admin.editSubCategory', [
		'subCategories' => $result,
		'categories' => $categories,
		'id' => $SubCategoryId
		]);
	}
	
	// Update SubCategory & loads editSubCategory view with success or error message
	public function updateSubCategory(Request $request, $SubCategoryId){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'categoryName' => 'required'
		]);
		
		// Create instance of SubCategory model & assign form value then save to database
		$SubCategory = Subcategory::find($SubCategoryId);
		$SubCategory->categoryName = $request->categoryName;
		$SubCategory->category_id = $request->category_id;
		$SubCategory->save();
		
		/* Checks if data is saved to database. If so, redirect to editSubCategory page with success message. Otherwise, redirect to editSubCategory page with error message */
		if($SubCategory){
			Session::put('success', 'SubCategory updated successfully.');
			return redirect('/editSubCategory/'.$SubCategoryId);
		}else{
			Session::put('error', 'SubCategory update failed!');
			return redirect('/editSubCategory/'.$SubCategoryId);
		}	
	}
	
	// Delete SubCategory
	public function deleteSubCategory($SubCategoryId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Subcategory::find($SubCategoryId)->delete();
				
		if($result){
			Session::put('success', 'SubCategory deleted successfully.');
			return redirect('/all-subCategories');
		}else{
			Session::put('error', 'SubCategory deletion failed!');
			return redirect('/all-subCategories');
		}
	}
}
