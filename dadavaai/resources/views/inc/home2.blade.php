@extends('layouts.client')

@section('og_property')
    <meta property="og:title" content="Dadavaai"/>
    <meta property="og:type" content="article"/>
    <meta property="og:description" content=""/>
    <meta property="og:url" content="{{ url('/')}}" />
    @if ($banner)
        <meta property="og:image" content="{{asset('storage/images/banner/'.$banner->home_one)}}"/>
    @elseif ($adsProducts)
        <meta property="og:image" content="{{asset('storage/images/ads/'.$adsProducts->ad3Image)}}"/>
    @endif
    
@endsection


@section('title')
    <title>Dadavaai | Exclusive & On Demand Products </title>
@endsection

@php
    $currentTime = \Carbon\Carbon::now()->format('d-m-Y');
    $time = \Carbon\Carbon::now()->format('h:m:s');
    $discount_val = 0;
    $discount_val = \App\Product::max('discount');
    $i = 0;

@endphp

@section('content')
    {{-- facebook share sdk --}}
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=196929838191386&autoLogAppEvents=1"></script>

    <!-- CONTENT + SIDEBAR -->
    <div class="main-wrapper clearfix">
        {{-- On demand form --}}
        <div class="contact-icons hidden-sm hidden-xs" style="right: 0px;">
            <div class="contact-icon-left-arrow" style="color: #ffffff;"><i  class="fa fa-arrow-left" style="padding-top: 33px;"></i></div>
            <div class="contact-icon-left-close hide"><i  class="fa fa-times" aria-hidden="true"></i></div>
            <div class="ondemand-form hide">
                <div class="contact-icon-right hide" ></div>
                    <div style="padding: 10px;">
                        <h2 class="fsz-28" style="color: #464545;">Query Your Demand</h2>
                    </div>
                {{-- <form action="{{url("on-demand")}}" enctype="multipart/form-data" role="form" method="post">
                    {{csrf_field()}}
                    <div class="form-inline mb-5">
                        <div class="form-group">
                            <select class="form-control" id="ondemandCategory" name="ondemand_category" required>
                                <option value="">select category</option>
                                @foreach($categories as $ondemandCategory)
                                    <option value="{{$ondemandCategory->id}}">{{$ondemandCategory->categoryName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="ondemandSubCategory" name="ondemand_subcategory">
                                <option value="">sub category</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="ondemandMiniCategory" name="ondemand_minicategory">
                                <option value="">mini category</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-inline mb-5">
                        <div class="form-group">
                          <input type="text" class="form-control" id="ondemandProduct" name="ondemand_product" placeholder="Product" required>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <select class="form-control" name="qty" required>
                                <option value="">Select Qty</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <select class="form-control" name="unit">
                                <option value="">Select Unit</option>
                                <option value="kilogram">kilogram </option>
                                <option value="meter">meter</option>
                                <option value="pieces">pieces</option>
                                <option value="liter">liter</option>
                                <option value="inch">inch</option>
                                <option value="gram">gram</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-inline mb-5 mt-10">
                        <div class="form-group left">
                            <textarea class="form-control" rows="3" name="ondemand_product_details" placeholder="Write product details" required ></textarea>
                        </div>
                        &nbsp;
                        <div class="form-group">
                          <input type="file" class="form-control"  name="input_img">
                        </div>
                    </div>
                    <div class="mt-60" style="padding:10px;">
                        <a href="#" class="left">
                            <u>
                                Term & Condition
                            </u>
                        </a>
                        @if(!Session::has('CLIENT_ID'))
                            <li class="menu-item">
                                <a  href="#login-popup" class="btn btn-default right" data-toggle="modal">Submit</a>
                            </li>
                        @else
                            <button type="submit" class="btn btn-default right">Submit</button>
                        @endif
                    </div>
                </form> --}}
                <form action="{{url("on-demand")}}" enctype="multipart/form-data" role="form" method="post">
                    {{csrf_field()}}
                    <div class="row" style="float: right;">
                        <div class="col-lg-3" style=" margin-left: 20px;">

                            <div class="" style="border: solid 1px ; padding: 5px;">
                                <div class="form-inline ">
                                    <label class="radio-inline">
                                        <input type="radio" name="ondemand_type" value="product" checked>Product
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="ondemand_type" value="service" disabled>Service
                                    </label>
                                </div>
                            </div>
                            <div style="border: solid 1px ; padding: 10px; margin-top: 5px;">
                                <div class="form-group" style="margin: 2px;">
                                    <select class="form-control" id="ondemandCategory" name="ondemand_category" required>
                                        <option value="">category</option>
                                        @foreach($categories as $ondemandCategory)
                                            <option value="{{$ondemandCategory->id}}">{{$ondemandCategory->categoryName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="margin: 2px;">
                                    <select class="form-control" id="ondemandSubCategory" name="ondemand_subcategory">
                                        <option value="">Sub category</option>
                                    </select>
                                </div>
                                <div class="form-group" style="margin: 2px;">
                                    <select class="form-control" id="ondemandMiniCategory" name="ondemand_minicategory">
                                        <option value="">Mini category</option>
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        {{--ondemand product details  start--}}
                        <div id="product_rfq" class="col-lg-8" style="border: solid 1px ; padding: 15px; margin-left: 10px;">
                            
                            <div class="row">
                                <div class="col-lg-1" >
                                    <div class="row">
                                        <div>
                                            <input type="radio" name="optradio" value="by_name" checked >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-11" style="padding-left: unset;">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                {{-- <select class="form-control" name="ondemand_product" required>
                                                    <option value="">product name</option>
                                                </select> --}}
                                                <input type="text" class="form-control" placeholder="product name"  name="ondemand_product" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                    <input type="number" class="form-control" placeholder="Qty"  name="qty">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <select class="form-control" name="unit">
                                                    <option value="">Unit</option>
                                                    <option value="kilogram">kilogram </option>
                                                    <option value="meter">meter</option>
                                                    <option value="pieces">pieces</option>
                                                    <option value="liter">liter</option>
                                                    <option value="inch">inch</option>
                                                    <option value="gram">gram</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="1" cols="30" name="ondemand_product_details" placeholder="product details" required ></textarea>
                                            </div>
                                        </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="margin:8px;">
                                    <span style="color: #000; " >---Or---</span>
                                </div>
                            </div>
                            <div class="row mt-10" >
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div>
                                            <input type="radio" name="optradio" value="by_image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-11" style="padding-left: unset;">
                                    <div class="form-group" >
                                        <label class="control-label col-lg-4">Upload Image</label>
                                        <div class="col-lg-8">
                                            <input type="file" class="form-control" placeholder="Optional"  name="input_img">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        {{--ondemand product details end--}}
                        {{--ondemand service details  start--}}
                        <div id="service_rfq" class="col-lg-8 hide" style="border: solid 1px ; padding: 15px; margin-left: 10px;">
                            
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-lg-12" style="padding-left: unset;">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="service name"  name="ondemand_service" >
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <input type="number" class="form-control" placeholder="Qty"  name="service_qty">
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="control-label col-lg-4" for="service_hour">Work hr</label>
                                            <div class="col-lg-8">
                                                <input type="number" class="form-control" placeholder="hour"  name="service_hour">
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-10" style="margin-bottom: 15px;">
                                <div class="col-lg-12" style="padding-left: unset;">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <select class="form-control" name="service_unit">
                                                <option value="">Unit</option>
                                                <option value="person">person </option>
                                                <option value="pieces">pieces</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label col-lg-4" for="service_time">Schedule</label>
                                            <div class="col-lg-8">
                                                <input type="time" class="form-control" placeholder="time"  name="service_time">
                                            </div>                                          
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="control-label col-lg-4" for="service_date">Date</label>
                                            <div class="col-lg-8">
                                                <input type="date" class="form-control" placeholder="date"  name="service_date">
                                            </div>                                          
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        {{--ondemand service details end--}}
                        <div class="form-inline ">
                            &nbsp;
                        </div>
                    </div>
                    <br>
                    <div class="row mt-10" style="padding:10px;">
                        <a href="#" class="left" style=" margin: 30px">
                            <u>
                                Term & Condition
                            </u>
                        </a>
                        @if(!Session::has('CLIENT_ID'))
                           
                            <a  href="#login-popup" class="btn btn-default right" data-toggle="modal" style="margin:30px;">Submit</a>
                            
                        @else
                            <button type="submit" class="btn btn-default right" style="margin: 30px;">Submit</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <!-- Main Slider -->
        <div id="owl-carousel-main" class="owl-carousel nav-1">
            @foreach ($sliders as $slider)
                <div class="gst-slide">
                    <img src="{{asset('storage/images/slider/'.$slider->image)}}"  alt="slider Image"/>
                    <div class="gst-caption container theme-container" style="margin-top:300px">
                        <div>
                            <div class="caption-center">
                                <a class="fancy-btn fsz-14" href="{{url(''.$slider->slider_link)}}">Find This Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- / Main Slider -->

        <!-- All products Start-->
        {{-- <section class="gst-row row-bikes clear">
            <div class="container theme-container">
                <div class="gst-column col-lg-12 no-padding text-center">
                    <div class="fancy-heading text-center">
                        <h3><span class="thm-clr">Products </span></h3>
                    </div>

                    <div class="theme-container container">
                        <ul class="nav nav-tabs fsz-13" role="tablist">
                            <li class="active"><a href="#all_p_cat" aria-controls="all_p_cat" role="tab" data-toggle="tab">ALL</a></li>
                            
                            @foreach ($categories as $P_category)
                                <li><a href="#p_cat_{{$P_category->id}}" aria-controls="p_cat_{{$P_category->id}}" role="tab" data-toggle="tab">{{$P_category->categoryName}}</a></li>
                            @endforeach 

                        </ul>
                    </div>
                    <div class="tab-content ">
                        <div role="tabpanel" class="tab-pane active" id="all_p_cat">
                            <div class="site-tab">
                                <div class="container text-center">
                                    
                                    @foreach ($all_products as $all_p_cat_product)
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="portfolio-wrapper">
                                                <div class="portfolio-thumb">
                                                    <img src="{{asset('storage/images/product/'.$all_p_cat_product->image->image1)}}" alt="">
                                                    <div class="portfolio-content">                                            
                                                        <div class="pop-up-icon">                 
                                                            <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                            data-id="{{$all_p_cat_product->id}}" 
                                                            data-min_order_qty="{{$all_p_cat_product->min_order_qty}}" 
                                                            
                                                            data-brand="{{$all_p_cat_product->brand->brandName}}"                                                             
                                                            data-slug="{{$all_p_cat_product->slug}}" 
                                                            data-name="{{$all_p_cat_product->productName}}" 
                                                            data-image="{{asset('storage/images/product/'.$all_p_cat_product->image->image1)}}" 
                                                            data-desc="{{strip_tags($all_p_cat_product->shortDescription)}}" 
                                                @if ($all_p_cat_product->discount)
                                                    @if ($all_p_cat_product->deal_id && $all_p_cat_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            
                                                        data-sale="{{number_format($all_p_cat_product->regularPrice-(($all_p_cat_product->regularPrice*($all_p_cat_product->deal->discount_value + $all_p_cat_product->discount))/100), 2)}}"

                                                        data-regular="{{$all_p_cat_product->regularPrice}}"
                                                             
                                                    @else
                                                            data-sale="{{number_format($all_p_cat_product->regularPrice-(($all_p_cat_product->regularPrice*$all_p_cat_product->discount)/100), 2)}}"
                                                            data-regular="{{$all_p_cat_product->regularPrice}}"

                                                    @endif
                                                @else
                                                    @if ($all_p_cat_product->deal_id && $all_p_cat_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        data-sale="{{number_format($all_p_cat_product->regularPrice-(($all_p_cat_product->regularPrice*$all_p_cat_product->deal->discount_value)/100), 2)}}"
                                                        data-regular="{{$all_p_cat_product->regularPrice}}"
                                                    @else
                                                        data-regular="{{$all_p_cat_product->regularPrice}}"
                                                    @endif
                                                @endif 
                                                            data-url="{{url('product/'.$all_p_cat_product->id.'/'.$all_p_cat_product->slug)}}"><i class="fa fa-search"></i></a>

                                                            <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$all_p_cat_product->slug}}" title="Add To Wishlist" data-id="{{$all_p_cat_product->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                            <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$all_p_cat_product->slug}}" title="Add To Cart" data-id="{{$all_p_cat_product->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3> 
                                                        <a class="title-3 fsz-12" href="{{url('product/'.$all_p_cat_product->id.'/'.$all_p_cat_product->slug)}}">
                                                            {{substr($all_p_cat_product->productName, 0, 35)}}
                                                        </a> 
                                                    </h3>
                                                    <p class="font-2"> 
                                                        @if ($all_p_cat_product->discount)
                                                            @if ($all_p_cat_product->deal_id && $all_p_cat_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($all_p_cat_product->regularPrice-(($all_p_cat_product->regularPrice*($all_p_cat_product->deal->discount_value + $all_p_cat_product->discount))/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($all_p_cat_product->regularPrice, 2)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($all_p_cat_product->regularPrice-(($all_p_cat_product->regularPrice*$all_p_cat_product->discount)/100), 2)}}</span>
                                                                <span class="thm-clr line-through"> Tk {{number_format($all_p_cat_product->regularPrice, 2)}}</span>        
                                                            @endif
                                                        @else
                                                            @if ($all_p_cat_product->deal_id && $all_p_cat_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($all_p_cat_product->regularPrice-(($all_p_cat_product->regularPrice*$all_p_cat_product->deal->discount_value)/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($all_p_cat_product->regularPrice, 2)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($all_p_cat_product->regularPrice, 2)}}</span>    
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
                        @foreach ($categories as $P_category_panel)
                            <div role="tabpanel" class="tab-pane" id="p_cat_{{$P_category_panel->id}}">
                                <div class="site-tab">
                                    <div class="container text-center">
                                        @foreach ($P_category_panel->product->where('published', false)->take(8) as $P_category_panel_product)
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="portfolio-wrapper">
                                                    <div class="portfolio-thumb">
                                                        <img src="{{asset('storage/images/product/'.$P_category_panel_product->image->image1)}}" alt="">
                                                        <div class="portfolio-content">                                            
                                                            <div class="pop-up-icon">                 
                                                                <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                                data-id="{{$P_category_panel_product->id}}"
                                                                data-min_order_qty="{{$P_category_panel_product->min_order_qty}}" 
                                                                data-category="{{$P_category_panel_product->category->categoryName}}" 
                                                                data-brand="{{$P_category_panel_product->brand->brandName}}" 
                                                                data-slug="{{$P_category_panel_product->slug}}" 
                                                                data-name="{{$P_category_panel_product->productName}}" 
                                                                data-image="{{asset('storage/images/product/'.$P_category_panel_product->image->image1)}}" 
                                                                data-desc="{{strip_tags($P_category_panel_product->shortDescription)}}" 
                                                    @if ($P_category_panel_product->discount)
                                                        @if ($P_category_panel_product->deal_id && $P_category_panel_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                
                                                            data-sale="{{number_format($P_category_panel_product->regularPrice-(($P_category_panel_product->regularPrice*($P_category_panel_product->deal->discount_value + $P_category_panel_product->discount))/100), 2)}}"

                                                            data-regular="{{$P_category_panel_product->regularPrice}}"
                                                                 
                                                        @else
                                                                data-sale="{{number_format($P_category_panel_product->regularPrice-(($P_category_panel_product->regularPrice*$P_category_panel_product->discount)/100), 2)}}"
                                                                data-regular="{{$P_category_panel_product->regularPrice}}"

                                                        @endif
                                                    @else
                                                        @if ($P_category_panel_product->deal_id && $P_category_panel_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            data-sale="{{number_format($P_category_panel_product->regularPrice-(($P_category_panel_product->regularPrice*$P_category_panel_product->deal->discount_value)/100), 2)}}"
                                                            data-regular="{{$P_category_panel_product->regularPrice}}"
                                                        @else
                                                            data-regular="{{$P_category_panel_product->regularPrice}}"
                                                        @endif
                                                    @endif  
                                                                data-url="{{url('product/'.$P_category_panel_product->id.'/'.$P_category_panel_product->slug)}}"><i class="fa fa-search"></i></a>

                                                                <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$P_category_panel_product->slug}}" title="Add To Wishlist" data-id="{{$P_category_panel_product->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                                <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$P_category_panel_product->slug}}" title="Add To Cart" data-id="{{$P_category_panel_product->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3> 
                                                            <a class="title-3 fsz-12" href="{{url('product/'.$P_category_panel_product->id.'/'.$P_category_panel_product->slug)}}">
                                                                {{substr($P_category_panel_product->productName, 0, 35)}}
                                                            </a> 
                                                        </h3>
                                                        <p class="font-2">
                                                            @if ($P_category_panel_product->discount)
                                                                @if ($P_category_panel_product->deal_id && $P_category_panel_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    <span class="thm-clr"> Tk {{number_format($P_category_panel_product->regularPrice-(($P_category_panel_product->regularPrice*($P_category_panel_product->deal->discount_value + $P_category_panel_product->discount))/100), 2)}}</span>    
                                                                    <span class="thm-clr line-through"> Tk {{number_format($P_category_panel_product->regularPrice, 2)}}</span>   
                                                                @else
                                                                    <span class="thm-clr"> Tk {{number_format($P_category_panel_product->regularPrice-(($P_category_panel_product->regularPrice*$P_category_panel_product->discount)/100), 2)}}</span>
                                                                    <span class="thm-clr line-through"> Tk {{number_format($P_category_panel_product->regularPrice, 2)}}</span>        
                                                                @endif
                                                            @else
                                                                @if ($P_category_panel_product->deal_id && $P_category_panel_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    <span class="thm-clr"> Tk {{number_format($P_category_panel_product->regularPrice-(($P_category_panel_product->regularPrice*$P_category_panel_product->deal->discount_value)/100), 2)}}</span>    
                                                                    <span class="thm-clr line-through"> Tk {{number_format($P_category_panel_product->regularPrice, 2)}}</span>   
                                                                @else
                                                                    <span class="thm-clr"> Tk {{number_format($P_category_panel_product->regularPrice, 2)}}</span>    
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
                        @endforeach 
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- all product End-->

        <!-- All products Start-->
        <section class="gst-row row-bikes clear">
            <div class="container theme-container">
                <div class="gst-column col-lg-12 no-padding text-center">
                    <div class="fancy-heading text-center">
                        <h3><span class="thm-clr">Products </span></h3>
                    </div>

                    <div class="theme-container container">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs fsz-13" role="tablist">
                            <li class="active"><a href="#all_p_cat" aria-controls="all_p_cat" role="tab" data-toggle="tab">ALL</a></li>
                            
                            @foreach ($categories->where('categoryName','!=', 'Service & Support') as $P_category)
                                <li><a href="#p_cat_{{$P_category->id}}" aria-controls="p_cat_{{$P_category->id}}" role="tab" data-toggle="tab" style="padding: 10px 13px !important;">{{$P_category->categoryName}}</a></li>
                            @endforeach 

                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content ">
                        <div role="tabpanel" class="tab-pane active" id="all_p_cat">
                            <div class="site-tab">
                                <div class="container text-center">
                                    <div class="row ">
                                        <div class="owl-carousel-all-product owl-theme">

                                            @php $i = 0; @endphp
                                            @foreach($all_products as $all_p_cat_product)
                                                @php $i++; @endphp
                                                @if($i % 2)
                                                <div class="item">
                                                @endif
                                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                                        <div class="portfolio-wrapper">
                                                            <div class="portfolio-thumb">
                                                                <img src="{{asset('storage/images/product/'.$all_p_cat_product->image->image1)}}" alt="">
                                                                <div class="portfolio-content">                                            
                                                                    <div class="pop-up-icon">                 
                                                                        <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                                        data-id="{{$all_p_cat_product->id}}" 
                                                                        data-min_order_qty="{{$all_p_cat_product->min_order_qty}}" 
                                                                        
                                                                        data-brand="{{$all_p_cat_product->brand->brandName}}"                                                             
                                                                        data-slug="{{$all_p_cat_product->slug}}" 
                                                                        data-name="{{$all_p_cat_product->productName}}" 
                                                                        data-image="{{asset('storage/images/product/'.$all_p_cat_product->image->image1)}}" 
                                                                        data-desc="{{strip_tags($all_p_cat_product->shortDescription)}}" 
                                                            @if ($all_p_cat_product->discount)
                                                                @if ($all_p_cat_product->deal_id && $all_p_cat_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                        
                                                                    data-sale="{{number_format($all_p_cat_product->regularPrice-(($all_p_cat_product->regularPrice*($all_p_cat_product->deal->discount_value + $all_p_cat_product->discount))/100), 2)}}"

                                                                    data-regular="{{$all_p_cat_product->regularPrice}}"
                                                                         
                                                                @else
                                                                        data-sale="{{number_format($all_p_cat_product->regularPrice-(($all_p_cat_product->regularPrice*$all_p_cat_product->discount)/100), 2)}}"
                                                                        data-regular="{{$all_p_cat_product->regularPrice}}"

                                                                @endif
                                                            @else
                                                                @if ($all_p_cat_product->deal_id && $all_p_cat_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    data-sale="{{number_format($all_p_cat_product->regularPrice-(($all_p_cat_product->regularPrice*$all_p_cat_product->deal->discount_value)/100), 2)}}"
                                                                    data-regular="{{$all_p_cat_product->regularPrice}}"
                                                                @else
                                                                    data-regular="{{$all_p_cat_product->regularPrice}}"
                                                                @endif
                                                            @endif 
                                                                        data-url="{{url('product/'.$all_p_cat_product->id.'/'.$all_p_cat_product->slug)}}"><i class="fa fa-search"></i></a>

                                                                        <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$all_p_cat_product->slug}}" title="Add To Wishlist" data-id="{{$all_p_cat_product->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                                        <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$all_p_cat_product->slug}}" title="Add To Cart" data-id="{{$all_p_cat_product->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-content">
                                                                <h3> 
                                                                    <a class="title-3 fsz-12" href="{{url('product/'.$all_p_cat_product->id.'/'.$all_p_cat_product->slug)}}">
                                                                        {{substr($all_p_cat_product->productName, 0, 26)}}
                                                                    </a> 
                                                                </h3>
                                                                <p class="font-2 fsz-10"> 
                                                                    @if ($all_p_cat_product->discount)
                                                                        @if ($all_p_cat_product->deal_id && $all_p_cat_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                            <span class="thm-clr"> Tk {{number_format($all_p_cat_product->regularPrice-(($all_p_cat_product->regularPrice*($all_p_cat_product->deal->discount_value + $all_p_cat_product->discount))/100))}}</span>    
                                                                            &nbsp; 
                                                                            <span class="thm-clr line-through"> Tk {{number_format($all_p_cat_product->regularPrice)}}</span>   
                                                                        @else
                                                                            <span class="thm-clr"> Tk {{number_format($all_p_cat_product->regularPrice-(($all_p_cat_product->regularPrice*$all_p_cat_product->discount)/100))}}</span>
                                                                            &nbsp;
                                                                            <span class="thm-clr line-through"> Tk {{number_format($all_p_cat_product->regularPrice)}}</span>        
                                                                        @endif
                                                                    @else
                                                                        @if ($all_p_cat_product->deal_id && $all_p_cat_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                            <span class="thm-clr"> Tk {{number_format($all_p_cat_product->regularPrice-(($all_p_cat_product->regularPrice*$all_p_cat_product->deal->discount_value)/100))}}</span>    
                                                                            &nbsp;
                                                                            <span class="thm-clr line-through"> Tk {{number_format($all_p_cat_product->regularPrice)}}</span>   
                                                                        @else
                                                                            <span class="thm-clr"> Tk {{number_format($all_p_cat_product->regularPrice)}}</span>    
                                                                        @endif
                                                                    @endif
                                                                    <a href="#" class="compare-add-to-cart right-link addCart" data-placement="top" data-slug="{{$all_p_cat_product->slug}}" title="Add To Cart" data-id="{{$all_p_cat_product->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="fa fa-shopping-cart"></i></a>
                                                                    <a class="compare-add-to-cart left-link addWishlist" href="#" data-placement="top" data-slug="{{$all_p_cat_product->slug}}" title="Add To Wishlist" data-id="{{$all_p_cat_product->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a> 
                                                                </p>    
                                                            </div>
                                                        </div>
                                                    </div>
                                                @if($i % 2 == 0)
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- here's the problem --}}
                        {{-- </div> --}}
                        @foreach ($categories->where('categoryName','!=', 'Service & Support') as $P_category_panel)
                            <div role="tabpanel" class="tab-pane" id="p_cat_{{$P_category_panel->id}}">
                                <div class="site-tab">
                                    <div class="container text-center">
                                        <!-- Portfolio items -->
                                        @foreach ($P_category_panel->product->where('published', false)->take(8) as $P_category_panel_product)
                                            <div class="col-md-3 col-sm-6 col-xs-12 w-20">
                                                <div class="portfolio-wrapper">
                                                    <div class="portfolio-thumb">
                                                        <img src="{{asset('storage/images/product/'.$P_category_panel_product->image->image1)}}" alt="">
                                                        <div class="portfolio-content">                                            
                                                            <div class="pop-up-icon">                 
                                                                <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                                data-id="{{$P_category_panel_product->id}}"
                                                                data-min_order_qty="{{$P_category_panel_product->min_order_qty}}" 
                                                                data-category="{{$P_category_panel_product->category->categoryName}}" 
                                                                data-brand="{{$P_category_panel_product->brand->brandName}}" 
                                                                data-slug="{{$P_category_panel_product->slug}}" 
                                                                data-name="{{$P_category_panel_product->productName}}" 
                                                                data-image="{{asset('storage/images/product/'.$P_category_panel_product->image->image1)}}" 
                                                                data-desc="{{strip_tags($P_category_panel_product->shortDescription)}}" 
                                                    @if ($P_category_panel_product->discount)
                                                        @if ($P_category_panel_product->deal_id && $P_category_panel_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                
                                                            data-sale="{{number_format($P_category_panel_product->regularPrice-(($P_category_panel_product->regularPrice*($P_category_panel_product->deal->discount_value + $P_category_panel_product->discount))/100), 2)}}"

                                                            data-regular="{{$P_category_panel_product->regularPrice}}"
                                                                 
                                                        @else
                                                                data-sale="{{number_format($P_category_panel_product->regularPrice-(($P_category_panel_product->regularPrice*$P_category_panel_product->discount)/100), 2)}}"
                                                                data-regular="{{$P_category_panel_product->regularPrice}}"

                                                        @endif
                                                    @else
                                                        @if ($P_category_panel_product->deal_id && $P_category_panel_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            data-sale="{{number_format($P_category_panel_product->regularPrice-(($P_category_panel_product->regularPrice*$P_category_panel_product->deal->discount_value)/100), 2)}}"
                                                            data-regular="{{$P_category_panel_product->regularPrice}}"
                                                        @else
                                                            data-regular="{{$P_category_panel_product->regularPrice}}"
                                                        @endif
                                                    @endif  
                                                                data-url="{{url('product/'.$P_category_panel_product->id.'/'.$P_category_panel_product->slug)}}"><i class="fa fa-search"></i></a>

                                                                <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$P_category_panel_product->slug}}" title="Add To Wishlist" data-id="{{$P_category_panel_product->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                                <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$P_category_panel_product->slug}}" title="Add To Cart" data-id="{{$P_category_panel_product->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3> 
                                                            <a class="title-3 fsz-12" href="{{url('product/'.$P_category_panel_product->id.'/'.$P_category_panel_product->slug)}}">
                                                                {{substr($P_category_panel_product->productName, 0, 35)}}
                                                            </a> 
                                                        </h3>
                                                        <p class="font-2 fsz-10">
                                                            @if ($P_category_panel_product->discount)
                                                                @if ($P_category_panel_product->deal_id && $P_category_panel_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    <span class="thm-clr"> Tk {{number_format($P_category_panel_product->regularPrice-(($P_category_panel_product->regularPrice*($P_category_panel_product->deal->discount_value + $P_category_panel_product->discount))/100))}}</span>
                                                                    &nbsp;    
                                                                    <span class="thm-clr line-through"> Tk {{number_format($P_category_panel_product->regularPrice)}}</span>   
                                                                @else
                                                                    <span class="thm-clr"> Tk {{number_format($P_category_panel_product->regularPrice-(($P_category_panel_product->regularPrice*$P_category_panel_product->discount)/100))}}</span>
                                                                    &nbsp; 
                                                                    <span class="thm-clr line-through"> Tk {{number_format($P_category_panel_product->regularPrice)}}</span>        
                                                                @endif
                                                            @else
                                                                @if ($P_category_panel_product->deal_id && $P_category_panel_product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    <span class="thm-clr"> Tk {{number_format($P_category_panel_product->regularPrice-(($P_category_panel_product->regularPrice*$P_category_panel_product->deal->discount_value)/100))}}</span> 
                                                                    &nbsp;    
                                                                    <span class="thm-clr line-through"> Tk {{number_format($P_category_panel_product->regularPrice)}}</span>   
                                                                @else
                                                                    <span class="thm-clr"> Tk {{number_format($P_category_panel_product->regularPrice)}}</span>    
                                                                @endif
                                                            @endif
                                                            <a href="#" class="compare-add-to-cart right-link addCart" data-placement="top" data-slug="{{$P_category_panel_product->slug}}" title="Add To Cart" data-id="{{$P_category_panel_product->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="fa fa-shopping-cart"></i></a>
                                                            <a class="compare-add-to-cart left-link addWishlist" href="#" data-placement="top" data-slug="{{$P_category_panel_product->slug}}" title="Add To Wishlist" data-id="{{$P_category_panel_product->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a> 
                                                        </p>    
                                                    </div>
                                                </div>
                                            </div>                                     
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach 
                    </div>
                </div>
            </div>
        </section>
        <!-- all product End-->

        <!-- Banner / Ads -->
        @if ($banner)
            <section class="banner clear" style="margin-top: 13px;">
                <div class="col-lg-4 col-md-4 col-sm-12 no-padding promo-wrap">
                    <div class="gst-promo gst-color-white">
                        <img src="{{asset('storage/images/banner/'.$banner->home_one)}}" alt="" />
                        <div class="vertical-align-div gst-promo-text col-lg-8 right">
                            <div>
                                <div class="vertical-align-text">
                                    <a href="{{url($banner->home_one_link)}}" class="fancy-btn fancy-btn-small mb-10">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 no-padding promo-wrap">
                    <div class="gst-promo gst-color-white">
                        <img src="{{asset('storage/images/banner/'.$banner->home_two)}}" alt="" />

                        <div class="vertical-align-div gst-promo-text col-lg-8 right">
                            <div>
                                <div class="vertical-align-text">
                                    <a href="{{url($banner->home_two_link)}}" class="fancy-btn fancy-btn-small mb-10">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 no-padding promo-wrap">
                    <div class="gst-promo gst-color-white">
                        <img src="{{asset('storage/images/banner/'.$banner->home_three)}}" alt="" />
                        <div class="vertical-align-div gst-promo-text col-lg-8 right">
                            <div>
                                <div class="vertical-align-text">
                                    <a href="{{url($banner->home_three_link)}}" class="fancy-btn fancy-btn-small mb-10">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- / Banner -->

        <!-- Lucky Today Slider -->
        <section class="gst-row row-bikes clear"> 
            <div class="products-wrap text-center">
                <div class="fancy-heading text-center">
                    <h3><span class="thm-clr">LUCKY </span> TODAY</h3>
                    <h5 class="funky-font-2">Trending Products</h5>
                    <i class="thm-clr fsz-20 fa fa-angle-double-down"></i>
                </div>
                @if (count($offers))
                    <!-- Portfolio items -->
                    {{-- <div class="products-slider nav-2">
                        @foreach ($offers as $offer)
                            @foreach ($offer->products as $offerProduct)
                                <div class="product">
                                    <div class="product-media" style="padding:unset;">
                                        <div class="icon-luky-label luky-left">
                                            @if ($offer->extra_offer == 1)
                                                buy & get
                                            @endif
                                            @if ($offer->extra_offer == 2)
                                            Free shipping
                                            @endif

                                        </div>
                                        @php
                                            $end = \Carbon\Carbon::parse($offer->valid_until);
                                        @endphp
                                        
                                        <div class="icon-luky-label luky-right">
                                            <div class="flex spcbt-30" >
                                                <div class="count-down text-center">
                                                    <div class="flex flex-1" data-countdown1="{{$end}}"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="icon-luky-label luky-left1">
                                            Extra {{$offer->discount_value}} %
                                        </div>


                                        <img class="" src="{{asset('storage/images/product/'.$offerProduct->image->image1)}}" alt="{{$offerProduct->productName}}" />                                             
                                    </div>
                                    <div class="product-content">
                                        <h3> <a href="{{url('product/'.$offerProduct->id.'/'.$offerProduct->slug)}}" class="title-2 fsz-12">{{$offerProduct->productName}}</a> </h3>
                                        <p class="font-2"> 
                                            @if ($offerProduct->discount)
                                                @if ($offerProduct->deal_id && $offerProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                    <span class="thm-clr">
                                                        Tk {{number_format($offerProduct->regularPrice-(($offerProduct->regularPrice*( $offer->discount_value + $offerProduct->deal->discount_value + $offerProduct->discount))/100), 2)}}
                                                    </span>    
                                                    <span class="thm-clr line-through"> Tk {{number_format($offerProduct->regularPrice, 2)}}</span>   
                                                @else
                                                    <span class="thm-clr">
                                                        Tk {{number_format($offerProduct->regularPrice-(($offerProduct->regularPrice*($offer->discount_value + $offerProduct->discount))/100), 2)}}
                                                    </span>
                                                    <span class="thm-clr line-through"> Tk {{number_format($offerProduct->regularPrice, 2)}}</span>        
                                                @endif
                                            @else
                                                @if ($offerProduct->deal_id && $offerProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                    <span class="thm-clr"> 
                                                        Tk {{number_format($offerProduct->regularPrice-(($offerProduct->regularPrice*( $offer->discount_value + $offerProduct->deal->discount_value))/100), 2)}}
                                                    </span>    
                                                    <span class="thm-clr line-through"> Tk {{number_format($offerProduct->regularPrice, 2)}}</span>   
                                                @else
                                                    <span class="thm-clr"> 
                                                        Tk {{number_format($offerProduct->regularPrice-(($offerProduct->regularPrice*( $offer->discount_value))/100), 2)}}
                                                    </span>    
                                                @endif
                                            @endif
                                        </p>    
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div> --}}

                    <div class="owl-carousel-luckytoday-product">
                        @foreach ($offers as $offer)
                            @foreach ($offer->products as $offerProduct)
                                <div class="product">
                                    <div>
                                        <div class="icon-luky-label luky-left">
                                            @if ($offer->extra_offer == 1)
                                                buy & get
                                            @endif
                                            @if ($offer->extra_offer == 2)
                                            Free shipping
                                            @endif

                                        </div>
                                        @php
                                            $end = \Carbon\Carbon::parse($offer->valid_until);
                                        @endphp
                                        
                                        <div class="icon-luky-label luky-right">
                                            <div class="flex spcbt-30" >
                                                <div class="count-down text-center">
                                                    <div class="flex flex-1" data-countdown1="{{$end}}"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="icon-luky-label luky-left1">
                                            Extra {{$offer->discount_value}} %
                                        </div>
                                        <img src="{{url('storage/images/product/'.$offerProduct->image->image1)}}" alt="" />                                                 
                                    </div>
                                    <div class="product-content text-center">
                                        <a class="" href="{{url('product/'.$offerProduct->id.'/'.$offerProduct->slug)}}" class="fsz-12"> 
                                            <span class="" style="font-size:12px;!important">{{substr($offerProduct->productName, 0, 26)}}</span> 
                                        </a>
                                        <p class="font-3 fsz-13">
                                            @if ($offerProduct->discount)
                                                @if ($offerProduct->deal_id && $offerProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                    <span class="thm-clr">
                                                        Tk {{number_format($offerProduct->regularPrice-(($offerProduct->regularPrice*($offerProduct->deal->discount_value + $offerProduct->discount))/100), 2)}}
                                                    </span>    
                                                    <span class="thm-clr line-through"> Tk {{number_format( $offerProduct->regularPrice)}}</span>   
                                                @else
                                                    <span class="thm-clr">
                                                        Tk {{number_format($offerProduct->regularPrice-(($offerProduct->regularPrice*$offerProduct->discount)/100), 2)}}
                                                    </span>
                                                    <span class="thm-clr line-through"> Tk {{number_format($offerProduct->regularPrice)}}</span>
                                                @endif
                                            @else
                                                @if ($offerProduct->deal_id && $offerProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                    <span class="thm-clr"> 
                                                        Tk {{number_format($offerProduct->regularPrice-(($offerProduct->regularPrice*$offerProduct->deal->discount_value)/100), 2)}}
                                                    </span>    
                                                    <span class="thm-clr line-through"> Tk {{number_format($offerProduct->regularPrice)}}</span>   
                                                @else
                                                    <span class="thm-clr"> Tk {{number_format($offerProduct->regularPrice,2)}}</span>    
                                                @endif
                                            @endif
                                        </p>    
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                @else
                    <h3><span class="thm-clr"> No offers available for Today </span></h3>
                @endif
            </div>           
        </section>
        <!-- / Lucky Today -->

        <!-- special discount Start-->
        <section class="gst-row row-bikes clear">
            <div class="container theme-container">
                <div class="gst-column col-lg-12 no-padding text-center">
                    <div class="fancy-heading text-center">
                        <h3><span class="thm-clr">special </span> discount</h3>
                        <h5 class="funky-font-2">Trending Products</h5>
                    </div>

                    <div class="theme-container container">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs fsz-13" role="tablist">
                          <li class="active"><a href="#allSpecialDiscount" aria-controls="allSpecialDiscount" role="tab" data-toggle="tab">ALL</a></li>
                          <li><a href="#b1-g1" aria-controls="b1-g1" role="tab" data-toggle="tab">BUY & GET FREE</a></li>
                          <li><a href="#occasion" aria-controls="occasion" role="tab" data-toggle="tab">OCCASION</a></li>
                          <li><a href="#promotion" aria-controls="promotion" role="tab" data-toggle="tab">PROMOTION</a></li>
                          <li><a href="#clearance" aria-controls="clearance" role="tab" data-toggle="tab">CLEARANCE</a></li>
                          <li><a href="#combo" aria-controls="combo" role="tab" data-toggle="tab">COMBO</a></li>
                          <li><a href="#bundleOffer" aria-controls="bundleOffer" role="tab" data-toggle="tab">BUNDLE OFFER</a></li>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content ">
                        <div role="tabpanel" class="tab-pane active" id="allSpecialDiscount">
                            <div class="site-tab">
                                <div class="container text-center">
                                    <!-- Portfolio items -->
                                    @foreach ($allSpecialDiscounts as $allSpecialDiscountProduct)
                                        <div class="col-md-3 col-sm-6 col-xs-12 w-20">
                                            <div class="portfolio-wrapper">
                                                <div class="portfolio-thumb">
                                                    <img src="{{asset('storage/images/product/'.$allSpecialDiscountProduct->image->image1)}}" alt="">
                                                    <div class="portfolio-content">                                            
                                                        <div class="pop-up-icon">                 
                                                            <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                            data-id="{{$allSpecialDiscountProduct->id}}" 
                                                            data-min_order_qty="{{$allSpecialDiscountProduct->min_order_qty}}" 
                                                            data-category="{{$allSpecialDiscountProduct->category->categoryName}}" 
                                                            data-brand="{{$allSpecialDiscountProduct->brand->brandName}}"                                                             
                                                            data-slug="{{$allSpecialDiscountProduct->slug}}" 
                                                            data-name="{{$allSpecialDiscountProduct->productName}}" 
                                                            data-image="{{asset('storage/images/product/'.$allSpecialDiscountProduct->image->image1)}}" 
                                                            data-desc="{{strip_tags($allSpecialDiscountProduct->shortDescription)}}" 
                                                @if ($allSpecialDiscountProduct->discount)
                                                    @if ($allSpecialDiscountProduct->deal_id && $allSpecialDiscountProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            
                                                        data-sale="{{number_format($allSpecialDiscountProduct->regularPrice-(($allSpecialDiscountProduct->regularPrice*($allSpecialDiscountProduct->deal->discount_value + $allSpecialDiscountProduct->discount))/100), 2)}}"

                                                        data-regular="{{$allSpecialDiscountProduct->regularPrice}}"
                                                             
                                                    @else
                                                            data-sale="{{number_format($allSpecialDiscountProduct->regularPrice-(($allSpecialDiscountProduct->regularPrice*$allSpecialDiscountProduct->discount)/100), 2)}}"
                                                            data-regular="{{$allSpecialDiscountProduct->regularPrice}}"

                                                    @endif
                                                @else
                                                    @if ($allSpecialDiscountProduct->deal_id && $allSpecialDiscountProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        data-sale="{{number_format($allSpecialDiscountProduct->regularPrice-(($allSpecialDiscountProduct->regularPrice*$allSpecialDiscountProduct->deal->discount_value)/100), 2)}}"
                                                        data-regular="{{$allSpecialDiscountProduct->regularPrice}}"
                                                    @else
                                                        data-regular="{{$allSpecialDiscountProduct->regularPrice}}"
                                                    @endif
                                                @endif 
                                                            data-url="{{url('product/'.$allSpecialDiscountProduct->id.'/'.$allSpecialDiscountProduct->slug)}}"><i class="fa fa-search"></i></a>

                                                            <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$allSpecialDiscountProduct->slug}}" title="Add To Wishlist" data-id="{{$allSpecialDiscountProduct->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                            <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$allSpecialDiscountProduct->slug}}" title="Add To Cart" data-id="{{$allSpecialDiscountProduct->id}}" data-url="{{url('/add-cart')}}" data-qty="2"><i class="cart-icn"> </i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3> 
                                                        <a class="title-3 fsz-12" href="{{url('product/'.$allSpecialDiscountProduct->id.'/'.$allSpecialDiscountProduct->slug)}}">
                                                            {{substr($allSpecialDiscountProduct->productName, 0, 35)}}
                                                        </a> 
                                                    </h3>
                                                    <p class="font-2"> 
                                                        @if ($allSpecialDiscountProduct->discount)
                                                            @if ($allSpecialDiscountProduct->deal_id && $allSpecialDiscountProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($allSpecialDiscountProduct->regularPrice-(($allSpecialDiscountProduct->regularPrice*($allSpecialDiscountProduct->deal->discount_value + $allSpecialDiscountProduct->discount))/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($allSpecialDiscountProduct->regularPrice, 2)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($allSpecialDiscountProduct->regularPrice-(($allSpecialDiscountProduct->regularPrice*$allSpecialDiscountProduct->discount)/100), 2)}}</span>
                                                                <span class="thm-clr line-through"> Tk {{number_format($allSpecialDiscountProduct->regularPrice, 2)}}</span>        
                                                            @endif
                                                        @else
                                                            @if ($allSpecialDiscountProduct->deal_id && $allSpecialDiscountProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($allSpecialDiscountProduct->regularPrice-(($allSpecialDiscountProduct->regularPrice*$allSpecialDiscountProduct->deal->discount_value)/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($allSpecialDiscountProduct->regularPrice, 2)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($allSpecialDiscountProduct->regularPrice, 2)}}</span>    
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
                        <div role="tabpanel" class="tab-pane" id="b1-g1">
                            <div class="site-tab">
                                <div class="container text-center">
                                    <!-- Portfolio items -->
                                    @foreach ($buyGetProducts as $buyGetProduct)
                                        <div class="col-md-3 col-sm-6 col-xs-12 w-20">
                                            <div class="portfolio-wrapper">
                                                <div class="portfolio-thumb">
                                                    <img src="{{asset('storage/images/product/'.$buyGetProduct->image->image1)}}" alt="">
                                                    <div class="portfolio-content">                                            
                                                        <div class="pop-up-icon">                 
                                                            <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                            data-id="{{$buyGetProduct->id}}"
                                                            data-min_order_qty="{{$buyGetProduct->min_order_qty}}" 
                                                            data-category="{{$buyGetProduct->category->categoryName}}" 
                                                            data-brand="{{$buyGetProduct->brand->brandName}}" 
                                                            data-slug="{{$buyGetProduct->slug}}" 
                                                            data-name="{{$buyGetProduct->productName}}" 
                                                            data-image="{{asset('storage/images/product/'.$buyGetProduct->image->image1)}}" 
                                                            data-desc="{{strip_tags($buyGetProduct->shortDescription)}}" 
                                                @if ($buyGetProduct->discount)
                                                    @if ($buyGetProduct->deal_id && $buyGetProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            
                                                        data-sale="{{number_format($buyGetProduct->regularPrice-(($buyGetProduct->regularPrice*($buyGetProduct->deal->discount_value + $buyGetProduct->discount))/100), 2)}}"

                                                        data-regular="{{$buyGetProduct->regularPrice}}"
                                                             
                                                    @else
                                                            data-sale="{{number_format($buyGetProduct->regularPrice-(($buyGetProduct->regularPrice*$buyGetProduct->discount)/100), 2)}}"
                                                            data-regular="{{$buyGetProduct->regularPrice}}"

                                                    @endif
                                                @else
                                                    @if ($buyGetProduct->deal_id && $buyGetProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        data-sale="{{number_format($buyGetProduct->regularPrice-(($buyGetProduct->regularPrice*$buyGetProduct->deal->discount_value)/100), 2)}}"
                                                        data-regular="{{$buyGetProduct->regularPrice}}"
                                                    @else
                                                        data-regular="{{$buyGetProduct->regularPrice}}"
                                                    @endif
                                                @endif  
                                                            data-url="{{url('product/'.$buyGetProduct->id.'/'.$buyGetProduct->slug)}}"><i class="fa fa-search"></i></a>

                                                            <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$buyGetProduct->slug}}" title="Add To Wishlist" data-id="{{$buyGetProduct->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                            <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$buyGetProduct->slug}}" title="Add To Cart" data-id="{{$buyGetProduct->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3> 
                                                        <a class="title-3 fsz-12" href="{{url('product/'.$buyGetProduct->id.'/'.$buyGetProduct->slug)}}">
                                                            {{substr($buyGetProduct->productName, 0, 35)}}
                                                        </a> 
                                                    </h3>
                                                    <p class="font-2">
                                                        @if ($buyGetProduct->discount)
                                                            @if ($buyGetProduct->deal_id && $buyGetProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($buyGetProduct->regularPrice-(($buyGetProduct->regularPrice*($buyGetProduct->deal->discount_value + $buyGetProduct->discount))/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($buyGetProduct->regularPrice, 2)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($buyGetProduct->regularPrice-(($buyGetProduct->regularPrice*$buyGetProduct->discount)/100), 2)}}</span>
                                                                <span class="thm-clr line-through"> Tk {{number_format($buyGetProduct->regularPrice, 2)}}</span>        
                                                            @endif
                                                        @else
                                                            @if ($buyGetProduct->deal_id && $buyGetProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($buyGetProduct->regularPrice-(($buyGetProduct->regularPrice*$buyGetProduct->deal->discount_value)/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($buyGetProduct->regularPrice, 2)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($buyGetProduct->regularPrice, 2)}}</span>    
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
                        <div role="tabpanel" class="tab-pane" id="occasion">
                            <div class="site-tab">
                                <div class="container text-center">
                                    <!-- Portfolio items -->
                                    @foreach ($occasionProducts as $occasionProduct)
                                        <div class="col-md-3 col-sm-6 col-xs-12 w-20">
                                            <div class="portfolio-wrapper">
                                                <div class="portfolio-thumb">
                                                    <img src="{{asset('storage/images/product/'.$occasionProduct->image->image1)}}" alt="">
                                                    <div class="portfolio-content">                                            
                                                        <div class="pop-up-icon">                 
                                                            <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                            data-id="{{$occasionProduct->id}}" 
                                                            data-min_order_qty="{{$occasionProduct->min_order_qty}}" 
                                                            data-category="{{$occasionProduct->category->categoryName}}" 
                                                            data-brand="{{$occasionProduct->brand->brandName}}"                                                             
                                                            data-slug="{{$occasionProduct->slug}}" 
                                                            data-name="{{$occasionProduct->productName}}" 
                                                            data-image="{{asset('storage/images/product/'.$occasionProduct->image->image1)}}" 
                                                            data-desc="{{strip_tags($occasionProduct->shortDescription)}}" 
                                                @if ($occasionProduct->discount)
                                                    @if ($occasionProduct->deal_id && $occasionProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            
                                                        data-sale="{{number_format($occasionProduct->regularPrice-(($occasionProduct->regularPrice*($occasionProduct->deal->discount_value + $occasionProduct->discount))/100), 2)}}"

                                                        data-regular="{{$occasionProduct->regularPrice}}"
                                                             
                                                    @else
                                                            data-sale="{{number_format($occasionProduct->regularPrice-(($occasionProduct->regularPrice*$occasionProduct->discount)/100), 2)}}"
                                                            data-regular="{{$occasionProduct->regularPrice}}"

                                                    @endif
                                                @else
                                                    @if ($occasionProduct->deal_id && $occasionProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        data-sale="{{number_format($occasionProduct->regularPrice-(($occasionProduct->regularPrice*$occasionProduct->deal->discount_value)/100), 2)}}"
                                                        data-regular="{{$occasionProduct->regularPrice}}"
                                                    @else
                                                        data-regular="{{$occasionProduct->regularPrice}}"
                                                    @endif
                                                @endif 
                                                            data-url="{{url('product/'.$occasionProduct->id.'/'.$occasionProduct->slug)}}"><i class="fa fa-search"></i></a>

                                                            <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$occasionProduct->slug}}" title="Add To Wishlist" data-id="{{$occasionProduct->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                            <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$occasionProduct->slug}}" title="Add To Cart" data-id="{{$occasionProduct->id}}" data-url="{{url('/add-cart')}}" data-qty="2"><i class="cart-icn"> </i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3> 
                                                        <a class="title-3 fsz-12" href="{{url('product/'.$occasionProduct->id.'/'.$occasionProduct->slug)}}">
                                                            {{substr($occasionProduct->productName, 0, 35)}}
                                                        </a> 
                                                    </h3>
                                                    <p class="font-2"> 
                                                        @if ($occasionProduct->discount)
                                                            @if ($occasionProduct->deal_id && $occasionProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($occasionProduct->regularPrice-(($occasionProduct->regularPrice*($occasionProduct->deal->discount_value + $occasionProduct->discount))/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($occasionProduct->regularPrice, 0)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($occasionProduct->regularPrice-(($occasionProduct->regularPrice*$occasionProduct->discount)/100), 2)}}</span>
                                                                <span class="thm-clr line-through"> Tk {{number_format($occasionProduct->regularPrice, 0)}}</span>        
                                                            @endif
                                                        @else
                                                            @if ($occasionProduct->deal_id && $occasionProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($occasionProduct->regularPrice-(($occasionProduct->regularPrice*$occasionProduct->deal->discount_value)/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($occasionProduct->regularPrice, 0)}}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($occasionProduct->regularPrice, 0)}}</span>    
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
                        <div role="tabpanel" class="tab-pane" id="promotion">
                            <div class="site-tab">
                                <div class="container text-center">
                                    <!-- Portfolio items -->
                                    @foreach ($promotionProducts as $promotionProduct)
                                        <div class="col-md-3 col-sm-6 col-xs-12 w-20">
                                            <div class="portfolio-wrapper">
                                                <div class="portfolio-thumb">
                                                    <img src="{{asset('storage/images/product/'.$promotionProduct->image->image1)}}" alt="">
                                                    <div class="portfolio-content">                                            
                                                        <div class="pop-up-icon">                 
                                                            <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                            data-id="{{$promotionProduct->id}}" 
                                                            data-min_order_qty="{{$promotionProduct->min_order_qty}}" 
                                                            data-category="{{$promotionProduct->category->categoryName}}" 
                                                            data-brand="{{$promotionProduct->brand->brandName}}"                                                            
                                                            data-slug="{{$promotionProduct->slug}}" 
                                                            data-name="{{$promotionProduct->productName}}" 
                                                            data-image="{{asset('storage/images/product/'.$promotionProduct->image->image1)}}" 
                                                            data-desc="{{strip_tags($promotionProduct->shortDescription)}}" 
                                                @if ($promotionProduct->discount)
                                                    @if ($promotionProduct->deal_id && $promotionProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            
                                                        data-sale="{{number_format($promotionProduct->regularPrice-(($promotionProduct->regularPrice*($promotionProduct->deal->discount_value + $promotionProduct->discount))/100), 2)}}"

                                                        data-regular="{{$promotionProduct->regularPrice}}"
                                                             
                                                    @else
                                                            data-sale="{{number_format($promotionProduct->regularPrice-(($promotionProduct->regularPrice*$promotionProduct->discount)/100), 2)}}"
                                                            data-regular="{{$promotionProduct->regularPrice}}"

                                                    @endif
                                                @else
                                                    @if ($promotionProduct->deal_id && $promotionProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        data-sale="{{number_format($promotionProduct->regularPrice-(($promotionProduct->regularPrice*$promotionProduct->deal->discount_value)/100), 2)}}"
                                                        data-regular="{{$promotionProduct->regularPrice}}"
                                                    @else
                                                        data-regular="{{$promotionProduct->regularPrice}}"
                                                    @endif
                                                @endif 
                                                            data-url="{{url('product/'.$promotionProduct->id.'/'.$promotionProduct->slug)}}"><i class="fa fa-search"></i></a>

                                                            <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$promotionProduct->slug}}" title="Add To Wishlist" data-id="{{$promotionProduct->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                            <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$promotionProduct->slug}}" title="Add To Cart" data-id="{{$promotionProduct->id}}" data-url="{{url('/add-cart')}}" data-qty="2"><i class="cart-icn"> </i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3> 
                                                        <a class="title-3 fsz-12" href="{{url('product/'.$promotionProduct->id.'/'.$promotionProduct->slug)}}">
                                                            {{substr($promotionProduct->productName, 0, 35)}}
                                                        </a> 
                                                    </h3>
                                                    <p class="font-2"> 
                                                        @if ($promotionProduct->discount)
                                                            @if ($promotionProduct->deal_id && $promotionProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($promotionProduct->regularPrice-(($promotionProduct->regularPrice*($promotionProduct->deal->discount_value + $promotionProduct->discount))/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($promotionProduct->regularPrice, 2)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($promotionProduct->regularPrice-(($promotionProduct->regularPrice*$promotionProduct->discount)/100), 2)}}</span>
                                                                <span class="thm-clr line-through"> Tk {{number_format($promotionProduct->regularPrice, 2)}}</span>        
                                                            @endif
                                                        @else
                                                            @if ($promotionProduct->deal_id && $promotionProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($promotionProduct->regularPrice-(($promotionProduct->regularPrice*$promotionProduct->deal->discount_value)/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($promotionProduct->regularPrice, 2)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($promotionProduct->regularPrice, 2)}}</span>    
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
                        <div role="tabpanel" class="tab-pane" id="clearance">
                            <div class="site-tab">
                                <div class="container text-center">
                                    <!-- Portfolio items -->
                                    @foreach ($clearanceProducts as $clearanceProduct)
                                        <div class="col-md-3 col-sm-6 col-xs-12 w-20">
                                            <div class="portfolio-wrapper">
                                                <div class="portfolio-thumb">
                                                    <img src="{{asset('storage/images/product/'.$clearanceProduct->image->image1)}}" alt="">
                                                    <div class="portfolio-content">                                            
                                                        <div class="pop-up-icon">                 
                                                            <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                            data-id="{{$clearanceProduct->id}}"
                                                            data-min_order_qty="{{$clearanceProduct->min_order_qty}}" 
                                                            data-category="{{$clearanceProduct->category->categoryName}}" 
                                                            data-brand="{{$clearanceProduct->brand->brandName}}"                                                             
                                                            data-slug="{{$clearanceProduct->slug}}" 
                                                            data-name="{{$clearanceProduct->productName}}" 
                                                            data-image="{{asset('storage/images/product/'.$clearanceProduct->image->image1)}}" 
                                                            data-desc="{{strip_tags($clearanceProduct->shortDescription)}}" 
                                                        @if ($clearanceProduct->discount)
                                                            @if ($clearanceProduct->deal_id && $clearanceProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    
                                                                data-sale="{{number_format($clearanceProduct->regularPrice-(($clearanceProduct->regularPrice*($clearanceProduct->deal->discount_value + $clearanceProduct->discount))/100), 2)}}"
        
                                                                data-regular="{{$clearanceProduct->regularPrice}}"
                                                                     
                                                            @else
                                                                    data-sale="{{number_format($clearanceProduct->regularPrice-(($clearanceProduct->regularPrice*$clearanceProduct->discount)/100), 2)}}"
                                                                    data-regular="{{$clearanceProduct->regularPrice}}"
        
                                                            @endif
                                                        @else
                                                            @if ($clearanceProduct->deal_id && $clearanceProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                data-sale="{{number_format($clearanceProduct->regularPrice-(($clearanceProduct->regularPrice*$clearanceProduct->deal->discount_value)/100), 2)}}"
                                                                data-regular="{{$clearanceProduct->regularPrice}}"
                                                            @else
                                                                data-regular="{{$clearanceProduct->regularPrice}}"
                                                            @endif
                                                        @endif 
                                                            data-url="{{url('product/'.$clearanceProduct->id.'/'.$clearanceProduct->slug)}}"><i class="fa fa-search"></i></a>

                                                            <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$clearanceProduct->slug}}" title="Add To Wishlist" data-id="{{$clearanceProduct->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                            <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$clearanceProduct->slug}}" title="Add To Cart" data-id="{{$clearanceProduct->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3> 
                                                        <a class="title-3 fsz-12" href="{{url('product/'.$clearanceProduct->id.'/'.$clearanceProduct->slug)}}">
                                                            {{substr($clearanceProduct->productName, 0, 35)}}
                                                        </a> 
                                                    </h3>
                                                    <p class="font-2"> 
                                                        @if ($clearanceProduct->discount)
                                                            @if ($clearanceProduct->deal_id && $clearanceProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($clearanceProduct->regularPrice-(($clearanceProduct->regularPrice*($clearanceProduct->deal->discount_value + $clearanceProduct->discount))/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($clearanceProduct->regularPrice, 2)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($clearanceProduct->regularPrice-(($clearanceProduct->regularPrice*$clearanceProduct->discount)/100), 2)}}</span>
                                                                <span class="thm-clr line-through"> Tk {{number_format($clearanceProduct->regularPrice, 2)}}</span>        
                                                            @endif
                                                        @else
                                                            @if ($clearanceProduct->deal_id && $clearanceProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($clearanceProduct->regularPrice-(($clearanceProduct->regularPrice*$clearanceProduct->deal->discount_value)/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($clearanceProduct->regularPrice, 2)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($clearanceProduct->regularPrice, 2)}}</span>    
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
                        <div role="tabpanel" class="tab-pane" id="combo">
                            <div class="site-tab">
                                <div class="container text-center">
                                    <!-- Portfolio items -->
                                    @foreach ($comboProducts as $comboProduct)
                                        <div class="col-md-3 col-sm-6 col-xs-12 w-20">
                                            <div class="portfolio-wrapper">
                                                <div class="portfolio-thumb">
                                                    <img src="{{asset('storage/images/product/'.$comboProduct->image->image1)}}" alt="">
                                                    <div class="portfolio-content">                                            
                                                        <div class="pop-up-icon">                 
                                                            <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                            data-id="{{$comboProduct->id}}"
                                                            data-min_order_qty="{{$comboProduct->min_order_qty}}" 
                                                            data-category="{{$comboProduct->category->categoryName}}" 
                                                            data-brand="{{$comboProduct->brand->brandName}}"                                                             
                                                            data-slug="{{$comboProduct->slug}}" 
                                                            data-name="{{$comboProduct->productName}}" 
                                                            data-image="{{asset('storage/images/product/'.$comboProduct->image->image1)}}" 
                                                            data-desc="{{strip_tags($comboProduct->shortDescription)}}" 
                                                        @if ($comboProduct->discount)
                                                            @if ($comboProduct->deal_id && $comboProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    
                                                                data-sale="{{number_format($comboProduct->regularPrice-(($comboProduct->regularPrice*($comboProduct->deal->discount_value + $comboProduct->discount))/100), 2)}}"
        
                                                                data-regular="{{$comboProduct->regularPrice}}"
                                                                     
                                                            @else
                                                                    data-sale="{{number_format($comboProduct->regularPrice-(($comboProduct->regularPrice*$comboProduct->discount)/100), 2)}}"
                                                                    data-regular="{{$comboProduct->regularPrice}}"
        
                                                            @endif
                                                        @else
                                                            @if ($comboProduct->deal_id && $comboProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                data-sale="{{number_format($comboProduct->regularPrice-(($comboProduct->regularPrice*$comboProduct->deal->discount_value)/100), 2)}}"
                                                                data-regular="{{$comboProduct->regularPrice}}"
                                                            @else
                                                                data-regular="{{$comboProduct->regularPrice}}"
                                                            @endif
                                                        @endif 
                                                            data-url="{{url('product/'.$comboProduct->id.'/'.$comboProduct->slug)}}"><i class="fa fa-search"></i></a>

                                                            <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$comboProduct->slug}}" title="Add To Wishlist" data-id="{{$comboProduct->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                            <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$comboProduct->slug}}" title="Add To Cart" data-id="{{$comboProduct->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3> 
                                                        <a class="title-3 fsz-12" href="{{url('product/'.$comboProduct->id.'/'.$comboProduct->slug)}}">
                                                            {{substr($comboProduct->productName, 0, 35)}}
                                                        </a> 
                                                    </h3>
                                                    <p class="font-2"> 
                                                        @if ($comboProduct->discount)
                                                            @if ($comboProduct->deal_id && $comboProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($comboProduct->regularPrice-(($comboProduct->regularPrice*($comboProduct->deal->discount_value + $comboProduct->discount))/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($comboProduct->regularPrice, 2)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($comboProduct->regularPrice-(($comboProduct->regularPrice*$comboProduct->discount)/100), 2)}}</span>
                                                                <span class="thm-clr line-through"> Tk {{number_format($comboProduct->regularPrice, 2)}}</span>        
                                                            @endif
                                                        @else
                                                            @if ($comboProduct->deal_id && $comboProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> Tk {{number_format($comboProduct->regularPrice-(($comboProduct->regularPrice*$comboProduct->deal->discount_value)/100), 2)}}</span>    
                                                                <span class="thm-clr line-through"> Tk {{number_format($comboProduct->regularPrice, 2)}}</span>   
                                                            @else
                                                                <span class="thm-clr"> Tk {{number_format($comboProduct->regularPrice, 2)}}</span>    
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
                        <div role="tabpanel" class="tab-pane" id="bundleOffer">
                            <div class="site-tab">
                                <div class="container">
                                    @foreach ($categories as $bundleOfferCategory)
                                        @php
                                           $bundleOffers= \App\Bundleoffer::select('products.productName','products.id', 'products.slug')->distinct('products.productName')->where('category_id', $bundleOfferCategory->id)->leftJoin('products', 'products.id', '=', 'bundleoffers.product_id')->take(8)->get();
                                            
                                        @endphp
                                        @if(count($bundleOffers)>0)
                                            @php
                                                $i++;
                                            @endphp

                                            @if($i > 6 )
                                                <div class="col-lg-2 col-md-3 col-sm-3" style="width: 12.5%">
                                                    <ul>
                                                        <li class="blk-clr text-center fsz-10" style="border-bottom: #999 1px solid;">{{$bundleOfferCategory->categoryName}}</li>
                                                        {{-- <li role="separator" class="divider"></li> --}}
                                                        @foreach ($bundleOffers as $bundleOffer)
                                                        <a href="{{url('product/'.$bundleOffer->id.'/'.$bundleOffer->slug)}}">
                                                                <li class="text-left">
                                                                    <i class="fa fa-circle fsz-6" aria-hidden="true"></i> &nbsp;
                                                                    <span class="fsz-8">
                                                                        {{substr($bundleOffer->productName, 0,21)}}
                                                                    </span>
                                                                </li>
                                                            </a>
                                                        @endforeach
                                                    </ul>
                                                </div>                                                    
                                            @else    
                                                <div class="col-lg-2 col-md-3 col-sm-3">
                                                    <ul>
                                                        <li class="blk-clr text-center fsz-10" style="border-bottom: #999 1px solid;">{{$bundleOfferCategory->categoryName}}</li>
                                                        {{-- <li role="separator" class="divider"></li> --}}
                                                        @foreach ($bundleOffers as $bundleOffer)
                                                        <a href="{{url('product/'.$bundleOffer->id.'/'.$bundleOffer->slug)}}">
                                                                <li class="text-left">
                                                                    <i class="fa fa-circle fsz-6" aria-hidden="true"></i> &nbsp;
                                                                    <span class="fsz-8">
                                                                        {{substr($bundleOffer->productName, 0,32)}}
                                                                    </span>
                                                                </li>
                                                            </a>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- special discount End-->

        <!-- New Arrivals -->
        <section class="gst-row row-arrivals woocommerce ovh">
            <div class="container theme-container">
                <div class="gst-column col-lg-12 no-padding text-center">
                    <div class="fancy-heading text-center">
                        <h3 class="fsz-15"><span class="thm-clr">New</span> Arrivals</h3>
                        <h5 class="funky-font-2">Trending Products</h5>
                    </div>

                    <!-- Filter for items -->
                    <div class="clearfix tabs space-15">
                        <ul class="filtrable products_filter" style="font-size: 9px !important;">
                            <li class="active"><a class="fsz-12" href="#" data-filter=".tab-1">All</a></li>
                            @foreach ($categories->where('categoryName','!=', 'Service & Support') as $category)
                                <li style="text-transform: unset!important;"><a class="fsz-12" href="#" data-filter=".tab-{{$category->id + 1}}">{{$category->categoryName}}</a></li>
                            @endforeach                            
                        </ul>
                    </div>

                    <!-- Portfolio items -->
                    <div class="row isotope isotope-items" id="product-filter">
                        @foreach ($categories->where('categoryName','!=', 'Service & Support') as $categoryP)
                            @foreach ($categoryP->product->where('published', false)->sortByDesc('created_at')->take(2) as $newArrival)
                                <div class="col-md-3 col-sm-6 col-xs-12 isotope-item tab-1 tab-{{$categoryP->id + 1}} w-20">
                                    <div class="portfolio-wrapper">
                                        <div class="portfolio-thumb">
                                            <img src="{{asset('storage/images/product/'.$newArrival->image->image1)}}" alt="">
                                            <div class="portfolio-content">                                            
                                                <div class="pop-up-icon">                 
                                                    <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                    data-id="{{$newArrival->id}}"
                                                    data-min_order_qty="{{$newArrival->min_order_qty}}" 
                                                    data-category="{{$newArrival->category->categoryName}}" 
                                                    data-brand="{{$newArrival->brand->brandName}}"
                                                    data-slug="{{$newArrival->slug}}" 
                                                    data-name="{{$newArrival->productName}}" 
                                                    data-image="{{asset('storage/images/product/'.$newArrival->image->image1)}}" 
                                                    data-desc="{{strip_tags($newArrival->shortDescription)}}" 

                                                @if ($newArrival->discount)
                                                    @if ($newArrival->deal_id && $newArrival->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            
                                                        data-sale="{{number_format($newArrival->regularPrice-(($newArrival->regularPrice*($newArrival->deal->discount_value + $newArrival->discount))/100), 2)}}"

                                                        data-regular="{{$newArrival->regularPrice}}"
                                                             
                                                    @else
                                                            data-sale="{{number_format($newArrival->regularPrice-(($newArrival->regularPrice*$newArrival->discount)/100), 2)}}"
                                                            data-regular="{{$newArrival->regularPrice}}"

                                                    @endif
                                                @else
                                                    @if ($newArrival->deal_id && $newArrival->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        data-sale="{{number_format($newArrival->regularPrice-(($newArrival->regularPrice*$newArrival->deal->discount_value)/100), 2)}}"
                                                        data-regular="{{$newArrival->regularPrice}}"
                                                    @else
                                                        data-regular="{{$newArrival->regularPrice}}"
                                                    @endif
                                                @endif 


                                                    data-url="{{url('product/'.$newArrival->id.'/'.$newArrival->slug)}}"><i class="fa fa-search"></i></a>

                                                    <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$newArrival->slug}}" title="Add To Wishlist" data-id="{{$newArrival->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                    <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$newArrival->slug}}" title="Add To Cart" data-id="{{$newArrival->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3> 
                                                <a class="title-3 fsz-12" href="{{url('product/'.$newArrival->id.'/'.$newArrival->slug)}}">
                                                    {{substr($newArrival->productName, 0, 35)}}
                                                </a> 
                                            </h3>
                                            <p class="font-2">
                                                @if ($newArrival->discount)
                                                    @if ($newArrival->deal_id && $newArrival->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        <span class="thm-clr">
                                                            Tk {{number_format($newArrival->regularPrice-(($newArrival->regularPrice*($newArrival->deal->discount_value + $newArrival->discount))/100), 2)}}
                                                        </span>    
                                                        <span class="thm-clr line-through"> Tk {{number_format($newArrival->regularPrice), 2}}</span>   
                                                    @else
                                                        <span class="thm-clr">
                                                            Tk {{number_format($newArrival->regularPrice-(($newArrival->regularPrice*$newArrival->discount)/100), 2)}}
                                                        </span>
                                                        <span class="thm-clr line-through"> Tk {{number_format($newArrival->regularPrice), 2}}</span>
                                                    @endif
                                                @else
                                                    @if ($newArrival->deal_id && $newArrival->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        <span class="thm-clr"> 
                                                            Tk {{number_format($newArrival->regularPrice-(($newArrival->regularPrice*$newArrival->deal->discount_value)/100), 2)}}
                                                        </span>    
                                                        <span class="thm-clr line-through"> Tk {{number_format($newArrival->regularPrice), 2}}</span>   
                                                    @else
                                                        <span class="thm-clr"> Tk {{number_format($newArrival->regularPrice), 2}}</span>    
                                                    @endif
                                                @endif  
                                            </p>    
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- / New Arrivals -->  

        <!-- Product Slider -->
        {{-- <section class="gst-row row-bikes clear"> 
            <div class="products-wrap text-center">
                <div class="fancy-heading text-center">
                    <h3 class="">Choose Your <span class="thm-clr">Product</span></h3>
                    <h5 class="funky-font-2">Search by type of product</h5>
                    <i class="thm-clr fsz-20 fa fa-angle-double-down"></i>
                </div>

                
                <div class="products-slider nav-2">
                    @foreach ($products as $product)
                        <div class="product">
                            <div class="product-media">
                                <a href="{{url('product/'.$product->id.'/'.$product->slug)}}" class="title-2 fsz-15">
                                    <img class="" src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="{{$product->productName}}" />                                               
                                </a>
                            </div>
                            <div class="product-content">
                                <h3> <a href="{{url('product/'.$product->id.'/'.$product->slug)}}" class="title-2 fsz-12">{{$product->productName}}</a> </h3>
                                <p class="font-2"> 
                                    @if ($product->discount)
                                        @if ($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                            <span class="thm-clr">
                                                Tk {{number_format($product->regularPrice-(($product->regularPrice*($product->deal->discount_value + $product->discount))/100), 2)}}
                                            </span>    
                                            <span class="thm-clr line-through"> Tk {{number_format($product->regularPrice, 2)}}</span>   
                                        @else
                                            <span class="thm-clr">
                                                Tk {{number_format($product->regularPrice-(($product->regularPrice*$product->discount)/100), 2)}}
                                            </span>
                                            <span class="thm-clr line-through"> Tk {{number_format($product->regularPrice, 2)}}</span>        
                                        @endif
                                    @else
                                        @if ($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                            <span class="thm-clr"> 
                                                Tk {{number_format($product->regularPrice-(($product->regularPrice*$product->deal->discount_value)/100), 2)}}
                                            </span>    
                                            <span class="thm-clr line-through"> Tk {{number_format($product->regularPrice, 2)}}</span>   
                                        @else
                                            <span class="thm-clr"> Tk {{number_format($product->regularPrice, 2)}}</span>    
                                        @endif
                                    @endif
                                    <a href="#" class="compare-add-to-cart right-link addCart" data-placement="top" data-slug="{{$product->slug}}" title="Add To Cart" data-id="{{$product->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="compare-add-to-cart left-link addWishlist" href="#" data-placement="top" data-slug="{{$product->slug}}" title="Add To Wishlist" data-id="{{$product->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>    
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="{{url('/all-categories')}}" class="fancy-btn fancy-btn-small fsz-15">View all Products</a>
            </div>           
        </section> --}}
        <!-- / Product Slider -->

        <!-- HOT DEALS START-->
        <section class="gst-row row-arrivals woocommerce ovh">
            <div class="container theme-container">
                <div class="gst-column col-lg-12 no-padding text-center">
                    <div class="fancy-heading text-center">
                        <h3><span class="thm-clr">HOT </span> DEALS</h3>
                    </div>

                    <div class="theme-container container">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                          <li><a class="fsz-13" href="#top-most" aria-controls="top-most" role="tab" data-toggle="tab">TOP MOST</a></li>
                          <li class="fsz-13 active"><a href="#all-hits" aria-controls="all-hits" role="tab" data-toggle="tab">ALL HITS</a></li>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content ">
                        <div role="tabpanel" class="tab-pane" id="top-most">
                            <div class="site-tab">
                                <div class="container text-center">
                                    <!-- Portfolio items -->
                                    @if ($topMostDeal)
                                        @foreach ($topMostDeal->products as $topMostDealProduct)
                                            <div class="col-md-3 col-sm-6 col-xs-12 isotope-item tab-2 w-20">
                                                <div class="portfolio-wrapper">
                                                    <div class="portfolio-thumb">
                                                        
                                                        <div class="icon-deal-label deal-left">
                                                            <div class="flex spcbt-30" >
                                                                <div class="count-down text-center">
                                                                    <div class="flex flex-1" data-countdown="{{$topMostDeal->valid_until}}"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="{{asset('storage/images/product/'.$topMostDealProduct->image->image1)}}" alt="">
                                                        <div class="portfolio-content">                                            
                                                            <div class="pop-up-icon">                 
                                                                <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                                data-id="{{$topMostDealProduct->id}}" 
                                                                data-min_order_qty="{{$topMostDealProduct->min_order_qty}}" 
                                                                data-category="{{$topMostDealProduct->category->categoryName}}" 
                                                                data-brand="{{$topMostDealProduct->brand->brandName}}"                                                                
                                                                data-slug="{{$topMostDealProduct->slug}}" 
                                                                data-name="{{$topMostDealProduct->productName}}" 
                                                                data-image="{{asset('storage/images/product/'.$topMostDealProduct->image->image1)}}" 
                                                                data-desc="{{strip_tags($topMostDealProduct->shortDescription)}}" 

                                                @if ($topMostDealProduct->discount)
                                                    @if ($topMostDealProduct->deal_id && $topMostDealProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            
                                                        data-sale="{{number_format($topMostDealProduct->regularPrice-(($topMostDealProduct->regularPrice*($topMostDealProduct->deal->discount_value + $topMostDealProduct->discount))/100), 2)}}"

                                                        data-regular="{{$topMostDealProduct->regularPrice}}"
                                                             
                                                    @else
                                                            data-sale="{{number_format($topMostDealProduct->regularPrice-(($topMostDealProduct->regularPrice*$topMostDealProduct->discount)/100), 2)}}"
                                                            data-regular="{{$topMostDealProduct->regularPrice}}"

                                                    @endif
                                                @else
                                                    @if ($topMostDealProduct->deal_id && $topMostDealProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        data-sale="{{number_format($topMostDealProduct->regularPrice-(($topMostDealProduct->regularPrice*$topMostDealProduct->deal->discount_value)/100), 2)}}"
                                                        data-regular="{{$topMostDealProduct->regularPrice}}"
                                                    @else
                                                        data-regular="{{$topMostDealProduct->regularPrice}}"
                                                    @endif
                                                @endif  

                                                                    data-url="{{url('product/'.$topMostDealProduct->id.'/'.$topMostDealProduct->slug)}}"><i class="fa fa-search"></i></a>
                                                                <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$topMostDealProduct->slug}}" title="Add To Wishlist" data-id="{{$topMostDealProduct->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                                <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$topMostDealProduct->slug}}" title="Add To Cart" data-id="{{$topMostDealProduct->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3> 
                                                            <a class="title-3 fsz-12" href="{{url('product/'.$topMostDealProduct->id.'/'.$topMostDealProduct->slug)}}">
                                                                {{substr($topMostDealProduct->productName, 0, 35)}}
                                                            </a> 
                                                        </h3>
                                                        <p class="font-2">
                                                            @if ($topMostDealProduct->discount)
                                                                @if ($topMostDealProduct->deal_id && $topMostDealProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    <span class="thm-clr">
                                                                        Tk {{number_format($topMostDealProduct->regularPrice-(($topMostDealProduct->regularPrice*($topMostDealProduct->deal->discount_value + $topMostDealProduct->discount))/100), 2)}}
                                                                    </span>    
                                                                    <span class="thm-clr line-through"> Tk {{number_format($topMostDealProduct->regularPrice, 2)}}</span>   
                                                                @else
                                                                    <span class="thm-clr">
                                                                        Tk {{number_format($topMostDealProduct->regularPrice-(($topMostDealProduct->regularPrice*$topMostDealProduct->discount)/100), 2)}}
                                                                    </span>
                                                                    <span class="thm-clr line-through"> Tk {{number_format($topMostDealProduct->regularPrice, 2)}}</span>        
                                                                @endif
                                                            @else
                                                                @if ($topMostDealProduct->deal_id && $topMostDealProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    <span class="thm-clr"> 
                                                                        Tk {{number_format($topMostDealProduct->regularPrice-(($topMostDealProduct->regularPrice*$topMostDealProduct->deal->discount_value)/100), 2)}}
                                                                    </span>    
                                                                    <span class="thm-clr line-through"> Tk {{number_format($topMostDealProduct->regularPrice, 2)}}</span>   
                                                                @else
                                                                    <span class="thm-clr"> Tk {{number_format($topMostDealProduct->regularPrice, 2)}}</span>    
                                                                @endif
                                                            @endif 
                                                        </p>    
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane active" id="all-hits">
                            <div class="site-tab">
                                <div class="container text-center">
                                    <!-- Portfolio items -->
                                    @foreach ($deals as $deal)
                                        @foreach ($deal->products as $dealProduct)
                                            <div class="col-md-3 col-sm-6 col-xs-12 w-20">
                                                <div class="portfolio-wrapper">
                                                    <div class="portfolio-thumb">
                                                        <div class="icon-deal-label deal-left">
                                                            <div class="flex spcbt-30" >
                                                                <div class="count-down text-center">
                                                                    <div class="flex flex-1" data-countdown="{{$deal->valid_until}}"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="{{asset('storage/images/product/'.$dealProduct->image->image1)}}" alt="">
                                                        <div class="portfolio-content">                                            
                                                            <div class="pop-up-icon">                 
                                                                <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                                data-id="{{$dealProduct->id}}" 
                                                                data-min_order_qty="{{$dealProduct->min_order_qty}}" 
                                                                data-category="{{$dealProduct->category->categoryName}}" 
                                                                data-brand="{{$dealProduct->brand->brandName}}"                                                                
                                                                data-slug="{{$dealProduct->slug}}" 
                                                                data-name="{{$dealProduct->productName}}" 
                                                                data-image="{{asset('storage/images/product/'.$dealProduct->image->image1)}}" 
                                                                data-desc="{{strip_tags($dealProduct->shortDescription)}}"
                                                                    
                                                                    
                                                                @if ($dealProduct->discount)
                                                                    @if ($dealProduct->deal_id && $dealProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                            
                                                                        data-sale="{{number_format($dealProduct->regularPrice-(($dealProduct->regularPrice*($dealProduct->deal->discount_value + $dealProduct->discount))/100), 2)}}"
                
                                                                        data-regular="{{$dealProduct->regularPrice}}"
                                                                             
                                                                    @else
                                                                            data-sale="{{number_format($dealProduct->regularPrice-(($dealProduct->regularPrice*$dealProduct->discount)/100), 2)}}"
                                                                            data-regular="{{$dealProduct->regularPrice}}"
                
                                                                    @endif
                                                                @else
                                                                    @if ($dealProduct->deal_id && $dealProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                        data-sale="{{number_format($dealProduct->regularPrice-(($dealProduct->regularPrice*$dealProduct->deal->discount_value)/100), 2)}}"
                                                                        data-regular="{{$dealProduct->regularPrice}}"
                                                                    @else
                                                                        data-regular="{{$dealProduct->regularPrice}}"
                                                                    @endif
                                                                @endif 
                                                                    
                                                                    
                                                                    data-url="{{url('product/'.$dealProduct->id.'/'.$dealProduct->slug)}}"><i class="fa fa-search"></i></a>
                                                                <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$dealProduct->slug}}" title="Add To Wishlist" data-id="{{$dealProduct->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                                <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$dealProduct->slug}}" title="Add To Cart" data-id="{{$dealProduct->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3> 
                                                            <a class="title-3 fsz-12" href="{{url('product/'.$dealProduct->id.'/'.$dealProduct->slug)}}">
                                                                {{substr($dealProduct->productName, 0,35)}}
                                                            </a> 
                                                        </h3>
                                                        <p class="font-2">
                                                            @if ($dealProduct->discount)
                                                                @if ($dealProduct->deal_id && $dealProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    <span class="thm-clr">
                                                                        Tk {{number_format($dealProduct->regularPrice-(($dealProduct->regularPrice*($dealProduct->deal->discount_value + $dealProduct->discount))/100), 2)}}
                                                                    </span>    
                                                                    <span class="thm-clr line-through"> Tk {{number_format($dealProduct->regularPrice, 2)}}</span>   
                                                                @else
                                                                    <span class="thm-clr">
                                                                        Tk {{number_format($dealProduct->regularPrice-(($dealProduct->regularPrice*$dealProduct->discount)/100), 2)}}
                                                                    </span>
                                                                    <span class="thm-clr line-through"> Tk {{number_format($dealProduct->regularPrice, 2)}}</span>
                                                                @endif
                                                            @else
                                                                @if ($dealProduct->deal_id && $dealProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    <span class="thm-clr"> 
                                                                        Tk {{number_format($dealProduct->regularPrice-(($dealProduct->regularPrice*$dealProduct->deal->discount_value)/100), 2)}}
                                                                    </span>    
                                                                    <span class="thm-clr line-through"> Tk {{number_format($dealProduct->regularPrice, 2)}}</span>   
                                                                @else
                                                                    <span class="thm-clr"> Tk {{number_format($dealProduct->regularPrice, 2)}}</span>    
                                                                @endif
                                                            @endif  
                                                        </p>    
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / HOT DEALS END -->

        <!-- Product Compare -->  
        @if ($adsProducts)          
            <section class="gst-compare">
                {{--<div class="gst-column col-lg-6 col-md-6 col-sm-12 col-xs-12 gst-compare-men" style="padding-top: 40px !important; padding-bottom: 20px !important; background: #f8f8f8 url('{{asset('storage/images/ads/'.$adsProducts->ad1Image)}}') no-repeat bottom left;"> --}}
                <div class="gst-column col-lg-6 col-md-6 col-sm-12 col-xs-12 gst-compare-men" style="background: #f8f8f8 url('{{asset('storage/images/ads/'.$adsProducts->ad1Image)}}') no-repeat bottom left;">
                    <div class="col-lg-5 right">
                        <h5 class="title-3">{{$adsProduct1->productName}}</h5>
                        <h4>                                         
                            @if ($adsProduct1->discount)
                                @if ($adsProduct1->deal_id && $adsProduct1->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                    <span class="thm-clr fsz-18 light-font-3">
                                        Tk {{number_format($adsProduct1->regularPrice-(($adsProduct1->regularPrice*($adsProduct1->deal->discount_value + $adsProduct1->discount))/100), 2)}}
                                    </span>    
                                    <span class="discnt fsz-18 light-font-3"> Tk {{number_format($adsProduct1->regularPrice,2)}}</span>   
                                @else
                                    <span class="thm-clr fsz-18 light-font-3">
                                        Tk {{number_format($adsProduct1->regularPrice-(($adsProduct1->regularPrice*$adsProduct1->discount)/100), 2)}}
                                    </span>
                                    <span class="discnt fsz-18 light-font-3"> Tk {{number_format($adsProduct1->regularPrice,2)}}</span>
                                @endif
                            @else
                                @if ($adsProduct1->deal_id && $adsProduct1->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                    <span class="thm-clr fsz-18 light-font-3"> 
                                        Tk {{number_format($adsProduct1->regularPrice-(($adsProduct1->regularPrice*$adsProduct1->deal->discount_value)/100), 2)}}
                                    </span>    
                                    <span class="discnt fsz-18 light-font-3"> Tk {{number_format($adsProduct1->regularPrice,2)}}</span>   
                                @else
                                    <span class="thm-clr fsz-18 light-font-3"> Tk {{number_format($adsProduct1->regularPrice,2)}}</span>    
                                @endif
                            @endif
                        </h4>

                        {{--<div class="gst-empty-space clearfix"></div>
                            <div class="gst-empty-space clearfix"></div>
                            <div class="gst-empty-space clearfix"></div>
                            <div class="gst-empty-space clearfix"></div>
                            <div class="gst-empty-space clearfix"></div>
                            <div class="gst-empty-space clearfix"></div>  --}}                   
                            {{-- <ul>
                                <li>{{substr(strip_tags($adsProduct1->shortDescription), 0, 30)}}...</li>
                            </ul> --}}

                        <p class="gst-compare-actions">
                            <a href="{{url('product/'.$adsProduct1->id.'/'.$adsProduct1->slug)}}">Detail</a>
                            <a href="#" class="compare-add-to-cart right-link addCart" data-placement="top" data-slug="{{$adsProduct1->slug}}" title="Add To Cart" data-id="{{$adsProduct1->id}}" data-url="{{url('/add-cart')}}" data-qty="1">Add to Cart</a>
                        </p>
                    </div>
                </div>

                {{--<div class="gst-column col-lg-6 col-md-6 col-sm-12 col-xs-12 gst-compare-women" style="padding-top: 40px !important; padding-bottom: 20px !important; background: #f0f0f0 url('{{asset('storage/images/ads/'.$adsProducts->ad2Image)}}') no-repeat bottom right;"> --}}
                <div class="gst-column col-lg-6 col-md-6 col-sm-12 col-xs-12 gst-compare-women" style="padding-left:38px !important; background: #f0f0f0 url('{{asset('storage/images/ads/'.$adsProducts->ad2Image)}}') no-repeat bottom right;">
                    <div class="col-lg-6">
                        <div>
                            <h5 class="title-3">{{$adsProduct2->productName}}</h5>
                            <h4>                                         
                                @if ($adsProduct2->discount)
                                    @if ($adsProduct2->deal_id && $adsProduct2->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                        <span class="thm-clr fsz-18 light-font-3">
                                            Tk {{number_format($adsProduct2->regularPrice-(($adsProduct2->regularPrice*($adsProduct2->deal->discount_value + $adsProduct2->discount))/100), 2)}}
                                        </span>    
                                        <span class="discnt fsz-18 light-font-3"> Tk {{number_format($adsProduct2->regularPrice,2)}}</span>   
                                    @else
                                        <span class="thm-clr fsz-18 light-font-3">
                                            Tk {{number_format($adsProduct2->regularPrice-(($adsProduct2->regularPrice*$adsProduct2->discount)/100), 2)}}
                                        </span>
                                        <span class="discnt fsz-18 light-font-3"> Tk {{number_format($adsProduct2->regularPrice,2)}}</span>
                                    @endif
                                @else
                                    @if ($adsProduct2->deal_id && $adsProduct2->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                        <span class="thm-clr fsz-18 light-font-3"> 
                                            Tk {{number_format($adsProduct2->regularPrice-(($adsProduct2->regularPrice*$adsProduct2->deal->discount_value)/100), 2)}}
                                        </span>    
                                        <span class="discnt fsz-18 light-font-3"> Tk {{number_format($adsProduct2->regularPrice,2)}}</span>   
                                    @else
                                        <span class="thm-clr fsz-18 light-font-3"> Tk {{number_format($adsProduct2->regularPrice,2)}}</span>    
                                    @endif
                                @endif
                            </h4>
                        </div>
                        {{--<div class="gst-empty-space clearfix"></div>
                        <div class="gst-empty-space clearfix"></div>
                        <div class="gst-empty-space clearfix"></div>
                        <div class="gst-empty-space clearfix"></div>
                        <div class="gst-empty-space clearfix"></div>
                        <div class="gst-empty-space clearfix"></div> --}}
                        {{-- <ul>
                            <li>{{substr(strip_tags($adsProduct2->shortDescription), 0, 30)}}...</li>
                        </ul> --}}
                        <div>
                            <p class="gst-compare-actions">
                                <a href="{{url('product/'.$adsProduct2->id.'/'.$adsProduct2->slug)}}">Detail</a>
                                <a href="#" class="compare-add-to-cart right-link addCart" data-placement="top" data-slug="{{$adsProduct2->slug}}" title="Add To Cart" data-id="{{$adsProduct2->id}}" data-url="{{url('/add-cart')}}" data-qty="1">Add to Cart</a>
                            </p>                        
                        </div>
                    </div>
                </div>

                <div class="descount bold-font-2"> 
                    <div class="rel-div fsz-13"> 
                        @if($topMostDeal)
                            <p> 
                                DISCOUNT UP TO {{$discount_val + $topMostDeal->discount_value}}% 
                            </p>
                        @else
                            <p> 
                                DISCOUNT UP TO {{$discount_val}}% 
                            </p>
                        @endif 
                    </div> 
                </div>
            </section>
        @endif
        <!-- / Product Compare -->


        <!-- Brand product-->
        @if($brand)
            @if(count($brand->product)>3)
                <section class="container theme-container">
                    <div class="gst-row">
                        <div class="fancy-heading text-center">
                            <h3 style="justify-content: center;">Brand Items</h3>
                            {{--<div class="flex spcbt-30" style="margin-top: -70px;">
                                <div class="flex flex-1" style="justify-content: ;" >
                                    <h5 class="funky-font-2">
                                        <img src="{{asset('storage/images/brand/'.$brand->brandImage)}}" height="100px" width="100px" alt="Product">
                                    </h5>
                                </div>
                            </div> --}}
                        </div>
                        <div class="special-offers row">
                            <div class="col-lg-4 pt-45">
                                <div class="col-lg-12 col-md-12 col-sm-12 menu-block mb-3" style="padding: 5px;">
                                    <div class="sub-list text-center">
                                        <div class="menu-card" style="height: 200px; border: #999 1px solid; border-radius: 5px;">
                                            <img class="" src="{{asset('storage/images/brand/'.$brand->brandImage)}}" height="100%" width="100%" alt="{{$brand->brandName}}" style="padding: 10px;">
                                        </div>
                                        <div class="mt-10" style="background: #f7f5f5; border-radius: 5px;">
                                            <div class="name pt-15">
                                                <h4 class="fsz-18">
                                                <b>{{$brand->brandName}}</b>
                                                </h4>
                                            </div>
                                            <div class="price font-2 spcbtm-15"> 
                                            <span>Total Products: ({{count($brand->product)}})</span> <br>
                                            <span>
                                                <a href="{{url('/product-by-brand/'.$brand->id.'/'.str_slug($brand->brandName))}}" class="red-clr"> See more</a> |
                                                <a href="{{url('all-brands')}}" class="red-clr">Other Brands </a>
                                            </span>
                                                
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>                                                 
                            </div>
                            <div class="col-lg-8">  
                                @foreach ($brand->product->where('published', false)->take(4) as $brandProduct)
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="product">
                                            <div class="image">
                                                <a href="{{url('product/'.$brandProduct->id.'/'.$brandProduct->slug)}}">
                                                    <img src="{{asset('storage/images/product/'.$brandProduct->image->image1)}}" alt="Product">
                                                </a>
                                            </div>
                                            <div class="">
                                                <!-- <p class="fsz-18">{{$brandProduct->category->categoryName}}</p> -->
                                                <div class="name">
                                                    <a href="{{url('product/'.$brandProduct->id.'/'.$brandProduct->slug)}}">
                                                        <span class="fsz-10">
                                                            {{substr($brandProduct->productName, 0)}}
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="price font-2"> 
                                                    @if ($brandProduct->discount)
                                                        @if ($brandProduct->deal_id && $brandProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            <span class="thm-clr">
                                                                Tk {{number_format($brandProduct->regularPrice-(($brandProduct->regularPrice*(  $brandProduct->deal->discount_value + $brandProduct->discount))/100), 2)}}
                                                            </span>    
                                                            <span class="thm-clr line-through"> Tk {{number_format($brandProduct->regularPrice), 2}}</span>   
                                                        @else
                                                            <span class="thm-clr">
                                                                Tk {{number_format($brandProduct->regularPrice-(($brandProduct->regularPrice*($brandProduct->discount))/100), 2)}}
                                                            </span>
                                                            <span class="thm-clr line-through"> Tk {{number_format($brandProduct->regularPrice), 2}} </span>        
                                                        @endif
                                                    @else
                                                        @if ($brandProduct->deal_id && $brandProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                            <span class="thm-clr"> 
                                                                Tk {{number_format($brandProduct->regularPrice-(($brandProduct->regularPrice* $brandProduct->deal->discount_value)/100), 2)}}
                                                            </span>    
                                                            <span class="thm-clr line-through"> Tk {{number_format($brandProduct->regularPrice), 2}} </span>   
                                                        @else
                                                            <span class="thm-clr"> Tk {{number_format($brandProduct->regularPrice), 2}} </span>   
                                                        @endif
                                                    @endif
                                                    <br>
                                                    <a href="#" class="red-clr right-link addCart" data-placement="top" data-slug="{{$brandProduct->slug}}" title="Add To Cart" data-id="{{$brandProduct->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="compare-add-to-cart left-link addWishlist" href="#" data-placement="top" data-slug="{{$brandProduct->slug}}" title="Add To Wishlist" data-id="{{$brandProduct->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                        
                                @endforeach                        
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endif
        <!-- / Brand Product -->

        <!-- Valued Offer -->
        @if ($adsProducts)
            <section class="gst-row row-carbon-fiber ovh">
                <div class="container theme-container">
                    <div class="gst-column col-lg-12 no-padding text-center">
                        <div class="fancy-heading text-center">
                            <h3>Valued  <span class="thm-clr">Offer </span></h3>
                            <h5 class="funky-font-2">Limited time offer only on Dadavaai</h5>
                        </div>

                        <div class="row"> 
                            <div class="col-lg-12 col-sm-12">
                                <div class="row"> 
                                    <div class="col-lg-7 col-sm-6">
                                        <p class="gst-compare-actions">
                                            <a class="left" href="{{url('product/'.$adsProduct3->id.'/'.$adsProduct3->slug)}}">
                                                <span class="fsz-20 price-tag" style="margin-top: unset;">                                    
                                                    {{$adsProduct3->productName}}
                                                </span>
                                            </a>
                                        </p>  
                                        <div class="left" style="margin-left: 75px;">   
                                            @if ($adsProduct3->discount)
                                                @if ($adsProduct3->deal_id && $adsProduct3->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                    <span class="thm-clr fsz-19 light-font-2">
                                                        Tk {{number_format($adsProduct3->regularPrice-(($adsProduct3->regularPrice*($adsProduct3->deal->discount_value + $adsProduct3->discount))/100), 2)}}
                                                    </span> 
                                                    &nbsp;   
                                                    <span class="discnt fsz-19 light-font-3"> Tk {{number_format($adsProduct3->regularPrice,2)}} </span>   
                                                @else
                                                    <span class="thm-clr fsz-19 light-font-2">
                                                        Tk {{number_format($adsProduct3->regularPrice-(($adsProduct3->regularPrice*$adsProduct3->discount)/100), 2)}}
                                                    </span>
                                                    &nbsp; 
                                                    <span class="discnt fsz-19 light-font-3"> Tk {{number_format($adsProduct3->regularPrice,2)}} </span>
                                                @endif
                                            @else
                                                @if ($adsProduct3->deal_id && $adsProduct3->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                    <span class="thm-clr fsz-19 light-font-2"> 
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
                                        </div>
                                        <div class="gst-empty-space clearfix"></div>
                                        {{-- <a href="#" class="fancy-btn fancy-btn-small addCart right-link" data-placement="top" data-slug="{{$adsProduct3->slug}}" title="Add To Cart" data-id="{{$adsProduct3->id}}" data-url="{{url('/add-cart')}}" data-qty="1">Add to Cart</a> --}}
                                    </div>
                                    <div class="col-lg-5 col-sm-6">
                                        {{--<div class="gst-empty-space clearfix"></div>
                                        <div class="gst-empty-space clearfix"></div> --}}
                                       
                                        @if ($adsProduct3->deal_id)
                                            <div id="countdown-deal" class="gst-countdown" data-countdown="{{$adsProduct3->deal->valid_until}}"></div>
                                            <div class="gst-empty-space clearfix"></div>
                                            <div class="gst-empty-space clearfix"></div>
                                        @endif

                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col-lg-8 col-sm-8 col-lg-offset-2">
                                        <img class="right" src="{{asset('storage/images/ads/'.$adsProducts->ad4Image)}}" alt="" />               
                                    </div>
                                    {{-- <div class="col-lg-4 col-sm-4">
                                        <img src="{{asset('storage/images/ads/'.$adsProducts->ad3Image)}}" alt="" />
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="gst-empty-space clearfix"></div>
                                
                    </div>
                </div>
            </section>
        @endif
        <!-- / Valued Offer  -->

        <!-- Pre-launching book -->
        @if (count($prebooks))
            <section class="gst-row ovh">
                <div class="container theme-container">
                    <div class="gst-column col-lg-12 no-padding">
                        <div class="fancy-heading text-center">
                            <h3>Pre Launching <span class="thm-clr">Booking</span></h3>
                            <h5 class="funky-font-2">News for upcoming product</h5>
                        </div>

                        <div class="row gst-post-list">
                            @foreach ($prebooks->take(4) as $prebook)
                                {{-- <div class="col-lg-3 col-md-6 col-sm-12" style="min-height: 400px; width: 24% !important; margin: 5px; border: solid 1px; padding: unset;"> --}}
                                <div class="col-lg-3 col-md-6 col-sm-12 prelaunching" style=" border-radius: 20px; margin: 5px; border: solid 1px; padding: unset;">

                                    <a href="{{url('pre-launching-product-details/'.$prebook->id)}}">
                                        <img src="{{asset('storage/images/product/'.$prebook->product->image->image1)}}" alt="" width='370px' height='210px'/>
                                    </a>
                                    <div class="media clearfix" style="border-top: solid 1px;">
                                        <div class="entry-meta media-left">
                                            <div class="entry-time meta-date" style=" border-radius: 20px;">
                                                <time datetime="2015-12-09T21:10:20+00:00">
                                                    <span class="entry-time-date dblock"></span>
                                                    {{date('d M Y', strtotime($prebook->launching_date))}}

                                                </time>
                                            </div>
                                            <div class="entry-reply" style=" border-radius: 20px;">
                                                <a href="#" class="comments-link" data-placement="top" title="Currently Booked Number" >
                                                    @php
                                                        $randomNumber = rand(10,20);
                                                    @endphp
                                                    {{$prebook->number_of_prebook + $randomNumber}}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <header class="entry-header">
                                                <span class="vcard">
                                                    <a class="blk-clr" href="{{url('product/'.$prebook->product->id.'/'.$prebook->product->slug)}}">
                                                    <span class="fsz-12" style="text-transform: unset;">
                                                        {{substr($prebook->product->productName, 0, 30)}}
                                                    </span>
                                                    </a>
                                                </span>
                                                <br>
                                                <span class="vcard author entry-author">
                                                    <a href="#"> Tk {{number_format($prebook->product->regularPrice - $prebook->prebook_discount,0)}}</a>
                                                    &nbsp;&nbsp;
                                                    <span class="thm-clr line-through"> Tk {{number_format($prebook->product->regularPrice, 0)}}</span>
                                                </span>
                                                
                                                <div style="padding-top: 5px;">
                                                    {{-- <span class="" style="padding-left: 3px;">
                                                        <a class="left-link addWishlist" href="#" data-placement="top" data-slug="{{$prebook->product->slug}}" title="Add To Wishlist" data-id="{{$prebook->product->id}}" data-url="{{url('/add-to-wishlist')}}">
                                                            <i class="fa fa-heart"></i>
                                                        </a>
                                                    </span> --}}
                                                    {{-- <span class="">
                                                        <a href="#" class="left-link addCart" data-placement="top" data-slug="{{$prebook->product->slug}}" title="Add To Cart" data-id="{{$prebook->product->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="fa fa-shopping-cart"></i></a>
                                                    </span> --}}
                                                    {{-- <span class="entry-categories">
                                                        <div class="fb-share-button" data-href="{{url('pre-launching-product-details/'.$prebook->id)}}" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F127.0.0.1%3A8000%2Fpre-launching-product-details%2F1&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                                                    </span> --}}
                                                    {{-- <br> --}}

                                                    {{-- <a class="fsz-12" href="{{url('pre-launching-product-details/'.$prebook->id)}}" rel="bookmark"> {{substr(strip_tags($prebook->details), 0, 60)}}  <span style="color: red;"> ..more </span> </a> --}}  

                                                    <a class="fsz-13" href="{{url('pre-launching-product-details/'.$prebook->id)}}" rel="bookmark"> DETAILS  </a> |

                                                    <a href="#" class="left-link addCart" data-placement="top" data-slug="{{$prebook->product->slug}}" title="Add To Cart" data-id="{{$prebook->product->id}}" data-url="{{url('/add-cart')}}" data-qty="1" style="padding: 0px 12px 0px 10px;"><i class="fa fa-shopping-cart"></i></a>|

                                                    <a class="fsz-13" href="{{url('prebook-form/'.$prebook->id)}}">BOOK NOW</a>
                                                </div>

                                                
                                                {{-- <a class="fancy-btn fancy-btn-small mb-5" href="{{url('prebook-form/'.$prebook->id)}}" data-placement="top" title="Book now" style="text-transform: unset; font-size: 11px;">
                                                    Book now
                                                </a> --}}
                                            </header>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif  
        <!-- Pre-launching book -->       

        <!-- Single Row Black Background  -->
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
        <!-- / Single Row Black Background  -->


        <!-- Featured Products -->
        <section class="box-content">   
            <div class="fancy-heading text-center spcbtm-15">
                <h3>Featured Products</h3>
                <h5 class="funky-font-2">Our featured products here</h5>
            </div>
            <div class="featured-products diblock">

                @foreach ($featuredProducts as $featuredProduct)
                    <div class="col-sm-6 col-lg-3 no-lr-padding">
                        <div class="image">
                            
                            @if ($featuredProduct->discount)
                                @if ($featuredProduct->deal_id && $featuredProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                    <div class="icon-discount-label discount-right">
                                        {{$featuredProduct->discount + $featuredProduct->deal->discount_value}} %  
                                    </div>  
                                @else
                                    <div class="icon-discount-label discount-right">
                                        {{$featuredProduct->discount}} %  
                                    </div>          
                                @endif
                            @else
                                @if ($featuredProduct->deal_id && $featuredProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                    <div class="icon-discount-label discount-right">
                                        {{$featuredProduct->deal->discount_value}} %  
                                    </div>       
                                @endif
                            @endif

                            <img src="{{asset('storage/images/product/'.$featuredProduct->image->image1)}}" alt="Product">

                        </div>
                        <div class="description">
                            <div class="text">
                                {{-- <a href="#" class="add-to-cart"></a> --}}
                                <a href="#" class="add-to-cart cart-icn2 addCart" data-placement="top" data-slug="{{$featuredProduct->slug}}" title="Add To Cart" data-id="{{$featuredProduct->id}}" data-url="{{url('/add-cart')}}" data-qty="1"></a>
                                <div class="brand funky-font-2 ">{{$featuredProduct->category->categoryName}}</div>
                                <div class="name">
                                    <a href="{{url('product/'.$featuredProduct->id.'/'.$featuredProduct->slug)}}">
                                        <span class="fsz-12">
                                            {{$featuredProduct->productName}}
                                        </span>
                                    </a>
                                </div>
                                <div class="price font-3">
                                    @if ($featuredProduct->discount)
                                        @if ($featuredProduct->deal_id && $featuredProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                            <span class="">
                                                Tk {{number_format($featuredProduct->regularPrice-(($featuredProduct->regularPrice*($featuredProduct->deal->discount_value + $featuredProduct->discount))/100), 2)}}
                                            </span>    
                                            <span class="thm-clr line-through"> Tk {{number_format($featuredProduct->regularPrice, 2)}}</span>   
                                        @else
                                            <span class="">
                                                Tk {{number_format($featuredProduct->regularPrice-(($featuredProduct->regularPrice*$featuredProduct->discount)/100), 2)}}
                                            </span>
                                            <span class="thm-clr line-through"> Tk {{number_format($featuredProduct->regularPrice, 2)}}</span>        
                                        @endif
                                    @else
                                        @if ($featuredProduct->deal_id && $featuredProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                            <span class=""> 
                                                Tk {{number_format($featuredProduct->regularPrice-(($featuredProduct->regularPrice*$featuredProduct->deal->discount_value)/100), 2)}}
                                            </span>    
                                            <span class="thm-clr line-through"> Tk {{number_format($featuredProduct->regularPrice, 2)}}</span>   
                                        @else
                                            <span class=""> Tk {{number_format($featuredProduct->regularPrice, 2)}}</span>    
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- / Featured Products -->


        @if(count($reviews)>0)
            <!-- Testimonials Slider -->
            <section class="gst-row gst-color-white row-they-say ovh" id="they-say-carousel">
                <div class="container theme-container">
                    <div class="gst-column col-lg-12 no-padding text-center">
                        <div class="fancy-heading text-center wht-clr">
                            <h3>They Says</h3>
                            <h5 class="funky-font-2">Happy Clients</h5>
                        </div>

                        <div class="quotes-carousel">
                            <div class="they-say nav-2">
                                @foreach($reviews as $review)
                                    <div class="item">                                   
                                        <p>
                                            {{$review->review}}
                                        </p>
                                        <cite>
                                            <strong>{{$review->client->clientName}}</strong> - {{$review->client->country}}
                                        </cite>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- / Testimonials Slider -->
        @endif

        <!-- OPENING HOURS -->
        <section class="gst-row our-address">
            <div class="container theme-container">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 add-wrap">
                    <div class=" text-center">
                        <h2 class="fsz-35"> <span class="bold-font-3 wht-clr">Dadavaai</span> <span class="thm-clr funky-font"></span> </h2>
                        @php
                            $contact = \App\Contact::first();
                        @endphp
                        @if ($contact)
                        <p>{{$contact->address}}<br>
                            Call Sales & Service : {{$contact->phone2}}, {{$contact->phone1}} <br> 
                            Email: {{$contact->email}}
                        </p>
                            
                        @endif
                        <div class="fancy-heading text-center">
                            <h2 class="title-2">OPENING HOURS</h2>                           
                        </div>
                        <p> Saturday to Wednesday from 9.00AM - 18.00PM </p>
                        <p> Thursday from 9.00AM - 14.00PM </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- / OPENING HOURS -->
    </div>                                                                                                                       
    <div class="clear"></div>
@endsection

@section('script')
<script>


$(document).ready(function(){

// $('.owl-carousel').owlCarousel({
//     loop:true,
//     autoplay:true,
//     margin:5,
//     items:5
// })

 $('.owl-carousel-all-product').owlCarousel({
     loop:true,
     margin:5,
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

 $('.owl-carousel-luckytoday-product').owlCarousel({
     loop:true,
     margin:5,
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
             items:6,
             nav:false,
             loop:true
         }
     }
 })


});

</script>
@endsection