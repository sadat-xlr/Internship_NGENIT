<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\Minicategory;
use App\Tab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class TabController extends Controller
{
    // Get tabs associated with minicategory
    public function getTab($miniCatId){
        $tabs = Tab::where('minicategory_id', $miniCatId)->pluck('tabName','id')->toArray();

        $data = "<option value=''>--Select Tab--</option>";
        foreach($tabs as $key => $tabs)
        {
            $data .= "<option value='$key'>$tabs</option>";
        }
        return $data;
    }    

    public function index()
    {
        $categories = Category::all();
        $miniCategories = Minicategory::all();
        $tabs = Tab::all();

        return view('admin.tabs', compact('categories', 'miniCategories', 'tabs'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // Validate form data
        $rules = array(
            'tabName' => 'required',
            'minicategory_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of Minicategory model & assign form value then save to database
            $tab = new Tab();
            $tab->tabName = $request->tabName;
            $tab->minicategory_id = $request->minicategory_id;
            $tab->save();

            // Find minicategory
            $minicategorie = Minicategory::with('subcategory')->find($tab->minicategory_id);
            $category = Category::find($minicategorie->subcategory->category_id);


            return response()->json([ $tab, $minicategorie, $category]);
        }
    }


    public function show(Minicategory $minicategory)
    {
        //
    }

    public function edit(Minicategory $minicategory)
    {
        //
    }


    public function update(Request $request, $id)
    {
        // Find the Subcategory model & assign form value then save to database
        $tab = Tab::with('minicategory')->find($id);
        $tab->tabName = $request->tabName;
        $tab->minicategory_id = $request->minicategory_id;
        $tab->save();

        // Find minicategory
        $minicategorie = Minicategory::with('subcategory')->find($tab->minicategory_id);
        $category = Category::find($minicategorie->subcategory->category_id);


        return response()->json([ $tab, $minicategorie, $category]);
    }

 
    public function destroy($id)
    {
        $tab = Tab::find ($id)->delete();
        return response()->json();
    }
}
