@extends('informative.layouts.master')
@section('content')
	<!-- SAB BANNER START-->
	<div class="sab_banner overlay">
		<div class="container">
			<div class="sab_banner_text">
				<h2>Blog Post</h2>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Blog Post</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- SAB BANNER END-->
	
	<!-- CITY EVENT2 WRAP START-->
	<div class="city_blog2_wrap">
		<div class="container">
			<div class="row">
				@foreach($blogs as $blog)
				<div class="col-md-4 col-sm-6">
					<div class="city_blog2_fig">
						<figure class="overlay">
							<img src="{{asset('storage/images/blog/'.$blog->blogImage)}}" alt="">
							<a class="paly_btn" data-rel="prettyPhoto" href="{{asset('storage/images/blog/'.$blog->blogImage)}}">+</a>
							<span class="city_blog2_met">{{$blog->category->categoryName}}</span>
						</figure>
						<div class="city_blog2_list">
							<ul class="city_meta_list">
								<li><a href="#"><i class="fa fa-calendar"></i>{{$blog->created_at}}</a></li>
								<li><a href="#"><i class="fa fa-comment-o"></i>{{count($blog->comment)}} Comments</a></li>
							</ul>
							<div class="city_blog2_text">
								<h5><a href="{{url('informative-blog-details/'.$blog->id)}}">{{$blog->blogTitle}}</a></h5>
								<p></p>
								<a class="see_more_btn" href="{{url('informative-blog-details/'.$blog->id)}}">READ MORE<i class="fa icon-right-arrow"></i></a>
							</div>
						</div>
					</div>
				</div>
				@endforeach


				<div id="pagination" style="margin-left: 45%">
						{{ $blogs->links() }}
				</div>
			</div>
		</div>
	</div>
	<!-- CITY EVENT2 WRAP END-->
@endsection