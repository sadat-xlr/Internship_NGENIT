@extends('layouts.client')

@section('og_property')
    <meta property="og:title" content="{{ $productInformation->product->productName}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:description" content="{{strip_tags($productInformation->product->shortDescription)}}"/>
    <meta property="og:url" content="{{ url('product/'.$productInformation->product->id.'/'.$productInformation->product->slug)}}" />
    <meta property="og:image" content="{{url('storage/images/product/'.$productInformation->product->image->image1)}}"/>
@endsection

@section('title')
    <title>{{$productInformation->product->productName}} | Dadavaai</title>
@endsection
@php
$currentTime = \Carbon\Carbon::now()->format('d-m-Y');

$price = 0;
@endphp
@section('content')
    <!-- CONTENT + SIDEBAR -->
    <div class="main-wrapper clearfix">  
        {{-- <section class="gst-row row-carbon-fiber ovh"> --}}
        <section class="gst-row row-carbon-fiber ovh" style="background-size: cover; background: url('{{asset('storage/images/productInformation/'.$productInformation->image_1)}}') no-repeat;">
            <div class="container theme-container">
                <div class="gst-column col-lg-12 no-padding text-center">
                    <div class="row"> 
                        <div class="col-lg-12 col-sm-12">
                            <div class="row"> 
                                <div class="col-lg-12 col-sm-6">
                                    <p class="gst-compare-actions">
                                        
                                            <span class="fsz-35 blk-clr" style="margin-top: 20px !important;">                                    
                                                {{$productInformation->product->productName}}
                                            </span>
                                    
                                    </p>  
                                    {{-- <div class="">   
                                        @if ($adsProduct3->discount)
                                            @if ($adsProduct3->deal_id && $adsProduct3->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                <span class="thm-clr fsz-19 light-font-3">
                                                    Tk {{number_format($adsProduct3->regularPrice-(($adsProduct3->regularPrice*($adsProduct3->deal->discount_value + $adsProduct3->discount))/100), 2)}}
                                                </span> 
                                                &nbsp;   
                                                <span class="discnt fsz-19 light-font-3"> Tk {{number_format($adsProduct3->regularPrice,2)}} </span>   
                                            @else
                                                <span class="thm-clr fsz-19 light-font-3">
                                                    Tk {{number_format($adsProduct3->regularPrice-(($adsProduct3->regularPrice*$adsProduct3->discount)/100), 2)}}
                                                </span>
                                                &nbsp; 
                                                <span class="discnt fsz-19 light-font-3"> Tk {{number_format($adsProduct3->regularPrice,2)}} </span>
                                            @endif
                                        @else
                                            @if ($adsProduct3->deal_id && $adsProduct3->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                <span class="thm-clr fsz-19 light-font-3"> 
                                                    Tk {{number_format($adsProduct3->regularPrice-(($adsProduct3->regularPrice*$adsProduct3->deal->discount_value)/100), 2)}}
                                                </span>  
                                                &nbsp;   
                                                <span class="discnt fsz-19 light-font-3"> Tk {{number_format($adsProduct3->regularPrice,2)}} </span>   
                                            @else

                                                <span class="thm-clr fsz-19 light-font-3"> Tk {{number_format($adsProduct3->regularPrice,2)}} </span>    
                                            @endif
                                        @endif

                                        <a href="#" class="compare-add-to-cart  red-clr right-link addCart" data-placement="top" data-slug="{{$adsProduct3->slug}}" title="Add To Cart" data-id="{{$adsProduct3->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="compare-add-to-cart left-link addWishlist" href="#" data-placement="top" data-slug="{{$adsProduct3->slug}}" title="Add To Wishlist" data-id="{{$adsProduct3->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>
                                    </div> --}}
                                    <a href="{{url('product/'.$productInformation->product->id.'/'.$productInformation->product->slug)}}" class="fancy-btn fancy-btn-small">Shop Now</a>
                                    
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-lg-8 col-sm-8 col-lg-offset-2">
                                    <img class="" src="{{asset('storage/images/product/'.$productInformation->product->image->image1)}}" alt="{{$productInformation->product->productName}}" height="500px" width="600px" />               
                                </div>

                            </div>
                        </div>
                    </div>
                            
                </div>
            </div>
        </section>

        <!-- section 2-->
        <section class="gst-row row-arrivals woocommerce ovh">
            <div class="container theme-container">
                <div class="gst-column col-lg-12 no-padding text-center">
                    <div class="theme-container container" style="width: 970px !important; padding-left: 0; padding-right: 0;">
                        <div class="row text-center">
                            @foreach ($relatedProducts->take(3) as $relatedProduct)
                                <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">                                    
                                    <div class="product">
                                        <div>
                                            <img src="{{url('storage/images/product/'.$relatedProduct->image->image1)}}" alt="" />                                                 
                                        </div>
                                        <div class="product-content text-center">
                                            <a class="" href="{{url('product/'.$relatedProduct->id.'/'.$relatedProduct->slug)}}" class="fsz-11"> 
                                                <span class="" style="font-size:11px;!important">{{$relatedProduct->productName}}</span> 
                                            </a>
                                            <p class="font-3">
                                                @if ($relatedProduct->discount)
                                                    @if ($relatedProduct->deal_id && $relatedProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        <span class="thm-clr">
                                                            Tk {{number_format($relatedProduct->regularPrice-(($relatedProduct->regularPrice*($relatedProduct->deal->discount_value + $relatedProduct->discount))/100), 2)}}
                                                        </span>    
                                                        <span class="thm-clr line-through"> Tk {{$relatedProduct->regularPrice}}</span>   
                                                    @else
                                                        <span class="thm-clr">
                                                            Tk {{number_format($relatedProduct->regularPrice-(($relatedProduct->regularPrice*$relatedProduct->discount)/100), 2)}}
                                                        </span>
                                                        <span class="thm-clr line-through"> Tk {{$relatedProduct->regularPrice}}</span>
                                                    @endif
                                                @else
                                                    @if ($relatedProduct->deal_id && $relatedProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        <span class="thm-clr"> 
                                                            Tk {{number_format($relatedProduct->regularPrice-(($relatedProduct->regularPrice*$relatedProduct->deal->discount_value)/100), 2)}}
                                                        </span>    
                                                        <span class="thm-clr line-through"> Tk {{$relatedProduct->regularPrice}}</span>   
                                                    @else
                                                        <span class="thm-clr"> Tk {{$relatedProduct->regularPrice}}</span>    
                                                    @endif
                                                @endif
                                            </p>    
                                        </div>
                                    </div>
                                    
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / section END -->


        <!-- section 3 -->
        <section class="gst-row wht-clr gst-cta row-cta ovh" style=" background-size: cover; background: url('{{asset('storage/images/productInformation/'.$productInformation->image_2)}}') no-repeat;">
            <div class="container theme-container">
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        
                    </div>

                    <div class="col-md-5 col-sm-12 col-xs-12 text-right gst-cta-buttons">
                        {!! $productInformation->description_1 !!}
                    </div>
                </div>
            </div>
        </section>   

        <!-- section 4 -->            
        <section class="" style="padding: 20px;">
            <div class="row" style="background: #f0f0f0;">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 blk-clr" >
                    
                    {!! $productInformation->description_3 !!}
                    
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
                    
                    <img class="right" src="{{asset('storage/images/productInformation/'.$productInformation->image_3)}}" alt="{{$productInformation->product->productName}}" /> 

                </div>
            </div>
            <div class="row mt-20 text-center">
                <div class="col-lg-12  col-md-12 col-sm-12">
                    <a href="#">
                        <span class="fsz-25  red-clr" style="margin-top: unset;">                                    
                            <a  href="{{url('product/'.$productInformation->product->id.'/'.$productInformation->product->slug)}}" class="fancy-btn fancy-btn-small "> Shop Now </a>
                        </span>
                    </a>
                </div>
            </div>

        </section>

        <!-- section review-->
        @if (count($productInformation->product->reviews)>0 )
            <section class="gst-row row-arrivals woocommerce ovh">
                <div class="container theme-container">
                    <div class="gst-column col-lg-12 no-padding text-center">
                        <div class="theme-container container" style="width: 970px !important; padding-left: 0; padding-right: 0;">
                            <div class="row">
                            <div class="col-xs-12">
                                <h1 class="text-center blk-clr">The Happy Client Says</h1>
                            </div>
                            </div>

                            
                            <div class="row text-center">
                                @foreach ($productInformation->product->reviews->take(3) as $review)
                                    <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12" style="border-right:  1px solid #dfdfdf">                                                
                                        <img src="{{asset('client/img/extra/icon-quote.png')}}" height="20px" width="20px">
                                        <p>{{$review->review}}</p>

                                        <div class="star-rating " data-test-info-type="productRating">
                                            @if($review->rating == 1)

                                                <div class="review-block-rate">
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                </div>

                                            @elseif($review->rating == 2)
                                                <div class="review-block-rate">
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                </div>

                                            @elseif($review->rating == 3)
                                                <div class="review-block-rate">
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                </div>

                                            @elseif($review->rating == 4)
                                                <div class="review-block-rate">
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                </div>

                                            @elseif($review->rating == 5)
                                                <div class="review-block-rate">
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                </div>

                                            @else
                                                <div class="review-block-rate">
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                    </button>
                                                </div>

                                            @endif
                                        </div>
                                    </div>
                                        
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- / section END -->
        @endif
        
        <!-- section 5 -->
        <section class="gst-row wht-clr gst-cta row-cta ovh">
            <div class="container theme-container">
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <h2>Found your <span class="thm-clr extbold-font-4">Dream Bike</span>? Why wait</h2>
                        <p class="gry-clr fsz-16">Get it now with a 0% finance deal from Dadavaai Fashion..</p>
                    </div>

                    <div class="col-md-5 col-sm-12 col-xs-12 text-right gst-cta-buttons">
                        <a href="{{url('all-categories')}}" class="fancy-btn-alt fancy-btn-small">Discover</a>
                        <a href="{{url('all-categories')}}" class="fancy-btn fancy-btn-small">Purchase</a>
                    </div>
                </div>
            </div>
        </section>


    </div>
@endsection


