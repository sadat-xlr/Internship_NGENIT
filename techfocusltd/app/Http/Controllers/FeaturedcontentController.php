<?php

namespace App\Http\Controllers;

use App\Featuredcontent;
use App\Category;
use App\Siteinfo;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

class FeaturedcontentController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticate')->except('index', 'searchByCategory', 'show', 'searchByTag');
    }
    
        /**
     * Search featured content by Category 
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByTag(Request $request){

        if($request->ajax())
        {
            $id = $request->id;
            if($id)
            {
                $featuredcontents = Tag::find($id)->featuredcontents()->get();
                return $featuredcontents;
                if($featuredcontents)
                {
                    // echo json_encode(array('status' => TRUE,  'featuredcontents'=>$featuredcontents)); die;
                    return $featuredcontents;
                }
            }

        }

    }


    /**
     * Search featured content by Category 
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByCategory(Request $request){

        // $featuredcontents = Featuredcontent::where('category_id', $request->id)->get();
        // return $featuredcontents;

        if($request->ajax())
        {
            $id = $request->id;
            if($id)
            {
                $featuredcontents = Featuredcontent::where('category_id', $request->id)->get();
                if($featuredcontents)
                {
                    // echo json_encode(array('status' => TRUE,  'featuredcontents'=>$featuredcontents)); die;
                    return $featuredcontents;
                }
            }

        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featuredcontents    =   Featuredcontent::orderBy('created_at','desc')->paginate('6');

        $categories = Category::all();

        $tags = Tag::all();
        
        return view('informative.featureContent.featuredContents', [
            'categories' => $categories,
            'tags'      => $tags,
            'featuredcontents' => $featuredcontents
            ]);

    }

    /**
     * Display all Content of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allContent()
    {
        $featuredcontents    =   Featuredcontent::orderBy('created_at','desc')->paginate('6');
        return view('admin.informative.featuredContent.featuredContents', [
            'featuredcontents' => $featuredcontents
            ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
        
        $categories = Category::all();

        $tags = Tag::all();
        
        return view('admin.informative.featuredContent.create', [
            'categories' => $categories,
            'tags'      => $tags
            ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    // Validate form
		$validatedData = $this->validate($request, [
        'title' => 'required|max:255',
        'description' => 'required|max:750',
        'image' => 'required|image|mimes:png,jpg,jpeg|max:500|dimensions:min_width=350,min_height=300'
		]);
				
		
		// Handel image upload 
		
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
			$path = $request->file('image')->storeAs('public/images/feturedContent', $fileNameToStore);    
		}else{
			Session::put('error', 'Service addition failed!');
			return redirect('/feature-content-create');
		}

		// Create instance of Blog model & assign form value then save to database
		$featureContent = new Featuredcontent;
        $featureContent->title = $request->title;
        $featureContent->category_id = $request->category_id;
        $featureContent->image = $fileNameToStore;
        $featureContent->description = $request->description;		
		/* Checks if data is saved to database. If so, redirect to addBlog page with success message. Otherwise, redirect to addBlog page with error message */
		if($featureContent->save()){
            Session::put('success', 'Featured content added successfully.');
         // Check if tag is set
        if (isset($request->tag)) {
            // Loop over selected tags
            foreach ($request->tag as $value) {
                // Save to pivot table
                $featureContent->tags()->attach($value);
            }
        }
			return redirect('/feature-content-create');
		}else{
			Session::put('error', 'Featured content addition failed!');
			return redirect('/feature-content-create');
		}



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Featuredcontent  $featuredcontent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $featuredcontent  = Featuredcontent::find($id);
        $categories = Category::all();
        $siteinfos = Siteinfo::all()->first();
        return view('informative.featureContent.show', [
            'categories' => $categories,
            'featuredcontent' => $featuredcontent,
            'siteinfos' => $siteinfos,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Featuredcontent  $featuredcontent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $featuredContent = Featuredcontent::FindOrFail($id);

        $categories = Category::all();
        $featuredContentTags = $featuredContent->Tags()->get();
        $tags = Tag::all();
        return view('admin.informative.featuredContent.edit', [
            'featuredContent' => $featuredContent,
            'categories' => $categories,
            'tags' => $tags,
            'featuredContentTags' => $featuredContentTags
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Featuredcontent  $featuredcontent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        // Validate form
		$validatedData = $this->validate($request, [
        'title' => 'required|max:255',
        'description' => 'required|max:750',
        'image' => 'image|mimes:png,jpg,jpeg|max:500|dimensions:min_width=350,min_height=300'
		]);
				
		// Create instance of Blog model & assign form value then save to database
        $featureContent = Featuredcontent::find($id);
        
		// Handel image upload 
		
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
            $path = $request->file('image')->storeAs('public/images/feturedContent', $fileNameToStore);    
            // Get categoryImage & delete it from the directory
            Storage::delete('public/images/feturedContent/'.$featureContent->image);
		}



        $featureContent->title = $request->title;
        $featureContent->category_id = $request->category_id;
        if($request->image){
            $featureContent->image = $fileNameToStore;
        }
        $featureContent->description = $request->description;		
		/* Checks if data is saved to database. If so, redirect to addBlog page with success message. Otherwise, redirect to addBlog page with error message */
		if($featureContent->save()){
            Session::put('success', 'Featured content Edit successfully done.');
         // Check if tag is set
         
         if (isset($request->tag)) {
            $featureContent->tags()->detach();
            // Loop over selected tags
            foreach ($request->tag as $value) {
                // Save to pivot table
                $featureContent->tags()->attach($value);
            }
        }
			return redirect('edit-featuredcontent/'.$id);
		}else{
			Session::put('error', 'Featured content addition failed!');
			return redirect('/feature-content-create');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Featuredcontent  $featuredcontent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $featureContent = Featuredcontent::find($id);
		// Get blogImage & delete it from the directory
		Storage::delete('public/images/feturedContent/'.$featureContent->image);
		$featureContent->delete();
				
		if($featureContent){
			Session::put('success', 'Content deleted successfully.');
			return redirect('/all-content');
		}else{
			Session::put('error', 'Content delete failed!');
			return redirect('/all-content');
		}
    }
}
