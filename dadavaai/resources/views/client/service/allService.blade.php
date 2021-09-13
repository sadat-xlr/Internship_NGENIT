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
                            <h6 class="widget-title">Service</h6>
                            <div class="panel-group">
                                @foreach ($categories as $category)
                                    @if($category->id == $category_id)
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('service-by-category/'.$category->id.'/'.str_slug($category->categoryName).'?category_id='.$category->id)}}" class="service-cat-sidebar cat-{{$category->id}}" aria-expanded="true" style="color: red;"> {{$category->categoryName}} <span>({{count($category->service)}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}} in" aria-expanded="true" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed service-subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('service-by-subcategory/'.$subcategory->id.'/'.str_slug($subcategory->subCategoryName))}}"> {{$subcategory->subCategoryName}} 
                                                                <span>({{count($subcategory->service)}})</span>
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                <li class="cat-item">
                                                                    <a  href="#" class="service-minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('service-by-minicategory/'.$minicategory->id)}}">{{$minicategory->miniCategoryName}} 
                                                                        <span>({{count($minicategory->service)}})</span>
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
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('service-by-category/'.$category->id.'/'.str_slug($category->categoryName).'?category_id='.$category->id)}}" class="collapsed cat-sidebar cat-{{$category->id}}"> {{$category->categoryName}} <span>({{count($category->service)}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}}" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('service-by-subcategory/'.$subcategory->id.'/'.str_slug($subcategory->subCategoryName))}}"> {{$subcategory->subCategoryName}} 
                                                                <span>({{count($subcategory->service)}})</span>
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                <li class="cat-item">
                                                                    <a  href="#" class="minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('service-by-minicategory/'.$minicategory->id)}}">{{$minicategory->miniCategoryName}} 
                                                                        <span>({{count($minicategory->service)}})</span>
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

                       
                        <!-- Product Grid View -->
                        <div id="grid-view-category" class="tab-pane fade active in" role="tabpanel">
                            
                            <div class="row text-center hvr2 clearfix">
                                    @foreach ($services as $serviceGrid)
                                        <div class="col-md-3 col-sm-6">
                                            <div class="portfolio-wrapper">
                                                <div class="portfolio-thumb">
                                                    <img src="{{asset('storage/images/service/'.$serviceGrid->image)}}" alt="">
                                                    {{-- <div class="portfolio-content">   
                                                        <div class="pop-up-icon">                 
                                                            <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" data-min_order_qty="{{$serviceGrid->min_order_qty}}" data-category="{{$serviceGrid->category->categoryName}}" data-id="{{$serviceGrid->id}}" data-category="{{$serviceGrid->category->categoryName}}" data-slug="{{$serviceGrid->slug}}" data-name="{{$serviceGrid->productName}}" 
                                                                data-image="{{asset('/storage/images/service/'.$serviceGrid->image)}}" 
                                                                data-desc="{{strip_tags($serviceGrid->shortDescription)}}" 
                                                                @if ($serviceGrid->discount)
                                                                    data-sale="{{number_format($serviceGrid->regularPrice-(($serviceGrid->regularPrice*$serviceGrid->discount)/100), 2)}}"
                                                                    data-regular="{{$serviceGrid->regularPrice}}"
                                                                @else
                                                                    data-regular="{{$serviceGrid->regularPrice}}"
                                                                @endif  
                                                                data-url="{{url('service/'.$serviceGrid->id.'/'.$serviceGrid->slug)}}"><i class="fa fa-search"></i></a>
                                                                <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$serviceGrid->slug}}" title="Add To Cart" data-id="{{$serviceGrid->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                        </div>                                                   
                                                    </div> --}}
                                                </div>
                                                <div class="product-content">
                                                    <h3> 
                                                        <a class="title-3 fsz-12" href="{{url('service/'.$serviceGrid->id.'/'.$serviceGrid->slug)}}"> {{substr($serviceGrid->serviceName, 0, 35)}} </a> 
                                                    </h3>
                                                    <p class="font-3"> 
                                                        @if ($serviceGrid->discount)
                                                            <span class="thm-clr"> Tk {{number_format($serviceGrid->regularPrice-(($serviceGrid->regularPrice*$serviceGrid->discount)/100), 2)}}</span>
                                                            <span class="thm-clr line-through"> Tk {{number_format($serviceGrid->regularPrice, 2)}}</span>        
                                                        @else
                                                            <span class="thm-clr"> Tk {{number_format($serviceGrid->regularPrice, 2)}}</span>    
                                                        @endif  
                                                    </p>    
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                            <nav class="woocommerce-pagination">
                                {{$services->links()}}
                            </nav>
                        </div>
                        <!-- / Product Grid View -->
                    </div>
                    <div id="ajax_cat">
                        
                    </div>
                </main>
            </div>
            <br><br>
        </div>
    </div>
    <div class="clear"></div>
    <!-- / CONTENT + SIDEBAR -->
@endsection
