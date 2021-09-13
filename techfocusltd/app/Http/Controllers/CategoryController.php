<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Brand;
use App\Cart;
use App\Industry;
use App\Technology;
use Session;

// Category Controller
class CategoryController extends Controller
{
	// Loads categories view
	public function index(){
		$result = Category::all();
		return view('categories', [
		'categories' => $result,
		]);
	}	
		
	// Loads addCategories view
	public function addCategories(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.addCategories');
	}
	
	// Insert new Category
	public function insertCategory(Request $request){
		// Validate form
		$validatedData = $this->validate($request, [
        'category' => 'required',
        'categoryImage' => 'required|image|mimes:png|max:25'
		]);
		
		$fileNameToStore = '';
		$imageFileNameToStore = '';
		
		// Handel image upload 
		
		// Checks if the file exists
		if ($request->hasFile('categoryImage2')){
			// Get file name with extension
			$fileNameWithExt = $request->file('categoryImage2')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('categoryImage2')->getClientOriginalExtension();
			// Filename to store 
			$imageFileNameToStore = $fileName . str_random(20) . "." . $extension;
			// Directory to upload
			$path = $request->file('categoryImage2')->storeAs('public/images/category', $imageFileNameToStore);    
		}

		// Checks if the file exists
		if ($request->hasFile('categoryImage')){
			// Get file name with extension
			$fileNameWithExt = $request->file('categoryImage')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('categoryImage')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . str_random(20) . "." . $extension;
			// Directory to upload
			$path = $request->file('categoryImage')->storeAs('public/images/icons/menu', $fileNameToStore);    
		}else{
			Session::put('error', 'Category addition failed!');
			return redirect('/addCategories');
		}

		// Create instance of Category model & assign form value then save to database
		$category = new Category;
		$category->categoryName = $request->category;
		$category->status = $request->status;
		$category->description = $request->description;
		//for extra image
		$category->categoryImage2 = $imageFileNameToStore;
		//for icon
		$category->categoryImage = $fileNameToStore;
		$category->save();
		
		
		/* Checks if data is saved to database. If so, redirect to addCategories page with success message. Otherwise, redirect to addCategories page with error message */
		if($category){
			Session::put('success', 'Category added successfully.');
			return redirect('/addCategories');
		}else{
			Session::put('error', 'Category addition failed!');
			return redirect('/addCategories');
		}
	}
		
	// Loads editCategory view
	public function editCategory($catId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Category::where('id', $catId)
               ->get();
		return view('admin.editCategories', [
		'categories' => $result,
		'id' => $catId
		]);
	}
	
	// Update catergory & loads editCategory view with success or error message
	public function updateCategory(Request $request, $catId){
		// Validate form
		$validatedData = $this->validate($request, [
        'category' => 'required',
        'categoryImage' => 'image|mimes:png|max:25'
		]);
				
		
		// Handel image upload 

		$fileNameToStore = '';
		$imageFileNameToStore = '';
		
		// Handel image upload 
		
		// Checks if the file exists
		if ($request->hasFile('categoryImage2')){
			// Get file name with extension
			$fileNameWithExt = $request->file('categoryImage2')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('categoryImage2')->getClientOriginalExtension();
			// Filename to store 
			$imageFileNameToStore = $fileName . str_random(20) . "." . $extension;
			// Directory to upload
			$path = $request->file('categoryImage2')->storeAs('public/images/category', $imageFileNameToStore);    
			// Find the Category 
			$category = Category::find($catId);
			// Get categoryImage & delete it from the directory
			Storage::delete('public/images/category/'.$category->categoryImage);
		}
		
		// Checks if the file exists. If exists upload new image and update database with new data
		if ($request->hasFile('categoryImage')){
			// Get file name with extension
			$fileNameWithExt = $request->file('categoryImage')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('categoryImage')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('categoryImage')->storeAs('public/images/icons/menu', $fileNameToStore);

			// Find the Category 
			$category = Category::find($catId);
			// Get categoryImage & delete it from the directory
			Storage::delete('public/images/icons/menu/'.$category->categoryImage);
			$category->categoryName = $request->category;
			$category->status = $request->status;
			$category->description = $request->description;
			$category->categoryImage = $fileNameToStore;
			$category->categoryImage2 = $imageFileNameToStore;
			$category->save();
				
			/* Checks if data is updated to database. If so, redirect to editCategory page with success message. Otherwise, redirect to editCategory page with error message */
			if($category){
				Session::put('success', 'Category updated successfully.');
				return redirect('/editCat/'.$catId);
			}else{
				Session::put('error', 'Category update failed!');
				return redirect('/editCat/'.$catId);
			}			
		}
		
		// If image not selected update without editing the categoryImage field
		else{
			// Create instance of Category model & assign form value then save to database
			$category = Category::find($catId);
			$category->categoryName = $request->category;
			$category->status = $request->status;
			$category->description = $request->description;

			if ($imageFileNameToStore != null) {
				$category->categoryImage2 = $imageFileNameToStore;
			}
			
			$category->save();
				
			/* Checks if data is updated to database. If so, redirect to editCategory page with success message. Otherwise, redirect to editCategory page with error message */
			if($category){
				Session::put('success', 'Category updated successfully.');
				return redirect('/editCat/'.$catId);
			}else{
				Session::put('error', 'Category update failed!');
				return redirect('/editCat/'.$catId);
			}
		}	
	}
	
	// Loads allCategories view
	public function allCategory(Request $request){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Category::all();
		return view('admin.allCategories', ['categories' => $result]);
	}
	
	// Delete category
	public function deleteCategory($catId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Category::find($catId);

		$result->featuredContent()->delete();
		// Get categoryImage & delete it from the directory
		Storage::delete('public/images/icons/menu/'.$result->categoryImage);
		$result->delete();
				
		if($result){
			Session::put('success', 'Category deleted successfully.');
			return redirect('/all-category');
		}else{
			Session::put('error', 'Category delete failed!');
			return redirect('/all-category');
		}
	}
}
