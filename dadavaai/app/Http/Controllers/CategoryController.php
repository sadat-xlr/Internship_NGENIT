<?php

namespace App\Http\Controllers;

use App\Category;
use App\Color;
use App\Size;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Validator;
use Response;
use DB;

class CategoryController extends Controller
{
    
    //search product in single category page
    public function categoryPageSearch(Request $request, $categoryId)
    {
        if ($request->get('query'))
        {
			$query = $request->get('query');
            $products = Product::with(['image', 'deal'])
                                ->where('productName','LIKE',"%{$query}%")
                                ->where('category_id', $categoryId)
                                ->where('published', false)
                                ->get();
        }
        return response()->json($products);
    }
 
    //search product in allcategory page
    public function allcategoryPageSearch(Request $request)
    {
        if ($request->get('query'))
        {
			$query = $request->get('query');
            $products = Product::with(['image', 'deal'])
                                ->where('productName','LIKE',"%{$query}%")
                                ->where('published', false)
                                ->get();
        }
        return response()->json($products);
    }


    
    public function singleCategory(Request $request, $id, $categoryName)
    {
        
        $singleCategory = Category::find($id);
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();

        // if($request->ajax())
        // {
        //  return view('client.product.fatch_data',compact('singleCategory', 'products'))->render();

        // }

        if ($request->min_price && $request->max_price) {

            $products = Product::whereBetween('regularPrice', [$request->min_price, $request->max_price])
                            ->where('published', false)
                            ->where('category_id', $singleCategory->id)->paginate(9);

            return view('client.product.singleCategory',compact('products', 'singleCategory', 'categories', 'colors', 'sizes'));

        }





        if($request->ajax()){

            $products = Product::with(['image', 'deal', 'category', 'brand'])->where('category_id', $id)
                            ->where('published', false)
                            ->get();
            return response()->json(['products'=>$products, 'singleCategory'=>$singleCategory]);

        }

        $products = Product::with(['image', 'deal', 'category', 'brand'])->where('category_id', $id)
                            ->where('published', false)
                            ->paginate(9);        
        return view('client.product.singleCategory',compact('products', 'singleCategory', 'categories', 'colors', 'sizes'));
   
    }


    public function allCategory()
    {
        $products = Product::where('published', false)->paginate(9);
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('client.product.allCategory', compact('categories', 'sizes', 'colors', 'products'));
    }

    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'categoryName' => 'required',
            'image_ad' => 'image|max:1000',
            'image_icon' => 'image|max:1000',

        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{

            // Checks if the file exists
            if ($request->hasFile('image_ad')){
                // Get file name with extension
                $fileNameWithExt = $request->file('image_ad')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('image_ad')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_image_ad = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('image_ad')->storeAs('public/images/category', $fileNameToStore_image_ad);
            }
            // Checks if the file exists
            if ($request->hasFile('image_icon')){
                // Get file name with extension
                $fileNameWithExt = $request->file('image_icon')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('image_icon')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_image_icon = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('image_icon')->storeAs('public/images/category', $fileNameToStore_image_icon);
            }


            // Create instance of category model & assign form value then save to database
            $categories = new Category;
            $categories->categoryName = $request->categoryName;
            $categories->image_ad = $fileNameToStore_image_ad;
            $categories->image_icon = $fileNameToStore_image_icon;
            $categories->save();

            return response()->json($categories);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        // Find the category model & assign form value then save to database
        $category = Category::find($request->id);


        // Handle image upload
        // Checks if the file exists
        if ($request->hasFile('image_ad')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image_ad')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image_ad')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_image_ad = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image_ad')->storeAs('public/images/category', $fileNameToStore_image_ad);
            // Get previous category & delete it from the directory
            Storage::delete('public/images/category/'.$category->image_ad);
            // Assign new value
            $category->image_ad = $fileNameToStore_image_ad;
        }
        // Checks if the file exists
        if ($request->hasFile('image_icon')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image_icon')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image_icon')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_image_icon = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image_icon')->storeAs('public/images/category', $fileNameToStore_image_icon);
            // Get previous category & delete it from the directory
            Storage::delete('public/images/category/'.$category->image_icon);
            // Assign new value
            $category->image_icon = $fileNameToStore_image_icon;
        }

        $category->categoryName = $request->categoryName;
        
        $category->save();

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find ($id);
        Storage::delete('public/images/category/'.$category->image_ad);
        Storage::delete('public/images/category/'.$category->image_icon);
        $category->delete();

        return response()->json($category);
    }
}
