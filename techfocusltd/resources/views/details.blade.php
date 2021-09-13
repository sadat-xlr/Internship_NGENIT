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
								<a href="{{URL::to('/productsByCat/'.$product->category_id)}}" title="">{{$product->category->categoryName}}</a>
								<span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="{{URL::to('/productsByCat/'.$product->category_id."/".$product->subcategory_id)}}" title="">{{$product->subcategory->categoryName}}</a>
								<span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="{{URL::to('/productsByCat/'.$product->category_id."/".$product->subcategory_id."/".$product->minicategory_id)}}" title="">{{$product->minicategory->miniCategoryName}}</a>
								<span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
							</li>
							<li class="trail-end">
								<a href="#" title="">{{$product->productName}}</a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<section class="flat-product-detail">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="flexslider">
							<ul class="slides">
							    <li data-thumb="{{asset('storage/images/product/'.$product->image->image1)}}">
							      <a href='#' id="zoom" class='zoom'><img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt='' width='400' height='300' /></a>
							    </li>
								@if ($product->image->image2)
							    <li data-thumb="{{asset('storage/images/product/'.$product->image->image2)}}">
							      <a href='#' id="zoom1" class='zoom'><img src="{{asset('storage/images/product/'.$product->image->image2)}}" alt='' width='400' height='300' /></a>
							    </li>
								@endif
								@if ($product->image->image3)
							    <li data-thumb="{{asset('storage/images/product/'.$product->image->image3)}}">
							      <a href='#' id="zoom2" class='zoom'><img src="{{asset('storage/images/product/'.$product->image->image3)}}" alt='' width='400' height='300' /></a>
							    </li>
								@endif
								@if ($product->image->image4)
							    <li data-thumb="{{asset('storage/images/product/'.$product->image->image4)}}">
							      <a href='#' id="zoom3" class='zoom'><img src="{{asset('storage/images/product/'.$product->image->image4)}}" alt='' width='400' height='300' /></a>
							    </li>
								@endif
								@if ($product->image->image5)
							    <li data-thumb="{{asset('storage/images/product/'.$product->image->image5)}}">
							      <a href='#' id="zoom4" class='zoom'><img src="{{asset('storage/images/product/'.$product->image->image5)}}" alt='' width='400' height='300' /></a>
							    </li>
								@endif
							</ul><!-- /.slides -->
						</div><!-- /.flexslider -->
					</div><!-- /.col-md-6 -->
					<div class="col-md-6">
						<div class="product-detail">
							<div class="header-detail">
								<h4 class="name">{{$product->productName}}</h4>
								<div class="category">
									{{$product->category->categoryName}}
								</div>
								<div class="reviewed">
									<div class="review">
									@php $sum = $i = 0; @endphp
									@foreach($product->productcomments as $productcomment)
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
									@endif
										<div class="text">
											<span>{{$i}} Reviews</span>
										</div>
									</div><!-- /.review -->
									<div class="status-product">
										Availablity 
										@if($product->availablity == 0)<span>In stock</span>
										@else<span>Out of stock</span>
										@endif
									</div>
								</div><!-- /.reviewed -->
							</div><!-- /.header-detail -->
							@php
								foreach($product->deals as $deals){
                                    if ($deals){
                                        if ($deals->valid_until >= \Carbon\Carbon::now()){
                                            $price = $product->price-(($product->price*$deals->discount_value)/100);
                                        }
                                    }
                                }

                                foreach($product->offers as $offers){
                                    if ($offers){
                                        if ($offers->valid_until >= \Carbon\Carbon::now()){
                                            $price = $product->price-(($product->price*$offers->discount_value)/100);
                                        }
                                    }
                                }
							@endphp
							<div class="content-detail">
								<div class="price">
								@if ($product->price)
									<div class="regular">
										৳ {{number_format($product->regularPrice)}}
									</div>
									<div class="sale">
										৳  @if(isset($price)){{number_format($price, 2)}} @else {{number_format($product->price, 2)}} @endif
									</div>
								@else
										<a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
								@endif
								</div>
								<div class="info-text">
									{!! html_entity_decode($product->shortDescription)  !!}
								</div>
								<div class="product-id">
									SKU: <span class="id">{{$product->sku}}</span>
								</div>
							</div><!-- /.content-detail -->
							<div class="footer-detail">
								<form action="{{url('/insertCart/'.$product->id)}}" method="post">
									{{csrf_field()}}
									<div class="quanlity-box">
											Quantity:
										<div class="quanlity">
											<input type="number" name="quantity" value="1" min="1" max="100" placeholder="Quantity">
										</div>
									</div><!-- /.quantity-box -->
									@if ($product->price)
									<div class="box-cart style2">
										<div class="btn-add-cart">
											<button style="background-color: #f92400;color: #fff;font-size: 16px;height: 50px;line-height: 50px;padding: 0 64px;border-radius: 25px;margin-right: 30px;font-weight: 600;margin-left: -8px;letter-spacing: 0.5px;"><img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart</button>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->slug)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}"><img src="{{asset('images/icons/compare.png')}}" alt="">Compare</a>
											<a href="{{URL::to('/addWishlist/'.$product->slug)}}" class="wishlist" title=""><img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist</a>
										</div>
									</div><!-- /.box-cart -->
									@endif
								</form>
								<div class="social-single">
									<span>SHARE</span>
									<ul class="social-list style2">
										<li>
											  <!-- Your share button code -->
											  <div class="fb-share-button" 
												data-href="{{url()->current()}}" 
												data-layout="button_count">
											  </div>
										</li>
										<li>
											<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
											<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">
												<i class="fa fa-twitter" aria-hidden="true"></i>
											</a>
										</li>
										<li>
											<a href="" title="" target="blank">
												<i class="fa fa-instagram" aria-hidden="true"></i>
											</a>
										</li>
										<li>
											<a href="https://pinterest.com/pin/create/button/?url={{url()->current()}}&media={{asset('storage/images/product/'.$product->image->image1)}}&description=" title="" target="blank">
												<i class="fa fa-pinterest" aria-hidden="true"></i>
											</a>
										</li>
										<li>
											<a href="https://www.linkedin.com/shareArticle?mini=true&url={{url()->current()}}&title=Techfocus%20Ltd&summary=&source=" title="" target="blank">
												<i class="fa fa-linkedin" aria-hidden="true"></i>
											</a>
										</li>
										<li>
											<a href="https://plus.google.com/share?url={{url()->current()}}" title="" target="blank">
												<i class="fa fa-google" aria-hidden="true"></i>
											</a>
										</li>
									</ul><!-- /.social-list -->
								</div><!-- /.social-single -->
							</div><!-- /.footer-detail -->
						</div><!-- /.product-detail -->
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->
			  
			</div><!-- /.container -->
		</section><!-- /.flat-product-detail -->

		<section class="flat-product-content">
			<ul class="product-detail-bar">
				<li class="active">Description</li>
				<li>Specification</li>
				<li>Reviews</li>
			</ul><!-- /.product-detail-bar -->
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="description-text">
						{!!html_entity_decode($product->description)!!}
						</div><!-- /.description-text -->
					</div><!-- /.col-md-6 -->
					@if ($product->image->image6 || $product->image->image7 || $product->image->image8)
					<div class="col-md-6">
						<div class="description-image">
							<div class="box-image">
								<img src="{{asset('storage/images/product/'.$product->image->image6)}}" alt="">
							</div>
							<div class="box-text">
								<h4>Nuqqam Et Massa</h4>
								<p>Sed sodales sed orci molestie tristique. Nunc dictum, erat id molestie vestibulum, ex leo vestibulum justo, luctus tempor erat sem quis diam. Lorem ipsum dolor sit amet.</p>
							</div>
						</div><!-- /.description-image -->
					</div><!-- /.col-md-6 -->
					<div class="col-md-12">
						<div class="different-color">
							<div class="title">
								Different Colors
							</div>
							<p>
								Sed sodales sed orci<br />molestie
							</p>
						</div><!-- /.different-color -->
					</div><!-- /.col-md-12 -->
					<div class="col-md-6">
						<div class="box-left">
							<div class="img-line">
								<img src="{{asset('images/product/single/line-1.png')}}" alt="">
							</div>
							<div class="img-product">
								<img src="{{asset('storage/images/product/'.$product->image->image7)}}" alt="">
							</div>
						</div><!-- /.box-left -->
					</div><!-- /.col-md-6 -->
					<div class="col-md-6">
						<div class="box-right">
							<div class="img-line">
								<img src="{{asset('images/product/single/line-2.png')}}" alt="">
							</div>
							<div class="img-product">
								<img src="{{asset('storage/images/product/'.$product->image->image8)}}" alt="">
							</div>
							<div class="box-text">
								<h4>Nuqqam Et Massa</h4>
								<p>Sed sodales sed orci molestie tristique. Nunc dictum, erat id molestie vestibulum, ex leo vestibulum justo, luctus tempor erat sem quis diam. Lorem ipsum dolor sit amet.</p>
							</div>
						</div><!-- /.box-right -->
					</div><!-- /.col-md-6 -->
					@endif
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="tecnical-specs">
						@if(!is_null($product->specification)) 
							<h4 class="name">
							{{$product->productName}}
							</h4>
							{!!html_entity_decode($product->specification)!!}
						@else
							<h4 class="name">
								Not Available
							</h4>
						@endif
						</div><!-- /.tecnical-specs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-4">
						<div class="rating">
								@if($sum)
								<div class="title">
									Based on {{$i}} reviews
								</div>
								<div class="score">
									<div class="average-score">
										<p class="numb">
											{{$score}}
										</p>
										<p class="text">Average score</p>
									</div>
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
								</div><!-- /.score -->
								@else
								<div class="title">
									No review yet
								</div>
								@endif
						</div><!-- /.rating -->
					</div><!-- /.col-md-6 -->
					<div class="col-md-4">
						<form action="{{url('/addReview/'.$productId)}}" method="post" accept-charset="utf-8">
							<div class="title">
								Add a review 
							</div>
							<div class="your-rating queue">
								<span>Your Rating</span>
								<div class="radio">
							      <label>
							      	<input type="radio" name="optradio" value="5" checked> 5</label>
							    </div>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
							</div>
							<div class="your-rating queue">
								<div class="radio">
							      <label>
							      	<input type="radio" name="optradio" value="4"> 4</label>
							    </div>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
							</div>
							<div class="your-rating queue">
								<div class="radio">
							      <label>
							      	<input type="radio" name="optradio" value="3"> 3</label>
							    </div>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
							</div>
							<div class="your-rating queue">
								<div class="radio">
							      <label>
							      	<input type="radio" name="optradio" value="2"> 2</label>
							    </div>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
							</div>
							<div class="your-rating queue">
								<div class="radio">
							      <label>
							      	<input type="radio" name="optradio" value="1"> 1</label>
							    </div>
								<i class="fa fa-star" aria-hidden="true"></i>
							</div>
					</div><!-- /.col-md-6 -->
					<div class="col-md-4">
						<div class="form-review">
								{{csrf_field()}}
								<div class="review-form-name">
									<input type="text" name="UserName" value="" placeholder="Name" required>
								</div>
								<div class="review-form-email">
									<input type="email" name="email" value="" placeholder="Email" required>
								</div>
								<div class="review-form-comment">
									<textarea name="comment" placeholder="Your Review" required></textarea>
								</div>
								<div class="btn-submit">
									<button type="submit">Add Review</button>
								</div>
							</form>
						</div><!-- /.form-review -->
					</div><!-- /.col-md-6 -->
					<div class="col-md-12">
						<ul class="review-list">
							@foreach($product->productcomments as $productcomment)
							<li>
								<div class="review-metadata">
									<div class="name">
										{{$productcomment->UserName}} : <span>{{$productcomment->created_at}}</span>
									</div>
									@if($productcomment->productReview == 5)
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									@elseif($productcomment->productReview == 4)
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									@elseif($productcomment->productReview == 3)
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									@elseif($productcomment->productReview == 2)
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									@else
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									@endif
								</div><!-- /.review-metadata -->
								<div class="review-content">
									<p>
										{{$productcomment->comment}}
									</p> 
								</div><!-- /.review-content -->
							</li>
							@endforeach
						</ul><!-- /.review-list -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-product-content -->

		<section class="flat-imagebox style4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="flat-row-title">
							<h3>Related Products</h3>
						</div>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="owl-carousel-3">
							@foreach($products as $product)
							<div class="imagebox style4">
								<div class="box-image">
									<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
										<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" height="100px" width="100px">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="{{URL::to('/productsByCat/'.$product->category_id)}}" title="">{{$product->category->categoryName}}</a>
									</div>
									<div class="product-name">
										<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{substr($product->productName, 0, 42)}}</a>
									</div>
									@if ($product->price)
										<div class="price">
											<span class="sale">৳ {{number_format($product->price)}}</span>
											<span class="regular">৳ {{number_format($product->regularPrice)}}</span>
										</div>
									@else
										<div class="price">
											<a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
										</div>
									@endif
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							@endforeach
						</div><!-- /.owl-carousel-3 -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-imagebox style4 -->

@endsection

@section('script')
	<!-- Load Facebook SDK for JavaScript -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-126368920-2');
	</script>
@endsection