@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                {{-- <h2>{{$featuredcontent->title}}</h2> --}}
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item">Newsroom</li>
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
                    <div class="city_news2_post">
                        <ul>
                            @foreach ($news as $singleNews)
                                <li>
                                    <div id="news-{{$singleNews->id}}" class="city_news2_detail" style="padding: 10px;">
                                        <ul class="city_meta_list">
                                            <li><a href="#"><i class="fa fa-calendar"></i>Posted: {{$singleNews->created_at->format('d-m-y')}}</a></li>
                                        </ul>
                                        <h5>{{$singleNews->newsTitle}}</h5>
                                        <p class="more text-justify">
                                            {{strip_tags($singleNews->description)}}
                                        </p>

                                    </div>
                                </li>
                            @endforeach
                            
                        </ul>
                    </div>
                    <div id="pagination" style="margin-left: 45%">
						{{ $news->links() }}
				    </div>
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
@section('script')
<script>
    jQuery(document).ready(function($){
        var showChar = 300;
        var ellipsestext = "...";
        var moretext = "more";
        var lesstext = "less";
        $('.more').each(function() {
        var content = $(this).html();
        var textcontent = $(this).text();

        if (textcontent.length > showChar) {

            var c = textcontent.substr(0, showChar);
            //var h = content.substr(showChar-1, content.length - showChar);

            var html = '<span class="container"><span>' + c + '</span>' + '<span class="moreelipses">' + ellipsestext + '</span></span><span class="morecontent">' + content + '</span>';

            $(this).html(html);
            $(this).after('<a href="" class="morelink theam_btn bg-color color">' + moretext + '</a>');
        }

        });

        $(".morelink").click(function() {
        if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
            $(this).prev().children('.morecontent').fadeToggle(500, function(){
            $(this).prev().fadeToggle(500);
            });
        
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
            $(this).prev().children('.container').fadeToggle(500, function(){
            $(this).next().fadeToggle(500);
            });
        }
        //$(this).prev().children().fadeToggle();
        //$(this).parent().prev().prev().fadeToggle(500);
        //$(this).parent().prev().delay(600).fadeToggle(500);
        
        return false;
        });
    });
</script>
@endsection