@extends('informative.layouts.master')
@section('content')
			<!-- SAB BANNER START-->
			<div class="sab_banner overlay">
				<div class="container">
					<div class="sab_banner_text">
						<h2>{{$job->title}}</h2>
						<ul class="breadcrumb">
						  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						  <li class="breadcrumb-item"><a href={{url('/career')}}>Career</a></li>
						  <li class="breadcrumb-item active">{{$job->title}}</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- SAB BANNER END-->
			
			<!-- CITY EVENT2 WRAP START-->
			<div class="city_blog2_wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<div class="city_blog2_fig fig2 detail">
								
								<img src="{{asset('informative/extra-images/service-banner.jpg')}}" alt="">
								<div class="blog_detail_row">
									<div class="city_blog2_list">
										<ul class="city_meta_list">
											<li><a href="#"><i class="fa fa-calendar"></i>{{$job->created_at}}</a></li>
											{{-- <li><a href="#"><i class="fa fa-comment-o"></i>{{count($blog->comment)}} Comments</a></li> --}}
										</ul>
										<div class="city_blog2_text">
											<h4><a href="#">{{$job->title}}</a></h4>
											<p>{!!$job->description!!}</p>
										</div>
									</div>
								</div>
							</div>			
							<!--BLOG USER COMMENT ROW START-->
							<div class="blog_user_comment_row">
								<div class="event_booking_form">
									<h4 class="sidebar_heading">Apply Now</h4>
									<div class="row">
                                        <form action="{{url('/application')}}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="col-md-6">
                                                <div class="event_booking_field">
                                                    <input type="text" placeholder="Name" name="name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="event_booking_field">
                                                    <input type="text" placeholder="Email" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="event_booking_field">
                                                    <input type="text" placeholder="Phone Number" name="number" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="event_booking_field">
                                                    <input type="number" placeholder="Year of experience" name="experience">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="event_booking_field">
                                                    <input type="file" placeholder="Cv" name="cv" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="hidden"  name="job_id" value="{{$job->id}}">
                                                <button class="theam_btn btn2" type="submit" style="background-color: #083b5b !important;
										padding: 10px !important;">Submit Now</button>
                                            </div>
                                        </form>
										
									</div>
								</div>
							</div>
							<!--BLOG USER COMMENT ROW END-->
						</div>
						<div class="col-md-4">
							<div class="sidebar_widget">					
								<!-- EVENT SIDEBAR START-->
								<div class="event_sidebar">
									<h4 class="sidebar_heading">Fellow Us</h4>
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
								
								<!-- EVENT SIDEBAR START-->
								<div class="event_sidebar">
									<h4 class="sidebar_heading">Recent Job</h4>
									<div class="event_categories">
										<ul>
                                            @foreach($allJobs as $allJob)
											<li>
												<div class="event_categories_list">
													<div class="event_categories_text">
														<h6>{{$allJob->title}}</h6>
														<ul class="blog_author_date">
															<li><a href="#">{{$allJob->created_at}}</a></li>
														</ul>
													</div>
												</div>
                                            </li>
                                            @endforeach
										</ul>
									</div>
								</div>
							</div>	
						</div>
					</div>					
				</div>
			</div>
			<!-- CITY EVENT2 WRAP END-->
@endsection