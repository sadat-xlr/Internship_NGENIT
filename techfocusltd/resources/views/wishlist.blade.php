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
								<a href="{{url('/my-account')}}" title="">My Account</a>
								<span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
							</li>
							<li class="trail-end">
								<a href="#" title="">Wishlist</a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<section class="flat-wishlist">
			<div class="container">
			@if(!$wishlists->isEmpty())
				<div class="row">
					<div class="col-md-12">
						<div class="wishlist">
							<div class="title">
								<h3>My wishlist</h3>
							</div>
							<div class="wishlist-content">
								<table class="table-wishlist">
									<thead>
										<tr>
											<th>Product Name</th>
											<th>Unit Price</th>
											<th>Stock Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									@foreach($wishlists as $wishlist)
										<tr>
											<td>
												<div class="delete">
													<a href="{{URL::to('/deleteWishlist/'.$wishlist->id)}}" onclick="return confirm('Are you sure want to delete this data?')" title=""><img src="{{asset('images/icons/delete.png')}}" alt=""></a>
												</div>
												<div class="product">
													<div class="image">
														<img src="{{asset('storage/images/product/'.$wishlist->product->image->image1)}}" alt="">
													</div>
													<div class="name">
														{{$wishlist->product->productName}}
													</div>
												</div>
											</td>
											<td>
												<div class="price">
													@if($wishlist->product->price)
													৳ {{number_format($wishlist->product->price)}}
													@else
														<a href="#" data-subject="Price quotation for {{$wishlist->product->productName}}" data-message="I would like to know the price of {{$wishlist->product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
													@endif
												</div>
											</td>
											<td>
												@if ($wishlist->product->availablity == 0)
												<div class="status-product">
													<span>In stock</span>
												</div>
												@else
												<div class="status-product">
													<span>Out of stock</span>
												</div>
												@endif
											</td>
											<td>
												<div class="add-cart">
													@if($wishlist->product->price)
													<a href="{{URL::to('/addCart/'.$wishlist->product_id)}}" title="">
														<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
													</a>
													@else
													<p style="color: red">N/A</p>
													@endif
												</div>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table><!-- /.table-wishlist -->
							</div><!-- /.wishlist-content -->
						</div><!-- /.wishlist -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				@else
					<div class="alert alert-danger">
					<h1 style="text-align:center">Your Wish list is empty! Add product to Wish list to purchase them later.</h1>
					</div>
					<div class="box-cart style2" style="text-align:center">
						<div class="btn-add-cart">
							<a href="{{URL::to('/home')}}" title="">
								<img src="{{asset('images/icons/add-cart.png')}}" alt="">Continue Shopping
							</a>
						</div>
					</div><!-- /.box-cart -->
				@endif
			</div><!-- /.container -->
		</section><!-- /.flat-wishlish -->

		<section class="flat-row flat-iconbox style2">
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
		</section><!-- /.flat-iconbox -->

@endsection