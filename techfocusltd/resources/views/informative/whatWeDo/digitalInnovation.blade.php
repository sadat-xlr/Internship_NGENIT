@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>Digital Innovation</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    {{-- <li class="breadcrumb-item"><a href="{{url('/feature-content')}}">Feature Content</a></li> --}}
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->

    <!-- CITY BLOG WRAPER START-->
    <div class="city_blog_wraper">
        <div class="container">
            <div class="row">
                @foreach ($digitalInnovations as $digitalInnovation)
                    <div class="col-md-4 col-sm-6">
                        <div class="city_blog_grid">
                            <div class="city_blog_grid_text">
                                <span><i class="fa icon-gear"></i></span>
                                <h6><a href="#">{{$digitalInnovation->topic}}</a></h6>
                                <p>{{$digitalInnovation->title}}</p>
                                <a href="{{url('digital-innovation/'.$digitalInnovation->id)}}">See More<i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- CITY BLOG WRAPER END-->


    <!--CITY AWARD WRAP START-->
    <div class="city_award_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="city_award_list">
                        <span><i class="fa icon-politician"></i></span>
                        <div class="city_award_text">
                            <h3 class="counter">1495</h3>
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
                            <h3 class="counter">1,435,268</h3>
                            <h3>Total Population</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--CITY AWARD WRAP END-->
    <!--CITY Product WRAP START-->
    <div class="city_project_wrap">
        <div class="container-fluid">
            <!--SECTION HEADING START-->
            <div class="section_heading center">
                <span>News </span>
                <h2>Content</h2>
            </div>
            <!--SECTION HEADING END-->
            {{-- <div class="city-project-slider">
                    <div>
                        <div class="city_project_fig">
                            <figure >
                                <img src="{{asset('images/flexslider/big-size.jpg')}}"  alt="" style=" width: 250px; height: 250px;!important">
                            </figure>
                            <div>
                                <div class="blog_post_slide_text">
                                    <h6><a href="#">Title</a></h6>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
            </div> --}}
        </div>
    </div>	
    <!--CITY Product WRAP END-->
@endsection