<?php

namespace App\Http\Controllers;

use App\Service;
use App\Category;
use App\Subcategory;
use App\Minicategory;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Validator;
use Response;

class ServiceController extends Controller
{
    public function serviceMiniCategory(Request $request, $id)
    {
        $miniCategory = Minicategory::with(['subcategory', 'tabs'])->find($id);
        $category  = $miniCategory->subcategory->category;
        $categories = Category::where('id', $category->id)->get();


        if($request->ajax())
        {
            $services = Service::with(['category'])->where('minicategory_id', $id)->where('published', false)->get();

            return response()->json(['services'=>$services, 'miniCategory'=>$miniCategory, 'category'=>$category]);
        }

        $services = Service::with(['category'])->where('minicategory_id', $id)->where('published', false)->paginate(9);
    
        return view('client.service.serviceMiniCategory', compact('categories', 'miniCategory', 'services'));
    }

    
    public function serviceCategory(Request $request, $id, $categoryName)
    {
        
        $singleCategory = Category::find($id);
        $categories = Category::where('id', $singleCategory->id)->get();
       

        if($request->ajax()){

            $services = Service::with(['category'])->where('category_id', $id)
                            ->where('published', false)
                            ->get();
            return response()->json(['services'=>$services, 'singleCategory'=>$singleCategory]);

        }

        $services = Service::with(['category'])->where('category_id', $id)
                            ->where('published', false)
                            ->paginate(9);     

        return view('client.service.allService',compact('services', 'singleCategory', 'categories'));
   
    }

    public function serviceSubcategory(Request $request, $id, $subcategoryName)
    {
        $singleSubcategory = Subcategory::with('category')->find($id);
        $categories = Category::where('id', $singleSubcategory->category->id)->get();


        if($request->ajax())
        {

        $services = Service::with(['category',])->where('subcategory_id', $id)
                            ->where('published', false)
                            ->get();

         return response()->json(['services'=>$services, 'singleSubcategory'=>$singleSubcategory]);

        }

        $services = Service::with(['category'])->where('subcategory_id', $id)
                            ->where('published', false)
                            ->paginate(9);

        return view('client.service.serviceSubcategory',compact('services', 'singleSubcategory', 'categories'));

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        $services = Service::all()->sortByDesc('id');
        return view('admin.services', compact('categories', 'services'));
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
            'serviceName' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'shortDescription' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|max:1000',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        // Create instance of Service model & assign form value then save to database
        $service = new Service;
        $service->serviceName = $request->serviceName;
        $service->sku = $request->sku;
        $service->slug = str_slug($request->serviceName);         
        $service->category_id = $request->category_id;
        $service->subcategory_id = $request->subcategory_id;
        $service->minicategory_id = $request->minicategory_id;
        $service->tab_id = $request->tab_id;
        $service->shortDescription = $request->shortDescription;
        $service->description = $request->description;
        $service->specification = $request->specification;
        $service->regularPrice = $request->regularPrice;
        $service->availability = $request->availability;

        $service->unit = $request->unit;
        $service->min_order_qty = $request->min_order_qty;
        $service->service_area = $request->service_area;

        //discount  percentage value
        $service->discount  =   $request->discount;

        // Checks if the file exists
        if ($request->hasFile('image')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image')->storeAs('public/images/service', $fileNameToStore);
            $service->image = $fileNameToStore;
        }

        $service->save();

        // Return json response
        return response()->json(array('service' => $service->toArray()));
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        // $relatedProducts = Product::where('subcategory_id', $product->subcategory->id)->get();
        // $similarProducts = Product::where('id', $id)
        //                             ->orWhere('minicategory_id', $product->minicategory_id)
        //                             ->orderByDesc('id')
        //                             ->take(5)
        //                             ->get();

        // $relatedProducts = Product::where('minicategory_id', $product->minicategory_id)->get();
        // $similarProducts = Product::where('id', $id)
        //                             ->orWhere('tab_id', $product->tab_id)
        //                             ->orderByDesc('id')
        //                             ->take(5)
        //                             ->get();
        return view('client.service.service', compact('service'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        // Validate form data
        $rules = array(
            'serviceName' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'shortDescription' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|max:1000',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }
        // Find the Service model & assign form value then save to database
        $service = Service::find($id);
        $service->serviceName = $request->serviceName;
        $service->sku = $request->sku;
		$service->slug = str_slug($request->serviceName);

        $service->category_id = $request->category_id;
        $service->subcategory_id = $request->subcategory_id;
        $service->minicategory_id = $request->minicategory_id;
        $service->tab_id = $request->tab_id;
        $service->shortDescription =$request->shortDescription;
        $service->description = $request->description;
        $service->specification = $request->specification;
        $service->regularPrice = $request->regularPrice;
        $service->availability = $request->availability;

        $service->unit = $request->unit;
        $service->min_order_qty = $request->min_order_qty;
        $service->service_area = $request->service_area;


        //discount  percentage value
        $service->discount  =   $request->discount;

        // Checks if the file exists
        if ($request->hasFile('image')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image')->storeAs('public/images/service', $fileNameToStore);
            // Delete image from the directory
            Storage::delete('public/images/service/'.$image->image);
            // Update database
            $service->image = $fileNameToStore;
        }

        $service->save();

        return response()->json($service); 

        // Return json response
        return response()->json(array('service' => $service->toArray()));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get the product & delete it
        $service = Service::find($id);

        // Delete images from the directory & then from database
        Storage::delete('public/images/service/'.$service->images);

        // Delete the service
        $service->delete();
        
        return response()->json();
    }
}
