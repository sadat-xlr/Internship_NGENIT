<?php

namespace App\Http\Controllers;

use App\Subsector;
use Response;
use Validator;
use App\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SectorController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authenticate')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all sector
        $sectors = Sector::all()->sortByDesc('id');

        return view('admin.sectors', compact('sectors'));
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
            'sectorName' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of Sector model & assign form value then save to database
            $sector = new Sector();
            $sector->sectorName = $request->sectorName;
            $sector->save();

            return response()->json($sector);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        $subsectors = Subsector::where('sector_id', $sector->id)->pluck('subSectorName','id')->toArray();

        $data = "<option value=''>--Select Subsector--</option>";
        foreach($subsectors as $key => $subsector)
        {
            $data .= "<option value='$key'>$subsector</option>";
        }
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sector $sector)
    {
        // Create instance of Sector model & assign form value then save to database
        $sector = Sector::find($sector->id);
        $sector->sectorName = $request->sectorName;
        $sector->save();

        return response()->json($sector);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector)
    {
        Sector::find ($sector->id)->delete();
        return response()->json();
    }
}
