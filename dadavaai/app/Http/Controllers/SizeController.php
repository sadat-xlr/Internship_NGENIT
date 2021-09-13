<?php

namespace App\Http\Controllers;

use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::all()->sortByDesc('id');
        return view('admin.sizes', compact('sizes'));
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
            'size' => 'required',
            );
            
            $validator = Validator::make ( Input::all(), $rules);
            if ($validator->fails()){
                return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            }
    
            else{
                // Create instance of category model & assign form value then save to database
                $size = new Size;
                $size->size = $request->size;
                $size->save();
                
                return response()->json($size); 
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the Size model & assign form value then save to database
        $size = Size::find($request->id);
        $size->size = $request->size;
        $size->save();
        
        return response()->json($size); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::find ($id)->delete();
        return response()->json();
    }
}
