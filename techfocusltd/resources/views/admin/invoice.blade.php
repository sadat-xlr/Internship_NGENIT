<!DOCTYPE html>
<html>
<head>
    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>TechFocus Ltd Admin Panel - Focusing on Technology</title>
    <meta name="description" content="Metro Admin Template.">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link id="bootstrap-style" href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
    <link id="base-style" href="{{asset('admin/css/style.css')}}" rel="stylesheet">
    <link id="base-style-responsive" href="{{asset('admin/css/style-responsive.css')}}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
    <!-- end: CSS -->

    <!-- start: jquery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- end: jquery -->

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="admin/img/favicon.ico">
    <!-- end: Favicon -->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Techfocusltd, Inc.
                    <small class="pull-right">Date: {{$order->created_at}}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>Techfocusltd, Inc.</strong><br>
                    Haque Chamber(11 floor - C&D)<br>
                    89/2, West Panthapath,Dhaka<br>
                    Phone:  (+88) 029110348<br>
                    Email: sales@techfocusltd.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>{{$order->customer->company}}</strong><br>
                    {{$order->customer->address}}<br>
                    {{$order->customer->city}}, {{$order->customer->division}}, {{$order->customer->country}}<br>
                    Phone: {{$order->customer->phone}}<br>
                    Email: {{$order->customer->email}}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice #{{$order->id}}</b><br>
                <br>
                <b>Order ID:</b> {{$order->id}}<br>
                <b>Account:</b> {{$order->payment->accNo}}
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
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
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
                        <tr>
                            <td>{{$orderDetail->quantity}}</td>
                            <td>{{$orderDetail->product->productName}}</td>
                            <td>{{$orderDetail->product->sku}}</td>
                            <td>{{substr(strip_tags($orderDetail->product->description), 0, 52)}}...</td><td>৳ {{$unitPrice}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">
                    Payment Method:
                    @if($order->payment->paymentMethod == 0) bKash
                    @elseif($order->payment->paymentMethod == 1) Rocket
                    @elseif($order->payment->paymentMethod == 2)direct bank transfer
                    @elseif($order->payment->paymentMethod == 3)check payment
                    @else Cach on delivery @endif
                </p>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    <b>Account No.:</b> {{$order->payment->accNo}}<br>
                    <b>Transaction ID:</b> {{$order->payment->tranId}}<br>
                    <b>Account Name:</b> {{$order->payment->acc_name}}<br>
                    <b>Bank:</b> {{$order->payment->bank_name}}<br>
                    <b>Deposit(scanned copy):</b> <img src="{{asset("storage/images/client/payment/".$order->payment->deposit)}}" alt="N/A">
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Amount Due 2/22/2014</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>৳ {{$cart_subtotal}}</td>
                        </tr>
                        <tr>
                            <th>Tax (15%)</th>
                            <td>৳ {{$total_price*0.15}}</td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>৳ 15</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>৳ {{$total_price+($total_price*0.15)+15}}</td>
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
<!-- ./wrapper -->
</body>
</html>
