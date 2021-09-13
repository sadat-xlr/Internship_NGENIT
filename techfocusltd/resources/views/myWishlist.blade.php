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
								<a href="#" title="">My Wishlist</a>
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
					@if(!$wishlists->isEmpty())
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
													৳{{$wishlist->product->price}}
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
													<a href="{{URL::to('/addCart/'.$wishlist->product_id)}}" title="">
														<img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
													</a>
												</div>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table><!-- /.table-wishlist -->
							</div><!-- /.wishlist-content -->
						</div><!-- /.wishlist -->
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
					</div><!-- /.col-lg-9 col-md-8 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</main><!-- /#shop -->

@endsection