<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Category;
use App\Product;
use App\Blogcomment;
use App\Brand;
use App\Cart;
use App\Industry;
use App\Technology;
use App\Siteinfo;
use Session;

// Blog Controller
class BlogController extends Controller
{
    // Loads all-blogs view 
	public function infoIndex(){
		$blogs = Blog::paginate(4);
		return view('informative.blog.blogs')->with('blogs', $blogs);
	}

	// Loads blogDetails view 
	public function informativeBlogDetails($blogId){
		$newProducts = Product::orderBy('id','desc')
               ->take(3)
               ->get();
		$blog = Blog::find($blogId);
		$categories = Category::all();
		$siteinfos = Siteinfo::all()->first();
		$recentBlogs =	Blog::orderBy('created_at', 'Desc')->take(4)->get();
		$relatedBlogs	=	Blog::where('category_id', $blog->category->id)->get();

			   
		return view('informative.blog.blogDetails', [
			'blog' => $blog,
			'blogId' => $blogId,
			'newProducts' => $newProducts,
			'categories' => $categories,
			'siteinfos' => $siteinfos,
			'recentBlogs' => $recentBlogs,
			'relatedBlogs'=> $relatedBlogs,
			]);
	}
	
	// Loads all-blogs view 
	public function index(){
		$newProducts = Product::orderBy('id','desc')
               ->take(3)
               ->get();
		$blogs = Blog::paginate(4);
		$categories = Category::all();

		return view('blog', [
			'blogs' => $blogs,
			'newProducts' => $newProducts,
			'categories' => $categories,
		]);
	}
	
	// Loads blogDetails view 
	public function blogDetails($blogId){
		$newProducts = Product::orderBy('id','desc')
               ->take(3)
               ->get();
		$blog = Blog::find($blogId);
		$categories = Category::all();
		$siteinfos = Siteinfo::all();
			   
		return view('blog-single', [
			'blog' => $blog,
			'blogId' => $blogId,
			'newProducts' => $newProducts,
			'categories' => $categories,
			'siteinfos' => $siteinfos,
			]);
	}
	
	// Loads addBlog view 
	public function addBlog(){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		$categories = Category::all();
		
		return view('admin.addBlog', [
		'categories' => $categories
		]);
	}
	
	// Insert new Blog
	public function insertBlog(Request $request){
		// Validate form
		$validatedData = $this->validate($request, [
        'blogTitle' => 'required',
        'description' => 'required',
        'blogImage' => 'required|image|mimes:png,jpg,jpeg|max:100'
		]);
				
		
		// Handel image upload 
		
		// Checks if the file exists
		if ($request->hasFile('blogImage')){
			// Get file name with extension
			$fileNameWithExt = $request->file('blogImage')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('blogImage')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('blogImage')->storeAs('public/images/blog', $fileNameToStore);    
		}else{
			Session::put('error', 'Blog addition failed!');
			return redirect('/addBlog');
		}

		// Create instance of Blog model & assign form value then save to database
		$blog = new Blog;
		$blog->blogTitle = $request->blogTitle;
		$blog->description = $request->description;
		$blog->category_id = $request->category_id;
		$blog->blogImage = $fileNameToStore;
		$blog->save();
		
		
		/* Checks if data is saved to database. If so, redirect to addBlog page with success message. Otherwise, redirect to addBlog page with error message */
		if($blog){
			Session::put('success', 'Blog added successfully.');
			return redirect('/addBlog');
		}else{
			Session::put('error', 'Blog addition failed!');
			return redirect('/addBlog');
		}
	}
	
	// Loads allBlogs view
	public function allBlogs(Request $request){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		$result = Blog::all();
		
		return view('admin.allBlogs', [
		'blogs' => $result
		]);
	}
		
	// Loads editBlog view
	public function editBlog($blogId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return Redirect::to('/administration');
		}
		$result = Blog::where('id', $blogId)
               ->get();
		$categories = Category::all();
		
		return view('admin.editBlog', [
		'blogs' => $result,
		'categories' => $categories,
		'id' => $blogId
		]);
	}
	
	// Update blog & loads editBlog view with success or error message
	public function updateBlog(Request $request, $blogId){
		// Validate form
		$validatedData = $this->validate($request, [
        'blogTitle' => 'required',
        'description' => 'required',
        'blogImage' => 'image|mimes:png,jpg,jpeg|max:100'
		]);
				
		
		// Handel image upload 
		
		// Checks if the file exists. If exists upload new image and update database with new data
		if ($request->hasFile('blogImage')){
			// Get file name with extension
			$fileNameWithExt = $request->file('blogImage')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('blogImage')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('blogImage')->storeAs('public/images/blog', $fileNameToStore);  

			// Create instance of Blog model & assign form value then save to database
			$blog = Blog::find($blogId);
			// Get blogImage & delete it from the directory
			Storage::delete('public/images/blog/'.$blog->blogImage);
			$blog->blogTitle = $request->blogTitle;
			$blog->description = $request->description;
			$blog->category_id = $request->category_id;
			$blog->blogImage = $fileNameToStore;
			$blog->save();
				
			/* Checks if data is updated to database. If so, redirect to editBlog page with success message. Otherwise, redirect to editBlog page with error message */
			if($blog){
				Session::put('success', 'Blog updated successfully.');
				return redirect('/editBlog/'.$blogId);
			}else{
				Session::put('error', 'Blog update failed!');
				return redirect('/editBlog/'.$blogId);
			}			
		}
		
		// If image not selected update without editing the blogImage field
		else{
			// Create instance of Blog model & assign form value then save to database
			$blog = Blog::find($blogId);
			$blog->blogTitle = $request->blogTitle;
			$blog->description = $request->description;
			$blog->category_id = $request->category_id;
			$blog->save();
				
			/* Checks if data is updated to database. If so, redirect to editBlog page with success message. Otherwise, redirect to editBlog page with error message */
			if($blog){
				Session::put('success', 'Blog updated successfully.');
				return redirect('/editBlog/'.$blogId);
			}else{
				Session::put('error', 'Blog update failed!');
				return redirect('/editBlog/'.$blogId);
			}
		}	
	}
	
	// Delete blog
	public function deleteBlog($blogId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		$result = Blog::find($blogId);
		// Get blogImage & delete it from the directory
		Storage::delete('public/images/blog/'.$result->blogImage);
		$result->delete();
				
		if($result){
			Session::put('success', 'Blog deleted successfully.');
			return redirect('/all-blogs');
		}else{
			Session::put('error', 'Blog delete failed!');
			return redirect('/all-blogs');
		}
	}

	// Add blog review
	public function addBlogReview($blogId, Request $request){
		// Validate form data 
		$validatedData = $this->validate($request, [
        'UserName' => 'required',
		'email' => 'required|email',
		'comment' => 'required',
		]);

		// Create a new Productcomment instance & assign form value then save to database
		$blogcomment = new Blogcomment;
		$blogcomment->UserName = $request->UserName;
		$blogcomment->email = $request->email;
		$blogcomment->comment = $request->comment;
		$blogcomment->blogReview = $request->optradio;
		$blogcomment->blog_id = $blogId;
		$blogcomment->save();

		// Check insertion
		if($blogcomment){
			return redirect()->back()->with('success', "Thanks for your review.");
		}else{
			return redirect()->back()->with('error', "Couldn't add review!");
		}
	}
}
