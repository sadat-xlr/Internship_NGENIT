@extends('informative.layouts.master')

@section('content')
		
{{-- 
<!-- SAB BANNER START-->
<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Login</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Login</li>
            </ul>
        </div>
    </div>
</div>
<!-- SAB BANNER END--> --}}

<!--D HELP LOGIN WRAP START-->
<div class="city_login_wrap" style="padding:20px 0px 140px 0px">
    <div class="container">
        <div class="city_login_list">
            {{-- <div class="city_login" style="width:30% !important;">
                <h4 style="font-size:16px">Search</h4>
                <div>
                    <div class="banner_search_form">
                        <div class="banner_search_field animated">
                            <form action="{{url('/search-page')}}" method="post">
                                {{ csrf_field() }}
                                <input type="text" name="query" placeholder="Search here" style="color:#1b6492">
                                <a href="#" type="submit"><i class="fa fa-search"></i></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="city_login" style="width:30% !important;">
                <div class="sidebar_widget">
                    <!-- EVENT SIDEBAR START-->
                    <div class="event_sidebar">
                        <h4 class="sidebar_heading">Search</h4>
                        <div class="sidebar_search">
                            <form action="{{url('/search-page')}}" method="post">
                                {{ csrf_field() }}
                                <input type="text" name="query" placeholder="Search" required>
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="city_login register" style="width:70% !important;">
                <h4 style="font-size:16px">Search Result</h4>
                <div>
                    <ul style="display:block;margin-top:30px; padding-left:0px">
                        @if ($solutions)
                            {{-- <li><b style="color:#1b6492">Solutions</b></li> --}}
                            @foreach ($solutions as $solution)
                                @if ($solution->solutionName)
                                    <li><a href="{{url('solution/'.$solution->id.'/'.$solution->slug)}}">{{$solution->solutionName}}</a></li>
                                @endif
                                @if ($solution->description)
                                    <li><a href="{{url('solution/'.$solution->id.'/'.$solution->slug)}}">{{$solution->description}}</a></li>
                                @endif
                            @endforeach
                        @endif
                        @if ($brands)
                            {{-- <li><b style="color:#1b6492">brands</b></li> --}}
                            @foreach ($brands as $brand)
                                <li><a href="{{url('brand-details/'.$brand->id)}}">{{$brand->brandName}}</a></li>
                            @endforeach
                        @endif
                        @if ($products)
                            {{-- <li><b style="color:#1b6492">brands</b></li> --}}
                            @foreach ($products as $product)
                                @if ($product->productName)
                                    <li><a href="{{url('product-info/'.$product->id.'/'.$product->slug)}}">{{$product->productName}}</a></li>
                                @endif
                                @if ($product->sku)
                                    <li><a href="{{url('product-info/'.$product->id.'/'.$product->slug)}}">{{$product->sku}}</a></li>
                                @endif
                                @if ($product->shortDescription)
                                    <li><a id="description-text" href="{{url('product-info/'.$product->id.'/'.$product->slug)}}">{!!$product->shortDescription!!}</a></li>
                                @endif
                                @if ($product->description)
                                    <li><a id="description-text" href="{{url('product-info/'.$product->id.'/'.$product->slug)}}">{!!$product->description!!}</a></li>
                                @endif
                                @if ($product->specification)
                                    <li><a id="description-text" href="{{url('product-info/'.$product->id.'/'.$product->slug)}}">{!!$product->specification!!}</a></li>
                                @endif
                            @endforeach
                        @endif
                        @if ($blogs)
                            @foreach ($blogs as $blog)
                                @if ($blog->blogTitle)
                                    <li><a href="{{url('informative-blog-details/'.$blog->id)}}"><b>{{$blog->blogTitle}}</b></a></li>
                                @endif
                                @if ($blog->description)
                                    <li><b>{{$blog->blogTitle}}</b></li>
                                    <li><a href="{{url('informative-blog-details/'.$blog->id)}}">{!!$blog->description!!}</a></li>
                                @endif
                            @endforeach
                        @endif
                        @if ($forums)
                            @foreach ($forums as $forum)
                                @if ($forum->title)
                                    <li><a href="{{url('forum-question-show/'.$blog->id)}}"><b>{{$forum->title}}</b></a></li>
                                @endif
                                @if ($forum->description)
                                    <li><b>{{$forum->description}}</b></li>
                                    <li><a href="{{url('forum-question-show/'.$forum->id)}}">{!!$forum->description!!}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--D HELP LOGIN WRAP END-->

@endsection
