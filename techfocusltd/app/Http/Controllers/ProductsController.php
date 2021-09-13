<?php

namespace App\Http\Controllers;

use App\Color;
use App\Size;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Brand;
use App\Technology;
use App\Industry;
use App\Cart;
use App\Image;
use App\Techdesc;
use App\Siteinfo;
use App\Productcomment;
use App\Solution;
use App\Subsolution;
use Session;

// Products Controller
class ProductsController extends Controller
{
		// Product by category
		public function productsByCatInfo($catId, $subCatId = null, $miniCatId = null){
			//getcategory info 
			$category = Category::find($catId);
			// Get all colors
			$colors = Color::all();
	
			// Get all sizes
			$sizes = Size::all();
	
			// Get all tags
			$tags = Tag::all();
	
			$newProducts = Product::orderBy('id', 'desc')
					->take(36)
					->get();
			$categories = Category::all();
			$brands = Brand::all();
			
			if(isset($miniCatId)){
				$result = Product::where('minicategory_id', $miniCatId)->paginate(15);
				
				return view('informative.product.productsByCat', [
				'newProducts' => $newProducts,
				'products' => $result,
				'categories' => $categories,
				'miniCat' => $miniCatId,
				'brands' => $brands,
				'colors' => $colors,
				'sizes' => $sizes,
				'tags' => $tags,
				'category' => $category,
			]);
			}else if(isset($subCatId)){
				$result = Product::where('subcategory_id', $subCatId)->paginate(15);
				
				return view('informative.product.productsByCat', [
				'newProducts' => $newProducts,
				'products' => $result,
				'categories' => $categories,
				'subCat' => $subCatId,
				'brands' => $brands,
				'colors' => $colors,
				'sizes' => $sizes,
				'tags' => $tags,
				'category' => $category,
				]);
			}else{
				$result = Product::where('category_id', $catId)->paginate(15);
				
				return view('informative.product.productsByCat', [
				'newProducts' => $newProducts,
				'products' => $result,
				'categories' => $categories,
				'cat' => $catId,
				'brands' => $brands,
				'colors' => $colors,
				'sizes' => $sizes,
				'tags' => $tags,
				'category' => $category,
				]);
	
			}
		}
	
	
	//product deails in informative part
	public function productInfo($id, $slug){
		$product	=	Product::FindOrFail($id);
		return view('informative.product.details')->with('product',$product);
	}
	
	public function show($slug)
	{
		$post = Post::where('slug', $slug)->first();
	
		return view('post.show')->withPost($post);
	}

	
	// Loads products details view 
	public function productDetails($slug){
		// Get products & update view
		//$product = Product::find($productId);
		$product = Product::where('slug', $slug)->first();
        $product->increment('view');

        // Get related products
        $products = Product::where('slug', '!=', $slug)->where('minicategory_id', $product->minicategory_id)->get();
		
		return view('details', [
			'product' => $product,
			'products' => $products,
			'productId' => $slug,
		]);
	}	
	
	// Loads addProduct view 
	public function addProduct(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$solutions	=	Solution::all();
		$subSolution =	Subsolution::all();
		$categories = Category::all();
		$brands = Brand::all();
		$technologies = Technology::all();
		$industries = Industry::all();

        // Get all colors
        $colors = Color::all();

        // Get all sizes
        $sizes = Size::all();

        // Get all tags
        $tags = Tag::all();

		return view('admin.addProduct', compact('solutions','subSolution','categories', 'brands', 'technologies', 'industries', 'colors', 'sizes', 'tags'));
	}
	
	// Add a new product in database & Redirect to addProduct page
	public function insertProduct(Request $request){

		// Validate form data 
		$validatedData = $this->validate($request, [
        'productName' => 'required',
        'slug' => 'required',
		'sku' => 'required',
		'shortDescription' => 'required',
		'description' => 'required',
		'category_id' => 'required',
		'subcategory_id' => 'required',
		'minicategory_id' => 'required',
        'image1' => 'required|image|mimes:png,jpg,jpeg',
        'image2' => 'image|mimes:png,jpg,jpeg',
        'image3' => 'image|mimes:png,jpg,jpeg',
        'image4' => 'image|mimes:png,jpg,jpeg',
        'image5' => 'image|mimes:png,jpg,jpeg',
        'image6' => 'image|mimes:png,jpg,jpeg',
        'image7' => 'image|mimes:png,jpg,jpeg',
        'image8' => 'image|mimes:png,jpg,jpeg',
		]);
		
		// Create instance of Product model & assign form value then save to database
		$product = new Product;
		$product->productName = $request->productName;
		$product->slug = str_slug($request->slug);
		$product->sku = $request->sku;
		$product->solution_id	=	$request->solution_id;
		if (is_numeric($request->subSolution_id)){
			$product->subSolution_id	=	$request->subSolution_id;
		}
		$product->category_id = $request->category_id;
		$product->subcategory_id = $request->subcategory_id;
		$product->minicategory_id = $request->minicategory_id;
		$product->industry_id = $request->industry_id;
		$product->technology_id = $request->technology_id;
		$product->brand_id = $request->brand_id;
		$product->shortDescription = $request->shortDescription;
		$product->description = $request->description;
		$product->specification = $request->specification;
		$product->regularPrice = $request->regularPrice;
		$product->price = $request->price;
		$product->type = $request->type;
		$product->availablity = $request->availablity;



		$product->save();

        // Check if color is set
        if (isset($request->color)) {
            // Loop over selected colors
            foreach ($request->color as $value) {
                // Save to pivot table
                $product->colors()->attach($value);
            }
        }

        // Check if size is set
        if (isset($request->size)) {
            // Loop over selected sizes
            foreach ($request->size as $value) {
                // Save to pivot table
                $product->sizes()->attach($value);
            }
        }

        // Check if tag is set
        if (isset($request->tag)) {
            // Loop over selected tags
            foreach ($request->tag as $value) {
                // Save to pivot table
                $product->tags()->attach($value);
            }
        }
		
		// Create instance of Image model & assign form value then save to database
		$image = new Image;
		$image->product_id = $product->id;
		
		// Handle image upload 
		
		// Checks if the file exists
		if ($request->hasFile('image1')){
			// Get file name with extension
			$fileNameWithExt = $request->file('image1')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('image1')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore1 = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('image1')->storeAs('public/images/product', $fileNameToStore1);
			$image->image1 = $fileNameToStore1;
		}else{
			Session::put('error', 'Product addition failed!');
			return redirect('/addProduct');
		}
		
		// Checks if the file exists
		if ($request->hasFile('image2')){
			// Get file name with extension
			$fileNameWithExt = $request->file('image2')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('image2')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore2 = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('image2')->storeAs('public/images/product', $fileNameToStore2);
			$image->image2 = $fileNameToStore2;
		}
		
		// Checks if the file exists
		if ($request->hasFile('image3')){
			// Get file name with extension
			$fileNameWithExt = $request->file('image3')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('image3')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore3 = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('image3')->storeAs('public/images/product', $fileNameToStore3);
			$image->image3 = $fileNameToStore3;
		}
		
		// Checks if the file exists
		if ($request->hasFile('image4')){
			// Get file name with extension
			$fileNameWithExt = $request->file('image4')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('image4')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore4 = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('image4')->storeAs('public/images/product', $fileNameToStore4);
			$image->image4 = $fileNameToStore4;
		}
		
		// Checks if the file exists
		if ($request->hasFile('image5')){
			// Get file name with extension
			$fileNameWithExt = $request->file('image5')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('image5')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore5 = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('image5')->storeAs('public/images/product', $fileNameToStore5);
			$image->image5 = $fileNameToStore5;
		}
		
		// Checks if the file exists
		if ($request->hasFile('image6')){
			// Get file name with extension
			$fileNameWithExt = $request->file('image6')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('image6')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore6 = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('image6')->storeAs('public/images/product', $fileNameToStore6);  
			$image->image6 = $fileNameToStore6;
		}
		
		// Checks if the file exists
		if ($request->hasFile('image7')){
			// Get file name with extension
			$fileNameWithExt = $request->file('image7')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('image7')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore7 = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('image7')->storeAs('public/images/product', $fileNameToStore7);  
			$image->image7 = $fileNameToStore7;
		}
		
		// Checks if the file exists
		if ($request->hasFile('image8')){
			// Get file name with extension
			$fileNameWithExt = $request->file('image8')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('image8')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore8 = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('image8')->storeAs('public/images/product', $fileNameToStore8);  
			$image->image8 = $fileNameToStore8;
		}
						
		$image->save();
		
		/* Checks if data is saved to database. If so, redirect to addUser page with success message. Otherwise, redirect to addUser page with error message */
		if($image){
			Session::put('success', 'Product added successfully!');
			return redirect('/addProduct');
		}else{
			Session::put('error', 'Product addition failed!');
			return redirect('/addProduct');
		}	
	}
	
	// Loads allProducts view
	public function allProducts(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$products = Product::all();
	
		return view('admin.allProducts', [
		'products' => $products
		]);
	}
	
	// Loads editProduct view
	public function editProduct($productId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$product = Product::find($productId);
		$solutions	=	Solution::all();
		$categories = Category::all();
		$brands = Brand::all();
		$technologies = Technology::all();
		$industries = Industry::all();

        // Get all colors
        $colors = Color::all();

        // Get all sizes
        $sizes = Size::all();

        // Get all tags
        $tags = Tag::all();

		return view('admin.editProduct', compact('product','solutions', 'categories', 'brands', 'technologies', 'industries', 'colors', 'sizes', 'tags'));
	}
	
	// Update Product & loads editProduct view with success or error message
	public function updateProduct(Request $request, $productId){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'productName' => 'required',
        'slug' => 'required',
		'sku' => 'required',
       // 'shortDescription' => 'required',
		'description' => 'required',
		'image1' => 'image|mimes:png,jpg,jpeg',
        'image2' => 'image|mimes:png,jpg,jpeg',
        'image3' => 'image|mimes:png,jpg,jpeg',
        'image4' => 'image|mimes:png,jpg,jpeg',
        'image5' => 'image|mimes:png,jpg,jpeg',
        'image6' => 'image|mimes:png,jpg,jpeg',
        'image7' => 'image|mimes:png,jpg,jpeg',
        'image8' => 'image|mimes:png,jpg,jpeg',
		]);

        // Find the product & assign form value then save to database
        $product = Product::find($productId);
        $product->productName = $request->productName;
		$product->slug = str_slug($request->slug);
		$product->sku = $request->sku;
		$product->solution_id	=	$request->solution_id;
		$product->subSolution_id	=	$request->subSolution_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->minicategory_id = $request->minicategory_id;
        $product->industry_id = $request->industry_id;
        $product->technology_id = $request->technology_id;
        $product->brand_id = $request->brand_id;
       // $product->shortDescription = $request->shortDescription;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->regularPrice = $request->regularPrice;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->availablity = $request->availablity;
        $product->save();

        // Detach previous color, tag & size
        $product->colors()->detach();
        $product->sizes()->detach();
        $product->tags()->detach();

        // Check if color is set
        if (isset($request->color)) {
            // Loop over checked values
            foreach ($request->color as $value) {
                // Update with new values
                $product->colors()->attach($value);
            }
        }

        // Check if size is set
        if (isset($request->size)) {
            // Loop over checked values
            foreach ($request->size as $value) {
                // Update with new values
                $product->sizes()->attach($value);
            }
        }

        // Check if tag is set
        if (isset($request->tag)) {
            // Loop over checked values
            foreach ($request->tag as $value) {
                // Update with new values
                $product->tags()->attach($value);
            }
        }
						
		// Handle image upload 
		
		// Checks if the file exists. If exists upload new image, delete the previous image from directory and update database with new data
		if ($request->hasFile('image1') || $request->hasFile('image2') || $request->hasFile('image3') || $request->hasFile('image4') || $request->hasFile('image5') || $request->hasFile('image6')){
			// Get the images associated with the product 
			$images = Image::where('product_id', $productId)->first();
			
			// Checks if the file exists
			if ($request->hasFile('image1')){
				// Get file name with extension
				$fileNameWithExt = $request->file('image1')->getClientOriginalName();
				// Get only file name
				$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
				// Get only extension
				$extension = $request->file('image1')->getClientOriginalExtension();
				// Filename to store 
				$fileNameToStore1 = $fileName . time() . "." . $extension;
				// Directory to upload
				$path = $request->file('image1')->storeAs('public/images/product', $fileNameToStore1);
				
				// Delete image from the directory 
				Storage::delete('public/images/product/'.$images->image1);
				
				// Update database
				$images->image1 = $fileNameToStore1;
			}
			
			// Checks if the file exists
			if ($request->hasFile('image2')){
				// Get file name with extension
				$fileNameWithExt = $request->file('image2')->getClientOriginalName();
				// Get only file name
				$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
				// Get only extension
				$extension = $request->file('image2')->getClientOriginalExtension();
				// Filename to store 
				$fileNameToStore2 = $fileName . time() . "." . $extension;
				// Directory to upload
				$path = $request->file('image2')->storeAs('public/images/product', $fileNameToStore2);

				// Checks if file exists
				if (!is_null($images->image2)){
					// Delete image from the directory 
					Storage::delete('public/images/product/'.$images->image2);
				}
								
				// Update database
				$images->image2 = $fileNameToStore2;
			}
			
			// Checks if the file exists
			if ($request->hasFile('image3')){
				// Get file name with extension
				$fileNameWithExt = $request->file('image3')->getClientOriginalName();
				// Get only file name
				$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
				// Get only extension
				$extension = $request->file('image3')->getClientOriginalExtension();
				// Filename to store 
				$fileNameToStore3 = $fileName . time() . "." . $extension;
				// Directory to upload
				$path = $request->file('image3')->storeAs('public/images/product', $fileNameToStore3);

				// Checks if file exists
				if (!is_null($images->image3)){
					// Delete image from the directory 
					Storage::delete('public/images/product/'.$images->image3);
				}
				
				// Update database
				$images->image3 = $fileNameToStore3;
			}
			
			// Checks if the file exists
			if ($request->hasFile('image4')){
				// Get file name with extension
				$fileNameWithExt = $request->file('image4')->getClientOriginalName();
				// Get only file name
				$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
				// Get only extension
				$extension = $request->file('image4')->getClientOriginalExtension();
				// Filename to store 
				$fileNameToStore4 = $fileName . time() . "." . $extension;
				// Directory to upload
				$path = $request->file('image4')->storeAs('public/images/product', $fileNameToStore4);

				// Checks if file exists
				if (!is_null($images->image4)){
					// Delete image from the directory 
					Storage::delete('public/images/product/'.$images->image4);
				}
				
				// Update database
				$images->image4 = $fileNameToStore4;
			}
			
			// Checks if the file exists
			if ($request->hasFile('image5')){
				// Get file name with extension
				$fileNameWithExt = $request->file('image5')->getClientOriginalName();
				// Get only file name
				$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
				// Get only extension
				$extension = $request->file('image5')->getClientOriginalExtension();
				// Filename to store 
				$fileNameToStore5 = $fileName . time() . "." . $extension;
				// Directory to upload
				$path = $request->file('image5')->storeAs('public/images/product', $fileNameToStore5);

				// Checks if file exists
				if (!is_null($images->image5)){
					// Delete image from the directory 
					Storage::delete('public/images/product/'.$images->image5);
				}
				
				// Update database
				$images->image5 = $fileNameToStore5;
			}
			
			// Checks if the file exists
			if ($request->hasFile('image6')){
				// Get file name with extension
				$fileNameWithExt = $request->file('image6')->getClientOriginalName();
				// Get only file name
				$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
				// Get only extension
				$extension = $request->file('image6')->getClientOriginalExtension();
				// Filename to store 
				$fileNameToStore6 = $fileName . time() . "." . $extension;
				// Directory to upload
				$path = $request->file('image6')->storeAs('public/images/product', $fileNameToStore6);

				// Checks if file exists
				if (!is_null($images->image6)){
					// Delete image from the directory 
					Storage::delete('public/images/product/'.$images->image6);
				}
				
				// Update database
				$images->image6 = $fileNameToStore6;
			}
			
			// Checks if the file exists
			if ($request->hasFile('image7')){
				// Get file name with extension
				$fileNameWithExt = $request->file('image7')->getClientOriginalName();
				// Get only file name
				$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
				// Get only extension
				$extension = $request->file('image7')->getClientOriginalExtension();
				// Filename to store 
				$fileNameToStore7 = $fileName . time() . "." . $extension;
				// Directory to upload
				$path = $request->file('image7')->storeAs('public/images/product', $fileNameToStore7);

				// Checks if file exists
				if (!is_null($images->image7)){
					// Delete image from the directory 
					Storage::delete('public/images/product/'.$images->image7);
				}
				
				// Update database
				$images->image7 = $fileNameToStore7;
			}
			
			// Checks if the file exists
			if ($request->hasFile('image8')){
				// Get file name with extension
				$fileNameWithExt = $request->file('image8')->getClientOriginalName();
				// Get only file name
				$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
				// Get only extension
				$extension = $request->file('image8')->getClientOriginalExtension();
				// Filename to store 
				$fileNameToStore8 = $fileName . time() . "." . $extension;
				// Directory to upload
				$path = $request->file('image8')->storeAs('public/images/product', $fileNameToStore8);

				// Checks if file exists
				if (!is_null($images->image8)){
					// Delete image from the directory 
					Storage::delete('public/images/product/'.$images->image8);
				}
				
				// Update database
				$images->image8 = $fileNameToStore8;
			}

			// Update images
			$images->save();
		}

        // Checks if product added
        if($product){
            Session::put('success', 'Product updated successfully.');
            return redirect('/editProduct/'.$productId);
        }else{
            Session::put('error', 'Product update failed.');
            return redirect('/editProduct/'.$productId);
        }
	}
	
	// Delete Product
	public function deleteProduct($productId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return Redirect::to('/administration');
		}
		
		// Get the images associated with the product 
		$images = Image::where('product_id', $productId)->first();
		
		// Delete images from the directory & then from database
		Storage::delete('public/images/product/'.$images->image1);
		
		// Checks if file exists
		if (!is_null($images->image2)){
			// Delete image from the directory 
			Storage::delete('public/images/product/'.$images->image2);
		}
		
		// Checks if file exists
		if (!is_null($images->image3)){
			// Delete image from the directory 
			Storage::delete('public/images/product/'.$images->image3);
		}
		
		// Checks if file exists
		if (!is_null($images->image4)){
			// Delete image from the directory 
			Storage::delete('public/images/product/'.$images->image4);
		}
		
		// Checks if file exists
		if (!is_null($images->image5)){
			// Delete image from the directory 
			Storage::delete('public/images/product/'.$images->image5);
		}
		
		// Checks if file exists
		if (!is_null($images->image6)){
			// Delete image from the directory 
			Storage::delete('public/images/product/'.$images->image6);
		}
		
		// Checks if file exists
		if (!is_null($images->image7)){
			// Delete image from the directory 
			Storage::delete('public/images/product/'.$images->image7);
		}
		
		// Checks if file exists
		if (!is_null($images->image8)){
			// Delete image from the directory 
			Storage::delete('public/images/product/'.$images->image8);
		}
		
		// Delete from database
		$images->delete();
		
		// Get the product $ delete it 
		$product = Product::find($productId);

        // Detach previous color & size $ tag
        $product->colors()->detach();
        $product->sizes()->detach();
        $product->tags()->detach();

        $product->delete();
				
		if($product){
			Session::put('success', 'Product deleted successfully.');
			return redirect('/all-products');
		}else{
			Session::put('error', 'Product delete failed!');
			return redirect('/all-products');
		}
	}
	
	// Product by brand
	public function productsByBrand($brandId){
        // Get all colors
        $colors = Color::all();

        // Get all sizes
        $sizes = Size::all();

        // Get all tags
        $tags = Tag::all();

		$result = Product::where('brand_id', $brandId)
               ->get();
		$newProducts = Product::orderBy('id', 'desc')
                ->take(36)
				->get();
		$brands = Brand::all();
			   
		return view('productsByBrand', [
		'newProducts' => $newProducts,
		'products' => $result,
		'brands' => $brands,
		'id' => $brandId,
		'colors' => $colors,
		'sizes' => $sizes,
		'tags' => $tags,
		]);
	}

	// Product by category
	public function productsByAjax(Request $request){

		

		if($request->ajax()){
			$result = Product::with(['image', 'category'])->where('subcategory_id', $request->subcat_id)
				->inRandomOrder()->take(6)->get();
			return response()->json($result);
		}
		
	}
	


	
	// Product by category
	public function productsByCat($catId, $subCatId = null, $miniCatId = null){
        // Get all colors
        $colors = Color::all();

        // Get all sizes
        $sizes = Size::all();

        // Get all tags
        $tags = Tag::all();

		$newProducts = Product::orderBy('id', 'desc')
                ->take(36)
				->get();
		$categories = Category::all();
		$brands = Brand::all();
		
		if(isset($miniCatId)){
			$result = Product::where('minicategory_id', $miniCatId)
					->get();
			
			return view('productsByCat', [
			'newProducts' => $newProducts,
			'products' => $result,
			'categories' => $categories,
			'miniCat' => $miniCatId,
			'brands' => $brands,
            'colors' => $colors,
            'sizes' => $sizes,
            'tags' => $tags,
		]);
		}else if(isset($subCatId)){
			$result = Product::where('subcategory_id', $subCatId)
					->get();
			
			return view('productsByCat', [
			'newProducts' => $newProducts,
			'products' => $result,
			'categories' => $categories,
			'subCat' => $subCatId,
			'brands' => $brands,
            'colors' => $colors,
            'sizes' => $sizes,
            'tags' => $tags,
			]);
		}else{
			$result = Product::where('category_id', $catId)->get();
			
			return view('productsByCat', [
			'newProducts' => $newProducts,
			'products' => $result,
			'categories' => $categories,
			'cat' => $catId,
			'brands' => $brands,
            'colors' => $colors,
            'sizes' => $sizes,
            'tags' => $tags,
			]);

		}
	}
	
	// Product by technology
	public function productsByTech($techId){
        // Get all colors
        $colors = Color::all();

        // Get all sizes
        $sizes = Size::all();

        // Get all tags
        $tags = Tag::all();

		$result = Product::where('technology_id', $techId)
               ->get();
		$newProducts = Product::orderBy('id', 'desc')
                ->take(36)
				->get();
		$brands = Brand::all();
		$technologies = Technology::all();
		$technology = Technology::find($techId);
			   
		return view('productsByTech', [
		'newProducts' => $newProducts,
		'products' => $result,
		'brands' => $brands,
		'technology' => $technology,
		'technologies' => $technologies,
        'colors' => $colors,
        'sizes' => $sizes,
        'tags' => $tags,
		]);
	}

    // Product by technology
    public function productsByTechnology(){
        $technologies = Technology::all();

        return view('productsByTechnology', [
            'technologies' => $technologies
        ]);
    }
	
	// Product by industry
	public function productsByInd($industryId, $catId = null){
        // Get all colors
        $colors = Color::all();

        // Get all sizes
        $sizes = Size::all();

        // Get all tags
        $tags = Tag::all();

		if(isset($catId)){
			$result = Product::where('category_id', $catId)
					->where('industry_id', $industryId)
					->get();
		}else{
			$result = Product::where('industry_id', $industryId)
					->get();
		}
		
		$newProducts = Product::orderBy('id', 'desc')
                ->take(36)
				->get();
        $industries = Industry::all();
		$brands = Brand::all();
		$industry = Industry::find($industryId);
			   
		return view('productsByInd', [
		'newProducts' => $newProducts,
		'products' => $result,
		'industries' => $industries,
		'brands' => $brands,
		'industry' => $industry,
        'colors' => $colors,
        'sizes' => $sizes,
        'tags' => $tags,
		]);
	}

    // Product by industry
    public function productsByIndustry(){
        // Get all colors
        $colors = Color::all();

        // Get all sizes
        $sizes = Size::all();

        // Get all tags
        $tags = Tag::all();

        $newProducts = Product::orderBy('id', 'desc')
            ->take(36)
            ->get();
        $industries = Industry::all();
        $brands = Brand::all();
        // Get all products
        $products = Product::orderBy('id', 'desc')
            ->get();

        return view('productsByIndustry', [
            'newProducts' => $newProducts,
            'industries' => $industries,
            'brands' => $brands,
            'products' => $products,
            'colors' => $colors,
            'sizes' => $sizes,
            'tags' => $tags,
        ]);
    }
	
	// Product by search
	public function getSearchedProduct(Request $request){
        // Get all colors
        $colors = Color::all();

        // Get all sizes
        $sizes = Size::all();

        // Get all tags
        $tags = Tag::all();

		$newProducts = Product::orderBy('id', 'desc')
                ->take(36)
				->get();
		$categories = Category::all();
		$brands = Brand::all();
		$products = Product::where('productName', 'like', '%' . $request->search . '%')->get();
				
		return view('getSearchedProduct', [
		'newProducts' => $newProducts,
		'categories' => $categories,
		'brands' => $brands,
        'colors' => $colors,
        'sizes' => $sizes,
        'tags' => $tags,
		'products' => $products
		]);
	}

	// Add product review
	public function addReview($proId, Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'UserName' => 'required',
		'email' => 'required|email',
		'comment' => 'required',
		]);

		// Create a new Productcomment instance & assign form value then save to database
		$productcomment = new Productcomment;
		$productcomment->UserName = $request->UserName;
		$productcomment->email = $request->email;
		$productcomment->comment = $request->comment;
		$productcomment->productReview = $request->optradio;
		$productcomment->slug = $proId;
		$productcomment->save();

		// Check insertion
		if($productcomment){
			return redirect()->back()->with('success', "Thanks for your review.");
		}else{
			return redirect()->back()->with('error', "Couldn't add review!");
		}
	}

	// Get product give response using Ajax for search suggetion 
	public function getProduct($key){
		$products = Product::with('image')->where('productName', 'like', '%' . $key . '%')->get(['id','slug', 'productName', 'price', 'regularPrice']);

		return response()->json($products);
	}
}
