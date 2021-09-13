<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Category;
use App\Subcategory;
use App\Minicategory;
use App\Size;
use App\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class BrandController extends Controller
{
    
    public function brandSearch(Request $request)
    {
        $brands = '';
        if ($request->get('query'))
        {
			$query = $request->get('query');
            $brands = Brand::where('brandName','LIKE',"%{$query}%")->get();
        }
        return response()->json($brands);
    }

    public function brandPageSearch(Request $request, $brandId)
    {
        if ($request->get('query'))
        {
			$query = $request->get('query');
            $products = Product::with(['image', 'deal'])->where('productName','LIKE',"%{$query}%")
                                                        ->where('brand_id', $brandId)->take(5)->get();
        }
        return response()->json($products);
    }
    
    // showing product of a specification brand of specification minicategory
    public function byMinicategory($brandId, $minicategoryId)
    {
        $brand = Brand::find($brandId);
        $products = Product::where('brand_id', $brandId)
                                ->where('minicategory_id', $minicategoryId)
                                ->paginate(9);
        $brands = Brand::all();
        $categories = Category::all();

        // return $products;

        return view('client.product.singleBrand',compact('products', 'brand', 'brands', 'categories'));
    }



    // showing all brands
    public function allBrands(Request $request)
    {
        
        $categories = Category::all();

        if($request->ajax())
        {
            if ($request->categoryId) {

                $category = Category::find($request->categoryId);

                $brands = \App\Product::select('brands.brandName','brands.id', 'brands.brandImage')->distinct('brands.brandName')->where('category_id', $request->categoryId)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->get();

                return response()->json(['brands'=>$brands, 'category' =>$category]);

            }else if ($request->subcategoryId) {

                $subcategory = Subcategory::find($request->subcategoryId);

                $category = $subcategory->category;

                $brands = \App\Product::select('brands.brandName','brands.id', 'brands.brandImage')->distinct('brands.brandName')->where('subcategory_id', $request->subcategoryId)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->get();

                return response()->json(['brands'=>$brands, 'category' =>$category, 'subcategory'=>$subcategory]);

            }else if ($request->minicategoryId) {

                $minicategory = Minicategory::with('subcategory')->find($request->minicategoryId);

                $brands = \App\Product::select('brands.brandName','brands.id', 'brands.brandImage')->distinct('brands.brandName')->where('minicategory_id', $request->minicategoryId)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->get();

                return response()->json(['brands'=>$brands, 'minicategory' =>$minicategory]);

            } else {

                $brands = Brand::orderBy('brandName')->get();
                return view('client.product.allBrands', compact('categories', 'brands'));
            }

        }


        if ($request->category_id)
        {
            $brands = \App\Product::select('brands.brandName','brands.id', 'brands.brandImage')->distinct('brands.brandName')->where('category_id', $request->category_id)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->get();

            $singleCategory = Category::where('id', $request->category_id)->first();

            return view('client.product.allBrands', compact('categories', 'brands', 'singleCategory'));
        }

        if ($request->minicategoryId) {

            $brands = \App\Product::select('brands.brandName','brands.id', 'brands.brandImage')->distinct('brands.brandName')->where('minicategory_id', $request->minicategoryId)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->get();

            return view('client.product.allBrands', compact('categories', 'brands'));

        } else {

            $brands = Brand::orderBy('brandName')->get();
            return view('client.product.allBrands', compact('categories', 'brands'));
        }
        


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all()->sortByDesc('id');
        return view('admin.brands', compact('brands'));
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
            'brand_name' => 'required',
            'image' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{

            // Handle image upload

            // Checks if the file exists
            if ($request->hasFile('image')){
                // Get file name with extension
                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('image')->storeAs('public/images/brand', $fileNameToStore);
            }


            // Create instance of brand model & assign form value then save to database
            $brand = new Brand;
            $brand->brandImage = $fileNameToStore;
            $brand->brandName = $request->brand_name;
            $brand->save();

            return response()->json($brand);
        }
    }

    /**
     * Display the specified resource in client panel.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::find($id);
        $products = Product::where('brand_id', $id)->paginate(9);
        $brands = Brand::all();
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();

        return view('client.product.singleBrand',compact('products', 'brand', 'brands', 'categories', 'sizes', 'colors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate form data
        $rules = array(
            'brand_name' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{

            // Handle image upload

            // Checks if the file exists
            if ($request->hasFile('image')){
                // Get file name with extension
                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('image')->storeAs('public/images/brand', $fileNameToStore);
            }


            // Create instance of brand model & assign form value then save to database
            $brand = brand::find($id);
            if($request->image){
                $brand->brandImage = $fileNameToStore;
            }
            $brand->brandName = $request->brand_name;
            $brand->save();

            return response()->json($brand);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brands = Brand::find ($id)->delete();
        return response()->json();
    }
}
