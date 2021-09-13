@extends('layouts.client')

@section('og_property')
    <meta property="og:title" content="{{ $product->productName}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:description" content="{{strip_tags($product->description)}}"/>
    <meta property="og:url" content="{{ url('product/'.$product->id.'/'.$product->slug)}}" />
    <meta property="og:image" content="{{url('storage/images/product/'.$product->image->image1)}}"/>
@endsection

@section('title')
    <title>{{$product->productName}} | Dadavaai</title>
@endsection
@php
$currentTime = \Carbon\Carbon::now()->format('d-m-Y');

$price = 0;

//Rating                                                            
$summation = 0;
$i = 0;
$average = 0;


if(count($product->reviews)>0)
{
    foreach ($product->reviews as $reviewAverage) {
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
                        <span><a href="{{url('#')}}">Products</a></span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span class="current red-clr">{{$product->productName}}</span>
                        {{-- <button id="buy" class="single_add_to_cart_button button fancy-button right" style="padding:5px" >Buy</button> --}}
                        @if($product->productInformation)
                            <i class="fa fa-home"></i>
                            <span><a href="{{url('product-ad-Information/'.$product->productInformation->id)}}">ad single page</a></span>
                        @endif
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
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="picZoomer">
                                        <img src="{{url('storage/images/product/'.$product->image->image1)}}" height="320" width="320" alt="">
                                    </div>
                                    <ul class="piclist">
                                        <li><img src="{{url('storage/images/product/'.$product->image->image1)}}" alt=""></li>
                                        <li><img src="{{url('storage/images/product/'.$product->image->image2)}}" alt=""></li>
                                        <li><img src="{{url('storage/images/product/'.$product->image->image3)}}" alt=""></li>
                                        <li><img src="{{url('storage/images/product/'.$product->image->image4)}}" alt=""></li>
                                        <li><img src="{{url('storage/images/product/'.$product->image->image5)}}" alt=""></li>

                                    </ul>
                                    {{-- <div class="outer">
                                        <div id="big" class="owl-carousel owl-theme">
                                            @if($product->image->image1)
                                                <div class="item">
                                                    <img src="{{url('storage/images/product/'.$product->image->image1)}}" alt="">
                                                </div>
                                            @endif
                                            @if($product->image->image2)
                                                <div class="item">
                                                    <img src="{{url('storage/images/product/'.$product->image->image2)}}" alt="">
                                                </div>
                                            @endif
                                            @if($product->image->image3)
                                                <div class="item">
                                                    <img src="{{url('storage/images/product/'.$product->image->image3)}}" alt="">
                                                </div>
                                            @endif
                                            @if($product->image->image4)
                                                <div class="item">
                                                    <img src="{{url('storage/images/product/'.$product->image->image4)}}" alt="">
                                                </div>
                                            @endif
                                            @if($product->image->image5)
                                                <div class="item">
                                                    <img src="{{url('storage/images/product/'.$product->image->image5)}}" alt="">
                                                </div>
                                            @endif
                                        </div>
                                        <div id="thumbs" class="owl-carousel owl-theme">
                                            @if($product->image->image1)
                                                <div class="item">
                                                    <img src="{{url('storage/images/product/'.$product->image->image1)}}" alt="">       
                                                </div>
                                            @endif
                                            @if($product->image->image2)
                                                <div class="item">
                                                    <img src="{{url('storage/images/product/'.$product->image->image2)}}" alt="">       
                                                </div>
                                            @endif
                                            @if($product->image->image3)
                                                <div class="item">
                                                    <img src="{{url('storage/images/product/'.$product->image->image3)}}" alt="">       
                                                </div>
                                            @endif
                                            @if($product->image->image4)
                                                <div class="item">
                                                    <img src="{{url('storage/images/product/'.$product->image->image4)}}" alt="">       
                                                </div>
                                            @endif
                                            @if($product->image->image5)
                                                <div class="item">
                                                    <img src="{{url('storage/images/product/'.$product->image->image5)}}" alt="">       
                                                </div>
                                            @endif
                                        </div>
                                    </div> --}}

                                </div>

                                <div class="col-lg-8 col-sm-12 col-md-12 col-xs-12">
                                    <form id="addProductToCart" action="#" class="" method="post">
                                        <div class="summary entry-summary">
                                            {{-- name & price --}}
                                            <div class="product_title_wrapper">
                                                <div itemprop="name" class="product_title entry-title">
                                                    <span class="fsz-14">{{$product->productName}}</span>
                                                    <p class=" fsz-14 no-mrgn price" style="width: 28% !important;">
                                                    @if ($product->discount)
                                                        @if ($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            <span class="thm-clr"> Tk {{number_format($product->regularPrice-(($product->regularPrice*($product->deal->discount_value + $product->discount))/100), 2)}}</span>    
                                                            <span class="thm-clr line-through"> Tk {{number_format($product->regularPrice,2)}}</span>  
                                                            @php
                                                                $price = $product->regularPrice-(($product->regularPrice*($product->deal->discount_value + $product->discount))/100);
                                                            @endphp 
                                                        @else
                                                            <span class="thm-clr"> Tk {{number_format($product->regularPrice-(($product->regularPrice*$product->discount)/100), 2)}}</span>
                                                            <span class="thm-clr line-through"> Tk {{number_format($product->regularPrice,2)}}</span>   
                                                            @php
                                                                $price = $product->regularPrice-(($product->regularPrice*$product->discount)/100);
                                                            @endphp     
                                                        @endif
                                                    @else
                                                        @if ($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            <span class="thm-clr"> Tk {{number_format($product->regularPrice-(($product->regularPrice*$product->deal->discount_value)/100), 2)}}</span>    
                                                            <span class="thm-clr line-through"> Tk {{number_format($product->regularPrice,2)}}</span>  
                                                            @php
                                                                $price = $product->regularPrice-(($product->regularPrice*$product->deal->discount_value)/100);
                                                            @endphp 
                                                        @else
                                                            <span class="thm-clr"> Tk {{number_format($product->regularPrice,2)}}</span> 
                                                            @php
                                                                $price = $product->regularPrice;
                                                            @endphp   
                                                        @endif
                                                    @endif  
                                                    </p>       
                                                </div>
                                            </div>
            
                                            <div class="col-lg-8 col-md-6 col-sm-6">
                                                <ul class="list-items fsz-12">
                                                    <li> 
                                                        <strong> Brand : <span class="blk-clr"> {{$product->brand->brandName}} </span> </strong> 
                                                    </li>
                                                    <li> 
                                                        <strong>  Category : <span class="blk-clr"> {{$product->category->categoryName}} </span> </strong> 
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
                                                                    {{-- @if($average != 0)
                                                                       ( {{$average}} <small>/ 5</small>)
                                                                    @else
                                                                        (0 <small>/ 5</small>)
                                                                    @endif --}}
                                                                </div>
                                                            </a>
                                                        </div>
                                                        
                                                    </li>
                                                </ul>

                                                <hr>

                                                <div class="text-justify blk-clr" style="font-size: 12px !important;">
                                                    {!! $product->shortDescription !!}
                                                </div>

                                                <div class="col-lg-12 col-md-6 col-sm-6 mt-20">
                                                    @if(count($product->bundleOffers))
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
                                                                @foreach ($product->bundleOffers as $bundleOffer)
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
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12 mt-20" style="display: inline-flex!important;">
                                                    <a href="{{url('addCompare/'.$product->id)}}" class="compare left-link red-clr" title="" data-comparelist="{{url('addCompare/'.$product->id)}}" style="border: solid 1px #d6d6d3; padding:8px 10px 8px 10px;  background: #f9f9f9; font-size: 14px;">compare</a>
                                                    &nbsp;
                                                    <a href="#" class="left-link addWishlist red-clr" data-placement="top" data-slug="{{$product->slug}}" title="Add To Wishlist" data-id="{{$product->id}}" data-url="{{url('/add-to-wishlist')}}" style="border: solid 1px #d6d6d3; padding:8px 10px 8px 10px;  background: #f9f9f9; font-size: 14px;">wishlist</a>

                                                    &nbsp;
                                                    <div class="fb-like right" data-href="{{url('product/'.$product->id.'/'.$product->slug)}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true" style="margin: auto; margin-left: 166px!important; "></div> 
                                                    
                                                    
                                                </div>
                                        
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6" style="border-left:#f2f2f2 1px solid">
                                                <ul class="list-items fsz-12">
                                                    <li style="margin-left: 40px;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <strong>  STOCK : 
                                                            @if ($product->availability == false)
                                                                <span class="grn-clr"> In Stock </span>  
                                                            @else
                                                                <span class="red-clr"> Out of Stock </span>  
                                                            @endif 
                                                        </strong> 
                                                    </li>
                                                    <hr>
                                                    <li style="margin-left: 40px;">
                                                        <div class="form-group">
                                                            
                                                            <label for="color" class="control-label col-lg-3">Color</label>
                                                            <div class="col-lg-9">
                                                                    <select id="color" name="color" class="form-control" title="Select color" style="text-transform: lowercase; height: 25px; width: 100px;">
                                                                        @foreach ($product->colors as $color)
                                                                            <option value="{{$color->id}}" style="text-transform: lowercase;">{{$color->color}}</option>
                                                                        @endforeach
                                                                    </select>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li style="margin-left: 40px;">
                                                        <div class="form-group ">
                                                            <label for="color" class="control-label col-lg-3">Size</label>
                                                            <div class="col-lg-9">
                                                                <select id="size" name="size" class="form-control" title="Select Size" style="text-transform: lowercase;height: 25px; width: 100px;">
                                                                    @foreach ($product->sizes as $size)
                                                                        <option value="{{$size->id}}" style="text-transform: lowercase;">{{$size->size}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li style="margin-left: 40px;">
                                                        <div class="form-group">
                                                            <label for="qty" class="control-label col-lg-3">Qty</label>
                                                            <div class="col-lg-9">
                                                                <input type="number" id="qty" name="qty"  value="{{$product->min_order_qty}}" title="Qty" class="form-control"  min="1" max="100" size="4" style="text-align: center;width: 100px;" />
                                                                <small><strong> &nbsp; * min qty : </strong> <span>{{$product->min_order_qty}}</span>{{$product->measurement}}</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="col-lg-12 col-md-6 col-sm-6 mt-20 mr-4">
                                                    <div class="row">
                                                        
                                                        <input type="text" name="productId" id="productId" data-price="@if($product->salePrice) {{$product->salePrice}} @else {{$product->regularPrice}}@endif" data-url="{{url('/add-cart')}}" value="{{$product->id}}" hidden>
                                                        <div class="col-lg-12 col-md-12 col-sm-12" >
                                                            <div class="form-group" style="margin-right: 10px;">
                                                                <button type="submit"  class="single_add_to_cart_button button alt fancy-button right"  title="Add To Cart">Add to cart</button>
                                                            </div>    
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-lg-12 col-md-6 col-sm-6 mt-20 mr-4" style="padding: unset; margin: unset;">
                                                    <div class="mt-5">
                                                        <div class="single-product-card-container">
                                                            {{-- <div class="single-product-card-header fsz-14">
                                                                Shipping
                                                            </div> --}}
                                                            <hr>
                                                            <div class="single-product-card-body pt-20">
                                                                <ul>
                                                                    {{-- <li class="text-left fsz-12"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Delivery from : {{$product->delivery_from}}</li> --}}
                                                                    <li class="text-left fsz-12"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Est. time of delivery : {{$product->delivery_time}}</li>
                                                                    {{-- <li class="text-left fsz-12"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> delivery charge : Tk {{$product->delivery_charge}}</li> --}}
                                                                    <li class="text-left fsz-12">
                                                                        <i class="fa fa-dot-circle-o" aria-hidden="true"></i> Payment : 
                                                                        @if ($product->paymentOption == true)
                                                                        Advance Payment
                                                                        @else
                                                                            Cash On delivery
                                                                        @endif
                                                                    </li>
                                                                    <li class="text-left fsz-12">
                                                                        <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                                                                        <a href="{{url('/terms-policies')}}"> Terms & Policies</a>
                                                                        &nbsp;&nbsp;
                                                                        {{-- <span class=""><i class="fa fa-info-circle" aria-hidden="true"></i></span> --}}

                                                                        <span data-toggle="tooltip" data-placement="left" title="{{$product->return_policy}}"><i class="fa fa-info-circle" aria-hidden="true"></i></span>

                                                                    </li>
                                                                    @if ($product->offer)
                                                                        @if ($product->offer->extra_offer == 1)
                                                                            <li class="text-left fsz-12">
                                                                                <i class="fa fa-dot-circle-o" aria-hidden="true"></i> 
                                                                                    buy & get
                                                                            </li>
                                                                        @endif
                                                                        @if ($product->offer->extra_offer == 2)
                                                                            <li class="text-left fsz-12">
                                                                                <i class="fa fa-dot-circle-o" aria-hidden="true"></i> 
                                                                                Free shipping
                                                                            </li>
                                                                        @endif
                                                                    {{-- @else
                                                                        <p class="text-center fsz-12"> No offer available</p> --}}
                                                                    @endif

                                                                    @if ($product->deal)
                                                                        <li class="text-left fsz-12">
                                                                            <i class="fa fa-dot-circle-o" aria-hidden="true"></i> 
                                                                                {{$product->deal->discount_value}} % (Deal)
                                                                                @if($product->discount)
                                                                                    + {{$product->discount}} % (Regular) off
                                                                                @endif
                                                                        </li>
                                                                    @elseif($product->discount)
                                                                        <li class="text-left fsz-12">
                                                                            <i class="fa fa-dot-circle-o" aria-hidden="true"></i> 
                                                                            {{$product->discount}} % (Regular) off
                                                                        </li>
                                                                    @else
                                                                        <li class="text-left fsz-12">
                                                                            <i class="fa fa-dot-circle-o" aria-hidden="true"></i> 
                                                                            No offer available
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                </div>
                                            </div>
                                            
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
                                    
                                    {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                                        <div class="row" style="border: solid 1px #ddd;">
                                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                                
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                                
                                                <div class="mt-5">
                                                    <div class="single-product-card-container">
                                                        <div class="single-product-card-header fsz-14">
                                                            Policy 
                                                        </div>
                                                        <div class="single-product-card-body pt-20">
                                                            @if($product->return_policy)
                                                            <p class="fsz-12">
                                                                {{ $product->return_policy }}
                                                                <br>
                                                                <a href="{{url('/terms-policies')}}"> Terms & Policies</a>
                                                            </p>
                                                            @else
                                                                <ul>
                                                                    <li>
                                                                        <a href="{{url('/terms-policies')}}"> Terms & Policies</a>
                                                                    </li>
                                                                </ul>
                                                            @endif

                                                        </div>
                                                    </div>    
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                                
                                                <div class="mt-5">
                                                    <div class="single-product-card-container">
                                                        <div class="single-product-card-header fsz-14">
                                                            Offers 
                                                        </div>
                                                        <div class="single-product-card-body ">
                                                            <ul>
                                                                @if ($product->offer)
                                                                    @if ($product->offer->extra_offer == 1)
                                                                        <li class="text-left fsz-12">
                                                                            <i class="fa fa-dot-circle-o" aria-hidden="true"></i> 
                                                                                buy & get
                                                                        </li>
                                                                    @endif
                                                                    @if ($product->offer->extra_offer == 2)
                                                                        <li class="text-left fsz-12">
                                                                            <i class="fa fa-dot-circle-o" aria-hidden="true"></i> 
                                                                            Free shipping
                                                                        </li>
                                                                    @endif
                                                                
                                                                @endif
                                                            </ul>
                                                            <ul>
                                                                @if ($product->deal)
                                                                    <li class="text-left fsz-12">
                                                                        <i class="fa fa-dot-circle-o" aria-hidden="true"></i> 
                                                                            {{$product->deal->discount_value}} % (Deal)
                                                                            @if($product->discount)
                                                                                + {{$product->discount}} % (Regular) off
                                                                            @endif
                                                                    </li>
                                                                @elseif($product->discount)
                                                                    {{$product->discount}} % (Regular) off
                                                                @else
                                                                    <p class="text-center fsz-12"> No offer available</p>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-20">
                                        <div>
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">

                                              <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
                                              <li role="presentation"><a href="#specification" aria-controls="specification" role="tab" data-toggle="tab">Specification</a></li>
                                              {{-- <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Review</a></li> --}}
                                            </ul>
                                        </div>
                                        {{-- Tab panes  --}}
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="description">
                                                <div class="site-tab">
                                                    <div class="text-justify blk-clr">
                                                        {!! $product->description !!}
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div role="tabpanel" class="tab-pane" id="specification">
                                                <div class="site-tab">
                                                    <div class="text-justify blk-clr">
                                                        {!! $product->specification !!}
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
                <section id="similar">
                    {{-- similar product comparison --}}
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="compare-list">
                                <div class="heading-2" style="padding-bottom: unset;"> <h3 class="title-3 fsz-15">Similar products</h3> </div> 
                                @if(count($similarProducts))                               
                                    <div class="table-responsive fsz-12">
                                        <table class="table table-responsive table-bordered table-compare">
                                            <tr>
                                                <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px;">Image</th>
                                                @foreach($similarProducts as $similarProduct)
                                                    <td class="text-center" style="vertical-align:middle!important;">
                                                        <a href="#">
                                                            <img src="{{asset('storage/images/product/'.$similarProduct->image->image1)}}" alt="Product" height="130px" width="130px">
                                                        </a>
                                                    </td><!-- /.product -->
                                                @endforeach
                                            </tr>
                                            <tr class="text-center">
                                                <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px;">Name</th>
                                                @foreach($similarProducts as $similarProduct)
                                                    <td class="blklt-clr" style="vertical-align:middle!important;">
                                                        <a href="{{url('product/'.$similarProduct->id.'/'.$similarProduct->slug)}}">{{substr($similarProduct->productName, 0,26)}}</a>
                                                    </td><!-- /.product -->
                                                @endforeach
                                            </tr>
                                            <tr class="text-center">
                                                <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px;">Price</th>
                                                @foreach($similarProducts as $similarProduct)
                                                    <td class="price blklt-clr" style="vertical-align:middle!important;">
                                                        @if ($similarProduct->discount)
                                                            @if ($similarProduct->deal_id && $similarProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr">
                                                                    Tk {{number_format($similarProduct->regularPrice-(($similarProduct->regularPrice*($similarProduct->deal->discount_value + $similarProduct->discount))/100), 2)}}
                                                                </span>    
                                                                <span class="thm-clr line-through"> Tk {{$similarProduct->regularPrice}}</span>   
                                                            @else
                                                                <span class="thm-clr">
                                                                    Tk {{number_format($similarProduct->regularPrice-(($similarProduct->regularPrice*$similarProduct->discount)/100), 2)}}
                                                                </span>
                                                                <span class="thm-clr line-through"> Tk {{$similarProduct->regularPrice}}</span>
                                                            @endif
                                                        @else
                                                            @if ($similarProduct->deal_id && $similarProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> 
                                                                    Tk {{number_format($similarProduct->regularPrice-(($similarProduct->regularPrice*$similarProduct->deal->discount_value)/100), 2)}}
                                                                </span>    
                                                                <span class="thm-clr line-through"> Tk {{$similarProduct->regularPrice}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{$similarProduct->regularPrice}}</span>    
                                                            @endif
                                                        @endif
                                                    </td>
                                                @endforeach
                                                
                                            </tr>

                                            <tr class="text-center">
                                                <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px;">Brand</th>
                                                @foreach($similarProducts as $similarProduct)
                                                    <td class="blklt-clr" style="vertical-align:middle!important;"> {{$similarProduct->brand->brandName}}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px;">Spec</th>
                                                @foreach($similarProducts as $similarProduct)
                                                    <td style="vertical-align:middle!important;"> 
                                                        <p class=" text-justify blklt-clr">
                                                            {{substr(strip_tags($similarProduct->specification), 0, 85)}}...
                                                            <a href="{{url('product/'.$similarProduct->id.'/'.$similarProduct->slug.'#specification')}}"> 
                                                                <span class="" style="color: red;!important">more</span> 
                                                            </a> 
                                                        </p> 
                                                    </td>

                                                @endforeach
                                            </tr>
                                        
                                            <tr class="text-center">
                                                <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px;">Size</th>
                                                @foreach($similarProducts as $similarProduct)
                                                    <td class="blklt-clr" style="vertical-align:middle!important;">
                                                        <p>
                                                            @php
                                                                $size_length = count($similarProduct->sizes);
                                                                $i = 0;

                                                            @endphp
                                                            @foreach($similarProduct->sizes as $size)
                                                                {{$size->size}}
                                                                @if($i < $size_length-1)
                                                                    ,
                                                                @endif

                                                                @php
                                                                    $i++;
                                                                @endphp

                                                            @endforeach
                                                        </p>
                                                    </td><!-- /.size -->
                                                @endforeach
                                            </tr>
                                            <tr class="text-center">
                                                <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px; ">Color</th>
                                                @foreach($similarProducts as $similarProduct)
                                                    <td class="blklt-clr" style="vertical-align:middle!important;">
                                                        <p>
                                                         @php
                                                            $color_length = count($similarProduct->colors);
                                                            $i = 0;

                                                        @endphp   
                                                        @foreach($similarProduct->colors as $color)
                                                            {{$color->color}}
                                                            @if($i < $color_length-1)
                                                                ,
                                                            @endif

                                                            @php
                                                                $i++;
                                                            @endphp
                                                        @endforeach
                                                        </p>
                                                    </td><!-- /.color -->
                                                @endforeach
                                            </tr>        
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>                     
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
                                                <input class="form-control" id="product_id-hidden" name="product_id" type="hidden" value="{{$product->id}}">
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
                    @if(count($product->reviews)>0)
                        <div class="row">
                            <div class="col-lg-12 col-sm-8">
                                <hr/>
                                <div class="review-block">
                                    @foreach($product->reviews as $review)
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

        // $('.picZoomer').picZoomer();

        // $('.piclist li').on('click',function(event){
        //     var $pic = $(this).find('img');
        //     $('.picZoomer-pic').attr('src',$pic.attr('src'));
        // });

        // $('#big').zoomify();



        //dgdhhrthrthrthrt

        // var bigimage = $("#big");
        // var thumbs = $("#thumbs");
        // var syncedSecondary = true;
      
        // bigimage
        //   .owlCarousel({
        //   items: 1,
        //   slideSpeed: 2000,
        //   nav: false,
        //   nav: false,
        //   autoplay: true,
        //   dots: false,
        //   loop: true,
        //   responsiveRefreshRate: 200,
        // }).on("changed.owl.carousel", syncPosition);
      
        // thumbs.on("initialized.owl.carousel", function() {
        //     thumbs.find(".owl-item").eq(0).addClass("current");
        // })
        //   .owlCarousel({
        //   items: 5,
        //   dots: false,
        //   nav: false,

        //   smartSpeed: 200,
        //   slideSpeed: 500,
        //   slideBy: 4,
        //   responsiveRefreshRate: 100
        // })
        //   .on("changed.owl.carousel", syncPosition2);
      
        // function syncPosition(el) {
         
          
        //   var count = el.item.count - 1;
        //   var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

        //   if (current < 0) {
        //     current = count;
        //   }
        //   if (current > count) {
        //     current = 0;
        //   }
          
        //   thumbs
        //     .find(".owl-item")
        //     .removeClass("current")
        //     .eq(current)
        //     .addClass("current");
        //   var onscreen = thumbs.find(".owl-item.active").length - 1;
          
        //   var start = thumbs.find(".owl-item.active").first().index();
        //   var end = thumbs.find(".owl-item.active").last().index();
        //   console.log(end);
        //   if (current > end) {
        //     thumbs.data("owl.carousel").to(current, 100, true);
            
        //   }
        //   if (current < start) {
        //     thumbs.data("owl.carousel").to(current - onscreen, 100, true);
            
        //   }
        // }
      
        // function syncPosition2(el) {
        //   if (syncedSecondary) {
        //     var number = el.item.index;
        //     bigimage.data("owl.carousel").to(number, 100, true);
            
        //   }
        // }
      
        // thumbs.on("click", ".owl-item", function(e) {
        //   e.preventDefault();
        //   var number = $(this).index();
        //   bigimage.data("owl.carousel").to(number, 300, true);
         
        // });


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
            $picBD = $('<div class="picZoomer-pic-wp"></div>').css({'width':350+'px', 'height':350+'px'}).appendTo($this),
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
        picWidth: 400,
        picHeight: 400,
        scale: 5,
        // zoomerPosition: {top: '350px', left: '0px'}
        zoomerPosition: {left: '350px', top: '0px'}
        ,
        // zoomWidth: 800,
        // zoomHeight: 800
    };
})(jQuery);


</script>
@endsection

