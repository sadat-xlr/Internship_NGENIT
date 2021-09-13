@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>Solutions</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/solutions')}}">Solutions</a></li>
                    <li class="breadcrumb-item active">{{$solution->solutionName}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->
    
    <!-- CITY SERVICES2 WRAP START-->
    <div class="city_health_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="city_health_text">
                        <h2>{{$solution->solutionName}}</h2>
                        <p>{!!$solution->description!!}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="city_health_fig">
                        <figure class="box">
                            <div class="box-layer layer-1"></div>
                            <div class="box-layer layer-2"></div>
                            <div class="box-layer layer-3"></div>
                            <img src="{{asset('storage/images/solution/'.$solution->image)}}" alt="" style="height:250px">
                        </figure>
                    </div>
                </div>
            </div>
        </div>	
    </div>
    <!-- CITY SERVICES2 WRAP END-->
    <!-- All Security of a Specific Solution  WRAP START-->
    <div class="city_services2_wrap">
        <div class="container">
            <div class="row">
                @if (count($solution->subSolutions)>0)
                    @foreach ($solution->subSolutions as $item)
                    <div class="col-md-4 col-sm-6">
                        <div class="city_service2_fig">
                            <figure class="overlay">
                                <img src="{{asset('storage/images/subSolution/'.$item->image)}}" alt="">
                                <div class="city_service2_list">
                                    {{-- <span><i class="fa icon-law-2"></i></span> --}}
                                    <div class="city_service2_caption">
                                        <h4>{{$item->subSolutionName}}</h4>
                                    </div>
                                </div>
                            </figure>
                            <div class="city_business_list">
                                <ul class="city_busine_detail">
                                    @foreach ($item->products->take(2) as $product)
                                        <li><a href="{{url('product-info/'.$product->id.'/'.$product->slug)}}"><i class="fa fa-star-o"></i><span class="block-text">{{$product->productName}} </span></a></li>
                                    @endforeach
                                </ul>
                                <a class="see_more_btn" href="{{url('sub-solution/'.$item->id.'/'.$item->slug)}}">See More <i class="fa icon-next-1"></i></a>
                            </div>
                        </div>
                    </div>                           
                    @endforeach
                @endif
            </div>
        </div>	
    </div>
    <!-- All Security of a Specific Solution WRAP END-->
    
    
    <!-- CITY SERVICES2 WRAP START-->
    {{-- <div class="city_service_detail_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar_widget">
                        <!-- CITY SERVICE TABS START-->
                        <div class="city_service_tabs tabs">
                            <ul class="tab-links">
                                @foreach ($services as $item)
                                    @if ($service->id != $item->id)
                                        <li><a href="#tab{{$item->id}}">{{$item->title}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <!-- CITY SERVICE TABS END-->
                        
                        <!-- CITY SIDE INFO START-->
                        <div class="city_side_info">
                            <span><i class="fa fa-github"></i></span>
                            <h4>Let’s Help You</h4>
                            <h6>908-879-5100 89, <br>Avenue 454 <br> NY, USA</h6>
                        </div>
                        <!-- CITY SIDE INFO END-->
                        
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tabs">
                        <div class="tab-content">
                            @foreach ($services as $itemTab)
                                @if ($service->id != $itemTab->id)
                                    <div id="tab1" class="tab active">
                                        <div class="city_service_tabs_list">
                                            <figure class="box">
                                                <div class="box-layer layer-1"></div>
                                                <div class="box-layer layer-2"></div>
                                                <div class="box-layer layer-3"></div>
                                                <img src="{{asset('storage/images/service/'.$itemTab->image)}}" alt="">
                                            </figure>
                                            <div class="city_service_tabs_text">
                                                <h3>{{$itemTab->title}}</h3>
                                                <p>{!!$itemTab->description!!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>	
        </div>		
    </div>	 --}}
@endsection