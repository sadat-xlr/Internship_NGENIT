<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
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
        // Get Announcement
        
        $announcements = Announcement::all();
        return view('admin.announcements', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return view
        return view('admin.addAnnouncement');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request);
        
        // Create instance of Banner model & assign form value then save to database
        $announcement = new Announcement();
        $announcement->label1 = $request->label1;
        $announcement->label2 = $request->label2;
        $announcement->label3 = $request->label3;
        $announcement->label4 = $request->label4;
        $announcement->label5 = $request->label5;
        $announcement->label6 = $request->label6;
        $announcement->label_url1 = $request->label_url1;
        $announcement->label_url2 = $request->label_url2;
        $announcement->label_url3 = $request->label_url3;
        $announcement->label_url4 = $request->label_url4;
        $announcement->label_url5 = $request->label_url5;
        $announcement->label_url6 = $request->label_url6;
        $announcement->save();

        return redirect()->back()->with('success', 'Announcement added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the banner
        $announcement = Announcement::find($id);

        $announcement->label1 = $request->label1;
        $announcement->label2 = $request->label2;
        $announcement->label3 = $request->label3;
        $announcement->label4 = $request->label4;
        $announcement->label5 = $request->label5;
        $announcement->label6 = $request->label6;
        $announcement->label_url1 = $request->label_url1;
        $announcement->label_url2 = $request->label_url2;
        $announcement->label_url3 = $request->label_url3;
        $announcement->label_url4 = $request->label_url4;
        $announcement->label_url5 = $request->label_url5;
        $announcement->label_url6 = $request->label_url6;
        $announcement->save();

        return response()->json($announcement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the banner
        $announcement = Announcement::find($id);

        // Delete from database
        $announcement->delete();

        return response()->json($announcement);
    }
}
