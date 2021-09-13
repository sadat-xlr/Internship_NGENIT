<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\Product;
use App\Size;
use App\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class SubcategoryController extends Controller
{
    
    public function singleSubcategory(Request $request, $id, $subcategoryName)
    {

        $singleSubcategory = Subcategory::with('category')->find($id);
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();

        if ($request->min_price && $request->max_price) {
            $products = Product::whereBetween('regularPrice', [$request->min_price, $request->max_price])
                            ->where('published', false)
                            ->where('subcategory_id', $singleSubcategory->id)->paginate(9);

        return view('client.product.singleSubcategory',compact('products', 'singleSubcategory', 'categories', 'colors', 'sizes'));

        }
        
        

        if($request->ajax())
        {

        $products = Product::with(['image', 'deal', 'category', 'brand'])->where('subcategory_id', $id)
                            ->where('published', false)
                            ->get();

         return response()->json(['products'=>$products, 'singleSubcategory'=>$singleSubcategory]);

        }

        $products = Product::with(['image', 'deal', 'category', 'brand'])->where('subcategory_id', $id)
                            ->where('published', false)
                            ->paginate(9);

        return view('client.product.singleSubcategory',compact('products', 'singleSubcategory', 'categories', 'colors', 'sizes'));

    }

    // Get subcategories associated with category
    public function getSubCat($catId){
        $subCategories = Subcategory::where('category_id', $catId)->pluck('subCategoryName','id')->toArray();

        $data = "<option value=''>--Select Subcategory--</option>";
        foreach($subCategories as $key => $subCategory)
        {
            $data .= "<option value='$key'>$subCategory</option>";
        }
        return $data;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $subCategories = Subcategory::all();
        return view('admin.subCategories', compact('categories', 'subCategories'));
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
            'subCategoryName' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of Subcategory model & assign form value then save to database
            $subcategories = new Subcategory;
            $subcategories->subCategoryName = $request->subCategoryName;
            $subcategories->category_id = $request->category_id;
            $subcategories->save();

            return response()->json($subcategories);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        // Find the Subcategory model & assign form value then save to database
        $subcategory = Subcategory::find($request->id);
        $subcategory->subCategoryName = $request->subCategoryName;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        // Return json response
        return response()->json($subcategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategories = Subcategory::find ($id)->delete();
        return response()->json();
    }
}
