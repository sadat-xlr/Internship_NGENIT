@extends('layouts.client')

@section('title')
    <title>Dadavaai | Client Offers </title>
@endsection

@php
$currentDate = \Carbon\Carbon::now()->format('d-m-Y');
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
                            <span class="current red-clr"> offers </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="theme-container container">
                <div class="gst-spc3 row">

                    @include('client.account.sidebar')
                    <main class="col-lg-8 col-md-6 col-sm-6 blog-wrap">

                        <article class="" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                            <div class="account-details-wrap">
                                <div class="account-box">
                                    <div class="row">
                                        <div class="col-lg-2 col-xs-6 text-center">
                                            <div class="single-product-card mt-30">
                                                <div class="single-product-card-container">
                                                    <div class="single-product-card-header">
                                                        Promo
                                                    </div>
                                                    <div class="single-product-card-body ">
                                                        <h3>{{$promo}}</h3>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xs-6 text-center">
                                            <div class="single-product-card mt-30">
                                                <div class="single-product-card-container">
                                                    <div class="single-product-card-header">
                                                        Clearance
                                                    </div>
                                                    <div class="single-product-card-body ">
                                                        <h3>{{$clearance}}</h3>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xs-6 text-center">
                                            <div class="single-product-card mt-30">
                                                <div class="single-product-card-container">
                                                    <div class="single-product-card-header">
                                                        EMI
                                                    </div>
                                                    <div class="single-product-card-body ">
                                                        <h3>#</h3>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xs-6 text-center">
                                            <div class="single-product-card mt-30">
                                                <div class="single-product-card-container">
                                                    <div class="single-product-card-header">
                                                        Lucky Today
                                                    </div>
                                                    <div class="single-product-card-body ">
                                                        <h3>{{$luckyToday}}</h3>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xs-6 text-center">
                                            <div class="single-product-card mt-30">
                                                <div class="single-product-card-container">
                                                    <div class="single-product-card-header">
                                                        Bundel Offer
                                                    </div>
                                                    <div class="single-product-card-body ">
                                                        <h3>{{$bundleOffer}}</h3>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xs-6 text-center">
                                            <div class="single-product-card mt-30">
                                                <div class="single-product-card-container">
                                                    <div class="single-product-card-header">
                                                        Season
                                                    </div>
                                                    <div class="single-product-card-body ">
                                                        <h3>{{$occasion}}</h3>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xs-6 text-center">
                                            <div class="single-product-card mt-30">
                                                <div class="single-product-card-container">
                                                    <div class="single-product-card-header">
                                                        Deal
                                                    </div>
                                                    <div class="single-product-card-body ">
                                                        <h3>{{$deal}}</h3>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xs-6 text-center">
                                            <div class="single-product-card mt-30">
                                                <div class="single-product-card-container">
                                                    <div class="single-product-card-header">
                                                        Hot Deal
                                                    </div>
                                                    <div class="single-product-card-body ">
                                                        <h3>#</h3>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xs-6 text-center">
                                            <div class="single-product-card mt-30">
                                                <div class="single-product-card-container">
                                                    <div class="single-product-card-header">
                                                        Pre Booking
                                                    </div>
                                                    <div class="single-product-card-body ">
                                                        <h3>{{$preBooking}}</h3>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xs-6 text-center">
                                            <div class="single-product-card mt-30">
                                                <div class="single-product-card-container">
                                                    <div class="single-product-card-header">
                                                        Free
                                                    </div>
                                                    <div class="single-product-card-body ">
                                                        <h3>#</h3>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xs-6 text-center">
                                            <div class="single-product-card mt-30">
                                                <div class="single-product-card-container">
                                                    <div class="single-product-card-header">
                                                        B&G
                                                    </div>
                                                    <div class="single-product-card-body ">
                                                        <h3>{{$b_g }}</h3>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xs-6 text-center">
                                            <div class="single-product-card mt-30">
                                                <div class="single-product-card-container">
                                                    <div class="single-product-card-header">
                                                        Discount
                                                    </div>
                                                    <div class="single-product-card-body ">
                                                        <h3>{{$discount}}</h3>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                            <div class="account-details-wrap">
                                <div class="heading-2">                                
                                    <h3 class="title-3 fsz-18">Offer Name</h3>                            
                                </div>

                                <div class="account-box">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <td>SL. No</td>
                                                <td>Offer Type</td>
                                                <td>Description</td>
                                                <td>Status</td>
                                                <td>Deadline</td>
                                                <td>Comments</td>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Hot Deal</td>
                                                    <td><a href="{{'/offers-deals'}}" target="_blank">See details</a></td>
                                                    <td>Active</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Pre Booking</td>
                                                    <td><a href="{{'pre-launching-product-details/'.$randomPreBooking->id}}" target="_blank">See details</a></td>
                                                    <td>
                                                        @if(date('d-m-Y', strtotime($randomPreBooking->launching_date)) >= $currentDate)
                                                            active
                                                        @else
                                                            inactive
                                                        @endif
                                                    </td>
                                                    <td>{{date('d-m-Y', strtotime($randomPreBooking->launching_date))}}</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>EMI</td>
                                                    <td><a href="#">See details</a></td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>B & G</td>
                                                    <td><a href="{{'/offers-buy-get'}}" target="_blank">See details</a></td>
                                                    <td>Active</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                @if ($randomLuckyToday)
                                                <tr>
                                                    <td>5</td>
                                                    <td>Lucky Today</td>
                                                    <td><a href="#">See details</a></td>
                                                    <td>
                                                        @if($randomLuckyToday->valid_until >= $currentTime)
                                                            Active
                                                        @else
                                                            Inactive

                                                        @endif
                                                    </td>
                                                    <td>{{$randomLuckyToday->valid_until}}</td>
                                                    <td>N/A</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
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