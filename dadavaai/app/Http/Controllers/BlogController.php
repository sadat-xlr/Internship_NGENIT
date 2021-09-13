<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Category;
use App\Blogcomment;
use Session;

// Blog Controller
class BlogController extends Controller
{
    // Loads all-blogs view 
	public function dadavaaiBlogs(){
		$blogs = Blog::paginate(4);
		$categories = Category::all();
		$recentBlogs =	Blog::orderBy('created_at', 'Desc')->take(4)->get();


		return view('client.blog.blogs', compact('blogs','categories', 'recentBlogs'));
	}

	// Loads blogDetails view 
	public function singleBlog($blogId, $slug){

		$blog = Blog::find($blogId);
		$categories = Category::all();
		$recentBlogs =	Blog::orderBy('created_at', 'Desc')->take(4)->get();
			   
		return view('client.blog.singleBlog', [
			'blog' => $blog,
			'blogId' => $blogId,
			'categories' => $categories,
			'recentBlogs' => $recentBlogs,
			]);
	}
	
	// Loads all-blogs view 
	public function index(){
		$blogs = Blog::paginate(4);
		$categories = Category::all();

		return view('admin.blog.list', [
			'blogs' => $blogs,
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

		$categories = Category::all();
		
		return view('admin.blog.create', [
		'categories' => $categories
		]);
	}
	
	// Insert new Blog
	public function storeBlog(Request $request){


		// Validate form
		$validatedData = $this->validate($request, [
        'blogTitle' => 'required',
        'description' => 'required',
        'blogImage' => 'required|image|max:2048'
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
			return redirect('/add-blog');
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
			return redirect('/blogs');
		}else{
			Session::put('error', 'Blog addition failed!');
			return redirect('/add-blog');
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

		$result = Blog::where('id', $blogId)
               ->first();
		$categories = Category::all();		
		return view('admin..blog.edit', [
		'blog' => $result,
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
				return redirect('/edit-blog/'.$blogId.'/edit');
			}else{
				Session::put('error', 'Blog update failed!');
				return redirect('/edit-blog/'.$blogId.'/edit');
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
				return redirect('/edit-blog/'.$blogId.'/edit');
			}else{

				Session::put('error', 'Blog update failed!');
				return redirect('/edit-blog/'.$blogId.'/edit');
			}
		}	
	}
	
	// Delete blog
	public function deleteBlog($blogId){

		$result = Blog::find($blogId);
		// Get blogImage & delete it from the directory
		Storage::delete('public/images/blog/'.$result->blogImage);
		$result->delete();
				
		if($result){
			Session::put('success', 'Blog deleted successfully.');
			return redirect('/blogs');
		}else{
			Session::put('error', 'Blog delete failed!');
			return redirect('/blogs');
		}
	}

	// Add blog review
	public function addBlogComment($blogId, Request $request){

		// Validate form data 
		$validatedData = $this->validate($request, [
        'userName' => 'required',
		'email' => 'required|email',
		'comment' => 'required',
		]);

		// Create a new Productcomment instance & assign form value then save to database
		$blogcomment = new Blogcomment;
		$blogcomment->userName = $request->userName;
		$blogcomment->email = $request->email;
		$blogcomment->comment = $request->comment;
		$blogcomment->blog_id = $blogId;
		$blogcomment->save();

		// Check insertion
		if($blogcomment){
			return redirect()->back()->with('success', "Thanks for your Comment.");
		}else{
			return redirect()->back()->with('error', "Couldn't add Comment!");
		}
	}
}
