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
								<a href="#" title="">Orders</a>
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
						<div class="user">
							<h2>My Orders</h2>
						</div>
						@if(!$orders->isEmpty())
						<div class="table-cart">
							<table>
								<thead>
									<tr>
										<th>Product</th>
										<th>Quantity</th>
										<th>Total</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php $totalPrice = 0; ?>
								@foreach($orders as $order)
									@foreach($order->orderDetails as $orderDetail)
									<tr>
										<td>
											<div class="img-product">
												<img src="{{asset('storage/images/product/'.$orderDetail->product->image->image1)}}" alt="">
											</div>
											<div class="name-product">
												{{$orderDetail->product->productName}}
											</div>
											<div class="price">
												৳{{$orderDetail->product->price}}
											</div>
											<div class="clearfix"></div>
										</td>
										<td>
											<div class="quanlity">
												{{$orderDetail->quantity}}
											</div>
										</td>
										<td>
											<div class="total">
												৳<?php 
													echo $unitPrice = $orderDetail->quantity * $orderDetail->product->price;
													$totalPrice += $unitPrice;
												?>
											</div>
										</td>
										<td>
											<a href="{{URL::to('/deleteOrder/'.$orderDetail->id)}}" onclick="return confirm('Are you sure want to cancel this order?')" title="">
												<img src="{{asset('images/icons/delete.png')}}" alt="">
											</a>
										</td>
									</tr>
									@endforeach
								@endforeach
								</tbody>
							</table>
						</div><!-- /.table-cart -->
						<div class="cart-totals">
							<h3>Order Totals</h3>
							<table>
								<tbody>
									<tr>
										<td>Subtotal</td>
										<td class="subtotal">৳{{$totalPrice}}</td>
									</tr>
									<tr>
										<td>Shipping</td>
										<td class="btn-radio">
											<div class="radio-info">
												<input type="radio" id="flat-rate" checked name="radio-flat-rate">
												<label for="flat-rate">Flat Rate: <span>৳3.00</span></label>
											</div>
											<div class="radio-info">
												<input type="radio" id="free-shipping" name="radio-flat-rate">
												<label for="free-shipping">Free Shipping</label>
											</div>
											<div class="btn-shipping">
												<a href="#" title="">Calculate Shipping</a>
											</div>
										</td><!-- /.btn-radio -->
									</tr>
									<tr>
										<td>Grand Total</td>
										<td class="price-total">৳{{$totalPrice}}</td>
									</tr>
								</tbody>
							</table>
							<div class="box-cart style2" style="text-align:center">
								<div class="btn-add-cart">
									<a href="{{URL::to('/home')}}" title="">
										<img src="{{asset('images/icons/add-cart.png')}}" alt="">Continue Shopping
									</a>
								</div>
							</div><!-- /.box-cart -->
						</div><!-- /.cart-totals -->
						@else
							<div class="alert alert-danger">
								<h1 style="text-align:center">You have no order!</h1>
							</div>
							<div class="box-cart style2" style="text-align:center">
								<div class="btn-add-cart">
									<a href="{{URL::to('/home')}}" title="">
										<img src="{{asset('images/icons/add-cart.png')}}" alt="">Continue Shopping
									</a>
								</div>
							</div><!-- /.box-cart -->
						@endif
					</div><!-- /.col-lg-9 col-md-8 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</main><!-- /#shop -->

@endsection