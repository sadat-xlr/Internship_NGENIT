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
                        <span class="cat-bread"><a href="{{url('service-by-category/'.$miniCategory->subcategory->category->id."/".str_slug($miniCategory->subcategory->category->categoryName).'?category_id='.$miniCategory->subcategory->category->id)}}">{{$miniCategory->subcategory->category->categoryName}}</a></span>
                        <span  id="breadcrumbs">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span><a href="{{url('service-by-subcategory/'.$miniCategory->subcategory->id.'/'.str_slug($miniCategory->subcategory->subCategoryName).'?category_id='.$miniCategory->subcategory->category->id.'&subcategory_id='.$miniCategory->subcategory->id)}}">{{$miniCategory->subcategory->subCategoryName}}</a></span>
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
                            <h6 class="widget-title">service</h6>
                            <div class="panel-group">
                                @foreach ($categories as $category)
                                    @if($category->id == $category_id)
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('service-by-category/'.$category->id.'/'.str_slug($category->categoryName).'?category_id='.$category->id)}}" class="service-cat-sidebar cat-{{$category->id}}" aria-expanded="true" style="color: red;"> {{$category->categoryName}} <span>({{count($category->service)}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}} in" aria-expanded="true" style="">

                                                @foreach ($category->subcategory as $subcategory)
                                                    @if($subcategory->id == $subcategory_id)
                                                        <div class="panel panel-cate panel-subcate mb-10">
                                                            <div class="cate-heading">                                            
                                                                <a data-toggle="collapse" href="#collapse-subcat-{{$subcategory->id}}" class=" service-subcat-sidebar" aria-expanded="true" style="color: red;" data-id="{{$subcategory->id}}" data-cat_id="{{$subcategory->category->id}}" data-url="{{url('service-by-subcategory/'.$subcategory->id.'/'.str_slug($subcategory->subCategoryName))}}"> {{$subcategory->subCategoryName}} 
                                                                    <span>({{count($subcategory->service)}})</span>
                                                                </a>                                           
                                                            </div>
                                                            <div id="collapse-subcat-{{$subcategory->id}}" class="panel-collapse collapse in subcat-panel-collapse subcat-panel-{{$subcategory->id}}" aria-expanded="true">
                                                                <ul>
                                                                    @foreach ($subcategory->minicategory as $minicategory)

                                                                        @if($minicategory->id == $minicategory_id)
                                                                            <li class="cat-item">
                                                                                <a  href="#" class="service-minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('service-by-minicategory/'.$minicategory->id)}}" style="color: red;">{{$minicategory->miniCategoryName}} 
                                                                                    <span>({{count($minicategory->service)}})</span>
                                                                                </a>
                                                                            </li>
                                                                        @else
                                                                            <li class="cat-item">
                                                                                <a  href="#" class="service-minicat-sidebar" data-id="{{$minicategory->id}}" data-cat_id="{{$minicategory->subcategory->category->id}}" data-subcat_id="{{$minicategory->subcategory->id}}"  data-url="{{url('service-by-minicategory/'.$minicategory->id)}}">{{$minicategory->miniCategoryName}} 
                                                                                    <span>({{count($minicategory->service)}})</span>
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
                                                    @endif
                                                @endforeach
                                                <hr>
                                            </div>
                                        </div>                                    
                                    @else
                                        <div class="panel panel-cate">
                                            <div class="cate-heading">                                            
                                                <a data-toggle="collapse" href="#collapse-cat-{{$category->id}}" data-id="{{$category->id}}" data-url="{{url('service-by-category/'.$category->id.'/'.str_slug($category->categoryName).'?category_id='.$category->id)}}" class="collapsed service-cat-sidebar cat-{{$category->id}}"> {{$category->categoryName}} <span>({{count($category->service)}})</span> </a>                                           
                                            </div>
                                            <div id="collapse-cat-{{$category->id}}" class="panel-collapse collapse cat-panel-{{$category->id}}" style="">
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
                                    @endif
                                @endforeach
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
                                                        @foreach ($services as $serviceGrid)
                                                            <div class="col-md-3 col-sm-6">
                                                                <div class="portfolio-wrapper">
                                                                    <div class="">
                                                                        <img src="{{asset('/storage/images/service/'.$serviceGrid->image)}}" alt="">
                                                                    </div>
                                                                    <div class="product-content">
                                                                        <h3> 
                                                                            <a class="title-3 fsz-12" href="{{url('service/'.$serviceGrid->id.'/'.$serviceGrid->slug)}}"> {{substr($serviceGrid->serviceName, 0, 35)}} </a> 
                                                                        </h3>
                                                                        <p class="font-3"> 
                                                                            @if ($serviceGrid->discount)
                                                                                @if ($serviceGrid->deal_id && $serviceGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                                    <span class="thm-clr"> ৳ {{number_format($serviceGrid->regularPrice-(($serviceGrid->regularPrice*($serviceGrid->deal->discount_value + $serviceGrid->discount))/100), 2)}}</span>    
                                                                                    <span class="thm-clr line-through"> ৳ {{number_format($serviceGrid->regularPrice, 2)}}</span>   
                                                                                @else
                                                                                    <span class="thm-clr"> ৳ {{number_format($serviceGrid->regularPrice-(($serviceGrid->regularPrice*$serviceGrid->discount)/100), 2)}}</span>
                                                                                    <span class="thm-clr line-through"> ৳ {{number_format($serviceGrid->regularPrice, 2)}}</span>        
                                                                                @endif
                                                                            @else
                                                                                @if ($serviceGrid->deal_id && $serviceGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                                    <span class="thm-clr"> ৳ {{number_format($serviceGrid->regularPrice-(($serviceGrid->regularPrice*$serviceGrid->deal->discount_value)/100), 2)}}</span>    
                                                                                    <span class="thm-clr line-through"> ৳ {{number_format($serviceGrid->regularPrice, 2)}}</span>   
                                                                                @else
                                                                                    <span class="thm-clr"> ৳ {{number_format($serviceGrid->regularPrice, 2)}}</span>    
                                                                                @endif
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
                                                            @foreach ($tabPanel->services as $tabService)
                                                                <div class="col-md-3 col-sm-6">
                                                                    <div class="portfolio-wrapper">
                                                                        <div class="">
                                                                            <img src="{{asset('/storage/images/service/'.$tabService->image)}}" alt="">
                                                                        </div>
                                                                        <div class="product-content">
                                                                            <h3> 
                                                                                <a class="title-3 fsz-12" href="{{url('service/'.$tabService->id.'/'.$tabService->slug)}}"> {{substr($tabService->serviceName, 0, 35)}} </a> 
                                                                            </h3>
                                                                            <p class="font-3"> 
                                                                            @if ($tabService->discount)
                                                                                    <span class="thm-clr"> ৳ {{number_format($tabService->regularPrice-(($tabService->regularPrice*$tabService->discount)/100), 2)}}</span>
                                                                                    <span class="thm-clr line-through"> ৳ {{number_format($tabService->regularPrice, 2)}}</span>        
                                                                            @else
                                                                                <span class="thm-clr"> ৳ {{number_format($tabService->regularPrice, 2)}}</span>    
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
            <br><br>
        </div>
    </div>
    <div class="clear"></div>
    <!-- / CONTENT + SIDEBAR -->
@endsection
