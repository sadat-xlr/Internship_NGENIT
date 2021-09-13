<?php

namespace App\Http\Controllers;

use App\Compare;
use App\Product;
use Illuminate\Http\Request;
use Session;

class CompareController extends Controller
{
    

    // Add product to compare 
    public function tabCompare(Request $request){

        return $request->all();

        $compare_session = Compare::where('sId', Session::getId())->first();

        if ($compare_session) {
            if ($compare_session->product->tab_id == $request->tab_id) {

                #// Create instance of compare model & assign form value then save to database
                $compare = new Compare;
                $compare->sId = Session::getId();
                $compare->product_id = $proId;
                $compare->save();
    
            }else{
    
                $compare_sessions = Compare::where('sId', Session::getId())->get();
                foreach ($compare_sessions as $compare_session) {
                    $compare_session->delete();
                }

                // Set data to session
                $data = array('tab_id' => $product->tab_id);
                Session::push('tab', $data);
                
    
                #// Create instance of compare model & assign form value then save to database
                $compare = new Compare;
                $compare->sId = Session::getId();
                $compare->product_id = $proId;
                $compare->save();
            }
        } else {

            #// Create instance of compare model & assign form value then save to database
            $compare = new Compare;
            $compare->sId = Session::getId();
            $compare->product_id = $proId;
            $compare->save();
        }
            
    }
    
    
    // Loads compare view
    public function compare(){

        $compares = Compare::where('sId', Session::getId())->get();
        return view('client.compare', compact('compares'));
    }

    // Add product to compare 
    public function addCompare(Request $request, $proId){

        $compares = Compare::where('sId', Session::getId())
            ->where('product_id', $proId)
            ->get();

        if (!$compares->isEmpty()){
            if($request->ajax())
            {
                
                return response()->json(['error'=> 'This Product already exists in compare! ']);
                
            }else{
                
                return redirect()->back()->with('error', 'This Product already exists in compare! ');
            } 
            
        }

        $product = Product::find($proId);
        $compare_session = Compare::where('sId', Session::getId())->first();

        if ($compare_session) {
            if ($compare_session->product->tab_id == $product->tab_id) {

                #// Create instance of compare model & assign form value then save to database
                $compare = new Compare;
                $compare->sId = Session::getId();
                $compare->product_id = $proId;
                $compare->save();
    
            }else{
    
                $compare_sessions = Compare::where('sId', Session::getId())->get();
                foreach ($compare_sessions as $compare_session) {

                    $tabs = Session::get('tab');
                    $tabCheck = false;

                    if ($tabs){
                        foreach ($tabs as $key => $tab){
                            
                            if($tab['tab_id'] == $compare_session->product->tab_id){
                                $tabCheck = true;
                            }
                            else {
                                $data = ['product_id' => $compare_session->product_id];
                                Session::push("'tab.".$key."'", $data);
                            }
                            
                        }
                        if ($tabCheck == true) {
                            $data = array('tab_id' => $compare_session->product->tab_id, 'product_id' => $compare_session->product_id);
                            Session::push('tab', $data);
                        }

                    }
                    else {
                        $data = array('tab_id' => $compare_session->product->tab_id, 'product_id' => $compare_session->product_id);
                        Session::push('tab', $data);
                    }
                    

                    $compare_session->delete();
                }

                #// Create instance of compare model & assign form value then save to database
                $compare = new Compare;
                $compare->sId = Session::getId();
                $compare->product_id = $proId;
                $compare->save();
            }
        } else {

            // $tabs = Session::get('tab');

            // $data = array('tab_id' => $product->tab_id, 'product'=> array('product_id' => $proId));

            // Session::push('tab', $data);

            #// Create instance of compare model & assign form value then save to database
            $compare = new Compare;
            $compare->sId = Session::getId();
            $compare->product_id = $proId;
            $compare->save();
        }
        
        
        

        if($request->ajax())
        {
            /* Checks if data is saved to database. If so, redirect to previous page with success message. Otherwise, redirect to previous page with error message */
            if($compare){
                return response()->json(['success'=> 'Product added to compare successfully. ']);
            }else{
                return response()->json(['error'=> 'Could not add product to compare! ']);
            }
        }else{
            /* Checks if data is saved to database. If so, redirect to previous page with success message. Otherwise, redirect to previous page with error message */
            if($compare){
                return redirect()->back()->with('success', 'Product added to compare successfully. ');
            }else{
                return redirect()->back()->with('error', 'Could not add product to compare! '); 
            }
        }           
    }

    // Delete compare
    public function deleteCompare($compareId){
        $result = Compare::find($compareId);
        $result->delete();
                
        if($result){
            return redirect()->back()->with('success', 'Compare deleted successfully. ');
        }else{
            return redirect()->back()->with('error', 'Could not delete Compare! '); 
        }
    }


}
