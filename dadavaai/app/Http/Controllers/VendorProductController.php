<?php

namespace App\Http\Controllers;

use App\Vendorpayment;
use App\Vendordelivery;
use App\Vendor;
use App\Vendorproduct;
use App\Vendorproductorder;
use App\Brand;
use App\Category;
use App\Color;
use App\Product;
use App\Size;
use App\Tag;
use App\Deal;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Validator;
use Response;
use Session; 

class VendorProductController extends Controller
{
    public function vendorPaymentStatus(Request $request)
    {

        // Validate form data
        $rules = array(
            'payment_status'          => 'required',

        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        $vendor_id = $request->vendor_id;
        $order_id = $request->order_id;

        $vendorOrder = Vendorproductorder::where('vendor_id', $vendor_id)
                                           ->where('order_id', $order_id)
                                           ->first();

        $vendorPayment    = Vendorpayment::where('vendor_id', $vendor_id)
                                        ->where('order_id', $order_id)
                                        ->first();

        $vendorPayment->status = $request->payment_status;
        $vendorPayment->acknowledgement = 0;
        $vendorPayment->paidAmount = $vendorOrder->totalPrice;
        $vendorPayment->save();


        return response()->json($vendorPayment);
    }



    public function vendorDeliveryAcknowledgement(Request $request)
    {
        //vendors
        $vendor_id = $request->vendor_id;
        $order_id = $request->order_id;

        $vendorDelivery    = Vendordelivery::where('vendor_id', $vendor_id)
                                        ->where('order_id', $order_id)
                                        ->first();
        if ($vendorDelivery) {
            $vendorDelivery->acknowledgement = $request->acknowledgement_status;
            $vendorDelivery->save();
        }

        return response()->json($vendorDelivery);
    }

    public function vendorPaymentAcknowledgement(Request $request)
    {

        //vendors
        $vendor_id = Session::get('VENDOR_ID');

        $vendor = Vendor::where('id', $vendor_id)->first();
        $order_id = $request->order_id;

        $vendorPayment    = Vendorpayment::where('vendor_id', $vendor->id)
                                        ->where('order_id', $order_id)
                                        ->first();
        if ($vendorPayment) {
            $vendorPayment->acknowledgement = $request->payment_acknowledgement_status;
            $vendorPayment->save();
        }

        return response()->json($vendorPayment);
    }

    public function orderDetailsForVendor(Request $request)
    {
        $order_id = $request->order_id;
        $vendor_id = $request->vendor_id;

        $vendor = Vendor::where('id', $vendor_id)->first();

        $orderedProductDetails = Vendorproductorder::where('order_id', $order_id)
                                                    ->where('vendor_id', $vendor->id)
                                                    ->get();

        return view('admin.orderDetailsForVendor', compact('orderedProductDetails', 'order_id', 'vendor'));
        return $orderedProductDetails;
    }

    public function orderForVendor()
    {

        $orderForVendors = Vendorproductorder::groupBy(['order_id', 'vendor_id'])->get();
        return view('admin.orderForVendor', compact('orderForVendors'));
    }

    public function vendorPayment()
    {
        //vendors
        $vendor_id = Session::get('VENDOR_ID');
        $vendor = Vendor::where('id', $vendor_id)->first();
        $vendorPayments    = Vendorpayment::where('vendor_id', $vendor->id)
                                        ->groupBy('order_id')
                                        ->get();



        return view('vendor.vendorPayment', compact('vendorPayments'));

        // return response()->json($vendorPayments);
    }

    public function vendorDelivery()
    {
        //vendors
        $vendor_id = Session::get('VENDOR_ID');
        $vendor = Vendor::where('id', $vendor_id)->first();

        $vendorDeliverys    = Vendordelivery::where('vendor_id', $vendor->id)
                                        ->groupBy('order_id')
                                        ->get();

        return view('vendor.vendorDelivery', compact('vendorDeliverys'));
    }


    public function vendorDeliveryStatus(Request $request)
    {
        // Validate form data
        $rules = array(
            'delivery_status'          => 'required',

        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        //Rfq or ondemand  notification for each vendors
        $vendor_id = Session::get('VENDOR_ID');
        $vendor = Vendor::where('id', $vendor_id)->first();

        $order_id = $request->order_id;

        $vendorDelivery    = Vendordelivery::where('vendor_id', $vendor->id)
                                        ->where('order_id', $order_id)
                                        ->first();

        $vendorDelivery->status = $request->delivery_status;
        $vendorDelivery->acknowledgement = 0;
        $vendorDelivery->save();


        return response()->json($vendorDelivery);
    }


    public function vendorOrderDetails(Request $request)
    {
        $order_id = $request->order_id;
        $vendor_id = Session::get('VENDOR_ID');
        $vendor = Vendor::where('id', $vendor_id)->first();

        $orderedProductDetails = Vendorproductorder::where('order_id', $order_id)
                                                    ->where('vendor_id', $vendor->id)
                                                    ->get();

        return view('vendor.vendorOrderDetails', compact('orderedProductDetails', 'order_id'));
    }

    public function orderedProduct()
    {

        $vendor_id = Session::get('VENDOR_ID');
        $vendor = Vendor::where('id', $vendor_id)->first();
        $orderForVendors = Vendorproductorder::where('vendor_id', $vendor->id)
                                                ->groupBy('order_id')->get();

        return view('vendor.orderedProducts', compact('orderForVendors'));
    }

    public function index()
    {
        $categories = Category::where('categoryName', 'like', '%On demand%')->get();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();
        $tags = Tag::all();
        $deals = Deal::all();

        $vendor_id = Session::get('VENDOR_ID');
        $vendor = Vendor::where('id', $vendor_id)->first();


        $vendorProducts = [];

        $vendorProductIds = Vendorproduct::select('product_id')->where('vendor_id', $vendor->id)->get();
        foreach ($vendorProductIds as $key => $vendorProductId) {
            $product = Product::where('id', $vendorProductId->product_id)->first();
            
            $vendorProducts[] = $product;
        }

        return view('vendor.products', compact('deals', 'tags', 'brands', 'colors', 'sizes', 'categories', 'vendorProducts'));
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
            'productName' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'shortDescription' => 'required|string',
            'description' => 'required|string',
            'image1' => 'required|image|max:1000',
            'image2' => 'image|max:1000',
            'image3' => 'image|max:1000',
            'image4' => 'image|max:1000',
            'image5' => 'image|max:1000',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        // Create instance of Product model & assign form value then save to database
        $product = new product;
        $product->productName = $request->productName;
        $product->sku = $request->sku;
        $product->slug = str_slug($request->productName);         
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->minicategory_id = $request->minicategory_id;
        $product->tab_id = $request->tab_id;
        $product->brand_id = $request->brand_id;
        $product->shortDescription = $request->shortDescription;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->regularPrice = $request->regularPrice;
        $product->type = $request->type;
        $product->availability = $request->availability;
        $product->paymentOption = $request->paymentOption;

        $product->measurement = $request->measurement;
        $product->min_order_qty = $request->min_order_qty;
        $product->delivery_time = $request->delivery_time;
        $product->delivery_from = $request->delivery_from;

        $product->delivery_charge = $request->delivery_charge;
        $product->return_policy = $request->return_policy;

        //discount  percentage value
        $product->discount  =   $request->discount;
        $product->occasion  =   $request->occasion;
        $product->promotion =   $request->promotion;
        $product->clearance =   $request->clearance;
        $product->buy_get   =   $request->buy_get;

        if($request->deal_id == 0){

            $product->deal_id = null;
        }else{
            $product->deal_id = $request->deal_id;
        }

        $product->published = true;

        $product->save();

        $vendorProduct = new Vendorproduct;

        $vendor_id = Session::get('VENDOR_ID');
        $vendorProduct->vendor_id = $vendor_id;
        $vendorProduct->product_id = $product->id;
        $vendorProduct->save();
        // Check if color is set
        if (isset($request->color)) {
            // Loop over selected colors
            foreach ($request->color as $value) {
                // Save to pivot table
                $product->colors()->attach($value);
            }
        }

        // Check if size is set
        if (isset($request->size)) {
            // Loop over selected sizes
            foreach ($request->size as $value) {
                // Save to pivot table
                $product->sizes()->attach($value);
            }
        }

        // Check if tag is set
        if (isset($request->tag)) {
            // Loop over selected tags
            foreach ($request->tag as $value) {
                // Save to pivot table
                $product->tags()->attach($value);
            }
        }

        // Create instance of Image model & assign form value then save to database
        $image = new Image;
        $image->product_id = $product->id;

        // Handle image upload

        // Checks if the file exists
        if ($request->hasFile('image1')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image1')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image1')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore1 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image1')->storeAs('public/images/product', $fileNameToStore1);
            $image->image1 = $fileNameToStore1;
        }

        // Checks if the file exists
        if ($request->hasFile('image2')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image2')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image2')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore2 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image2')->storeAs('public/images/product', $fileNameToStore2);
            $image->image2 = $fileNameToStore2;
        }

        // Checks if the file exists
        if ($request->hasFile('image3')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image3')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image3')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore3 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image3')->storeAs('public/images/product', $fileNameToStore3);
            $image->image3 = $fileNameToStore3;
        }

        // Checks if the file exists
        if ($request->hasFile('image4')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image4')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image4')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore4 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image4')->storeAs('public/images/product', $fileNameToStore4);
            $image->image4 = $fileNameToStore4;
        }

        // Checks if the file exists
        if ($request->hasFile('image5')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image5')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image5')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore5 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image5')->storeAs('public/images/product', $fileNameToStore5);
            $image->image5 = $fileNameToStore5;
        }

        // Save image to database
        $image->save();

        // Return json response
        return response()->json(array('product' => $product->toArray(),'image' => $image->toArray(), 'colors' => $product->colors,'sizes' => $product->sizes,'tags' => $product->tags));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        
        // Validate form data
        $rules = array(
            'productName' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'shortDescription' => 'required|string',
            'description' => 'required|string',
            'image1' => 'nullable|image|max:1000',
            'image2' => 'nullable|image|max:1000',
            'image3' => 'nullable|image|max:1000',
            'image4' => 'nullable|image|max:1000',
            'image5' => 'nullable|image|max:1000',
        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        // Find the Product model & assign form value then save to database
        $product = Product::find($id);
        $product->productName = $request->productName;
        $product->sku = $request->sku;
        $product->slug = str_slug($request->productName);

        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->minicategory_id = $request->minicategory_id;
        $product->tab_id = $request->tab_id;
        $product->brand_id = $request->brand_id;
        $product->shortDescription =$request->shortDescription;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->regularPrice = $request->regularPrice;
        $product->type = $request->type;
        $product->availability = $request->availability;
        $product->paymentOption = $request->paymentOption;

        $product->measurement = $request->measurement;
        $product->min_order_qty = $request->min_order_qty;
        $product->delivery_time = $request->delivery_time;
        $product->delivery_from = $request->delivery_from;

        $product->delivery_charge = $request->delivery_charge;
        $product->return_policy = $request->return_policy;

        //discount  percentage value
        $product->discount  =   $request->discount;
        $product->occasion  =   $request->occasion;
        $product->promotion =   $request->promotion;
        $product->clearance =   $request->clearance;
        $product->buy_get   =   $request->buy_get;


        if($request->deal_id == 0){

            $product->deal_id = null;
        }else{
            $product->deal_id = $request->deal_id;
        }

        $product->published = true;


        $product->save();

        // Detach previous color, tag & size
        $product->colors()->detach();
        $product->sizes()->detach();
        $product->tags()->detach();

        // Check if color is set
        if (isset($request->color)) {
            // Loop over checked values
            foreach ($request->color as $value) {
                // Update with new values
                $product->colors()->attach($value);
            }
        }

        // Check if size is set
        if (isset($request->size)) {
            // Loop over checked values
            foreach ($request->size as $value) {
                // Update with new values
                $product->sizes()->attach($value);
            }
        }

        // Check if tag is set
        if (isset($request->tag)) {
            // Loop over checked values
            foreach ($request->tag as $value) {
                // Update with new values
                $product->tags()->attach($value);
            }
        }

        // Create instance of Image model & assign form value then save to database
        $image = Image::where('product_id', $product->id)->first();

        // Handle image upload

        // Checks if the file exists
        if ($request->hasFile('image1')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image1')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image1')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore1 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image1')->storeAs('public/images/product', $fileNameToStore1);
            // Delete image from the directory
            Storage::delete('public/images/product/'.$image->image1);
            // Update database
            $image->image1 = $fileNameToStore1;
        }

        // Checks if the file exists
        if ($request->hasFile('image2')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image2')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image2')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore2 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image2')->storeAs('public/images/product', $fileNameToStore2);

            // Checks if file exists
            if (!is_null($image->image2)){
                // Delete image from the directory
                Storage::delete('public/images/product/'.$image->image2);
            }

            // Update database
            $image->image2 = $fileNameToStore2;
        }

        // Checks if the file exists
        if ($request->hasFile('image3')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image3')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image3')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore3 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image3')->storeAs('public/images/product', $fileNameToStore3);

            // Checks if file exists
            if (!is_null($image->image3)){
                // Delete image from the directory
                Storage::delete('public/images/product/'.$image->image3);
            }

            // Update database
            $image->image3 = $fileNameToStore3;
        }

        // Checks if the file exists
        if ($request->hasFile('image4')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image4')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image4')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore4 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image4')->storeAs('public/images/product', $fileNameToStore4);

            // Checks if file exists
            if (!is_null($image->image4)){
                // Delete image from the directory
                Storage::delete('public/images/product/'.$image->image4);
            }

            // Update database
            $image->image4 = $fileNameToStore4;
        }

        // Checks if the file exists
        if ($request->hasFile('image5')){
            // Get file name with extension
            $fileNameWithExt = $request->file('image5')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('image5')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore5 = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('image5')->storeAs('public/images/product', $fileNameToStore5);

            // Checks if file exists
            if (!is_null($image->image5)){
                // Delete image from the directory
                Storage::delete('public/images/product/'.$image->image5);
            }

            // Update database
            $image->image5 = $fileNameToStore5;
        }

        $image->save();

        // Return json response
        return response()->json(array('product' => $product->toArray(),'image' => $image->toArray(), 'colors' => $product->colors,'sizes' => $product->sizes,'tags' => $product->tags));
    }
}
