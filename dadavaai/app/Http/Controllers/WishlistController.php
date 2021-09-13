<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Session;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client_id = Session::get('CLIENT_ID');
        $wishlists = Wishlist::where('client_id', $client_id)->orderByDesc('created_at')->get();
        return view('client.account.wishlist', compact('wishlists'));
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
        $client_id = Session::get('CLIENT_ID');
        if($request->ajax()){
            // Check user session
            if (!$client_id) {
                return response()->json(array('error' => 'Please <a href="/client-login-register" style="color:yellow">sign in / Sign up</a> to add wishlist!'));
            }
    
            // Checks if the product exists in the list
            $wishlists = Wishlist::where('client_id', $client_id)
                ->where('product_id', $request->product_id)
                ->get();
    
            if (!$wishlists->isEmpty()){
                return response()->json(array('error' => 'This Product already exists in your wishlist! '));
            }
    
            // Create instance of wishlist model & assign form value then save to database
            $wishlist = new Wishlist;
            $wishlist->client_id = $client_id;
            $wishlist->product_id = $request->product_id;
            $wishlist->save();
    
            /* Checks if data is saved to database. If so, redirect to previous page with success message. Otherwise, redirect to previous page with error message */
            if($wishlist){
                return response()->json(array('success' => 'Product added to wishlist successfully. '));
            }else{
                return response()->json(array('error' => 'Could not add product to wishlist! '));
            }
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $wishlist = Wishlist::find ($request->id)->delete();

        return response()->json(['wishlist' => $wishlist]);
    }
}
