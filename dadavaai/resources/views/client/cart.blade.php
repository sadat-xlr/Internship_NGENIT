@extends('layouts.client')

@section('title')
    <title>Cart | Dadavaai </title>
@endsection

@php
$price = 0;
$shipping = 100;
$vatTax = 7.5;
$currentTime = \Carbon\Carbon::now()->format('d-m-Y');

@endphp

@section('content')
    <!-- CONTENT + SIDEBAR -->
    <div class="main-wrapper clearfix">
        <div class="site-pagetitle jumbotron" style="margin-bottom: 10px;">
            <div class="container text-center">
                <!-- Breadcrumbs -->
                <div class="breadcrumbs">
                    <div class="breadcrumbs text-left">
                        <i class="fa fa-home"></i>
                        <span><a href="{{url('/')}}">Home</a></span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span class="current">Cart</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container theme-container">
            <main id="main-content" class="main-container"  itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
                <article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                    <header class="entry-header diblock spc-15">
                        <!-- Post Title -->
                        <h2 class="fsz-18 title-3 pull-left" itemprop="headline">Your Cart</h2>
                        <h2 class="fsz-15 title-3 drk-gry pull-right">
                            <a href="{{url('/')}}" class="red-clr">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                Add More 
                            </a> 
                        </h2>
                    </header>

                    <!-- Main Content of the Post -->
                    <div class="cart-wrap">
                        <div class="woocommerce">
                            <div>
                                @if ($carts)
                                    <form action="#" method="post">
                                        <table class="shop_table cart">
                                            <thead>
                                                <tr>
                                                    <th class="product-sl blk-clr fsz-15" style="background: #cecece;"> Sl.</th>
                                                    <th class="product-thumbnail blk-clr fsz-15" style="background: #cecece;">&nbsp;</th>
                                                    <th class="product-name blk-clr fsz-15" style="background: #cecece;">Product</th>
                                                    <th class="product-price blk-clr fsz-15" style="background: #cecece;">Price</th>
                                                    <th class="product-quantity blk-clr fsz-15" style="background: #cecece; font-size: 15px !important;">Quantity</th>
                                                    {{-- <th class="product-action">Action</th> --}}
                                                    <th class="product-subtotal blk-clr fsz-15" style="background: #cecece;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($carts as $key => $cart)
                                                    @php
                                                        $product = \App\Product::find($cart['product_id']);
                                                        $salePrice = $product->regularPrice;
                                                        $proPrice   = 0;
    
                                                        if ($product->discount){
                                                            if ($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                $proPrice = $salePrice-(($salePrice*($product->deal->discount_value + $product->discount))/100);
                                                            
                                                            else
                                                                $proPrice = $salePrice-(($salePrice*$product->discount)/100);
                                                        }
                                                        else{
                                                            if ($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                $proPrice = $salePrice-(($salePrice*$product->deal->discount_value)/100);
                                                            else
                                                                $proPrice = $product->regularPrice;
                                                        }

                                                        if ($product->bundleOffers) {
                                                            foreach ($product->bundleOffers as  $bundleOffer) {
                                                                if ($cart['qty'] >= $bundleOffer->qty_start) {
                                                                    $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                                                                }
                                                            }
                                                        }
                                                                
                                                            
    
                                                        $unitPrice = $cart['qty'] * $proPrice;
                                                        $price += $unitPrice;
                                                    @endphp
                                                    <tr class="cart_item">
                                                        <td class="product-sl blk-clr">
                                                            {{$key+1}}
                                                        </td>
                                                        <td class="product-thumbnail">
                                                            <a href="#">
                                                                <img  src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="{{$product->productName}}" />
                                                            </a>
                                                        </td>
                                                        <td class="product-name">
                                                            <div class="">
                                                                <a class="" href="{{url('product/'.$product->id.'/'.$product->slug)}}" style="font-style:unset;">
                                                                    <b class="blk-clr fsz-12"> {{$product->productName}} </b>
                                                                </a>
                                                            </div>
    
                                                            {{-- <p class="fsz-5 ">{{$product->category->categoryName}}</p> --}}
                                                        </td>
    
                                                        <td class="product-price">                                                    
                                                            <p class="fsz-12 no-mrgn"> 
                                                                <b class="amount blk-clr">Tk {{number_format($proPrice,2)}}</b> 
                                                            </p>
                                                            {{-- <p class="fsz-14 no-mrgn"> <b class="gray-clr">Special Offers: </b> <b class="blk-clr">Discount 50%</b> </p> --}}
                                                        </td>
    
                                                        <td class="product-quantity">
                                                            <div id="quantity" class="quantity input-group fsz-12">
                                                                <input type="number" name="qty{{$product->id}}" data-url="update-cart" data-id="{{$product->id}}" value="{{$cart['qty']}}" title="Qty" class="form-control input-text qty input-qty input-number"  min="1" max="100" size="4" style="width:50%;margin-left:28%;" />
                                                            </div>
                                                        </td>
                                                        {{-- <td id="quantityChange">
                                                            <a href="#"  data-text="Update Quantity" data-id="{{$product->id}}">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>                                                    
                                                        </td> --}}
    
                                                        <td class="product-subtotal">
                                                            <p class="fsz-12 no-mrgn"> 
                                                                <b class="amount blk-clr">
                                                                    Tk <span id="product_t_price_{{$product->id}}"> {{number_format($unitPrice,2)}}</span> 
                                                                </b> 
                                                            </p>
                                                            <a href="#" class="remove" id="delete-cart" data-id="{{$product->id}}" data-url="{{url('delete-cart')}}" title="Remove this item"> <i class="fa-times fa"></i> </a>
                                                        </td>
                                                    </tr>
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </form>                                
                                @else
                                    <p class="text-center alert alert-danger">Your cart is empty!</p>
                                @endif

                            </div>
                            {{-- coupon --}}
                            {{-- <div class="mt-20" style="padding:10px; border:#eff2f2 1px solid">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6" style="border-right:black 1px solid">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form class="">
                                                    <div class="form-group">
                                                        <label for="coupon_code" class="control-label col-md-3">Coupon Code</label>
                                                        <div class="col-md-6">
                                                            <input type="text" name="coupon_code" placeholder="ENTER CODE" class="form-control">
                                                        </div>
    
                                                    </div>
                                                    <div class="form-group"> 
                                                        <div class="col-md-3 cart-extra-info" style="padding:unset; margin:unset;">
                                                            <input type="submit" class="button" value="Apply">
                                                        </div>                                                 
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form class="">
                                                    <div class="form-group">
                                                        <label for="wallet_code" class="control-label col-md-3">Wallet Code</label>
                                                        <div class="col-md-6">
                                                            <input type="text" name="wallet_code" placeholder="ENTER CODE" class="form-control">
                                                        </div>
    
                                                    </div>
                                                    <div class="form-group"> 
                                                        <div class="col-md-3 cart-extra-info" style="padding:unset; margin:unset;">
                                                            <input type="submit" class="button" value="Apply">
                                                        </div>                                                 
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- wallet --}}
                            {{-- <div class="mt-20" style="padding:10px; border:#eff2f2 1px solid">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <form class="woocommerce-shipping-calculator" action="#" >
                                            <section class="shipping-calculator-form">
                                                <div class="form-group">
                                                    <label for="coupon_code" class="control-label col-md-2">Calculate Shipping</label>
                                                </div>
                                                <div class="form-group selectpicker-wrapper">
                                                    <div class="col-md-4">
                                                        <select
                                                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                            data-toggle="tooltip" title="Country">
                                                            <option>Åland Islands</option>
                                                            <option>Afghanistan</option>
                                                            <option>Albania</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group selectpicker-wrapper">
                                                    <div class="col-md-4">
                                                        <select
                                                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                            data-toggle="tooltip" title="State / Province">
                                                            <option>Tirana</option>
                                                            <option>Durres</option>
                                                            <option>Vlore</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group"> 
                                                    <div class="col-md-2 cart-extra-info" style="padding:unset; margin:unset;">
                                                        <input type="submit" class="button" value="update">
                                                    </div>                                                 
                                                </div>                                               
                                            </section>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="mt-20">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="blk-clr" style="padding:10px; border:#eff2f2 1px solid">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-6 ">
                                                    <form class="">
                                                        <div class="form-group">
                                                            <label for="coupon_code" class="control-label col-md-3">Coupon Code</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="coupon_code" placeholder="ENTER CODE" class="form-control">
                                                            </div>
        
                                                        </div>
                                                        <div class="form-group"> 
                                                            <div class="col-md-3 cart-extra-info" style="padding:unset; margin:unset;">
                                                                <input type="submit" class="button" value="Apply" style="background: #cecece; color: #000;">
                                                            </div>                                                 
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-12 col-sm-6 ">
                                                    @php
                                                        $client_id = \Illuminate\Support\Facades\Session::get('CLIENT_ID');
                                                        $client = \App\Client::find($client_id);

                                                        $points = \App\Clientpoint::where('client_id',$client_id)->get();

                                                        $totalPoint = 0;
                                                        $totalRedeem = 0;

                                                        foreach ($points as $tPoint)
                                                        {
                                                            $totalPoint += $tPoint->po_point + $tPoint->shared_ref_point + $tPoint->new_friend_purchase_point + $tPoint->pro_review_ref_point;
                                                            $totalRedeem += $tPoint->redeem;
                                                        }

                                                        $availablePoint = $totalPoint - $totalRedeem;


                                                    @endphp
                                                    <form class="">
                                                        <div class="form-group">
                                                            <label for="redeem_point" class="control-label col-md-3">Redeem Point</label>
                                                            @if($client)
                                                                <div class="col-md-6">
                                                                    <input type="text" name="redeem_point" placeholder="ENTER Point" class="form-control" value="{{$availablePoint}}" style="color: #000;">
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <input type="text" name="redeem_point" placeholder="To see your Point Please do login" class="form-control" style="color: #000;">
                                                                </div>
                                                            @endif
                                                            
                                                        </div>
                                                        <div class="form-group"> 
                                                            <div class="col-md-3 cart-extra-info" style="padding:unset; margin:unset;">
                                                                <input type="submit" class="button" value="Apply" style="background: #cecece; color: #000;">
                                                            </div>                                                 
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="mt-20 blk-clr" style="padding:10px; border:#eff2f2 1px solid">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <form class="woocommerce-shipping-calculator" action="#" >
                                                        <section class="shipping-calculator-form">
                                                            <div class="form-group">
                                                                <label for="coupon_code" class="control-label col-md-3">Reference</label>
                                                                <div class="col-md-6">
                                                                    <input type="mail" name="reference_mail" placeholder="reference mail" class="form-control">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group"> 
                                                                <div class="col-md-2 cart-extra-info" style="padding:unset; margin:unset;">
                                                                    <input type="submit" class="button" value="Apply" style="background: #cecece; color: #000;">
                                                                </div>                                                 
                                                            </div>                                               
                                                        </section>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-sm-6 cart-collaterals" style="padding:unset;">
                                        <div class="cart_totals fsz-15" style="padding:10px; border:#eff2f2 1px solid">
                                            {{-- <h4 class="cart-title-highlight title-3">Cart Total</h4> --}}
                                            <table>
                                                <tr class="cart-subtotal">
                                                    <th>Sub Total:</th>
                                                    <td><b class="blk-clr">Tk {{number_format($price,2)}}</b></td>
                                                </tr>
                                                <tr class="cart-discount">
                                                    <th>Discount :</th>
                                                    <td><b class="blk-clr">Tk 0</b></td>
                                                </tr>
    
                                                <tr class="cart-discount">
                                                    <th>Shipping Charge :</th>
                                                    <td><b class="blk-clr">Tk {{$shipping}}</b></td>
                                                </tr>
                                                <tr class="">
                                                    <th>VAT :</th>
                                                    <td>
                                                        <b class="blk-clr">Tk {{number_format($price * $vatTax/100, 2)}}</b>
                                                    </td>
                                                </tr>

                                                @php
                                                    $redeem_point = null;
                                                    $redeem_point = \Illuminate\Support\Facades\Session::get('redeem_point');
                                                @endphp

                                                @if($redeem_point != null)
                                                    <tr class="redeem_point">
                                                        <th>Redeem Point :</th>
                                                        <td>
                                                            <b class="blk-clr">Tk {{number_format($redeem_point, 2)}}</b>
                                                        </td>
                                                    </tr>

                                                @endif
                                                
                                                <tr class="order-total">
                                                    <th>Order Total</th>
                                                    <td><strong><b class="amount">Tk {{number_format($price+($price * ($vatTax/100)) + $shipping - $redeem_point,2)}}</b></strong> </td>
                                                </tr>
                                            </table>
                                        </div>
{{--                                         <div class="wc-proceed-to-checkout text-center mb-10">
                                            <a href="{{url('/checkout')}}" class="checkout-button button alt wc-forward">
                                                <i class="fa fa-check-circle"></i>Proceed to Checkout
                                            </a>
                                        </div> --}}
                                        <div class="row">
                                            <div class="col-md-12 mb-10">
                                                <div class="wc-proceed-to-checkout text-center">
                                                    
                                                    @if(!Session::has('CLIENT_ID'))
                                                        {{-- <a  href="#login-popup" class="btn btn-default right" data-toggle="modal">Proceed to Checkout</a> --}}
                                                        <a  href="#login-popup" class="checkout-button button alt wc-forward" data-toggle="modal" style="padding: 10px;"><i class="fa fa-check-circle"></i>Proceed to Checkout</a>
                                                    @else
                                                        <a type="submit" class="checkout-button button alt wc-forward" href="{{url('/checkout')}}" style="padding: 10px;">
                                                            <i class="fa fa-check-circle"></i>Proceed to Checkout
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="wc-proceed-to-checkout text-center mb-10">
                                <a href="{{url('/checkout')}}" class="checkout-button button alt wc-forward">
                                    <i class="fa fa-check-circle"></i>Proceed to Checkout
                                </a>
                            </div> --}}
                        </div>                            
                    </div>
                </article>
            </main>
        </div>
        <div class="clear"></div>
    </div>
    <br><br>
@endsection