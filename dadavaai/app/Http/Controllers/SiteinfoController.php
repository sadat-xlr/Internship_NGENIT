<?php

namespace App\Http\Controllers;

use Response;
use Validator;
use App\Siteinfo;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class SiteinfoController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('faq', 'terms');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteinfos = Siteinfo::all();

        return view('admin.siteInfo', compact('siteinfos'));
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
        $rules = array(
            'title' => 'required',
            'copyright' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
            'googleplus' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails())
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));

        else {
            $siteinfos = new Siteinfo;
            $siteinfos->title = $request->title;
            $siteinfos->copyright = $request->copyright;
            $siteinfos->facebook = $request->facebook;
            $siteinfos->twitter = $request->twitter;
            $siteinfos->linkedin = $request->linkedin;
            $siteinfos->googleplus = $request->googleplus;
            $siteinfos->save();

            return response()->json($siteinfos);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Siteinfo  $siteinfo
     * @return \Illuminate\Http\Response
     */
    public function show(Siteinfo $siteinfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siteinfo  $siteinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Siteinfo $siteinfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siteinfo  $siteinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $siteinfos = Siteinfo::find ($id);
        $siteinfos->title = $request->title;
        $siteinfos->copyright = $request->copyright;
        $siteinfos->facebook = $request->facebook;
        $siteinfos->twitter = $request->twitter;
        $siteinfos->linkedin = $request->linkedin;
        $siteinfos->googleplus = $request->googleplus;
        $siteinfos->save();
        return response()->json($siteinfos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siteinfo  $siteinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Siteinfo::find ($id)->delete();
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Siteinfo  $siteinfo
     * @return \Illuminate\Http\Response
     */
    public function faq()
    {
        // Return view
        return view('faq');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Siteinfo  $siteinfo
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        // Return view
        return view('term-condition');
    }
}
