<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dadavaai | Invoice(Client copy)</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                    {{-- <i class="fa fa-globe"></i> Dadavaai, Inc. --}}
                    <img src="{{asset('client/img/logo/dadavaai-favicon.png')}}" width="40px" height="40px" alt="">Dadavaai, Inc.
                    <small class="pull-right">
                        <b>Date: {{$order->created_at}}</b> <br>
                        <b>Invoice # DVI{{$order->id}}</b><br>
                    </small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>Dadavaai, Inc.</strong><br>
                    Haque Chamber(11th floor -D)<br>
                    89/2, West Panthapath,Dhaka<br>
                    Phone:  (+880) 1971424220<br>
                    Email: sales@dadavaai.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Shipping Address
                <address>
                    <strong>{{$order->shipping->name}}</strong><br>
                    {{$order->shipping->address}}<br>
                    {{$order->shipping->town}}, {{$order->shipping->division}}-{{$order->shipping->zipCode}}, {{$order->shipping->country}}<br>
                    Phone: {{$order->shipping->phone}}<br>
                    Email: {{$order->shipping->email}}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Billing Address
                <address>
                    <strong>{{$order->billing->name}}</strong><br>
                    {{$order->billing->address}}<br>
                    {{$order->billing->city}}, {{$order->billing->division}}-{{$order->billing->zipCode}}, {{$order->billing->country}}<br>
                    Phone: {{$order->billing->phone}}<br>
                    Email: {{$order->billing->email}}
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
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>

                    @php
                        $price = $total_price = $cart_subtotal = 0;
                        $shipping = 100;
                        $vatTax = 7.5;
                        $currentTime = \Carbon\Carbon::now()->format('d-m-Y');
                    @endphp

                    @foreach($order->orderDetails as $orderDetail)
                        @php
                            $proPrice = 0;
                            $salePrice = $orderDetail->product->regularPrice;
                            
                            if ($orderDetail->product->discount){
                                if ($orderDetail->product->deal_id && $orderDetail->product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                    $proPrice = $salePrice-(($salePrice*($orderDetail->product->deal->discount_value + $orderDetail->product->discount))/100);
                                
                                else
                                    $proPrice = $salePrice-(($salePrice*$orderDetail->product->discount)/100);
                            }
                            else{
                                if ($orderDetail->product->deal_id && $orderDetail->product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                    $proPrice = $salePrice-(($salePrice*$orderDetail->product->deal->discount_value)/100);
                                else
                                    $proPrice = $orderDetail->product->regularPrice;
                            }

                            if ($orderDetail->product->bundleOffers) {
                                foreach ($orderDetail->product->bundleOffers as  $bundleOffer) {
                                    if ($orderDetail->quantity >= $bundleOffer->qty_start) {
                                        $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                                    }
                                }
                            }

                            $unitPrice = $orderDetail->quantity * $proPrice;
                            $price += $unitPrice;

                        @endphp
                        <tr>
                            <td>{{$orderDetail->quantity}}</td>
                            <td>{{$orderDetail->product->productName}}</td>
                            <td>{{$orderDetail->product->sku}}</td>
                            <td>{{substr(strip_tags($orderDetail->product->shortDescription), 0, 52)}}...</td><td>Tk {{$unitPrice}}
                            </td>
                        </tr>
                    @endforeach
                    {{-- @php
                        if($cart_subtotal > 99 && $cart_subtotal < 501){
                            $shipping = 50;
                        }elseif ($cart_subtotal > 500 && $cart_subtotal < 1001){
                            $shipping = 20;
                        }else{
                            $shipping = 0;
                        }
                    @endphp --}}
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
                    Payment Details:
                </p>
                @if($order->payment->paymentOption == 1)
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Cash On delivery
                    </p>
                @else
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        <b>Paid Amount:</b>Tk {{$order->payment->amount}}<br>
                        <b>Pay from: </b>{{$order->payment->card_type}}<br>
                        <b>Issuer:</b>{{$order->payment->card_issuer}}<br>
                        <b>Account No.:</b> {{$order->payment->accNo}}<br>
                        <b>Transaction ID:</b> {{$order->payment->tran_id}}<br>
                        <b>Bank Transaction ID :</b> {{$order->payment->bank_tran_id}}<br>
                        @if($order->payment->card_no)
                        <b>Card no:</b> {{$order->payment->card_no}}<br>
                        @endif
                    </p>
                @endif
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>Tk {{$price}}</td>
                        </tr>
                        {{-- @if($order->discount_id != null)
                        <tr>
                            <td class="text-left">Discount @if($discount->discount_unit == 0) ({{$discount->discount_value}}%) @endif</td>
                            <td class="text-right">Tk {{number_format($discount_val, 2)}}</td>
                        </tr>
                        @endif --}}
                        <tr>
                            <th>VAT ({{$vatTax}}%)</th>
                            <td>Tk {{$price* ($vatTax/100)}}</td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>Tk {{$shipping}}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>Tk {{$price+( $price * ($vatTax/100) )+$shipping}}</td>
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
