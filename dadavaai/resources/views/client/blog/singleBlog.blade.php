@extends('layouts.client')

@section('og_property')
    <meta property="og:title" content="{{$blog->blogTitle}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:description" content="{{strip_tags($blog->description)}}"/>
    <meta property="og:url" content="{{url('/dadavaai-blog/'.$blog->id.'/'.str_slug($blog->blogTitle))}}" />
    <meta property="og:image" content="{{url('storage/images/blog/'.$blog->blogImage)}}"/>
@endsection

@section('title')
    <title>Blogs | Dadavaai </title>
@endsection

@section('content')
<div class="site-pagetitle jumbotron">
    <div class="container  theme-container">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="breadcrumbs">
                <i class="fa fa-home"></i>
                <span><a href="{{url('/')}}">Home</a></span>
                <i class="fa fa-arrow-circle-right"></i>
                <span><a href="{{url('dadavaai-blogs')}}">Blogs</a></span>
                <i class="fa fa-arrow-circle-right"></i>
                <span class="current red-clr"> {{$blog->blogTitle}}  </span>
            </div>
        </div>
    </div>
</div>
<div class="theme-container container">
    <div class="spc-60 row">
        <main class="col-md-9 col-sm-8 blog-wrap">
            <article class="has-post-thumbnail">
                <!-- Featured Media -->
                <div class="entry-media">
                    <a href="{{url('/dadavaai-blog/'.$blog->id.'/'.str_slug($blog->blogTitle))}}">
                        <img src="{{asset('storage/images/blog/'.$blog->blogImage)}}" alt="" itemprop="image">
                    </a>
                </div>                  
                <div class="media clearfix">
                    <div class="entry-meta media-left">
                        <!-- Publish Date -->
                        <div class="entry-time meta-date">
                            <time itemprop="datePublished" datetime="2015-12-09T21:10:20+00:00">
                                <span class="entry-time-date dblock">{{$blog->created_at->format('d M')}}</span>
                            </time>
                        </div>

                        <!-- Number of Comments -->
                        <div class="entry-reply">
                            <a href="{{('/dadavaai-blog/'.$blog->id.'/'.str_slug($blog->blogTitle))}}#comments" class="comments-link" itemprop="discussionURL">
                                <i class="fa fa-comment dblock"></i>
                                {{count($blog->blogComments)}}
                            </a>
                        </div>
                    </div>

                    <div class="media-body">
                        <header class="entry-header">
                            <!-- Author Link -->
                            <span class="vcard author entry-author">
                                <a class="url fn n" rel="author" href="category.html">
                                    {{$blog->category->categoryName}}
                                </a>
                            </span>

                            <!-- Post Categories -->
                            <span class="entry-categories" itemprop="articleSection">
                                <a href="#" rel="category tag">Bike Tours</a>, <a href="#" rel="category tag">Featured</a>
                            </span>


                            <!-- Post Title -->
                            <h3 class="entry-title" itemprop="headline">
                                <a href="{{('/dadavaai-blog/'.$blog->id.'/'.str_slug($blog->blogTitle))}}" rel="bookmark" >{{$blog->blogTitle}}</a>
                            </h3>
                        </header>

                        <!-- Main Content of the Post -->
                        <div class="entry-content" itemprop="articleBody">
                            <p>{{strip_tags($blog->description)}}</p>
                        </div>

                        <footer class="entry-footer clearfix">
                            <!-- Tags and Read More Link -->
                            <div class="pull-left">
                                <div class="tagcloud">
                                    <span class="entry-tags">
                                        <a href="#" rel="tag">first</a> <a href="#" rel="tag">seventh</a> <a href="#" rel="tag">sixth</a>                                       </span>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </article>

            <div id="comments" class="comments-area">
                <h3 class="comments-title">({{count($blog->blogComments)}}) thoughts on &ldquo;{{$blog->blogTitle}}&rdquo;</h3>

                <ol class="comments">
                    @foreach($blog->blogComments as $blogComment)
                        <li id="comment-2" class="comment even thread-even depth-1 single-comment">
                            <div class="comment-block">
                                <div class="comment-author vcard">
                                    <img alt="" src="assets/img/extra/avatar1.jpg" class="avatar" height='60' width='60' />
                                    <b class="url fn n">
                                        <a href="#" class="url fn n" itemprop="url">
                                            <span itemprop="name">{{$blogComment->userName}}</span>
                                        </a>
                                    </b> <span class="says sr-only">says:</span>
                                </div>

                                <div class="comment-content">
                                    <p>{{$blogComment->comment}}</p>
                                </div>

                                <div class="comment-metadata clearfix">
                                    <a class="left" href="#">
                                        <time datetime="2015-12-09T21:22:10+00:00" title="">{{$blogComment->created_at->format('d,M Y')}}</time>
                                    </a>

                                    <span class="right"><a href="{{('/dadavaai-blog/'.$blog->id.'/'.str_slug($blog->blogTitle))}}#comments" class="comment-reply-link" href="#">Reply</a></span>
                                </div>
                            </div>
                        </li><!-- #comment-## -->
                    @endforeach
                </ol>

                <div id="respond" class="comment-respond">
                    <h2 id="reply-title" class="comment-reply-title">
                        Leave a Reply 
                        <small><a href="#">Cancel reply</a></small>
                    </h2>

                    <form id="commentform" action="{{url('add-blog-comment',$blog->id)}}" method="POST" class="comment-form">
                        {{csrf_field()}}
                        {{method_field('POST')}}
                        <p class="comment-notes">
                            <span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
                        </p>

                        <p class="form-group comment-form-comment">
                            <label for="comment">Comment</label>
                            <textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                        </p>
                        @php
                            $client_id = \Illuminate\Support\Facades\Session::get('CLIENT_ID');
                            $client = \App\Client::find($client_id);
                        @endphp
                        @if($client)
                            <p class="form-group comment-form-author columns col-lg-6">
                                <label for="author">Name <span class="required">*</span></label> 
                                <input id="author" name="userName" class="form-control" type="text" value="{{$client->clientName}}" size="30" aria-required="true" />
                            </p>

                            <p class="form-group comment-form-email columns col-lg-6">
                                <label for="email">Email <span class="required">*</span></label> 
                                <input id="email" name="email" class="form-control" type="text" value="{{$client->email}}" size="30" aria-required="true" />
                            </p>
                        @else
                            <p class="form-group comment-form-author columns col-lg-6">
                                <label for="author">Name <span class="required">*</span></label> 
                                <input id="author" name="userName" class="form-control" type="text" value="" size="30" aria-required="true" />
                            </p>

                            <p class="form-group comment-form-email columns col-lg-6">
                                <label for="email">Email <span class="required">*</span></label> 
                                <input id="email" name="email" class="form-control" type="text" value="" size="30" aria-required="true" />
                            </p>
                        @endif

                        <div class="clearfix"></div>

                        <p class="form-submit">
                            <input name="submit" type="submit" id="submit" class="submit btn btn-default fancy-button" value="Post Comment" /> 
                        </p>
                    </form>
                </div>
            </div>
        </main>
        
        <div class="visible-xs spc-15 clear"></div>
        
        <aside class="col-md-3 col-sm-4">
            <div class="main-sidebar" >
                <div id="search-2" class="widget sidebar-widget widget_search clearfix">
                    <form method="get" id="searchform" class="form-search" action="http://localhost/goshopwp">
                        <input class="form-control search-query" type="text" placeholder="Type Keyword" name="s" id="s" />
                        <button class="btn btn-default search-button" type="submit" name="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>

                <div class="widget sidebar-widget widget_categories clearfix">
                    <h6 class="widget-title">Categories</h6>
                    <div class="panel-group">
                      @foreach($categories as $category)
                        <div class="panel panel-cate">
                            <div class="blog-cate-heading">                                            
                                <a  href="#" class=""> {{$category->categoryName}} </a>                                           
                            </div>
                        </div>
                      @endforeach

                    </div>
                </div>

                <div id="goshop_widget_posts-2" class="widget sidebar-widget goshop_widget_posts clearfix">
                    <h6 class="widget-title">Recent Posts</h6>
                    <ul class="list-unstyled">
                      @foreach($recentBlogs as $recentBlog)
                        <li>
                            <div class="media clearfix">
                                <div class="media-lefta">
                                    <a href="{{('dadavaai-blog/'.$recentBlog->id.'/'.str_slug($recentBlog->blogTitle))}}">
                                        <img src="{{url('storage/images/blog/'.$recentBlog->blogImage)}}" alt="{{$recentBlog->blogTitle}}" />
                                    </a>
                                </div>

                                <div class="media-body">
                                    <span class="widget-post-cat">Category: {{$recentBlog->category->categoryName}}</span>
                                    <h6>
                                        <a href="{{('dadavaai-blog/'.$recentBlog->id.'/'.str_slug($recentBlog->blogTitle))}}">{{$recentBlog->blogTitle}}</a>
                                    </h6>
                                    <span class="widget-post-meta">{{$blog->created_at->format('d M, Y')}}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

{{--                 <div id="tag_cloud-2" class="widget sidebar-widget widget_tag_cloud clearfix">
                    <h6 class="widget-title">Popular Tags</h6>
                    <div class="tagcloud">
                        <a href="category.html" style="font-size: 13px;">eighth</a>
                        <a href="category.html" style="font-size: 13px;">fifth</a>
                        <a href="category.html" style="font-size: 13px;">first</a>
                        <a href="category.html" style="font-size: 13px;">fourth</a>
                        <a href="category.html" style="font-size: 13px;">ninth</a>
                        <a href="category.html" style="font-size: 13px;">second</a>
                        <a href="category.html" style="font-size: 13px;">seventh</a>
                        <a href="category.html" style="font-size: 13px;">sixth</a>
                        <a href="category.html" style="font-size: 13px;">tenth</a>
                        <a href='category.html' style="font-size: 13px;">third</a>
                    </div>
                </div> --}}

{{--                 <div class="widget sidebar-widget widget_categories clearfix">
                    <h6 class="widget-title">ARCHIEVES</h6>
                    <div class="panel-group">
                        <div class="panel panel-cate">
                            <div class="cate-heading">                       
                                <a data-toggle="collapse" href="#arcv1" class="collapsed"> January <span>(75)</span> </a>                                           
                            </div>
                            <div id="arcv1" class="panel-collapse collapse">
                                <ul>
                                    <li class="cat-item"><a href="#">Bike Tours</a> (3)</li>
                                    <li class="cat-item"><a href="#">Featured</a> (1)</li>
                                    <li class="cat-item"><a href="#">Imagination</a> (2)</li>
                                    <li class="cat-item"><a href="#">Inspire</a> (1)</li>
                                    <li class="cat-item"><a href="#">Luxury</a> (1)</li>
                                    <li class="cat-item"><a href="#">Recommended</a> (2)</li>
                                    <li class="cat-item"><a href="#">Travel</a> (1)</li>
                                </ul>                                       
                            </div>
                        </div>
                        <div class="panel panel-cate">
                            <div class="cate-heading">                                            
                                <a data-toggle="collapse" href="#arcv2" class="collapsed"> February <span>(25)</span> </a>                                           
                            </div>
                            <div id="arcv2" class="panel-collapse collapse">
                                <ul>
                                    <li class="cat-item"><a href="#">Bike Tours</a> (3)</li>
                                    <li class="cat-item"><a href="#">Featured</a> (1)</li>
                                    <li class="cat-item"><a href="#">Imagination</a> (2)</li>
                                    <li class="cat-item"><a href="#">Inspire</a> (1)</li>
                                    <li class="cat-item"><a href="#">Luxury</a> (1)</li>
                                    <li class="cat-item"><a href="#">Recommended</a> (2)</li>
                                    <li class="cat-item"><a href="#">Travel</a> (1)</li>
                                </ul>                                       
                            </div>
                        </div>
                        <div class="panel panel-cate">
                            <div class="cate-heading">                                            
                                <a data-toggle="collapse" href="#arcv3" class="collapsed"> March <span>(10)</span> </a>                                           
                            </div>
                            <div id="arcv3" class="panel-collapse collapse">
                                <ul>
                                    <li class="cat-item"><a href="#">Bike Tours</a> (3)</li>
                                    <li class="cat-item"><a href="#">Featured</a> (1)</li>
                                    <li class="cat-item"><a href="#">Imagination</a> (2)</li>
                                    <li class="cat-item"><a href="#">Inspire</a> (1)</li>
                                    <li class="cat-item"><a href="#">Luxury</a> (1)</li>
                                    <li class="cat-item"><a href="#">Recommended</a> (2)</li>
                                    <li class="cat-item"><a href="#">Travel</a> (1)</li>
                                </ul>                                       
                            </div>
                        </div>
                        <div class="panel panel-cate">
                            <div class="cate-heading">                                            
                                <a data-toggle="collapse" href="#arcv4" class="collapsed no-item"> April  <span>(17)</span> </a>                                           
                            </div>
                            <div id="arcv4" class="panel-collapse collapse">                                                                                  
                            </div>
                        </div>
                        <div class="panel panel-cate">
                            <div class="cate-heading">                                            
                                <a data-toggle="collapse" href="#arcv5" class="collapsed no-item"> May <span>(21)</span> </a>                                           
                            </div>
                            <div id="arcv5" class="panel-collapse collapse">                                                                                  
                            </div>
                        </div>
                    </div>
                </div> --}}

{{--                 <div class="widget widget-flickr-feed clearfix">
                    <h6 class="widget-title">GALLERY</h6>
                    <ul>
                        <li> <a href="#"> <img src="assets/img/flicker/1.jpg" alt=""> </a> </li>
                        <li> <a href="#"> <img src="assets/img/flicker/2.jpg" alt=""> </a> </li>
                        <li> <a href="#"> <img src="assets/img/flicker/3.jpg" alt=""> </a> </li>

                        <li> <a href="#"> <img src="assets/img/flicker/4.jpg" alt=""> </a> </li>
                        <li> <a href="#"> <img src="assets/img/flicker/5.jpg" alt=""> </a> </li>
                        <li> <a href="#"> <img src="assets/img/flicker/6.jpg" alt=""> </a> </li>

                        <li> <a href="#"> <img src="assets/img/flicker/7.jpg" alt=""> </a> </li>
                        <li> <a href="#"> <img src="assets/img/flicker/8.jpg" alt=""> </a> </li>
                        <li> <a href="#"> <img src="assets/img/flicker/9.jpg" alt=""> </a> </li>
                    </ul>
                </div> --}}
            </div>
        </aside>

    </div>
</div>
<div class="clear"></div>
@endsection