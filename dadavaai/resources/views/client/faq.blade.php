@extends('layouts.client')

@section('title')
    <title>FAQ & Help | Dadavaai </title>
@endsection

@php
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
                <span class="current red-clr"> FAQ & Help  </span>
            </div>
        </div>
    </div>
</div>
<div class="theme-container container">
    <div class="gst-spc3 row">
        <main class="col-md-9 col-sm-8 blog-wrap">
            {{-- <div class=" text-center">
                <h4>Answers to Your Questions</h4>
            </div> --}}
            <div id="all-faqs">
              @foreach ($faqs as $faq)
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="heading{{$faq->id}}">
                        <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$faq->id}}" aria-expanded="false" aria-controls="collapse{{$faq->id}}">
                              <i class="fa fa-plus" aria-hidden="true"></i>&nbsp; &nbsp;
                              {{$faq->question}}
                          </a>
                        </h4>
                      </div>
                      <div id="collapse{{$faq->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$faq->id}}">
                        <div class="panel-body">
                          {!!$faq->answer!!}
                        </div>
                      </div>
                    </div>
                </div>
              @endforeach
            </div>
            <div id="ajax_call">
              
            </div>
        </main>  
          <aside class="col-md-3 col-sm-4">
            <div class="main-sidebar" >
              <div id="search-2" class="widget sidebar-widget widget_search clearfix">
                  <form method="get" id="faqSearch" class="form-search" action="#">
                      <input class="form-control search-query" id="faqs-search" type="text" placeholder="Type Keyword" name="query"/>
                      <button class="btn btn-default search-button" type="submit"><i class="fa fa-search"></i></button>
                  </form>
              </div>
              <div class="single-product-card mt-30" style="box-shadow: unset; border: #e9e6e6 1px solid">
                  <div class="single-product-card-container">
                      <div class="single-product-card-header">
                          Hotline Number
                      </div>
                      <div class="single-product-card-body pt-20">
                          <p class="fsz-12">
                              {{$contact->phone1}}, {{$contact->phone2}}
                          </p> 
                      </div>
                  </div>    
              </div>
              <div class="widget sidebar-widget widget_categories clearfix">
                  <h6 class="widget-title">Query</h6>
                  <form action="{{url('query')}}" method="POST" id="contact-form" class="no-padding col-md-12 col-sm-12">
                      {{ csrf_field() }}
                      <div class="form-group col-sm-12 form-alert"></div>
                      <div class="contact-form">
                          <div class="form-group col-sm-12">
                              <input type="text" class="form-control name input-your-name" placeholder="Your Name" name="name" id="cf_name" value="" data-toggle="tooltip" data-placement="bottom"  title="Name is required" required>
                          </div>
                          <div class="form-group col-sm-12">
                              <input type="number" class="form-control" placeholder="Phone Number" name="phone_number" value="" data-toggle="tooltip" data-placement="bottom"  title="Phone is required" required>
                          </div>
                          <div class="form-group col-sm-12">
                              <input type="text" class="form-control email input-email" placeholder="Email Address" name="email" id="cf_email" value="" data-toggle="tooltip" data-placement="bottom"  title="Email is required" required>
                          </div>
                          <div class="form-group col-sm-12">
                              <textarea class="form-control message input-message" rows="4" cols="10" placeholder="Your Massage" name="message" id="cf_message" data-toggle="tooltip" data-placement="top"  title="Message is required" required></textarea>
                          </div>
                      </div>
                      <div class="form-group col-sm-12 text-center">
                          <button type="submit" class="alt fancy-button">Send Now</button>
                      </div>
                  </form> 
              </div>
            </div>
        </aside>
    </div>
</div>
<!-- / Contact Us Ends -->
<div class="clear"></div>
@endsection