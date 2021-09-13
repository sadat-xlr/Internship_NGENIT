@extends('layouts.client')

@section('title')
    <title>Search | Dadavaai</title>
@endsection
@php
    $currentTime = \Carbon\Carbon::now()->format('d-m-Y');
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
                        <span><a href="#">Seaech</a></span>
                        <span  id="breadcrumbs" class="">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span class="current cat-bread red-clr"></span>
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
                            <h6 class="widget-title">CATEGORY</h6>
                            <div class="panel-group">
                                @foreach ($categories as $category)
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
                                @endforeach
                            </div>
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
                                                    <li class="cat-item"><a href="#">{{$color->color}}</a></li>
                                                @endforeach
                                            </ul>                                                                                  
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </aside>

                <main class="col-md-9 col-sm-8 shop-wrap">
                    <div id="main">
                    <div class="row spcbt-30">
                        <div class="col-lg-6 col-sm-6 sorter"> 
                            <ul class="nav-tabs tabination view-tabs">
                                <li class="active">
                                    <a href="#grid-view" data-toggle="tab">                                                    
                                        <i class="fa fa-th" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-sm-6 woocommerce-result-count">  {{count($products)}} Results found </div>

                    </div>  
                    <div id="table_data">
                        <div class="tab-content">
                            <!-- Product Grid View -->
                            <div id="grid-view" class="tab-pane fade active in" role="tabpanel">
                                <div class="row text-center hvr2 clearfix">
                                    @foreach ($products as $productGrid)
                                        <div class="col-md-4 col-sm-6">
                                            <div class="portfolio-wrapper">
                                                <div class="portfolio-thumb">
                                                    <img src="{{asset('/storage/images/product/'.$productGrid->image->image1)}}" alt="">
                                                    <div class="portfolio-content">   
                                                        
                                                        <div class="pop-up-icon">                 
                                                            <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" data-id="{{$productGrid->id}}" data-min_order_qty="{{$productGrid->min_order_qty}}" data-category="{{$productGrid->category->categoryName}}" data-brand="{{$productGrid->brand->brandName}}" data-slug="{{$productGrid->slug}}" data-name="{{$productGrid->productName}}" 
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

                                                            <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$productGrid->slug}}" title="Add To Wishlist" data-id="{{$productGrid->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                            <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$productGrid->slug}}" title="Add To Cart" data-id="{{$productGrid->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                        </div>                                                  
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3> <a class="title-3 fsz-16" href="{{url('product/'.$productGrid->id.'/'.$productGrid->slug)}}"> {{$productGrid->productName}} </a> </h3>
                                                    <p class="font-3">Price: 
                                                        @if ($productGrid->discount)
                                                            @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr">
                                                                    ${{number_format($productGrid->regularPrice-(($productGrid->regularPrice*($productGrid->deal->discount_value + $productGrid->discount))/100), 2)}}
                                                                </span>    
                                                                <span class="thm-clr line-through"> ${{$productGrid->regularPrice}}</span>   
                                                            @else
                                                                <span class="thm-clr">
                                                                    ${{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->discount)/100), 2)}}
                                                                </span>
                                                                <span class="thm-clr line-through"> ${{$productGrid->regularPrice}}</span>        
                                                            @endif
                                                        @else
                                                            @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <span class="thm-clr"> 
                                                                    ${{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->deal->discount_value)/100), 2)}}
                                                                </span>    
                                                                <span class="thm-clr line-through"> ${{$productGrid->regularPrice}}</span>   
                                                            @else
                                                                <span class="thm-clr"> ${{$productGrid->regularPrice}}</span>    
                                                            @endif
                                                        @endif 
                                                    </p>    
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- / Product Grid View -->
                        </div>
                    </div>                        
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
<script>
    // $(document).ready(function(){
    
    //  $(document).on('click', '.pagination a', function(event){
    //   event.preventDefault(); 
    //   var page = $(this).attr('href').split('page=')[1];
    //   fetch_data(page);
    //  });
    
    //  function fetch_data(page)
    //  {
    //     var categoryName = $('#cateroryName').text();
    //     var cateroryId = $('#cateroryId').text();
    //   $.ajax({
    //    url:"offers?page="+page,
    //    success:function(data)
    //    {
    //     $('#table_data').html(data);
    //    }
    //   });
    //  }
     
    // });
</script>
@endsection