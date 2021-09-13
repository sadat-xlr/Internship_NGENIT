@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>Featured Content</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item">Feature Content</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->
    <!-- CITY SERVICES2 WRAP START-->
    <div class="city_service_detail_wrap" style="padding-top:10px">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar_widget">
                        <!-- CITY SERVICE TABS START-->
                        <div class="city_service_tabs tabs">
                            <ul class="tab-links">
                                <li style="text-align:center; font-size:25px;"><b>Content Title </b></li>
                                @foreach ($featuredcontents as $featuredcontent)
                                <li class=""><a href="#tab{{$featuredcontent->id}}">{{$featuredcontent->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- CITY SERVICE TABS END-->
                        @php
                            $contact = \App\Contact::all()->first();
                        @endphp
                        <!-- CITY SIDE INFO START-->
                        <div class="city_side_info">
                            <span><i class="fa fa-github"></i></span>
                            <h4>Let’s Help You</h4>
                            <h6>{{$contact->phone1}}, <br>{{$contact->address}}</h6>
                        </div>
                        <!-- CITY SIDE INFO END-->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tabs">
                        <div class="tab-content">
                            <div class="tab active">
                                <div class="city_service_tabs_list">
                                    <figure class="box">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        <img src="{{asset('informative/extra-images/service-banner.jpg')}}" alt="">
                                    </figure>
                                    <div class="city_service_tabs_text">
                                        <h3>Feature Content</h3>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            @foreach ($featuredcontents as $featuredcontent)
                            @if (count($featuredcontents)>0)
                                <div id="tab{{$featuredcontent->id}}" class="tab">
                                    <div class="city_service_tabs_list">
                                        <figure class="box">
                                            <div class="box-layer layer-1"></div>
                                            <div class="box-layer layer-2"></div>
                                            <div class="box-layer layer-3"></div>
                                            <img src="{{asset('storage/images/feturedContent/'.$featuredcontent->image)}}" alt="">
                                        </figure>
                                        <div class="city_service_tabs_text">
                                            <h3>{{$featuredcontent->title}}</h3>
                                            <p>{!!$featuredcontent->description!!}</p>
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
    </div>
@endsection