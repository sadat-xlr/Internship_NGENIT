@extends('layouts.client')

@section('title')
    <title>Terms & Policies | Dadavaai </title>
@endsection

@section('content')
<div class="site-pagetitle jumbotron">
    <div class="container  theme-container">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="breadcrumbs">
                <i class="fa fa-home"></i>
                <span><a href="{{url('/')}}">Home</a></span>
                <i class="fa fa-arrow-circle-right"></i>
                <span class="current red-clr"> Terms & Policies  </span>
            </div>
        </div>
    </div>
</div>
<div class="theme-container container">
    <div class="fancy-heading text-center">
        <h3>Terms & Policies</h3>
    </div>
    <div class="gst-spc3 row">

        <aside class="col-md-3 col-sm-4">
            <div class="main-sidebar" >
                <div class="widget sidebar-widget widget_categories clearfix">
                    <h6 class="widget-title">Topic</h6>
                    <ul>
                        @foreach ($policies as $policy)
                            <li  class="accout-item active"><i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp;<a href="#policy-{{$policy->id}}">{{$policy->topic}}</a></li>                                                                    
                        @endforeach
                    </ul>  
                </div>
            </div>
        </aside>
        <main class="col-md-9 col-sm-8 blog-wrap">
            @foreach ($policies as $policySection)
                <div id="policy-{{$policySection->id}}">
                    <h4><i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp;<b>{{$policySection->topic}}</b></h4>
                    <p>{!!$policySection->description!!}</p>
                </div>
            @endforeach
        </main>  
    </div>
</div>
<!-- / Contact Us Ends -->
<div class="clear"></div>
@endsection