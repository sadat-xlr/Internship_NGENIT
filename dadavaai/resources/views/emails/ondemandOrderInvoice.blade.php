<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dadavaai | Invoice</title>
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
                        <b>Invoice#{{$order->id}}</b><br>
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
                            <th>Unit #</th>
                            <th>Details</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php 
                        $subtotal= $price = $quotation->price + ($quotation->price *(20/100));
                        $shipping = 100;
                        $vatTax = 7.5;
                    @endphp
                        <tr>
                            <td>{{$quotation->ondemand->qty}}</td>
                            <td>{{$quotation->ondemand->product}}</td>
                            <td>{{$quotation->ondemand->unit}}</td>
                            <td>{{substr(strip_tags($quotation->ondemand->details), 0, 52)}}...</td>
                            <td>Tk {{$price}}</td>
                        </tr>
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
                    {{$order->payment->card_type}}
                    {{$order->payment->card_issuer}}
                </p>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    <b>Account No.:</b> {{$order->payment->accNo}}<br>
                    <b>Transaction ID:</b> {{$order->payment->tran_id}}<br>
                    <b>Bank Transaction ID:</b> {{$order->payment->bank_tran_id}}<br>
                    @if($order->payment->card_no)
                        <b>Card no:</b> {{$order->payment->card_no}}<br>
                    @endif
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>Tk {{$subtotal}}</td>
                        </tr>
                        {{-- @if($order->discount_id != null)
                        <tr>
                            <td class="text-left">Discount @if($discount->discount_unit == 0) ({{$discount->discount_value}}%) @endif</td>
                            <td class="text-right">Tk {{number_format($discount_val, 2)}}</td>
                        </tr>
                        @endif --}}
                        <tr>
                            <th>VAT ({{$vatTax}}%)</th>
                            <td>Tk {{$subtotal * ($vatTax/100)}}</td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>Tk {{$shipping}}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>Tk {{$subtotal+( $subtotal * ($vatTax/100) )+$shipping}}</td>
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
