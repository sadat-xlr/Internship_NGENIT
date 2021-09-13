<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authenticate');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all banners
        $banners = Banner::all()->sortByDesc('id');

        return view('admin.banners', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return view
        return view('admin.addBanner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileNameToStore = '';
        $fileNameToStore1 = '';
        $fileNameToStore2 = '';
        $fileNameToStore3 = '';
        
        // Checks if the file exists
        if ($request->hasFile('banner_one')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_one')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_one')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_one')->storeAs('public/images/banner', $fileNameToStore);
        }

        // Checks if the file exists
        if ($request->hasFile('banner_two')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_two')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_two')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore1 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_two')->storeAs('public/images/banner', $fileNameToStore1);
        }

        // Checks if the file exists
        if ($request->hasFile('banner_three')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_three')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_three')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore3 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_three')->storeAs('public/images/banner', $fileNameToStore3);
        }

        // Checks if the file exists
        if ($request->hasFile('banner_four')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_four')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_four')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore4 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_four')->storeAs('public/images/banner', $fileNameToStore4);
        }

        // Create instance of Banner model & assign form value then save to database
        $banner = new Banner();
        $banner->banner_one = $fileNameToStore;
        $banner->banner_two = $fileNameToStore1;
        $banner->banner_three = $fileNameToStore3;
        $banner->banner_four = $fileNameToStore4;
        $banner->link1 = $request->link1;
        $banner->link2 = $request->link2;
        $banner->link3 = $request->link3;
        $banner->link4 = $request->link4;
        $banner->save();

        return redirect()->back()->with('success', 'Banner added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        // Find the banner
        $banner = Banner::find($banner->id);

        // Checks if the file exists
        if ($request->hasFile('banner_one')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_one')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_one')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_one')->storeAs('public/images/banner', $fileNameToStore);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->banner_one);
            // Assign new value
            $banner->banner_one = $fileNameToStore;
        }

        // Checks if the file exists
        if ($request->hasFile('banner_two')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_two')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_two')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore1 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_two')->storeAs('public/images/banner', $fileNameToStore1);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->banner_two);
            // Assign new value
            $banner->banner_two = $fileNameToStore1;
        }

        // Checks if the file exists
        if ($request->hasFile('banner_three')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_three')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_three')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore3 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_three')->storeAs('public/images/banner', $fileNameToStore3);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->banner_three);
            // Assign new value
            $banner->banner_three = $fileNameToStore3;
        }

        // Checks if the file exists
        if ($request->hasFile('banner_four')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_four')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_four')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore4 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_four')->storeAs('public/images/banner', $fileNameToStore4);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->banner_four);
            // Assign new value
            $banner->banner_four = $fileNameToStore4;
        }

        $banner->link1 = $request->link1;
        $banner->link2 = $request->link2;
        $banner->link3 = $request->link3;
        $banner->link4 = $request->link4;
        $banner->save();

        return response()->json($banner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        // Find the banner
        $banner = Banner::find($banner->id);

        // Get previous banner & delete it from the directory
        Storage::delete('public/images/banner/'.$banner->banner_one);

        // Get previous banner & delete it from the directory
        Storage::delete('public/images/banner/'.$banner->banner_two);

        // Delete from database
        $banner->delete();

        return response()->json();
    }
}
