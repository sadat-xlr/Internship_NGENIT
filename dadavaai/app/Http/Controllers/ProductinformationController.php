<?php

namespace App\Http\Controllers;

use App\Productinformation;
use App\Product;
use Illuminate\Http\Request;
use Response;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ProductinformationController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Productinformation  $productinformation
     * @return \Illuminate\Http\Response
     */
    public function information( $id)
    {
        $productInformation = Productinformation::findOrFail($id);
        $product = Product::find($productInformation->product_id);
        $relatedProducts = Product::where('tab_id', $product->tab->id)->inRandomOrder()->get();

        return view('client.product.adSinglePage', compact('productInformation', 'relatedProducts'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all faqs info
        $productInformations = Productinformation::all();
        $products = Product::all();

        // Return view
        return view('admin.productsInformation', compact('productInformations', 'products'));
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
        
        // return response()->json($request->image_1);
        // Validate form data
        $rules = array(
            'product_id' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails())
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));

        else{
            // Handle image upload

            $fileNameToStore_image_1 = null;
            $fileNameToStore_image_2 = null;
            $fileNameToStore_image_3 = null;
            $fileNameToStore_image_4 = null;
            // Checks if the file exists
            if ($request->hasFile('image_1')){
                // Get file name with extension
                $fileNameWithExt = $request->file('image_1')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('image_1')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_image_1 = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('image_1')->storeAs('public/images/productInformation', $fileNameToStore_image_1);
            }
            // Checks if the file exists
            if ($request->hasFile('image_2')){
                // Get file name with extension
                $fileNameWithExt = $request->file('image_2')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('image_2')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_image_2 = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('image_2')->storeAs('public/images/productInformation', $fileNameToStore_image_2);
            }
            // Checks if the file exists
            if ($request->hasFile('image_3')){
                // Get file name with extension
                $fileNameWithExt = $request->file('image_3')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('image_3')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_image_3 = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('image_3')->storeAs('public/images/productInformation', $fileNameToStore_image_3);
            }

            // Checks if the file exists
            if ($request->hasFile('image_4')){
                // Get file name with extension
                $fileNameWithExt = $request->file('image_4')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('image_4')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_image_4 = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('image_4')->storeAs('public/images/productInformation', $fileNameToStore_image_4);
            }

            // Create instance of Productinformation model & assign form value then save to database


            $Productinformations = new Productinformation();

            $Productinformations->product_id  = $request->product_id;

            $Productinformations->description_1 = $request->description_1;
            $Productinformations->description_2 = $request->description_2;
            $Productinformations->description_3 = $request->description_3;
            $Productinformations->description_4 = $request->description_4;

            if($fileNameToStore_image_1 != null)
            {
                $Productinformations->image_1  =  $fileNameToStore_image_1;
            }
            if($fileNameToStore_image_2 != null)
            {
                $Productinformations->image_2  =  $fileNameToStore_image_2;
            }
            if($fileNameToStore_image_3 != null)
            {
                $Productinformations->image_3  =  $fileNameToStore_image_3;
            }
            
            if($fileNameToStore_image_4 != null)
            {
                $Productinformations->image_4  =  $fileNameToStore_image_4;
            }

            $Productinformations->save();
            return response()->json($Productinformations);
        }       
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Productinformation  $productinformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
            // Handle image upload

            $productInformation =  Productinformation::with('product')->find($id);

            $fileNameToStore_image_1 = null;
            $fileNameToStore_image_2 = null;
            $fileNameToStore_image_3 = null;
            $fileNameToStore_image_4 = null;
            // Checks if the file exists
            if ($request->hasFile('image_1')){
                // Get file name with extension
                $fileNameWithExt = $request->file('image_1')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('image_1')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_image_1 = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('image_1')->storeAs('public/images/productInformation', $fileNameToStore_image_1);
                Storage::delete('public/images/productInformation/'.$productInformation->image_1);
            }
            // Checks if the file exists
            if ($request->hasFile('image_2')){
                // Get file name with extension
                $fileNameWithExt = $request->file('image_2')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('image_2')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_image_2 = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('image_2')->storeAs('public/images/productInformation', $fileNameToStore_image_2);
                Storage::delete('public/images/productInformation/'.$productInformation->image_2);
            }
            // Checks if the file exists
            if ($request->hasFile('image_3')){
                // Get file name with extension
                $fileNameWithExt = $request->file('image_3')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('image_3')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_image_3 = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('image_3')->storeAs('public/images/productInformation', $fileNameToStore_image_3);
                Storage::delete('public/images/productInformation/'.$productInformation->image_3);
            }

            // Checks if the file exists
            if ($request->hasFile('image_4')){
                // Get file name with extension
                $fileNameWithExt = $request->file('image_4')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('image_4')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore_image_4 = $fileName . time() . "." . $extension;
                // Directory to upload
                $path = $request->file('image_4')->storeAs('public/images/productInformation', $fileNameToStore_image_4);
                Storage::delete('public/images/productInformation/'.$productInformation->image_4);
            }

            // Create instance of Productinformation model & assign form value then save to database

            $productInformation->description_1 = $request->description_1;
            $productInformation->description_2 = $request->description_2;
            $productInformation->description_3 = $request->description_3;
            $productInformation->description_4 = $request->description_4;

            if($fileNameToStore_image_1 != null)
            {
                $productInformation->image_1  =  $fileNameToStore_image_1;
            }
            if($fileNameToStore_image_2 != null)
            {
                $productInformation->image_2  =  $fileNameToStore_image_2;
            }
            if($fileNameToStore_image_3 != null)
            {
                $productInformation->image_3  =  $fileNameToStore_image_3;
            }
            
            if($fileNameToStore_image_4 != null)
            {
                $productInformation->image_4  =  $fileNameToStore_image_4;
            }

            $productInformation->save();
            return response()->json($productInformation);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Productinformation  $productinformation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productInformation =  Productinformation::find($id);
    
        // Checks if the file exists
        if ($productInformation->image_1){
            Storage::delete('public/images/productInformation/'.$productInformation->image_1);
        }
        // Checks if the file exists
        if ($productInformation->image_2){
            Storage::delete('public/images/productInformation/'.$productInformation->image_2);
        }
        // Checks if the file exists
        if ($productInformation->image_3){
            Storage::delete('public/images/productInformation/'.$productInformation->image_3);
        }

        // Checks if the file exists
        if ($productInformation->image_4){
            Storage::delete('public/images/productInformation/'.$productInformation->image_4);
        }

        $productInformation->delete();

        return response()->json();
    }
}
