@extends('layouts.client')

@section('og_property')
    <meta property="og:title" content="{{ $prebook->product->productName}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:description" content="{{strip_tags($prebook->details)}}"/>
    <meta property="og:url" content="{{url('pre-launching-product-details/'.$prebook->id)}}" />
    <meta property="og:image" content="{{url('storage/images/product/'.$prebook->product->image->image1)}}"/>
@endsection

@section('title')
    <title>Pre-launching book product </title>
@endsection
@php
$currentTime = \Carbon\Carbon::now()->format('d-m-Y');

$price = 0;

//Rating                                                            
$summation = 0;
$i = 0;
$average = 0;


if(count($prebook->product->reviews)>0)
{
    foreach ($prebook->product->reviews as $reviewAverage) {
        $summation = $summation + $reviewAverage->rating;
        $i++;
    }; 

    $average = number_format($summation/$i, 0);
}

@endphp
@section('content')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=196929838191386"></script>
    <!-- CONTENT + SIDEBAR -->
    <div class="main-wrapper clearfix">
        <div class="site-pagetitle jumbotron" style="margin-bottom: 10px;">
            <div class="container text-center">
                <!-- Breadcrumbs -->
                <div class="breadcrumbs">
                    <div class="breadcrumbs text-left">
                        <i class="fa fa-home"></i>
                        <span><a href="{{url('/')}}">Home</a></span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span><a href="{{url('#')}}">Pre-launching Product</a></span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span class="current red-clr">{{$prebook->product->productName}}</span>
                    </div>
                </div>
            </div>
        </div>

        <div id="productCart">
            
            <main id="main-content" class="main-content container"> 
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product has-post-thumbnail product-type-variable">
                            {{-- product details --}}
                            <div class="row">
                                {{-- product image --}}
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="picZoomer">
                                        <img src="{{url('storage/images/product/'.$prebook->product->image->image1)}}" height="420" width="420" alt="">
                                    </div>
                                    <ul class="piclist">
                                        <li><img src="{{url('storage/images/product/'.$prebook->product->image->image1)}}" alt=""></li>
                                        <li><img src="{{url('storage/images/product/'.$prebook->product->image->image2)}}" alt=""></li>
                                        <li><img src="{{url('storage/images/product/'.$prebook->product->image->image3)}}" alt=""></li>
                                        <li><img src="{{url('storage/images/product/'.$prebook->product->image->image4)}}" alt=""></li>
                                        <li><img src="{{url('storage/images/product/'.$prebook->product->image->image5)}}" alt=""></li>

                                    </ul>
                                </div>

                                <div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
                                    <form id="addProductToCart" action="#" class="" method="post">
                                        <div class="summary entry-summary">
                                            {{-- name & price --}}
                                            <div class="product_title_wrapper">
                                                <div itemprop="name" class="product_title entry-title">
                                                    <span class="fsz-14">{{$prebook->product->productName}}</span>
                                                    <p class=" fsz-14 no-mrgn price" style="width: 28% !important;">
                                                    @if ($prebook->product->discount)
                                                        @if ($prebook->product->deal_id && $prebook->product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            <span class="thm-clr"> Tk {{number_format($prebook->product->regularPrice-(($prebook->product->regularPrice*($prebook->product->deal->discount_value + $prebook->product->discount))/100), 2)}}</span>    
                                                            <span class="thm-clr line-through"> Tk {{$prebook->product->regularPrice}}</span>  
                                                            @php
                                                                $price = $prebook->product->regularPrice-(($prebook->product->regularPrice*($prebook->product->deal->discount_value + $prebook->product->discount))/100);
                                                            @endphp 
                                                        @else
                                                            <span class="thm-clr"> Tk {{number_format($prebook->product->regularPrice-(($prebook->product->regularPrice*$prebook->product->discount)/100), 2)}}</span>
                                                            <span class="thm-clr line-through"> Tk {{$prebook->product->regularPrice}}</span>   
                                                            @php
                                                                $price = $prebook->product->regularPrice-(($prebook->product->regularPrice*$prebook->product->discount)/100);
                                                            @endphp     
                                                        @endif
                                                    @else
                                                        @if ($prebook->product->deal_id && $prebook->product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            <span class="thm-clr"> Tk {{number_format($prebook->product->regularPrice-(($prebook->product->regularPrice*$prebook->product->deal->discount_value)/100), 2)}}</span>    
                                                            <span class="thm-clr line-through"> Tk {{$prebook->product->regularPrice}}</span>  
                                                            @php
                                                                $price = $prebook->product->regularPrice-(($prebook->product->regularPrice*$prebook->product->deal->discount_value)/100);
                                                            @endphp 
                                                        @else
                                                            <span class="thm-clr"> Tk {{$prebook->product->regularPrice}}</span> 
                                                            @php
                                                                $price = $prebook->product->regularPrice;
                                                            @endphp   
                                                        @endif
                                                    @endif  
                                                    </p>       
                                                </div>
                                            </div>
            
                                            <div class="col-lg-12 col-md-6 col-sm-6">
                                                <ul class="list-items fsz-12">
                                                    <li> 
                                                        <strong> Brand : <span class="blk-clr"> {{$prebook->product->brand->brandName}} </span> </strong> 
                                                    </li>
                                                    <li> 
                                                        <strong>  Category : <span class="blk-clr"> {{$prebook->product->category->categoryName}} </span> </strong> 
                                                    </li >
                                                    <li class="right">
                                                        <div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope="">
                                                            <a  href="#review-popup" data-toggle="modal">
                                                                <div class="rating"> 
                                                                    
                                                                    @if($average == 1)
                                                                        <span class="star active"></span>
                                                                        <span class="star "></span>
                                                                        <span class="star "></span>                                           
                                                                        <span class="star "></span>
                                                                        <span class="star "></span>
                                                                    @elseif($average == 2)
                                                                        <span class="star active"></span>
                                                                        <span class="star active"></span>
                                                                        <span class="star "></span>                                           
                                                                        <span class="star "></span>
                                                                        <span class="star "></span>
                                                                    @elseif($average == 3)
                                                                        <span class="star active"></span>
                                                                        <span class="star active"></span>
                                                                        <span class="star active"></span>                                           
                                                                        <span class="star "></span>
                                                                        <span class="star "></span>
                                                                    @elseif($average == 4)
                                                                        <span class="star active"></span>
                                                                        <span class="star active"></span>
                                                                        <span class="star active"></span>                                           
                                                                        <span class="star active"></span>
                                                                        <span class="star "></span>
                                                                    @elseif($average == 5)
                                                                        <span class="star active"></span>
                                                                        <span class="star active"></span>
                                                                        <span class="star active"></span>                                           
                                                                        <span class="star active"></span>
                                                                        <span class="star active"></span>
                                                                    @else
                                                                        <span class="star red-clr"></span>
                                                                        <span class="star "></span>
                                                                        <span class="star "></span>                                           
                                                                        <span class="star "></span>
                                                                        <span class="star "></span>
                                                                    @endif
                                                                </div>
                                                            </a>
                                                        </div>
                                                        
                                                    </li>
                                                </ul>

                                                <hr>

                                                <div class="text-justify blk-clr" style="font-size: 12px !important;">
                                                    {!! $prebook->product->shortDescription !!}
                                                </div>

                                                {{-- <div class="col-lg-12 col-md-6 col-sm-6 mt-20">
                                                    @if(count($prebook->product->bundleOffers))
                                                        <table id="bundle_offer" class="table mt-4" style="border:#f2f2f2 1px solid">
                                                            <thead>
                                                                <tr>
                                                                    <td class="fsz-12 text-center">select</td>
                                                                    <td class="fsz-12"> qty</td>
                                                                    <td class="fsz-12">discount</td>
                                                                    <td class="fsz-12">unit price</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($prebook->product->bundleOffers as $bundleOffer)
                                                                    <tr class="" data-qty_start="{{$bundleOffer->qty_start}}">
                                                                        <td>
                                                                            <input type="radio" id="volume_{{$bundleOffer->qty_start}}" name="volume" id="" style="margin-left: 38px;">
                                                                        </td>
                                                                        <td class="fsz-12">
                                                                            {{$bundleOffer->qty_start}} - {{$bundleOffer->qty_end}}
                                                                        </td>
                                                                        <td class="fsz-12">                                                    
                                                                            <span class="amount text-center"> {{$bundleOffer->discount}}%</span> 
                                                                        </td>
                                                                        <td class="fsz-12">
                                                                            <span class="amount text-center"> Tk {{ number_format($price-($price*$bundleOffer->discount/100), 2) }}</span> 
                                                                        </td>
                                                                    </tr>                                                
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                </div> --}}
                                                <br>
                                                <div>
                                                    <a href="#"> Tk {{number_format($prebook->product->regularPrice,0)}}</a>
                                                    <a href="#" class="right"> Save {{number_format(( $prebook->prebook_discount*100/$prebook->product->regularPrice) ,1)}}%</a>
                                                    <hr style="padding: unset; margin:unset;border-top: 5px solid #04b44d;">
                                                </div>
                                                <div class="">
                                                    <span class="left">
                                                        @if (\Carbon\Carbon::parse($prebook->launching_date)->diffInDays() > 90 )
                                                        @php
                                                            $randomNumber = rand(20,39);
                                                        @endphp
                                                        {{$randomNumber}}% Booked
                                                        
                                                    @elseif(\Carbon\Carbon::parse($prebook->launching_date)->diffInDays() > 45 && \Carbon\Carbon::parse($prebook->launching_date)->diffInDays()< 90)
                                                        @php
                                                            
                                                            $randomNumber = rand(40,59);
                                                        @endphp
                                                        {{$randomNumber}}% Booked
                                                    @elseif(\Carbon\Carbon::parse($prebook->launching_date)->diffInDays() > 30 && \Carbon\Carbon::parse($prebook->launching_date)->diffInDays() < 45)
                                                        @php
                                                            $randomNumber = rand(60,69);
                                                        @endphp
                                                        {{$randomNumber}}% Booked
                                                    @elseif(\Carbon\Carbon::parse($prebook->launching_date)->diffInDays() > 10 && \Carbon\Carbon::parse($prebook->launching_date)->diffInDays() < 30)
                                                        @php
                                                            $randomNumber = rand(70,79);
                                                        @endphp
                                                        {{$randomNumber}}% Booked
                                                    @else
                                                        @php
                                                            $randomNumber = rand(90,99);
                                                        @endphp
                                                        {{$randomNumber}}% Booked
                                                    @endif
                                                    
                                                    
                                                    </span>
                                                    <span class="right">
                                                        {{ \Carbon\Carbon::parse($prebook->launching_date)->diffForhumans() }}
                                                    </span>
                                                    
                                                </div>

                                                <br><br>


                                                <div class="col-lg-12 col-md-6 col-sm-12 mt-20" style="display: inline-flex!important;">
                                                    
                                                    <a href="{{url('prebook-form/'.$prebook->id)}}" class="compare left-link red-clr" title="" style="border: solid 1px #d6d6d3; padding:8px 10px 8px 10px;  background: #f9f9f9; font-size: 14px;">Book</a>
                                                    &nbsp;
                                                    <a href="#" class="left-link addWishlist red-clr" data-placement="top" data-slug="{{$prebook->product->slug}}" title="Add To Wishlist" data-id="{{$prebook->product->id}}" data-url="{{url('/add-to-wishlist')}}" style="border: solid 1px #d6d6d3; padding:8px 10px 8px 10px;  background: #f9f9f9; font-size: 14px;">wishlist</a>

                                                    &nbsp;
                                                    <div class="fb-like right" data-href="{{url('product/'.$prebook->product->id.'/'.$prebook->product->slug)}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true" style="margin: auto; margin-left: 166px!important; "></div> 
                                                    
                                                    
                                                </div>
                                        
                                            </div>
                                            {{-- <div class="col-lg-4 col-md-6 col-sm-6" style="border-left:#f2f2f2 1px solid">
                                                <div class="col-lg-12 col-md-6 col-sm-6 mt-20 mr-4">
                                                    <div class="row">
                                                        
                                            
                                                        <div class="col-lg-12 col-md-12 col-sm-12" >
                                                            <div class="form-group" style="margin-right: 10px;">
                                                                <button type="submit"  class="single_add_to_cart_button button alt fancy-button right"  title="Add To Cart">Add to cart</button>
                                                            </div>    
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div> --}}
                                            
                                        </div><!-- .summary -->
                                    </form>
                                </div>
                            </div>
                            <div>
                                <br>
                            </div>
                            {{-- product description, specification, short description  --}}
                            <div class="row">
                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 mb-10" style="border:solid 1px #ddd;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-20">
                                        <div>
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Prebook overview</a></li>
                                                <li role="presentation" ><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
                                                <li role="presentation"><a href="#specification" aria-controls="specification" role="tab" data-toggle="tab">Specification</a></li>
                                            </ul>
                                        </div>
                                        {{-- Tab panes  --}}
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="description">
                                                <div class="site-tab">
                                                    <div class="text-justify blk-clr">
                                                        {!! $prebook->details !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane active" id="description">
                                                <div class="site-tab">
                                                    <div class="text-justify blk-clr">
                                                        {!! $prebook->product->description !!}
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div role="tabpanel" class="tab-pane" id="specification">
                                                <div class="site-tab">
                                                    <div class="text-justify blk-clr">
                                                        {!! $prebook->product->specification !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 mb-10 mt-20">
                                    <div class="heading-2" style="padding-bottom: 5px;"> <h3 class="title-3 fsz-15">Offer</h3> </div> 
                                    @if ($deal)
                                        <div class="widget sidebar-widget" style="border: #cbbbbb 1px solid">
                                            @foreach ($deal->products->take(1) as $dealProduct)
                                                <a href="{{url('product/'.$dealProduct->id.'/'.$dealProduct->slug)}}">
                                                    <div class="icon-sale-label" style="position: relative;">
                                                        Get {{$deal->discount_value}}% on Tk {{number_format($dealProduct->regularPrice, 2)}}
                                                    </div>
                                                    <img src="{{asset('storage/images/product/'.$dealProduct->image->image1)}}" alt="" style="padding:0px; height:230px; width: 250px;"/>
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="widget sidebar-widget">
                                            <div class="text-box">
                                                <h2 class="title-3 fsz-14 blklt-clr"> FREE SHIPPING. FREE RETURN. </h2>
                                                <h2 class="sec-title fsz-20 blklt-clr"> ALL THE TIME </h2>
                                            </div>
                                        </div>
                                    @endif 
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                {{-- related-product --}}
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="heading-2" style="padding-bottom: unset;"> <h3 class="title-3 fsz-15">RELATED PRODUCTS</h3> </div> 
                        <div class="owl-carousel-related-product">
                            @foreach ($relatedProducts as $relatedProduct)
                                <div class="product">
                                    <div>
                                        <img src="{{url('storage/images/product/'.$relatedProduct->image->image1)}}" alt="" />                                                 
                                    </div>
                                    <div class="product-content text-center">
                                        <a class="" href="{{url('product/'.$relatedProduct->id.'/'.$relatedProduct->slug)}}" class="fsz-12"> 
                                            <span class="" style="font-size:12px;!important">{{substr($relatedProduct->productName, 0, 26)}}</span> 
                                        </a>
                                        <p class="font-3 fsz-13">
                                            @if ($relatedProduct->discount)
                                                @if ($relatedProduct->deal_id && $relatedProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                    <span class="thm-clr">
                                                        Tk {{number_format($relatedProduct->regularPrice-(($relatedProduct->regularPrice*($relatedProduct->deal->discount_value + $relatedProduct->discount))/100), 2)}}
                                                    </span>    
                                                    <span class="thm-clr line-through"> Tk {{number_format( $relatedProduct->regularPrice)}}</span>   
                                                @else
                                                    <span class="thm-clr">
                                                        Tk {{number_format($relatedProduct->regularPrice-(($relatedProduct->regularPrice*$relatedProduct->discount)/100), 2)}}
                                                    </span>
                                                    <span class="thm-clr line-through"> Tk {{number_format($relatedProduct->regularPrice)}}</span>
                                                @endif
                                            @else
                                                @if ($relatedProduct->deal_id && $relatedProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                    <span class="thm-clr"> 
                                                        Tk {{number_format($relatedProduct->regularPrice-(($relatedProduct->regularPrice*$relatedProduct->deal->discount_value)/100), 2)}}
                                                    </span>    
                                                    <span class="thm-clr line-through"> Tk {{number_format($relatedProduct->regularPrice)}}</span>   
                                                @else
                                                    <span class="thm-clr"> Tk {{number_format($relatedProduct->regularPrice,2)}}</span>    
                                                @endif
                                            @endif
                                        </p>    
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <br>                    
            </main>
            <br><br>
        </div>        
    </div>
    <!-- Popup: revie  -->
    <div class="modal fade login-popup" id="review-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">                
            <button type="button" class="close close-btn popup-cls" data-dismiss="modal" aria-label="Close"> <i class="fa-times fa"></i> </button>

            <div class="modal-content">   
                <div class="login-wrap text-center">                        
                    <div id="review-block" class="row" style="margin-top:40px;">
                        <div class="col-lg-7 col-md-8">
                            <div class="well well-sm">
                                <div class="row" id="post-review-box">
                                    <div class="col-md-12">
                                        <form class="form" id="review-form" action="#" method="post">
                                            <div class="form-group">
                                                <input class="form-control" id="product_id-hidden" name="product_id" type="hidden" value="{{$prebook->product->id}}">
                                                <input class="form-control" id="ratings-hidden" name="rating" type="hidden"> 
                                                
                                                <div  style="display: inline-flex!important;">
                                                    <div class="text-left" style="margin: 20px 0; margin-left: 5px;">
                                                        <strong>Your rate and review</strong>
                                                    </div>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <div class="stars starrr" data-rating="0"></div>
                                                    <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                                    <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                                                    
                                                </div>  
                                                <textarea class="form-control animated" cols="50" id="new_review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
                                                <br>
                                                <button class="fancy-btn fancy-btn-small" type="submit">Send</button>                     
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-5 col-sm-4">
                            <div class="rating-block" style="height: 203px;">
                                <h4>Average user rating</h4>
                                
                                @if($average != 0)
                                    <h2 class="bold pt-20">{{$average}} <small>/ 5</small></h2>
                                @else
                                    <span>Be the First one to give review</span>
                                @endif
                                <div class="woocommerce-product-rating pt-20" itemprop="aggregateRating" itemscope="">
                                    <div class="rating"> 
                                        
                                        @if($average == 1)
                                            <span class="star active"></span>
                                            <span class="star "></span>
                                            <span class="star "></span>                                           
                                            <span class="star "></span>
                                            <span class="star "></span>
                                        @elseif($average == 2)
                                            <span class="star active"></span>
                                            <span class="star active"></span>
                                            <span class="star "></span>                                           
                                            <span class="star "></span>
                                            <span class="star "></span>
                                        @elseif($average == 3)
                                            <span class="star active"></span>
                                            <span class="star active"></span>
                                            <span class="star active"></span>                                           
                                            <span class="star "></span>
                                            <span class="star "></span>
                                        @elseif($average == 4)
                                            <span class="star active"></span>
                                            <span class="star active"></span>
                                            <span class="star active"></span>                                           
                                            <span class="star active"></span>
                                            <span class="star "></span>
                                        @elseif($average == 5)
                                            <span class="star active"></span>
                                            <span class="star active"></span>
                                            <span class="star active"></span>                                           
                                            <span class="star active"></span>
                                            <span class="star active"></span>
                                        @else
                                            <span class="star red-clr"></span>
                                            <span class="star "></span>
                                            <span class="star "></span>                                           
                                            <span class="star "></span>
                                            <span class="star "></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>         
                            
                    </div>
                    @if(count($prebook->product->reviews)>0)
                        <div class="row">
                            <div class="col-lg-12 col-sm-8">
                                <hr/>
                                <div class="review-block">
                                    @foreach($prebook->product->reviews as $review)
                                        <div class="row">
                                            <div class="col-sm-3" style="border-right: solid 1px #e3e0e0;">
                                                {{-- <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded"> --}}
                                                <img alt="" src="{{asset('/client/img/extra/avatar5.png')}}" class="img-rounded" height='40' width='40' />
                                                <div class="review-block-name"><a href="#">{{$review->client->clientName}}</a></div>
                                                <div class="review-block-date">{{$review->created_at->diffForHumans() }} </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="woocommerce-product-rating text-left ml-10" itemprop="aggregateRating" itemscope="">
                                                    <div class="rating"> 
                                                        @if($review->rating == 1)
                                                            <span class="star active"></span>
                                                            <span class="star "></span>
                                                            <span class="star "></span>                                           
                                                            <span class="star "></span>
                                                            <span class="star "></span>
                                                        @elseif($review->rating == 2)
                                                            <span class="star active"></span>
                                                            <span class="star active"></span>
                                                            <span class="star "></span>                                           
                                                            <span class="star "></span>
                                                            <span class="star "></span>
                                                        @elseif($review->rating == 3)
                                                            <span class="star active"></span>
                                                            <span class="star active"></span>
                                                            <span class="star active"></span>                                           
                                                            <span class="star "></span>
                                                            <span class="star "></span>
                                                        @elseif($review->rating == 4)
                                                            <span class="star active"></span>
                                                            <span class="star active"></span>
                                                            <span class="star active"></span>                                           
                                                            <span class="star active"></span>
                                                            <span class="star "></span>
                                                        @elseif($review->rating == 5)
                                                            <span class="star active"></span>
                                                            <span class="star active"></span>
                                                            <span class="star active"></span>                                           
                                                            <span class="star active"></span>
                                                            <span class="star active"></span>
                                                        @else
                                                            <span class="star red-clr"></span>
                                                            <span class="star "></span>
                                                            <span class="star "></span>                                           
                                                            <span class="star "></span>
                                                            <span class="star "></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="review-block-description text-left ml-10">
                                                    {{$review->review}}
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                    @endforeach
                                </div>
                            </div>
                        </div>                                                        
                    @endif
                </div>
            </div> 
        </div>
    </div>
    <!-- /Popup: review--> 
@endsection

@section('script')
<script>
$(document).ready(function(){
     $('.owl-carousel-related-product').owlCarousel({
         loop:true,
         margin:10,
         responsiveClass:true,
         autoplay:true,
         center:true,
         responsive:{
             0:{
                 items:1,
                 nav:false
             },
             600:{
                 items:3,
                 nav:false
             },
             1000:{
                 items:5,
                 nav:false,
                 loop:true
             }
         }
     })
});

$(document).ready(function(){
    $('.picZoomer').picZoomer({
        picWidth: $(this).width()
    });

    $('.piclist li').on('click',function(event){
        var $pic = $(this).find('img');
        $('.picZoomer-pic').attr('src',$pic.attr('src'));
    });
});


var clrTimeout;
$(window).resize(function(){
    clearTimeout(clrTimeout);
    clrTimeout = setTimeout(function(){
        $('.picZoomer').html($('.imgToSave'));
        $('.picZoomer').picZoomer({
            picWidth: $(this).width()
        });
    }, 200);
});

(function($){
    $.fn.picZoomer = function(options){
        var opts = $.extend({}, $.fn.picZoomer.defaults, options), 
            $this = this,
            // $picBD = $('<div class="picZoomer-pic-wp"></div>').css({'width':opts.picWidth+'px', 'height':opts.picHeight+'px'}).appendTo($this),
            $picBD = $('<div class="picZoomer-pic-wp"></div>').css({'width':420+'px', 'height':420+'px'}).appendTo($this),
            $pic = $this.children('img').addClass('picZoomer-pic').appendTo($picBD),
            $cursor = $('<div class="picZoomer-cursor"><i class="f-is picZoomCursor-ico"></i></div>').appendTo($picBD),
            cursorSizeHalf = {w:$cursor.width()/2 ,h:$cursor.height()/2},
            $zoomWP = $('<div class="picZoomer-zoom-wp"><img src="" alt="" class="picZoomer-zoom-pic"></div>').appendTo($this),
            $zoomPic = $zoomWP.find('.picZoomer-zoom-pic'),
            picBDOffset = {x:$picBD.offset().left,y:$picBD.offset().top};
        
        
        console.log(cursorSizeHalf);
        console.log(opts.picWidth);
        console.log(opts.picHeight);
        console.log(picBDOffset);


        
        opts.zoomWidth = opts.zoomWidth||opts.picWidth;
        opts.zoomHeight = opts.zoomHeight||opts.picHeight;
        var zoomWPSizeHalf = {w:opts.zoomWidth/2 ,h:opts.zoomHeight/2};

        
        $zoomWP.css({'width':opts.zoomWidth+'px', 'height':opts.zoomHeight+'px'});
        $zoomWP.css(opts.zoomerPosition || {top: 0, left: opts.picWidth+30+'px'});
        
        $zoomPic.css({'width':opts.picWidth*opts.scale+'px', 'height':opts.picHeight*opts.scale+'px'});

        
        $picBD.on('mouseenter',function(event){
            $cursor.show();
            $zoomWP.show();
            $zoomPic.attr('src',$pic.attr('src'))
        }).on('mouseleave',function(event){
            $cursor.hide();
            $zoomWP.hide();
        }).on('mousemove', function(event){
            var x = event.pageX-picBDOffset.x,
                y = event.pageY-picBDOffset.y;

            $cursor.css({'left':x-cursorSizeHalf.w+'px', 'top':y-cursorSizeHalf.h+'px'});
            $zoomPic.css({'left':-(x*opts.scale-zoomWPSizeHalf.w)+'px', 'top':-(y*opts.scale-zoomWPSizeHalf.h)+'px'});

        });
        return $this;

    };
    $.fn.picZoomer.defaults = {
        // picWidth: 320,
        // picHeight: 320,
        picWidth: 520,
        picHeight: 520,
        scale: 5,
        // zoomerPosition: {top: '350px', left: '0px'}
        zoomerPosition: {left: '520px', top: '0px'}
        ,
        // zoomWidth: 800,
        // zoomHeight: 800
    };
})(jQuery);


</script>
@endsection

