<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dadavaai | Invoice(Office copy)</title>
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
                        <b>Date: {{$preorder->created_at}}</b> <br>
                        <b>Invoice # DVPO{{$preorder->id}}</b><br>
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
                    <strong>{{$preorder->client->shipping->name}}</strong><br>
                    {{$preorder->client->shipping->address}}<br>
                    {{$preorder->client->shipping->town}}, {{$preorder->client->shipping->division}}-{{$preorder->client->shipping->zipCode}}, {{$preorder->client->shipping->country}}<br>
                    Phone: {{$preorder->client->shipping->phone}}<br>
                    Email: {{$preorder->client->shipping->email}}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Billing Address
                <address>
                    <strong>{{$preorder->client->billing->name}}</strong><br>
                    {{$preorder->client->billing->address}}<br>
                    {{$preorder->client->billing->city}}, {{$preorder->client->billing->division}}-{{$preorder->client->billing->zipCode}}, {{$preorder->client->billing->country}}<br>
                    Phone: {{$preorder->client->billing->phone}}<br>
                    Email: {{$preorder->client->billing->email}}
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
                            <th>Product</th>
                            <th>SKU</th>
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

                        $product = $prebook->product;
                        $salePrice = $product->regularPrice;

                        if ($product->discount){
                            if ($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                $proPrice = $salePrice-(($salePrice*($product->deal->discount_value + $product->discount))/100);
                            
                            else
                                $proPrice = $salePrice-(($salePrice*$product->discount)/100);
                        }
                        else{
                            if ($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                $proPrice = $salePrice-(($salePrice*$product->deal->discount_value)/100);
                            else
                                $proPrice = $product->regularPrice;
                        }
                    @endphp

                    
                        <tr>
                            <td >{{$product->productName}}</td>
                            
                            <td>{{$product->sku}}</td>
                            <td>{{substr(strip_tags($product->shortDescription), 0, 52)}}...</td>
                            <td ><b class="amount">Tk {{number_format($proPrice, 2)}}</b></td>
                        </tr>
                        @php
                            $unitPrice = $proPrice;
                            $price += $unitPrice;
                            $discount = $prebook->prebook_discount;
                        @endphp

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
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    <b>Paid Amount:</b>Tk {{$preorder->payment->amount}}<br>
                    <b>Pay from: </b>{{$preorder->payment->card_type}}<br>
                    <b>Issuer:</b>{{$preorder->payment->card_issuer}}<br>
                    <b>Account No.:</b> {{$preorder->payment->accNo}}<br>
                    <b>Transaction ID:</b> {{$preorder->payment->tran_id}}<br>
                    <b>Bank Transaction ID :</b> {{$preorder->payment->bank_tran_id}}<br>
                    @if($preorder->payment->card_no)
                    <b>Card no:</b> {{$preorder->payment->card_no}}<br>
                    @endif
                </p>
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
                        @if($discount != null)
                        <tr>
                            <td>Discount</td>
                            <td>Tk {{number_format($discount, 2)}}</td>
                        </tr>
                        @endif
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
                            <td>Tk {{$preorder->totalAmount}}</td>
                        </tr>
                        <tr>
                            <th>Due:</th>
                            <td>Tk {{number_format(($preorder->totalAmount)-$preorder->payment->amount)}}</td>
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
