<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Validator;
use Response;



class BannerController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // Validate form data
        $rules = array(
            'home_one' => 'required|image|max:1000',
            'home_one_link' => 'required',
            'home_two' => 'required|image|max:1000',
            'home_two_link' => 'required',
            'home_three' => 'required|image|max:1000',
            'home_three_link' => 'required',
            'header_one' => 'required|image|max:1000',
            'header_one_link' => 'required',
            'header_two' => 'required|image|max:1000',
            'header_two_link' => 'required',
            'header_three' => 'required|image|max:1000',
            'header_three_link' => 'required',
            'banner_category_page' => 'required|image|max:1000',
            'banner_link_category_page' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Handle image upload

            // Checks if the file exists
            if ($request->hasFile('home_one')){
                // Get file name with extension
                $fileNameWithExt = $request->file('home_one')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('home_one')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_home_one = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('home_one')->storeAs('public/images/banner', $fileNameToStore_home_one);
            }
            // Checks if the file exists
            if ($request->hasFile('home_two')){
                // Get file name with extension
                $fileNameWithExt = $request->file('home_two')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('home_two')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_home_two = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('home_two')->storeAs('public/images/banner', $fileNameToStore_home_two);
            }
            // Checks if the file exists
            if ($request->hasFile('home_three')){
                // Get file name with extension
                $fileNameWithExt = $request->file('home_three')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('home_three')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_home_three = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('home_three')->storeAs('public/images/banner', $fileNameToStore_home_three);
            }
            // Checks if the file exists
            if ($request->hasFile('header_one')){
                // Get file name with extension
                $fileNameWithExt = $request->file('header_one')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('header_one')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_header_one = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('header_one')->storeAs('public/images/banner', $fileNameToStore_header_one);
            }
            // Checks if the file exists
            if ($request->hasFile('header_two')){
                // Get file name with extension
                $fileNameWithExt = $request->file('header_two')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('header_two')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_header_two = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('header_two')->storeAs('public/images/banner', $fileNameToStore_header_two);
            }
            // Checks if the file exists
            if ($request->hasFile('header_three')){
                // Get file name with extension
                $fileNameWithExt = $request->file('header_three')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('header_three')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_header_three = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('header_three')->storeAs('public/images/banner', $fileNameToStore_header_three);
            }
            // Checks if the file exists
            if ($request->hasFile('banner_category_page')){
                // Get file name with extension
                $fileNameWithExt = $request->file('banner_category_page')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('banner_category_page')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_banner_category_page = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('banner_category_page')->storeAs('public/images/banner', $fileNameToStore_banner_category_page);
            }
            // Checks if the file exists
            if ($request->hasFile('banner_brand_page')){
                // Get file name with extension
                $fileNameWithExt = $request->file('banner_brand_page')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('banner_brand_page')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_banner_brand_page = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('banner_brand_page')->storeAs('public/images/banner', $fileNameToStore_banner_brand_page);
            }
            // Checks if the file exists
            if ($request->hasFile('banner_brand_single_page')){
                // Get file name with extension
                $fileNameWithExt = $request->file('banner_brand_single_page')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('banner_brand_single_page')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_banner_brand_single_page = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('banner_brand_single_page')->storeAs('public/images/banner', $fileNameToStore_banner_brand_single_page);
            }
            // Checks if the file exists
            if ($request->hasFile('banner_product_page')){
                // Get file name with extension
                $fileNameWithExt = $request->file('banner_product_page')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('banner_product_page')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_banner_product_page = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('banner_product_page')->storeAs('public/images/banner', $fileNameToStore_banner_product_page);
            }
            // Checks if the file exists
            if ($request->hasFile('banner_searched_product_page')){
                // Get file name with extension
                $fileNameWithExt = $request->file('banner_searched_product_page')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('banner_searched_product_page')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_banner_searched_product_page = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('banner_searched_product_page')->storeAs('public/images/banner', $fileNameToStore_banner_searched_product_page);
            }

            // Create instance of Banner model & assign form value then save to database
            $banner = new Banner;
            $banner->home_one = $fileNameToStore_home_one;
            $banner->home_two = $fileNameToStore_home_two;
            $banner->home_three = $fileNameToStore_home_three;
            $banner->header_one = $fileNameToStore_header_one;
            $banner->header_two = $fileNameToStore_header_two;
            $banner->header_three = $fileNameToStore_header_three;
            $banner->banner_category_page = $fileNameToStore_banner_category_page;
            $banner->banner_brand_page = $fileNameToStore_banner_brand_page;
            $banner->banner_brand_single_page = $fileNameToStore_banner_brand_single_page;
            $banner->banner_product_page = $fileNameToStore_banner_product_page;
            $banner->banner_searched_product_page = $fileNameToStore_banner_searched_product_page;
            $banner->home_one_link = $request->home_one_link;
            $banner->home_two_link = $request->home_two_link;
            $banner->home_three_link = $request->home_three_link;
            $banner->banner_link_category_page = $request->banner_link_category_page;
            $banner->banner_link_brand_page = $request->banner_link_brand_page;
            $banner->banner_link_brand_single_page = $request->banner_link_brand_single_page;
            $banner->banner_link_product_page = $request->banner_link_product_page;
            $banner->banner_link_searched_product_page = $request->banner_link_searched_product_page;
            $banner->header_one_link = $request->header_one_link;
            $banner->header_two_link = $request->header_two_link;
            $banner->header_three_link = $request->header_three_link;
            $banner->save();
            return response()->json($banner);
        }
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
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        // Handle image upload
        // Checks if the file exists
        if ($request->hasFile('home_one')){
            // Get file name with extension
            $fileNameWithExt = $request->file('home_one')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('home_one')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_home_one = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('home_one')->storeAs('public/images/banner', $fileNameToStore_home_one);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->home_one);
            // Assign new value
            $banner->home_one = $fileNameToStore_home_one;
        }
        // Checks if the file exists
        if ($request->hasFile('home_two')){
            // Get file name with extension
            $fileNameWithExt = $request->file('home_two')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('home_two')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_home_two = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('home_two')->storeAs('public/images/banner', $fileNameToStore_home_two);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->home_two);
            // Assign new value
            $banner->home_two = $fileNameToStore_home_two;
        }
        // Checks if the file exists
        if ($request->hasFile('home_three')){
            // Get file name with extension
            $fileNameWithExt = $request->file('home_three')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('home_three')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_home_three = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('home_three')->storeAs('public/images/banner', $fileNameToStore_home_three);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->home_three);
            // Assign new value
            $banner->home_three = $fileNameToStore_home_three;
        }
        // Checks if the file exists
        if ($request->hasFile('header_one')){
            // Get file name with extension
            $fileNameWithExt = $request->file('header_one')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('header_one')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_header_one = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('header_one')->storeAs('public/images/banner', $fileNameToStore_header_one);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->header_one);
            // Assign new value
            $banner->header_one = $fileNameToStore_header_one;
        }
        // Checks if the file exists
        if ($request->hasFile('header_two')){
            // Get file name with extension
            $fileNameWithExt = $request->file('header_two')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('header_two')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_header_two = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('header_two')->storeAs('public/images/banner', $fileNameToStore_header_two);

            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->header_two);
            // Assign new value
            $banner->header_two = $fileNameToStore_header_two;
        }
        // Checks if the file exists
        if ($request->hasFile('header_three')){
            // Get file name with extension
            $fileNameWithExt = $request->file('header_three')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('header_three')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_header_three = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('header_three')->storeAs('public/images/banner', $fileNameToStore_header_three);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->header_three);
            // Assign new value
            $banner->header_three = $fileNameToStore_header_three;
        }
        // Checks if the file exists
        if ($request->hasFile('banner_category_page')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_category_page')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_category_page')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_banner_category_page = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_category_page')->storeAs('public/images/banner', $fileNameToStore_banner_category_page);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->banner_category_page);
            // Assign new value
            $banner->banner_category_page = $fileNameToStore_banner_category_page;

        }
        // Checks if the file exists
        if ($request->hasFile('banner_brand_page')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_brand_page')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_brand_page')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_banner_brand_page = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_brand_page')->storeAs('public/images/banner', $fileNameToStore_banner_brand_page);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->banner_brand_page);
            // Assign new value
            $banner->banner_brand_page = $fileNameToStore_banner_brand_page;

        }
        // Checks if the file exists
        if ($request->hasFile('banner_brand_single_page')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_brand_single_page')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_brand_single_page')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_banner_brand_single_page = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_brand_single_page')->storeAs('public/images/banner', $fileNameToStore_banner_brand_single_page);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->banner_brand_single_page);
            // Assign new value
            $banner->banner_brand_single_page = $fileNameToStore_banner_brand_single_page;

        }
        // Checks if the file exists
        if ($request->hasFile('banner_product_page')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_product_page')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_product_page')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_banner_product_page = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_product_page')->storeAs('public/images/banner', $fileNameToStore_banner_product_page);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->banner_product_page);
            // Assign new value
            $banner->banner_product_page = $fileNameToStore_banner_product_page;

        }
        // Checks if the file exists
        if ($request->hasFile('banner_searched_product_page')){
            // Get file name with extension
            $fileNameWithExt = $request->file('banner_searched_product_page')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('banner_searched_product_page')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_banner_searched_product_page = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('banner_searched_product_page')->storeAs('public/images/banner', $fileNameToStore_banner_searched_product_page);
            // Get previous banner & delete it from the directory
            Storage::delete('public/images/banner/'.$banner->banner_searched_product_page);
            // Assign new value
            $banner->banner_searched_product_page = $fileNameToStore_banner_searched_product_page;

        }

        // Create instance of Banner model & assign form value then save to database
        $banner->home_one_link = $request->home_one_link;
        $banner->home_two_link = $request->home_two_link;
        $banner->home_three_link = $request->home_three_link;
        $banner->banner_link_category_page = $request->banner_link_category_page;
        $banner->banner_link_brand_page = $request->banner_link_brand_page;
        $banner->banner_link_brand_single_page = $request->banner_link_brand_single_page;
        $banner->banner_link_product_page = $request->banner_link_product_page;
        $banner->banner_link_searched_product_page = $request->banner_link_searched_product_page;
        $banner->header_one_link = $request->header_one_link;
        $banner->header_two_link = $request->header_two_link;
        $banner->header_three_link = $request->header_three_link;
        $banner->save();
        return response()->json($banner);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        Storage::delete('public/images/banner/'.$banner->home_one);
        Storage::delete('public/images/banner/'.$banner->home_two);
        Storage::delete('public/images/banner/'.$banner->home_three);
        Storage::delete('public/images/banner/'.$banner->header_one);
        Storage::delete('public/images/banner/'.$banner->header_two);
        Storage::delete('public/images/banner/'.$banner->header_three);
        Storage::delete('public/images/banner/'.$banner->banner_category_page);
        Storage::delete('public/images/banner/'.$banner->banner_brand_page);
        Storage::delete('public/images/banner/'.$banner->banner_brand_single_page);
        Storage::delete('public/images/banner/'.$banner->banner_product_page);
        Storage::delete('public/images/banner/'.$banner->banner_searched_product_page);
        
        // Delete from database
        $banner->delete();
        return response()->json();
    }
}
