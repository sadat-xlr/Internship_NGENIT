<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $message = Message::where('status', false)
                            ->where('owner', 1)
                            ->groupBy('client_id')->orderBy('created_at', 'asc')->first();

        // return view('home');
        return view('admin.dashboard', compact('message'));

    }
}
