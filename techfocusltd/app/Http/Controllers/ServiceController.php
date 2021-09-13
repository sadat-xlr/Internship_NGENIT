<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Session;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticate')->except('index', 'show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services=  Service::all();
        return view('informative.service.services')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.informative.service.create');
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
        'serviceTitle' => 'required',
        'description' => 'required',
        'serviceImage' => 'required|image|mimes:png,jpg,jpeg|max:100'
		]);
				
		
		// Handel image upload 
		
		// Checks if the file exists
		if ($request->hasFile('serviceImage')){
			// Get file name with extension
			$fileNameWithExt = $request->file('serviceImage')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('serviceImage')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . time() . "." . $extension;
			// Directory to upload
			$path = $request->file('serviceImage')->storeAs('public/images/service', $fileNameToStore);    
		}else{
			Session::put('error', 'Service addition failed!');
			return redirect('/addservice');
		}

		// Create instance of Blog model & assign form value then save to database
		$service = new Service;
		$service->title = $request->serviceTitle;
        $service->image = $fileNameToStore;
        $service->description = $request->description;
        $service->slug  =   str_slug($request->serviceTitle);
		
		/* Checks if data is saved to database. If so, redirect to addBlog page with success message. Otherwise, redirect to addBlog page with error message */
		if($service->save()){
			Session::put('success', 'Service added successfully.');
			return redirect('/addservice');
		}else{
			Session::put('error', 'Service addition failed!');
			return redirect('/addservice');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($id,$slug)
    {
        $service    =   Service::find($id)->where('slug',$slug)->first();
        $services   =   Service::all();
        return view('informative.service.serviceDetails')->with('service',$service)
                                                         ->with('services',$services);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
