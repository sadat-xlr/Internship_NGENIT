<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Minicategory;
use App\Color;
use App\Size;
use App\Product;
class OffersController extends Controller
{

    public function offers(Request $request){

        if($request->ajax()){

            if ($request->categoryId) {
                $singleCategory = Category::find($request->categoryId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('category_id', $request->categoryId)
                                        ->where('discount', '!=', null)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleCategory'=>$singleCategory]);
            }


            if ($request->subcatId) {
                $singleSubcategory = Subcategory::with('category')->find($request->subcatId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('subcategory_id', $singleSubcategory->id)
                                        ->where('discount', '!=', null)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleSubcategory'=>$singleSubcategory]);
            }

            if ($request->minicatId) {

                $miniCategory = Minicategory::with('subcategory')->find($request->minicatId);
                $category  = $miniCategory->subcategory->category;

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('minicategory_id', $miniCategory->id)
                                        ->where('discount', '!=', null)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'miniCategory'=>$miniCategory, 'category'=>$category]);
            }

        }

        $categories =   Category::all();

        if ($request->min_price || $request->max_price) {
            $products = Product::where('occasion', true)
                             ->where('published', false)
                             ->orWhere('promotion', true)
                             ->orWhere('clearance', true)
                             ->orWhere('deal_id','!=', null)
                             ->whereBetween('regularPrice', [$request->min_price, $request->max_price])
                             ->paginate(9);
            
        } else {
            // $products   =   Product::where('occasion', true)
            //                         ->where('published', false)
            //                         ->orWhere('promotion', true)
            //                         ->orWhere('clearance', true)
            //                         ->orWhere('deal_id','!=', null)
            //                         ->orWhere('discount', '!=', null)
            //                         ->paginate(9); 

            $products   =   Product::where('published', false)
                                    ->Where('discount', '!=', null)
                                    ->paginate(9);                                    
        }
        


        $offerName  = "discount";
        return view('client.offer.offers', compact('categories', 'products', 'offerName'));
    }


    public function deals(Request $request){

        if($request->ajax()){

            if ($request->categoryId) {
                $singleCategory = Category::find($request->categoryId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('category_id', $request->categoryId)
                                        ->where('deal_id', '!=', null)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleCategory'=>$singleCategory]);
            }


            if ($request->subcatId) {
                $singleSubcategory = Subcategory::with('category')->find($request->subcatId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('subcategory_id', $singleSubcategory->id)
                                        ->where('deal_id', '!=', null)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleSubcategory'=>$singleSubcategory]);
            }

            if ($request->minicatId) {

                $miniCategory = Minicategory::with('subcategory')->find($request->minicatId);
                $category  = $miniCategory->subcategory->category;

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('minicategory_id', $miniCategory->id)
                                        ->where('deal_id', '!=', null)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'miniCategory'=>$miniCategory, 'category'=>$category]);
            }

        }


        $categories =   Category::all();

        if ($request->min_price || $request->max_price) {
            $products   =   Product::where('deal_id', '!=', null)
                                    ->whereBetween('regularPrice', [$request->min_price, $request->max_price])
                                    ->where('published', false)                     
                                    ->paginate(9); 
        } else {
            $products   =   Product::where('deal_id', '!=', null)
                                    ->where('published', false)
                                    ->paginate(9); 
        }
        
        $offerName = "Deals";

        return view('client.offer.offers', compact('categories', 'products', 'offerName'));
    }   

    public function occasion(Request $request){

        if($request->ajax()){

            if ($request->categoryId) {
                $singleCategory = Category::find($request->categoryId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('category_id', $request->categoryId)
                                        ->where('occasion', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleCategory'=>$singleCategory]);
            }


            if ($request->subcatId) {
                $singleSubcategory = Subcategory::with('category')->find($request->subcatId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('subcategory_id', $singleSubcategory->id)
                                        ->where('occasion', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleSubcategory'=>$singleSubcategory]);
            }

            if ($request->minicatId) {

                $miniCategory = Minicategory::with('subcategory')->find($request->minicatId);
                $category  = $miniCategory->subcategory->category;

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('minicategory_id', $miniCategory->id)
                                        ->where('occasion', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'miniCategory'=>$miniCategory, 'category'=>$category]);
            }

        }


        $categories =   Category::all();

        if ($request->min_price || $request->max_price) {
            $products   =   Product::where('occasion', true)
                                    ->whereBetween('regularPrice', [$request->min_price, $request->max_price])
                                    ->where('published', false)                        
                                    ->paginate(9); 
        } else {
            $products   =   Product::where('occasion', true)
                                    ->where('published', false)
                                    ->paginate(9); 
        }


        $offerName = "Occasion";
        return view('client.offer.offers', compact('categories', 'products', 'offerName'));
    }  

    public function promotion(Request $request){


        if($request->ajax()){

            if ($request->categoryId) {
                $singleCategory = Category::find($request->categoryId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('category_id', $request->categoryId)
                                        ->where('promotion', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleCategory'=>$singleCategory]);
            }


            if ($request->subcatId) {
                $singleSubcategory = Subcategory::with('category')->find($request->subcatId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('subcategory_id', $singleSubcategory->id)
                                        ->where('promotion', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleSubcategory'=>$singleSubcategory]);
            }

            if ($request->minicatId) {

                $miniCategory = Minicategory::with('subcategory')->find($request->minicatId);
                $category  = $miniCategory->subcategory->category;

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('minicategory_id', $miniCategory->id)
                                        ->where('promotion', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'miniCategory'=>$miniCategory, 'category'=>$category]);
            }

        }



        $categories =   Category::all();

        if ($request->min_price || $request->max_price) {
            $products   =   Product::where('promotion', true)
                                    ->whereBetween('regularPrice', [$request->min_price, $request->max_price])
                                    ->where('published', false)                        
                                    ->paginate(9); 
        } else {
            $products   =   Product::where('promotion', true)
                                    ->where('published', false)
                                    ->paginate(9); 
        }

        $offerName = "Promotion";
        return view('client.offer.offers', compact('categories', 'products', 'offerName'));
    }   

    public function clearance(Request $request){

        if($request->ajax()){

            if ($request->categoryId) {
                $singleCategory = Category::find($request->categoryId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('category_id', $request->categoryId)
                                        ->where('clearance', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleCategory'=>$singleCategory]);
            }


            if ($request->subcatId) {
                $singleSubcategory = Subcategory::with('category')->find($request->subcatId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('subcategory_id', $singleSubcategory->id)
                                        ->where('clearance', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleSubcategory'=>$singleSubcategory]);
            }

            if ($request->minicatId) {

                $miniCategory = Minicategory::with('subcategory')->find($request->minicatId);
                $category  = $miniCategory->subcategory->category;

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('minicategory_id', $miniCategory->id)
                                        ->where('clearance', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'miniCategory'=>$miniCategory, 'category'=>$category]);
            }

        }


        $categories =   Category::all();

        if ($request->min_price || $request->max_price) {
            $products   =   Product::where('clearance', true)
                                    ->whereBetween('regularPrice', [$request->min_price, $request->max_price])
                                    ->where('published', false)                        
                                    ->paginate(9); 
        } else {
            $products   =   Product::where('clearance', true)->where('published', false)->paginate(9); 
        }


        $offerName = "Clearance";
        return view('client.offer.offers', compact('categories', 'products', 'offerName'));
    }
    public function buyGet(Request $request){

        if($request->ajax()){

            if ($request->categoryId) {
                $singleCategory = Category::find($request->categoryId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('category_id', $request->categoryId)
                                        ->where('buy_get', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleCategory'=>$singleCategory]);
            }


            if ($request->subcatId) {
                $singleSubcategory = Subcategory::with('category')->find($request->subcatId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('subcategory_id', $singleSubcategory->id)
                                        ->where('buy_get', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleSubcategory'=>$singleSubcategory]);
            }

            if ($request->minicatId) {

                $miniCategory = Minicategory::with('subcategory')->find($request->minicatId);
                $category  = $miniCategory->subcategory->category;

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('minicategory_id', $miniCategory->id)
                                        ->where('buy_get', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'miniCategory'=>$miniCategory, 'category'=>$category]);
            }

        }        

        $categories =   Category::all();

        if ($request->min_price || $request->max_price) {
            $products   =   Product::where('buy_get', true)
                                    ->whereBetween('regularPrice', [$request->min_price, $request->max_price])
                                    ->where('published', false)                        
                                    ->paginate(9); 
        } else {
            $products   =   Product::where('buy_get', true)->where('published', false)->paginate(9); 
        }

        $offerName = "Buy & Get";
        return view('client.offer.offers', compact('categories', 'products', 'offerName'));
    }

    public function combo(Request $request){

        if($request->ajax()){

            if ($request->categoryId) {
                $singleCategory = Category::find($request->categoryId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('category_id', $request->categoryId)
                                        ->where('combo', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleCategory'=>$singleCategory]);
            }


            if ($request->subcatId) {
                $singleSubcategory = Subcategory::with('category')->find($request->subcatId);

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('subcategory_id', $singleSubcategory->id)
                                        ->where('combo', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'singleSubcategory'=>$singleSubcategory]);
            }

            if ($request->minicatId) {

                $miniCategory = Minicategory::with('subcategory')->find($request->minicatId);
                $category  = $miniCategory->subcategory->category;

                $products   =   Product::with(['image', 'deal', 'category', 'brand'])
                                        ->where('minicategory_id', $miniCategory->id)
                                        ->where('combo', true)
                                        ->where('published', false)
                                        ->get();

                return response()->json(['products'=>$products, 'miniCategory'=>$miniCategory, 'category'=>$category]);
            }

        }        

        $categories =   Category::all();

        if ($request->min_price || $request->max_price) {
            $products   =   Product::where('combo', true)
                                    ->whereBetween('regularPrice', [$request->min_price, $request->max_price])
                                    ->where('published', false)                        
                                    ->paginate(9); 
        } else {
            $products   =   Product::where('combo', true)->where('published', false)->paginate(9); 
        }

        $offerName = "Combo";
        return view('client.offer.offers', compact('categories', 'products', 'offerName'));
    }

}
