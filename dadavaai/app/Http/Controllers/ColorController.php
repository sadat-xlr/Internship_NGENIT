<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all()->sortByDesc('id');
        return view('admin.colors', compact('colors'));
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
            'color' => 'required',
            );
            
            $validator = Validator::make ( Input::all(), $rules);
            if ($validator->fails()){
                return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            }
    
            else{
                // Create instance of category model & assign form value then save to database
                $colors = new Color;
                $colors->color = $request->color;
                $colors->save();
                
                return response()->json($colors); 
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the color model & assign form value then save to database
        $colors = Color::find($request->id);
        $colors->color = $request->color;
        $colors->save();
        
        return response()->json($colors); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $colors = Color::find ($id)->delete();
        return response()->json();
    }
}
