<?php

namespace App\Http\Controllers;

use App\Sent;
use Illuminate\Http\Request;

class SentController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all sent mail item
        $sents = Sent::orderBy('id', 'desc')->simplePaginate(15);
        $total = Sent::all()->count();

        return view('admin.sent', compact('sents', 'total'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get the sent mail
        $sent = Sent::find($id);

        return view('admin.showSentMail', compact('sent'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Get the mail $ delete it
        Sent::find($request->id)->delete();

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function destroyBulk(Request $request)
    {
        // Get the mail $ delete it
        Sent::destroy($request->id);

        return response()->json();
    }
}
