@extends('masterLayout')

@section('content')
		
		<section class="flat-breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumbs">
							<li class="trail-item">
								<a href="{{url('/')}}" title="">Home</a>
								<span><img src="{{('images/icons/arrow-right.png')}}" alt=""></span>
							</li>
							<li class="trail-end">
								<a href="#" title="">Store Location</a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<section class="flat-location">
			<div class="location">
				<div class="title">
					<h3>Store Locator</h3>
				</div>
				<div class="location-content">
					<div class="select-location">
						<div class="select">
							<select name="location">
								<option value="">All</option>
							</select>
						</div>	
						<a href="#" title="">
							<img src="{{('images/icons/address-2.png')}}" alt="">Share Location
						</a>
					</div>
					<ul class="location-list scroll">
						<li>Argentina</li>
						<li>Australia</li>
						<li>Belgium</li>
						<li>Brazil</li>
						<li>Canada</li>
						<li>Denmark</li>
						<li>France</li>
						<li>Germany</li>
						<li>India</li>
						<li>Russia</li>
						<li>Turkey</li>
						<li>United Kingdom</li>
						<li>United States</li>
						<li>Viet Nam</li>
						<li>Venezuela</li>
						<li>Japan</li>
						<li>Korea</li>
						<li>China</li>
					</ul>
				</div><!-- /.location-content -->
			</div><!-- /.location -->
			<div class="location-detail">
				<span>x</span>
				<div class="title">
					<h3>United States</h3>
				</div>
				<div class="image-location">
					<img src="{{('images/about/location-1.jpg')}}" alt="">
				</div>
				<ul>
					<li>
						<h3>Address</h3>
						<p>PO Box CT16122 Collins Street West, Victoria 8007, Australia.</p>
					</li>
					<li>
						<h3>Phone</h3>
						<p>(888) 123 456 789</p>
						<p>(888) 589 658 23</p>
					</li>
					<li>
						<h3>Email</h3>
						<p><a href="#" title="">info@technostore.com</a></p>
					</li>
					<li>
						<h3>Opening Hours</h3>
						<p>Monday to Friday: 10am to 6pm</p>
						<p>Saturday: 10am to 4pm</p>
						<p>Sunday: 12am t0 4pm</p>
					</li>
				</ul>
			</div><!-- /.location-detail -->
			<div id="flat-map-2" class="pdmap">
	           	<div class="flat-maps" data-address="17872 US-90, Greenville, FL 32331" data-height="638" data-images="images/icons/map.png" data-name="Themesflat Map"></div>
	            <div class="gm-map">                
	                <div class="map-2"></div>                        
	            </div>
			</div><!-- /#flat-map-2 -->
			<div class="clearfix"></div>
		</section><!-- /.flat-location -->

		<section class="flat-iconbox">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="{{('images/icons/car.png')}}" alt="">
								</div>
								<div class="box-title">
									<h3>Worldwide Shipping</h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p>Free Shipping On Order Over $100</p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="{{('images/icons/order.png')}}" alt="">
								</div>
								<div class="box-title">
									<h3>Order Online Service</h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p>Free return products in 30 days</p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="{{('images/icons/payment.png')}}" alt="">
								</div>
								<div class="box-title">
									<h3>Payment</h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p>Secure System</p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="{{('images/icons/return.png')}}" alt="">
								</div>
								<div class="box-title">
									<h3>Return 30 Days</h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p>Free return products in 30 days</p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-iconbox -->

@endsection