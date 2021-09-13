@extends('layouts.client')

@section('title')
    <title>All Brands | Dadavaai </title>
@endsection

@php
    $category_id = request()->query('category_id');
@endphp

@section('content')
    <!-- CONTENT + SIDEBAR -->
    <div class="main-wrapper clearfix">
        <div class="site-pagetitle jumbotron" style="margin-bottom: 10px;">
            <div class="container text-center">
                <h3>All Brands</h3>

                <!-- Breadcrumbs -->
                <div class="breadcrumbs">
                    <div class="breadcrumbs text-center">
                        <i class="fa fa-home"></i>
                        <span><a href="{{url('/')}}">Home</a></span>

                        <i class="fa fa-arrow-circle-right"></i>
                        <span class="current">All Brands</span>

                        @if($category_id)

                            <i class="fa fa-arrow-circle-right"></i>
                            <span class="current cat-bread red-clr">{{$singleCategory->categoryName}}</span>
                        @else
                            <i class="fa fa-arrow-circle-right"></i>
                            <span class="current cat-bread red-clr"></span>
                        @endif

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
                        <div id="search-2" class="widget sidebar-widget widget_search clearfix">
                            <form method="get" id="searchform" class="form-search" action="#">
                                <input id="brand-search" class="form-control search-query" type="text" placeholder="Type Keyword" name="brand-search" />
                                <button class="btn btn-default search-button" type="submit" name="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget sidebar-widget widget_categories clearfix">
                            <h6 class="widget-title">Brand</h6>
                            <div class="panel-group">
                                @foreach ($categories as $category)

                                    @if($category->id == $category_id)
                                        @php
                                            $brandNumberCategory = \App\Product::select('brands.brandName','brands.id', 'brands.brandImage')->distinct('brands.brandName')->where('category_id', $category->id)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->get();
                                        @endphp
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('product-by-category/'.$category->id.'/'.str_slug($category->categoryName).'?category_id='.$category->id)}}" class="brand-cat-sidebar cat-{{$category->id}}" aria-expanded="true" style="color: red;"> {{$category->categoryName}} <span>({{count($brandNumberCategory)}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}} in" aria-expanded="true" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    @php
                                                        $brandNumberSubcategory = \App\Product::select('brands.brandName','brands.id', 'brands.brandImage')->distinct('brands.brandName')->where('subcategory_id', $subcategory->id)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->get();
                                                    @endphp
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed brand-subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('product-by-subcategory/'.$subcategory->id.'/'.str_slug($subcategory->subCategoryName))}}"> {{$subcategory->subCategoryName}} 
                                                                <span>({{count($brandNumberSubcategory)}})</span>
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                @php
                                                                    $brandNumberMinicategory = \App\Product::select('brands.brandName','brands.id', 'brands.brandImage')->distinct('brands.brandName')->where('minicategory_id', $minicategory->id)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->get();
                                                                @endphp
                                                                <li class="cat-item">
                                                                    <a  href="#" class="brand-minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('product-by-minicategory/'.$minicategory->id)}}">{{$minicategory->miniCategoryName}} 
                                                                        <span>({{count($brandNumberMinicategory)}})</span>
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

                                        @php
                                            $brandNumberCategory = \App\Product::select('brands.brandName','brands.id', 'brands.brandImage')->distinct('brands.brandName')->where('category_id', $category->id)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->get();
                                        @endphp
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('product-by-category/'.$category->id.'/'.str_slug($category->categoryName).'?category_id='.$category->id)}}" class="collapsed brand-cat-sidebar cat-{{$category->id}}"> {{$category->categoryName}} <span>({{count($brandNumberCategory)}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}}" style="">
                                                @foreach ($category->subcategory as $subcategory)
                                                    @php
                                                        $brandNumberSubcategory = \App\Product::select('brands.brandName','brands.id', 'brands.brandImage')->distinct('brands.brandName')->where('subcategory_id', $subcategory->id)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->get();
                                                    @endphp
                                                    <div class="panel panel-cate panel-subcate mb-10">
                                                        <div class="cate-heading">                                            
                                                            <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class="collapsed brand-subcat-sidebar" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('product-by-subcategory/'.$subcategory->id.'/'.str_slug($subcategory->subCategoryName))}}"> {{$subcategory->subCategoryName}} 
                                                                <span>({{count($brandNumberSubcategory)}})</span>
                                                            </a>                                           
                                                        </div>
                                                        <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse subcat-panel-collapse subcat-panel-{{$subcategory->id}}">
                                                            <ul>
                                                                @foreach ($subcategory->minicategory as $minicategory)
                                                                @php
                                                                    $brandNumberMinicategory = \App\Product::select('brands.brandName','brands.id', 'brands.brandImage')->distinct('brands.brandName')->where('minicategory_id', $minicategory->id)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->get();
                                                                @endphp
                                                                <li class="cat-item">
                                                                    <a  href="#" class="brand-minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('product-by-minicategory/'.$minicategory->id)}}">{{$minicategory->miniCategoryName}} 
                                                                        <span>({{count($brandNumberMinicategory)}})</span>
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
                    </div>
                </aside>
                <main class="col-md-9 col-sm-9 shop-wrap">
                    <div id="grid-view-brand" class="tab-pane fade active in" role="tabpanel">
                        @foreach ($brands as $brand)
                            <a href="{{url('product-by-brand/'.$brand->id.'/'.str_slug($brand->brandName))}}" class="">
                                <div class="col-lg-2 col-md-3 col-sm-3 menu-block mb-3" style="padding: 5px;">
                                    <div class="sub-list text-center" style="height: 120px">
                                        <div class="menu-card" style="border: #999 1px solid; border-radius: 5px;">
                                            <img class="" src="{{asset('storage/images/brand/'.$brand->brandImage)}}" height="100%" width="100%" alt="{{$brand->brandName}}" style="padding: 10px;">
                                        </div>
                                        <div>
                                            <h5 class="fsz-10 mt-20">{{$brand->brandName}}</h5>
                                        </div>
                                        <br>
                                    </div>
                                </div> 
                            </a>
                        @endforeach
                    </div>

                    <!--  Ajax result of sort by product View -->
                    <div class=" tab-pane fade active in" role="tabpanel">
                        <div id="sort" class="row text-center hvr2 clearfix">
    
                        </div>
                    </div>
                    <!-- / Ajax result of sort by product View -->
                </main>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- / CONTENT + SIDEBAR -->
@endsection