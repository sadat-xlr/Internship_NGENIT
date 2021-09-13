<?php

namespace App\Http\Controllers;

use App\News;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use DB;
use Carbon\Carbon;

class NewsController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mediaArchive(Request $request)
    {
		
		if ($request->month) {
			
			
			$news = DB::table('news')->where(DB::raw('MONTH(created_at)'),$request->month)->paginate(10);
			// return response()->json($news);
			$news_by_month = DB::table('news')
						->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) news_count'))
						->groupBy('year')
						->groupBy('month')
						->orderBy('year', 'desc')
						->orderBy('month', 'desc')
						->get();	
			
			return view('informative.news.mediaArchive', compact('news', 'news_by_month'));
		} else {
			$news = News::orderBy('created_at','desc')->paginate(10);
			$news_by_month = DB::table('news')
						->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) news_count'))
						->groupBy('year')
						->groupBy('month')
						->orderBy('year', 'desc')
						->orderBy('month', 'desc')
						->get();	
			// return response()->json($news_by_month);
			return view('informative.news.mediaArchive', compact('news', 'news_by_month'));
		}
		

		
    }


	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function news()
    {
		$result = News::orderBy('created_at','desc')->paginate(10);
		
		return view('informative.news.news', [
		'news' => $result
		]);
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allNews()
    {
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		$result = News::all();
		
		return view('admin.allNews', [
		'news' => $result
		]);
    }

    // Loads addNews view 
    public function addNews(){
        // Checks if logged in
        if (!\Session::has('Name')){
            return redirect('/administration');
        }
        $categories = Category::all();
        
        return view('admin.addNews', [
        'categories' => $categories
        ]);
    }

    // Insert new News
    public function insertNews(Request $request){
        
        // Validate form
        $validatedData = $this->validate($request, [
        'newsTitle' => 'required',
        'description' => 'required',
        'newsImage' => 'required|image|mimes:png,jpg,jpeg|max:100'
        ]);
                
        $fileNameToStore= '';
        // Handel image upload 
        
        // Checks if the file exists
        if ($request->hasFile('newsImage')){
            // Get file name with extension
            $fileNameWithExt = $request->file('newsImage')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('newsImage')->getClientOriginalExtension();
            // Filename to store 
            $fileNameToStore = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('newsImage')->storeAs('public/images/news', $fileNameToStore);    
        }else{
            Session::put('error', 'News addition failed!');
            return redirect('/addNews');
        }

        // Create instance of News model & assign form value then save to database
        $news = new News;
        $news->newsTitle = $request->newsTitle;
        $news->description = $request->description;
        $news->category_id = $request->category_id;
        $news->newsImage = $fileNameToStore;

        $news->save();

        /* Checks if data is saved to database. If so, redirect to addBlog page with success message. Otherwise, redirect to addNews page with error message */
        if($news){
            Session::put('success', 'News added successfully.');
            return redirect('/addNews');
        }else{
            Session::put('error', 'News addition failed!');
            return redirect('/addNews');
        }
    }

    public function editNews($newsId){
		// Checks if logged in
		if (!\Session::has('Name')){
			return Redirect::to('/administration');
		}
		$result = News::where('id', $newsId)
               ->get();
		$categories = Category::all();
		
		return view('admin.editNews', [
		'news' => $result,
		'categories' => $categories,
		'id' => $newsId
		]);
    }
    
    	// Update blog & loads editBlog view with success or error message
	public function updateNews(Request $request, $newsId){
		// Validate form
		$validatedData = $this->validate($request, [
        'newsTitle' => 'required',
        'description' => 'required',
        'newsImage' => 'image|mimes:png,jpg,jpeg|max:100'
		]);
				
		
		// Handel image upload 
		
		// Checks if the file exists. If exists upload new image and update database with new data
		if ($request->hasFile('newsImage')){
			// Get file name with extension
			$fileNameWithExt = $request->file('newsImage')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('newsImage')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('newsImage')->storeAs('public/images/blog', $fileNameToStore);  

			// Create instance of Blog model & assign form value then save to database
			$news = Blog::find($newsId);
			// Get blogImage & delete it from the directory
			Storage::delete('public/images/news/'.$news->newsImage);
			$news->newsTitle = $request->newsTitle;
			$news->description = $request->description;
			$news->category_id = $request->category_id;
			$news->newsImage = $fileNameToStore;
			$news->save();
				
			/* Checks if data is updated to database. If so, redirect to editBlog page with success message. Otherwise, redirect to editBlog page with error message */
			if($news){
				Session::put('success', 'news updated successfully.');
				return redirect('editNews/'.$newsId);
			}else{
				Session::put('error', 'Blog update failed!');
				return redirect('/editNews/'.$newsId);
			}			
		}
		
		// If image not selected update without editing the blogImage field
		else{
			// Create instance of Blog model & assign form value then save to database
			$news = News::find($newsId);
			$news->newsTitle = $request->newsTitle;
			$news->description = $request->description;
			$news->category_id = $request->category_id;
			$news->save();
				
			/* Checks if data is updated to database. If so, redirect to editBlog page with success message. Otherwise, redirect to editBlog page with error message */
			if($news){
				Session::put('success', 'Blog updated successfully.');
				return redirect('editNews/'.$newsId);
			}else{
				Session::put('error', 'Blog update failed!');
				return redirect('editNews/'.$newsId);
			}
		}	
	}

	// Delete blog
	public function deleteNews($id){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		$result = News::find($id);
		// Get newsImage & delete it from the directory
		Storage::delete('public/images/news/'.$result->newsImage);
		$result->delete();
				
		if($result){
			Session::put('success', 'News deleted successfully.');
			return redirect('/all-news');
		}else{
			Session::put('error', 'News delete failed!');
			return redirect('/all-news');
		}
	}
}
