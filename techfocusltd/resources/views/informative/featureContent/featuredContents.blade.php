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
    <!-- CITY EVENT2 WRAP START-->
    <div class="city_event2_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar_widget">
                        <!-- EVENT SIDEBAR START-->
                        <div class="event_sidebar">
                            <h4 class="sidebar_heading">Search</h4>
                            <div class="sidebar_search">
                                <input type="text" placeholder="Search" required>
                                <button><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <!-- EVENT SIDEBAR END-->
                        
                        <!-- EVENT SIDEBAR START-->
                        <div class="event_sidebar">
                            <h4 class="sidebar_heading">Categories</h4>
                            <div class="categories_list">
                                <ul>
                                    @if ($categories)
                                        @foreach($categories as $category)
                                            <li id="featuredContentCategory"><a  data-id="{{$category->id}}" href="#">{{$category->categoryName}}<span>({{count($category->featuredContent)}})</span></a></li>
                                        @endforeach                         
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!-- EVENT SIDEBAR END-->
                        
                        <!-- EVENT SIDEBAR START-->
                        <div class="event_sidebar event">
                            <h4 class="sidebar_heading">Tags</h4>
                            <div class="event_categories">
                                <ul>
                                    @if ($tags)
                                        @foreach ($tags as $tag)
                                            <li id="featuredContentTag">
                                                <a data-id="{{$tag->id}}" href="#">{{$tag->tag}}</a>
                                            </li>   
                                        @endforeach
                                        
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!-- EVENT SIDEBAR END-->
                    </div>
                </div>
                <div class="col-md-9">
                    <div  id="defultFearutedContentRow" class="row" >
                        <div id="defultFearutedContent">
                            @foreach($featuredcontents as $featuredcontent)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="city_blog2_fig">
                                    <figure class="overlay">
                                        <img src="{{asset('storage/images/feturedContent/'.$featuredcontent->image)}}" alt="" style="width:420px; height:200px">
                                        <a class="paly_btn" data-rel="prettyPhoto" href="{{asset('storage/images/feturedContent/'.$featuredcontent->image)}}">+</a>
                                        <span class="city_blog2_met">{{$featuredcontent->category->categoryName}}</span>
                                    </figure>
                                    <div class="city_blog2_list">
                                        <ul class="city_meta_list">
                                            <li><a href="#"><i class="fa fa-calendar"></i>{{$featuredcontent->created_at}}</a></li>
                                            <li>
                                                <i class="fa fa-tag"></i>
                                                @foreach($featuredcontent->tags->take(2) as $tag)
                                                    <a href="#">
                                                        {{$tag->tag}},</a>
                                                @endforeach
                                            </li>
                                        </ul>
                                        <div class="city_blog2_text">
                                            <h5><a href="{{url('feature-content/'.$featuredcontent->id)}}">{{$featuredcontent->title}}</a></h5>
                                            <p></p>
                                            <a class="see_more_btn" href="{{url('feature-content/'.$featuredcontent->id)}}">READ MORE<i class="fa icon-right-arrow"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div id="pagination" style="margin-left: 45%">
                                    {{ $featuredcontents->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CITY EVENT2 WRAP END-->
    
    <!--CITY REQUEST WRAP START-->
    {{-- <div class="city_requset_wrap requst02">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="city_request_list">
                        <div class="city_request_row">
                            <span><i class="fa icon-question"></i></span>
                            <div class="city_request_text">
                                <span>Recent</span>
                                <h4>Top Request</h4>
                            </div>
                        </div>
                        <div class="city_request_link">
                            <ul>
                                <li><a href="#">Pay a Parking Ticket</a></li>
                                <li><a href="#">Building Violation</a></li>
                                <li><a href="#">Affordable Housing</a></li>
                                <li><a href="#">Graffiti Removal</a></li>
                                <li><a href="#">Civil Service Exams</a></li>
                                <li><a href="#">Rodent Baiting</a></li>
                                <li class="margin0"><a href="#">Cleaning</a></li>
                                <li class="margin0"><a href="#">Uncleared Sidewalk</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="city_request_list">
                        <div class="city_request_row">
                            <span><i class="fa icon-shout"></i></span>
                            <div class="city_request_text">
                                <span>Recent</span>
                                <h4>Announcement</h4>
                            </div>
                        </div>
                        <div class="city_request_link">
                            <ul>
                                <li><a href="#">Pay a Parking Ticket</a></li>
                                <li><a href="#">Building Violation</a></li>
                                <li><a href="#">Affordable Housing</a></li>
                                <li><a href="#">Graffiti Removal</a></li>
                                <li><a href="#">Civil Service Exams</a></li>
                                <li><a href="#">Rodent Baiting</a></li>
                                <li class="margin0"><a href="#">Cleaning</a></li>
                                <li class="margin0"><a href="#">Uncleared Sidewalk</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	 --}}
    <!--CITY REQUEST WRAP END-->


    <!-- CITY SERVICES2 WRAP START-->
    {{-- <div class="city_service_detail_wrap" style="padding-top:10px">
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
    </div> --}}
@endsection