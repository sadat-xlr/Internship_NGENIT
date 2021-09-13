@extends('layouts.admin')
@section('title')
    <title>Orders</title>
@endsection
@php
    $currentTime = \Carbon\Carbon::now()->format('d-m-Y');
@endphp
@section('breadcrumbhead')
    <h1>
        Orders
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Client</li>
        <li class="active">orders</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Order</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Order id</th>
                <th>Client</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total price</th>
                <th>Paid Amount</th>
                <th>card_type</th>
                <th>Transaction ID</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr id="order{{$order->id}}">    
                    <td>{{$order->id}}</td>
                    <td>{{$order->client->clientName}}</td>
                    <td>{{$order->created_at}}</td>
                    <td id="sts{{$order->id}}">
                        @if($order->status  == 0)
                            order recived
                        @elseif($order->status  == 1)
                            payment Pending
                        @elseif($order->status  == 2)
                            payment recived
                        @elseif($order->status == 3)
                            order processiong
                        @elseif($order->status  == 4)
                            Cancelled
                        @elseif($order->status  == 5)
                            Refunded
                        @elseif($order->status  == 6)
                            Failed
                        @elseif($order->status  == 7)
                            On shipment
                        @else
                            Delivered
                        @endif
                    </td>
                    <td>
                        @if (count($order->orderDetails)>0)
                            @php
                                $total_price = $cart_subtotal = 0;
                                $shipping = 100;
                                $vatTax = 7.5;
                            @endphp
                            @foreach($order->orderDetails as $x)
                                @php
                                    $salePrice = 0;
                                    $salePrice = $x->product->regularPrice;

                                    if($x->product->discount){
                                        
                                        if($x->product->deal_id != null && $x->product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                            $proPrice = $salePrice-(($salePrice*($x->product->deal->discount_value + $x->product->discount))/100);
                                        else
                                            $proPrice = $salePrice-(($salePrice*$x->product->discount)/100);
                                    }
                                    else
                                    {
                                        if($x->product->deal_id != null && $x->product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                            $proPrice = $salePrice-(($salePrice*$x->product->deal->discount_value)/100);
                                        else
                                            $proPrice = $x->product->regularPrice;
                                    }  
                                    
                                    if ($x->product->bundleOffers) {
                                        foreach ($x->product->bundleOffers as  $bundleOffer) {
                                            if ($x->quantity >= $bundleOffer->qty_start) {
                                                $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                                            }
                                        }
                                    }
                                                                
                                    $unitPrice = $x->quantity * $proPrice;
                                    $total_price += $unitPrice;
                                    $cart_subtotal += $unitPrice;
                                @endphp
                            @endforeach
                            {{-- Tk  --}}
                            {{$total_price + ($total_price * ($vatTax/100)) + $shipping}}
                        @elseif (count($order->serviceOrders)>0)
                            @php
                                $total_price = 0;
                                $shipping = 0;
                                $vatTax = 0;
                            @endphp
                            @foreach($order->serviceOrders as $x)
                                @php
                                    $salePrice = 0;
                                    $salePrice = $x->service->regularPrice;

                                    if($x->service->discount){
                                        $proPrice = $salePrice-(($salePrice*$x->service->discount)/100);
                                    }
                                    else
                                    {
                                        $proPrice = $x->service->regularPrice;
                                    }  
                                                                                           
                                    $unitPrice = $x->quantity * $x->hour * $proPrice;
                                    $total_price += $unitPrice;
                                @endphp
                            @endforeach
                            {{-- Tk  --}}
                            {{$total_price + ($total_price * ($vatTax/100)) + $shipping}}
                        @endif
                        
                    </td>
                    <td>
                        @if($order->payment->paymentOption != 1)
                            {{$order->payment->amount}}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        @if($order->payment->paymentOption == 1)
                            Cash On delivery
                        @else
                            {{$order->payment->card_type}}
                        @endif
                    </td>
                    <td>{{$order->payment->tran_id}}</td>
                    <td>
                        <div class="table-data-feature">
                            @can('order handle')
                                <a href="#" class="edit-order btn btn-warning btn-sm" data-id="{{$order->id}}" data-status="{{$order->status}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{url('orders/'.$order->id.'/edit')}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i></a>
                                <a href="#" class="delete-order btn btn-danger btn-sm" data-id="{{$order->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

{{-- Modal Form update order --}}
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
                <form class="form-horizontal" role="form" id="order-form" method="POST" action="{{url('orders')}}">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="status">Status :</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="status" name="status" required>
                                <option value="0">order recived</option>
                                <option value="1">payment Pending</option>
                                <option value="2">payment recived</option>
                                <option value="3">order processing</option>
                                <option value="4">Cancelled</option>
                                <option value="5">Refunded</option>
                                <option value="6">Failed</option>
                                <option value="7">On shipment</option>
                                <option value="8">Delivered</option>

                            </select>
                        </div>
                        <label class="control-label col-sm-2" for="delivery_date">Delivery date:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="delivery_date" name="delivery_date"
                                   placeholder="Tentative Delivery date">
                        </div>
                    </div>
                    <input type="hidden" id="fid">
                    <input type="hidden" name="_method" value="PUT">
                </form>
                {{-- Form Delete Post --}}
                <input type="hidden" name="_method1" value="DELETE">
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

{{-- Modal Form Show POST --}}
<div id="show" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="largeModalLabel">Order Details</h2>
            </div>
            <div class="modal-body">
                <!-- Main content -->
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> Dadavaai, Inc.
                                <small class="pull-right">Date: 2/10/2014</small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col" id="companyInfo">
                            <b>Personnel Info</b><br>
                            <b>Email:</b> 4F3S8J<br>
                            <b>Phone:</b> 2/22/2014<br>
                            <b>Email(Office):</b> 968-34567<br>
                            <b>Phone(Office):</b> 2/22/2014
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col" id="billing">
                            Billing Details
                            <address>
                                <strong>John Doe</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (555) 539-1037<br>
                                Email: john.doe@example.com
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col" id="shipping">
                            Shipping Details
                            <address>
                                <strong>John Doe</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (555) 539-1037<br>
                                Email: john.doe@example.com
                            </address>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Product</th>
                                        <th>SKU </th>
                                        <th>Description</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="orderDetails">
                                    <tr>
                                        <td>1</td>
                                        <td>Call of Duty</td>
                                        <td>455-981-221</td>
                                        <td>El snort testosterone trophy driving gloves handsome</td>
                                        <td>$64.50</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6" id="payment">
                            <p class="lead">Payment Method:</p>
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                <b>Account No.:</b> 4F3S8J<br>
                                <b>Transaction ID:</b> 2/22/2014<br>
                                <b>Email(Office):</b> 968-34567<br>
                                <b>Phone(Office):</b> 2/22/2014
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td id="subtotal">$250.30</td>
                                    </tr>
                                    // <tr id="discount_row">
                                    //     <th style="width:50%">Discount:</th>
                                    //     <td id="discount">N/A</td>
                                    // </tr>
                                    <tr>
                                        <th>Tax </th>
                                        <td id="tax">$10.34</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping:</th>
                                        <td id="ship">Tk 15</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td id="total">Tk 265.24</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
        </div>
    </div>
</div>

@endsection