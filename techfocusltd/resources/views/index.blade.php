@extends('masterLayout')

@section('content')
		<!-- popup-newsletter -->
		@if(Session::get('popup'))
		<div class="popup-newsletter">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						
					</div>
					<div class="col-sm-8">
						<div class="popup">
							<span></span>
							<div class="popup-text">
								<h2>Join our newsletter and <br />get discount!</h2>
								<p class="subscribe">Subscribe to the newsletter to receive updates about new products.</p>
								<div class="form-popup">
									<form action="{{URL::to('/subscribe')}}" class="subscribe-form" method="post" accept-charset="utf-8">
									{{csrf_field()}}
										<div class="subscribe-content">
											<input type="email" name="email" class="subscribe-email" placeholder="Your E-Mail" required>
											<button type="submit"><img src="{{asset('images/icons/right-2.png')}}" alt=""></button>
										</div>
									</form><!-- /.subscribe-form -->
									<div class="checkbox">
										<input type="checkbox" id="popup-not-show" name="category">
										<label for="popup-not-show">Don't show this popup again</label>
									</div>
								</div><!-- /.form-popup -->
							</div><!-- /.popup-text -->
							<div class="popup-image">
								<img src="{{asset('images/banner_boxes/popup.png')}}" alt="">
							</div><!-- /.popup-text -->
						</div><!-- /.popup -->
					</div><!-- /.col-sm-8 -->
					<div class="col-sm-2">
						
					</div>
				</div><!-- /.row -->
			</div><!-- /.container -->
		</div>
		@endif
		<!-- /.popup-newsletter -->
		<!-- slider -->
		<section class="flat-row flat-slider style3">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
					</div>
					<div class="col-lg-9">
						<div class="slider owl-carousel-11">
							
						@foreach($sliders as $slider)
							<div class="slider-item style5">
								<div class="item-text">
									<div class="header-item">
										<p>Enhanced Technology</p>
										<h2 class="name">Techfocus<br><span>Ltd</span></h2>
									</div>
									<div class="content-item">
										<div class="btn-shop">
											<a href="#" title="">SHOP NOW <img src="images/icons/right-2.png" alt=""></a>
										</div>
									</div>
								</div>
								<div class="item-image">
									<img src="{{asset('storage/images/slider/'.$slider->image)}}" alt="">
								</div>
							</div><!-- /.slider-item style5 -->
						@endforeach
						</div><!-- /.owl-carousel-11 -->
					</div><!-- /.col-lg-9 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-slider -->
		<!--flat-iconbox -->
		<section class="flat-row flat-iconbox">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-lg-3">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="{{asset('images/icons/car.png')}}" alt="">
								</div>
								<div class="box-title">
									<h3>Worldwide Shipping</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-6 col-lg-3 -->
					<div class="col-md-6 col-lg-3">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="{{asset('images/icons/order.png')}}" alt="">
								</div>
								<div class="box-title">
									<h3>Order Online Service</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-6 col-lg-3 -->
					<div class="col-md-6 col-lg-3">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="{{asset('images/icons/payment.png')}}" alt="">
								</div>
								<div class="box-title">
									<h3>Payment</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-6 col-lg-3 -->
					<div class="col-md-6 col-lg-3">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="{{asset('images/icons/return.png')}}" alt="">
								</div>
								<div class="box-title">
									<h3>Return 30 Days</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-6 col-lg-3 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>
		<!-- /.flat-iconbox -->

		<!--flat-banner-box -->
		<section class="flat-row flat-banner-box">
			<div class="container">
				<div class="row">
					@foreach($banners as $banner)
					<div class="col-md-8">
						<div class="banner-box one-half">
							<div class="inner-box">
								<a href="{{$banner->link1}}" title="">
									<img src="{{asset('storage/images/banner/'.$banner->banner_one)}}" alt="">
								</a>
							</div><!-- /.inner-box -->
							<div class="inner-box">
								<a href="{{$banner->link2}}" title="">
									<img src="{{asset('storage/images/banner/'.$banner->banner_two)}}" alt="">
								</a>
							</div><!-- /.inner-box -->
							<div class="clearfix"></div>
						</div><!-- /.box -->
						{{-- <div class="banner-box">
							<div class="inner-box">
								<a href="{{$banner->link3}}" title="">
									<img src="{{asset('storage/images/banner/'.$banner->banner_three)}}" alt="">
								</a>
							</div>
						</div><!-- /.box --> --}}
					</div><!-- /.col-md-8 -->
					<div class="col-md-4">
						<div class="banner-box">
							<div class="inner-box">
								<a href="{{$banner->link4}}" title="">
									<img src="{{asset('storage/images/banner/'.$banner->banner_four)}}" alt="">
								</a>
							</div><!-- /.inner-box -->
						</div><!-- /.box -->
					</div><!-- /.col-md-4 -->
					@endforeach
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>
		<!-- /.flat-banner-box -->

		<!-- Our Products -->
		<section class="flat-imagebox style1">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="flat-row-title">
							<h3>Our Products</h3>
						</div>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				<div class="row ">
					<div class="col-lg-3 col-md-4">
						<div class="sidebar ">
							<div class="widget widget-categories">
								<div class="widget-title">
									<h3>Categories</h3>
								</div>
								<ul class="cat-list style1 widget-content">
									@foreach($categories as $category)
									<li>
										<span>
											{{$category->categoryName}}
											<i>
												<?php $i = 0; ?>
												(@foreach($category->product as $product)
													<?php $i++; ?>
												@endforeach
												{{$i}})
											</i>
										</span>
										<ul class="cat-child">
										@foreach ($category->subcategory as $subcategory)
											<li>
												<a class="our-product-sub" data-subcat_id="{{$subcategory->id}}" data-url="{{URL::to('products-by-ajax')}}" href="">{{$subcategory->categoryName}}</a>
											</li>
										@endforeach
										</ul>
									</li>
									@endforeach
								</ul><!-- /.cat-list -->
							</div><!-- /.widget-categories -->
						</div><!-- /.sidebar -->
					</div><!-- /.col-lg-3 col-md-4 -->
					<div class="col-lg-9 col-md-8 main our_product">
						<div class="owl-carousel-10">
							@php $i = 0; @endphp
							@foreach($products as $product)
								@php $i++; @endphp
								@if($i % 2)
								<div class="owl-carousel-item">
								@endif
									<div class="product-box style1">
										<div class="imagebox style1">
											<div class="box-image">
												<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
													<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style="width: 153px;height: 122px">
												</a>
											</div><!-- /.box-image -->
											<div class="box-content">
												<div class="cat-name">
													<a href="{{URL::to('/productsByCat/'.$product->category_id)}}" title="">{{$product->category->categoryName}}</a>
												</div>
												<div class="product-name">
													<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{substr(strip_tags($product->productName), 0, 39)}}</a>
												</div>
												@if ($product->price)
												<div class="price">
													<span class="regular">৳ {{number_format($product->regularPrice)}}</span>
													<span class="sale">৳ {{number_format($product->price)}}</span>
												</div>
												@else
												<div class="price">
													<a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="">Ask for Quote</a>
												</div>
												@endif
											</div><!-- /.box-content -->
											<div class="box-bottom">
												<div class="compare-wishlist">
													<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
														<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
													</a>
													<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
														<img src="images/icons/wishlist.png" alt="">Wishlist
													</a>
												</div>
												@if ($product->price)
												<div class="btn-add-cart">
													<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
														Add to Cart
													</a>
												</div>
												@endif
											</div><!-- /.box-bottom -->
										</div><!-- /.imagebox style1 -->
									</div><!-- /.product-box style1 -->
								@if($i % 2 == 0)
								</div>
								<!-- /.owl-carousel-item -->
								@endif
							@endforeach
								</div><!-- /.owl-carousel-item -->								
						</div>
						<div class="col-lg-9 col-md-8">
							<div class="row ajax_product">
	
								
							</div>
						</div>
					</div>
					
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>
		<!-- /.Our Products -->
		

		<!-- New arrival-->
		<section class="flat-imagebox">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-list">
								<li class="active">New Arrivals</li>
								<li>Featured</li>
								<li>Offers</li>
							</ul>
						</div><!-- /.product-tab -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				<div class="box-product">
					<div class="row">
					  @foreach($newProducts as $newProduct)
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									{{--<span class="item-new">NEW</span>--}}
									 <ul class="box-image owl-carousel-1">
										<li>
											<a href="{{URL::to('/productDetails/'.$newProduct->slug)}}" title="">
												<img src="{{asset('storage/images/product/'.$newProduct->image->image1)}}" alt="" style="height:180px">
											</a>
										</li>
										@if ($newProduct->image->image2)
										<li>
											<a href="{{URL::to('/productDetails/'.$newProduct->slug)}}" title="">
												<img src="{{asset('storage/images/product/'.$newProduct->image->image2)}}" alt="" style="height:180px">
											</a>
										</li>
										@endif
										@if ($newProduct->image->image3)
										<li>
											<a href="{{URL::to('/productDetails/'.$newProduct->slug)}}" title="">
												<img src="{{asset('storage/images/product/'.$newProduct->image->image3)}}" alt="" style="height:180px">
											</a>
										</li>
										@endif
										@if ($newProduct->image->image4)
										<li>
											<a href="{{URL::to('/productDetails/'.$newProduct->slug)}}" title="">
												<img src="{{asset('storage/images/product/'.$newProduct->image->image3)}}" alt="" style="height:180px">
											</a>
										</li>
										@endif
										@if ($newProduct->image->image5)
										<li>
											<a href="{{URL::to('/productDetails/'.$newProduct->slug)}}" title="">
												<img src="{{asset('storage/images/product/'.$newProduct->image->image3)}}" alt="" style="height:180px">
											</a>
										</li>
										@endif
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="{{URL::to('/productsByCat/'.$newProduct->category_id)}}" title="">{{$newProduct->category->categoryName}}</a>
										</div>
										<div class="product-name">
											<a href="{{URL::to('/productDetails/'.$newProduct->slug)}}" title="">{{$newProduct->productName}}</a>
										</div>
										@if ($newProduct->price)
										<div class="price">
											<span class="sale">৳ {{number_format($newProduct->price)}}</span>
											<span class="regular">৳ {{number_format($newProduct->regularPrice)}}</span>
										</div>
										@else
										<div class="price">
											<a href="#" data-subject="Price quotation for {{$newProduct->productName}}" data-message="I would like to know the price of {{$newProduct->productName}}." class="btn btn-warning btn-sm quotation" title="">Ask for Quotation</a>
										</div>
										@endif
									</div><!-- /.box-content -->
									<div class="box-bottom">
										@if ($newProduct->price)
										<div class="btn-add-cart">
											<a href="{{URL::to('/addCart/'.$newProduct->id)}}" title="">
												<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
											</a>
										</div>
										@endif
										<div class="compare-wishlist">
											<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$newProduct->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$newProduct->id.'/'.$newProduct->minicategory_id)}}">
												<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
											</a>
											<a href="{{URL::to('/addWishlist/'.$newProduct->id)}}" class="wishlist" title="">
												<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>
						</div><!-- /.col-lg-3 col-sm-6 -->
					  @endforeach
					</div><!-- /.row -->
					<div class="row">
					  @foreach($featureProducts as $featureProduct)
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									{{--<span class="item-new">Feature</span>--}}
									 <ul class="box-image owl-carousel-1">
										<li>
											<a href="{{URL::to('/productDetails/'.$featureProduct->id)}}" title="">
												<img src="{{asset('storage/images/product/'.$featureProduct->image->image1)}}" alt="" style="height:180px">
											</a>
										</li>
										@if ($featureProduct->image->image2)
										<li>
											<a href="{{URL::to('/productDetails/'.$featureProduct->id)}}" title="">
												<img src="{{asset('storage/images/product/'.$featureProduct->image->image2)}}" alt="" style="height:180px">
											</a>
										</li>
										@endif
										@if ($featureProduct->image->image3)
										<li>
											<a href="{{URL::to('/productDetails/'.$featureProduct->id)}}" title="">
												<img src="{{asset('storage/images/product/'.$featureProduct->image->image3)}}" alt="" style="height:180px">
											</a>
										</li>
										@endif
										@if ($featureProduct->image->image4)
										<li>
											<a href="{{URL::to('/productDetails/'.$featureProduct->id)}}" title="">
												<img src="{{asset('storage/images/product/'.$featureProduct->image->image3)}}" alt="" style="height:180px">
											</a>
										</li>
										@endif
										@if ($featureProduct->image->image5)
										<li>
											<a href="{{URL::to('/productDetails/'.$featureProduct->id)}}" title="">
												<img src="{{asset('storage/images/product/'.$featureProduct->image->image3)}}" alt="" style="height:180px">
											</a>
										</li>
										@endif
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="{{URL::to('/productsByCat/'.$featureProduct->category_id)}}" title="">{{$featureProduct->category->categoryName}}</a>
										</div>
										<div class="product-name">
											<a href="{{URL::to('/productDetails/'.$featureProduct->id)}}" title="">{{$featureProduct->productName}}</a>
										</div>
										@if ($featureProduct->price)
										<div class="price">
											<span class="sale">৳ {{number_format($featureProduct->price)}}</span>
											<span class="regular">৳ {{number_format($featureProduct->regularPrice)}}</span>
										</div>
										@else
										<div class="price">
											<a href="#" data-subject="Price quotation for {{$featureProduct->productName}}" data-message="I would like to know the price of {{$featureProduct->productName}}." class="btn btn-warning btn-sm quotation" title="">Ask for Quotation</a>
										</div>
										@endif
									</div><!-- /.box-content -->
									<div class="box-bottom">
										@if ($featureProduct->price)
										<div class="btn-add-cart">
											<a href="{{URL::to('/addCart/'.$featureProduct->id)}}" title="">
												<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
											</a>
										</div>
										@endif
										<div class="compare-wishlist">
											<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$featureProduct->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$featureProduct->id.'/'.$featureProduct->minicategory_id)}}">
												<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
											</a>
											<a href="{{URL::to('/addWishlist/'.$featureProduct->id)}}" class="wishlist" title="">
												<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>
						</div><!-- /.col-lg-3 col-sm-6 -->
					  @endforeach	
					</div><!-- /.row -->
					<div class="row">
					@foreach($offers as $offer)
						@foreach($offer->products as $stockProduct)
							@php
								$price = $stockProduct->price-(($stockProduct->price*$offer->discount_value)/100);
							@endphp
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">-{{$offer->discount_value}}</span>
									 <ul class="box-image owl-carousel-1">
										<li>
											<a href="{{URL::to('/productDetails/'.$stockProduct->id)}}" title="">
												<img src="{{asset('storage/images/product/'.$stockProduct->image->image1)}}" alt="" style="height:180px">
											</a>
										</li>
										@if ($stockProduct->image->image2)
										<li>
											<a href="{{URL::to('/productDetails/'.$stockProduct->id)}}" title="">
												<img src="{{asset('storage/images/product/'.$stockProduct->image->image2)}}" alt="" style="height:180px">
											</a>
										</li>
										@endif
										@if ($stockProduct->image->image3)
										<li>
											<a href="{{URL::to('/productDetails/'.$stockProduct->id)}}" title="">
												<img src="{{asset('storage/images/product/'.$stockProduct->image->image3)}}" alt="" style="height:180px">
											</a>
										</li>
										@endif
										@if ($stockProduct->image->image4)
										<li>
											<a href="{{URL::to('/productDetails/'.$stockProduct->id)}}" title="">
												<img src="{{asset('storage/images/product/'.$stockProduct->image->image3)}}" alt="" style="height:180px">
											</a>
										</li>
										@endif
										@if ($stockProduct->image->image5)
										<li>
											<a href="{{URL::to('/productDetails/'.$stockProduct->id)}}" title="">
												<img src="{{asset('storage/images/product/'.$stockProduct->image->image3)}}" alt="" style="height:180px">
											</a>
										</li>
										@endif
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="{{URL::to('/productsByCat/'.$stockProduct->category_id)}}" title="">{{$stockProduct->category->categoryName}}</a>
										</div>
										<div class="product-name">
											<a href="{{URL::to('/productDetails/'.$stockProduct->id)}}" title="">{{$stockProduct->productName}}</a>
										</div>
										@if ($stockProduct->price)
										<div class="price">
											<span class="sale">৳ {{number_format($price)}}</span>
											<span class="regular">৳ {{number_format($stockProduct->regularPrice)}}</span>
										</div>
										@else
										<div class="price">
											<a href="#"  data-subject="Price quotation for {{$stockProduct->productName}}" data-message="I would like to know the price of {{$stockProduct->productName}}." class="btn btn-warning btn-sm quotation" title="">Ask for Quotation</a>
										</div>
										@endif
									</div><!-- /.box-content -->
									<div class="box-bottom">
										@if ($stockProduct->price)
										<div class="btn-add-cart">
											<a href="{{URL::to('/addCart/'.$stockProduct->id)}}" title="">
												<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
											</a>
										</div>
										@endif
										<div class="compare-wishlist">
											<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$stockProduct->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$stockProduct->id.'/'.$stockProduct->minicategory_id)}}">
												<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
											</a>
											<a href="{{URL::to('/addWishlist/'.$stockProduct->id)}}" class="wishlist" title="">
												<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>
						</div><!-- /.col-lg-3 col-sm-6 -->
						@endforeach
					@endforeach
					</div><!-- /.row -->
				</div><!-- /.box-product -->
			</div><!-- /.container -->
		</section>
		<!-- /.New arrival -->

		<!-- Computers -->
		<section class="flat-imagebox style2 background">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="product-wrap">
							<div class="product-tab style1">
								<ul class="tab-list">
									<li class="active">Computers</li>
									<li>Mobile</li>
									<li>Accessories</li>
									<li>Hawdware</li>
									<li>Storage</li>
									<li>AI,loT</li>
									<li>Books</li>
								</ul><!-- /.tab-list -->
							</div><!-- /.product-tab style1 -->
							<div class="tab-item">
								<div class="row">
								@php
									$catProducts = \App\Product::where('minicategory_id', 95)->inRandomOrder()->take(5)->get();
									$i = 0;
								@endphp
								@foreach($catProducts as $product)
									@php $i++; @endphp
									@if($i == 1)
										<div class="col-md-6">
											<div class="product-box">
												<div class="imagebox style2 v1">
													<div class="box-image">
														<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
															<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="">
														</a>
													</div><!-- /.box-image -->
													<div class="box-content">
														<div class="cat-name">
															<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
														</div>
														<div class="product-name">
															<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
														</div>
														@if ($product->price)
															<div class="price">
																<span class="sale">৳{{$product->price}}</span>
																<span class="regular">৳{{$product->regularPrice}}</span>
															</div>
														@else
															<div class="price">
																<a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
															</div>
														@endif
													</div><!-- /.box-content -->
													<div class="box-bottom">
														@if ($product->price)
															<div class="btn-add-cart">
																<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																	<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																</a>
															</div>
														@endif
														<div class="compare-wishlist">
															<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
															</a>
															<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
															</a>
														</div>
													</div><!-- /.box-bottom -->
												</div><!-- /.imagebox style2 -->
											</div><!-- /.product-box -->
										</div><!-- /.col-md-6 -->
									@else
										@if($i % 2 == 0)
											<div class="col-md-3 col-sm-6">
												@endif
												<div class="product-box style2">
													<div class="imagebox style2">
														<div class="box-image">
															<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
																<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style="height:180px">
															</a>
														</div><!-- /.box-image -->
														<div class="box-content">
															<div class="cat-name">
																<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
															</div>
															<div class="product-name">
																<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
															</div>
															@if ($product->price)
																<div class="price">
																	<span class="sale">৳{{$product->price}}</span>
																	<span class="regular">৳{{$product->regularPrice}}</span>
																</div>
															@else
																<div class="price">
																	<a href="#" class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
																</div>
															@endif
														</div><!-- /.box-content -->
														<div class="box-bottom">
															@if ($product->price)
																<div class="btn-add-cart">
																	<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																		<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																	</a>
																</div>
															@endif
															<div class="compare-wishlist">
																<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																	<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
																</a>
																<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																	<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
																</a>
															</div>
														</div><!-- /.box-bottom -->
													</div><!-- /.imagebox style2 -->
												</div><!-- /.product-box -->
												@if($i % 2)
											</div><!-- /.col-md-3 col-sm-6 -->
										@endif
									@endif
								@endforeach
								@if($i)
									@if($i % 2 == 0)
										</div><!-- /.col-md-3 col-sm-6 -->
									@endif
								@endif
								</div><!-- /.row -->
								<div class="row">
									@php
										$catProducts = \App\Product::where('minicategory_id', 98)->inRandomOrder()->take(5)->get();
										$i = 0;
									@endphp
									@foreach($catProducts as $product)
										@php $i++; @endphp
										@if($i == 1 || $i ==2)
											@if($i % 2)
												<div class="col-md-3 col-sm-6">
													@endif
													<div class="product-box style2">
														<div class="imagebox style2">
															<div class="box-image">
																<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
																	<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style="height:180px">
																</a>
															</div><!-- /.box-image -->
															<div class="box-content">
																<div class="cat-name">
																	<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
																</div>
																<div class="product-name">
																	<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
																</div>
																@if ($product->price)
																	<div class="price">
																		<span class="sale">৳{{$product->price}}</span>
																		<span class="regular">৳{{$product->regularPrice}}</span>
																	</div>
																@else
																	<div class="price">
																		<a href="#" class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
																	</div>
																@endif
															</div><!-- /.box-content -->
															<div class="box-bottom">
																@if ($product->price)
																	<div class="btn-add-cart">
																		<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																			<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																		</a>
																	</div>
																@endif
																<div class="compare-wishlist">
																	<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																		<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
																	</a>
																	<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																		<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
																	</a>
																</div>
															</div><!-- /.box-bottom -->
														</div><!-- /.imagebox style2 -->
													</div><!-- /.product-box -->
													@if($i % 2 == 0)
												</div><!-- /.col-md-3 col-sm-6 -->
											@endif
										@elseif($i == 3)
											<div class="col-md-6">
												<div class="product-box">
													<div class="imagebox style2 v1">
														<div class="box-image">
															<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
																<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="">
															</a>
														</div><!-- /.box-image -->
														<div class="box-content">
															<div class="cat-name">
																<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
															</div>
															<div class="product-name">
																<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
															</div>
															@if ($product->price)
																<div class="price">
																	<span class="sale">৳{{$product->price}}</span>
																	<span class="regular">৳{{$product->regularPrice}}</span>
																</div>
															@else
																<div class="price">
																	<a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
																</div>
															@endif
														</div><!-- /.box-content -->
														<div class="box-bottom">
															@if ($product->price)
																<div class="btn-add-cart">
																	<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																		<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																	</a>
																</div>
															@endif
															<div class="compare-wishlist">
																<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																	<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
																</a>
																<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																	<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
																</a>
															</div>
														</div><!-- /.box-bottom -->
													</div><!-- /.imagebox style2 -->
												</div><!-- /.product-box -->
											</div><!-- /.col-md-6 -->
										@else
											@if($i % 2 == 0)
												<div class="col-md-3 col-sm-6">
													@endif
													<div class="product-box style2">
														<div class="imagebox style2">
															<div class="box-image">
																<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
																	<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style="height:180px">
																</a>
															</div><!-- /.box-image -->
															<div class="box-content">
																<div class="cat-name">
																	<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
																</div>
																<div class="product-name">
																	<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
																</div>
																@if ($product->price)
																	<div class="price">
																		<span class="sale">৳{{$product->price}}</span>
																		<span class="regular">৳{{$product->regularPrice}}</span>
																	</div>
																@else
																	<div class="price">
																		<a href="#" class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
																	</div>
																@endif
															</div><!-- /.box-content -->
															<div class="box-bottom">
																@if ($product->price)
																	<div class="btn-add-cart">
																		<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																			<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																		</a>
																	</div>
																@endif
																<div class="compare-wishlist">
																	<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																		<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
																	</a>
																	<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																		<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
																	</a>
																</div>
															</div><!-- /.box-bottom -->
														</div><!-- /.imagebox style2 -->
													</div><!-- /.product-box -->
													@if($i % 2)
												</div><!-- /.col-md-3 col-sm-6 -->
											@endif
										@endif
									@endforeach
									@if($i == 1 || $i == 4)
										</div><!-- /.col-md-3 col-sm-6 -->
									@endif
								</div><!-- /.row -->
								<div class="row">
									@php
										$catProducts = \App\Product::where('subcategory_id', 2)->inRandomOrder()->take(5)->get();
										$i = 0;
									@endphp
									@foreach($catProducts as $product)
										@php $i++; @endphp
										@if($i == 5)
											<div class="col-md-6">
												<div class="product-box">
													<div class="imagebox style2 v1">
														<div class="box-image">
															<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
																<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="">
															</a>
														</div><!-- /.box-image -->
														<div class="box-content">
															<div class="cat-name">
																<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
															</div>
															<div class="product-name">
																<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
															</div>
															@if ($product->price)
																<div class="price">
																	<span class="sale">৳{{$product->price}}</span>
																	<span class="regular">৳{{$product->regularPrice}}</span>
																</div>
															@else
																<div class="price">
																	<a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
																</div>
															@endif
														</div><!-- /.box-content -->
														<div class="box-bottom">
															@if ($product->price)
																<div class="btn-add-cart">
																	<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																		<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																	</a>
																</div>
															@endif
															<div class="compare-wishlist">
																<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																	<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
																</a>
																<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																	<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
																</a>
															</div>
														</div><!-- /.box-bottom -->
													</div><!-- /.imagebox style2 -->
												</div><!-- /.product-box -->
											</div><!-- /.col-md-6 -->
										@else
											@if($i % 2)
												<div class="col-md-3 col-sm-6">
													@endif
													<div class="product-box style2">
														<div class="imagebox style2">
															<div class="box-image">
																<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
																	<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style="height:180px">
																</a>
															</div><!-- /.box-image -->
															<div class="box-content">
																<div class="cat-name">
																	<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
																</div>
																<div class="product-name">
																	<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
																</div>
																@if ($product->price)
																	<div class="price">
																		<span class="sale">৳{{$product->price}}</span>
																		<span class="regular">৳{{$product->regularPrice}}</span>
																	</div>
																@else
																	<div class="price">
																		<a href="#" class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
																	</div>
																@endif
															</div><!-- /.box-content -->
															<div class="box-bottom">
																@if ($product->price)
																	<div class="btn-add-cart">
																		<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																			<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																		</a>
																	</div>
																@endif
																<div class="compare-wishlist">
																	<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																		<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
																	</a>
																	<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																		<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
																	</a>
																</div>
															</div><!-- /.box-bottom -->
														</div><!-- /.imagebox style2 -->
													</div><!-- /.product-box -->
													@if($i % 2 == 0)
												</div><!-- /.col-md-3 col-sm-6 -->
											@endif
										@endif
									@endforeach
									@if($i == 1 || $i == 3)
											</div><!-- /.col-md-3 col-sm-6 -->
									@endif
								</div><!-- /.row -->
								<div class="row">
									@php
										$catProducts = \App\Product::where('subcategory_id', 10)->inRandomOrder()->take(5)->get();
										$i = 0;
									@endphp
									@foreach($catProducts as $product)
										@php $i++; @endphp
										@if($i == 1)
											<div class="col-md-6">
												<div class="product-box">
													<div class="imagebox style2 v1">
														<div class="box-image">
															<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
																<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="">
															</a>
														</div><!-- /.box-image -->
														<div class="box-content">
															<div class="cat-name">
																<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
															</div>
															<div class="product-name">
																<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
															</div>
															@if ($product->price)
																<div class="price">
																	<span class="sale">৳{{$product->price}}</span>
																	<span class="regular">৳{{$product->regularPrice}}</span>
																</div>
															@else
																<div class="price">
																	<a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
																</div>
															@endif
														</div><!-- /.box-content -->
														<div class="box-bottom">
															@if ($product->price)
																<div class="btn-add-cart">
																	<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																		<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																	</a>
																</div>
															@endif
															<div class="compare-wishlist">
																<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																	<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
																</a>
																<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																	<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
																</a>
															</div>
														</div><!-- /.box-bottom -->
													</div><!-- /.imagebox style2 -->
												</div><!-- /.product-box -->
											</div><!-- /.col-md-6 -->
										@else
											@if($i % 2 == 0)
												<div class="col-md-3 col-sm-6">
													@endif
													<div class="product-box style2">
														<div class="imagebox style2">
															<div class="box-image">
																<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
																	<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style="height:180px">
																</a>
															</div><!-- /.box-image -->
															<div class="box-content">
																<div class="cat-name">
																	<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
																</div>
																<div class="product-name">
																	<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
																</div>
																@if ($product->price)
																	<div class="price">
																		<span class="sale">৳{{$product->price}}</span>
																		<span class="regular">৳{{$product->regularPrice}}</span>
																	</div>
																@else
																	<div class="price">
																		<a href="#" class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
																	</div>
																@endif
															</div><!-- /.box-content -->
															<div class="box-bottom">
																@if ($product->price)
																	<div class="btn-add-cart">
																		<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																			<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																		</a>
																	</div>
																@endif
																<div class="compare-wishlist">
																	<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																		<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
																	</a>
																	<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																		<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
																	</a>
																</div>
															</div><!-- /.box-bottom -->
														</div><!-- /.imagebox style2 -->
													</div><!-- /.product-box -->
													@if($i % 2)
												</div><!-- /.col-md-3 col-sm-6 -->
											@endif
										@endif
									@endforeach
									@if($i)
										@if($i % 2 == 0)
											</div><!-- /.col-md-3 col-sm-6 -->
										@endif
									@endif
							</div><!-- /.row -->
							<div class="row">
								@php
									$catProducts = \App\Product::where('minicategory_id', 97)->inRandomOrder()->take(5)->get();
									$i = 0;
								@endphp
								@foreach($catProducts as $product)
									@php $i++; @endphp
									@if($i == 1 || $i ==2)
										@if($i % 2)
											<div class="col-md-3 col-sm-6">
												@endif
												<div class="product-box style2">
													<div class="imagebox style2">
														<div class="box-image">
															<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
																<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style="height:180px">
															</a>
														</div><!-- /.box-image -->
														<div class="box-content">
															<div class="cat-name">
																<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
															</div>
															<div class="product-name">
																<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
															</div>
															@if ($product->price)
																<div class="price">
																	<span class="sale">৳{{$product->price}}</span>
																	<span class="regular">৳{{$product->regularPrice}}</span>
																</div>
															@else
																<div class="price">
																	<a href="#" class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
																</div>
															@endif
														</div><!-- /.box-content -->
														<div class="box-bottom">
															@if ($product->price)
																<div class="btn-add-cart">
																	<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																		<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																	</a>
																</div>
															@endif
															<div class="compare-wishlist">
																<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																	<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
																</a>
																<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																	<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
																</a>
															</div>
														</div><!-- /.box-bottom -->
													</div><!-- /.imagebox style2 -->
												</div><!-- /.product-box -->
												@if($i % 2 == 0)
											</div><!-- /.col-md-3 col-sm-6 -->
										@endif
									@elseif($i == 3)
										<div class="col-md-6">
											<div class="product-box">
												<div class="imagebox style2 v1">
													<div class="box-image">
														<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
															<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="">
														</a>
													</div><!-- /.box-image -->
													<div class="box-content">
														<div class="cat-name">
															<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
														</div>
														<div class="product-name">
															<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
														</div>
														@if ($product->price)
															<div class="price">
																<span class="sale">৳{{$product->price}}</span>
																<span class="regular">৳{{$product->regularPrice}}</span>
															</div>
														@else
															<div class="price">
																<a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
															</div>
														@endif
													</div><!-- /.box-content -->
													<div class="box-bottom">
														@if ($product->price)
															<div class="btn-add-cart">
																<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																	<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																</a>
															</div>
														@endif
														<div class="compare-wishlist">
															<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
															</a>
															<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
															</a>
														</div>
													</div><!-- /.box-bottom -->
												</div><!-- /.imagebox style2 -->
											</div><!-- /.product-box -->
										</div><!-- /.col-md-6 -->
									@else
										@if($i % 2 == 0)
											<div class="col-md-3 col-sm-6">
												@endif
												<div class="product-box style2">
													<div class="imagebox style2">
														<div class="box-image">
															<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
																<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style="height:180px">
															</a>
														</div><!-- /.box-image -->
														<div class="box-content">
															<div class="cat-name">
																<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
															</div>
															<div class="product-name">
																<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
															</div>
															@if ($product->price)
																<div class="price">
																	<span class="sale">৳{{$product->price}}</span>
																	<span class="regular">৳{{$product->regularPrice}}</span>
																</div>
															@else
																<div class="price">
																	<a href="#" class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
																</div>
															@endif
														</div><!-- /.box-content -->
														<div class="box-bottom">
															@if ($product->price)
																<div class="btn-add-cart">
																	<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																		<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																	</a>
																</div>
															@endif
															<div class="compare-wishlist">
																<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																	<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
																</a>
																<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																	<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
																</a>
															</div>
														</div><!-- /.box-bottom -->
													</div><!-- /.imagebox style2 -->
												</div><!-- /.product-box -->
												@if($i % 2)
											</div><!-- /.col-md-3 col-sm-6 -->
										@endif
									@endif
								@endforeach
								@if($i == 1 || $i == 4)
							</div><!-- /.col-md-3 col-sm-6 -->
							@endif
						</div><!-- /.row -->
						<div class="row">
							@php
								$catProducts = \App\Product::where('category_id', 12)->inRandomOrder()->take(5)->get();
									$i = 0;
							@endphp
							@foreach($catProducts as $product)
								@php $i++; @endphp
								@if($i == 5)
									<div class="col-md-6">
										<div class="product-box">
											<div class="imagebox style2 v1">
												<div class="box-image">
													<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
														<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
													</div>
													<div class="product-name">
														<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
													</div>
													@if ($product->price)
														<div class="price">
															<span class="sale">৳{{$product->price}}</span>
															<span class="regular">৳{{$product->regularPrice}}</span>
														</div>
													@else
														<div class="price">
															<a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
														</div>
													@endif
												</div><!-- /.box-content -->
												<div class="box-bottom">
													@if ($product->price)
														<div class="btn-add-cart">
															<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
															</a>
														</div>
													@endif
													<div class="compare-wishlist">
														<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
															<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
														</a>
														<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
															<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
									</div><!-- /.col-md-6 -->
								@else
									@if($i % 2)
										<div class="col-md-3 col-sm-6">
											@endif
											<div class="product-box style2">
												<div class="imagebox style2">
													<div class="box-image">
														<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
															<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style="height:180px">
														</a>
													</div><!-- /.box-image -->
													<div class="box-content">
														<div class="cat-name">
															<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
														</div>
														<div class="product-name">
															<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
														</div>
														@if ($product->price)
															<div class="price">
																<span class="sale">৳{{$product->price}}</span>
																<span class="regular">৳{{$product->regularPrice}}</span>
															</div>
														@else
															<div class="price">
																<a href="#" class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
															</div>
														@endif
													</div><!-- /.box-content -->
													<div class="box-bottom">
														@if ($product->price)
															<div class="btn-add-cart">
																<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																	<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																</a>
															</div>
														@endif
														<div class="compare-wishlist">
															<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
															</a>
															<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
															</a>
														</div>
													</div><!-- /.box-bottom -->
												</div><!-- /.imagebox style2 -->
											</div><!-- /.product-box -->
											@if($i % 2 == 0)
										</div><!-- /.col-md-3 col-sm-6 -->
									@endif
								@endif
							@endforeach
							@if($i == 1 || $i == 3)
								</div><!-- /.col-md-3 col-sm-6 -->
							@endif
							</div><!-- /.row -->
							<div class="row">
								@php
									$catProducts = \App\Product::where('subcategory_id', 42)->inRandomOrder()->take(5)->get();
										$i = 0;
								@endphp
								@foreach($catProducts as $product)
									@php $i++; @endphp
									@if($i == 1)
										<div class="col-md-6">
											<div class="product-box">
												<div class="imagebox style2 v1">
													<div class="box-image">
														<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
															<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="">
														</a>
													</div><!-- /.box-image -->
													<div class="box-content">
														<div class="cat-name">
															<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
														</div>
														<div class="product-name">
															<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
														</div>
														@if ($product->price)
															<div class="price">
																<span class="sale">৳{{$product->price}}</span>
																<span class="regular">৳{{$product->regularPrice}}</span>
															</div>
														@else
															<div class="price">
																<a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
															</div>
														@endif
													</div><!-- /.box-content -->
													<div class="box-bottom">
														@if ($product->price)
															<div class="btn-add-cart">
																<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																	<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																</a>
															</div>
														@endif
														<div class="compare-wishlist">
															<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
															</a>
															<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
															</a>
														</div>
													</div><!-- /.box-bottom -->
												</div><!-- /.imagebox style2 -->
											</div><!-- /.product-box -->
										</div><!-- /.col-md-6 -->
									@else
										@if($i % 2 == 0)
											<div class="col-md-3 col-sm-6">
												@endif
												<div class="product-box style2">
													<div class="imagebox style2">
														<div class="box-image">
															<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
																<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style="height:180px">
															</a>
														</div><!-- /.box-image -->
														<div class="box-content">
															<div class="cat-name">
																<a href="{{URL::to('/productsByCat/'.$product->id)}}" title="">{{$product->category->categoryName}}</a>
															</div>
															<div class="product-name">
																<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
															</div>
															@if ($product->price)
																<div class="price">
																	<span class="sale">৳{{$product->price}}</span>
																	<span class="regular">৳{{$product->regularPrice}}</span>
																</div>
															@else
																<div class="price">
																	<a href="#" class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
																</div>
															@endif
														</div><!-- /.box-content -->
														<div class="box-bottom">
															@if ($product->price)
																<div class="btn-add-cart">
																	<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																		<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
																	</a>
																</div>
															@endif
															<div class="compare-wishlist">
																<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$product->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$product->id.'/'.$product->minicategory_id)}}">
																	<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
																</a>
																<a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
																	<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
																</a>
															</div>
														</div><!-- /.box-bottom -->
													</div><!-- /.imagebox style2 -->
												</div><!-- /.product-box -->
												@if($i % 2)
											</div><!-- /.col-md-3 col-sm-6 -->
										@endif
									@endif
								@endforeach
								@if($i)
									@if($i % 2 == 0)
										</div><!-- /.col-md-3 col-sm-6 -->
									@endif
								@endif
								</div><!-- /.row -->
							</div><!-- /.tab-item -->
						</div><!-- /.product-wrap -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>
		<!-- /.Computers -->

		<!-- deal -->
		<section class="flat-imagebox style3" id="deal">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="owl-carousel-2">
						@foreach($deals as $deal)
						@foreach ($deal->products as $offerProduct)
							@php
								$price = $offerProduct->price-(($offerProduct->price*$deal->discount_value)/100);
							@endphp
							<div class="box-counter">
								<div class="counter">
									<span class="special">Special Offer</span>
									<div class="counter-content">
										<p>{{substr(strip_tags($offerProduct->description), 0, 107)}}...</p>
										<div class="count-down" data-countdown="{{$deal->valid_until}}">
											<div class="square">
												<div class="numb">
													7
												</div>
												<div class="text">
													DAYS
												</div>
											</div>
											<div class="square">
												<div class="numb">
													4
												</div>
												<div class="text">
													HOURS
												</div>
											</div>
											<div class="square">
												<div class="numb">
													25
												</div>
												<div class="text">
													MINS
												</div>
											</div>
											<div class="square">
												<div class="numb">
													30
												</div>
												<div class="text">
													SECS
												</div>
											</div>
										</div><!-- /.count-down -->
									</div><!-- /.counter-content -->
								</div><!-- /.counter -->
								<div class="product-item">
									<div class="imagebox style3">
										<div class="box-image save">
											<a href="{{URL::to('/productDetails/'.$offerProduct->id)}}" title="">
												<img src="{{asset('storage/images/product/'.$offerProduct->image->image1)}}" alt="" style="height:400px; width:350px">
											</a>
											<span>Save ৳ {{number_format($offerProduct->price-($offerProduct->price * $deal->discount_value/100))}}</span>
										</div><!-- /.box-image -->
										<div class="box-content">
											<div class="product-name">
												<a href="{{URL::to('/productDetails/'.$offerProduct->id)}}" title="">{{$offerProduct->productName}}</a>
											</div>
											<ul class="product-info">
												<li>{{substr(strip_tags($offerProduct->description), 0, 300)}}...</li>
											</ul>
											<div class="price">
												<span class="sale">৳ {{number_format($price)}}</span>
												<span class="regular">৳ {{number_format($offerProduct->regularPrice)}}</span>
											</div>
										</div><!-- /.box-content -->
										<div class="box-bottom">
											<div class="btn-add-cart">
												<a href="{{URL::to('/addCart/'.$offerProduct->id)}}" title="">
													<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
												</a>
											</div>
											<div class="compare-wishlist">
												<a href="#" class="compare" title="" data-comparelist="{{URL::to('/addCompare/'.$offerProduct->id)}}" data-comparesimiliar="{{URL::to('/compareSimiliar/'.$offerProduct->id.'/'.$offerProduct->minicategory_id)}}">
													<img src="{{asset('images/icons/compare.png')}}" alt="">Compare
												</a>
												<a href="{{URL::to('/addWishlist/'.$offerProduct->id)}}" class="wishlist" title="">
													<img src="{{asset('images/icons/wishlist.png')}}" alt="">Wishlist
												</a>
											</div>
										</div><!-- /.box-bottom -->
									</div><!-- /.imagbox style3 -->
								</div><!-- /.product-item -->
							</div><!-- /.box-counter -->
						@endforeach
						@endforeach
						</div><!-- /.owl-carousel-2 -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>
		<!-- /.deal -->
		
		<!-- Most Viewed -->
		<section class="flat-imagebox style4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="flat-row-title">
							<h3>Most Viewed</h3>
						</div>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="owl-carousel-3">
						@if (isset($mostViewed))
							@foreach($mostViewed as $product)
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
											<a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="">Ask for Quotation</a>
										</div>
										@endif
									</div><!-- /.box-content -->
								</div><!-- /.imagebox style4 -->
							@endforeach
						@endif
						</div><!-- /.owl-carousel-3 -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>
		<!-- /.Most Viewed -->	

		<!--Today deals -->
		<section class="flat-highlights">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="flat-row-title">
							<h3>Today deals</h3>
						</div>
						<ul class="product-list style1">
						<?php $j = 0; ?>
						@foreach($deals as $deal)
							@foreach ($deal->products as $dealProduct)
								<?php $j++; ?>
							<li>
								<div class="img-product">
									<a href="{{URL::to('/productDetails/'.$dealProduct->slug)}}" title="">
										<img src="{{asset('storage/images/product/'.$dealProduct->image->image1)}}" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="{{URL::to('/productDetails/'.$dealProduct->slug)}}" title="">{{$dealProduct->productName}}</a>
									</div>
									@php $sum = $i = 0; @endphp
									@foreach($dealProduct->productcomments as $productcomment)
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
										<div style="color:red">
											No review yet
										</div>
									@endif
									@php
										$price = $dealProduct->price-(($dealProduct->price*$deal->discount_value)/100);
									@endphp
									@if ($dealProduct->price)
										<div class="price">
											<span class="sale">৳ {{number_format($price)}}</span>
											<span class="regular">৳ {{number_format($dealProduct->regularPrice)}}</span>
										</div>
									@else
										<div class="price">
											<a href="#" data-subject="Price quotation for {{$dealProduct->productName}}" data-message="I would like to know the price of {{$dealProduct->productName}}." class="btn btn-warning btn-sm quotation" title="">Ask for Quote</a>
										</div>
									@endif
								</div>
								<div class="clearfix"></div>
							</li>
							<?php
							if($j == 3){
								break;
							}
							?>
							@endforeach
						@endforeach
						</ul><!-- /.product-list style1 -->
					</div><!-- /.col-md-4 -->
					<div class="col-md-4">
						<div class="flat-row-title">
							<h3>Offers</h3>
						</div>
						<ul class="product-list style1">
						  <?php $j = 0; ?>
						  @foreach($offers as $offer)
							  @foreach($offer->products as $offerProduct)
						  <?php $j++; ?>
							<li>
								<div class="img-product">
									<a href="{{URL::to('/productDetails/'.$offerProduct->slug)}}" title="">
										<img src="{{asset('storage/images/product/'.$offerProduct->image->image1)}}" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="{{URL::to('/productDetails/'.$offerProduct->slug)}}" title="">{{$offerProduct->productName}}</a>
									</div>
									@php $sum = $i = 0; @endphp
									@foreach($offerProduct->productcomments as $productcomment)
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
										<div style="color:red">
											No review yet
										</div>
									@endif
									@php
										$price = $offerProduct->price-(($offerProduct->price*$offer->discount_value)/100);
									@endphp
									@if ($offerProduct->price)
									<div class="price">
										<span class="sale">৳ {{number_format($price)}}</span>
										<span class="regular">৳ {{number_format($offerProduct->regularPrice)}}</span>
									</div>
									@else
									<div class="price">
										<a href="#" data-subject="Price quotation for {{$offerProduct->productName}}" data-message="I would like to know the price of {{$offerProduct->productName}}." class="btn btn-warning btn-sm quotation" title="">Ask for Quote</a>
									</div>
									@endif
								</div>
								<div class="clearfix"></div>
							</li>
						  <?php 
							if($j == 3){
							  break;
							}
						  ?>
						  @endforeach
						  @endforeach
						</ul>
					</div><!-- /.col-md-4 -->
					<div class="col-md-4">
						<div class="flat-row-title">
							<h3>Hot Deals</h3>
						</div>
						<ul class="product-list style1">
						<?php $j = 0; ?>
						@foreach($deals as $deal)
							@if($deal->discount_value >= 50)
							@foreach ($deal->products as $dealProduct)
								<?php $j++; ?>
								<li>
									<div class="img-product">
										<a href="{{URL::to('/productDetails/'.$dealProduct->slug)}}" title="">
											<img src="{{asset('storage/images/product/'.$dealProduct->image->image1)}}" alt="">
										</a>
									</div>
									<div class="info-product">
										<div class="name">
											<a href="{{URL::to('/productDetails/'.$dealProduct->slug)}}" title="">{{$dealProduct->productName}}</a>
										</div>
										@php $sum = $i = 0; @endphp
										@foreach($dealProduct->productcomments as $productcomment)
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
											<div style="color:red">
												No review yet
											</div>
										@endif
										@php
											$price = $dealProduct->price-(($dealProduct->price*$deal->discount_value)/100);
										@endphp
										@if ($dealProduct->price)
											<div class="price">
												<span class="sale">৳ {{number_format($price)}}</span>
												<span class="regular">৳ {{number_format($dealProduct->regularPrice)}}</span>
											</div>
										@else
											<div class="price">
												<a href="#" data-subject="Price quotation for {{$dealProduct->productName}}" data-message="I would like to know the price of {{$dealProduct->productName}}." class="btn btn-warning btn-sm quotation" title="">Ask for Quote</a>
											</div>
										@endif
									</div>
									<div class="clearfix"></div>
								</li>
								<?php
								if($j == 3){
									break;
								}
								?>
							@endforeach
							@endif
						@endforeach
						</ul><!-- /.product-list style1 -->
					</div><!-- /.col-md-4 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>
		<!-- /.Today deals -->
		
		<!-- Our Partners -->
		<section class="flat-row flat-brand style2">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title">
							<h3>Our Partners</h3>
						</div>
						<ul class="owl-carousel-9">
						@foreach ($partners as $partner)
							<li>
								<img src="{{asset('storage/images/partner/'.$partner->logo)}}" alt="">
							</li>
						@endforeach
						</ul><!-- /.owl-carousel-5 -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>
		<!-- /.Our Partners -->
		
		<script>
		window.onload= function(){
			document.getElementById('mega-menu').className='style1';
		}
		</script>

@endsection