@extends('layouts.client')

@section('title')
    <title>Dadavaai | Ondemand Order complete </title>
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
                <p class="text-center">Thank you. Your order has been received.</p>
            </div>
            <main class="col-md-8 col-sm-8 blog-wrap">
                <article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                    <!-- Main Content of the Post -->
                    <div class="entry-content" itemprop="articleBody">
                        <div class="woocommerce checkout">
                            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="{{url('#')}}" enctype="multipart/form-data">
                                <div id="order_review" class="woocommerce-checkout-review-order ">
                                    <div class="col-lg-12 col-sm-6 border">
                                        <div class="chck-ttl">
                                            <h4 id="order_review_heading" class="cart-title-highlight title-3">Your order</h4>
                                            <table class="shop_table woocommerce-checkout-review-order-table">
                                                <thead>
                                                    <tr>
                                                        <th class="product-name">Product &nbsp;&nbsp;&nbsp; x qty</th>
                                                        <th class="product-total">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $price = $quotation->price + ($quotation->price *(20/100));
                                                    $shipping = 100;
                                                    $vatTax = 7.5;
                                                @endphp
                                                    <tr class="cart_item">
                                                        <td class="product-name">{{$quotation->ondemand->product}} <strong class="product-quantity">&times; {{$quotation->ondemand->qty}}</strong></td>
                                                        <td class="product-total"><b class="amount">Tk {{number_format($price, 2)}}</b></td>
                                                    </tr>
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
                                                        <th>VAT :</th>
                                                        <td>
                                                            <b class="drk-gry">Tk {{$price * $vatTax/100}}</b>
                                                        </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Order Total</th>
                                                        <td><b class="amount">Tk {{number_format($price+($price * ($vatTax/100)) + $shipping,0)}}</b> </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                                    <address>
                                    Name: {{$order->billing->name}}<br>
                                    Address: {{$order->billing->address}}<br>
                                    Town: {{$order->billing->town}}<br>
                                    Division: {{$order->billing->division}}<br>
                                    Country: {{$order->billing->country}}<br>
                                    Zip Code: {{$order->billing->zipCode}}<br>
                                    Phone: {{$order->billing->phone}}<br>
                                    Email: {{$order->billing->email}}
                                    </address>
                                    
                                @endif
                            </dd>
                            <dt class="complete"> Shipping Address <span class="separator">|</span></dt>
                            <dd class="complete">

                                {{-- client shipping address --}}
                                @if ($order->shipping)
                                    <address>
                                    Name: {{$order->shipping->name}}<br>
                                    Address: {{$order->shipping->address}}<br>
                                    Town: {{$order->shipping->town}}<br>
                                    Division: {{$order->shipping->division}}<br>
                                    Country: {{$order->shipping->country}}<br>
                                    Zip Code: {{$order->shipping->zipCode}}<br>
                                    Phone: {{$order->shipping->phone}}<br>
                                    Email: {{$order->shipping->email}}
                                    </address>
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