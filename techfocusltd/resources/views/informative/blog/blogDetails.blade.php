@extends('informative.layouts.master')
@section('content')
			<!-- SAB BANNER START-->
			<div class="sab_banner overlay">
				<div class="container">
					<div class="sab_banner_text">
						<h2>{{$blog->blogTitle}}</h2>
						<ul class="breadcrumb">
						  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						  <li class="breadcrumb-item"><a href={{url('/informative-blog')}}>Blogs</a></li>
						  <li class="breadcrumb-item active">{{$blog->blogTitle}}</li>
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
								<figure class="box">
									<div class="box-layer layer-1"></div>
									<div class="box-layer layer-2"></div>
									<div class="box-layer layer-3"></div>
									<img src="{{asset('storage/images/blog/'.$blog->blogImage)}}" alt="">
									<span class="city_blog2_met">{{$blog->category->categoryName}}</span>
								</figure>
								<div class="blog_detail_row">
									<div class="city_blog2_list">
										<ul class="city_meta_list">
											<li><a href="#"><i class="fa fa-calendar"></i>{{$blog->created_at}}</a></li>
											<li><a href="#"><i class="fa fa-comment-o"></i>{{count($blog->comment)}} Comments</a></li>
										</ul>
										<div class="city_blog2_text">
											<h4><a href="#">{{$blog->blogTitle}}</a></h4>
											<p>{!!$blog->description!!}</p>
										</div>
									</div>
									<!--CITY EVENT META START-->
									<!-- <div class="city_event_meta">
										<div class="city_event_tags">
											<span>Tags:</span>
											<span><a href="#">Audio</a> <a href="#">Conferences</a> <a href="#">Family</a></span>
										</div>
										<div class="city_top_social">
											<span>Share:</span>
											<ul>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
												<li><a href="#"><i class="fa fa-youtube"></i></a></li>
												<li><a href="#"><i class="fa fa-google"></i></a></li>
											</ul>
										</div>
									</div> -->
									<!--CITY EVENT META END-->
								</div>
							</div>
							<!--BLOG POST SLIDE START-->
							<div class="blog_post_slide">
								<h4 class="sidebar_heading">Related Post</h4>
								<div class="blog-post-slider">
                                    @foreach($relatedBlogs as $relatedBlog)
									<div>
										<div class="blog_post_slide_fig">
											<figure class="box">
												<div class="box-layer layer-1"></div>
												<div class="box-layer layer-2"></div>
												<div class="box-layer layer-3"></div>
												<img src="{{asset('storage/images/blog/'.$relatedBlog->blogImage)}}" alt="">
											</figure>
											<div class="blog_post_slide_text">
												<h6><a href="#">{{$relatedBlog->blogTitle}}</a></h6>
											</div>
										</div>
									</div>
                                    @endforeach
								</div>
							</div>
							<!--BLOG POST SLIDE END-->
							
							<!--BLOG USER COMMENT ROW START-->
							<div class="blog_user_comment_row">
								<div class="blog_user_comment">
                                    <h4 class="sidebar_heading">User Comments</h4>
                                    @if(count($blog->comment)>0)
                                    @foreach($blog->comment as $comment)
									<ul class="forum_replie_list">
										<li>
											<div class="forum_user_replay padding0">
												<figure class="box">
													<div class="box-layer layer-1"></div>
													<div class="box-layer layer-2"></div>
													<div class="box-layer layer-3"></div>
													<img src="{{asset('informative/extra-images/replie-fig.jpg')}}" alt="">
												</figure>
												<div class="forum_user_detail">
													<div class="forum_user_meta">
														<h5>{{$comment->UserName}}</h5>
														<ul class="city_meta_list">
															<li><a href="#"><i class="fa fa-calendar"></i>{{$comment->created_at}}</a></li>
															<li><a href="#"><i class="fa fa-reply-all"></i>Reply</a></li>
														</ul>
													</div>
													<p>{{$comment->comment}}</p>
												</div>
											</div>
											<!-- <ul class="chlid">
												<li>
													<div class="forum_user_replay">
														<figure class="box">
															<div class="box-layer layer-1"></div>
															<div class="box-layer layer-2"></div>
															<div class="box-layer layer-3"></div>
															<img src="{{asset('informative/extra-images/replie-fig1.jpg')}}" alt="">
														</figure>
														<div class="forum_user_detail">
															<div class="forum_user_meta">
																<h5>Monica Brandson</h5>
																<ul class="city_meta_list">
																	<li><a href="#"><i class="fa fa-calendar"></i>June 15, 2018 23:00</a></li>
																	<li><a href="#"><i class="fa fa-reply-all"></i>Reply</a></li>
																</ul>
															</div>
															<p>This is Photoshop's Lorem Ipsum. Proin gravida nibh. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. </p>
														</div>
													</div>
												</li>
											</ul> -->
										</li>
                                    </ul>
                                    @endforeach
                                    @else
                                    <h3>Not Available</h3>
                                    @endif
								</div>
								<div class="event_booking_form">
									<h4 class="sidebar_heading">Leave Us a Reply</h4>
									<div class="row">
										<div class="col-md-6">
											<div class="event_booking_field">
												<input type="text" placeholder="Name">
											</div>
										</div>
										<div class="col-md-6">
											<div class="event_booking_field">
												<input type="text" placeholder="Email">
											</div>
										</div>
										<div class="col-md-12">
											<div class="event_booking_area">
												<textarea>Comments</textarea>
											</div>
											<a class="theam_btn btn2" href="#">Submit</a>
										</div>
									</div>
								</div>
							</div>
							<!--BLOG USER COMMENT ROW END-->
						</div>
						<div class="col-md-4">
							<div class="sidebar_widget">
								<!-- EVENT SIDEBAR START-->
								<div class="event_sidebar">
									<h4 class="sidebar_heading">Search</h4>
									<div class="sidebar_search">
										<input type="text" placeholder="Search" required>
										<button><i class="fa fa-search"></i></button>
									</div>
								</div>
								<!-- EVENT SIDEBAR END-->
								
								<!-- EVENT SIDEBAR START-->
								<div class="event_sidebar">
									<h4 class="sidebar_heading">Categories</h4>
									<div class="categories_list">
										<ul>
                                            @foreach($categories as $category)
											<li><a href="#">{{$category->categoryName}}<span>({{count($category->blog)}})</span></a></li>
                                            @endforeach
										</ul>
									</div>
								</div>
								<!-- EVENT SIDEBAR END-->
								
								<!-- EVENT SIDEBAR START-->
								<div class="event_sidebar">
									<h4 class="sidebar_heading">Fellow Us</h4>
									<div class="city_top_social">
										<ul>
											<li><a href="{{$siteinfos->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="{{$siteinfos->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
											<li><a href="{{$siteinfos->dribbble}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
										</ul>
									</div>
								</div>
                                <!-- EVENT SIDEBAR END-->
								
								<!-- EVENT SIDEBAR START-->
								<div class="event_sidebar">
									<h4 class="sidebar_heading">Recent Post</h4>
									<div class="event_categories">
										<ul>
                                            @foreach($recentBlogs as $recentBlog)
											<li>
												<div class="event_categories_list">
													<figure class="box">
														<div class="box-layer layer-1"></div>
														<div class="box-layer layer-2"></div>
														<div class="box-layer layer-3"></div>
														<img src="{{asset('storage/images/blog/'.$recentBlog->blogImage)}}" alt="" style="width: 90px; height: 80px;!important">
													</figure>
													<div class="event_categories_text">
														<h6><span>{{$recentBlog->category->categoryName}}</span> {{$recentBlog->blogTitle}}</h6>
														<ul class="blog_author_date">
															<li><a href="#">{{$recentBlog->created_at}}</a></li>
														</ul>
													</div>
												</div>
                                            </li>
                                            @endforeach
										</ul>
									</div>
								</div>
								<!-- EVENT SIDEBAR END-->
								
								<!-- EVENT SIDEBAR START-->
								<!-- <div class="event_sidebar">
									<h4 class="sidebar_heading">Archive</h4>
									<div class="categories_list archive">
										<ul>
											<li><a href="#">March</a></li>
											<li><a href="#">Febuary</a></li>
											<li><a href="#">January</a></li>
											<li><a href="#">December</a></li>
											<li><a href="#">November</a></li>
											<li><a href="#">October</a></li>
										</ul>
									</div>
								</div> -->
								<!-- EVENT SIDEBAR END-->
								
								<!-- EVENT SIDEBAR START-->
								<!-- <div class="event_sidebar margin0">
									<h4 class="sidebar_heading">Populor Tags</h4>
									<div class="blog_tags">
										<a href="#">fashion</a>
										<a href="#">woman</a>
										<a href="#">studio</a>
										<a href="#">photo</a>
										<a href="#">man</a>
										<a href="#">html</a>
										<a href="#">css</a>
										<a href="#">joomla</a>
										<a href="#">wp</a>
										<a href="#">fashion</a>
										<a href="#">woman</a>
										<a href="#">studio</a>
										<a href="#">photo</a>
									</div>
								</div> -->
								<!-- EVENT SIDEBAR END-->
							</div>	
						</div>
					</div>					
				</div>
			</div>
			<!-- CITY EVENT2 WRAP END-->
@endsection