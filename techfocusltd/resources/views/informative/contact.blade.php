@extends('informative.layouts.master')
@section('content')
    
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>Contact Us</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->    
    <!-- Contact Boxes -->
    <div class="city_blog2_wrap team" style="padding-top:20px; padding-bottom:0px !important;">
        <div class="reach-us-section">
            <div class="container">
                <div class="city_contact_row">	
                    <div class="city_contact_list">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="sales-contact-box text-center">
                                    <h6>Sales Queries</h6>
                                    <p><i class="fas fa-envelope"></i>&nbsp;sales@techfocusltd.com<p>
                                    <p><i class="fas fa-phone"></i>&nbsp;(+88) 01714243446, (+88) 029110348</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="suggestion-and-complaint-contact-box text-center">
                                    <h6>General Queries</h6>
                                    <p><i class="fas fa-envelope"></i>&nbsp;info@techfocusltd.com<p>
                                    <p><i class="fas fa-phone"></i>&nbsp;(+88) 01714243446, (+88) 029110348</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="support-contact-box text-center">
                                    <h6>Support Queries</h6>
                                    <p><i class="fas fa-envelope"></i>&nbsp;support@techfocusltd.com<p>
                                    <p><i class="fas fa-phone"></i>&nbsp;(+88) 01714243446, (+88) 029110348</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-center">
                                <div class="recr-contact-box">
                                    <h6>Recruitment Queries</h6>
                                    <p><i class="fas fa-envelope"></i>&nbsp;recruitment@techfocusltd.com<p>
                                    <p><i class="fas fa-phone"></i>&nbsp;(+88) 01714243446, (+88) 029110348</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>
    <!-- Contact Boxes -->
    <!-- CITY EVENT2 WRAP START-->
    <div class="city_blog2_wrap team" style="padding-top:0px !important;">
        <div class="container">
            <div class="city_contact_row">	
                <div class="city_contact_list">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="city_contact_text">
                                <h6>Comments, <br>Compliments and <br>Complaints</h6>
                                <span><i class="fa icon-comment-1"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="city_contact_text">
                                <h6>Contact with <br>us About our<br>Services</h6>
                                <span><i class="fa icon-agenda"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="city_contact_text">
                                <h6>Take A Part As <br>Consultant & <br>Voluntree</h6>
                                <span><i class="fa icon-help"></i></span>
                            </div>
                        </div>
                        @php
                            $siteinfo = \App\Siteinfo::all()->first();
                        @endphp
                        <div class="col-md-6">
                            <div class="city_contact_text text2">
                                <h6>Follow Us on Social Media </h6>
                                <div class="city_top_social">
                                    <ul>
                                        <li><a href="{{$siteinfo->facebook}}" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                                        <li><a href="{{$siteinfo->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="{{$siteinfo->dribbble}}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                        <li><a href="{{$siteinfo->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="city_event_detail contact">
                    <div class="section_heading center">
                        <span>TechFocus</span>
                        <h2>Contact With Us</h2>
                    </div>
                    <form action="{{url('send-guest-message')}}" method="post">
                        {{ csrf_field() }}
                        <div class="event_booking_form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="event_booking_field">
                                        <input type="text" name="name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="event_booking_field">
                                        <input type="text" name="email" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="event_booking_field">
                                        <input type="number" name="phoneNumber" placeholder="Phone" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="event_booking_field">
                                        <input type="text" name="subject" placeholder="subject" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="event_booking_area">
                                        <textarea name="message" placeholder="Enter Your Message Here" required ></textarea>
                                    </div>
                                    <button class="theam_btn btn2" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- CITY EVENT2 WRAP END-->
@endsection