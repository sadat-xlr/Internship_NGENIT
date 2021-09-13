<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Toprequest;
use App\Newsletter;
use App\Blog;
use App\Industry;
use App\Welcomenote;
use App\Brand;
use App\Category;
use App\Forum;
use App\Product;
use App\Profile;
use App\Offer;
use App\Solution;
use Carbon\Carbon;

use Illuminate\Http\Request;

class InformativeHomeController extends Controller
{
	
	// Loads login view
	public function login()
	{
		return view('informative.login');
	}
	
	
	public function informativeProducts( Request $request)
	{
		if ($request->ajax())
        {
			if($request->id == 1){
				$allProducts = Product::select('id', 'productName', 'slug')->take(8)->get();
				return response()->json(['allProducts' => $allProducts]);
			}
			if($request->id == 2){
				$offers = Offer::where('valid_until', '>=', Carbon::now())->get()->sortByDesc('id');
				return response()->json(['offers' => $offers]);
			}
			if($request->id == 3){
				$newProducts = Product::select('id','productName', 'slug')->inRandomOrder()
				->take(8)
				->get();				
				return response()->json(['newProducts' => $newProducts]);
			}
			if($request->id == 4){
				$featureProducts = Product::select('id','productName', 'slug')->where('type', '0')
				->inRandomOrder()
				->take(8)
				->get();				
				return response()->json(['featureProducts' => $featureProducts]);
			}
			if($request->id == 5){
				$mostVieweds = Product::select('id','productName', 'slug')->orderBy('view', 'desc')
				->take(30)
				->get();
				$output = '<div class="city-project-slider">';
				foreach($mostVieweds as $mostViewed){
					$output .= '<div>
									<div class="city_project_fig">
										<figure class="overlay">
											<img src="storage/images/product/'.$mostViewed->image->image1.'"  alt="" style=" width: 300px; height: 300px;!important">
											<div class="city_project_text">
												<a href="product-info/'.$mostViewed->id.'/'.$mostViewed->slug.'">'.$mostViewed->productName.'</a>
											</div>
										</figure>
									</div>
								</div>';
					}
					$output .= '</div>';
					echo $output;
				// return response()->json(['mostViewed' => $mostViewed]);
			}

		}

	}

	//search box in welcome note
	public function searchPage(Request $request)
	{
		
		if ($request->get('query'))
        {
			$query = $request->get('query');
			$solutions = Solution::select('solutionName','id', 'slug')->where('solutionName','LIKE',"%{$query}%")->select('description','id', 'slug')->orWhere('description','LIKE',"%{$query}%")->get();
			$brands = Brand::where('brandName','LIKE',"%{$query}%")->get();
			$industries = Industry::where('industryName','LIKE',"%{$query}%")->get();
			$products = Product::select('productName', 'id', 'slug')->where('productName','LIKE',"%{$query}%")
								->select('sku', 'id', 'slug')->orWhere('sku','LIKE',"%{$query}%")
								->select('shortDescription', 'id', 'slug')->orWhere('shortDescription','LIKE',"%{$query}%")
								->select('description', 'id', 'slug')->orWhere('description','LIKE',"%{$query}%")
								->select('specification', 'id', 'slug')->orWhere('specification','LIKE',"%{$query}%")->get();
			$blogs = Blog::select('blogTitle', 'id')->where('blogTitle','LIKE',"%{$query}%")->select('blogTitle', 'description', 'id')->where('description','LIKE',"%{$query}%")->get();
			$forums = Forum::where('title','LIKE',"%{$query}%")->get();

			return view('informative.search-page', compact('solutions','brands','industries', 'products', 'blogs', 'forums'));

			
			$output	=	'';
			$output .= '<div style="position:relative; z-index:2;"><ul class="dropdown-menu" style="display:block;margin-top:30px; padding-left:0px">';
			//dd($data);
			if($solutions){
				$output .= '<li class="dropdown-header"><b style="color:#1b6492">Solutions</b></li>';

				foreach ($solutions as $solution)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/solution/'.$solution->id.'/'.$solution->slug.'">'.$solution->solutionName.'</a></li>';
				}
			}
			if($brands){
				$output .= '<li class="dropdown-header"><b style="color:#1b6492">brands</b></li>';

				foreach ($brands as $brand)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/brand-details/'.$brand->id.'" style="white-space: unset !important;">'.$brand->brandName.'</a></li>';
				}
			}
			if($industries){
				$output .= '<li class="dropdown-header"><b style="color:#1b6492">industries</b></li>';

				foreach ($industries as $industry)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/industry-details/'.$industry->id.'" style="white-space: unset !important;">'.$industry->industryName.'</a></li>';
				}
			}
			if($products){
				$output .= '<li class="dropdown-header"><b style="color:#1b6492">Products</b></li>';

				foreach ($products as $product)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/product-info/'.$product->id.'/'.$product->slug.'" style="white-space: unset !important;">'.$product->productName.'</a></li>';
				}
			}
			if($blogs){
				$output .= '<li class="dropdown-header"><b style="color:#1b6492">Blogs</b></li>';
				foreach ($blogs as $blog)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/informative-blog-details/'.$blog->id.'" style="white-space: unset !important;">'.$blog->blogTitle.'</a></li>';
				}				
			}
			if($forums){
				$output .= '<li class="dropdown-header"><b style="color:#1b6492">Forums</b></li>';
				foreach ($forums as $forum)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/forum-question-show/'.$forum->slug.'" style="white-space: unset !important;">'.$forum->title.'</a></li>';
				}				
			}
			$output .='</ul></div>';
			// echo $output;
			return view('informative.search-page')->with('output', $output);

        }
	}

	// search box in navbar
	public function search(Request $request)
	{
		if ($request->get('query'))
        {
			$query = $request->get('query');
			$solutions = Solution::where('solutionName','LIKE',"%{$query}%")->get();
			$brands = Brand::where('brandName','LIKE',"%{$query}%")->get();
			$industries = Industry::where('industryName','LIKE',"%{$query}%")->get();
			$products = Product::where('productName','LIKE',"%{$query}%")->get();
			$blogs = Blog::where('blogTitle','LIKE',"%{$query}%")->get();
			$forums = Forum::where('title','LIKE',"%{$query}%")->get();



			
			$output	=	'';
			$output .= '<div style="position:relative; z-index:2;"><ul class="dropdown-menu" style="display:block;margin-top:30px; padding-left:0px">';
			//dd($data);
			if($solutions){
				$output .= '<li class="dropdown-header"><b style="color:#1b6492">Solutions</b></li>';

				foreach ($solutions as $solution)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/solution/'.$solution->id.'/'.$solution->slug.'">'.$solution->solutionName.'</a></li>';
				}
			}
			if($brands){
				$output .= '<li class="dropdown-header"><b style="color:#1b6492">brands</b></li>';

				foreach ($brands as $brand)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/brand-details/'.$brand->id.'" style="white-space: unset !important;">'.$brand->brandName.'</a></li>';
				}
			}
			if($industries){
				$output .= '<li class="dropdown-header"><b style="color:#1b6492">industries</b></li>';

				foreach ($industries as $industry)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/industry-details/'.$industry->id.'" style="white-space: unset !important;">'.$industry->industryName.'</a></li>';
				}
			}
			if($products){
				$output .= '<li class="dropdown-header"><b style="color:#1b6492">Products</b></li>';

				foreach ($products as $product)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/product-info/'.$product->id.'/'.$product->slug.'" style="white-space: unset !important;">'.$product->productName.'</a></li>';
				}
			}
			if($blogs){
				$output .= '<li class="dropdown-header"><b style="color:#1b6492">Blogs</b></li>';
				foreach ($blogs as $blog)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/informative-blog-details/'.$blog->id.'" style="white-space: unset !important;">'.$blog->blogTitle.'</a></li>';
				}				
			}
			if($forums){
				$output .= '<li class="dropdown-header"><b style="color:#1b6492">Forums</b></li>';
				foreach ($forums as $forum)
				{
					$output .='<li id="search-li"><a class="dropdown-item " href="/forum-question-show/'.$forum->slug.'" style="white-space: unset !important;">'.$forum->title.'</a></li>';
				}				
			}
			$output .='</ul></div>';
			echo $output;
        }
	}

	
	public function index()
    {
		
		try {
			$topRequest = Toprequest::first();
			$announcement = Announcement::first();

			$welcomeNote	=	Welcomenote::orderBy('created_at','desc')->first();
			$offers = Offer::where('valid_until', '>=', Carbon::now())->get()->sortByDesc('id');
			$newProducts = Product::select('id','productName', 'slug')->inRandomOrder()->take(8)->get();

			$hardCatId = Category::select('id')->where('categoryName','LIKE',"%hardware%")->first();
			$hardwares = Product::select('id','productName', 'slug')->where('category_id',$hardCatId->id)->take(8)->get();

			$softCatId = Category::select('id')->where('categoryName','LIKE',"%software%")->first();
			$softwares = Product::select('id','productName', 'slug')->where('category_id',$softCatId->id)->take(8)->get();

			$mostVieweds = Product::select('id','productName', 'slug')->orderBy('view', 'desc')->take(30)->get();

			return view('informative.index', compact('announcement', 'topRequest', 'welcomeNote', 'hardwares', 'newProducts', 'softwares', 'mostVieweds'));
		} catch (\Throwable $th) {
			// return back()->withError($th->getMessage())->withInput();
			return redirect('/notFound')->withErrors($th->getMessage())->withInput();

		}
		
    }

    public function contact()
    {
        return view('informative.contact');
    }
    	// Loads about view 
	public function welcomeNote(Request $request)
	{
		// $welcomeNote = Welcomenote::all();
		// if(!$welcomeNote){
			
			$welcomeNote	=	new Welcomenote;
			$welcomeNote->description	=	$request->welcomeNote;
			$welcomeNote->save();
			return redirect('/addWelcomeNote');
		// }else{
		// 	return response('Welcome note is available');
		// }
	}
	
	// Loads addAbout view 
	public function addWelcomeNote()
	{
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.informative.welcomeNote');
	}

	public function latestNews()
	{
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.informative.latestNews');
	}

	//add profile broshier 
	public function addProfile()
	{
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.informative.profile.addProfile');
	}

	public function profile(Request $request)
	{
		$fileNameToStore= '';
		$fileNameToStore1= '';
		$fileNameToStore3= '';
				
				// Checks if the file exists
				if ($request->hasFile('profile')){
					// Get file name with extension
					$fileNameWithExt = $request->file('profile')->getClientOriginalName();
					// Get only file name
					$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
					// Get only extension
					$extension = $request->file('profile')->getClientOriginalExtension();
					// Filename to store
					$fileNameToStore = $fileName . time() . "." . $extension;
					// Directory to upload
					$path = $request->file('profile')->storeAs('public/profile', $fileNameToStore);
				}
		
				// Checks if the file exists
				if ($request->hasFile('brochure')){
					// Get file name with extension
					$fileNameWithExt = $request->file('brochure')->getClientOriginalName();
					// Get only file name
					$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
					// Get only extension
					$extension = $request->file('brochure')->getClientOriginalExtension();
					// Filename to store
					$fileNameToStore1 = $fileName . time() . "." . $extension;
					// Directory to upload
					$path = $request->file('brochure')->storeAs('public/profile', $fileNameToStore1);
				}
		
				// Checks if the file exists
				if ($request->hasFile('dataSheet')){
					// Get file name with extension
					$fileNameWithExt = $request->file('dataSheet')->getClientOriginalName();
					// Get only file name
					$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
					// Get only extension
					$extension = $request->file('dataSheet')->getClientOriginalExtension();
					// Filename to store
					$fileNameToStore3 = $fileName . time() . "." . $extension;
					// Directory to upload
					$path = $request->file('dataSheet')->storeAs('public/profile', $fileNameToStore3);
				}
				// Create instance of Banner model & assign form value then save to database
				$companyProfile = new Profile();
				$companyProfile->profile = $fileNameToStore;
				$companyProfile->brochure = $fileNameToStore1;
				$companyProfile->dataSheet = $fileNameToStore3;
				$companyProfile->save();
		
				return redirect()->back()->with('success', 'Profile added successfully.');
	}
	//add profile broshier 
	public function allNewsletter()
	{

		$newsletters = Newsletter::paginate(1);
		return view('informative.newsletter', compact('newsletters'));
	}


	//add profile broshier 
	public function addNewsletter()
	{
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		return view('admin.informative.newsletter.addNewsletter');
	}

	public function newsletter(Request $request)
	{
		$fileNameToStore= '';

		// Checks if the file exists
		if ($request->hasFile('newsletter_file')){
			// Get file name with extension
			$fileNameWithExt = $request->file('newsletter_file')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('newsletter_file')->getClientOriginalExtension();
			// Filename to store
			$fileNameToStore = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('newsletter_file')->storeAs('public/newsletter', $fileNameToStore);
		}

		// Create instance of Banner model & assign form value then save to database
		$newsletter = new Newsletter();
		$newsletter->file = $fileNameToStore;
		$newsletter->title = $request->title;
		$newsletter->save();

		return redirect()->back()->with('success', 'Newsletter added successfully.');
	}

	public function allIndustry()
	{
		$industries	=	Industry::all();
		return view('informative.industry.allIndustry')->with('industries', $industries);
	}
	public function industryDetails($id)
	{
		$industry	=	Industry::FindOrFail($id);
		$industries =	Industry::all();
		return view('informative.industry.industryDetails')->with('industry', $industry)
															->with('industries', $industries);
	}
	public function allBrand()
	{
		$brands	=	Brand::all()->sortBy('brandName');
		return view('informative.brand.allBrand')->with('brands', $brands);
	}
	public function brandDetails($id)
	{
		$brand	=	Brand::FindOrFail($id);
		$brands =	Brand::all();
		return view('informative.brand.brandDetails')->with('brand', $brand)
														->with('brands', $brands);
	}
	public function allCategory()
	{
		$categories	=	Category::all();
		return view('informative.category.categories')->with('categories', $categories);
	}

	public function services()
	{
		return view('informative.services');
	}
}
