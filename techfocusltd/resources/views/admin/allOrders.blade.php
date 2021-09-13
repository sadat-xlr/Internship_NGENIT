@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Order</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">All Order</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Order</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table id="example1" class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>Order id</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total price</th>
                        <th>Payment Method</th>
                        <th>Account No.</th>
                        <th>Transaction ID</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr id="order{{$order->id}}">
                            <td>{{$order->id}}</td>
                            <td>{{$order->customer->company}}</td>
                            <td>{{$order->created_at}}</td>
                            <td id="sts{{$order->id}}">
                                @if($order->status  == 0)
                                    On hold
                                @elseif($order->status  == 1)
                                    Processing
                                @elseif($order->status  == 2)
                                    Pending payment
                                @elseif($order->status == 3)
                                    Completed
                                @elseif($order->status  == 4)
                                    Cancelled
                                @elseif($order->status  == 5)
                                    Refunded
                                @else
                                    Failed
                                @endif
                            </td>
                            <td>
                                @php $total_price = $cart_subtotal = 0; @endphp
                                @foreach($order->orderDetails as $orderDetail)
                                    @php
                                        $price = 0;
                                        foreach($orderDetail->product->deals as $deals){
                                            if ($deals){
                                                if ($deals->valid_until >= \Carbon\Carbon::now()){
                                                    $price = $orderDetail->product->price-(($orderDetail->product->price*$deals->discount_value)/100);
                                                }
                                            }
                                        }

                                        foreach($orderDetail->product->offers as $offers){
                                            if ($offers){
                                                if ($offers->valid_until >= \Carbon\Carbon::now()){
                                                    $price = $orderDetail->product->price-(($orderDetail->product->price*$offers->discount_value)/100);
                                                }
                                            }
                                        }

                                        if(isset($price) && $price != 0)
                                            $proPrice = $price;
                                        else
                                            $proPrice = $orderDetail->product->price;

                                        $unitPrice = $orderDetail->quantity * $proPrice;
                                        $total_price += $unitPrice;
                                        $cart_subtotal += $unitPrice;
                                    @endphp
                                @endforeach
                                @if($order->discount_id != null)
                                    @php
                                        $discount = \App\Discount::find($order->discount_id);
                                    if($discount->discount_unit == 0){
                                    $discount_val = ($total_price*$discount->discount_value)/100;
                                        $total_price = $total_price - $discount_val;
                                    }
                                    elseif($discount->discount_unit  == 1){
                                        $discount_val = $total_price - $discount->discount_value;
                                        $total_price = $total_price - $discount_val;
                                    }
                                    else{
                                        $discount_val = $total_price - $discount->discount_value;
                                        $total_price = $total_price - $discount_val;
                                    }
                                    @endphp
                                @endif
                                ৳ {{$total_price+($total_price*0.15)+15}}
                            </td>
                            <td>
                                @if($order->payment->paymentMethod == 0)
                                    bKash
                                @elseif($order->payment->paymentMethod == 1)
                                    Rocket
                                @elseif($order->payment->paymentMethod == 2)
                                    direct bank transfer
                                @elseif($order->payment->paymentMethod == 3)
                                    check payment
                                @else
                                    Cach on delivery
                                @endif
                            </td>
                            <td>{{$order->payment->accNo}}</td>
                            <td>{{$order->payment->tranId}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="#" class="show-order btn btn-info btn-sm" data-id="{{$order->id}}" data-date="{{$order->created_at}}" data-company="<b>Company Info</b><br><b>Company:</b> {{$order->customer->company}}<br><b>Email:</b> {{$order->customer->email}}<br><b>Phone:</b> {{$order->customer->phone}}<br><b>Email(Office):</b> {{$order->customer->office_email}}<br><b>Phone(Office):</b> {{$order->customer->office_phone}}" {{--data-billing="Billing Details<address><strong>{{$order->customer->customerName}}</strong><br>{{$order->billing->address}}<br>{{$order->billing->city}}, {{$order->billing->division}}, {{$order->billing->country}}<br>Phone: {{$order->billing->phone}}<br>Email: {{$order->billing->email}}</address>"--}} @if ($order->shipping != null) data-shipping="Shipping Details<address><strong>{{$order->customer->customerName}}</strong><br>{{$order->shipping->address}}<br>{{$order->shipping->city}}, {{$order->shipping->division}}, {{$order->shipping->country}}<br>Phone: {{$order->shipping->phone}}<br>Email: {{$order->shipping->email}}</address>" @endif data-orderDetails="@foreach($order->orderDetails as $orderDetail)
                                    @php
                                        $price = 0;
                                        foreach($orderDetail->product->deals as $deals){
                                            if ($deals){
                                                if ($deals->valid_until >= \Carbon\Carbon::now()){
                                                    $price = $orderDetail->product->price-(($orderDetail->product->price*$deals->discount_value)/100);
                                                }
                                            }
                                        }

                                        foreach($orderDetail->product->offers as $offers){
                                            if ($offers){
                                                if ($offers->valid_until >= \Carbon\Carbon::now()){
                                                    $price = $orderDetail->product->price-(($orderDetail->product->price*$offers->discount_value)/100);
                                                }
                                            }
                                        }

                                        if(isset($price) && $price != 0)
                                            $proPrice = $price;
                                        else
                                            $proPrice = $orderDetail->product->price;

                                        $unitPrice = $orderDetail->quantity * $proPrice;
                                    @endphp
                                            <tr><td>{{$orderDetail->quantity}}</td><td>{{$orderDetail->product->productName}}</td><td>{{$orderDetail->product->sku}}</td><td>{{substr(strip_tags($orderDetail->product->description), 0, 52)}}...</td><td>৳{{$unitPrice}}</td></tr> @endforeach" data-paymentMethod='<p class="lead">Payment Method:@if($order->payment->paymentMethod == 0) bKash @elseif($order->payment->paymentMethod == 1) Rocket @elseif($order->payment->paymentMethod == 2)direct bank transfer@elseif($order->payment->paymentMethod == 3)check payment @else Cach on delivery @endif</p><p class="text-muted well well-sm no-shadow" style="margin-top: 10px;"><b>Account No.:</b> {{$order->payment->accNo}}<br><b>Transaction ID:</b> {{$order->payment->tranId}}<br><b>Account Name:</b> {{$order->payment->acc_name}}<br><b>Bank:</b> {{$order->payment->bank_name}}<br><b>Deposit(scanned copy):</b> <img src="{{asset("storage/images/customer/payment/".$order->payment->deposit)}}" alt="N/A"></p>' data-subtotal="৳{{$cart_subtotal}}" data-tax="৳{{$total_price*0.15}}" data-total="৳{{$total_price+($total_price*0.15)+15}}">
                                        <i class="halflings-icon white eye-open"></i>
                                    </a>
                                    <a href="#" class="edit-order btn btn-warning btn-sm" data-id="{{$order->id}}" data-status="{{$order->status}}">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a href="{{url('orders/'.$order->id.'/edit')}}" target="_blank" class="btn btn-default"><i class="halflings-icon white print"></i></a>
                                    <a href="#" class="delete-order btn btn-danger btn-sm" data-id="{{$order->id}}">
                                        <i class="halflings-icon white trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!--/span-->
    </div><!--/row-->

    {{-- Modal Form and Client Post --}}
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
                    <form class="form-horizontal" role="form" id="order-form" action="{{url('orders')}}">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="status">Status :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="status" name="status" required>
                                    <option value="0">On hold</option>
                                    <option value="1">Processing</option>
                                    <option value="2">Pending payment</option>
                                    <option value="3">Completed</option>
                                    <option value="4">Cancelled</option>
                                    <option value="5">Refunded</option>
                                    <option value="6">Failed</option>
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="coupon_code">Apply Coupon:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="coupon_code" name="coupon_code"
                                       placeholder="Coupon code Here" required>
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
                                    <i class="fa fa-globe"></i> Offtica, Inc.
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
                                            <th>Serial #</th>
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
                                <p class="lead">Amount Due 2/22/2014</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td id="subtotal">$250.30</td>
                                        </tr>
                                        <tr>
                                            <th>Tax (15%)</th>
                                            <td id="tax">$10.34</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td>৳15</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td id="total">$265.24</td>
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