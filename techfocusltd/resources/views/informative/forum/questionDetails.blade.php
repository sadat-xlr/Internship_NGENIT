@extends('informative.layouts.master')
@section('content')
    <!-- CITY EVENT2 WRAP START-->
    <div class="city_blog2_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="forum_detail">
                        <div class="forum_card">
                            <h3>Ask about buying video card experience</h3>
                            <span>This Topic Contain 4 Repies, has 1 Voice and Last Updated By Johie Doe 1 Week ago.</span>
                        </div>
                        <div class="forum_author">
                            <ul class="forum_author_posts">
                                <li>Author</li>
                                <li style="margin-left:5%">Posts</li>
                            </ul>
                            <div class="forum_author_row">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="forum_author_fig">
                                            <figure class="box">
                                                <div class="box-layer layer-1"></div>
                                                <div class="box-layer layer-2"></div>
                                                <div class="box-layer layer-3"></div>
                                                <img src="{{asset('informative/extra-images/forum-authore.jpg')}}" alt="">
                                            </figure>
                                            <div class="forum_author_text">
                                                <h6><a href="#">{{$questionDetails->customer->customerName}}</a></h6>
                                                <span>Member sience: {{$questionDetails->customer->created_at}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="forum_detail_deta">
                                            <a href="#"><i class="fa fa-calendar"></i>{{$questionDetails->created_at}}</a>
                                            <h4>{{$questionDetails->title}}</h4>
                                            <p>{{$questionDetails->description}}</p>
                                        </div>	
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="forum_replies">
                        <h4 class="sidebar_heading">User REPLIES</h4>
                        <ul class="forum_replie_list">
                            @foreach ($questionDetails->comments as $comment)
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
                                            @if ($comment->customer_id != 0)
                                                <h5>{{$comment->customer->customerName}}</h5>
                                            @else
                                                <h5>Guest</h5>
                                            @endif

                                            <ul class="city_meta_list">
                                                <li><a href="#"><i class="fa fa-calendar"></i>{{$comment->created_at}}</a></li>
                                                <li><a href="#"><i class="fa fa-reply-all"></i>Reply</a></li>
                                            </ul>
                                        </div>

                                        <p>{{$comment->comment}}</p>
                                            @if (count($comment->forumCommentReplies)>0)
                                                <div class="reply-part">
                                                    @foreach ($comment->forumCommentReplies as $item)
                                                        <div class="first_reply">
                                                            <p>{{$item->reply}}</p>
                                                            <p><i><b>-{{$item->customer->customerName}}</b></i></p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        <div class="forum_user_detail">
                                            <a href="#" data-id="{{$comment->id}}" id="forumcommentreply">reply</a>
                                            <form action="{{url('forum-question-replies/'.$comment->id)}}" method="post" hidden>
                                                {{ csrf_field() }}
                                                <textarea name="reply" id="" cols="30" rows="10"></textarea>
                                                <button type="submit">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach  
                        </ul>
                        <div class="event_booking_form">
                            <h4 class="sidebar_heading">Leave Your Comments</h4>
                            <form action="{{url('forum-question-comment/'.$questionDetails->id)}}" method="post" accept-charset="utf-8">
                                {{ csrf_field() }}                    
                                <div class="row">
                                    @if (!Session::has("ID"))
                                    <div class="col-md-6">
                                        <div class="event_booking_field">
                                            <input type="text" name="name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="event_booking_field">
                                            <input type="email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="event_booking_area">
                                            <textarea name="comment">Comments</textarea>
                                        </div>
                                        <button class="theam_btn btn2" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="sidebar_widget">
                        <!-- EVENT SIDEBAR START-->
                        <div class="event_sidebar">
                            <h4 class="sidebar_heading">Search</h4>
                            <div class="sidebar_search">
                                <form action="{{url('/search-page')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="text" name="query" placeholder="Search" required>
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <!-- EVENT SIDEBAR END-->
                        <form action="{{url('/loginAuthorization')}}" method="post" id="form-login" accept-charset="utf-8">
                            {{ csrf_field() }}
                            <!-- EVENT SIDEBAR START-->
                            <div class="event_sidebar">
                                <h4 class="sidebar_heading">User Login</h4>
                                <div class="sidebar_search margin-bottom">
                                    <input type="email" id="name-login" name="email" placeholder="Username or email address" required>
                                </div>
                                <div class="sidebar_search margin-bottom">
                                    <input type="password" id="password-login" name="password" placeholder="******" required>
                                </div>
                                <div class="sidebar_search_login">
                                    <button class="theam_btn" type="submit" style="background-color:#1b6492">Login</button>
                                </div>
                            </div>
                            <!-- EVENT SIDEBAR END-->
                        </form>

                        <!-- EVENT SIDEBAR START-->
                        <div class="event_sidebar">
                            <h4 class="sidebar_heading">Recent Post</h4>
                            <div class="event_categories">
                                <ul>
                                    <li>
                                        <div class="event_categories_list post">
                                            <figure class="box">
                                                <div class="box-layer layer-1"></div>
                                                <div class="box-layer layer-2"></div>
                                                <div class="box-layer layer-3"></div>
                                                <img src="{{asset('informative/extra-images/replay-post.jpg')}}" alt="">
                                            </figure>
                                            <div class="event_categories_text">
                                                <span>6 days, 10 hours agon</span>
                                                <p>Ded on Ask about buying video card experience</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="event_categories_list post">
                                            <figure class="box">
                                                <div class="box-layer layer-1"></div>
                                                <div class="box-layer layer-2"></div>
                                                <div class="box-layer layer-3"></div>
                                                <img src="{{asset('informative/extra-images/replay-post1.jpg')}}" alt="">
                                            </figure>
                                            <div class="event_categories_text">
                                                <span>6 days, 10 hours agon</span>
                                                <p>Ded on Ask about buying video card experience</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="event_categories_list post">
                                            <figure class="box">
                                                <div class="box-layer layer-1"></div>
                                                <div class="box-layer layer-2"></div>
                                                <div class="box-layer layer-3"></div>
                                                <img src="{{asset('informative/extra-images/replay-post2.jpg')}}" alt="">
                                            </figure>
                                            <div class="event_categories_text">
                                                <span>6 days, 10 hours agon</span>
                                                <p>Ded on Ask about buying video card experience</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- EVENT SIDEBAR END-->
                        
                        <!-- EVENT SIDEBAR START-->
                        <div class="event_sidebar">
                            <h4 class="sidebar_heading">Fellow Us</h4>
                            <div class="city_top_social">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- EVENT SIDEBAR END-->
                        
                        <!-- EVENT SIDEBAR START-->
                        <div class="event_sidebar">
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
                        </div>
                        <!-- EVENT SIDEBAR END-->
                    </div>	
                </div>
            </div>
        </div>	
    </div>
    <!-- CITY EVENT2 WRAP END-->
    

@endsection