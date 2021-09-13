<?php

namespace App\Http\Controllers;

use Response;
use Validator;
use App\Sector;
use App\Subsector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SubsectorController extends Controller
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
        // Get all subsectors
        $subsectors = Subsector::all()->sortByDesc('id');
        $sectors = Sector::all()->sortByDesc('id');

        return view('admin.subsectors', compact('subsectors', 'sectors'));
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
            'subSectorName' => 'required',
            'sector_id' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of Subsector model & assign form value then save to database
            $subsectors = new Subsector();
            $subsectors->subSectorName = $request->subSectorName;
            $subsectors->sector_id = $request->sector_id;
            $subsectors->save();

            return response()->json($subsectors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subsector  $subsector
     * @return \Illuminate\Http\Response
     */
    public function show(Subsector $subsector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subsector  $subsector
     * @return \Illuminate\Http\Response
     */
    public function edit(Subsector $subsector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subsector  $subsector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subsector $subsector)
    {
        // Create instance of Subsector model & assign form value then save to database
        $subsectors = Subsector::find($subsector->id);
        $subsectors->subSectorName = $request->subSectorName;
        $subsectors->sector_id = $request->sector_id;
        $subsectors->save();

        return response()->json($subsectors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subsector  $subsector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subsector $subsector)
    {
        Subsector::find($subsector->id)->delete();
        return response()->json();
    }
}
