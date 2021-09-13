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
								<a href="#" title="">Cart</a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->
		
		<section class="flat-shop-cart">
			<div class="container">
				@if(!$carts->isEmpty())
				<div class="row">
					<div class="col-lg-8">
						<div class="flat-row-title style1">
							<h3>Shopping Cart</h3>
						</div>
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
								<?php $price = 0; ?>
								@foreach($carts as $cart)
									@php
										$product = \App\Product::find($cart['product_id']);
                                        $salePrice = 0;
                                        foreach($product->deals as $deals){
                                            if ($deals){
                                                if ($deals->valid_until >= \Carbon\Carbon::now()){
                                                    $salePrice = $product->price-(($product->price*$deals->discount_value)/100);
                                                }
                                            }
                                        }

                                        foreach($product->offers as $offers){
                                            if ($offers){
                                                if ($offers->valid_until >= \Carbon\Carbon::now()){
                                                    $salePrice = $product->price-(($product->price*$offers->discount_value)/100);
                                                }
                                            }
                                        }
									@endphp
									<tr>
										<td>
											<div class="img-product">
												<img src="{{asset('storage/images/product/'.$cart->product->image->image1)}}" alt="">
											</div>
											<div class="name-product">
												<?php echo substr($cart->product->productName,0,17); ?><br/>
												<?php echo substr($cart->product->productName,17); ?>
											</div>
											<div class="price">
												৳ {{number_format($cart->product->price)}}
											</div>
											<div class="clearfix"></div>
										</td>
										<td>
											<form action="{{url('/updateCart/'.$cart->id)}}" method="post" accept-charset="utf-8">
											{{csrf_field()}}
												<div class="quanlity">
													<input type="number" name="quantity" value="{{$cart->quantity}}" min="1" max="100" placeholder="Quantity">
												</div>
												<div class="quanlity">
													<button type="submit">Update</button>
												</div>
											</form>
										</td>
										<td>
											<div class="total">
												৳<?php
													if(isset($salePrice) && $salePrice != 0)
														$proPrice = $salePrice;
													else
														$proPrice = $cart->product->price;

													$unitPrice = $cart->quantity * $proPrice;
													echo $unitPrice;
													$price += $unitPrice;
												?>
											</div>
										</td>
										<td>
											<a href="{{URL::to('/deleteCart/'.$cart->id)}}" onclick="return confirm('Are you sure want to delete this data?')" title="">
												<img src="{{asset('images/icons/delete.png')}}" alt="">
											</a>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
							<div class="form-coupon">
								<form action="{{url('applyCoupon')}}" id="applyCoupon" method="post" accept-charset="utf-8">
									<div class="coupon-input">
										<input type="text" name="coupon_code" placeholder="Coupon Code" required>
										<input type="hidden" name="price" value="{{$price+($price*0.15)+15}}">
										<button type="submit">Apply Coupon</button>
									</div>
								</form>
							</div><!-- /.form-coupon -->
						</div><!-- /.table-cart -->
					</div><!-- /.col-lg-8 -->
					<div class="col-lg-4">
						<div class="cart-totals">
							<h3>Cart Totals</h3>
							<form action="" method="post" accept-charset="utf-8">
								<table>
									<tbody>
										<tr>
											<td>Subtotal</td>
											<td class="subtotal">৳ {{number_format($price)}}</td>
										</tr>
										<tr>
											<td>Shipping</td>
											<td class="btn-radio">
												<div class="radio-info">
													<input type="radio" id="flat-rate" checked name="radio-flat-rate">
													<label for="flat-rate">Flat Rate: <span>৳ 15.00</span></label>
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
										@if(Session::has('coupon_id'))
											@php
												$discount = \App\Discount::find(Session::get('coupon_id'));
                                            if($discount->discount_unit == 0){
                                            	$discount_val = ($price*$discount->discount_value)/100;
                                                $price = $price - $discount_val;
                                            }
                                            else{
                                                $discount_val = $discount->discount_value;
                                                $price = $price - $discount_val;
                                            }
											@endphp
											<tr>
												<td>Discount</td>
												<td class="subtotal">৳ {{number_format($discount_val)}}</td>
											</tr>
										@endif
										<tr>
											<td>Grand Total</td>
											<td class="price-total">৳ {{number_format($price+($price*0.15)+15)}}</td>
										</tr>
									</tbody>
								</table>
								<div class="btn-cart-totals">
									<a href="{{URL::to('/shop')}}" class="update" title="">Continue Shopping</a>
									<a href="{{URL::to('/checkout')}}" class="checkout" title="">Proceed to Checkout</a>
								</div><!-- /.btn-cart-totals -->
							</form><!-- /form -->
						</div><!-- /.cart-totals -->
					</div><!-- /.col-lg-4 -->
				</div><!-- /.row -->
				@else
					<div class="alert alert-danger">
						<h1 style="text-align:center">Your Cart is empty!</h1>
					</div>
					<div class="box-cart style2" style="text-align:center">
						<div class="btn-add-cart">
							<a href="{{URL::to('/shop')}}" title="">
								<img src="{{asset('images/icons/add-cart.png')}}" alt="">Continue Shopping
							</a>
						</div>
					</div><!-- /.box-cart -->
				@endif
			</div><!-- /.container -->
		</section><!-- /.flat-shop-cart -->
		

		<section class="flat-row flat-iconbox style3">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6">
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
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
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
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
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
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
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
					</div><!-- /.col-lg-3 col-md-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-iconbox -->

@endsection