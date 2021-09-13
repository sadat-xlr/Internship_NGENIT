@extends('layouts.client')

@section('title')
    <title>Dadavaai | Client Dashboard </title>
@endsection

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
                            <span class="current red-clr"> Dashboard </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="theme-container container">
                <div class="gst-spc3 row">

                    @include('client.account.sidebar')

                    <main class="col-md-9 col-sm-8 blog-wrap">
                        <article class="" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                            <div class="account-details-wrap">
                                <div class="heading-2"><h3 class="title-3 fsz-15">Welcome, {{$client->clientName}}</h3></div>                                
                                <div class="account-box">
                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-2 col-xs-6 text-center" style=" margin: 10px; border: #999 1px solid; border-radius: 5px;">
                                        <!-- small box -->
                                        <div class="small-box bg-aqua">
                                            <div class="inner">
                                            @if ($client->order)
                                                <h3><a href="{{url('/client-order-history')}}">({{count($client->order)}})</a></h3>
                                            @else
                                                <h3><a href="{{url('/client-order-history')}}">(0)</a></h3>
                                            @endif

                                            <p>Total Orders</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-xs-6 text-center" style=" margin: 10px; border: #999 1px solid; border-radius: 5px;">
                                        <!-- small box -->
                                        <div class="small-box bg-aqua">
                                            <div class="inner">
                                            @if ($client->wishlists)
                                                <h3><a href="{{url('/wishlist')}}">({{count($client->wishlists)}})</a></h3>
                                            @else
                                                <h3><a href="{{url('/wishlist')}}">(0)</a></h3>
                                            @endif


                                            <p>Wish List</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-xs-6 text-center" style=" margin: 10px; border: #999 1px solid; border-radius: 5px;">
                                        <!-- small box -->
                                        <div class="small-box bg-aqua">
                                            <div class="inner">
                                            @if ($client->ondemands)
                                                <h3><a href="{{url('/client-ondemand-history')}}">({{count($client->ondemands)}})</a></h3>
                                            @else
                                                <h3><a href="{{url('/client-ondemand-history')}}">(0)</a></h3>
                                            @endif


                                            <p>Ondemand</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-xs-6 text-center" style=" margin: 10px; border: #999 1px solid; border-radius: 5px;">
                                        <!-- small box -->
                                        <div class="small-box bg-aqua">
                                            <div class="inner">
                                            @if (1 != 1)
                                                <h3><a href="#">(0)</a></h3>
                                            @else
                                                <h3><a href="#">(0)</a></h3>
                                            @endif


                                            <p>Credit Point (0)</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-6 text-center">
                                        <div class="single-product-card mt-30">
                                            <div class="single-product-card-container">
                                                <div class="single-product-card-header">
                                                    My Order
                                                </div>
                                                <div class="single-product-card-body pt-20">
                                                    <ul style="text-align: justify;">
                                                        <li>
                                                            <a href="{{url('/client-order-history')}}">Order History</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{url('/client-ondemand-history')}}">Rfqs</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{url('/client-preorder-history')}}">Pre Book History</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-6 text-center">
                                        <div class="single-product-card mt-30">
                                            <div class="single-product-card-container">
                                                <div class="single-product-card-header">
                                                    My Offer
                                                </div>
                                                <div class="single-product-card-body pt-20">
                                                    <ul style="text-align: justify;">
                                                        <li>
                                                            <a href="#"># Premium Offers</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"># PROMO Codes</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"># Free Offers</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-6 text-center">
                                        <div class="single-product-card mt-30">
                                            <div class="single-product-card-container">
                                                <div class="single-product-card-header">
                                                    My Delivery
                                                </div>
                                                <div class="single-product-card-body pt-20">
                                                    <ul style="text-align: justify;">
                                                        <li>
                                                            <a href="{{url('/order-track')}}" target="_blank">Track order</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"># Return My Order</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{'/client-order-delivery-history'}}">Delivery Details</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-6 text-center">
                                        <div class="single-product-card mt-30">
                                            <div class="single-product-card-container">
                                                <div class="single-product-card-header">
                                                    My Product
                                                </div>
                                                <div class="single-product-card-body pt-20">
                                                    <ul style="text-align: justify;">
                                                        <li>
                                                            <a href="{{url('/wishlist')}}">Wistlist</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"># Love list</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"># Save cart</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-6 text-center">
                                        <div class="single-product-card mt-30">
                                            <div class="single-product-card-container">
                                                <div class="single-product-card-header">
                                                    My Payment
                                                </div>
                                                <div class="single-product-card-body pt-20">
                                                    <ul style="text-align: justify;">
                                                        <li>
                                                            <a href="{{'/client-order-payment-history'}}"> Pending Payments</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"># Payment Receipts</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{'/client-order-payment-history'}}">Payment History</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-6 text-center">
                                        <div class="single-product-card mt-30">
                                            <div class="single-product-card-container">
                                                <div class="single-product-card-header">
                                                    My Point
                                                </div>
                                                <div class="single-product-card-body pt-20">
                                                    <ul style="text-align: justify;">
                                                        <li>
                                                            <a href="{{'/my-point'}}"> Gained Point</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"># Reedem Point</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"># Surprising Points</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>


                                </div>

                                {{-- <div class="heading-2"> <h3 class="title-3 fsz-18">order and review</h3> </div>
                                <div class="account-box">
                                    <ul>
                                        <li>
                                            <a href="{{url('client-order-history')}}">View your order history</a>
                                        </li>
                                        
                                    </ul>
                                </div> --}}
                                <br><br>

                                <div class="heading-2"> <h3 class="title-3 fsz-18">Newsletter</h3> </div>
                                <div class="account-box">
                                    <ul>
                                        <li>
                                            <a href="{{url('unsubscribe?email='.$client->email)}}">Subscribe / unsubscribe to newsletter</a>
                                        </li>                                           
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </main>  

                </div>
            </div>

            <div class="clear"></div>
        </div>
        <!-- / CONTENT + SIDEBAR -->
@endsection