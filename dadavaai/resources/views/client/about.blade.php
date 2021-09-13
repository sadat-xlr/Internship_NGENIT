@extends('layouts.client')

@section('title')
    <title>About | Dadavaai </title>
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
                <span class="current red-clr"> About </span>
            </div>
        </div>
    </div>
</div>
<!-- Contact Us Start -->
<section class="gst-row"  id="contact-us">                 
    <div class="container theme-container">
        <div class="fancy-heading text-center">
            <h3>About Us</h3>
        </div>                  
        <div class="cntct-frm  clearfix">

            <div class="col-md-12 col-sm-6 col-lg-12">
                <div class="contact-details">
                    <p>
                        @if ($abouts)
                            {!!$abouts->description !!}
                        @endif
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- / Contact Us Ends -->
<div class="clear"></div>
@endsection