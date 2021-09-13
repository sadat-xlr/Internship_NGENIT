@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>{{$featuredcontent->title}}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/feature-content')}}">Feature Content</a></li>
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
                            <img src="{{asset('storage/images/feturedContent/'.$featuredcontent->image)}}" alt="" style="height:400px">
                            <a class="paly_btn" data-rel="prettyPhoto" href="{{asset('storage/images/feturedContent/'.$featuredcontent->image)}}"><i class="fa fa-plus"></i></a>
                            <span class="city_blog2_met">{{$featuredcontent->category->categoryName}}</span>
                        </figure>
                        <div class="blog_detail_row">
                            <div class="city_blog2_list">
                                <ul class="city_meta_list">
                                    <li><a href="#"><i class="fa fa-calendar"></i>{{$featuredcontent->created_at}}</a></li>
                                    @foreach($featuredcontent->tags as $tag)
                                        <li><a href="#"><i class="fa fa-tag"></i>{{$tag->tag}}</a></li>
                                    @endforeach
                                </ul>
                                <div class="city_blog2_text">
                                    <h4><a href="#">{{$featuredcontent->title}}</a></h4>
                                    <p>{!!$featuredcontent->description!!}</p>
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

                    {{-- @php
                        $relatedFeaturedcontents = \App\Featuredcontent::where('category_id',$featuredcontent->category_id)->get();
                    @endphp
                    <div class="blog_post_slide">
                        <h4 class="sidebar_heading">Related Content</h4>
                        <div class="blog-post-slider">
                            @foreach($relatedFeaturedcontents as $relatedFeaturedcontent)
                            <div>
                                <div class="blog_post_slide_fig">
                                    <figure class="box">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        <img src="{{asset('storage/images/feturedcontent/'.$relatedFeaturedcontent->image)}}" alt="" style="width:320px; height:200px">
                                    </figure>
                                    <div class="blog_post_slide_text">
                                        <h6><a href="#">{{$relatedFeaturedcontent->title}}</a></h6>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div> --}}
                    <!--BLOG POST SLIDE END-->
                    
                    <!--BLOG USER COMMENT ROW START-->
                    {{-- <div class="blog_user_comment_row">
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
                    </div> --}}
                    <!--BLOG USER COMMENT ROW END-->
                </div>
                <div class="col-md-4">
                    <div class="sidebar_widget">
                        
                        <!-- EVENT SIDEBAR START-->
						<div class="sidebar_widget">
							<!-- SIDE SUBMIT FORM START-->
							<div class="side_submit_form">
								<h4 class="sidebar_title">Get In Touch</h4>
								<form action="{{url('send-guest-message')}}" method="post">
									{{ csrf_field() }}
									<div class="side_submit_field">
										<input type="text" name="name" placeholder="Name" required>
										<input type="text" name="email" placeholder="Email" required>
										<input type="text" name="phoneNumber" placeholder="Phone Number">
										<input type="text" name="subject" placeholder="Subject" required>
										<textarea name="message" placeholder="Enter Your Message Here" required></textarea>
										<button class="theam_btn btn2" type="submit" style="background-color: #083b5b !important;
										padding: 10px !important;">Submit Now</button>
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
                                    <li><a href="{{$siteinfos->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="{{$siteinfos->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="{{$siteinfos->dribbble}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- EVENT SIDEBAR END-->
                        
                        <!-- EVENT SIDEBAR START-->
                        {{-- <div class="event_sidebar">
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
                        </div> --}}
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

    <!--CITY AWARD WRAP START-->
    <div class="city_award_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="city_award_list">
                        <span><i class="fa icon-politician"></i></span>
                        <div class="city_award_text">
                            <h3 class="counter">1495</h3>
                            <h3>Established</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="city_award_list">
                        <span><i class="fa icon-cube"></i></span>
                        <div class="city_award_text">
                            <h3 class="counter">75,399</h3>
                            <h3>KM Square</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="city_award_list">
                        <span><i class="fa icon-demographics"></i></span>
                        <div class="city_award_text">
                            <h3 class="counter">1,435,268</h3>
                            <h3>Total Population</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--CITY AWARD WRAP END-->
    @php
        $relatedFeaturedcontents = \App\Featuredcontent::where('category_id',$featuredcontent->category_id)->get();
    @endphp
    <!-- CITY EVENT2 WRAP START-->
    {{-- <div class="city_blog2_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog_post_slide">
                        <h4 class="sidebar_heading">Related Content</h4>
                        <div class="blog-post-slider">
                            @foreach($relatedFeaturedcontents as $relatedFeaturedcontent)
                            <div>
                                <div class="blog_post_slide_fig">
                                    <figure class="box">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        <img src="{{asset('storage/images/feturedcontent/'.$relatedFeaturedcontent->image)}}" alt="" style="width:320px; height:200px">
                                    </figure>
                                    <div class="blog_post_slide_text">
                                        <h6><a href="#">{{$relatedFeaturedcontent->title}}</a></h6>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>					
        </div>
    </div> --}}
    <!-- CITY EVENT2 WRAP END-->

    <!--CITY Product WRAP START-->
    <div class="city_project_wrap">
        <div class="container-fluid">
            <!--SECTION HEADING START-->
            <div class="section_heading center">
                <span>Related </span>
                <h2>Content</h2>
            </div>
            <!--SECTION HEADING END-->
            <div class="city-project-slider">
                @foreach ($relatedFeaturedcontents as $relatedFeaturedcontent)
                    <div>
                        {{-- <a href="{{url('product-info/'.$newProduct->id.'/'.$newProduct->slug)}}"> --}}
                        <div class="city_project_fig">
                            <figure >
                                <img src="{{asset('storage/images/feturedcontent/'.$relatedFeaturedcontent->image)}}"  alt="" style=" width: 250px; height: 250px;!important">
                            </figure>
                            <div>
                                <div class="blog_post_slide_text">
                                    <h6><a href="#">{{$relatedFeaturedcontent->title}}</a></h6>
                                </div>
                                {{-- <span style="padding:10px; text-align:center !important;"> {{$relatedFeaturedcontent->title}} </span> --}}
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </div>	
    <!--CITY Product WRAP END-->
@endsection