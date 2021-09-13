@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>Quotation</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Quotation Form</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->
    <!-- CITY EVENT2 WRAP START-->
    <div class="city_blog2_wrap team">
        <div class="container">
            <div class="city_contact_row">	
                <div class="city_event_detail contact">
                    <div class="section_heading center">
                        <span>TechFocus</span>
                        <h2>Product Quotaion</h2>
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
                                        <input type="text" name="subject" placeholder="subject" value="{{$slug}}" required>
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