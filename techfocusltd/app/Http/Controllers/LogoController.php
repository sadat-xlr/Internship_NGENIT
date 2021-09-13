<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\Principle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function principleIndex()
    {
        // Get all sliders
        $principles = Principle::all()->sortByDesc('id');

        return view('admin.informative.principle.principles', compact('principles'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all sliders
        $vendors = Vendor::all()->sortByDesc('id');

        return view('admin.informative.vendor.vendors', compact('vendors'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function principleCreate()
    {
        return view('admin.informative.principle.create');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function principleStore(Request $request)
    {
                // Validate form data
        $rules = array(
            'image' => 'required|image|max:1000',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Handle image upload

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
                $path = $request->file('image')->storeAs('public/images/logo/principle/', $fileNameToStore);
            }

            // Create instance of Slider model & assign form value then save to database
            $principle = new Principle;
            $principle->image = $fileNameToStore;
            $principle->save();

            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.informative.vendor.create');
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
            'image' => 'required|image|max:1000',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Handle image upload

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
                $path = $request->file('image')->storeAs('public/images/logo/vendor/', $fileNameToStore);
            }

            // Create instance of Slider model & assign form value then save to database
            $vendor = new Vendor;
            $vendor->image = $fileNameToStore;
            $vendor->save();

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                // Validate form data
                $rules = array(
                    'image' => 'image|max:1000',
                );
        
                $validator = Validator::make ( Input::all(), $rules);
                if ($validator->fails()){
                    return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
                }
        
                // Find the Slider model & assign form value then save to database
                $vendor = Vendor::find($id);
        
                // Handle image upload
        
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
                    $path = $request->file('image')->storeAs('public/images/logo/vendor/', $fileNameToStore);
                    // Get previous logo & delete it from the directory
                    Storage::delete('public/images/logo/vendor/'.$vendor->image);
                    // Save filename to database
                    $vendor->image = $fileNameToStore;
                }
        
                $vendor->save();
        
                return response()->json($vendor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the model instance
        $vendor = Vendor::find ($id);
        // Get logo & delete it from the directory
        Storage::delete('public/images/logo/vendor/'.$vendor->image);
        // Delete it from database
        $vendor->delete();

        return back();
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function principleDestroy($id)
    {
        // Find the model instance
        $principle = Principle::find ($id);
        // Get logo & delete it from the directory
        Storage::delete('public/images/logo/principle/'.$principle->image);
        // Delete it from database
        $principle->delete();

        return back();
    }
}
