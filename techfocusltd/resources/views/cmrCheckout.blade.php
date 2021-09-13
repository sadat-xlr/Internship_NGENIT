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
								<a href="{{url('/')}}" title="">Home</a>
								<span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
							</li>
							<li class="trail-end">
								<a href="#" title="">Checkout</a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->
		
		<main id="shop">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
					
						<section class="flat-checkout">
							<div class="container">
								<div class="row">
									<div class="col-md-7">
										<div class="box-checkout">
											<h3 class="title">Checkout</h3>
											<form action="{{url('/cmrOrder')}}" method="post" class="checkout" accept-charset="utf-8">
											{{csrf_field()}}
												<div class="shipping-address-fields">
													<div class="fields-title">
														<h3>Shipping Address</h3>
														<span></span>
														<div class="clearfix"></div>
													</div><!-- /.fields-title -->
													<div class="checkbox">
														<input type="checkbox" id="create-account-2" name="shipping">
														<label for="create-account-2">Ship to a different address ?</label>
													</div>
													<div class="fields-content">
														<div class="field-row">
															<label>Country *</label>
															<select name="country2">
																<option value="Bangladesh">Bangladesh</option>
															</select>
														</div>
														<div class="field-row">
															<label for="address-3">Address *</label>
															<input type="text" id="address-3" name="address3" placeholder="Street address">
															<input type="text" id="address-4" name="address4" placeholder="Apartment, suite, unit etc. (optional)">
														</div>
														<div class="field-row">
															<label for="town-city-2">Town / City *</label>
															<select name="towncity2">
																<option value="Dhaka">Dhaka</option>
															</select>
														</div>
														<div class="field-row">
															<p class="field-one-half">
																<label for="state-country-2">State / Division *</label>
																<select name="statecountry2">
																	<option value="Dhaka">Dhaka</option>
																</select>
															</p>
															<p class="field-one-half">
																<label for="post-code-2">Postcode / ZIP *</label>
																<input type="text" id="post-code-2" name="postcode2" placeholder="Postcode / ZIP">
															</p>
															<div class="clearfix"></div>
														</div>
														<div class="field-row">
															<label for="notes">Order Notes</label>
															<textarea id="notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
														</div>
													</div><!-- /.fields-content -->
												</div><!-- /.shipping-address-fields -->
											<!--</form> /.checkout -->
										</div><!-- /.box-checkout -->
									</div><!-- /.col-md-7 -->
									<div class="col-md-5">
										<div class="cart-totals style2">
											<h3>Your Order</h3>
											<!--<form action="#" method="get" accept-charset="utf-8">-->
												<table class="product">
													<thead>
														<tr>
															<th>Product</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
														<?php $price = 0; ?>
														@foreach ($carts as $cart)
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
															<td><?php echo substr($cart->product->productName, 0, 15);?><br /><?php echo substr($cart->product->productName, 15);?></td>
															<td>
																৳
																<?php
																	if(isset($salePrice) && $salePrice != 0)
																		$proPrice = $salePrice;
																	else
																		$proPrice = $cart->product->price;

																	$unitPrice = $cart->quantity * $proPrice;
																	echo $unitPrice;
																	$price += $unitPrice;
																?>
															</td>
														</tr>
														@endforeach
													</tbody>
												</table><!-- /.product -->
												<table>
													<tbody>
														<tr>
															<td>Sub Total</td>
															<td class="subtotal">৳ {{number_format($price)}}</td>
														</tr>
														<tr>
															<td>Shipping</td>
															<td class="btn-radio">
																<div class="radio-info">
																	<input type="radio" checked id="flat-rate" name="radio-flat-rate">
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
												<div id="payment" class="woocommerce-checkout-payment">
													<ul class="wc_payment_methods payment_methods methods">
														<li class="wc_payment_method payment_method_softtech_bkash">
															<input id="payment_method_softtech_bkash" type="radio" class="input-radio" name="paymentMethod" value="0" checked="checked" data-order_button_text="">

															<label for="payment_method_softtech_bkash">
																bKash <img src="http://gamersbd.com/wp-content/plugins/bkash/images/bkash.png" alt="bKash">	</label>
															<div class="payment_box payment_method_softtech_bkash" style="display: block">
																<p>Please complete your bKash payment at first, then fill up the form below. Also note that 2% bKash "SEND MONEY" cost will be added with net price. Total amount you need to send us at ৳&nbsp;</p>
																<p>
																<p>bKash Agent Number : 01971424221</p>
																<label for="bkash_number">bKash Number</label>
																<input type="number" min="11" name="bkash_number" id="bkash_number" placeholder="017XXXXXXXX">
																</p>
																<p>
																	<label for="bkash_transaction_id">bKash Transaction ID</label>
																	<input type="text" name="bkash_transaction_id" id="bkash_transaction_id" placeholder="8N7A6D5EE7M">
																</p>
															</div>
														</li>
														<li class="wc_payment_method payment_method_sobkichu_rocket">
															<input id="payment_method_sobkichu_rocket" type="radio" class="input-radio" name="paymentMethod" value="1" data-order_button_text="">

															<label for="payment_method_sobkichu_rocket">
																Rocket <img src="http://gamersbd.com/wp-content/plugins/woo-rocket/images/rocket.png" alt="Rocket">	</label>
															<div class="payment_box payment_method_sobkichu_rocket">
																<p>Please at first complete your rocket payment, then try to fill up the form below. Also note that 2% rocket "SEND MONEY" cost will be added with net price. Total amount you need to send us at ৳&nbsp;</p>
																<p>Rocket Personal Number : 01971424221</p>
																<p>
																	<label for="rocket_number">Rocket Number</label>
																	<input type="number" min="11" name="rocket_number" id="Rocket_number" placeholder="017XXXXXXXX">
																</p>
																<p>
																	<label for="rocket_transaction_id">Transaction ID</label>
																	<input type="text" name="rocket_transaction_id" id="rocket_transaction_id" placeholder="A7D8H65FGH90">
																</p>
															</div>
														</li>
														<li class="wc_payment_method payment_method_bacs">
															<input id="payment_method_bacs" type="radio" class="input-radio" name="paymentMethod" value="2" data-order_button_text="">

															<label for="payment_method_bacs">
																Direct bank transfer 	</label>
															<div class="payment_box payment_method_bacs">
																<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
																<p>Or you also can send the scan copy of the deposited check along with order ID at sales@techfocus.com</p>
																<p>
																	<label for="bacs_acc_name">Account Name</label>
																	<input type="text" name="bacs_acc_name" id="bacs_acc_name" placeholder="Account Name">
																</p>
																<p>
																	<label for="bacs_acc_no">Account Number</label>
																	<input type="text" name="bacs_acc_no" id="bacs_acc_no" placeholder="Account Number">
																</p>
																<p>
																	<label for="bacs_bank_name">Bank Name</label>
																	<input type="text" name="bacs_bank_name" id="bacs_bank_name" placeholder="Bank Name">
																</p>
																<p>
																	<label for="bacs_bank_deposit">Deposit (Scanned copy)</label>
																	<input type="file" name="bacs_bank_deposit" id="bacs_bank_deposit">
																</p>
															</div>
														</li>
														<li class="wc_payment_method payment_method_cps">
															<input id="payment_method_cps" type="radio" class="input-radio" name="paymentMethod" value="3" data-order_button_text="">

															<label for="payment_method_cps">
																Cheque Payment 	</label>
															<div class="payment_box payment_method_cps">
																<p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
																<label for="cps_bank_deposit">Cheque (Scanned copy)</label>
																<input type="file" name="cps_bank_deposit" id="cps_bank_deposit">
															</div>
														</li>
														<li class="wc_payment_method payment_method_cod">
															<input id="payment_method_cod" type="radio" class="input-radio" name="paymentMethod" value="4" data-order_button_text="">

															<label for="payment_method_cod">
																Cash on delivery 	</label>
															<div class="payment_box payment_method_cod">
																<p>Pay cash on product delivery.</p>
															</div>
														</li>
													</ul>
												</div>
												<style>
													.payment_box{display: none}
												</style>
												<div class="checkbox">
													<input type="checkbox" id="checked-order" name="checkedorder" checked>
													<label for="checked-order">I’ve read and accept the <a href="{{URL::to('/term-condition')}}">terms & conditions</a> *</label>
												</div><!-- /.checkbox -->
												<div class="btn-order">
													<input type="submit">
												</div><!-- /.btn-order -->
											</form>
										</div><!-- /.cart-totals style2 -->
									</div><!-- /.col-md-5 -->
									<div id="message"></div>
								</div><!-- /.row -->
							</div><!-- /.container -->
						</section><!-- /.flat-checkout -->
					</div><!-- /.col-lg-9 col-md-8 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</main><!-- /#shop -->

@endsection

@section('script')
	<script>
		// Payment checkbox show
		$(function() {
			$('input[name=paymentMethod]').change(function () {
				$('.payment_box').hide();
				$('.'+$(this).attr('id')).show();
			});
		});
	</script>
@endsection