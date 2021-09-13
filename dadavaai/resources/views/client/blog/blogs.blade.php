@extends('layouts.client')

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
                <span class="current red-clr"> Blogs  </span>
            </div>
        </div>
    </div>
</div>
<div class="theme-container container">
    <div class="spc-60 row">
        <main class="col-md-9 col-sm-8 blog-wrap">
          @foreach($blogs as $blog)
            <article class="post type-post format-standard has-post-thumbnail">
                <!-- Featured Media -->
                <div class="entry-media">
                    <a href="{{('/dadavaai-blog/'.$blog->id.'/'.str_slug($blog->blogTitle))}}">
                        <img src="{{url('storage/images/blog/'.$blog->blogImage)}}" alt="" itemprop="image">
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
                                <a class="url fn n" rel="author" href="#">
                                    {{$blog->category->categoryName}}
                                </a>
                            </span>

                            <!-- Post Categories -->
                            <span class="entry-categories" itemprop="articleSection">
                                <a href="category.html" rel="category tag">Bike Tours</a>, <a href="category.html" rel="category tag">Featured</a>                </span>


                            <!-- Post Title -->
                            <h3 class="entry-title" itemprop="headline">
                                <a href="{{('dadavaai-blog/'.$blog->id.'/'.str_slug($blog->blogTitle))}}" rel="bookmark" >{{$blog->blogTitle}}</a>
                            </h3>
                        </header>

                        <!-- Main Content of the Post -->
                        <div class="entry-content" itemprop="description">
                            <p>{{substr(strip_tags($blog->description),0,300)}}</p>
                            <a href="{{('dadavaai-blog/'.$blog->id.'/'.str_slug($blog->blogTitle))}}" class="read-more-link thm-clr">Read More  <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </article>
          @endforeach
            <nav class="site-pagination text-center">
                {{$blogs->links()}}
            </nav>
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

{{--                 <div class="widget sidebar-widget goshop_widget_posts widget_tweeter clearfix">
                    <h6 class="widget-title">Tweet Feed</h6>
                    <ul class="list-unstyled">
                        <li>
                            <div class="media clearfix">
                                <div class="media-lefta">
                                    <div class="tweet-icn"> <i class="fa fa-twitter"></i> </div>
                                </div>
                                <div class="media-body">
                                    <h6>
                                        <a href="#"> Women ‘s Summer Dress </a>
                                    </h6>
                                    <p>Lorem ipsum dolor sit amet consectetuer adipiscing elit, diam nonummy nibh euismod tincidunt ut laoreet dolore.</p>
                                    <span class="widget-post-meta">June 2015</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="media clearfix">
                                <div class="media-lefta">
                                    <div class="tweet-icn"> <i class="fa fa-twitter"></i> </div>
                                </div>
                                <div class="media-body">
                                    <h6>
                                        <a href="#"> Women ‘s Summer Dress </a>
                                    </h6>
                                    <p>Lorem ipsum dolor sit amet consectetuer adipiscing elit, diam nonummy nibh euismod tincidunt ut laoreet dolore.</p>
                                    <span class="widget-post-meta">June 2015</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
 --}}
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

                <div class="widget widget-flickr-feed clearfix">
                    <h6 class="widget-title">GALLERY</h6>
                    <ul>
                        @foreach($blogs as $blogs)
                          <li> <a href="#"> <img src="{{url('storage/images/blog/'.$recentBlog->blogImage)}}" alt=""> </a> </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </aside>

    </div>
</div>
<div class="clear"></div>
@endsection