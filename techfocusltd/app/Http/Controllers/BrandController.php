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

// Brand Controller
class BrandController extends Controller
{
	// Loads brands view 
	public function index(){
		$brands = Brand::all();
		return view('brands', [
		'brands' => $brands,
		]);
	}
	
	// Loads addBrands view 
	public function addBrands(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.addBrands');
	}
	
	// Add a new brand and redirect to addBrands view 
	public function insertBrands(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
		'brandName' => 'required',
		'brandLogo'	=> 'required|image|mimes:png,jpg,jpeg|max:1999'
		
		]);

		// Handel image upload 
		// Checks if the file exists
		if ($request->hasFile('brandLogo')){
			// Get file name with extension
			$fileNameWithExt = $request->file('brandLogo')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('brandLogo')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . str_random(20) . "." . $extension;
			// Directory to upload
			$path = $request->file('brandLogo')->storeAs('public/images/brand/logo', $fileNameToStore);    
		}else{
			Session::put('error', 'Brand addition failed!');
			return redirect('/addBrands');
		}

		
		// Create instance of Brand model & assign form value then save to database
		$brand = new Brand;
		$brand->brandName = $request->brandName;
		$brand->image = $fileNameToStore;
		$brand->save();
		
		/* Checks if data is saved to database. If so, redirect to addBrands page with success message. Otherwise, redirect to addBrands page with error message */
		if($brand){
			Session::put('success', 'Brand added successfully.');
			return redirect('/addBrands');
		}else{
			Session::put('error', 'Brand addition failed!');
			return redirect('/addBrands');
		}
	}
	
	// Loads allBrands view 
	public function allBrands(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Brand::all();
		return view('admin.allBrands', ['brands' => $result]);
	}
	
	// Loads editBrand view
	public function editBrand($brandId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Brand::where('id', $brandId)
               ->get();
		return view('admin.editBrand', [
		'brands' => $result,
		'id' => $brandId
		]);
	}
	
	// Update Brand & loads editBrand view with success or error message
	public function updateBrand(Request $request, $brandId){
		// Validate form data 
		$validatedData = $this->validate($request, [
		'brandName' => 'required',
		// 'brandLogo'	=> 'required|image|mimes:png,jpg,jpeg|max:1999'

		]);

		// Handel image upload 
		// Checks if the file exists
		if ($request->hasFile('brandLogo')){
			// Get file name with extension
			$fileNameWithExt = $request->file('brandLogo')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('brandLogo')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . str_random(20) . "." . $extension;
			// Directory to upload
			$path = $request->file('brandLogo')->storeAs('public/images/brand/logo', $fileNameToStore);  

			// Create instance of Brand model & assign form value then save to database
			$brand = Brand::find($brandId);
			Storage::delete('public/images/brand/logo/'.$brand->image);

			$brand->brandName = $request->brandName;
			$brand->image = $fileNameToStore;
			$brand->save();
			
			/* Checks if data is saved to database. If so, redirect to editBrand page with success message. Otherwise, redirect to editBrand page with error message */
			if($brand){
				Session::put('success', 'Brand updated successfully.');
				return redirect('editBrand/'.$brandId);
			}else{
				Session::put('error', 'Brand update failed!');
				return redirect('editBrand/'.$brandId);
			}

		}else{
			// Create instance of Brand model & assign form value then save to database
			$brand = Brand::find($brandId);
			$brand->brandName = $request->brandName;
			$brand->save();
			
			/* Checks if data is saved to database. If so, redirect to editBrand page with success message. Otherwise, redirect to editBrand page with error message */
			if($brand){
				Session::put('success', 'Brand updated successfully.');
				return redirect('editBrand/'.$brandId);
			}else{
				Session::put('error', 'Brand update failed!');
				return redirect('editBrand/'.$brandId);
			}	
		}
		
	}
	
	// Delete Brand
	public function deleteBrand($brandId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Brand::find($brandId)->delete();
				
		if($result){
			Session::put('success', 'Brand deleted successfully.');
			return redirect('/all-brands');
		}else{
			Session::put('error', 'Brand deletion failed!');
			return redirect('/all-brands');
		}
	}	
}
