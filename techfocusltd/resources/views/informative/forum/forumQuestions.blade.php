@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
            <div class="container">
                <div class="sab_banner_text">
                    <h2>Tech Forums</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Tech Forums</li>
                    </ul>
                </div>
                
            </div>
        </div>
        <!-- SAB BANNER END-->    
<!-- CITY EVENT2 WRAP START-->
    <div class="city_blog2_wrap">
        <div class="container">
            <h4>Do you want to know something? <a href="{{url('forum-question-create')}}"> <u>Ask your question here.</u> </a></h4>
            <div class="forum_list">
                <ul>
                    <li>
                        <div class="forum_title">
                            <h6 class="left">Topic</h6>
                        </div>
                    </li>
                    <li>
                        <div class="forum_title">
                            <h6>Veiws</h6>
                        </div>
                    </li>
                    <li>
                        <div class="forum_title">
                            <h6>Comment</h6>
                        </div>
                    </li>
                    <li class="hidden-md hidden-sm hidden-xs">
                        <div class="forum_title">
                            <h6>FRESHNESS</h6>
                        </div>
                    </li>
                </ul>
                @foreach ($forumQuestions as $item)
                    <ul class="bg_color forum">
                        <li>
                            <div class="forum_fig forum2">
                                <a href="{{url('forum-question-show/'.$item->slug)}}">
                                <figure >
                                    <img src="{{asset("informative/images/forum-fig.png")}}" alt="">
                                </figure>
                                <div class="forum_text">
                                    {{$item->title}} 
                                    <span>Posted by: {{$item->customer->customerName}}</span>
                                </div>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="forum_topic">
                                <h6>{{$item->views}}</h6>
                            </div>
                        </li>
                        <li>
                            <div class="forum_topic">
                                <h6>{{count($item->comments)}}</h6>
                            </div>
                        </li>
                        <li class="hidden-md hidden-sm hidden-xs">
                            <div class="forum_month">
                                <span>{{$item->created_at->format('d-m-y')}}</span>
                                <p>{{$item->customer->customerName}}</p>
                            </div>
                        </li>
                    </ul>
                @endforeach
            </div>
            <div id="pagination" style="margin-left: 45%">
                    {{ $forumQuestions->links() }}
                
            </div>
        </div>	
    </div>
    <!-- CITY EVENT2 WRAP END-->
@endsection
