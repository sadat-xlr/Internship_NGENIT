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
								<a href="{{url('productsByInd')}}" title="">Industries</a>
								<span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
							</li>
							<li class="trail-end">
								<a href="#" title="">
								{{$industry->industryName}}
								</a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<main id="shop">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="sidebar ">
							<div class="widget widget-categories">
								<div class="widget-title">
									<h3>Industries<span></span></h3>
								</div>
								<ul class="cat-list style1 widget-content">
									@foreach($industries as $industry)
									<li>
										<span>
											<a href="{{URL::to('/productsByInd/'.$industry->id)}}" title="">{{$industry->industryName}}</a>
											<i>
												<?php $i = 0; ?>
												(@foreach($industry->product as $product)
													<?php $i++; ?>
												@endforeach
												{{$i}})
											</i>
										</span>
									</li>
									@endforeach
								</ul><!-- /.cat-list -->
							</div><!-- /.widget-categories -->
							<div class="widget widget-price">
								<div class="widget-title">
									<h3>Price<span></span></h3>
								</div>
								<div class="widget-content">
									<p>Price</p>
									<div class="price search-filter-input">
                                        <div id="slider-range" class="price-slider ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-filter-group="price"><div class="ui-slider-range ui-corner-all ui-widget-header" ></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span></div>
                                        <p class="amount">
                                          <input type="text" id="amount" disabled="">
                                        </p>
                                   </div>
								</div>
							</div><!-- /.widget widget-price -->
							<div class="widget widget-brands">
								<div class="widget-title">
									<h3>Brands<span></span></h3>
								</div>
								<div class="widget-content" data-filter-group="brand">
									<form action="#" method="get" accept-charset="utf-8">
										<input type="text" name="brands" id="brands" placeholder="Brands Search">
									</form>
									<ul class="box-checkbox scroll">
										  <?php $j = 0; ?>
									  @foreach($brands as $brand)
									  <?php $j++; ?>
										<li class="check-box brands">
											<input type="checkbox" id="checkbox{{$j}}" value=".{{$brand->brandName}}" name="checkbox{{$j}}" data-filter=".b{{$brand->id}}">
											<label for="checkbox{{$j}}">
											{{$brand->brandName}}
											</label>
										</li>
									  @endforeach
									</ul>
								</div>
							</div><!-- /.widget widget-brands -->
							<div class="widget widget-color">
								<div class="widget-title">
									<h3>Color<span></span></h3>
									<div style="height: 2px"></div>
								</div>
								<div class="widget-content" data-filter-group="color">
									<form action="#" method="get" accept-charset="utf-8">
										<input type="text" name="color" id="color" placeholder="Color Search">
									</form>
									<div style="height: 5px"></div>
									<ul class="box-checkbox scroll">
										@foreach($colors as $color)
											<li class="check-box color">
												<input type="checkbox" id="check{{$color->id}}" name="check{{$color->id}}" value=".{{$color->color}}">
												<label for="check{{$color->id}}">{{$color->color}} </label>
											</li>
										@endforeach
									</ul>
								</div>
							</div><!-- /.widget widget-color -->
							<div class="widget widget-products">
								<div class="widget-title">
									<h3>Latest Products<span></span></h3>
								</div>
								<ul class="product-list widget-content">
								  <?php $j = 0; ?>
								  @foreach($newProducts as $product)
								  <?php $j++; ?>
									<li>
										<div class="img-product">
											<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
												<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" height="100px" width="100px">
											</a>
										</div>
										<div class="info-product">
											<div class="name">
												<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
											</div>
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
											@else
												<div style="color:red">
													No review yet
												</div>
											@endif
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
										</div>
										<div class="clearfix"></div>
									</li>
									<?php 
										if($j == 3){
										  break;
										}
									?>
								  @endforeach	
								</ul>
							</div><!-- /.widget widget-products -->
							<div class="widget widget-banner">
								<div class="banner-box">
									<div class="inner-box">
										<a href="#" title="">
											<img src="{{asset('images/banner_boxes/06.png')}}" alt="">
										</a>
									</div>
								</div>
							</div><!-- /.widget widget-banner -->
						</div><!-- /.sidebar -->
					</div><!-- /.col-lg-3 col-md-4 -->
					<div class="col-lg-9 col-md-8">
						<div class="main-shop">
							<div class="slider owl-carousel-16">
								<div class="slider-item style9">
									<div class="item-text">
										<div class="header-item">
											<p>You can build the banner for other category</p>
											<h2 class="name">Shop Banner</h2>
										</div>
									</div>
									<div class="item-image">
										<img src="{{asset('images/banner_boxes/07.png')}}" alt="">
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style9 -->
								<div class="slider-item style9">
									<div class="item-text">
										<div class="header-item">
											<p>You can build the banner for other category</p>
											<h2 class="name">Shop Banner</h2>
										</div>
									</div>
									<div class="item-image">
										<img src="{{asset('images/banner_boxes/07.png')}}" alt="">
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style9 -->
								
							</div><!-- /.slider -->
							@if (!$products->isEmpty())
							<div class="wrap-imagebox">
								<div class="flat-row-title">
									<h3>
										{{$industry->industryName}}
									</h3>
									<span>
										Showing @if(!$products->isEmpty()) 1 @else 0 @endif-{{$products->count()}} of  {{$products->count()}} results
									</span>
									<div class="clearfix"></div>
								</div>
								<div class="sort-product">
									<ul class="icons">
										<li>
											<img src="{{asset('images/icons/list-1.png')}}" alt="">
										</li>
										<li>
											<img src="{{asset('images/icons/list-2.png')}}" alt="">
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="tab-product">
									<div class="row sort-box">
									  @foreach($products as $product)
										<div class="col-lg-4 col-sm-6 product {{$product->industry->id}} b{{$product->brand_id}} @foreach($product->colors as $color){{$color->color}} @endforeach @foreach($product->sizes as $size){{$size->size}} @endforeach" data-price="{{$product->price}}">
											<div class="product-box">
												<div class="imagebox">
													<div class="box-image owl-carousel-1">
														<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
															<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style="height:180px">
														</a>
														@if ($product->image->image2)
														<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
															<img src="{{asset('storage/images/product/'.$product->image->image2)}}" alt="" style="height:180px">
														</a>
														@endif
														@if ($product->image->image3)
														<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
															<img src="{{asset('storage/images/product/'.$product->image->image3)}}" alt="" style="height:180px">
														</a>
														@endif
														@if ($product->image->image4)
														<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
															<img src="{{asset('storage/images/product/'.$product->image->image4)}}" alt="" style="height:180px">
														</a>
														@endif
														@if ($product->image->image5)
														<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
															<img src="{{asset('storage/images/product/'.$product->image->image5)}}" alt="" style="height:180px">
														</a>	
														@endif
													</div><!-- /.box-image -->
													<div class="box-content">
														<div class="cat-name">
															<a href="{{URL::to('/productsByCat/'.$product->category_id)}}" title="">{{$product->category->categoryName}}</a>
														</div>
														<div class="product-name">
															<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
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
												</div><!-- /.imagebox -->
											</div><!-- /.product-box -->
										</div><!-- /.col-lg-4 col-sm-6 -->
									  @endforeach
										<div style="height: 9px;"></div>
									</div>
									<div class="sort-box">
									  @foreach($products as $product)
										<div class="product-box style3">
											<div class="imagebox style1 v3">
												<div class="box-image">
													<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">
														<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="{{URL::to('/productsByCat/'.$product->category_id)}}" title="">{{$product->category->categoryName}}</a>
													</div>
													<div class="product-name">
														<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
													</div>
													<div class="status">
														Availablity: 
														@if($product->availablity == 0) In stock
														@else Out of stock
														@endif
													</div>
													<div class="info">
														<p>
															{{substr(strip_tags($product->description), 0, 115)}}...
														</p>
													</div>
												</div><!-- /.box-content -->
												<div class="box-price">
													@if ($product->price)
														<div class="price">
															<span class="sale">৳ {{number_format($product->price)}}</span>
															<span class="regular">৳ {{number_format($product->regularPrice)}}</span>
														</div>
														<div class="btn-add-cart">
															<a href="{{URL::to('/addCart/'.$product->id)}}" title="">
																<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
															</a>
														</div>
													@else
														<div class="price">
															<a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
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
												</div><!-- /.box-price -->
											</div><!-- /.imagebox -->
										</div><!-- /.product-box -->
									  @endforeach
										<div style="height: 9px;"></div>
									</div>
								</div>
							</div><!-- /.wrap-imagebox -->
							<div class="blog-pagination">
								<span>
									Showing @if(!$products->isEmpty()) 1 @else 0 @endif-{{$products->count()}} of  {{$products->count()}} results
								</span>
								<div class="clearfix"></div>
							</div><!-- /.blog-pagination -->
							@else
								<div class="alert alert-danger">
									<h1 style="text-align:center">No products available for this industry!</h1>
								</div>
								<div class="box-cart style2" style="text-align:center">
									<div class="btn-add-cart">
										<a href="{{URL::to('/home')}}" title="">
											<img src="{{asset('images/icons/add-cart.png')}}" alt="">Continue Shopping
										</a>
									</div>
								</div><!-- /.box-cart -->
							@endif
						</div><!-- /.main-shop -->
					</div><!-- /.col-lg-9 col-md-8 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</main><!-- /#shop -->

		<section class="flat-imagebox style4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="flat-row-title">
							<h3>Recent Products</h3>
						</div>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="owl-carousel-3 style3">
						@foreach ($newProducts as $product)
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
										<a href="{{URL::to('/productDetails/'.$product->slug)}}" title="">{{$product->productName}}</a>
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