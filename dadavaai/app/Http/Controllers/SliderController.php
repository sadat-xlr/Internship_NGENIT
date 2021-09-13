<?php

namespace App\Http\Controllers;

use Response;
use Validator;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * all Sliders for Front End
     */
    public function allSliders()
    {
        // Get all sliders
        $sliders = Slider::all()->sortByDesc('id');
        return view('admin.sliders', compact('sliders'));
    }

    /**
     * All Slider for admin.
     */
    public function index()
    {
        // Get all sliders
        $sliders = Slider::all()->sortByDesc('id');

        return view('admin.sliders', compact('sliders'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        // Validate form data
        $rules = array(
            'image' => 'required|image|max:2000',
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
                $path = $request->file('image')->storeAs('public/images/slider', $fileNameToStore);
            }

            // Create instance of Slider model & assign form value then save to database
            $slider = new Slider;
            $slider->image = $fileNameToStore;
            $slider->slider_link = $request->slider_link;
            $slider->save();

            return response()->json($slider);
        }
    }

    public function show(Slider $slider)
    {
        //
    }

    public function edit(Slider $slider)
    {
        //
    }

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
        $slider = Slider::find($id);

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
            $path = $request->file('image')->storeAs('public/images/slider', $fileNameToStore);
            // Get previous logo & delete it from the directory
            Storage::delete('public/images/slider/'.$slider->image);
            // Save filename to database
            $slider->image = $fileNameToStore;
        }

        $slider->slider_link = $request->slider_link;
        $slider->save();

        return response()->json($slider);
    }

    public function destroy($id)
    {
        // Find the model instance
        $slider = Slider::find ($id);
        // Get logo & delete it from the directory
        Storage::delete('public/images/slider/'.$slider->image);
        // Delete it from database
        $slider->delete();

        return response()->json();
    }
}
