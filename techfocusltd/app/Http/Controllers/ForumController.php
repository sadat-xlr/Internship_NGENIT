<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Session;
use App\Forum;
use App\Forumcommentreply;
use App\Tag;

class ForumController extends Controller
{
    



    public function forumcommentreplies($id, Request $request)
    {
        $reply    =   new Forumcommentreply;
        $reply->reply   =   $request->reply;
        $reply->comment_id  =   $id;
        if (Session::has('ID')) {
            $reply->customer_id  =   Session::get('ID');
        } else {
            $reply->customer_id  =   0;
        }
        
        $reply->save();
        return response()->json($reply);
    }
    public function comments($id, Request $request)
    {
        $comment    =   new Comment;
        $comment->comment   =   $request->comment;
        $comment->forum_id  =   $id;
        if (Session::has('ID')) {
            $comment->customer_id  =   Session::get('ID');
        } else {
            $comment->customer_id  =   0;
        }
        
        $comment->save();
        return back();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forumQuestions  =   Forum::orderBy('created_at','desc')->paginate(10);
        return view('informative.forum.forumQuestions')->with('forumQuestions', $forumQuestions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Session::has('ID')){
            $tages    =   Tag::all();
            return view('informative.forum.question')->with('tages',$tages);
        }else{

            return redirect()->back()->with('error','Need to login first');

            // return response()->json('pleash login first');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $description   =   $request->description;
        $tag    =   $request->tag;
        $customer_id  =   Session::get('ID');
        $forumQuestion  =   new Forum;
        $forumQuestion->title  =   $title;
        $forumQuestion->slug    =   str_slug($title);
        $forumQuestion->description  =   $description;
        $forumQuestion->customer_id  =   $customer_id;
        
        //for search in database the question is available
        $slug  =   Forum::where('slug',$forumQuestion->slug)->first();

        if(!$slug){
            $forumQuestion->save();
            return response()->json($forumQuestion);
        }
        else{
            return response()->json('The question is available in THe forum');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $forumQuestion  =   Forum::where('slug', $slug)->first();
        // return response()->json($forumQuestion);
        return view('informative.forum.questionDetails')->with('questionDetails',$forumQuestion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forumQuestion  =   Forum::Find($id);
        $forumQuestion->delete();
    }
}
