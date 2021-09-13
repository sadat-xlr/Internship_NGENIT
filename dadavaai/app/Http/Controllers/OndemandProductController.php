<?php

namespace App\Http\Controllers;

use App\Client;
use App\Ondemand;
use App\Ondemandproduct;
use App\Category;
use App\Vendor;
use App\Quotation;
use App\Productprovide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Response;
use Session;
use DB;

class OndemandProductController extends Controller
{
    
    // Get ondemand Product 
    public function getOndemandProduct(Request $request){
        $ondemandProducts = Ondemandproduct::where('category_id', $request->catId)
                                            ->where('subcategory_id', $request->subCatId)
                                            ->where('minicategory_id', $request->miniCatId)
                                            ->pluck('product_name','id')->toArray();

        $data = "<option value=''>--Select One--</option>";
        foreach($ondemandProducts as $key => $ondemandProduct)
        {
            $data .= "<option value='$ondemandProduct'>$ondemandProduct</option>";
        }
        return $data;
    }


    public function quoteToClient($ondemand_id, $quotation_id)
    {

        $quotation = Quotation::where('id', $quotation_id)
                                ->where('ondemand_id', $ondemand_id)
                                ->first();
        $quotation->quote_status = true;
        $quotation->status       =   2;
        $quotation->save();
  
        return response()->json(array('success'=> 'successfully Quoted'));
    }

    public function allToQuote($id)
    {
        $ondemand = Ondemand::find($id);

        foreach ($ondemand->quotations as $quotation) {
            $quotation->quote_status = true;
            $quotation->status       =   2;
            $quotation->save();
        }

        return response()->json(array('success'=> 'successfully Quoted'));
    }

    public function quotation(Request $request, $id)
    {
        // Validate form data
        $rules = array(
            'price'          => 'required',
            'delivery_day'  => 'required|integer',

        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        //Rfq or ondemand  notification for each vendors
        $vendor_id = Session::get('VENDOR_ID');
        $vendor = Vendor::where('id', $vendor_id)->first();
        $current_time = Carbon::now()->format('Y-m-d');

        

        $ondemand_id = $request->ondemand_id;

        $ondemand    = Ondemand::find($ondemand_id);

        if ($ondemand->expiry_date <= Carbon::parse($current_time)->format('Y-m-d')) {
            return Response::json(array('errors'=> 'Date is expired'));
        }

        $quotation = Quotation::where('vendor_id', $vendor->id)
                                ->where('ondemand_id', $ondemand_id)
                                ->first();
        if (!empty($quotation)) {
            return Response::json(array('errors'=> 'You already submited a quotation for this rfq'));
        }



        $quotation                  = new Quotation;
        $quotation->price           = $request->price;
        $quotation->delivery_day    = $request->delivery_day;
        $quotation->status          = 1;
        $quotation->vendor_id       = $vendor->id;
        $quotation->ondemand_id     = $ondemand_id;
        $quotation->save();


        return response()->json($quotation);
    }

    //single ondemand for client
    public function clientOndemand($id)
    {
        $ondemand = Ondemand::where('id', $id)->first();
        $quotations = Quotation::where('ondemand_id', $ondemand->id)
                                ->where('quote_status', true)
                                ->get();
        return view('client.account.ondemand', compact('ondemand', 'quotations'));
    }

    //all ondemand of client 
    public function clientOndemandHistory()
    {
        $client = Client::where('id', Session::get('CLIENT_ID'))->first();
        $ondemands = $client->ondemands->sortByDesc('created_at');
        return view('client.account.ondemandHistory', compact('ondemands'));
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ondemands = Ondemand::all();
        $categories = Category::all();
        return view('admin.ondemand', compact('ondemands', 'categories'));
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
            'ondemand_product'          => 'required|string|max:255',
            'ondemand_product_details'  => 'required|string',
            'qty'                       => 'required|integer',
            'ondemand_category'         => 'required|integer',
            'input_img'                 => 'image|max:2048',

        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        $current_time = Carbon::now();


        $ondemandProduct = New Ondemandproduct;
        $ondemandProduct->product_name    = $request->ondemand_product;
        $ondemandProduct->category_id     = $request->ondemand_category;
        $ondemandProduct->subcategory_id  = $request->ondemand_subcategory;
        $ondemandProduct->minicategory_id = $request->ondemand_minicategory; 
        $ondemandProduct->save();


        //create instant of ondemand
        $ondemand = new Ondemand;

        if ($request->hasFile('input_img')){
            // Get file name with extension
            $fileNameWithExt = $request->file('input_img')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get only extension
            $extension = $request->file('input_img')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName . time() . "." . $extension;
            // Directory to upload
            $path = $request->file('input_img')->storeAs('public/images/ondemand', $fileNameToStore);
            $ondemand->product_image   = $fileNameToStore;
        }

        $ondemand->product         = $request->ondemand_product;
        $ondemand->product_details = $request->ondemand_product_details;
        $ondemand->qty             = $request->qty;
        $ondemand->unit            = $request->unit;
        $ondemand->expiry_date     = $current_time->addDays(3)->toDateString();
        
        $ondemand->category_id     = $request->ondemand_category;
        $ondemand->subcategory_id  = $request->ondemand_subcategory;
        $ondemand->minicategory_id = $request->ondemand_minicategory; 

        $client_id = Session::get('CLIENT_ID');

        //it should be changed 
        $ondemand->client_id   = $client_id;
        $ondemand->save();

       $productProvides = Productprovide::where('category_id', $ondemand->category_id)
                                        ->orWhere('subcategory_id', $ondemand->subcategory_id)
                                        ->orWhere('minicategory_id', $ondemand->minicategory_id)
                                        ->groupBy('vendor_id')
                                        ->get();
        // $vendors = Vendor::with('productprovide')->whereHas('category_id', $ondemand->category_id)->get();

        foreach ($productProvides as $productProvide) {
            
            $vendor = Vendor::find($productProvide->vendor_id);
            $ondemand->vendors()->attach($vendor);
        }

        return redirect()->back()->with('success','Your demand submitted successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $ondemand = Ondemand::find($id);

        $vendors_id = DB::table('productprovides')->select('vendor_id')->where('category_id', $ondemand->category_id)
                                                ->orWhere('subcategory_id', $ondemand->subcategory_id)
                                                ->orWhere('minicategory_id', $ondemand->minicategory_id)
                                                ->get();
        return view('admin.ondemandQuotations', compact('ondemand' , 'vendors_id'));
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
        // Validate form data
        $rules = array(
            'expiry_date'  => 'required|date',

        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        $ondemand = Ondemand::find($id);
        $ondemand->expiry_date = $request->expiry_date;
        $ondemand->save();


        return response()->json($ondemand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the deal & delete it
        $ondemand = Ondemand::find($id);
        
        $ondemand->delete();

        return response()->json();
    }
}
