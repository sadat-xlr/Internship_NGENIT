@extends('masterLayout')

@section('content')
			
			<section class="flat-breadcrumb">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<ul class="breadcrumbs">
								<li class="trail-item">
									<a href="{{url('/')}}" title="">Home</a>
									<span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
								</li>
								<li class="trail-end">
									<a href="#" title="">Blog</a>
								</li>
							</ul><!-- /.breacrumbs -->
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</section><!-- /.flat-breadcrumb -->

			<section class="main-blog">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-lg-9">
							<div class="post-wrap">
							  @foreach($blogs as $blog)
								<article class="main-post style1 {{$blog->category_id}}">
									<div class="featured-post">
										<a href="{{URL::to('/blog-details/'.$blog->id)}}" title="">
											<img src="{{asset('storage/images/blog/'.$blog->blogImage)}}" style="width: 258px;height: 229px" alt="">
										</a>
									</div><!-- /.featured-post -->
									<div class="content-post">
										<h3 class="title-post">
											<a href="{{URL::to('/blog-details/'.$blog->id)}}" title="">{{$blog->blogTitle}}</a>
										</h3>
										<ul class="meta-post">
											<li class="comment">
												<a href="#" title="">
													<?php $i = 0; ?>
													@foreach($blog->comment as $comment)
														<?php $i++; ?>
													@endforeach
													{{$i}} Comments
												</a>
											</li>
											<li class="date">
												<a href="#" title="">
												{{date_format($blog->created_at, 'M d, Y')}}
												</a>
											</li>
										</ul>
										<div class="entry-post">
											<p>{{substr(strip_tags($blog->description), 0, 292)}}</p>
											<div class="more-link">
												<a href="{{URL::to('/blog-details/'.$blog->id)}}" title="">Read More
													<span>
														<img src="{{asset('images/icons/right-2.png')}}" alt="">
													</span>
												</a>
											</div>
										</div>
									</div><!-- /.content-post -->
								</article><!-- /.main-post style1 -->
							  @endforeach
							</div><!-- /.post-wrap -->
							{{$blogs->links('pagination')}}
						</div><!-- /.col-md-8 col-lg-9 -->
						<div class="col-md-4 col-lg-3">
							<div class="sidebar left">
								<div class="widget widget-search">
									<form action="#" method="get" accept-charset="utf-8">
										<input type="text" id="blog_search" name="widget-search" placeholder="Search">
									</form>
								</div><!-- /.widget widget-search -->
								<div class="widget widget-categories">
									<div class="widget-title">
										<h3>Categories</h3>
									</div>
									<ul class="cat-list" data-filter-group="cat">
									  @foreach($categories as $category)
										<li>
											<a href="#" title="" class="buttons" data-filter=".{{$category->id}}">
												{{$category->categoryName}}
												<?php $i = 0; ?>
												<span>
													(@foreach($category->blog as $blog)
														<?php $i++; ?>
													@endforeach
													{{$i}}
													)
												</span>
											</a>
										</li>
									  @endforeach
									</ul>
								</div><!-- /.widget widget-categories -->
								<div class="widget widget-products">
									<div class="widget-title">
										<h3>Latest Products</h3>
									</div>
									<ul class="product-list style1">
									  @foreach($newProducts as $newProduct)
										<li>
											<div class="img-product">
												<a href="{{URL::to('/productDetails/'.$newProduct->id)}}" title="">
													<img src="{{asset('storage/images/product/'.$newProduct->image->image1)}}" alt="">
												</a>
											</div>
											<div class="info-product">
												<div class="name">
													<a href="{{URL::to('/productDetails/'.$newProduct->id)}}" title="">{{$newProduct->productName}}</a>
												</div>
												@php $sum = $i = 0; @endphp
												@foreach($newProduct->productcomments as $productcomment)
													@php 
														$i++;
														$sum += $productcomment->productReview; 
													@endphp
												@endforeach
												@if($sum)
													@php $score = round($sum/$i); @endphp 
													@if($score == 5)
													<div class="queue">
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
													</div>
													@elseif($score == 4)
													<div class="queue">
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
													</div>
													@elseif($score == 3)
													<div class="queue">
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
													</div>
													@elseif($score == 2)
													<div class="queue">
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
													</div>
													@else
													<div class="queue">
														<i class="fa fa-star" aria-hidden="true"></i>
													</div>
													@endif
												@else
													<div style="color:red">No Review yet</div>
												@endif
												<div class="price">
													@if($newProduct->price)
													<span class="sale">${{$newProduct->price}}</span>
													<span class="regular">${{$newProduct->regularPrice}}</span>
													@else
													<span class="sale">Call for price</span>
													@endif
												</div>
											</div>
										</li>	
									  @endforeach
									</ul>
								</div><!-- /.widget widget-product -->
								<div class="widget widget-tags">
									<div class="widget-title">
										<h3>Popular Tags</h3>
									</div>
									<ul class="tag-list">
										<li>
											<a href="#" class="waves-effect waves-teal" title="">Phone</a>
										</li>
										<li>
											<a href="#" class="waves-effect waves-teal" title="">Cameras</a>
										</li>
										<li>
											<a href="#" class="waves-effect waves-teal" title="">Computers</a>
										</li>
										<li>
											<a href="#" class="waves-effect waves-teal" title="">Laptops</a>
										</li>
										<li>
											<a href="#" class="waves-effect waves-teal" title="">Headphones</a>
										</li>
									</ul>
								</div><!-- /.widget widget-tags -->
							</div><!-- /.sidebar left -->
						</div><!-- /.col-md-4 col-lg-3 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</section><!-- /.main-blog -->

@endsection