@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>{{$systemIntegration->title}}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/system-integration-all')}}">System integration</a></li>
                    <li class="breadcrumb-item"><a href="#">{{$systemIntegration->topic}}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->

    <!-- CITY BLOG WRAPER START-->
    <div class="city_blog_wraper" style="background-color: #F5F2F1">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    {!!$systemIntegration->description!!}
                </div>
            </div>
        </div>
    </div>
    <!-- CITY BLOG WRAPER END-->
    <!--CITY AWARD WRAP START-->
    <div class="city_award_wrap" style="background-color: #FFFFFFFF">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-4">
                        {!!$systemIntegration->description_1!!}
                </div>
            </div>
        </div>
    </div>
    <!--CITY AWARD WRAP END-->
    <!--CITY AWARD WRAP START-->
    @if ($systemIntegration->description_2)
        <div class="city_award_wrap" style="background-color: #F5F2F1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-4">
                        {!!$systemIntegration->description_2!!}
                    </div>
                </div>
            </div>
        </div>  
    @endif
    <!--CITY AWARD WRAP END-->
    <!--CITY AWARD WRAP START-->
    @if ($systemIntegration->description_3)
        <div class="city_award_wrap" style="background-color: #FFFFFFFF">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-4">
                            {!!$systemIntegration->description_3!!}
                    </div>
                </div>
            </div>
        </div>  
    @endif
    <!--CITY AWARD WRAP END-->
    <!--CITY AWARD WRAP START-->
    @if ($systemIntegration->description_4)
        <div class="city_award_wrap" style="background-color: #F5F2F1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-4">
                            {!! $systemIntegration->description_4 !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--CITY AWARD WRAP END-->

    <!--CITY AWARD WRAP START-->
    <div class="city_award_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="city_award_list">
                        <span><i class="fa icon-politician"></i></span>
                        <div class="city_award_text">
                            <h3 class="counter">2015</h3>
                            <h3>Established</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="city_award_list">
                        <span><i class="fa icon-cube"></i></span>
                        <div class="city_award_text">
                            <h3 class="counter">75,399</h3>
                            <h3>KM Square</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="city_award_list">
                        <span><i class="fa icon-demographics"></i></span>
                        <div class="city_award_text">
                            @php
                                $products = \App\Product::count();
                            @endphp
                            <h3 class="counter">{{$products}}</h3>
                            <h3>Total Products</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--CITY AWARD WRAP END-->

    <!-- CITY EVENT2 WRAP START-->
    <div class="city_event2_wrap" style="padding:10px 0px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="city_event_detail">
                        <!--CITY HEALTH2 TEXT WRAP START-->
                        <div class="city_health2_text team">
                            <h3 class="event_heading">Related Products</h3>
                            <!--SECTION HEADING END-->
                            <div class="city-health2-slider2">
                                @foreach ($systemIntegration->products as $product)
                                    <div>
                                        <a href="{{url('product-info/'.$product->id.'/'.$product->slug)}}">
                                            <div class="city_senior_team">
                                                <figure class="box">
                                                    <div class="box-layer layer-1"></div>
                                                    <div class="box-layer layer-2"></div>
                                                    <div class="box-layer layer-3"></div>
                                                    <img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt=""style="width: 350px; height: 220px;!important">
                                                </figure>
                                                <div class="city_senior_team_text">
                                                    <h5 style="font-size:12px">{{$product->productName}}</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>	 					
                                @endforeach
                            </div>	
                        </div>
                        <!--CITY HEALTH2 TEXT WRAP END-->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="city_event_detail">
                        <!--CITY HEALTH2 TEXT WRAP START-->
                        <div class="city_health2_text team">
                            <h3 class="event_heading">Related Solutions</h3>
                            <!--SECTION HEADING END-->
                            <div class="city-health2-slider2">
                                @foreach ($systemIntegration->solutions as $solution)
                                    <div>
                                        <a href="{{url('solution/'.$solution->id.'/'.$solution->slug)}}"></a>
                                        <div class="city_senior_team">
                                            <figure class="box">
                                                <div class="box-layer layer-1"></div>
                                                <div class="box-layer layer-2"></div>
                                                <div class="box-layer layer-3"></div>
                                                <img src="{{asset('storage/images/solution/'.$solution->image)}}" alt="" style="width: 350px; height: 220px;!important">
                                            </figure>
                                            <div class="city_senior_team_text">
                                                <h5>{{$solution->solutionName}}</h5>
                                                {{-- <a href="#">01534 482016</a> --}}
                                            </div>
                                        </div>
                                    </div>	 					
                                @endforeach
                            </div>	
                        </div>
                        <!--CITY HEALTH2 TEXT WRAP END-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CITY EVENT2 WRAP END-->
@endsection