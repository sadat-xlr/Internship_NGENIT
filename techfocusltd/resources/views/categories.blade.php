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
								<a href="#" title="">Top Categories</a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<section class="flat-slider style2">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="slider owl-carousel style2">
							<div class="slider-item style3">
								<div class="item-text">
									<div class="header-item">
										<p>You can build the banner for other category</p>
										<h2 class="name"><span>SHOP BANNER</span></h2>
									</div>
								</div>
								<div class="item-image">
									<img src="{{asset('images/banner_boxes/07.png')}}" alt="">
								</div>
								<div class="clearfix"></div>
							</div><!-- /.slider-item style3 -->
							<div class="slider-item style3">
								<div class="item-text">
									<div class="header-item">
										<p>You can build the banner for other category</p>
										<h2 class="name"><span>SHOP BANNER</span></h2>
									</div>
								</div>
								<div class="item-image">
									<img src="{{asset('images/banner_boxes/07.png')}}" alt="">
								</div>
								<div class="clearfix"></div>
							</div><!-- /.slider-item style3 -->
						</div><!-- /.slider -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-slider style2 -->

		<section class="flat-row flat-imagebox">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="flat-row-title">
							<h3>Top Categories</h3>
						</div>
					</div><!-- /.cl-md-12 -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-6 col-lg-4">
						<div class="imagebox style1 v1">
							<div class="box-image">
								<a href="#" title="">
									<img src="{{asset('images/product/other/s07.jpg')}}" alt="">
								</a>
							</div><!-- /.box-image -->
							<div class="box-content">
								<div class="cat-name">
									<a href="#" title="">Cellphones</a>
								</div>
								<ul class="cat-list">
									<li><a href="#" title="">HTC</a></li>
									<li><a href="#" title="">Iphone</a></li>
									<li><a href="#" title="">LG</a></li>
									<li><a href="#" title="">Microsoft</a></li>
									<li><a href="#" title="">Oppo phone</a></li>
								</ul>
								<div class="btn-more">
									<a href="#" title="">See all</a>
								</div>
							</div><!-- /.box-content -->
						</div><!-- /.imagebox style1 -->
					</div><!-- /.col-md-6 col-lg-4 -->
					<div class="col-md-6 col-lg-4">
						<div class="imagebox style1 v1">
							<div class="box-image">
								<a href="#" title="">
									<img src="{{asset('images/product/other/15.jpg')}}" alt="">
								</a>
							</div><!-- /.box-image -->
							<div class="box-content">
								<div class="cat-name">
									<a href="#" title="">Televisions</a>
								</div>
								<ul class="cat-list">
									<li><a href="#" title="">4K Ultra HD TVs</a></li>
									<li><a href="#" title="">Curved TVs</a></li>
									<li><a href="#" title="">LED & LCD TVs</a></li>
									<li><a href="#" title="">OLED TVs</a></li>
									<li><a href="#" title="">Outdoor TVs</a></li>
								</ul>
								<div class="btn-more">
									<a href="#" title="">See all</a>
								</div>
							</div><!-- /.box-content -->
						</div><!-- /.imagebox style1 -->
					</div><!-- /.col-md-6 col-lg-4 -->
					<div class="col-md-6 col-lg-4">
						<div class="imagebox style1 v1">
							<div class="box-image">
								<a href="#" title="">
									<img src="{{asset('images/product/other/16.jpg')}}" alt="">
								</a>
							</div><!-- /.box-image -->
							<div class="box-content">
								<div class="cat-name">
									<a href="#" title="">Laptops</a>
								</div>
								<ul class="cat-list">
									<li><a href="#" title="">Computers & Tablets</a></li>
									<li><a href="#" title="">Curved TVs</a></li>
									<li><a href="#" title="">Hard Drives & Storage</a></li>
									<li><a href="#" title="">Inkjet Printers</a></li>
									<li><a href="#" title="">Laptop Accessories</a></li>
								</ul>
								<div class="btn-more">
									<a href="#" title="">See all</a>
								</div>
							</div><!-- /.box-content -->
						</div><!-- /.imagbox style1 -->
					</div><!-- /.col-md-6 col-lg-4 -->
					<div class="col-md-6 col-lg-4">
						<div class="imagebox style1 v1">
							<div class="box-image">
								<a href="#" title="">
									<img src="{{asset('images/product/other/s05.jpg')}}" alt="">
								</a>
							</div><!-- /.box-image -->
							<div class="box-content">
								<div class="cat-name">
									<a href="#" title="">Games & Drones</a>
								</div>
								<ul class="cat-list">
									<li><a href="#" title="">Audio</a></li>
									<li><a href="#" title="">Furniture & Decor</a></li>
									<li><a href="#" title="">OLED TVs</a></li>
									<li><a href="#" title="">LG</a></li>
									<li><a href="#" title="">Headphones</a></li>
								</ul>
								<div class="btn-more">
									<a href="#" title="">See all</a>
								</div>
							</div><!-- /.box-content -->
						</div><!-- /.imagbox style1 -->
					</div><!-- /.col-md-6 col-lg-4 -->
					<div class="col-md-6 col-lg-4">
						<div class="imagebox style1 v1">
							<div class="box-image">
								<a href="#" title="">
									<img src="{{asset('images/product/other/s08.jpg')}}" alt="">
								</a>
							</div><!-- /.box-image -->
							<div class="box-content">
								<div class="cat-name">
									<a href="#" title="">Headphones</a>
								</div>
								<ul class="cat-list">
									<li><a href="#" title="">4K Ultra HD TVs</a></li>
									<li><a href="#" title="">Curved TVs</a></li>
									<li><a href="#" title="">LED & LCD TVs</a></li>
									<li><a href="#" title="">OLED TVs</a></li>
									<li><a href="#" title="">Outdoor TVs</a></li>
								</ul>
								<div class="btn-more">
									<a href="#" title="">See all</a>
								</div>
							</div><!-- /.box-content -->
						</div><!-- /.imagebox style1 -->
					</div><!-- /.col-md-6 col-lg-4 -->
					<div class="col-md-6 col-lg-4">
						<div class="imagebox style1 v1">
							<div class="box-image">
								<a href="#" title="">
									<img src="{{asset('images/product/other/14.jpg')}}" alt="">
								</a>
							</div><!-- /.box-image -->
							<div class="box-content">
								<div class="cat-name">
									<a href="#" title="">Tablets</a>
								</div>
								<ul class="cat-list">
									<li><a href="#" title="">Car Speakers</a></li>
									<li><a href="#" title="">Car Subwoofers</a></li>
									<li><a href="#" title="">Enclosures</a></li>
									<li><a href="#" title="">Musical Instruments</a></li>
									<li><a href="#" title="">OLED TVs</a></li>
								</ul>
								<div class="btn-more">
									<a href="#" title="">See all</a>
								</div>
							</div><!-- /.box-content -->
						</div><!-- /.imagebox style1 -->
					</div><!-- /.col-md-6 col-lg-4 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-imagebox style1 -->

		<section class="flat-row flat-highlights style1">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="flat-row-title">
							<h3>Bestsellers</h3>
						</div><!-- /.flat-row-title -->
						<ul class="product-list style1">
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="{{asset('images/product/highlights/10.jpg')}}" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Razer RZ02-01071500-R3M1</a>
									</div>
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									<div class="price">
										<span class="sale">$50.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.info-product -->
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="{{asset('images/product/highlights/9.jpg')}}" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Apple iPad Mini G2356</a>
									</div>
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									<div class="price">
										<span class="sale">$24.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.info-product -->
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="{{asset('images/product/highlights/8.jpg')}}" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Beats Snarkitecture Headphones</a>
									</div>
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									<div class="price">
										<span class="sale">$90.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div><!-- /.info-product -->
								<div class="clearfix"></div>
							</li>
						</ul><!-- /.product-list style1 -->
					</div><!-- /.col-md-4 -->
					<div class="col-md-4">
						<div class="flat-row-title">
							<h3>Featured</h3>
						</div><!-- /.flat-row-title -->
						<ul class="product-list style1">
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="{{asset('images/product/highlights/3.jpg')}}" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Razer RZ02-01071500-R3M1</a>
									</div>
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									<div class="price">
										<span class="sale">$50.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div>
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="{{asset('images/product/highlights/2.jpg')}}" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Apple iPad Mini G2356</a>
									</div>
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									<div class="price">
										<span class="sale">$24.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div>
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="{{asset('images/product/highlights/1.jpg')}}" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Beats Snarkitecture Headphones</a>
									</div>
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									<div class="price">
										<span class="sale">$90.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div>
								<div class="clearfix"></div>
							</li>
						</ul><!-- /.product-list style1 -->
					</div><!-- /.col-md-4 -->
					<div class="col-md-4">
						<div class="flat-row-title">
							<h3>Hot Sale</h3>
						</div><!-- /.flat-row-title -->
						<ul class="product-list style1">
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="{{asset('images/product/highlights/19.jpg')}}" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Razer RZ02-01071500-R3M1</a>
									</div>
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									<div class="price">
										<span class="sale">$50.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div>
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="{{asset('images/product/highlights/11.jpg')}}" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Apple iPad Mini G2356</a>
									</div>
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									<div class="price">
										<span class="sale">$24.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div>
								<div class="clearfix"></div>
							</li>
							<li>
								<div class="img-product">
									<a href="#" title="">
										<img src="{{asset('images/product/highlights/20.jpg')}}" alt="">
									</a>
								</div>
								<div class="info-product">
									<div class="name">
										<a href="#" title="">Beats Snarkitecture Headphones</a>
									</div>
									<div class="queue">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									<div class="price">
										<span class="sale">$90.00</span>
										<span class="regular">$2,999.00</span>
									</div>
								</div>
								<div class="clearfix"></div>
							</li>
						</ul><!-- /.product-list style1 -->
					</div><!-- /.col-md-4 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-highlights -->

@endsection