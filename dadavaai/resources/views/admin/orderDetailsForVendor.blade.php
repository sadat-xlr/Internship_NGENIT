@extends('layouts.admin')
@section('title')
    <title>Order details for Vendor</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Order details for Vendor
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/order-for-vendor')}}"></i> order</a></li>
        <li class="active">Order details</li>
    </ol>
@endsection

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">order #{{$order_id}} </h3> <br> <h3 class="box-title">vendor #{{$vendor->vendorName}} </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>qunatity</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orderedProductDetails as $orderedProductDetail)
                    <tr id="orderedProductDetail{{$orderedProductDetail->id}}">
                        <td>{{$orderedProductDetail->product->productName}}</td>
                        <td><img src="{{asset('storage/images/product/'.$orderedProductDetail->product->image->image1)}}" height="100px" width="100px"/></td>
                        <td>{{$orderedProductDetail->qty}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>delivery status</th>
                    <th>
                        Acknowledgement
                        <a href="#" class="delivery-acknowledgement-status btn btn-success btn-sm" data-order_id="{{$order_id}}" data-vendor_id="{{$vendor->id}}">
                            change
                        </a>
                    </th>
                    <th>comments</th>
                    <th>
                        Payment status
                        <a href="#" class="payment-status btn btn-success btn-sm" data-order_id="{{$order_id}}" data-vendor_id="{{$vendor->id}}">
                            change
                        </a>
                    </th>
                    <th>Acknowledgement</th>
                    <th>comments</th>
                </tr>
                </thead>
                <tbody>
                @php
                        
                    $deliveryStatus = \App\Vendordelivery::where('order_id', $order_id)
                                                               ->where('vendor_id', $vendor->id)
                                                               ->first(); 
                    $paymentStatus = \App\Vendorpayment::where('order_id', $order_id)
                                                               ->where('vendor_id', $vendor->id)
                                                               ->first(); 
                @endphp
                <tr>
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
                                @if($deliveryStatus->acknowledgement == true )
                                    recieved
                                @else
                                    pending
                                @endif
                            </p>
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
                    @if($paymentStatus)
                        <td>
                                @if($paymentStatus->status == 0)
                                    processing
                                @elseif($paymentStatus->status == 1)
                                    On Hold
                                @elseif($paymentStatus->status == 2 && $paymentStatus->acknowledgement == 0)
                                    Paid(not confirmed)
                                @elseif($paymentStatus->status == 2 && $paymentStatus->acknowledgement == 1)
                                    Paid(confirmed)
                                @endif
                        </td>
                        <td>
                            <p>
                                @if($paymentStatus->acknowledgement == true )
                                    confirm
                                @else
                                    pending
                                @endif
                            </p>
                        </td>
                        <td>
                            <p>
                                @if($paymentStatus->comments)
                                    {{$paymentStatus->comments}}
                                @else
                                    No Comments
                                @endif
                            </p>
                        </td>
                     @endif

                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

{{-- Modal For acknowledgement status --}}
<div id="acknowledgement" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="acknowledgement_status-form" action="{{url('#')}}">
                    <div class="form-group">
                        <label for="acknowledgement_status category" class="control-label col-sm-4">Delivery acknowledgement status :</label>
                        <div class="col-sm-8">
                            <select name="acknowledgement_status" class="form-control" id="acknowledgement_status" required>
                                <option value="0" selected>Pending</option>
                                <option value="1">received</option>
                            </select>
                            <p class="error acknowledgement_status text-center alert alert-danger hidden"></p>
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





{{-- Modal For payment status --}}
<div id="payment" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="payment_status-form" action="{{url('#')}}">
                    <div class="form-group">
                        <label for="payment_status category" class="control-label col-sm-2">Payment status :</label>
                        <div class="col-sm-4">
                            <select name="payment_status" class="form-control" id="payment_status" required>
                                <option value="0" selected>Processing</option>
                                <option value="1">On Hold</option>
                                <option value="2">Paid</option>
                            </select>
                            <p class="error payment_status text-center alert alert-danger hidden"></p>
                        </div>
                        <label class="control-label col-sm-2" for="comments">Comments :</label>
                        <div class="col-sm-4 input-group">
                            <textarea type="text" class="form-control pull-right" name="comments" id="comments">
                                
                            </textarea>
                            <p class="error comments text-center alert alert-danger hidden"></p>
                        </div>  
                        <input type="text" class="hidden" name="order_id" class="form-control" id="payment_order_id" >
                        <input type="text" class="hidden" name="vendor_id" class="form-control" id="payment_vendor_id" >

                        
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

@endsection
