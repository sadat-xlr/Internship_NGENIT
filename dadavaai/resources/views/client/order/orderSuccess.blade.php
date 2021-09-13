@extends('layouts.client')

@section('title')
    <title>Dadavaai | Order complete </title>
@endsection
@php
$currentTime = \Carbon\Carbon::now()->format('d-m-Y');
@endphp
@section('content')
    <!-- CONTENT + SIDEBAR -->
    <div class="main-wrapper clearfix">
        <div class="site-pagetitle jumbotron">
            <div class="container  theme-container">
                <!-- Breadcrumbs -->
                <div class="breadcrumbs">
                    <div class="breadcrumbs">
                        <i class="fa fa-home"></i>
                        <span><a href="{{url('/')}}">Home</a></span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span> Client </span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span class="current"> Order </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container theme-container">
            <div class="col-md-12 alert alert-success">
                <h4>order no: {{$order->id}}</h4>
                <h4>Date:{{$order->created_at}}</h4>
                <p class="text-center">Thank you. Your order has been received.{{$redeem_point}}</p>
            </div>
            <main class="col-md-8 col-sm-8 blog-wrap">
                <article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                    <!-- Main Content of the Post -->
                    <div class="entry-content" itemprop="articleBody">
                        <div class="woocommerce checkout">
                            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="{{url('#')}}" enctype="multipart/form-data">
                                <div id="order_review" class="woocommerce-checkout-review-order ">
                                    <div class="col-lg-12 col-sm-6">
                                        <div class="chck-ttl">
                                            <h4 id="order_review_heading" class="cart-title-highlight title-3">Your order</h4>
                                            <table class="shop_table woocommerce-checkout-review-order-table">
                                                <thead>
                                                    <tr>
                                                        <th class="product-sl fsz-15"> Sl.</th>
                                                        <th class="product-name fsz-15">Product</th>
                                                        <th class="product-price fsz-15">Price</th>
                                                        <th class="fsz-15">qty</th>
                                                        <th class="product-total fsz-15">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $price = 0;
                                                    $shipping = 100;
                                                    $vatTax = 7.5;
                                                @endphp
                                                @foreach($order->orderDetails as $key => $orderdetail)
                                                    @php
                                                        $salePrice = $orderdetail->product->regularPrice;

                                                        if ($orderdetail->product->discount){
                                                            if ($orderdetail->product->deal_id && $orderdetail->product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                $proPrice = $salePrice-(($salePrice*($orderdetail->product->deal->discount_value + $orderdetail->product->discount))/100);
                                                            
                                                            else
                                                                $proPrice = $salePrice-(($salePrice*$orderdetail->product->discount)/100);
                                                        }
                                                        else{
                                                            if ($orderdetail->product->deal_id && $orderdetail->product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                $proPrice = $salePrice-(($salePrice*$orderdetail->product->deal->discount_value)/100);
                                                            else
                                                                $proPrice = $orderdetail->product->regularPrice;
                                                        }

                                                        if ($orderdetail->product->bundleOffers) {
                                                            foreach ($orderdetail->product->bundleOffers as  $bundleOffer) {
                                                                if ($orderdetail->quantity >= $bundleOffer->qty_start) {
                                                                    $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                                                                }
                                                            }
                                                        }

                                                    @endphp
                                                    <tr class="">
                                                        <td class="blk-clr fsz-13" style="padding: 10px;">{{$key+1}}</td>
                                                        <td class="blk-clr fsz-13" style="padding: 10px;">{{$orderdetail->product->productName}}</td>
                                                        <td class="blk-clr fsz-13" style="padding:10px;">Tk {{number_format($proPrice, 2)}}</td><td class="blk-clr" style="padding: 10px;"> {{$orderdetail->quantity}}</td>
                                                        <td class="blk-clr fsz-13" style="padding:10px;">Tk {{number_format($orderdetail->quantity * $proPrice, 2)}}</td>
                                                    </tr>
                                                    @php
                                                        $unitPrice = $orderdetail->quantity * $proPrice;
                                                        $price += $unitPrice;
                                                    @endphp
                                                @endforeach
                                                
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="4">Sub Total:</th>
                                                        <td><b class="blk-clr">Tk {{number_format($price,2)}}</b></td>
                                                    </tr>

                                                    <tr class="cart-discount">
                                                        <th colspan="4">Shipping Charge :</th>
                                                        <td><b class="blk-clr">Tk {{number_format($shipping,2)}}</b></td>
                                                    </tr>
                                                    <tr class="shipping">
                                                        <th colspan="4">VAT :</th>
                                                        <td>
                                                            <b class="blk-clr">Tk {{number_format($price * ($vatTax/100),2)}}</b>
                                                        </td>
                                                    </tr>

                                                    @if($redeem_point)
                                                    <tr class="shipping">
                                                        <th colspan="4">Redeem Point :</th>
                                                        <td>
                                                            <b class="blk-clr">Tk {{number_format($redeem_point,2)}}</b>
                                                        </td>
                                                    </tr>
                                                    @endif

                                                    <tr class="order-total">
                                                        <th colspan="4">Order Total</th>
                                                        <td><b class="amount">Tk {{number_format($price+($price * ($vatTax/100)) + $shipping - $redeem_point,2)}}</b> </td>
                                                    </tr>
                                                </tfoot>
                                            </table> 
                                            {{-- <table class="shop_table woocommerce-checkout-review-order-table">
                                                <thead>
                                                    <tr>
                                                        <th class="product-name">Product &nbsp;&nbsp;&nbsp; x qty</th>
                                                        <th class="product-total">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $price = 0;
                                                    $shipping = 100;
                                                    $vatTax = 7.5;
                                                @endphp
                                                @foreach($order->orderDetails as $orderdetail)
                                                    @php
                                                        $salePrice = $orderdetail->product->regularPrice;
                                                        
                                                        if ($orderdetail->product->discount){
                                                            if ($orderdetail->product->deal_id && $orderdetail->product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                $proPrice = $salePrice-(($salePrice*($orderdetail->product->deal->discount_value + $orderdetail->product->discount))/100);
                                                            
                                                            else
                                                                $proPrice = $salePrice-(($salePrice*$orderdetail->product->discount)/100);
                                                        }
                                                        else{
                                                            if ($orderdetail->product->deal_id && $orderdetail->product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                $proPrice = $salePrice-(($salePrice*$orderdetail->product->deal->discount_value)/100);
                                                            else
                                                                $proPrice = $orderdetail->product->regularPrice;
                                                        }
                                                    @endphp
                                                    <tr class="cart_item">
                                                        <td class="product-name">{{$orderdetail->product->productName}} <strong class="product-quantity">&times; {{$orderdetail->quantity}}</strong></td>
                                                        <td class="product-total"><b class="amount">Tk {{number_format($orderdetail->quantity * $proPrice, 2)}}</b></td>
                                                    </tr>
                                                    @php
                                                        $unitPrice = $orderdetail->quantity * $proPrice;
                                                        $price += $unitPrice;
                                                    @endphp
                                                @endforeach
                                                
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sub Total:</th>
                                                        <td><span class="drk-gry">Tk {{number_format($price,0)}}</span></td>
                                                    </tr>

                                                    <tr class="cart-discount">
                                                        <th>Shipping Charge :</th>
                                                        <td><b class="drk-gry">Tk {{$shipping}}</b></td>
                                                    </tr>
                                                    <tr class="shipping">
                                                        <th>Vat/Tex :</th>
                                                        <td>
                                                            <b class="drk-gry">Tk {{$price * $vatTax/100}}</b>
                                                        </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Order Total</th>
                                                        <td><b class="amount">Tk {{number_format($price+($price * ($vatTax/100)) + $shipping,0)}}</b> </td>
                                                    </tr>
                                                </tfoot>
                                            </table> --}}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Paid Percentage --}}
                        {{-- <div id="payment" class="col-lg-12 col-sm-6 border woocommerce-checkout-payment">
                            <h4 class="cart-title-highlight title-3" style="margin-top: 40px;">Paid Percentage to Total amount</h4>
                            <div class="col-md-8">
                                <div class="form-group selectpicker-wrapper">
                                    <select
                                        class="selectpicker input-price" data-live-search="true" data-width="100%"
                                        data-toggle="tooltip" id="payment_option" name="payment_option" title="Payment Option" disabled>
                                        <option selected>{{$order->payment->paymentOption * 100}} % paid</option>
                                    </select>
                                </div>
                            </div>   
                        </div> --}}
                        <div class="clearfix"></div>
                    </div>
                </article>
            </main>
            <aside class="col-md-4 col-sm-3">
                <div class="main-sidebar" >
                    <div class="widget sidebar-widget widget_categories clearfix">
                        <h6 class="widget-title">Address</h6>
                        <dl>
                            <dt class="complete"> Billing Address <span class="separator">|</span></dt>
                            <dd class="complete">
                                {{-- Client billing address --}}
                                @if ($order->billing)
                                    <table id="saved_billing_address" class="table borderless fsz-13">
                                            <tbody>
                                                <tr class="">
                                                    <td class=" hidden-sm hidden-xs">
                                                        Name
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Address
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->address}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Town
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->town}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Division
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->division}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Country
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->country}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Zip Code
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->zipCode}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Phone
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Email
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->email}}</td>
                                                </tr>            
                                            </tbody>
                                        </table> 
                                    
                                @endif
                            </dd>
                            <dt class="complete"> Shipping Address <span class="separator">|</span></dt>
                            <dd class="complete">

                                {{-- client shipping address --}}
                                @if ($order->shipping)
                                    <table id="saved_shipping_address" class="table borderless fsz-13">
                                            <tbody>
                                                <tr class="">
                                                    <td class=" hidden-sm hidden-xs">
                                                        Name
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Address
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->address}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Town
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->town}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Division
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->division}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Country
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->country}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Zip Code
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->zipCode}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Phone
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Email
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->email}}</td>
                                                </tr>            
                                            </tbody>
                                        </table> 
                                @endif
                            </dd>
                        </dl>    
                    </div>
                </div>
            </aside>  
        </div>
        <div class="clear"></div>
    </div>
@endsection