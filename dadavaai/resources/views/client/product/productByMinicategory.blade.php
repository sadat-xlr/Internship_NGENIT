@extends('layouts.client')

@section('title')
    <title>{{$miniCategory->miniCategoryName}} | Dadavaai</title>
@endsection
@php
$currentTime = \Carbon\Carbon::now()->format('d-m-Y');
$banner  = \App\Banner::select('banner_product_page', 'banner_link_product_page')->first();
$category_id = request()->query('category_id');
$subcategory_id = request()->query('subcategory_id');
$minicategory_id = request()->query('minicategory_id');

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
                        <span class="cat-bread"><a href="{{url('product-by-category/'.$miniCategory->subcategory->category->id."/".str_slug($miniCategory->subcategory->category->categoryName).'?category_id='.$miniCategory->subcategory->category->id)}}">{{$miniCategory->subcategory->category->categoryName}}</a></span>
                        <span  id="breadcrumbs">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span><a href="{{url('product-by-subcategory/'.$miniCategory->subcategory->id.'/'.str_slug($miniCategory->subcategory->subCategoryName).'?category_id='.$miniCategory->subcategory->category->id.'&subcategory_id='.$miniCategory->subcategory->id)}}">{{$miniCategory->subcategory->subCategoryName}}</a></span>
                            <i class="fa fa-arrow-circle-right"></i>
                            <span class="current red-clr">{{$miniCategory->miniCategoryName}}</span>
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
                                                    @if($subcategory->id == $subcategory_id)
                                                        <div class="panel panel-cate panel-subcate mb-10">
                                                            <div class="cate-heading">                                            
                                                                <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class=" subcat-sidebar" aria-expanded="true" style="color: red;" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('product-by-subcategory/'.$subcategory->id.'/'.str_slug($subcategory->subCategoryName))}}"> {{$subcategory->subCategoryName}} 
                                                                    <span>({{count($subcategory->product)}})</span>
                                                                </a>                                           
                                                            </div>
                                                            <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse in subcat-panel-collapse subcat-panel-{{$subcategory->id}}" aria-expanded="true">
                                                                <ul>
                                                                    @foreach ($subcategory->minicategory as $minicategory)

                                                                        @if($minicategory->id == $minicategory_id)
                                                                            <li class="cat-item">
                                                                                <a  href="#" class="minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('product-by-minicategory/'.$minicategory->id)}}" style="color: red;">{{$minicategory->miniCategoryName}} 
                                                                                    <span>({{count($minicategory->product)}})</span>
                                                                                </a>
                                                                            </li>
                                                                        @else
                                                                            <li class="cat-item">
                                                                                <a  href="#" class="minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('product-by-minicategory/'.$minicategory->id)}}">{{$minicategory->miniCategoryName}} 
                                                                                    <span>({{count($minicategory->product)}})</span>
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>                                                        
                                                    @else
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
                                                    @endif
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

                        <div class="widget sidebar-widget woocommerce widget_price_filter clearfix">
                            <h6 class="widget-title">Filter by price</h6>
                            <form action="{{url('sort-by-price-range')}}" method="GET">
                                <div class="price_slider_wrapper">
                                    <div id="price_slider" class="price_slider"></div>
                                    <div class="price_slider_amount">
                                        <input type="text" id="min_price" name="min_price" value="" data-min="10" placeholder="Min price" />
                                        <input type="text" id="max_price" name="max_price" value="" data-max="10000" placeholder="Max price" />
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
                                                    <li id="miniCategoryColor" class="cat-item"><a data-id="{{$color->id}}" data-mini="{{$miniCategory->id}}" href="#">{{$color->color}}</a></li>
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
                                            <a data-toggle="collapse" href="#size5" class="collapsed"> All Sizes</a>                                           
                                        </div>
                                        <div id="size5" class="panel-collapse collapse">
                                            <ul>
                                                @foreach ($sizes as $size)
                                                    <li id="miniCategorySize" class="cat-item"><a data-id="{{$size->id}}" data-mini="{{$miniCategory->id}}" href="#">{{$size->size}}</a></li>
                                                @endforeach
                                            </ul>                                                                                 
                                        </div>
                                    </div>
                            </div>
   
                        </div>
                
                        <div class="widget sidebar-widget">
                            <div class="text-box">
                                <a href="{{url($banner->banner_link_product_page)}}">
                                    <img src="{{asset('storage/images/banner/'.$banner->banner_product_page)}}" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>

                <main class="col-md-9 col-sm-8 shop-wrap">
                    <div id="main">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                          <li class="fsz-13 active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All</a></li>
                          @foreach ($miniCategory->tabs as $tab)
                            <li><a class="fsz-13" href="#tab{{$tab->id}}" aria-controls="tab{{$tab->id}}" role="tab" data-toggle="tab">{{$tab->tabName}}</a></li>
                          @endforeach
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="all">
                                <div class="site-tab">
                                    {{-- <div class="container text-center"> --}}
                                    <div class="text-center">
                                        <!-- Portfolio items -->
                                        <div id="table_data">
                                            <div class="tab-content">
                                                <!-- Product Grid View -->
                                                <div id="grid-view-minicategory" class="tab-pane fade active in" role="tabpanel">
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
                    
                                                                                {{-- <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$productGrid->slug}}" title="Add To Wishlist" data-id="{{$productGrid->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>  --}}
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
                                                                                    <span class="thm-clr fsz-13"> ৳ {{number_format($productGrid->regularPrice-(($productGrid->regularPrice*($productGrid->deal->discount_value + $productGrid->discount))/100), 2)}}</span>    
                                                                                    <span class="thm-clr line-through"> ৳ {{number_format($productGrid->regularPrice, 2)}}</span>   
                                                                                @else
                                                                                    <span class="thm-clr fsz-13"> ৳ {{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->discount)/100), 2)}}</span>
                                                                                    <span class="thm-clr line-through"> ৳ {{number_format($productGrid->regularPrice, 2)}}</span>        
                                                                                @endif
                                                                            @else
                                                                                @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                                    <span class="thm-clr fsz-13"> ৳ {{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->deal->discount_value)/100), 2)}}</span>    
                                                                                    <span class="thm-clr line-through"> ৳ {{number_format($productGrid->regularPrice, 2)}}</span>   
                                                                                @else
                                                                                    <span class="thm-clr fsz-13"> ৳ {{number_format($productGrid->regularPrice, 2)}}</span>    
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
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @foreach ($miniCategory->tabs as $tabPanel)
                                <div role="tabpanel" class="tab-pane" id="tab{{$tabPanel->id}}">
                                    <div class="site-tab">
                                        {{-- <div class="container text-center"> --}}
                                        <div class="text-center">
                                            <!-- Portfolio items -->
                                            <div id="table_data">
                                                <div class="tab-content">
                                                    <!-- Product Grid View -->
                                                    <div id="grid-view-minicategory" class="tab-pane fade active in" role="tabpanel">
                                                        <div class="row text-center hvr2 clearfix">
                                                            @foreach ($tabPanel->products as $tabProduct)
                                                                <div class="col-md-4 col-sm-6">
                                                                    <div class="portfolio-wrapper">
                                                                        <div class="portfolio-thumb">
                                                                            <img src="{{asset('/storage/images/product/'.$tabProduct->image->image1)}}" alt="">
                                                                            <div class="portfolio-content">   
                                                                                <div class="pop-up-icon">                 
                                                                                    <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" data-id="{{$tabProduct->id}}" data-slug="{{$tabProduct->slug}}" data-name="{{$tabProduct->productName}}" 
                                                                                    data-image="{{asset('/storage/images/product/'.$tabProduct->image->image1)}}" 
                                                                                    data-desc="{{strip_tags($tabProduct->shortDescription)}}" 
                                                                                @if ($tabProduct->discount)
                                                                                    @if ($tabProduct->deal_id && $tabProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                                            
                                                                                        data-sale="{{number_format($tabProduct->regularPrice-(($tabProduct->regularPrice*($tabProduct->deal->discount_value + $tabProduct->discount))/100), 2)}}"
                                
                                                                                        data-regular="{{$tabProduct->regularPrice}}"
                                                                                            
                                                                                    @else
                                                                                        data-sale="{{number_format($tabProduct->regularPrice-(($tabProduct->regularPrice*$tabProduct->discount)/100), 2)}}"
                                                                                        data-regular="{{$tabProduct->regularPrice}}"
                                
                                                                                    @endif
                                                                                @else
                                                                                    @if ($tabProduct->deal_id && $tabProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                                        data-sale="{{number_format($tabProduct->regularPrice-(($tabProduct->regularPrice*$tabProduct->deal->discount_value)/100), 2)}}"
                                                                                        data-regular="{{$tabProduct->regularPrice}}"
                                                                                    @else
                                                                                        data-regular="{{$tabProduct->regularPrice}}"
                                                                                    @endif
                                                                                @endif  
                                                                                    data-url="{{url('product/'.$tabProduct->id.'/'.$tabProduct->slug)}}"><i class="fa fa-search"></i></a>
                        
                                                                                    <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$tabProduct->slug}}" title="Add To Wishlist" data-id="{{$tabProduct->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                                                                    <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$tabProduct->slug}}" title="Add To Cart" data-id="{{$tabProduct->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                                                                </div>                                                  
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-content">
                                                                            <h3> 
                                                                                <a class="title-3 fsz-12" href="{{url('product/'.$tabProduct->id.'/'.$tabProduct->slug)}}"> {{substr($tabProduct->productName, 0, 35)}} </a> 
                                                                            </h3>
                                                                            <p class="font-3"> 
                                                                            @if ($tabProduct->discount)
                                                                                @if ($tabProduct->deal_id && $tabProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                                    <span class="thm-clr"> ৳ {{number_format($tabProduct->regularPrice-(($tabProduct->regularPrice*($tabProduct->deal->discount_value + $tabProduct->discount))/100), 2)}}</span>    
                                                                                    <span class="thm-clr line-through"> ৳ {{number_format($tabProduct->regularPrice, 2)}}</span>   
                                                                                @else
                                                                                    <span class="thm-clr"> ৳ {{number_format($tabProduct->regularPrice-(($tabProduct->regularPrice*$tabProduct->discount)/100), 2)}}</span>
                                                                                    <span class="thm-clr line-through"> ৳ {{number_format($tabProduct->regularPrice, 2)}}</span>        
                                                                                @endif
                                                                            @else
                                                                                @if ($tabProduct->deal_id && $tabProduct->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                                    <span class="thm-clr"> ৳ {{number_format($tabProduct->regularPrice-(($tabProduct->regularPrice*$tabProduct->deal->discount_value)/100), 2)}}</span>    
                                                                                    <span class="thm-clr line-through"> ৳ {{number_format($tabProduct->regularPrice, 2)}}</span>   
                                                                                @else
                                                                                    <span class="thm-clr"> ৳ {{number_format($tabProduct->regularPrice, 2)}}</span>    
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
                                    </div>
                                </div>
                            @endforeach
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
@endsection
