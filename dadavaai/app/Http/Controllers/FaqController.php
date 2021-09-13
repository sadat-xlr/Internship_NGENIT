<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;


class FaqController extends Controller
{
    
    //search product in single category page
    public function faqPageSearch(Request $request)
    {
        
        if($request->ajax())
        {
            if ($request->get('query'))
            {
                $query = $request->get('query');
                $faqs = Faq::where('question','LIKE',"%{$query}%")
                                    ->get();
            }
            return response()->json($faqs);
        }
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allFaqs()
    {
        // Get all about info
        $faqs = Faq::all();

        // Return view
        return view('client.faq', compact('faqs'));
    }


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all faqs info
        $faqs = Faq::all();

        // Return view
        return view('admin.faqs', compact('faqs'));
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
            'question' => 'required',
            'answer' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails())
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));

        else {

            $faqs = new Faq();
            $faqs->question = $request->question;
            $faqs->answer = $request->answer;
            $faqs->save();
            return response()->json($faqs);

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
    public function update(Request $request )
    {
        // Find the faq & update it
        $faq = Faq::find ($request->id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return response()->json($faq);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::find ($id)->delete();
        return response()->json();
    }
}
