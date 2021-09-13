@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                {{-- <h2>{{$featuredcontent->title}}</h2> --}}
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item">Partnership</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->

    <!-- CITY EVENT2 WRAP START-->
    <div class="city_blog2_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="city_blog2_fig fig2 detail">
								
                        <img src="{{asset('informative/extra-images/service-banner.jpg')}}" alt="">
                        <div class="blog_detail_row">
                            <div class="city_blog2_list">
                                <div class="city_blog2_text">
                                    <h4>Top brands, working together</h4>
                                    <p>
                                        Our business revolves around making meaningful connections — partners to clients and clients to solutions. 
                                        When your company partners with us to combine your products and/or services with our family of offerings, 
                                        we both benefit in ways that multiply our capabilities, broaden our reach and amplify our impact. 
                                    </p>

                                    <h4>The future is here. We are leading the way.</h4>
                                    <p>
                                        We are redefining the channel to solve the increasingly complex needs our clients face. 
                                        By partnering with us, you are part of the solution to help clients manage business today and transform the future.
                                    </p>
                                    <h4>Together, we’ll do more.</h4>
                                    <p>
                                        We're always looking for new partners who share our passion for delivering meaningful outcomes. 
                                        Become a partner with Insight and collaborate with a community of technology leaders, increase your market share, speed revenue growth and amplify your brand.
                                    </p>
                                    <h4>Our Technology Partner Base Program</h4>
                                    <p>
                                        Our partnership programs are designed to build long-term relationships through a collaborative sales enablement approach. 
                                        With our Technology Partner program and an investment of $12,500 per quarter, you’ll get a dedicated product manager to coordinate strategic, joint-business initiatives.

                                        Achieving your business goals requires tactical initiatives through multiple sources, mediums and platforms. 
                                        We know what it takes to connect your brand with the right target audience and present precise solutions using analytics and marketing innovation.
                                        Benefits of our Technology Partner program include:

                                        Sales and special costing support Products sold through insight.com Branded internal and external web pages
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>
                <div class="col-md-5">
                    <div class="sidebar_widget">
                        
                        <!-- EVENT SIDEBAR START-->
						<div class="sidebar_widget">
							<!-- SIDE SUBMIT FORM START-->
							<div class="side_submit_form">
								<h4 class="sidebar_title">Let’s work together.</h4>
								<form action="{{url('store-partnership')}}" method="post">
									{{ csrf_field() }}
									<div class="side_submit_field">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="company_name" placeholder="Company Name *" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Company website *" name="company_website" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Company Address *" name="company_address" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4" style="padding: 0px 5px 0px 0px;">
                                                <input type="text" class="form-control" placeholder="City *" name="city" required>
                                            </div>
                                            <div class="col-sm-4" style="padding: 0px 5px 0px 0px;">
                                                <input type="text" class="form-control" placeholder="Zip Code *" name="zip_code" required>
                                            </div>
                                            <div class="col-sm-4" style="padding: 0px 0px 0px 0px;">
                                                <input type="text" class="form-control" placeholder="Country *" name="country" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white" for="">Last fiscal year revenue </label>
                                            <input type="number" class="form-control" placeholder="Enter 0 if you are restricted from providing " name="fy_revenue">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white" for="">Projected revenue for current fiscal year</label>
                                            <input type="number" class="form-control" placeholder="Enter 0 if you are restricted from providing " name="projected_fy_revenue">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white" for="">How many employees does your company have?</label>
                                            <input type="number" class="form-control" placeholder="Enter 0 if you are restricted from providing " name="employee">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white" for="">What is your primary product/solution segment? *</label>
                                            <input type="text" class="form-control" name="primary_product" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white" for="">What is your company's primary business? *</label>
                                            <input type="text" class="form-control" name="primary_business" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white" for="">What is your company's unique selling items? *</label>
                                            <textarea class="form-control" placeholder=" " name="selling_item" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white" for="">How were you referred to us? </label>
                                            <select name="referred"  class="form-control">
                                                <option value="web search">Web search</option>
                                                <option value="Distribution referral">Distribution referral</option>
                                                <option value="Prior working relationship with Techfocus">Prior working relationship with Techfocus</option>
                                            </select>
                                        </div>
                                        <h6 class="sidebar_title">Company Contact Information.</h6>
                                        <div class="form-group">
                                            <div class="col-sm-6" style="padding: 0px 5px 0px 0px;">
                                                <input type="text" class="form-control" placeholder="Contect name *" name="contact_name" required>
                                            </div>
                                            <div class="col-sm-6" style="padding: 0px 5px 0px 0px;">
                                                <input type="text" class="form-control" placeholder="Job title *" name="job_title" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6" style="padding: 0px 5px 0px 0px;">
                                                <input type="text" class="form-control" placeholder="Email *" name="contact_email" required>
                                            </div>
                                            <div class="col-sm-6" style="padding: 0px 5px 0px 0px;">
                                                <input type="text" class="form-control" placeholder="Phone number *" name="contact_phone" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button class="theam_btn btn2" type="submit" style="background-color: #083b5b !important;
                                                padding: 10px !important;">Submit</button>
                                            </div>
                                        </div>
									</div>
								</form>
							</div>
						</div>
                        <!-- EVENT SIDEBAR END-->
                        
                        <!-- EVENT SIDEBAR START-->
                        <div class="event_sidebar">
                            <h4 class="sidebar_heading">Follow Us</h4>
                            <div class="city_top_social">
                                <ul>
                                    @php
                                        $siteinfos = \App\Siteinfo::first();
                                    @endphp
                                    <li><a href="{{$siteinfos->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="{{$siteinfos->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="{{$siteinfos->dribbble}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- EVENT SIDEBAR END-->
                        
                    </div>	
                </div>
            </div>					
        </div>
    </div>
    <!-- CITY EVENT2 WRAP END-->


@endsection