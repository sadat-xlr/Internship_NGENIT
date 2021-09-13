@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>Services</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/services')}}">Services</a></li>
                    <li class="breadcrumb-item active">Services detail</li>
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
                        <h2><span>{{$service->title}}</h2>
                        <p>{!!$service->description!!}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="city_health_fig">
                        <figure class="box">
                            <div class="box-layer layer-1"></div>
                            <div class="box-layer layer-2"></div>
                            <div class="box-layer layer-3"></div>
                            <img src="{{asset('storage/images/service/'.$service->image)}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>	
    </div>
    <!-- CITY SERVICES2 WRAP END-->
    
    
    <!-- CITY SERVICES2 WRAP START-->
    <div class="city_service_detail_wrap">
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
                        
                        @php
                            $contact = \App\Contact::all()->first();
                        @endphp
                        <!-- CITY SIDE INFO START-->
                        <div class="city_side_info">
                            <span><i class="fa fa-github"></i></span>
                            <h4>Let’s Help You</h4>
                            <h6>{{$contact->phone1}},  {{$contact->phone2}}<br>{{$contact->address}}</h6>
                        </div>
                        <!-- CITY SIDE INFO END-->
                        
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tabs">
                        <div class="tab-content">
                            @foreach ($services as $itemTab)
                                @if ($service->id != $itemTab->id)
                                    <div id="tab{{$itemTab->id}}" class="tab active">
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
    </div>	
@endsection