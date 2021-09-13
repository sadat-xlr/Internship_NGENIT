<?php

namespace App\Http\Controllers;

use App\Productsad;
use App\Product;
use Response;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ProductsadController extends Controller
{
    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all ads
        $productsAds = Productsad::all()->sortByDesc('id');
        // Get all products
        $products = Product::all()->where('published', false)->sortByDesc('id');
        return view('admin.productsAds', compact('productsAds', 'products'));
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
            'ad1Image' => 'required|image|max:1000',
            'ad1Product_id' => 'required',
            'ad2Image' => 'required|image|max:1000',
            'ad2Product_id' => 'required',
            'ad3Image' => 'required|image|max:1000',
            'ad4Image' => 'required|image|max:1000',
            'ad3Product_id' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Handle image upload

            // Checks if the file exists
            if ($request->hasFile('ad1Image')){
                // Get file name with extension
                $fileNameWithExt = $request->file('ad1Image')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('ad1Image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_ad1Image = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('ad1Image')->storeAs('public/images/ads', $fileNameToStore_ad1Image);
            }
            // Checks if the file exists
            if ($request->hasFile('ad2Image')){
                // Get file name with extension
                $fileNameWithExt = $request->file('ad2Image')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('ad2Image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_ad2Image = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('ad2Image')->storeAs('public/images/ads', $fileNameToStore_ad2Image);
            }
            // Checks if the file exists
            if ($request->hasFile('ad3Image')){
                // Get file name with extension
                $fileNameWithExt = $request->file('ad3Image')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('ad3Image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_ad3Image = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('ad3Image')->storeAs('public/images/ads', $fileNameToStore_ad3Image);
            }

            // Checks if the file exists
            if ($request->hasFile('ad4Image')){
                // Get file name with extension
                $fileNameWithExt = $request->file('ad4Image')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('ad4Image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_ad4Image = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('ad4Image')->storeAs('public/images/ads', $fileNameToStore_ad4Image);
            }

            // Create instance of Banner model & assign form value then save to database
            $productsad = new Productsad;
            $productsad->ad1Image       = $fileNameToStore_ad1Image;
            $productsad->ad2Image       = $fileNameToStore_ad2Image;
            $productsad->ad3Image       = $fileNameToStore_ad3Image;
            $productsad->ad4Image       = $fileNameToStore_ad4Image;

            $productsad->ad1Product_id  = $request->ad1Product_id;
            $productsad->ad2Product_id  = $request->ad2Product_id;
            $productsad->ad3Product_id  = $request->ad3Product_id;

            $productsad->save();
            return response()->json($productsad);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Productsad  $productsad
     * @return \Illuminate\Http\Response
     */
    public function show(Productsad $productsad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Productsad  $productsad
     * @return \Illuminate\Http\Response
     */
    public function edit(Productsad $productsad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Productsad  $productsad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate form data
        $rules = array(
            'ad1Image' => 'image|max:1000',
            'ad1Product_id' => 'required',
            'ad2Image' => 'image|max:1000',
            'ad2Product_id' => 'required',
            'ad3Image' => 'image|max:1000',
            'ad4Image' => 'image|max:1000',
            'ad3Product_id' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            
            $productsad = Productsad::find($id);

            // Handle image upload

            // Checks if the file exists
            if ($request->hasFile('ad1Image')){
                // Get file name with extension
                $fileNameWithExt = $request->file('ad1Image')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('ad1Image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_ad1Image = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('ad1Image')->storeAs('public/images/ads', $fileNameToStore_ad1Image);
                Storage::delete('public/images/ads/'.$productsad->ad1Image);
                $productsad->ad1Image = $fileNameToStore_ad1Image;
            }
            // Checks if the file exists
            if ($request->hasFile('ad2Image')){
                // Get file name with extension
                $fileNameWithExt = $request->file('ad2Image')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('ad2Image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_ad2Image = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('ad2Image')->storeAs('public/images/ads', $fileNameToStore_ad2Image);
                Storage::delete('public/images/ads/'.$productsad->ad2Image);
                $productsad->ad2Image = $fileNameToStore_ad2Image;

            }
            if ($request->hasFile('ad3Image')){
                // Get file name with extension
                $fileNameWithExt = $request->file('ad3Image')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('ad3Image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_ad3Image = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('ad3Image')->storeAs('public/images/ads', $fileNameToStore_ad3Image);
                Storage::delete('public/images/ads/'.$productsad->ad3Image);
                $productsad->ad3Image = $fileNameToStore_ad3Image;

            }

            if ($request->hasFile('ad4Image')){
                // Get file name with extension
                $fileNameWithExt = $request->file('ad4Image')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('ad4Image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_ad4Image = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('ad4Image')->storeAs('public/images/ads', $fileNameToStore_ad4Image);
                Storage::delete('public/images/ads/'.$productsad->ad4Image);
                $productsad->ad4Image = $fileNameToStore_ad4Image;

            }            

            // Create instance of Banner model & assign form value then save to database
            if($request->ad1Product_id != 0){
                $productsad->ad1Product_id = $request->ad1Product_id;
            }
            if($request->ad2Product_id != 0){
                $productsad->ad2Product_id = $request->ad2Product_id;
            }
            if($request->ad3Product_id != 0){
                $productsad->ad3Product_id = $request->ad3Product_id;
            }

            $productsad->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Productsad  $productsad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the offer & delete it
        $productsad =  Productsad::find($id)->delete();
        // Delete images from the directory & then from database
        Storage::delete('public/images/ads/'.$productsad->ad1Image);
        // Delete images from the directory & then from database
        Storage::delete('public/images/ads/'.$productsad->ad2Image);
        // Delete images from the directory & then from database
        Storage::delete('public/images/ads/'.$productsad->ad3Image);
        // Delete images from the directory & then from database
        Storage::delete('public/images/ads/'.$productsad->ad4Image);        

        return response()->json();
    }
}
