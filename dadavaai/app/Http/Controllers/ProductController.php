<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Color;
use App\Product;
use App\Size;
use App\Tag;
use App\Deal;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Validator;
use Response;


class ProductController extends Controller
{

    public function requestedProduct()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();
        $tags = Tag::all();
        $deals = Deal::all();

        $products = Product::where('published', true)->orderByDesc('id')->get();
        return view('admin.requestedProducts', compact('deals', 'tags', 'brands', 'colors', 'sizes', 'categories', 'products'));
    }

    public function publishProduct(Request $request, $id)
    {

        $product = Product::find($id);
        $product->published = false;
        $product->save();
        

        return response()->json($product);
    }


    //find product by Price Range
    public function brandProductSortByPriceRange(Request $request){

        // $products = Product::whereBetween('regularPrice', [$request->min_price, $request->max_price]);
        
        $products = Product::whereBetween('regularPrice', [$request->min_price, $request->max_price])
                            ->where('published', false)
                            ->where('brand_id', $request->brandId)->paginate(9);
        // return $products;
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        $brand = Brand::find($request->brandId);
        return view('client.product.singleBrand', compact('categories', 'sizes', 'colors', 'brand', 'products'));

    }
    


    //Brand product sort by ajax call
    public function brandProductSort($type, $brandId){

        $products = '';
        if ($type == 'date') {
            $products = Product::with(['image', 'deal'])
                                ->where('brand_id', $brandId)
                                ->orderBy('created_at', 'desc')
                                ->where('published', false)
                                ->get();
        }

        if ($type == 'price') {
            $products = Product::with(['image', 'deal'])
                                ->where('published', false)
                                ->where('brand_id', $brandId)
                                ->orderBy('regularPrice', 'asc')
                                ->get();
        }

        if ($type == 'price-desc') {
            $products = Product::with(['image', 'deal'])
                                ->where('published', false)
                                ->where('brand_id', $brandId)
                                ->orderBy('regularPrice', 'desc')
                                ->get();
        }

        return response()->json($products);

    }

    //find product by Size for single brand
    public function singleBrandProductSortBySize($sizeId, $brandId){

        $size = Size::find($sizeId); 
        $products = [];
        $image = [];
        $deal = [];
        foreach($size->products as $key => $product){
            
            if ($product->brand_id == $brandId) {
                $products[$key] = [$product];
                $image[$product->id] = $product->image;
                $deal = $product->deal;
            }
        }

        return response()->json($products);
    }

    //find product by color for single brand
    public function singleBrandProductSortByColor($colorId , $brandId){

        $color = Color::find($colorId); 
        $products = [];
        $image = [];
        $deal = [];
        foreach($color->products as $key => $product){
            if($product->brand_id == $brandId){
                $products[$key] = [$product];
                // $products[$key]['image'] =  $product->image; 
                $image[$product->id] = $product->image;
                $deal = $product->deal;
            }
        }

        return response()->json($products);
    }


    //find product by Size for single category
    public function singleCategoryProductSortBySize($sizeId, $categoryId){

        $size = Size::find($sizeId); 
        $products = [];
        $image = [];
        $deal = [];
        foreach($size->products as $key => $product){
            
            if ($product->category_id == $categoryId) {
                $products[$key] = [$product];
                $image[$product->id] = $product->image;
                $deal = $product->deal;
            }
        }

        return response()->json($products);
    }

    //find product by color for single category
    public function singleCategoryProductSortByColor($colorId , $categoryId){

        $color = Color::find($colorId); 
        $products = [];
        $image = [];
        $deal = [];
        foreach($color->products as $key => $product){
            if($product->category_id == $categoryId){
                $products[$key] = [$product];
                // $products[$key]['image'] =  $product->image; 
                $image[$product->id] = $product->image;
                $deal = $product->deal;
            }
        }

        return response()->json($products);
    }

    //singlecategory product sort by ajax call
    public function categoryProductSort(Request $request, $type){


        $products = '';
        if ($type == 'date') {
            $products = Product::with(['image', 'deal'])
                                ->where('published', false)
                                ->where('category_id', $request->categoryId)
                                ->orderBy('created_at', 'desc')
                                ->get();
        }

        if ($type == 'price') {
            $products = Product::with(['image', 'deal'])
                                ->where('published', false)
                                ->where('category_id', $request->categoryId)
                                ->orderBy('regularPrice', 'asc')
                                ->get();
        }

        if ($type == 'price-desc') {
            $products = Product::with(['image', 'deal'])
                                ->where('published', false)
                                ->where('category_id', $request->categoryId)
                                ->orderBy('regularPrice', 'desc')
                                ->get();
        }

        return response()->json($products);

    }

    //minicategory product sort by ajax call
    public function minicategoryProductSort(Request $request, $type){


        $products = '';
        if ($type == 'date') {
            $products = Product::with(['image', 'deal'])
                                ->where('published', false)
                                ->where('minicategory_id', $request->minicategoryId)
                                ->orderBy('created_at', 'desc')
                                ->get();
        }

        if ($type == 'price') {
            $products = Product::with(['image', 'deal'])
                                ->where('published', false)
                                ->where('minicategory_id', $request->minicategoryId)
                                ->orderBy('regularPrice', 'asc')
                                ->get();
        }

        if ($type == 'price-desc') {
            $products = Product::with(['image', 'deal'])
                                ->where('published', false)
                                ->where('minicategory_id', $request->minicategoryId)
                                ->orderBy('regularPrice', 'desc')
                                ->get();
        }

        return response()->json($products);

    }


    //find product by Price Range
    public function productSortByPriceRange(Request $request){

        // $products = Product::whereBetween('regularPrice', [$request->min_price, $request->max_price]);
        
        $products = Product::whereBetween('regularPrice', [$request->min_price, $request->max_price])
                            ->where('published', false)
                            ->paginate(9);
        // return $products;
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('client.product.allCategory', compact('categories', 'sizes', 'colors', 'products'));

    }
    
    //find product by Size
    public function productSortBySize($miniCatId, $sizeId){

        $size = Size::find($sizeId); 
        $products = [];
        $image = [];
        $deal = [];
        foreach($size->products as $key => $product){
            if ($product->minicategory_id == $miniCatId) {
                # code...
                $products[$key] = [$product];
                $image[$product->id] = $product->image;
                $deal = $product->deal;
            }
        }

        return response()->json($products);
    }
    
    //find product by color
    public function productSortByColor($miniCatId, $colorId){

        $color = Color::find($colorId); 
        $products = [];
        $image = [];
        $deal = [];
        foreach($color->products as $key => $product){
            if ($product->minicategory_id == $miniCatId) {
                $products[$key] = [$product];
                $image[$product->id] = $product->image;
                $deal = $product->deal;
            }
        }

        return response()->json($products);
    }


    //product sort by ajax call
    public function productSort($type){

        $products = '';
        if ($type == 'date') {
            $products = Product::with(['image', 'deal'])
                        ->where('published', false)
                        ->orderBy('created_at', 'desc')
                        ->get();
        }

        if ($type == 'price') {
            $products = Product::with(['image', 'deal'])
                                ->where('published', false)
                                ->orderBy('regularPrice', 'asc')
                                ->get();
        }

        if ($type == 'price-desc') {
            $products = Product::with(['image', 'deal'])
                                ->where('published', false)
                                ->orderBy('regularPrice', 'desc')
                                ->get();
        }

        return response()->json($products);

    }
    
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();
        $tags = Tag::all();
        $deals = Deal::all();

        $products = Product::all()->sortByDesc('id');
        return view('admin.products', compact('deals', 'tags', 'brands', 'colors', 'sizes', 'categories', 'products'));
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
            'productName' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'shortDescription' => 'required|string',
            'description' => 'required|string',
            'image1' => 'required|image|max:1000',
            'image2' => 'image|max:1000',
            'image3' => 'image|max:1000',
            'image4' => 'image|max:1000',
            'image5' => 'image|max:1000',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        // Create instance of Product model & assign form value then save to database
        $product = new Product;
        $product->productName = $request->productName;
        $product->sku = $request->sku;
		$product->slug = str_slug($request->productName);         
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->minicategory_id = $request->minicategory_id;
        $product->tab_id = $request->tab_id;
        $product->brand_id = $request->brand_id;
        $product->shortDescription = $request->shortDescription;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->regularPrice = $request->regularPrice;
        $product->type = $request->type;
        $product->availability = $request->availability;
        $product->paymentOption = $request->paymentOption;

        $product->measurement = $request->measurement;
        $product->min_order_qty = $request->min_order_qty;
        $product->delivery_time = $request->delivery_time;
        $product->delivery_from = $request->delivery_from;

        $product->delivery_charge = $request->delivery_charge;
        $product->return_policy = $request->return_policy;

        //discount  percentage value
        $product->discount  =   $request->discount;
        $product->occasion  =   $request->occasion;
        $product->promotion =   $request->promotion;
        $product->clearance =   $request->clearance;
        $product->buy_get   =   $request->buy_get;
        $product->combo     =   $request->combo;

        if($request->deal_id == 0){

            $product->deal_id = null;
        }else{
            $product->deal_id = $request->deal_id;
        }

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

        // Save image to database
        $image->save();

        // Return json response
        return response()->json(array('product' => $product->toArray(),'image' => $image->toArray(), 'colors' => $product->colors,'sizes' => $product->sizes,'tags' => $product->tags));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        // $relatedProducts = Product::where('subcategory_id', $product->subcategory->id)->get();
        // $similarProducts = Product::where('id', $id)
        //                             ->orWhere('minicategory_id', $product->minicategory_id)
        //                             ->orderByDesc('id')
        //                             ->take(5)
        //                             ->get();

        $relatedProducts = Product::where('minicategory_id', $product->minicategory_id)->get();
        $similarProducts = Product::where('id', $id)
                                    ->orWhere('tab_id', $product->tab_id)
                                    ->orderByDesc('id')
                                    ->take(5)
                                    ->get();

        $deal = \App\Deal::inRandomOrder()->take(1)->first();
        return view('client.product.product', compact('product', 'relatedProducts', 'similarProducts', 'deal'));

        // return view('client.product.singleProduct', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        
        // Validate form data
        $rules = array(
            'productName' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'shortDescription' => 'required|string',
            'description' => 'required|string',
            'image1' => 'nullable|image|max:1000',
            'image2' => 'nullable|image|max:1000',
            'image3' => 'nullable|image|max:1000',
            'image4' => 'nullable|image|max:1000',
            'image5' => 'nullable|image|max:1000',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        // Find the Product model & assign form value then save to database
        $product = Product::find($id);
        $product->productName = $request->productName;
        $product->sku = $request->sku;
		$product->slug = str_slug($request->productName);

        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->minicategory_id = $request->minicategory_id;
        $product->tab_id = $request->tab_id;
        $product->brand_id = $request->brand_id;
        $product->shortDescription =$request->shortDescription;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->regularPrice = $request->regularPrice;
        $product->type = $request->type;
        $product->availability = $request->availability;
        $product->paymentOption = $request->paymentOption;

        $product->measurement = $request->measurement;
        $product->min_order_qty = $request->min_order_qty;
        $product->delivery_time = $request->delivery_time;
        $product->delivery_from = $request->delivery_from;

        $product->delivery_charge = $request->delivery_charge;
        $product->return_policy = $request->return_policy;

        //discount  percentage value
        $product->discount  =   $request->discount;
        $product->occasion  =   $request->occasion;
        $product->promotion =   $request->promotion;
        $product->clearance =   $request->clearance;
        $product->buy_get   =   $request->buy_get;
        $product->combo     =   $request->combo;


            if($request->deal_id == 0){
    
                $product->deal_id = null;
            }else{
                $product->deal_id = $request->deal_id;
            }

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

        // Create instance of Image model & assign form value then save to database
        $image = Image::where('product_id', $product->id)->first();

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
            // Delete image from the directory
            Storage::delete('public/images/product/'.$image->image1);
            // Update database
            $image->image1 = $fileNameToStore1;
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
            if (!is_null($image->image2)){
                // Delete image from the directory
                Storage::delete('public/images/product/'.$image->image2);
            }

            // Update database
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

            // Checks if file exists
            if (!is_null($image->image3)){
                // Delete image from the directory
                Storage::delete('public/images/product/'.$image->image3);
            }

            // Update database
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

            // Checks if file exists
            if (!is_null($image->image4)){
                // Delete image from the directory
                Storage::delete('public/images/product/'.$image->image4);
            }

            // Update database
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

            // Checks if file exists
            if (!is_null($image->image5)){
                // Delete image from the directory
                Storage::delete('public/images/product/'.$image->image5);
            }

            // Update database
            $image->image5 = $fileNameToStore5;
        }

        $image->save();
        return response()->json($product); 


        // Return json response
        return response()->json(array('product' => $product->toArray(),'image' => $image->toArray(), 'colors' => $product->colors,'sizes' => $product->sizes,'tags' => $product->tags));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get the images associated with the product
        $images = Image::where('product_id', $id)->first();

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

        // Delete from database
        $images->delete();

        // Get the product & delete it
        $product = Product::find($id);

        // Detach previous color & size $ tag
        $product->colors()->detach();
        $product->sizes()->detach();
        $product->tags()->detach();

        // Delete the product
        $product->delete();

        return response()->json();
    }
}
