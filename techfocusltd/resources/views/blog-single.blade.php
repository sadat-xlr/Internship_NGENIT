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
								<li class="trail-item">
									<a href="{{url('/blog')}}" title="">Blog</a>
									<span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
								</li>
								<li class="trail-end">
									<a href="#" title="">{{$blog->blogTitle}}</a>
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
								<article class="main-post single">
									<div class="featured-post">
										<a href="#" title="">
											<img src="{{asset('storage/images/blog/'.$blog->blogImage)}}" alt="">
										</a>
									</div><!-- /.featured-post -->
									<div class="divider25"></div>
									<div class="content-post">
										<h3 class="title-post">
											<a href="#" title="">{{$blog->blogTitle}}</a>
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
										</ul><!-- /.meta-post -->
										<div class="entry-post">
											<p>
												{!!html_entity_decode($blog->description)!!}
											</p>
										</div><!-- /.entry-post -->
										<div class="social-single">
											<span>SHARE</span>
											<ul class="social-list style2">
											@foreach($siteinfos as $siteinfo)
												<li>
													<a href="{{$siteinfo->facebook}}" title="" target="blank">
														<i class="fa fa-facebook" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="{{$siteinfo->twitter}}" title="" target="blank">
														<i class="fa fa-twitter" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="{{$siteinfo->instagram}}" title="" target="blank">
														<i class="fa fa-instagram" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="{{$siteinfo->pinterest}}" title="" target="blank">
														<i class="fa fa-pinterest" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="{{$siteinfo->dribbble}}" title="" target="blank">
														<i class="fa fa-linkedin" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="{{$siteinfo->googleplus}}" title="" target="blank">
														<i class="fa fa-google" aria-hidden="true"></i>
													</a>
												</li>
											@endforeach
											</ul>
										</div><!-- /.social-single -->
									</div><!-- /.content-post -->
								</article><!-- /.main-post single -->
							</div><!-- /.post-wrap -->
							<div class="comment-area">
								<h2 class="comment-title">{{$i}} Comments</h2>
								<ol class="comment-list">
									@foreach($blog->comment as $comment)
									<li class="comment">
										<div class="comment-author">
											<img src="{{asset('images/blog/user.png')}}" alt="">
										</div>
										<div class="comment-text">
											<div class="comment-metadata">
												<div class="name">
													{{$comment->UserName}} : <span>{{$comment->created_at}}</span>
												</div>
												@if($comment->blogReview == 5)
												<div class="queue">
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
												</div>
												@elseif($comment->blogReview == 4)
												<div class="queue">
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
												</div>
												@elseif($comment->blogReview == 3)
												<div class="queue">
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
												</div>
												@elseif($comment->blogReview == 2)
												<div class="queue">
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
												</div>
												@else
												<div class="queue">
													<i class="fa fa-star" aria-hidden="true"></i>
												</div>
												@endif
											</div>
											<div class="comment-content">
												<p>
													{{$comment->comment}}
												</p> 
											</div>
											<div class="clearfix"></div>
										</div>
									</li><!-- /.comment -->
									@endforeach
								</ol><!-- /.comment-list -->
								<div class="comment-respond">
									<h2 class="comment-reply-title">Leave a Reply</h2>
									<p>Your email address will not be published. Required fields are marked *</p>
									<div class="form-comment">
										<form action="{{url('/addBlogReview/'.$blogId)}}" method="post" accept-charset="utf-8">
											{{csrf_field()}}
											<div class="comment-form-name">
												<div class="radio">
											      	<input type="radio" name="optradio" value="5" checked>
											    </div>
											    <div class="queue">
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
												</div>
											</div><!-- /.comment-form-name -->
											<div class="comment-form-name">
												<div class="radio">
											      	<input type="radio" name="optradio" value="4">
											    </div>
											    <div class="queue">
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
												</div>
											</div><!-- /.comment-form-name -->
											<div class="comment-form-name">
												<div class="radio">
											      	<input type="radio" name="optradio" value="3">
											    </div>
											    <div class="queue">
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
												</div>
											</div><!-- /.comment-form-name -->
											<div class="comment-form-name">
												<div class="radio">
											      	<input type="radio" name="optradio" value="2">
											    </div>
											    <div class="queue">
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
												</div>
											</div><!-- /.comment-form-name -->
											<div class="comment-form-name">
												<div class="radio">
											      	<input type="radio" name="optradio" value="1">
											    </div>
											    <div class="queue">
														<i class="fa fa-star" aria-hidden="true"></i>
												</div>
											</div><!-- /.comment-form-name -->
											<div class="comment-form-name">
												<label id="name-author">Name *</label>
												<input type="text" name="UserName" value="" placeholder="Your Name">
											</div><!-- /.comment-form-name -->
											<div class="comment-form-email">
												<label id="email-author">Email *</label>
												<input type="email" name="email" value="" placeholder="Your Email">
											</div><!-- /.comment-form-email -->
											<div class="comment-form-comment">
												<label id="comment-author">Comment *</label>
												<textarea name="comment" placeholder="Your Comment"></textarea>
											</div><!-- /.comment-form-comment -->
											<div class="btn-submit">
												<button type="submit">Post Comment</button>
											</div><!-- /.btn-submit -->
										</form><!-- /.form -->
									</div><!-- /.form-comment -->
								</div><!-- /.comment-respond -->
							</div><!-- /.comment-area -->
						</div><!-- /.col-md-8 col-lg-9 -->
						<div class="col-md-4 col-lg-3">
							<div class="sidebar left">
								<div class="widget widget-search">
									<form action="#" method="get" accept-charset="utf-8">
										<input type="text" name="widget-search" placeholder="Search">
									</form>
								</div><!-- /.widget widget-search -->
								<div class="widget widget-categories">
									<div class="widget-title">
										<h3>Categories</h3>
									</div>
									<ul class="cat-list">
									  @foreach($categories as $category)
										<li>
											<a href="#" title="">
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