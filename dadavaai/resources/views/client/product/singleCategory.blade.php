@extends('layouts.client')

@section('og_property')
    <meta property="og:title" content="Dadavaai:{{$singleCategory->categoryName}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:description" content=""/>
    <meta property="og:url" content="{{url('product-by-category/'.$singleCategory->id.'/'.str_slug($singleCategory->categoryName).'?category_id='.$singleCategory->id)}}" />
    <meta property="og:image" content="{{url('/storage/images/category/'.$singleCategory->image_ad)}}"/>
@endsection

@section('title')
    <title>Dadavaai | {{$singleCategory->categoryName}} </title>
@endsection
@php
$currentTime = \Carbon\Carbon::now()->format('d-m-Y');
$category_id = request()->query('category_id');
$banner  = App\Banner::select('banner_category_page', 'banner_link_category_page')->first();

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
                        <span><a href="{{url('/all-categories')}}">Categories</a></span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span class="current cat-bread red-clr">{{$singleCategory->categoryName}}</span>
                        <span  id="breadcrumbs" class="hide">
                            
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="theme-container container">
            <div class="main-container row">
                <aside class="col-md-3 col-sm-4">
                    <div class="main-sidebar">
                        <div class="widget sidebar-widget widget_categories clearfix">
                            <h6 class="widget-title">product</h6>
                            <div class="panel-group">
                                @foreach ($categories as $category)
                                    @if($category->id == $category_id)
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('product-by-category/'.$category->id.'/'.str_slug($category->categoryName).'?category_id='.$category->id)}}" class="cat-sidebar cat-{{$category->id}}" aria-expanded="true" style="color: red;"> {{$category->categoryName}} <span>({{count($category->product)}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}} in" aria-expanded="true" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('product-by-subcategory/'.$subcategory->id.'/'.str_slug($subcategory->subCategoryName))}}"> {{$subcategory->subCategoryName}} 
                                                                <span>({{count($subcategory->product)}})</span>
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                <li class="cat-item">
                                                                    <a  href="#" class="minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('product-by-minicategory/'.$minicategory->id)}}">{{$minicategory->miniCategoryName}} 
                                                                        <span>({{count($minicategory->product)}})</span>
                                                                    </a>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <hr>
                                            </div>
                                        </div>                                    
                                    @else
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('product-by-category/'.$category->id.'/'.str_slug($category->categoryName).'?category_id='.$category->id)}}" class="collapsed cat-sidebar cat-{{$category->id}}"> {{$category->categoryName}} <span>({{count($category->product)}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}}" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('product-by-subcategory/'.$subcategory->id.'/'.str_slug($subcategory->subCategoryName))}}"> {{$subcategory->subCategoryName}} 
                                                                <span>({{count($subcategory->product)}})</span>
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                <li class="cat-item">
                                                                    <a  href="#" class="minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('product-by-minicategory/'.$minicategory->id)}}">{{$minicategory->miniCategoryName}} 
                                                                        <span>({{count($minicategory->product)}})</span>
                                                                    </a>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <hr>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div id="search-2" class="widget sidebar-widget widget_search clearfix">
                            <form method="get" id="searchform" class="form-search" action="#">
                                <input data-category="{{$singleCategory->id}}" id="category-product-search" class="form-control search-query" type="text" placeholder="Type Keyword" name="category-product-search" />
                                <button class="btn btn-default search-button" type="submit" name="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        <div class="widget sidebar-widget woocommerce widget_price_filter clearfix">
                            <h6 class="widget-title">Filter by price</h6>
                            <form action="#" id="price_range_form" method="get">
                                <div class="price_slider_wrapper">
                                    <div id="price_slider" class="price_slider"></div>
                                    <div class="price_slider_amount">
                                        <input type="text" id="min_price" name="min_price" value="" data-min="10" placeholder="Min price" />
                                        <input type="text" id="max_price" name="max_price" value="" data-max="100" placeholder="Max price" />
                                        <button type="submit" class="button">Filter</button>
                                        <div class="price_label">
                                            Price: Tk.<span id="label_min" class="from">10</span> &mdash; Tk.<span id="label_max" class="to">100</span>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if ($banner)
                            <div class="widget sidebar-widget">
                                <div class="text-box">
                                    <a href="{{url($banner->banner_link_category_page)}}">
                                        <img src="{{asset('storage/images/banner/'.$banner->banner_category_page)}}" alt="" />
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                </aside>

                <main class="col-md-9 col-sm-8 shop-wrap">
                    <div id="main">
                        {{-- Banner category  page --}}
                        <div class="page-description spcbt-30">
                            <img class="" src="{{url('/storage/images/category/'.$singleCategory->image_ad)}}" alt="banner-category-page" />
                        </div>

                        <div class="row spcbt-30">
                            <div class="col-lg-6 col-sm-6 sorter"> 
                                <ul class="nav-tabs tabination view-tabs">
                                    <li class="active">
                                        <a href="#grid-view" data-toggle="tab">                                                    
                                            <i class="fa fa-th" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    {{-- <li class="">
                                        <a href="#list-view" data-toggle="tab">
                                            <i class="fa fa-th-list"></i>
                                        </a>
                                    </li> --}}
                                </ul>
                                <form action="#" class="sorting-form">
                                    <div class="search-selectpicker selectpicker-wrapper">
                                        <select id="sort-by-type-category"
                                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                                            data-toggle="tooltip" name="sort_by" title="Sort By">                                           
                                            {{-- <option value="popularity">Sort by popularity</option>
                                            <option value="rating">Sort by average rating</option> --}}
                                            <option data-id="{{$singleCategory->id}}" value="date">Sort by newness</option>
                                            <option data-id="{{$singleCategory->id}}" value="price">Sort by price: low to high</option>
                                            <option data-id="{{$singleCategory->id}}" value="price-desc">Sort by price: high to low</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>  
                        {{-- <div id="table_data"> --}}
                            {{-- <div class="tab-content"> --}}
                                    <!-- Product Grid View -->
                                    <div id="grid-view-category" class="tab-pane fade active in" role="tabpanel">
                                        {{-- @include('client.product.fatch_data') --}}
                                        <div class="row text-center hvr2 clearfix">
                                                @foreach ($products as $productGrid)
                                                    <div class="col-md-4 col-sm-6">
                                                        <div class="portfolio-wrapper">
                                                            <div class="portfolio-thumb">
                                                                <img src="{{asset('storage/images/product/'.$productGrid->image->image1)}}" alt="">
                                                                <div class="portfolio-content">   
                                                                    <div class="pop-up-icon">                 
                                                                        <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" data-min_order_qty="{{$productGrid->min_order_qty}}" data-category="{{$productGrid->category->categoryName}}" data-brand="{{$productGrid->brand->brandName}}" data-id="{{$productGrid->id}}" data-category="{{$productGrid->category->categoryName}}" data-slug="{{$productGrid->slug}}" data-name="{{$productGrid->productName}}" 
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

                                                                            {{-- <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$productGrid->slug}}" title="Add To Wishlist" data-id="{{$productGrid->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   --}}
                                                                            <a href="#" class="compare left-link addToCompare" data-placement="top" data-url="{{url('addCompare/'.$productGrid->id)}}" title="Add To Compare">
                                                                                <i class="fa fa-retweet"></i>
                                                                            </a> 
                                                                            <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$productGrid->slug}}" title="Add To Cart" data-id="{{$productGrid->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                                    </div>                                                   
                                                                </div>
                                                            </div>
                                                            <div class="product-content">
                                                                <h3> 
                                                                    <a class="title-3 fsz-13" href="{{url('product/'.$productGrid->id.'/'.$productGrid->slug)}}"> {{substr($productGrid->productName, 0, 30)}} </a> 
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
                                                                            <span class="thm-clr line-through"> Tk{{number_format($productGrid->regularPrice, 2)}}</span>   
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
                                        {{-- <a href="" id="categoryName" hidden>{{str_slug($singleCategory->categoryName)}}</a> 
                                        <a href="" id="cateroryId" hidden>{{$singleCategory->id}}</a>  --}}
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
                            {{-- </div> --}}
                        {{-- </div> --}}
                    </div>
                    <div id="ajax_cat">
                        
                    </div>
                </main>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- / CONTENT + SIDEBAR -->
@endsection
@section('script')
{{-- <script>
    $(document).ready(function(){
    
     $(document).on('click', '.pagination a', function(event){
      event.preventDefault(); 
      var page = $(this).attr('href').split('page=')[1];
      fetch_data(page);
     });
    
     function fetch_data(page)
     {
        var categoryName = $('#categoryName').text();
        var cateroryId = $('#cateroryId').text();
      $.ajax({
       url:"/product-by-category/"+cateroryId+"/"+categoryName+"?page="+page,
       success:function(data)
       {
        $('#table_data').html(data);
       }
      });
     }
     
    });
</script> --}}
@endsection