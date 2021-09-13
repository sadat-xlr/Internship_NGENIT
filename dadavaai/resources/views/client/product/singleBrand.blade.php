@extends('layouts.client')

@section('og_property')
    <meta property="og:title" content="Dadavaai:{{$brand->brandName}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:description" content=""/>
    <meta property="og:url" content="{{url('product-by-brand/'.$brand->id.'/'.str_slug($brand->brandName))}}" />
    <meta property="og:image" content="{{asset('storage/images/brand/'.$brand->brandImage)}}"/>
@endsection

@section('title')
    <title>{{$brand->brandName}} | Dadavaai</title>
@endsection
@php
$currentTime = \Carbon\Carbon::now()->format('d-m-Y');
$banner  = \App\Banner::select('header_two', 'banner_brand_single_page', 'banner_link_brand_single_page')->first();
@endphp
@section('content')
    <!-- CONTENT + SIDEBAR -->
    <div class="main-wrapper clearfix">
        <div class="site-pagetitle jumbotron" style="margin-bottom: 10px;">
            <div class="container text-center">
                {{-- <h3>{{$singleCategory->categoryName}}</h3> --}}

                <!-- Breadcrumbs -->
                <div class="breadcrumbs">
                    <div class="breadcrumbs text-left">
                        <i class="fa fa-home"></i>
                        <span><a href="{{url('/')}}">Home</a></span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span><a href="{{url('/all-brands')}}">Brands</a></span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span class="current red-clr">{{$brand->brandName}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="theme-container container">
            <div class="main-container row">
                <aside class="col-md-3 col-sm-4">
                    <div class="main-sidebar">
                        <div class="widget sidebar-widget widget_categories clearfix">
                            <img class="CqQKv brand-border brand-border-solid mr-2" src="{{asset('storage/images/brand/'.$brand->brandImage)}}"  width="100%" height="100%" alt="Brand Image" >
                        </div>
                        <div id="search-2" class="widget sidebar-widget widget_search clearfix">
                            <form method="get" id="searchform" class="form-search" action="#">
                                <input data-brand="{{$brand->id}}" id="brand-page-search" class="form-control search-query" type="text" placeholder="Type Keyword" name="brand-page-search-product-name" />
                                <button class="btn btn-default search-button" type="submit" name="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        <div class="widget sidebar-widget woocommerce widget_price_filter clearfix">
                            <h6 class="widget-title">Filter by price</h6>
                            <form action="{{url('sort-by-price-range-brand-product')}}" method="GET">
                                <div class="price_slider_wrapper">
                                    <div id="price_slider" class="price_slider"></div>
                                    <div class="price_slider_amount">
                                        <input type="text" id="min_price" name="min_price" value="" data-min="10" placeholder="Min price" />
                                        <input type="text" id="max_price" name="max_price" value="" data-max="10000" placeholder="Max price" />
                                        <input type="hidden" name="brandId" value="{{$brand->id}}">
                                        <button type="submit" class="button">Filter</button>
                                        <div class="price_label">
                                            Price: Tk.<span id="label_min" class="from">10</span> &mdash; Tk.<span id="label_max" class="to">10000</span>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="widget sidebar-widget widget_categories clearfix">
                            <h6 class="widget-title">COLOR</h6>
                            <div class="panel-group">
                                    <div class="panel panel-cate">
                                        <div class="cate-heading">                                            
                                            <a data-toggle="collapse" href="#crl5" class="collapsed"> All Color</a>                                           
                                        </div>
                                        <div id="crl5" class="panel-collapse collapse">
                                            <ul>
                                                @foreach ($colors as $color)
                                                    <li id="allBrandColor" class="cat-item"><a data-id="{{$color->id}}" data-brand="{{$brand->id}}" href="#">{{$color->color}}</a></li>
                                                @endforeach
                                            </ul>                                                                                  
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="widget sidebar-widget widget_categories clearfix">
                            <h6 class="widget-title">Size</h6>
                            <div class="panel-group">
                                <div class="panel panel-cate">
                                    <div class="cate-heading">                                            
                                        <a data-toggle="collapse" href="#sizeB" class="collapsed"> All Sizes</a>                                           
                                    </div>
                                    <div id="sizeB" class="panel-collapse collapse">
                                        <ul>
                                            @foreach ($sizes as $size)
                                                <li id="allBrandSize" class="cat-item"><a data-id="{{$size->id}}" data-brand="{{$brand->id}}" href="#" style="text-transform:uppercase">{{$size->size}}</a></li>
                                            @endforeach
                                        </ul>                                                                                 
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <div class="widget sidebar-widget">
                            <div class="text-box">
                                <a href="{{url($banner->banner_link_brand_single_page)}}">
                                    <img src="{{asset('storage/images/banner/'.$banner->banner_brand_single_page)}}" alt="" />
                                </a>
                            </div>
                        </div>

                    </div>
                </aside>
                <main class="col-md-9 col-sm-9 shop-wrap">
                    {{-- <div class="flex  mt-4 spcbt-30" >
                        <div class="bg-white flex flex-1 p-4 rounded-lg shadow-md">
                            <img class="CqQKv brand-border brand-border-solid mr-2" src="{{asset('storage/images/brand/'.$brand->brandImage)}}" alt="Brand Image" >
                            <div>
                                <h1>{{$brand->brandName}}</h1>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Banner category  page --}}
                    <div class="page-description spcbt-30">
                        <img src="{{asset('storage/images/banner/'.$banner->header_two)}}" alt="" />
                    </div>

                    <div class="row spcbt-30">
                        <div class="col-lg-6 col-sm-6 sorter"> 
                            <ul class="nav-tabs tabination view-tabs">
                                <li class="active">
                                    <a href="#grid-view" data-toggle="tab">                                                    
                                        <i class="fa fa-th" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                            <form action="#" class="sorting-form">
                                <div class="search-selectpicker selectpicker-wrapper">
                                    <select id="sort-by-type-brand" data-id="{{$brand->id}}"
                                        class="selectpicker input-price" data-live-search="true" data-width="100%"
                                        data-toggle="tooltip" name="sort_by" title="Sort By">                                           
                                        <option  value="date">Sort by newness</option>
                                        <option  value="price">Sort by price: low to high</option>
                                        <option  value="price-desc">Sort by price: high to low</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>	
                    <div class="tab-content">
                        <!-- Product Grid View -->
                        <div id="grid-view-brandProduct" class="tab-pane fade active in" role="tabpanel">
                            <div class="row text-center hvr2 clearfix">
                                @foreach ($products as $productGrid)
                                    <div class="col-md-4 col-sm-4">
                                        <div class="portfolio-wrapper">
                                            <div class="portfolio-thumb">
                                                <img src="{{asset('storage/images/product/'.$productGrid->image->image1)}}" alt="">
                                                <div class="portfolio-content">   
                                                    <div class="pop-up-icon">                 
                                                        <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" data-id="{{$productGrid->id}}"  data-min_order_qty="{{$productGrid->min_order_qty}}" data-category="{{$productGrid->category->categoryName}}" data-brand="{{$productGrid->brand->brandName}}" data-slug="{{$productGrid->slug}}" data-name="{{$productGrid->productName}}" 
                                                            data-image="{{asset('/storage/images/product/'.$productGrid->image->image1)}}" 
                                                            data-desc="{{strip_tags($productGrid->shortDescription)}}" 
                                                        @if ($productGrid->discount)
                                                            @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    
                                                                data-sale="{{number_format($productGrid->regularPrice-(($productGrid->regularPrice*($productGrid->deal->discount_value + $productGrid->discount))/100), 2)}}"
        
                                                                data-regular="{{$productGrid->regularPrice}}"
                                                                     
                                                            @else
                                                                    data-sale="{{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->discount)/100), 2)}}"
                                                                    data-regular="{{$productGrid->regularPrice}}"
        
                                                            @endif
                                                        @else
                                                            @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                data-sale="{{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->deal->discount_value)/100), 2)}}"
                                                                data-regular="{{$productGrid->regularPrice}}"
                                                            @else
                                                                data-regular="{{$productGrid->regularPrice}}"
                                                            @endif
                                                        @endif 
                                                            data-url="{{url('product/'.$productGrid->id.'/'.$productGrid->slug)}}"><i class="fa fa-search"></i></a>

                                                            {{-- <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$productGrid->slug}}" title="Add To Wishlist" data-id="{{$productGrid->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>    --}}

                                                            <a href="#" class="compare left-link addToCompare" data-placement="top" data-url="{{url('addCompare/'.$productGrid->id)}}" title="Add To Compare">
                                                                <i class="fa fa-retweet"></i>
                                                            </a> 


                                                            <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$productGrid->slug}}" title="Add To Cart" data-id="{{$productGrid->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                    </div>                                                   
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3> 
                                                    <a class="title-3 fsz-13" href="{{url('product/'.$productGrid->id.'/'.$productGrid->slug)}}"> 
                                                        {{substr($productGrid->productName, 0, 30)}}
                                                    </a> 
                                                </h3>
                                                <p class="font-2 fsz-10"> 
                                                @if ($productGrid->discount)
                                                    @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        <span class="thm-clr fsz-13"> Tk {{number_format($productGrid->regularPrice-(($productGrid->regularPrice*($productGrid->deal->discount_value + $productGrid->discount))/100), 2)}}</span>    
                                                        <span class="thm-clr line-through"> Tk {{number_format($productGrid->regularPrice, 2)}}</span>   
                                                    @else
                                                        <span class="thm-clr fsz-13"> Tk {{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->discount)/100), 2)}}</span>
                                                        <span class="thm-clr line-through"> Tk {{number_format($productGrid->regularPrice, 2)}}</span>        
                                                    @endif
                                                @else
                                                    @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        <span class="thm-clr fsz-13"> Tk {{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->deal->discount_value)/100), 2)}}</span>    
                                                        <span class="thm-clr line-through"> Tk {{number_format($productGrid->regularPrice, 2)}}</span>   
                                                    @else
                                                        <span class="thm-clr fsz-13"> Tk {{number_format($productGrid->regularPrice, 2)}}</span>    
                                                    @endif
                                                @endif
                                                    <a href="#" class="compare-add-to-cart right-link addCart" data-placement="top" data-slug="{{$productGrid->slug}}" title="Add To Cart" data-id="{{$productGrid->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="compare-add-to-cart left-link addWishlist" href="#" data-placement="top" data-slug="{{$productGrid->slug}}" title="Add To Wishlist" data-id="{{$productGrid->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>
                                                </p>    
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <nav class="woocommerce-pagination">
                                {{$products->links()}}
                            </nav>
                        </div>
                        <!-- / Product Grid View -->
                        <!--  Ajax result of sort by product View -->
                        <div class=" tab-pane fade active in" role="tabpanel">
                            <div id="sort" class="row text-center hvr2 clearfix">

                            </div>
                        </div>
                        <!-- / Ajax result of sort by product View -->
                    </div>
                </main>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- / CONTENT + SIDEBAR -->
@endsection
@section('script')
<script>
    $(document).ready(function(){
    
     $(document).on('click', '.pagination a', function(event){
      event.preventDefault(); 
      var page = $(this).attr('href').split('page=')[1];
      fetch_data(page);
     });
    
     function fetch_data(page)
     {
        var brandName = $('#cateroryName').text();
        var brandId = $('#cateroryId').text();
      $.ajax({
       url:"/product-by-brand/"+brandId+"/"+brandName+"?page="+page,
       success:function(data)
       {
        $('#table_data').html(data);
       }
      });
     }
     
    });
</script>
@endsection