@extends('layouts.client')

@section('title')
    <title>Contact | Dadavaai </title>
@endsection
@php
$siteInfos = \App\Siteinfo::first();
$contact = \App\Contact::first();

@endphp

@section('content')
<div class="site-pagetitle jumbotron">
    <div class="container  theme-container">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="breadcrumbs">
                <i class="fa fa-home"></i>
                <span><a href="{{url('/')}}">Home</a></span>
                <i class="fa fa-arrow-circle-right"></i>
                <span class="current red-clr"> Contact </span>
            </div>
        </div>
    </div>
</div>
<div class="theme-container container">
    <div class="gst-spc3 row">
        <main class="col-md-9 col-sm-8 blog-wrap" style="border-right:black 1px solid">
            <div class="fancy-heading text-center">
                <h3>Contact Us</h3>
            </div>                  
            <div class="cntct-frm  clearfix">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <form action="{{url('query')}}" method="POST" id="contact-form" class="col-md-offset-2 no-padding col-md-8 col-sm-12">
                        {{ csrf_field() }}
                        <div class="form-group col-sm-12 form-alert"></div>
                        <div class="contact-form">
                            <div class="form-group col-sm-6">
                                <input type="text" class="form-control name input-your-name" placeholder="Your Name" name="name" id="cf_name" value="" data-toggle="tooltip" data-placement="bottom"  title="Name is required" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <select class="form-control name input-your-name" name="title" id="" required>
                                    <option value="">select one</option>
                                    <option value="delivery">Delivery</option>
                                    <option value="purchase">Purchase</option>
                                    <option value="policy">Policy</option>
                                    <option value="ondemand">Ondemand </option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <input type="number" class="form-control" placeholder="Phone Number" name="phone_number" value="" data-toggle="tooltip" data-placement="bottom"  title="Phone is required" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <input type="text" class="form-control email input-email" placeholder="Email Address" name="email" id="cf_email" value="" data-toggle="tooltip" data-placement="bottom"  title="Email is required" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <textarea class="form-control message input-message" rows="4" cols="10" placeholder="Your Massage" name="message" id="cf_message" data-toggle="tooltip" data-placement="top"  title="Message is required" required></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group col-sm-12 text-center">
                            <div class="g-recaptcha" data-sitekey="6LdsZcMZAAAAADBONnt7PalFLqUgJOdrrJ3YBnCe"></div>
                            <br>
                            <button type="submit" class="alt fancy-button">Send Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>  
          <aside class="col-md-3 col-sm-4">
            <div class="main-sidebar" >
                <div class="widget sidebar-widget widget_categories clearfix">
                    <h6 class="widget-title">Contact Detailes</h6>
                    <div class="contact-details">
                        {{-- <h4 class="title-1 title-border text-uppercase mb-30">contact details</h4> --}}
                        <ul>
                            <li>
                                <i class="fa fa-map-marker fa-10x" aria-hidden="true" style="font-size: 24px;"></i>&nbsp;&nbsp;
                                <span>{{$contact->address}}</span>
                                <br><br>
                            </li>
                            <li>
                                <i class="fa fa-phone fa-10x" aria-hidden="true" style="font-size: 24px;"></i>&nbsp;&nbsp;
                                <span><a href="tel:+88029110348">{{$contact->phone1}},</a></span>
                                <span><a href="tel:+8801971424220">{{$contact->phone1}}</a></span>
                                <br><br>
                            </li>
                            <li>
                                <i class="fa fa-envelope fa-10x" aria-hidden="true" style="font-size: 24px;"></i>&nbsp;&nbsp;
                                <span><a href="mailto:{{$contact->email}}">{{$contact->email}}</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="widget sidebar-widget widget_categories clearfix">
                    <div class="author-info-social">
                        <a class="goshop-share rcc-google" href="https://www.skype.com/en/" data-toggle="tooltip" title="Skype" rel="nofollow" target="_blank">
                            <i class="fa fa-skype fa-lg red-clr"></i>
                        </a>
                        <a class="goshop-share rcc-twitter" href="https://api.whatsapp.com/send?phone={{$contact->phone1}}&text=&source=&data=" data-toggle="tooltip" title="Whatsapp" rel="nofollow" target="_blank">
                            <i class="fa fa-whatsapp fa-lg red-clr"></i>
                        </a>
                        <a class="goshop-share rcc-facebook" href="https://www.messenger.com/t/dadavaai.shop" data-toggle="tooltip" title="messenger"  rel="nofollow" target="_blank">
                            <i class="fa fa-facebook red-clr" aria-hidden="true"></i>

                        </a>
                        <a class="goshop-share rcc-linkedin" href="{{$siteInfos->linkedin}}" data-toggle="tooltip" title="linkedin" rel="nofollow" target="_blank">
                            <i class="fa fa-linkedin red-clr"></i>
                        </a>
                    </div> 
                </div>
            </div>
        </aside>
    </div>
</div>

<!-- / Contact Us Ends -->
<div class="clear"></div>
@endsection
@section('script')
    <script type="text/javascript">
        var onloadCallback = function() {
        // alert("grecaptcha is ready!");
        };
    </script>

    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
@endsection