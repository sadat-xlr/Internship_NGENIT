@extends('layouts.admin')
@section('title')
    <title>Pre Orders</title>
@endsection
@php
    $currentTime = \Carbon\Carbon::now()->format('d-m-Y');
@endphp
@section('breadcrumbhead')
    <h1>
        Pre Orders
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Client</li>
        <li class="active">Pre Orders</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Pre Order</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Order id</th>
                <th>Client</th>
                <th>Date</th>
                <th>Total price</th>
                <th>Paid Amount</th>
                <th>Due</th>
                <th>card_type</th>
                <th>Transaction ID</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($preOrders as $preOrder)
                <tr id="preOrder{{$preOrder->id}}">
                    <td>{{$preOrder->id}}</td>
                    <td>{{$preOrder->client->clientName}}</td>
                    <td>{{$preOrder->created_at->format('d-m-y')}}</td>

                    @php
                        $paid_amount = 0;
                        
                        foreach($preOrder->preorderPayments as $preorderPayment)
                        {
                            $paid_amount += $preorderPayment->payment->amount;
                        }

                        $paid_amount += $preOrder->payment->amount;
                    
                    @endphp

                    <td>
                        {{$preOrder->totalAmount}}
                    </td>
                    <td>{{$paid_amount}}</td>
                    <td>{{$preOrder->totalAmount - $paid_amount}}</td>
                    <td>{{$preOrder->payment->card_type}}</td>
                    <td>{{$preOrder->payment->tran_id}}</td>
                    <td>
                        <div class="table-data-feature">
                            @can('order handle')
                                <a href="#" class="edit-preOrder btn btn-warning btn-sm" data-id="{{$preOrder->id}}" data-status="{{$preOrder->status}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{url('pre-order-details/'.$preOrder->id)}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i></a>
                                <a href="#" class="delete-preOrder btn btn-danger btn-sm" data-id="{{$preOrder->id}}">
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