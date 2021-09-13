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
								<a href="#" title="">Account Details</a>
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
						<div class="cart-totals">
							<h3>Account Details</h3>
							<table>
								<tbody>
								@foreach($customers as $customer)
									<tr>
										<td>Name</td>
										<td class="subtotal">{{$customer->customerName}}</td>
									</tr>
									<tr>
										<td>Address</td>
										<td class="subtotal">{{$customer->address}}</td>
									</tr>
									<tr>
										<td>City</td>
										<td class="subtotal">{{$customer->city}}</td>
									</tr>
									<tr>
										<td>Country</td>
										<td class="subtotal">{{$customer->country}}</td>
									</tr>
									<tr>
										<td>Division</td>
										<td class="subtotal">{{$customer->division}}</td>
									</tr>
									<tr>
										<td>ZipCode</td>
										<td class="subtotal">{{$customer->zipCode}}</td>
									</tr>
									<tr>
										<td>Phone</td>
										<td class="subtotal">{{$customer->phone}}</td>
									</tr>
									<tr>
										<td>E-mail</td>
										<td class="subtotal">{{$customer->email}}</td>
									</tr>
									<tr>
										@if($customer->status == 0)
										<td class="subtotal">Active</td>
										@else
										<td class="subtotal"></td>
									@endif
									</tr>
								@endforeach
								</tbody>
							</table>
							<div class="box-cart style2" style="text-align:center">
								<div class="btn-add-cart">
									<a href="{{URL::to('/editDetails')}}" title="">
										Update Details
									</a>
								</div>
							</div><!-- /.box-cart -->
						</div><!-- /.cart-totals -->
					</div><!-- /.col-lg-9 col-md-8 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</main><!-- /#shop -->
@endsection