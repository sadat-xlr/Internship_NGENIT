@extends('masterLayout')

@section('content')

		<style>
			.user{border:1px solid white; background-color:#f9f9f9; padding:20px; margin-bottom:20px}
		</style>
		<section class="flat-breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumbs">
							<li class="trail-item">
								<a href="#" title="">Home</a>
								<span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="#" title="">My Account</a>
								<span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
							</li>
							<li class="trail-end">
								<a href="#" title="">Edit Details</a>
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
									<h3>My Account<span></span></h3>
								</div>
								<ul class="cat-list style1 widget-content">
									<li><a href="{{URL::to('/my-account')}}" title="">Dashboard</a></li>
									<li><a href="{{URL::to('/my-order')}}" title="">Order</a></li>
									<li><a href="{{URL::to('/my-details')}}" title="">Account Details</a></li>
									<li><a href="{{URL::to('/my-wishlist')}}" title="">Wishlist</a></li>
									<li><a href="{{URL::to('/cmrLogout')}}" title="">Logout</a></li>
								</ul><!-- /.cat-list -->
							</div><!-- /.widget-categories -->
						</div><!-- /.sidebar -->
					</div><!-- /.col-lg-3 col-md-4 -->
					<div class="col-lg-9 col-md-8">
						<div class="box-checkout">
							<form action="{{url('/updateDetails')}}" method="post" class="checkout" accept-charset="utf-8">
							{{csrf_field()}}
								<div class="billing-fields">
									<div class="fields-title">
										<h3>Account details</h3>
										<span></span>
										<div class="clearfix"></div>
									</div><!-- /.fields-title -->
									@foreach($customers as $customer)
									<div class="fields-content">
										<div class="field-row">
											<p class="field-one-half">
												<label for="first-name">Name *</label>
												<input type="text" id="first-name" name="name" value="{{$customer->customerName}}">
											</p>
											<p class="field-one-half">
												<label for="phone">Phone *</label>
												<input type="number" id="phone" name="phone" value="{{$customer->phone}}">
											</p>
										</div>
										<div class="field-row">
											<p class="field-one-half">
												<label for="company-name">Town / City *</label>
												<input type="text" id="town-city" name="towncity" value="{{$customer->city}}">
											</p>
											<p class="field-one-half">
												<label for="phone">State / Division *</label>
												<input type="text" id="state-country" name="statecountry" value="{{$customer->division}}">
											</p>
											<div class="clearfix"></div>
										</div>
										<div class="field-row">
											<label>Country *</label>
											<select name="country">
												<option value="{{$customer->country}}">{{$customer->country}}</option>
											</select>
										</div>
										<div class="field-row">
											<label for="address">Address *</label>
											<input type="text" id="address" name="address" value="{{$customer->address}}">
										</div>
										<div class="field-row">
											<p class="field-one-half">
												<label for="post-code">Postcode / ZIP *</label>
												<input type="text" id="post-code" name="postcode" value="{{$customer->zipCode}}">
											</p>
											<div class="clearfix"></div>
										</div>										
									</div><!-- /.fields-content -->
									@endforeach
								</div><!-- /.billing-fields -->
								<button type="submit">Save changes</button>
							</form><!-- /.checkout -->
						</div><!-- /.box-checkout -->
					</div><!-- /.col-lg-9 col-md-8 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</main><!-- /#shop -->
@endsection