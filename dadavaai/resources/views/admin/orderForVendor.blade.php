@extends('layouts.admin')
@section('title')
    <title>Order for vendor</title>
@endsection
@section('breadcrumbhead')
    <h1>
        Order for vendor
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Order for vendor</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Pending Order</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>SL.</th>
                <th>date</th>
                <th>Vendor</th>
                <th>Order no</th>
                <th>Order Details</th>
                <th>Status</th>
                <th>Comments</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $key = 0;
                @endphp
            @foreach($orderForVendors as $orderForVendor)
                    @php

                        $deliveryStatus = \App\Vendordelivery::where('order_id', $orderForVendor->order_id)
                                                               ->where('vendor_id', $orderForVendor->vendor_id)
                                                               ->first(); 
                    @endphp
                @if($deliveryStatus->status != 2)
                <tr id="orderForVendor{{$orderForVendor->id}}">
                    <td>{{$key + 1}}</td>
                    <td>{{$orderForVendor->created_at->format('Y-m-d')}}</td>
                    <td>{{$orderForVendor->vendor->vendorName}}</td>
                    <td>#{{$orderForVendor->order->id}}</td>
                    <td> <a href="{{url('order-details-for-vendor?order_id='.$orderForVendor->order_id.'&vendor_id='.$orderForVendor->vendor_id)}}">Details</a></td>
                    @if($deliveryStatus)
                        <td>
                                @if($deliveryStatus->status == 0)
                                    pending
                                @elseif($deliveryStatus->status == 1)
                                    On delivered
                                @elseif($deliveryStatus->status == 2 && $deliveryStatus->acknowledgement == 0)
                                    delivered(not confirmed)
                                @elseif($deliveryStatus->status == 2 && $deliveryStatus->acknowledgement == 1)
                                    delivered(confirmed)
                                @endif
                        </td>
                        <td>
                            <p>
                                @if($deliveryStatus->comments)
                                    {{$deliveryStatus->comments}}
                                @else
                                    No Comments
                                @endif
                            </p>
                        </td>
                     @endif
                </tr>
                @endif
                @php
                    $key++;
                @endphp
                
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Order list</h3>
    </div>
    <div class="box-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>SL.</th>
                <th>date</th>
                <th>Order no</th>
                <th>Order Details</th>
                <th>Status</th>
                <th>Payment</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $keyNo = 0;
                @endphp
            @foreach($orderForVendors as $orderListForVendor)

                    @php
                        
                        $deliveryStatus = \App\Vendordelivery::where('order_id', $orderListForVendor->order_id)
                                                               ->where('vendor_id', $orderListForVendor->vendor_id)
                                                               ->first(); 
                        $paymentStatus = \App\Vendorpayment::where('order_id', $orderListForVendor->order_id)
                                                               ->where('vendor_id', $orderListForVendor->vendor_id)
                                                               ->first(); 
                    @endphp
                @if($deliveryStatus->status == 2)
                    <tr id="orderListForVendor{{$orderListForVendor->id}}">
                        <td>{{$keyNo + 1}}</td>
                        <td>{{$orderListForVendor->created_at->format('Y-m-d')}}</td>
                        <td>#{{$orderListForVendor->order->id}}</td>
                        <td> <a href="{{url('order-details-for-vendor?order_id='.$orderListForVendor->order_id.'&vendor_id='.$orderListForVendor->vendor_id)}}">Details</a></td>
                        @if($deliveryStatus)
                            <td>
                                @if($deliveryStatus->status == 2 && $deliveryStatus->acknowledgement == 0)
                                    delivered(not confirmed)
                                @elseif($deliveryStatus->status == 2 && $deliveryStatus->acknowledgement == 1)
                                    delivered(confirmed)
                                @endif                    
                            </td>
                        @endif
                        @if($paymentStatus)
                            <td>
                                @if($paymentStatus->status == 2 && $paymentStatus->acknowledgement == 0)
                                    pending
                                @elseif($paymentStatus->status == 2 && $paymentStatus->acknowledgement == 1)
                                    received
                                @else
                                    pending
                                @endif                    
                            </td>
                        @endif
                    </tr>
                @endif
                @php
                    $keyNo++;
                @endphp
            @endforeach
            </tbody>
        </table>
    </div>
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


{{-- Modal For delivery status --}}
<div id="delivery" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="delivery_status-form" action="{{url('#')}}">
                    <div class="form-group">
                        <label for="delivery_status category" class="control-label col-sm-2">Delivery status :</label>
                        <div class="col-sm-4">
                            <select name="delivery_status" class="form-control" id="delivery_status" required>
                                <option value="0" selected>Pending</option>
                                <option value="1">On delivered</option>
                                <option value="2">Delivered</option>
                            </select>
                            <p class="error delivery_status text-center alert alert-danger hidden"></p>
                        </div>
                        <label class="control-label col-sm-2" for="comments">Comments :</label>
                        <div class="col-sm-4 input-group">
                            <textarea type="text" class="form-control pull-right" name="comments" id="comments">
                                
                            </textarea>
                            <p class="error comments text-center alert alert-danger hidden"></p>
                        </div>  
                        <input type="text" class="hidden" name="order_id" class="form-control" id="order_id" >
                        <input type="text" class="hidden" name="vendor_id" class="form-control" id="vendor_id" >

                        
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-10"></label>
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
