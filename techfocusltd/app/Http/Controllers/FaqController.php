<?php

namespace App\Http\Controllers;

use App\Faq;
use Session;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('informative.faq')->with('faqs', $faqs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }  
              
        return view('admin.informative.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}        
        
        $validatedData = $this->validate($request, [
            'question' => 'required',
            'answer'   =>  'required',
            ]);

        $faq = new Faq;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();    
        /* Checks if data is saved to database. If so, redirect to addCategories page with success message. Otherwise, redirect to addCategories page with error message */
		if($faq){
			Session::put('success', 'Faq added successfully.');
			return redirect('/create-faq');
		}else{
			Session::put('error', 'Faq addition failed!');
			return redirect('/create-faq');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        //
    }
}
