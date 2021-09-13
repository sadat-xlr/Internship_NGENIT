@extends('layouts.vendor')
@section('title')
    <title>Payment</title>
@endsection
@section('breadcrumbhead')
    <h1>
        Payment
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/vendor-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/vendor-orders')}}"> Order</a></li>
        <li class="active">Payment</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Payment status</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>SL.</th>
                <th>date</th>
                <th>Order no</th>
                <th>Order Details</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Acknowledgement</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $keyNo = 0;
                @endphp
            @foreach($vendorPayments as $vendorPayment)

                    @php
                        
                        $deliveryStatus = \App\Vendordelivery::where('order_id', $vendorPayment->order_id)
                                                               ->where('vendor_id', $vendorPayment->vendor_id)
                                                               ->first(); 
                    @endphp
                    <tr id="vendorPayment{{$vendorPayment->id}}">
                        <td>{{$keyNo + 1}}</td>
                        <td>{{$vendorPayment->created_at->format('Y-m-d')}}</td>
                        <td>#{{$vendorPayment->order->id}}</td>
                        <td> <a href="{{url('vendor-order-details?order_id='.$vendorPayment->order_id)}}">Details</a></td>
                        @if($deliveryStatus)
                            <td>
                                @if($deliveryStatus->status == 2 && $deliveryStatus->acknowledgement == 0)
                                    delivered(not confirmed)
                                @elseif($deliveryStatus->status == 2 && $deliveryStatus->acknowledgement == 1)
                                    delivered(confirmed)
                                @endif                    
                            </td>
                        @endif
                        <td>
                            @if($vendorPayment->status == 2 && $vendorPayment->acknowledgement == 0)
                                pending
                            @elseif($vendorPayment->status == 2 && $vendorPayment->acknowledgement == 1)
                                received
                            @elseif($vendorPayment->status == 1 && $vendorPayment->acknowledgement == 0)
                                On hold
                            @elseif($vendorPayment->status == 0 && $vendorPayment->acknowledgement == 0)
                                Procecing
                            @endif                    
                        </td>
                        <td>
                            @if($vendorPayment->status == 2 && $vendorPayment->acknowledgement == 0)
                                pending
                                <a href="#" class="payment-acknowledgement-status btn btn-success btn-sm" data-order_id="{{$vendorPayment->order_id}}">
                                    Change
                                </a>
                            @elseif($vendorPayment->status == 2 && $vendorPayment->acknowledgement == 1)
                                received
                            @else
                                pending
                                <a href="#" class="payment-acknowledgement-status btn btn-success btn-sm" data-order_id="{{$vendorPayment->order_id}}">
                                    Change
                                </a>
                            @endif
                            
                        </td>
                    </tr>                
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->



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
{{-- Modal For payment status --}}
<div id="payment-acknowledgement" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="payment_acknowledgement_status-form" action="{{url('#')}}">
                    <div class="form-group">
                        <label for="payment_acknowledgement_status category" class="control-label col-sm-2">Payment status :</label>
                        <div class="col-sm-8">
                            <select name="payment_acknowledgement_status" class="form-control" id="payment_acknowledgement_status" required>
                                <option value="0" selected>pendind</option>
                                <option value="1">Received</option>
                            </select>
                            <p class="error payment_acknowledgement_status text-center alert alert-danger hidden"></p>
                        </div> 
                        <input type="text" class="hidden" name="order_id" class="form-control" id="payment_order_id" >
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
