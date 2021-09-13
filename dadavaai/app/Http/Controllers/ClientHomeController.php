<?php

namespace App\Http\Controllers;

use App\Category;
use App\Brand;
use App\Color;
use App\Size;
use App\Banner;
use App\Product;
use App\Slider;
use App\Deal;
use App\Prebook;
use App\Contact;
use App\Offer;

use App\Productreview;

use App\Productsad;
use Carbon\Carbon;

use DB;
use Illuminate\Http\Request;

class ClientHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        $banner  = Banner::select('home_one', 'home_one_link', 'home_two', 'home_two_link', 'home_three', 'home_three_link')->first();
        $categories = Category::all();
        // $products = Product::select('id', 'productName', 'slug', 'regularPrice', 'deal_id', 'discount')
        //                     ->where('availability', false)
        //                     ->where('published', false)
        //                     ->inRandomOrder()
        //                     ->take(8)
        //                     ->get();

        $all_products = Product::where('availability', false)
                                ->where('published', false)
                                ->inRandomOrder()
                                ->take(16)
                                ->get();
        // $products = Product::all()->sortByDesc('created_at')->take(4);
        $featuredProducts = Product::where('type', false)
                                    ->where('published', false)
                                    ->take(8)->get();

        $deals = Deal::all();
        $discount_value = DB::table('deals')->max('discount_value');
        $topMostDeal = Deal::all()->where('discount_value', $discount_value)->first();

        //for the product which has higest deal and discount 
        $heighDealProduct = '';
        $discount = 0;
        if($topMostDeal)
        {
            foreach($topMostDeal->products as $topMostDealProduct)
            {
                if($topMostDealProduct->discount >= $discount)
                {
                    $discount = $topMostDealProduct->discount;
                    $heighDealProduct = $topMostDealProduct;
                }
    
            }

        }

        $comboProducts = Product::where('combo', true)->where('published', false)->inRandomOrder()->take(5)->get();
        $buyGetProducts = Product::where('buy_get', true)->where('published', false)->inRandomOrder()->take(5)->get();
        $occasionProducts = Product::where('occasion', true)->where('published', false)->inRandomOrder()->take(5)->get();
        $promotionProducts = Product::where('promotion', true)->where('published', false)->inRandomOrder()->take(5)->get();
        $clearanceProducts = Product::where('clearance', true)->where('published', false)->inRandomOrder()->take(5)->get();
        $allSpecialDiscounts = Product::where('buy_get', true)
                                        ->orWhere('occasion', true)
                                        ->orWhere('promotion', true)
                                        ->orWhere('clearance', true)
                                        ->where('published', false)
                                        ->inRandomOrder()
                                        ->take(5)
                                        ->get();

        $currentTime = Carbon::now()->format('h:m:s');

        $offerUpdates = Offer::all();
        
        

        

        $offers = Offer::where('valid_until','>=', $currentTime)
                        ->where('status', true)->get();

        $adsProducts = Productsad::first();

        if ($adsProducts) {
            # selected product for ads
            $adsProduct1 = Product::where('id', $adsProducts->ad1Product_id)->where('published', false)->first();
            $adsProduct2 = Product::where('id', $adsProducts->ad2Product_id)->where('published', false)->first();
            $adsProduct3 = Product::where('id', $adsProducts->ad3Product_id)->where('published', false)->first();
        }



        $brand = Brand::inRandomOrder()->take(1)->first();

        $prebooks = Prebook::all()->sortByDesc('id');

        $reviews = Productreview::take(3)->get();
        

        return view('client.home', compact('sliders', 'banner', 'categories', 'all_products', 'products', 'offers', 'featuredProducts', 'deals', 'adsProducts', 'adsProduct1', 'adsProduct2', 'adsProduct3', 'topMostDeal', 'heighDealProduct', 'buyGetProducts', 'occasionProducts', 'promotionProducts', 'clearanceProducts', 'comboProducts', 'allSpecialDiscounts', 'brand', 'reviews', 'prebooks'));
    }

    	// search box in navbar
	public function search(Request $request)
	{
		if ($request->get('query'))
        {
			$query = $request->get('query');
			$brands = Brand::where('brandName','LIKE',"%{$query}%")->take(5)->get();
            $products = Product::where('productName','LIKE',"%{$query}%")->where('published', false)->take(5)->get();
            
			$output	=	'';
			$output .= '<div style="position:relative; z-index:2;"><ul class="dropdown-menu" style="display:block;margin-top:30px; padding-left:0px; width:570px">';
			if($brands){
				$output .= '<li class="dropdown-header"><b style="color:#ed1c24">brands</b></li>';

				foreach ($brands as $brand)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/product-by-brand/'.$brand->id.'/'.str_slug($brand->brandName).'" style="white-space: unset !important;">'.$brand->brandName.'</a></li>';
				}
            }
            
			if($products){
				$output .= '<li class="dropdown-header"><b style="color:#ed1c24">Products</b></li>';

				foreach ($products as $product)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/product/'.$product->id.'/'.$product->slug.'" style="white-space: unset !important;">'.$product->productName.'</a></li>';
				}
            }
            
			$output .='</ul></div>';
			echo $output;
        }
	}


    public function searchPage(Request $request)
    {
        
        $categories = Category::all();
        $colors     = Color::all();
        $sizes      = Size::all();


        $products = '';
        if($request->category_id != 0){
            $products = Product::where('category_id', $request->category_id)
                                ->where('productName','LIKE',"%{$request->search}%")
                                ->where('published', false)
                                ->get();
        }
        else {
            $products = Product::where('productName','LIKE',"%{$request->search}%")
                                ->where('published', false)
                                ->get();
        }


        return view('client.search', compact('categories', 'colors', 'sizes', 'products'));
    }

}
