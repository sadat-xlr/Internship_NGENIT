<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\Minicategory;
use App\Tab;
use App\Product;
use App\Size;
use App\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class MinicategoryController extends Controller
{
    //homeMiniCategoryProduct

    public function homeMiniCategoryProduct(Request $request, $id)
    {
        if($request->ajax())
        {
            $products = Product::with(['image', 'deal', 'category', 'brand'])->where('minicategory_id', $id)->where('published', false)->inRandomOrder()->take(9)->get();

            return response()->json(['products'=>$products]);
        }
    }



    public function singleMiniCategory(Request $request, $id)
    {
        $miniCategory = Minicategory::with(['subcategory', 'tabs'])->find($id);
        $category  = $miniCategory->subcategory->category;
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();

        if($request->ajax())
        {
            $products = Product::with(['image', 'deal', 'category', 'brand'])->where('minicategory_id', $id)->where('published', false)->get();

            return response()->json(['products'=>$products, 'miniCategory'=>$miniCategory, 'category'=>$category]);
        }


        if ($request->min_price && $request->max_price) {

            $products = Product::whereBetween('regularPrice', [$request->min_price, $request->max_price])
                            ->where('published', false)
                            ->where('minicategory_id', $miniCategory->id)->paginate(9);

            return view('client.product.productByMinicategory', compact('categories', 'sizes', 'colors', 'miniCategory', 'products'));

        }


        $products = Product::with(['image', 'deal', 'category', 'brand'])->where('minicategory_id', $id)->where('published', false)->paginate(9);
    
        return view('client.product.productByMinicategory', compact('categories', 'sizes', 'colors', 'miniCategory', 'products'));
    }

    
    
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $miniCategories = Minicategory::all()->sortByDesc('id');
        return view('admin.miniCategories', compact('categories', 'miniCategories'));
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
            'miniCategoryName' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of Minicategory model & assign form value then save to database
            $minicategories = new Minicategory();
            $minicategories->miniCategoryName = $request->miniCategoryName;
            $minicategories->subcategory_id = $request->subcategory_id;
            $minicategories->save();

            // Find subcategory
            $subcategories = Subcategory::with('category')->find($minicategories->subcategory_id);

            return response()->json([$minicategories, $subcategories]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Minicategory  $minicategory
     * @return \Illuminate\Http\Response
     */
    public function show(Minicategory $minicategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Minicategory  $minicategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Minicategory $minicategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Minicategory  $minicategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the Subcategory model & assign form value then save to database
        $minicategory = Minicategory::with('subcategory')->find($id);
        $minicategory->miniCategoryName = $request->miniCategoryName;
        $minicategory->subcategory_id = $request->subcategory_id;
        $minicategory->save();

        // Find subcategory
        $subcategories = Subcategory::with('category')->find($minicategory->subcategory_id);

        return response()->json([$minicategory, $subcategories]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Minicategory  $minicategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $minicategory = Minicategory::find ($id)->delete();
        return response()->json();
    }
}
