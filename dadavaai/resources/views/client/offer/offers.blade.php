@extends('layouts.client')

@section('title')
    <title>Offers | Dadavaai</title>
@endsection
@php
    $currentTime = \Carbon\Carbon::now()->format('d-m-Y');
    $banner  = \App\Banner::select('header_two', 'banner_searched_product_page', 'banner_link_searched_product_page')->first();

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
                        <span><a href="#">Offers</a></span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span class="current red-clr">{{ $offerName }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="theme-container container">
            <div class="main-container row">
                <aside class="col-md-3 col-sm-4">
                    <div class="main-sidebar">                        
                        @if('offers-'.str_slug($offerName) == 'offers-discount')
                            <div class="widget sidebar-widget widget_categories clearfix">
                                <h6 class="widget-title">{{ $offerName }}</h6>
                                <div class="panel-group">
                                    @foreach ($categories as $category)
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}" class="collapsed offer-cat-sidebar cat-{{$category->id}}"> {{$category->categoryName}} <span>({{count($category->product->where('discount', '!=', null)->where('published', false))}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}}" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed offer-subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}"> {{$subcategory->subCategoryName}}
                                                                <span>({{count($category->product->where('discount', '!=', null)->where('published', false)->where('subcategory_id', $subcategory->id))}})</span> 
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                <li class="cat-item">
                                                                    <a  href="#" class="offer-minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('offers-'.str_slug($offerName))}}" >{{$minicategory->miniCategoryName}}
                                                                        <span>
                                                                            ({{count($category->product->where('discount', '!=', null)->where('published', false)->where('minicategory_id', $minicategory->id))}})
                                                                        </span> 
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
                        @endif

                        @if('offers-'.str_slug($offerName) == 'offers-occasion')
                            <div class="widget sidebar-widget widget_categories clearfix">
                                <h6 class="widget-title">{{ $offerName }}</h6>
                                <div class="panel-group">
                                    @foreach ($categories as $category)
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}" class="collapsed offer-cat-sidebar cat-{{$category->id}}"> {{$category->categoryName}} <span>({{count($category->product->where('occasion', true)->where('published', false))}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}}" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed offer-subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}"> {{$subcategory->subCategoryName}}
                                                                <span>({{count($category->product->where('occasion', true)->where('published', false)->where('subcategory_id', $subcategory->id))}})</span> 
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                <li class="cat-item">
                                                                    <a  href="#" class="offer-minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('offers-'.str_slug($offerName))}}" >{{$minicategory->miniCategoryName}}
                                                                        <span>
                                                                            ({{count($category->product->where('occasion', true)->where('published', false)->where('minicategory_id', $minicategory->id))}})
                                                                        </span> 
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
                        @endif 

                        @if('offers-'.str_slug($offerName) == 'offers-promotion')
                            <div class="widget sidebar-widget widget_categories clearfix">
                                <h6 class="widget-title">{{ $offerName }}</h6>
                                <div class="panel-group">
                                    @foreach ($categories as $category)
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}" class="collapsed offer-cat-sidebar cat-{{$category->id}}"> {{$category->categoryName}} <span>({{count($category->product->where('promotion', true)->where('published', false))}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}}" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed offer-subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}"> {{$subcategory->subCategoryName}}
                                                                <span>({{count($category->product->where('promotion', true)->where('published', false)->where('subcategory_id', $subcategory->id))}})</span> 
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                <li class="cat-item">
                                                                    <a  href="#" class="offer-minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('offers-'.str_slug($offerName))}}" >{{$minicategory->miniCategoryName}}
                                                                        <span>
                                                                            ({{count($category->product->where('promotion', true)->where('published', false)->where('minicategory_id', $minicategory->id))}})
                                                                        </span> 
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
                        @endif                                 

                        @if('offers-'.str_slug($offerName) == 'offers-clearance')
                            <div class="widget sidebar-widget widget_categories clearfix">
                                <h6 class="widget-title">{{ $offerName }}</h6>
                                <div class="panel-group">
                                    @foreach ($categories as $category)
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}" class="collapsed offer-cat-sidebar cat-{{$category->id}}"> {{$category->categoryName}} <span>({{count($category->product->where('clearance', true)->where('published', false))}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}}" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed offer-subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}"> {{$subcategory->subCategoryName}}
                                                                <span>({{count($category->product->where('clearance', true)->where('published', false)->where('subcategory_id', $subcategory->id))}})</span> 
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                <li class="cat-item">
                                                                    <a  href="#" class="offer-minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('offers-'.str_slug($offerName))}}" >{{$minicategory->miniCategoryName}}
                                                                        <span>
                                                                            ({{count($category->product->where('clearance', true)->where('published', false)->where('minicategory_id', $minicategory->id))}})
                                                                        </span> 
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
                        @endif                                
                       
                        @if('offers-'.str_slug($offerName) == 'offers-buy-get')
                            <div class="widget sidebar-widget widget_categories clearfix">
                                <h6 class="widget-title">{{ $offerName }}</h6>
                                <div class="panel-group">
                                    @foreach ($categories as $category)
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}" class="collapsed offer-cat-sidebar cat-{{$category->id}}"> {{$category->categoryName}} <span>({{count($category->product->where('buy_get', true)->where('published', false))}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}}" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed offer-subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}"> {{$subcategory->subCategoryName}}
                                                                <span>({{count($category->product->where('buy_get', true)->where('published', false)->where('subcategory_id', $subcategory->id))}})</span> 
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                <li class="cat-item">
                                                                    <a  href="#" class="offer-minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('offers-'.str_slug($offerName))}}" >{{$minicategory->miniCategoryName}}
                                                                        <span>
                                                                            ({{count($category->product->where('buy_get', true)->where('published', false)->where('minicategory_id', $minicategory->id))}})
                                                                        </span> 
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
                        @endif

                        @if('offers-'.str_slug($offerName) == 'offers-combo')
                            <div class="widget sidebar-widget widget_categories clearfix">
                                <h6 class="widget-title">{{ $offerName }}</h6>
                                <div class="panel-group">
                                    @foreach ($categories as $category)
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}" class="collapsed offer-cat-sidebar cat-{{$category->id}}"> {{$category->categoryName}} <span>({{count($category->product->where('combo', true)->where('published', false))}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}}" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed offer-subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}"> {{$subcategory->subCategoryName}}
                                                                <span>({{count($category->product->where('combo', true)->where('published', false)->where('subcategory_id', $subcategory->id))}})</span> 
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                <li class="cat-item">
                                                                    <a  href="#" class="offer-minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('offers-'.str_slug($offerName))}}" >{{$minicategory->miniCategoryName}}
                                                                        <span>
                                                                            ({{count($category->product->where('combo', true)->where('published', false)->where('minicategory_id', $minicategory->id))}})
                                                                        </span> 
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
                        @endif
                                                        
                        @if('offers-'.str_slug($offerName) == 'offers-deals')
                            <div class="widget sidebar-widget widget_categories clearfix">
                                <h6 class="widget-title">{{ $offerName }}</h6>
                                <div class="panel-group">
                                    @foreach ($categories as $category)
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}" class="collapsed offer-cat-sidebar cat-{{$category->id}}"> {{$category->categoryName}} <span>({{count($category->product->where('deal_id', '!=', null)->where('published', false))}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}}" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed offer-subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('offers-'.str_slug($offerName))}}"> {{$subcategory->subCategoryName}}
                                                                <span>({{count($category->product->where('deal_id', '!=', null)->where('published', false)->where('subcategory_id', $subcategory->id))}})</span> 
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                <li class="cat-item">
                                                                    <a  href="#" class="offer-minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('offers-'.str_slug($offerName))}}" >{{$minicategory->miniCategoryName}}
                                                                        <span>
                                                                            ({{count($category->product->where('deal_id', '!=', null)->where('published', false)->where('minicategory_id', $minicategory->id))}})
                                                                        </span> 
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
                        @endif

                        <div class="widget sidebar-widget woocommerce widget_price_filter clearfix">
                            <h6 class="widget-title">Filter by price</h6>
                            <form>
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

                        <div class="widget sidebar-widget widget_categories clearfix">
                            <h6 class="widget-title">Offers</h6>
                            <ul>
                                @if('offers-'.str_slug($offerName) != 'offers-discount')
                                    <li class="cat-item"><a href="{{url('offers-discount')}}">Discount</a></li>
                                @endif

                                @if('offers-'.str_slug($offerName) != 'offers-occasion')
                                    <li class="cat-item"><a href="{{url('offers-occasion')}}">Occasion</a></li>
                                @endif 

                                @if('offers-'.str_slug($offerName) != 'offers-promotion')
                                    <li class="cat-item"><a href="{{url('offers-promotion')}}">Promotion</a></li>
                                @endif                                 

                                @if('offers-'.str_slug($offerName) != 'offers-clearance')
                                    <li class="cat-item"><a href="{{url('offers-clearance')}}">Clearance</a></li>
                                @endif                                
                               
                                @if('offers-'.str_slug($offerName) != 'offers-buy-get')
                                    <li class="cat-item"><a href="{{url('offers-buy-get')}}">Buy & Get</a></li>
                                @endif

                                @if('offers-'.str_slug($offerName) != 'offers-combo')
                                    <li class="cat-item"><a href="{{url('offers-combo')}}">Combo</a></li>
                                @endif 

                                @if('offers-'.str_slug($offerName) != 'offers-deals')
                                    <li class="cat-item"><a href="{{url('offers-deals')}}">Deals</a></li>
                                @endif

                                                                
                                
                            </ul>   
                        </div>

                        <div class="widget sidebar-widget">
                            <div class="text-box">
                                <a href="{{url($banner->banner_link_searched_product_page)}}">
                                    <img src="{{asset('storage/images/banner/'.$banner->banner_searched_product_page)}}" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>

                <main class="col-md-9 col-sm-8 shop-wrap">
                    <div id="main">
                        {{-- Banner category  page --}}
                        <div class="page-description spcbt-30">
                            <img src="{{asset('storage/images/banner/'.$banner->header_two)}}" alt="" />
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

                                                        @if ($productGrid->discount)
                                                            @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <div class="icon-discount-label discount-right">
                                                                    {{$productGrid->discount + $productGrid->deal->discount_value}} %  
                                                                </div>  
                                                            @else
                                                                <div class="icon-discount-label discount-right">
                                                                    {{$productGrid->discount}} %  
                                                                </div>          
                                                            @endif
                                                        @else
                                                            @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                <div class="icon-discount-label discount-right">
                                                                    {{$productGrid->deal->discount_value}} %  
                                                                </div>       
                                                            @endif
                                                        @endif



                                                        <img src="{{asset('/storage/images/product/'.$productGrid->image->image1)}}" alt="">
                                                        <div class="portfolio-content">   
                                                            
                                                            <div class="pop-up-icon">                 
                                                                <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" 
                                                                data-id="{{$productGrid->id}}" 
                                                                data-min_order_qty="{{$productGrid->min_order_qty}}" 
                                                                data-category="{{$productGrid->category->categoryName}}" 
                                                                data-brand="{{$productGrid->brand->brandName}}"                                                            
                                                                data-slug="{{$productGrid->slug}}" 
                                                                data-name="{{$productGrid->productName}}" 
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
                                                        <h3> 
                                                            <a class="title-3 fsz-12" href="{{url('product/'.$productGrid->id.'/'.$productGrid->slug)}}"> {{substr($productGrid->productName, 0, 35)}} 
                                                            </a> 
                                                        </h3>
                                                        <p class="font-3"> 
                                                            @if ($productGrid->discount)
                                                                @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    <span class="thm-clr">
                                                                        Tk {{number_format($productGrid->regularPrice-(($productGrid->regularPrice*($productGrid->deal->discount_value + $productGrid->discount))/100), 2)}}
                                                                    </span>    
                                                                    <span class="thm-clr line-through"> Tk {{number_format($productGrid->regularPrice, 2)}}</span>   
                                                                @else
                                                                    <span class="thm-clr">
                                                                        Tk {{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->discount)/100), 2)}}
                                                                    </span>
                                                                    <span class="thm-clr line-through"> Tk {{number_format($productGrid->regularPrice, 2)}}</span>        
                                                                @endif
                                                            @else
                                                                @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                    <span class="thm-clr"> 
                                                                        Tk {{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->deal->discount_value)/100), 2)}}
                                                                    </span>    
                                                                    <span class="thm-clr line-through"> Tk {{number_format($productGrid->regularPrice, 2)}}</span>   
                                                                @else
                                                                    <span class="thm-clr"> Tk {{number_format($productGrid->regularPrice, 2)}}</span>    
                                                                @endif
                                                            @endif 
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

</script>
@endsection