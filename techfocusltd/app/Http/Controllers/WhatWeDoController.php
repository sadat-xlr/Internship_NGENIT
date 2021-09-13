<?php

namespace App\Http\Controllers;

use App\Datacenter;
use App\Product;
use App\Digitalinnovation;
use App\Connectedworkforce;
use App\Systemintegration;
use App\Solution;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use Session;
use Response;



class WhatWeDoController extends Controller
{
        //System Integration

        public function systemIntegrations()
        {
            // Checks if logged in
            if (!\Session::has('Name')){
                return redirect('/administration');
            }
            
            // Get all DigitalInnovation
            $systemIntegrations = Systemintegration::all()->sortByDesc('id');
            return view('admin.informative.systemIntegration.all', compact('systemIntegrations'));
    
        }
        public function createSystemIntegration()
        {
            
            // Checks if logged in
            if (!\Session::has('Name')){
                return redirect('/administration');
            }
                    
            // Get all products
            $products = Product::all()->sortByDesc('id');
            $solutions = Solution::all()->sortByDesc('id');
            return view('admin.informative.systemIntegration.create', compact('products', 'solutions'));
        }  
        
        public function storeSystemIntegration(Request $request)
        {
            
            // Checks if logged in
            if (!\Session::has('Name')){
                return redirect('/administration');
            }
                    
            // Validate form data
            $rules = array(
                'topic' => 'required',
                'title' => 'required',
                'description' => 'required',
                'description_1' => 'required',
            );
    
            $validator = Validator::make ( Input::all(), $rules);
            if ($validator->fails()){
                return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            }
    
            else{
                // Create instance of deal model & assign form value then save to database
                $systemIntegration = new Systemintegration;
                $systemIntegration->topic = $request->topic;
                $systemIntegration->title = $request->title;
                $systemIntegration->description = $request->description;
                $systemIntegration->description_1 = $request->description_1;
    
                if($request->description_2){
                    $systemIntegration->description_2 = $request->description_2;
                }
    
                if($request->description_3){
                    $systemIntegration->description_3 = $request->description_3;
                }
    
                if($request->description_4){
                    $systemIntegration->description_4 = $request->description_4;
                }
    
                $systemIntegration->save();
    
                if($request->product_id){
                    foreach ($request->product_id as $product){
                        $systemIntegration->products()->attach($product);
                    }
                }
    
                if($request->solution_id){
                    foreach ($request->solution_id as $solution){
                        $systemIntegration->solutions()->attach($solution);
                    }
                }
                return redirect('system-integration');
                // return response('digital-innovations')->json(['digitalInnovation' => $digitalInnovation->toArray(), 'products' => $digitalInnovation->products, 'solutions' => $digitalInnovation->solutions]);
            }
        }
    
        public function showSystemIntegration($id)
        {
            $systemIntegration = Systemintegration::find($id);
            return view('informative.whatWeDo.systemIntegration', compact('systemIntegration'));
        }
    
        public function editSystemIntegration( $id)
        {
            // Checks if logged in
            if (!\Session::has('Name')){
                return redirect('/administration');
            }
                    
            
            $systemIntegration = Systemintegration::find($id);
    
            // Get all products and solutions
            $products = Product::all()->sortByDesc('id');
            $solutions = Solution::all()->sortByDesc('id');
            return view('admin.informative.systemIntegration.edit', compact('products', 'solutions', 'systemIntegration'));
        }
    
        public function updateSystemIntegration(Request $request, $id)
        {
            // Checks if logged in
            if (!\Session::has('Name')){
                return redirect('/administration');
            }
                    
            
            // Validate form data
            $rules = array(
                'topic' => 'required',
                'title' => 'required',
                'description' => 'required',
                'description_1' => 'required',
            );
    
            $validator = Validator::make ( Input::all(), $rules);
            if ($validator->fails()){
                return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            }
    
            else{
                // Create instance of deal model & assign form value then save to database
                $systemIntegration = Systemintegration::find($id);
                $systemIntegration->topic = $request->topic;
                $systemIntegration->title = $request->title;
                $systemIntegration->description = $request->description;
                $systemIntegration->description_1 = $request->description_1;
    
                if($request->description_2){
                    $systemIntegration->description_2 = $request->description_2;
                }
    
                if($request->description_3){
                    $systemIntegration->description_3 = $request->description_3;
                }
                if($request->description_4){
                    $systemIntegration->description_4 = $request->description_4;
                }
                $systemIntegration->save();
    
    
                if($request->product_id){
                    foreach ($request->product_id as $product){
                        $systemIntegration->products()->attach($product);
                    }
                }
    
                if($request->solution_id){
                    foreach ($request->solution_id as $solution){
                        $systemIntegration->solutions()->attach($solution);
                    }
                }
                if($systemIntegration){
                    Session::put('success', 'System integration updated successfully.');
                    return redirect('/system-integration');
                }else{
                    Session::put('error', 'System integration updated failed!');
                    return redirect('/system-integration');
                }
                // return redirect('digital-innovations');
                // return response('digital-innovations')->json(['digitalInnovation' => $digitalInnovation->toArray(), 'products' => $digitalInnovation->products, 'solutions' => $digitalInnovation->solutions]);
            }
        }
    
        public function destroySystemIntegration($id)
        {
            // Checks if logged in
            if (!\Session::has('Name')){
                return redirect('/administration');
            }
                    
            
            $systemIntegration = Systemintegration::find($id);
    
            $systemIntegration->solutions()->detach();
            $systemIntegration->products()->detach();
    
            if($systemIntegration->delete()){
                Session::put('success', 'System integration deleted successfully.');
                return redirect('/system-integration');
            }else{
                Session::put('error', 'System integration delete failed!');
                return redirect('/system-integration');
            }
        }
    

    //Connected workforce
    public function connectedWorkforces()
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
        
        // Get all DigitalInnovation
        $connectedWorkforces = Connectedworkforce::all()->sortByDesc('id');
        return view('admin.informative.connectedWorkforce.all', compact('connectedWorkforces'));

    }
    public function createConnectedWorkforce()
    {
        
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        // Get all products
        $products = Product::all()->sortByDesc('id');
        $solutions = Solution::all()->sortByDesc('id');
        return view('admin.informative.connectedWorkforce.create', compact('products', 'solutions'));
    }  
    
    public function storeConnectedWorkforce(Request $request)
    {
        
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        // Validate form data
        $rules = array(
            'topic' => 'required',
            'title' => 'required',
            'description' => 'required',
            'description_1' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of deal model & assign form value then save to database
            $connectedWorkforce = new Connectedworkforce;
            $connectedWorkforce->topic = $request->topic;
            $connectedWorkforce->title = $request->title;
            $connectedWorkforce->description = $request->description;
            $connectedWorkforce->description_1 = $request->description_1;

            if($request->description_2){
                $connectedWorkforce->description_2 = $request->description_2;
            }

            if($request->description_3){
                $connectedWorkforce->description_3 = $request->description_3;
            }

            if($request->description_4){
                $connectedWorkforce->description_4 = $request->description_4;
            }

            $connectedWorkforce->save();

            if($request->product_id){
                foreach ($request->product_id as $product){
                    $connectedWorkforce->products()->attach($product);
                }
            }

            if($request->solution_id){
                foreach ($request->solution_id as $solution){
                    $connectedWorkforce->solutions()->attach($solution);
                }
            }
            return redirect('connected-workforce');
            // return response('digital-innovations')->json(['digitalInnovation' => $digitalInnovation->toArray(), 'products' => $digitalInnovation->products, 'solutions' => $digitalInnovation->solutions]);
        }
    }

    public function showConnectedWorkforce($id)
    {
        $connectedWorkforce = Connectedworkforce::find($id);
        return view('informative.whatWeDo.connectedWorkforce', compact('connectedWorkforce'));
    }

    public function editConnectedWorkforce( $id)
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        
        $connectedWorkforce = Connectedworkforce::find($id);

        // Get all products and solutions
        $products = Product::all()->sortByDesc('id');
        $solutions = Solution::all()->sortByDesc('id');
        return view('admin.informative.connectedWorkforce.edit', compact('products', 'solutions', 'connectedWorkforce'));
    }

    public function updateConnectedWorkforce(Request $request, $id)
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        
        // Validate form data
        $rules = array(
            'topic' => 'required',
            'title' => 'required',
            'description' => 'required',
            'description_1' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of deal model & assign form value then save to database
            $connectedWorkforce = Connectedworkforce::find($id);
            $connectedWorkforce->topic = $request->topic;
            $connectedWorkforce->title = $request->title;
            $connectedWorkforce->description = $request->description;
            $connectedWorkforce->description_1 = $request->description_1;

            if($request->description_2){
                $connectedWorkforce->description_2 = $request->description_2;
            }

            if($request->description_3){
                $connectedWorkforce->description_3 = $request->description_3;
            }
            if($request->description_4){
                $connectedWorkforce->description_4 = $request->description_4;
            }
            $connectedWorkforce->save();


            if($request->product_id){
                foreach ($request->product_id as $product){
                    $connectedWorkforce->products()->attach($product);
                }
            }

            if($request->solution_id){
                foreach ($request->solution_id as $solution){
                    $connectedWorkforce->solutions()->attach($solution);
                }
            }
            if($connectedWorkforce){
                Session::put('success', 'Connected Workforce updated successfully.');
                return redirect('/connected-workforce');
            }else{
                Session::put('error', 'Connected Workforce updated failed!');
                return redirect('/connected-workforce');
            }
            // return redirect('digital-innovations');
            // return response('digital-innovations')->json(['digitalInnovation' => $digitalInnovation->toArray(), 'products' => $digitalInnovation->products, 'solutions' => $digitalInnovation->solutions]);
        }
    }

    public function destroyConnectedWorkforce($id)
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        
        $connectedWorkforce = Connectedworkforce::find($id);

        $connectedWorkforce->solutions()->detach();
        $connectedWorkforce->products()->detach();

		if($connectedWorkforce->delete()){
			Session::put('success', 'Connected workforce deleted successfully.');
			return redirect('/connected-workforce');
		}else{
			Session::put('error', 'Connected workforce delete failed!');
			return redirect('/connected-workforce');
		}
    }


    
    //Digital Innovation
    
    public function digitalInnovations()
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
        
        // Get all DigitalInnovation
        $digitalInnovations = Digitalinnovation::all()->sortByDesc('id');
        return view('admin.informative.digitalInnovation.all', compact('digitalInnovations'));

    }

    public function createDigitalInnovation()
    {
        
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        // Get all products
        $products = Product::all()->sortByDesc('id');
        $solutions = Solution::all()->sortByDesc('id');
        return view('admin.informative.digitalInnovation.create', compact('products', 'solutions'));
    }


    public function storeDigitalInnovation(Request $request)
    {
        
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        // Validate form data
        $rules = array(
            'topic' => 'required',
            'title' => 'required',
            'description' => 'required',
            'description_1' => 'required',
            'description_2' => 'required',
            'description_3' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of deal model & assign form value then save to database
            $digitalInnovation = new Digitalinnovation;
            $digitalInnovation->topic = $request->topic;
            $digitalInnovation->title = $request->title;
            $digitalInnovation->description = $request->description;
            $digitalInnovation->description_1 = $request->description_1;
            $digitalInnovation->description_2 = $request->description_2;
            $digitalInnovation->description_3 = $request->description_3;
            if($request->description_4){
                $digitalInnovation->description_4 = $request->description_4;
            }

            $digitalInnovation->save();

            if($request->product_id){
                foreach ($request->product_id as $product){
                    $digitalInnovation->products()->attach($product);
                }
            }

            if($request->solution_id){
                foreach ($request->solution_id as $solution){
                    $digitalInnovation->solutions()->attach($solution);
                }
            }
            return redirect('digital-innovations');
            // return response('digital-innovations')->json(['digitalInnovation' => $digitalInnovation->toArray(), 'products' => $digitalInnovation->products, 'solutions' => $digitalInnovation->solutions]);
        }
    }

    public function showDigitalInnovation($id)
    {
        $digitalInnovation = Digitalinnovation::find($id);
        return view('informative.whatWeDo.show', compact('digitalInnovation'));
    }


    public function editDigitalInnovation( $id)
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        
        $digitalInnovation = Digitalinnovation::find($id);

        // Get all products and solutions
        $products = Product::all()->sortByDesc('id');
        $solutions = Solution::all()->sortByDesc('id');
        return view('admin.informative.digitalInnovation.edit', compact('products', 'solutions', 'digitalInnovation'));
    }

    public function updateDigitalInnovation(Request $request, $id)
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        
        // Validate form data
        $rules = array(
            'topic' => 'required',
            'title' => 'required',
            'description' => 'required',
            'description_1' => 'required',
            'description_2' => 'required',
            'description_3' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of deal model & assign form value then save to database
            $digitalInnovation = Digitalinnovation::find($id);
            $digitalInnovation->topic = $request->topic;
            $digitalInnovation->title = $request->title;
            $digitalInnovation->description = $request->description;
            $digitalInnovation->description_1 = $request->description_1;
            $digitalInnovation->description_2 = $request->description_2;
            $digitalInnovation->description_3 = $request->description_3;
            if($request->description_4){
                $digitalInnovation->description_4 = $request->description_4;
            }
            $digitalInnovation->save();


            if($request->product_id){
                foreach ($request->product_id as $product){
                    $digitalInnovation->products()->attach($product);
                }
            }

            if($request->solution_id){
                foreach ($request->solution_id as $solution){
                    $digitalInnovation->solutions()->attach($solution);
                }
            }
            if($digitalInnovation){
                Session::put('success', 'Digital Innovation updated successfully.');
                return redirect('/digital-innovations');
            }else{
                Session::put('error', 'Digital Innovation updated failed!');
                return redirect('/digital-innovations');
            }
            // return redirect('digital-innovations');
            // return response('digital-innovations')->json(['digitalInnovation' => $digitalInnovation->toArray(), 'products' => $digitalInnovation->products, 'solutions' => $digitalInnovation->solutions]);
        }
    }

    public function destroy($id)
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        
        $digitalInnovation = DigitalInnovation::find($id);

        $digitalInnovation->solutions()->detach();
        $digitalInnovation->products()->detach();

		if($digitalInnovation->delete()){
			Session::put('success', 'Digital Innovation deleted successfully.');
			return redirect('/digital-innovations');
		}else{
			Session::put('error', 'Digital Innovation delete failed!');
			return redirect('/digital-innovations');
		}
    }

    //DataCenter
    public function dataCenter()
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        
        
        // Get all DigitalInnovation
        $dataCenterInfoes = Datacenter::all()->sortByDesc('id');
        return view('admin.informative.dataCenter.all', compact('dataCenterInfoes'));
    }

    public function createDataCenter()
    {
         // Checks if logged in
         if (!\Session::has('Name')){
			return redirect('/administration');
        }
               
        
        
        // Get all products
        $products = Product::all()->sortByDesc('id');
        $solutions = Solution::all()->sortByDesc('id');
        return view('admin.informative.dataCenter.create', compact('products', 'solutions'));
    }

    public function storeDataCenter(Request $request)
    {
        
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        
        // Validate form data
        $rules = array(
            'topic' => 'required',
            'title' => 'required',
            'description' => 'required',
            'description_1' => 'required',
            'description_2' => 'required',
            'description_3' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of deal model & assign form value then save to database
            $dataCenter= new Datacenter;
            $dataCenter->topic = $request->topic;
            $dataCenter->title = $request->title;
            $dataCenter->description = $request->description;
            $dataCenter->description_1 = $request->description_1;
            $dataCenter->description_2 = $request->description_2;
            $dataCenter->description_3 = $request->description_3;

            if($request->description_4){
                $dataCenter->description_4 = $request->description_4;
            }
            $dataCenter->save();

            if($request->product_id){
                foreach ($request->product_id as $product){
                    $dataCenter->products()->attach($product);
                }
            }

            if($request->solution_id){
                foreach ($request->solution_id as $solution){
                    $dataCenter->solutions()->attach($solution);
                }
            }
            return redirect('cloud-datacenter');
            // return response('digital-innovations')->json(['digitalInnovation' => $digitalInnovation->toArray(), 'products' => $digitalInnovation->products, 'solutions' => $digitalInnovation->solutions]);
        }
    }

    public function editDataCenter( $id)
    {
        
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        
        $dataCenter = Datacenter::find($id);

        // Get all products and solutions
        $products = Product::all()->sortByDesc('id');
        $solutions = Solution::all()->sortByDesc('id');
        return view('admin.informative.dataCenter.edit', compact('products', 'solutions', 'dataCenter'));
    }

    public function updateDataCenter(Request $request, $id)
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                

        // Validate form data
        $rules = array(
            'topic' => 'required',
            'title' => 'required',
            'description' => 'required',
            'description_1' => 'required',
            'description_2' => 'required',
            'description_3' => 'required',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{
            // Create instance of deal model & assign form value then save to database
            $dataCenter = Datacenter::find($id);
            $dataCenter->topic = $request->topic;
            $dataCenter->title = $request->title;
            $dataCenter->description = $request->description;
            $dataCenter->description_1 = $request->description_1;
            $dataCenter->description_2 = $request->description_2;
            $dataCenter->description_3 = $request->description_3;

            if($request->description_4){
                $dataCenter->description_4 = $request->description_4;
            }
            $dataCenter->save();

            if($request->product_id){
                foreach ($request->product_id as $product){
                    $dataCenter->products()->attach($product);
                }
            }

            if($request->solution_id){
                foreach ($request->solution_id as $solution){
                    $dataCenter->solutions()->attach($solution);
                }
            }
            if($dataCenter){
                Session::put('success', 'Cloud & datacenter updated successfully.');
                return redirect('/cloud-datacenter');
            }else{
                Session::put('error', 'Cloud & datacenter updated failed!');
                return redirect('/cloud-datacenter');
            }
        }
    }

    public function destroydataCenter($id)
    {
        
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }
                
        
        $dataCenter = Datacenter::find($id);

        $dataCenter->solutions()->detach();
        $dataCenter->products()->detach();

		if($dataCenter->delete()){
			Session::put('success', 'Cloud & Data Center deleted successfully.');
			return redirect('/cloud-datacenter');
		}else{
			Session::put('error', 'Cloud & Data Center delete failed!');
			return redirect('/cloud-datacenter');
		}
    }

    public function showDataCenter($id)
    {
        $dataCenter = Datacenter::find($id);
        return view('informative.whatWeDo.dataCenter', compact('dataCenter'));
    }

    
    //Connected Workforce

    //System Integration

}
