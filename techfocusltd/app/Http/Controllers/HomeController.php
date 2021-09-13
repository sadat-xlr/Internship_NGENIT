<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Deal;
use App\Offer;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Brand;
use App\Category;
use App\Product;
use App\Cart;
use App\Industry;
use App\Technology;
use App\Partner;
use App\Subscription;
use Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if (!Session::has('popup')) {
			Session::put('popup', true);
		}else{
			Session::put('popup', false);
		}

		$categories = Category::all();
        // Get offer products
		$offers = Offer::where('valid_until', '>=', Carbon::now())->get()->sortByDesc('id');
		

        // Get deal products
        $deals = Deal::where('valid_until', '>=', Carbon::now())->get()->sortByDesc('id');

		$newProducts = Product::inRandomOrder()
						->take(8)
						->get();
		$featureProducts = Product::where('type', '0')
						->inRandomOrder()
						->take(8)
						->get();
		$partners = Partner::all()->sortByDesc('id');
		$sliders = Slider::all();
		$banners = Banner::all();
        $products = Product::inRandomOrder()->limit(36)->get();
		$mostViewed = Product::orderBy('view', 'desc')
                        ->take(30)
						->get();
			
        return view('index', compact('categories', 'mostViewed', 'offers', 'deals', 'newProducts', 'featureProducts', 'partners', 'sliders', 'banners', 'products'));
    }
	
	public function subscribe(Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
		'email' => 'required|email'
		]);
		
		$subscription = Subscription::where('email', $request->email)->get();
		if (!$subscription->isEmpty()){
			return redirect()->back()->with('error', 'E-mail exists! Please try with a different E-mail.'); 
		}
		
		$subscription = new Subscription;
		$subscription->email = $request->email;
		$subscription->save();
		
		if ($subscription){
			return redirect()->back()->with('success', 'Congratulations! you have successfully subscribed for our newsletter. Now, you will get update continuously.'); 
		}else{
			return redirect()->back()->with('error', 'Subscription failed!'); 
		}
	}
}
