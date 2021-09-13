@extends('layouts.vendor')
@section('title')
    <title>RFQ</title>
@endsection
@section('breadcrumbhead')
    <h1>
        RFQ
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/vendor-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">RFQ</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Pending RFQ</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>date</th>
                <th>Rfq no</th>
                <th>Product</th>
                <th>Status</th>
                <th>Expiry Date</th>
                <th>quote</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rfqs as $rfq)
                @if($rfq->status == true)
                    <tr id="rfq{{$rfq->id}}">
                        <td>{{$rfq->created_at->format('Y-m-d')}}</td>
                        <td>{{$rfq->id}}</td>
                        <td>
                            <a href="#" class="show-rfq" data-id="{{$rfq->id}}" data-product="{{$rfq->product}}" 
                                data-product_details="{{$rfq->product_details}}" data-qty="{{$rfq->qty}}" data-unit="{{$rfq->unit}}" 
                                data-image="{{$rfq->product_image}}" data-category="{{$rfq->category->categoryName}} -> {{$rfq->subcategory->subCategoryName}} -> {{$rfq->minicategory->miniCategoryName}}">
                             {{$rfq->product}}
                            </a>
                        </td>
                        <td>
                            @php
                                $vendor_id = Session::get('VENDOR_ID');
                                $vendor = \App\Vendor::where('id', $vendor_id)->first();
                                $quotation = \App\Quotation::where('ondemand_id', $rfq->id)
                                                            ->where('vendor_id', $vendor->id)
                                                            ->first();
                            @endphp
                            
                            @if($quotation)
                                @if($quotation->status == 1)
                                    Submitted to Admin
                                @elseif($quotation->status == 2)
                                    Waiting for Client Order
                                @endif
                                
                            @else    
                                Pendeing to Submit
                            @endif
                        </td>
                        <td> <span style="color: red;"> {{$rfq->expiry_date}}</span></td>
                        <td>
                            @if($quotation)
                                <a href="#" class="show-quotation btn btn-info btn-sm" data-id="{{$quotation->id}}" data-price="{{$quotation->price}}" data-delivery_day="{{$quotation->delivery_day}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @else
                                <a href="#" class="rfq-quote btn btn-success btn-sm" data-id="{{$rfq->id}}">
                                    Quotation
                                </a>
                            @endif

                        </td>
                       
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

<div class="box">
    <div class="box-header">
        <h3 class="box-title">RFQ list</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>date</th>
                <th>Rfq no</th>
                <th>Product</th>
                <th>Status</th>
                <th>quote</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rfqs as $rfq)
                @php
                    $vendor_id = Session::get('VENDOR_ID');
                    $vendor = \App\Vendor::where('id', $vendor_id)->first();
                    $quotation = \App\Quotation::where('ondemand_id', $rfq->id)
                                                ->where('vendor_id', $vendor->id)
                                                ->first();
                @endphp
                @if($rfq->status == false)
                    <tr id="rfq{{$rfq->id}}">
                        <td>{{$rfq->created_at->format('Y-m-d')}}</td>
                        <td>{{$rfq->id}}</td>
                        <td>
                            <a href="#" class="show-rfq" data-id="{{$rfq->id}}" data-product="{{$rfq->product}}" 
                                data-product_details="{{$rfq->product_details}}" data-qty="{{$rfq->qty}}" data-unit="{{$rfq->unit}}" 
                                data-image="{{$rfq->product_image}}" data-category="{{$rfq->category->categoryName}} -> {{$rfq->subcategory->subCategoryName}} -> {{$rfq->minicategory->miniCategoryName}}">
                             {{$rfq->product}}
                            </a>
                        </td>
                            @if($quotation)
                                @if($quotation->confirmation == true)
                                <td>
                                    Ordered
                                </td>
                                <td>
                                    <a href="{{url('ondemand-invoice/?ondemand_id='.$rfq->id)}}" target="_blank" class="show-invoice btn btn-info btn-sm" data-id="{{$quotation->id}}" data-price="{{$quotation->price}}" data-delivery_day="{{$quotation->delivery_day}}">
                                    Invoice
                                </a>
                                </td>

                                @elseif($quotation->confirmation == false)
                                    <td>
                                        Not Ordered
                                    </td>
                                    <td>
                                        <a href="#" class="show-invoice btn btn-info btn-sm" data-id="{{$quotation->id}}" data-price="{{$quotation->price}}" data-delivery_day="{{$quotation->delivery_day}}">
                                            Invoice
                                        </a>
                                    </td>
                                @endif
                            @endif
                        </td>              
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

{{-- Modal for show rfq details--}}
<div id="show-quotation" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="ID" class="control-label col-sm-2">Quotation ID :</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="quotationId" disabled>
                        </div>                              
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="price">Price :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sprice" disabled>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="delivery_day">Delivery Days(with in) :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sdelivery_day" disabled>
                        </div> 
                    </div>

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="glyphicon glyphicon"></span>close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>


{{-- Modal for show rfq details--}}
<div id="show" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-lg-7">
                            <label for="ID" class="control-label col-sm-3">ID :</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="i" disabled>
                            </div>
                            <br>
                            <label for="rfq category" class="control-label col-sm-3">RFQ Type :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ct" disabled>
                            </div>
                            <br>
                            <label for="rfq miniCategory" class="control-label col-sm-3">Name :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="sname" disabled>
                            </div>
                            <br>
                            <label for="rfq miniCategory" class="control-label col-sm-3">Qty :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="sqty" disabled>
                            </div>
                            <br>
                            <label for="rfq miniCategory" class="control-label col-sm-3">Unit :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="sunit" disabled>
                            </div>                                

                        </div>
                        <div class="col-lg-5">
                            <label class="control-label col-sm-3" for="rfq image">Img :</label>
                            <div class="col-sm-9"><img id="img" style="height: 200px;"/></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="details">RFQ details :</label>
                        <div id="details" class="col-sm-10"></div>
                    </div>

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="glyphicon glyphicon"></span>close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>


{{-- Modal For send quotation --}}
<div id="quotation" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="quotation-form" action="{{url('#')}}">
                    <div class="form-group">
                        <label for="rfq category" class="control-label col-sm-2">Price :</label>
                        <div class="col-sm-4">
                            <input type="number" name="price" class="form-control" id="price" required>
                            <p class="error price text-center alert alert-danger hidden"></p>
                        </div>
                        <label class="control-label col-sm-2" for="delivery_date">delivery Days (with in) :</label>
                        <div class="col-sm-4 input-group">
                            <input type="text" class="form-control pull-right" name="delivery_day" id="delivery_day" autocomplete="on" required>
                            <p class="error delivery_day text-center alert alert-danger hidden"></p>
                        </div>  
                        <input type="text" class="hidden" name="ondemand_id" class="form-control" id="ondemand_id" >

                        
                    </div>
                    <div class="form-group">
                        <p class="error already_submited text-center alert alert-warning hidden"></p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-10" for="brandLogo"></label>
                        <div class="col-sm-2">
                            <button class="btn btn-success" type="submit">
                                Send
                            </button>
                        </div>
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="glyphicon glyphicon"></span>close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>







    {{-- Modal Form Update product --}}
{{--     <div id="update" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" id="updateProductProvide">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="category_id">Category :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="ecategory_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="subcategory_id">SubCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="esubcategory_id" name="subcategory_id">
                                    <option value="">Select SubCategory</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            

                            <label class="control-label col-sm-2" for="minicategory_id">MiniCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="eminicategory_id" name="minicategory_id">
                                    <option value="">Select MiniCategory</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-sm-10" for="brandLogo"><input type="hidden" id="ID"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-warning" type="submit">
                                    <span class="glyphicon glyphicon-edit"></span>Update product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class="glyphicon glyphicon"></span>close
                    </button>
                </div>
            </div>
        </div>
    </div>
 --}}
    <div class="clearfix"></div>

    {{-- Modal Form Delete Post --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">

                    {{-- Form Delete Post --}}
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="deleteContent">
                        Are You sure want to delete this data?
                        <span class="hidden id" style="display:none"></span>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class="glyphicon"></span>
                    </button>

                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class="glyphicon glyphicon"></span>close
                    </button>

                </div>
            </div>
        </div>
    </div> 

@endsection

@section('script')

//Date picker
$('#delivery_date, #edelivery_date').datepicker({
format: 'yyyy/mm/dd',
autoclose: true,
todayHighlight: true
})

//Initialize Select2 Elements
//$('.select2').select2()

@endsection