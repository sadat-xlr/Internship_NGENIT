<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
	<!-- Basic Page Needs -->
	<meta charset="UTF-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<?php $siteinfos = DB::table('siteinfos')->get();?>
	<title>@foreach($siteinfos as $siteinfo) {{$siteinfo->title}} @endforeach</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="TECH FOCUS is a technology based solution provider to the customer of Bangladesh and other eligible countries. A good range of hardware, software, solution, training, products it serves to the customers. Techfocus continuously works on advanced technology solution for its' clients.">
	<meta name="keywords" content="New Technologies Manufacturers, New Technologies Suppliers, New Technologies, Manufacturer Directory, Exporters, Sellers, tech accessories, tech trends, tech products, tech reviews, Techfocus, Techfocus.com, Books, Online Shopping, Book Store, Magazine, Subscription, Music, CDs, DVDs, Videos, Electronics, Video Games, Computers, Cell Phones, Toys, Games, Apparel, Accessories, Shoes, Jewelry, Watches, Office Products, Sports & Outdoors, Sporting Goods, Baby Products, Health, Personal Care, Beauty, Home, Garden, Bed & Bath, Furniture, Tools, Hardware, Vacuums, Outdoor Living, Automotive Parts, Pet Supplies, Broadband, DSL" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Techfocus Limited">
	<meta name="subject" content="eCommerce, Corporate Supply">
	<meta name="Geography" content="89/2, Haque Chamber, Panthapath, Dhaka 1205">
	<meta name="Language" content="English">
	<meta http-equiv="CACHE-CONTROL" content="PUBLIC">
	<meta name="Copyright" content="Techfocus Limited">
	<meta name="Designer" content="Software Department, Techfocus Limited">
	<meta name="Publisher" content="Techfocus Limited">
	<meta name="distribution" content="Local">
	<meta name="Robots" content="INDEX,FOLLOW">
	<meta name="zipcode" content="1205">
	<meta name="city" content="Dhaka">
	<meta name="country" content="Bangladesh">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
	<meta property="og:url"           content="{{url()->current()}}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content=" TechFocus LTD - Focusing on Technology Solution" />
	<meta property="og:description"   content="TechFocus was founded, and continues to flourish based on a very unique culture. We cater to every client and their demanding requirements. We earn our customers trust and loyalty. We listen intently and respond to their needs with solutions that really work. Our services combine our technology expertise backed with a commitment of personable service and dependable support. We're driven to remain 'ahead of the curve' because technology evolves rapidly. This presents the opportunity for small and mid-sized businesses to dramatically improve the efficiency of their enterprise." />
	<meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Boostrap style -->
	<link rel="stylesheet" type="text/css" href="{{asset('stylesheets/bootstrap.min.css')}}">

	<!-- Theme style -->
	<link rel="stylesheet" type="text/css" href="{{asset('stylesheets/style.css')}}">

	<!-- Reponsive -->
	<link rel="stylesheet" type="text/css" href="{{asset('stylesheets/responsive.css')}}">
	
	<!-- start: jquery -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<!-- end: jquery -->
	
	<!-- Font-awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- data-table -->
	<link rel="stylesheet" href="{{asset('stylesheets/jquery.dataTables.min.css')}}">

	<link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.png')}}">

	<script>
	  <!-- App base_url-->
	  var base_url = {!! json_encode(url('/shop')) !!}
	</script>
</head>
<body class="header_sticky">
	<div class="boxed">

		<div class="overlay"></div>

		{{--<!-- Preloader -->
		<div class="preloader">
			<div class="clear-loading loading-effect-2">
				<span></span>
			</div>
		</div><!-- /.preloader -->--}}

		<section id="header" class="header">
			<div class="header-top">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<ul class="flat-support">
								<li>
									<a href="{{URL::to('/faq')}}" title="">Support</a>
								</li>
								{{--<li>
									<a href="{{URL::to('/store-location')}}" title="">Store Locator</a>
								</li>--}}
								<li>
									<a href="{{URL::to('/order-tracking')}}" title="">Track Your Order</a>
								</li>
							</ul><!-- /.flat-support -->
						</div><!-- /.col-md-4 -->
						<div class="col-md-4">
							<ul class="flat-infomation">
								<li class="phone">
								<?php $contacts = DB::table('contacts')->get();?>
									Call Us: <a href="#" title="">@foreach($contacts as $contact) {{$contact->phone1}} @endforeach</a>
								</li>
							</ul><!-- /.flat-infomation -->
						</div><!-- /.col-md-4 -->
						<div class="col-md-4">
							<ul class="flat-unstyled">
								<li class="account">
									<a href="{{URL::to('/my-account')}}" title="">My Account<i class="fa fa-angle-down" aria-hidden="true"></i></a>
									<ul class="unstyled">
									@if (!\Session::has('ID'))
										<li>
											<a href="{{URL::to('/login')}}" title="">Login/Register</a>
										</li>
									@else
										<li>
											<a href="{{URL::to('/cmrLogout')}}" title="">Logout</a>
										</li>
									@endif
										<li>
											<a href="{{URL::to('/wishlist')}}" title="">Wishlist</a>
										</li>
										<li>
											<a href="{{URL::to('/cart')}}" title="">My Cart</a>
										</li>
										<li>
											<a href="{{URL::to('/my-account')}}" title="">My Account</a>
										</li>
										<li>
											<a href="{{URL::to('/checkout')}}" title="">Checkout</a>
										</li>
									</ul><!-- /.unstyled -->
								</li>
							</ul><!-- /.flat-unstyled -->
						</div><!-- /.col-md-4 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.header-top -->
			<div class="header-middle">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<div id="logo" class="logo">
								<a href="{{URL::to('/shop')}}" title="">
									<img src="{{asset('images/logos/logo.png')}}" alt="">
								</a>
							</div><!-- /#logo -->
						</div><!-- /.col-md-3 -->
						<div class="col-md-6">
							<div class="top-search">
								<form action="{{URL::to('/getSearchedProduct')}}" method="get" class="form-search" accept-charset="utf-8">
									{{csrf_field()}}
									<div class="cat-wrap">
										<select name="category">
											<option hidden value="">All Category</option>
											<option hidden value="">Cameras</option>
											<option hidden value="">Computer</option>
											<option hidden value="">Laptops</option>
										</select>
										<span><i class="fa fa-angle-down" aria-hidden="true"></i></span>
										<div class="all-categories">
										@php
											$brands = \App\Brand::all();
											$technologies = \App\Technology::all();
											$industries = \App\Industry::all();
											$categories = \App\Category::where('status', 0)->get();
										@endphp
										@foreach ($categories as $category)
											<div class="cat-list-search">
												<div class="title">
													{{$category->categoryName}}
												</div>
												<ul>
												@foreach ($category->subcategory as $subcategory)
													<a href="{{URL::to('productsByCat/'.$category->id."/".$subcategory->id)}}" title=""><li>{{$subcategory->categoryName}}</li></a>
												@endforeach
												</ul>
											</div><!-- /.cat-list-search -->
										@endforeach
										</div><!-- /.all-categories -->
									</div><!-- /.cat-wrap -->
									<div class="box-search">
										<input type="text" id="search" name="search" placeholder="Search what you looking for ?" required>
										<span class="btn-search">
											<button type="submit" class="waves-effect"><img src="{{asset('images/icons/search.png')}}" alt=""></button>
										</span>
										<div class="search-suggestions">
											<div class="box-suggestions">
												<div class="title">
													Search Suggestions
												</div>
												<ul id="productSug">
												</ul>
											</div><!-- /.box-suggestions -->
											<div class="box-cat">
												<div class="cat-list-search">
													<div class="title">
														Categories
													</div>
													<ul>
														@foreach ($categories as $category)
														<li>
															<a href="{{URL::to('productsByCat/'.$category->id)}}">{{$category->categoryName}}</a>
														</li>
														@endforeach
													</ul>
												</div><!-- /.cat-list-search -->
											</div><!-- /.box-cat -->
										</div><!-- /.search-suggestions -->
									</div><!-- /.box-search -->
								</form><!-- /.form-search -->
							</div><!-- /.top-search -->
						</div><!-- /.col-md-6 -->
						<div class="col-md-3">
							<div class="box-cart">
								<div class="inner-box">
									<ul class="menu-compare-wishlist">
										<li class="compares">
											<a href="{{URL::to('/compare')}}" title="">
												<img src="{{asset('images/icons/compare.png')}}" alt="">
											</a>
										</li>
										<li class="wishlist">
											<a href="{{URL::to('/wishlist')}}" title="">
												<img src="{{asset('images/icons/wishlist.png')}}" alt="">
											</a>
										</li>
									</ul><!-- /.menu-compare-wishlist -->
								</div><!-- /.inner-box -->
								<div class="inner-box">
									<a href="{{URL::to('/cart')}}" title="">
										<div class="icon-cart">
											<img src="{{asset('images/icons/cart.png')}}" alt="">
											<span>
											<?php 
												$price = 0;
												$carts = DB::table('carts')
															->join('products', 'products.id', '=', 'carts.product_id')
															->join('images', 'images.product_id', '=', 'carts.product_id')
															->select(
																	'products.price',
																	'products.productName',
																	'images.image1',
																	'carts.*'
																	)
															->where('sId', Session::getId())
															->get();
											?>
											@foreach($carts as $cart)
											<?php 
												$unitPrice = $cart->quantity * $cart->price;
												$price += $unitPrice;
											?>
											@endforeach
											{{$carts->count()}}
											</span>
										</div>
										<div class="price">
										@if ($price)
											৳{{$price}}
										@else
											৳0.00
										@endif
										</div>
									</a>
									@if (!$carts->isEmpty())
									<div class="dropdown-box">
										<ul>
										@foreach($carts as $cart)
											<li>
												<div class="img-product">
													<img src="{{asset('storage/images/product/'.$cart->image1)}}" alt="">
												</div>
												<div class="info-product">
													<div class="name">
													{{$cart->productName}}
													</div>
													<div class="price">
														<span>{{$cart->quantity}} x</span>
														<span>৳{{$cart->price}}</span>
													</div>
												</div>
												<div class="clearfix"></div>
												<a href="{{URL::to('/deleteCart/'.$cart->id)}}" onclick="return confirm('Are you sure want to delete this data?')" title="">
													<span class="delete">x</span>
												</a>
											</li>
										@endforeach
										</ul>
										<div class="total">
											<span>Subtotal:</span>
											<span class="price">৳{{$price}}</span>
										</div>
										<div class="btn-cart">
											<a href="{{URL::to('/cart')}}" class="view-cart" title="">View Cart</a>
											<a href="{{URL::to('/checkout')}}" class="check-out" title="">Checkout</a>
										</div>
									</div>
									@endif
								</div><!-- /.inner-box -->
							</div><!-- /.box-cart -->
						</div><!-- /.col-md-3 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.header-middle -->
			<div class="header-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-2">
							<div id="mega-menu">
								<div class="btn-mega"><span></span>ALL CATEGORIES</div>
								<ul class="menu">
								@foreach ($categories as $category)
									<li>
										<a href="{{URL::to('/productsByCat/'.$category->id)}}" title="" class="dropdown">
											<span class="menu-img">
												<img src="{{asset('storage/images/icons/menu/'.$category->categoryImage)}}" alt="">
											</span>
											<span class="menu-title">
												{{$category->categoryName}}
											</span>
										</a>
										<div class="drop-menu">
										@foreach ($category->subcategory as $subcategory)
											<div class="one-third">
												<div class="cat-title">
													{{$subcategory->categoryName}}
												</div>
												<ul>
												@foreach ($subcategory->minicategory as $minicategory)
													<li>
														<a href="{{URL::to('/productsByCat/'.$category->id."/".$subcategory->id."/".$minicategory->id)}}" title="">{{$minicategory->miniCategoryName}}</a>
													</li>
												@endforeach
												</ul>
												<div class="show">
													<a href="{{URL::to('/productsByCat/'.$category->id."/".$subcategory->id)}}" title="">Shop All</a>
												</div>
											</div>
										@endforeach
										</div>
									</li>
								@endforeach
								</ul>
							</div>
						</div><!-- /.col-md-3 -->
						<div class="col-md-9 col-10">
							<div class="nav-wrap">
								<div id="mainnav" class="mainnav">
									<ul class="menu">
										<li class="column-1">
											<a href="{{URL::to('/shop')}}" title="">Home</a>
										</li><!-- /.column-1 -->
										<li class="has-mega-menu">
											<a href="{{url('productsByInd')}}" title="">Industry</a>
											<div class="submenu">
												<div class="row">
												@foreach($industries as $industry)
													<div class="col-lg-3 col-md-12">
														<h3 class="cat-title">{{$industry->industryName}}</h3>
														<ul class="submenu-child">
														<?php
															$categories = DB::table('products')
															->join('categories', 'categories.id', '=', 'products.category_id')
															->select(
																	'products.category_id',
																	'categories.categoryName'
																	)
															->distinct() //returns too few; without too many
															->where('products.industry_id', $industry->id)
															->get();
														?>
														@foreach($categories as $category)
															<li>
																<a href="{{URL::to('/productsByInd/'.$industry->id."/".$category->category_id)}}" title="">{{$category->categoryName}}</a>
															</li>
														@endforeach
														</ul>
														<div class="show">
															<a href="{{URL::to('/productsByInd/'.$industry->id)}}" title="">Shop All</a>
														</div>
													</div><!-- /.col-lg-3 col-md-12 -->
												@endforeach
												</div><!-- /.row -->
											</div><!-- /.submenu -->
										</li><!-- /.has-mega-menu -->
										<li class="column-1">
											<a href="{{URL::to('/technologies')}}" title="">Technology</a>
											<ul class="submenu">
											  @foreach ($technologies as $technology)
												<li>
													<a href="{{URL::to('/productsByTech/'.$technology->id)}}" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>{{$technology->technologyName}}</a>
												</li>
											  @endforeach
											</ul><!-- /.submenu -->
										</li><!-- /.column-1 -->
										<li class="has-mega-menu">
											<a href="{{URL::to('/brands')}}" title="">Brands</a>
											<div class="submenu">
												<div class="row">
												@foreach($brands as $brand)
													<div class="col-lg-2 col-md-12">
														<ul class="submenu-child">
														</ul>
														<div class="show">
															<a href="{{URL::to('productsByBrand/'.$brand->id)}}" title="">{{$brand->brandName}}</a>
														</div>
													</div>
												@endforeach
												</div>
											</div>
										</li>
										<li class="column-1">
											<a href="#" title="">Help</a>
											<ul class="submenu">
												<li>
													<a href="{{URL::to('/faq')}}" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>FAQ</a>
												</li>
												<li>
													<a href="{{URL::to('/term-condition')}}" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Terms & Condition</a>
												</li>
												<li>
													<a href="{{URL::to('/order-tracking')}}" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Order Tracking</a>
												</li>
												<li>
													<a href="{{URL::to('/about')}}" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>About</a>
												</li>
												<li>
													<a href="{{URL::to('/contact')}}" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Contact</a>
												</li>
											</ul><!-- /.submenu -->
										</li><!-- /.column-1 -->
										<li class="column-1">
											<a href="{{URL::to('/blog')}}" title="">Blog</a>
										</li><!-- /.column-1 -->
									</ul><!-- /.menu -->
								</div><!-- /.mainnav -->
							</div><!-- /.nav-wrap -->
							<div class="today-deal">
								{{-- <a href="@if (url()->current() == url('/shop')) #deal @else {{url('/shop#deal')}} @endif" title="">TODAY DEALS</a> --}}
								<a href="{{url('/')}}" title="">Corporate Home</a>

							</div><!-- /.today-deal -->
							<div class="btn-menu">
	                            <span></span>
	                        </div><!-- //mobile menu button -->
						</div><!-- /.col-md-9 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.header-bottom -->
		</section><!-- /#header -->		
		@include('messages')
		<div class="mainContainer">
			@yield('content')
		</div>
		
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="widget-ft widget-about">
							<div class="logo logo-ft">
								<a href="{{URL::to('/shop')}}" title="">
									<img src="{{asset('images/logos/logo-ft.png')}}" alt="">
								</a>
							</div><!-- /.logo-ft -->
							<div class="widget-content">
								<div class="icon">
									<img src="{{asset('images/icons/call.png')}}" alt="">
								</div>
								<div class="info">
									<p class="questions">Got Questions ? Call us 24/7!</p>

									@foreach($contacts as $contact)
									<p class="phone">Call Us: {{$contact->phone1}}</p>
									<p class="address">
										{{$contact->address}}.
									</p>
									@endforeach
								</div>
							</div><!-- /.widget-content -->
							<ul class="social-list">
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
							</ul><!-- /.social-list -->
						</div><!-- /.widget-about -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="widget-ft widget-categories-ft">
							<div class="widget-title">
								<h3>Find By Categories</h3>
							</div>
							<ul class="cat-list-ft">
								<li>
									<a href="{{url('productsByInd')}}" title="Industrial">Industrial</a>
								</li>
								<li>
									<a href="{{url('technologies')}}" title="Technologies">Technologies</a>
								</li>
								<li>
									<a href="{{url('brands')}}" title="Brands">Brands</a>
								</li>
								<li>
									<a href="{{url('offer')}}" title="Offers">Offers </a>
								</li>
								<li>
									<a href="{{url('deal')}}" title="Deals">Deals</a>
								</li>
								<li>
									<a href="{{url('blog')}}" title="">Blog</a>
								</li>
								<li>
									<a href="{{url('faq')}}" title="">FAQ</a>
								</li>
							</ul><!-- /.cat-list-ft -->
						</div><!-- /.widget-categories-ft -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-2 col-md-6">
						<div class="widget-ft widget-menu">
							<div class="widget-title">
								<h3>Customer Care</h3>
							</div>
							<ul>
								<li>
									<a href="{{URL::to('/my-account')}}" title="My Accounts">
										My Accounts
									</a>
								</li>
								<li>
									<a href="{{URL::to('/wishlist')}}" title="My Wishlist">
										My Wishlist
									</a>
								</li>
								<li>
									<a href="{{URL::to('/cart')}}" title="My Cart">
										My Cart
									</a>
								</li>
								<li>
									<a href="{{URL::to('/term-condition')}}" title="Terms & privacy Policy">
										Terms & privecy Policy
									</a>
								</li>
								<li>
									<a href="{{URL::to('/about')}}" title="About Us">
										About Us
									</a>
								</li>
								<li>
									<a href="{{URL::to('/contact')}}" title="Contact Us">
										Contact Us
									</a>
								</li>
								<li>
									<a href="{{URL::to('/contact')}}" title="Support">
										Support
									</a>
								</li>
							</ul>
						</div><!-- /.widget-menu -->
					</div><!-- /.col-lg-2 col-md-6 -->
					<div class="col-lg-4 col-md-6">
						<div class="widget-ft widget-newsletter">
							<div class="widget-title">
								<h3>Sign Up To News Letter</h3>
							</div>
							<p>Make sure that you never miss our interesting <br />
								news by joining our newsletter program
							</p>
							<form action="{{URL::to('/subscribe')}}" class="subscribe-form" method="post" accept-charset="utf-8">
							{{csrf_field()}}
								<div class="subscribe-content">
									<input type="email" name="email" class="subscribe-email" placeholder="Your E-Mail" required>
									<button type="submit"><img src="{{asset('images/icons/right-2.png')}}" alt=""></button>
								</div>
							</form><!-- /.subscribe-form -->
							<ul class="pay-list">
								<li>
									<a href="#" title="">
										<img src="{{asset('images/logos/ft-01.png')}}" alt="">
									</a>
								</li>
								<li>
									<a href="#" title="">
										<img src="{{asset('images/logos/ft-02.png')}}" alt="">
									</a>
								</li>
								<li>
									<a href="#" title="">
										<img src="{{asset('images/logos/ft-03.png')}}" alt="">
									</a>
								</li>
								<li>
									<a href="#" title="">
										<img src="{{asset('images/logos/ft-04.png')}}" alt="">
									</a>
								</li>
								<li>
									<a href="#" title="">
										<img src="{{asset('images/logos/ft-05.png')}}" alt="">
									</a>
								</li>
							</ul><!-- /.pay-list -->
						</div><!-- /.widget-newsletter -->
					</div><!-- /.col-lg-4 col-md-6 -->
				</div><!-- /.row -->
				{{--<div class="row">
					<div class="col-md-12">
						<div class="widget widget-apps">
							<div class="widget-title">
								<h3>Mobile Apps</h3>
							</div>
							<ul class="app-list">
								<li class="app-store">
									<a href="#" title="">
										<div class="img">
											<img src="{{asset('images/icons/app-store.png')}}" alt="">
										</div>
										<div class="text">
											<h4>App Store</h4>
											<p>Coming Soon....</p>
										</div>
									</a>
								</li><!-- /.app-store -->
								<li class="google-play">
									<a href="#" title="">
										<div class="img">
											<img src="{{asset('images/icons/google-play.png')}}" alt="">
										</div>
										<div class="text">
											<h4>Google Play</h4>
											<p>Coming Soon....</p>
										</div>
									</a>	
								</li><!-- /.google-play -->
							</ul><!-- /.app-list -->
						</div><!-- /.widget-apps -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->--}}
			</div><!-- /.container -->
		</footer><!-- /footer -->

		<section class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="copyright">@foreach($siteinfos as $siteinfo) {{$siteinfo->copyright}} @endforeach <script>document.write(new Date().getFullYear());</script></p>
						<p class="btn-scroll">
							<a href="#" title="">
								<img src="{{asset('images/icons/top.png')}}" alt="">
							</a>
						</p>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.footer-bottom -->
		
	</div><!-- /.boxed -->

		<!-- Javascript -->
		<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/tether.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/waypoints.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.circlechart.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/easing.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.zoom.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/isotope.pkgd.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.flexslider-min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/owl.carousel.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/smoothscroll.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.mCustomScrollbar.js')}}"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script>
	   	<script type="text/javascript" src="{{asset('js/gmap3.min.js')}}"></script>
	   	<script type="text/javascript" src="{{asset('js/waves.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.countdown.js')}}"></script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126368920-2"></script>
		
		<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>

    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v3.2'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
         attribution=setup_tool
         page_id="319854214809357">
    </div>

	@yield('script')
  
</body>	
</html>