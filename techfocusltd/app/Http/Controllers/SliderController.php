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
        // Get all sliders
        $sliders = Slider::all()->sortByDesc('id');

        return view('admin.sliders', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliderCreate');
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
                $path = $request->file('image')->storeAs('public/images/slider', $fileNameToStore);
            }

            // Create instance of Slider model & assign form value then save to database
            $slider = new Slider;
            $slider->image = $fileNameToStore;
            $slider->save();

            return response()->json($slider);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
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
        $slider = Slider::find($slider->id);

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

        $slider->save();

        return response()->json($slider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        // Find the model instance
        $slider = Slider::find ($slider->id);
        // Get logo & delete it from the directory
        Storage::delete('public/images/slider/'.$slider->image);
        // Delete it from database
        $slider->delete();

        return response()->json();
    }
}
