@extends('layouts.client')

@section('title')
    <title>Dadavaai | Checkout </title>
@endsection

@section('content')
    <!-- CONTENT + SIDEBAR -->
    <div class="main-wrapper clearfix">
        <div class="site-pagetitle jumbotron">
            <div class="container  theme-container">
                <!-- Breadcrumbs -->
                <div class="breadcrumbs">
                    <div class="breadcrumbs">
                        <i class="fa fa-home"></i>
                        <span><a href="{{url('/')}}">Home</a></span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span> Client </span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span class="current"> Checkout </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container theme-container">
            <main class="col-md-8 col-sm-8 blog-wrap">
                <article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                    <!-- Main Content of the Post -->
                    <div class="entry-content" itemprop="articleBody">
                        <div class="woocommerce checkout">
                            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="{{url('/hello')}}" enctype="multipart/form-data">
                                <div id="order_review" class="woocommerce-checkout-review-order ">
                                    <div class="col-lg-12 col-sm-6 border">
                                        <div class="chck-ttl">
                                            <h4 id="order_review_heading" class="cart-title-highlight title-3">Your order</h4>
                                            <table class="shop_table woocommerce-checkout-review-order-table">
                                                <thead>
                                                    <tr>
                                                        <th class="product-name" style="border-left: black 1px solid;">Product &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; x   qty</th>
                                                        <th class="product-total">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $advancePayment = false;
                                                    $currentTime = \Carbon\Carbon::now()->format('d-m-Y');
                                                    $price = $quotation->price + ($quotation->price*(20/100));
                                                    $shipping = 100;
                                                    $vatTax = 7.5;
                                                @endphp

                                                    <tr class="cart_item">
                                                        <td class="product-name" style="padding-left:25px;">{{$quotation->ondemand->product}} <strong class="product-quantity">&times; {{$quotation->ondemand->qty}}</strong></td>
                                                        <td class="product-total" style="border: black 1px solid;"><b class="amount">Tk {{number_format($price , 2)}}</b></td>
                                                    </tr>   
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sub Total:</th>
                                                        <td><b class="drk-gry">Tk {{number_format($price,2)}}</b></td>
                                                    </tr>

                                                    <tr class="cart-discount">
                                                        <th>Shipping Charge :</th>
                                                        <td><b class="drk-gry">Tk {{number_format($shipping,2)}}</b></td>
                                                    </tr>
                                                    <tr class="shipping">
                                                        <th>Vat/Tex :</th>
                                                        <td>
                                                            <b class="drk-gry">Tk {{number_format($price * ($vatTax/100),2)}}</b>
                                                        </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Order Total</th>
                                                        <td><b class="amount">Tk {{number_format($price+($price * ($vatTax/100)) + $shipping,2)}}</b> </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </article>

            </main>
            <form action="{{url('ondemand-order-store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <aside class="col-md-4 col-sm-3">
                    <div class="main-sidebar" >
                        <div class="widget sidebar-widget widget_categories clearfix">
                            <h6 class="widget-title">Address</h6>
                            <dl>
                                <dt class="complete"> Billing Address <span class="separator">|</span> 
                                    <div class="form-group">
                                        <label class="radio-inline"> 
                                            <input class="form-control" id="billing_address" type="radio" value="1" name="change_billing_address"> 
                                            <span id="change-billing-address"> Change </span>  
                                        </label>
                                    </div>
                                </dt>
                                <dd class="complete">

                                    {{-- Client billing address --}}

                                    @if ($client->billing)
                                    <address>
                                    Name: {{$client->billing->name}}<br>
                                    Address: {{$client->billing->address}}<br>
                                    Town: {{$client->billing->town}}<br>
                                    Division: {{$client->billing->division}}<br>
                                    Country: {{$client->billing->country}}<br>
                                    Zip Code: {{$client->billing->zipCode}}<br>
                                    Phone: {{$client->billing->phone}}<br>
                                    Email: {{$client->billing->email}}
                                    </address>
                                    @else 
                                        <p style="color:red; font-size: 12px;">
                                            Your profile's billing address is not specified. Please click on change and fill up the form with your billing address details. You can update your profile's billing address on your profile address book.
                                        </p>
                                    @endif

                                    {{-- Changed billing address --}}

                                    <div id="billing-address" class="row hide"> 
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" type="text" id="billname" name="billName" placeholder="Name"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" type="text" id="billaddress" name="billAddress" placeholder="Address"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" type="email" id="billemail" name="billEmail" placeholder="Email"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" type="text" id="billtown" name="billTown" placeholder="Town/City"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group selectpicker-wrapper">
                                                <select
                                                    class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                    data-toggle="tooltip" id="billdivision" name="billDivision" title="Division">
                                                    <option value="dhaka">Dhaka</option>
                                                    <option value="barisal">Barisal</option>
                                                    <option value="sylhet">Sylhet</option>
                                                    <option value="rajshahi">Rajshahi</option>
                                                    <option value="rangpur">Rangpur</option>
                                                    <option value="khulna">Khulna</option>
                                                    <option value="chattogram">Chattogram</option>
                                                    <option value="mymensingh">Mymensingh</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group selectpicker-wrapper">
                                                <select
                                                    class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                    data-toggle="tooltip" id="billcountry" name="billCountry" title="Country">
                                                    <option value="bangladesh">Bangladesh</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control" type="text" id="billzipCode" name="billZipCode" placeholder="Post Code / Zip Code"></div>
                                        </div>                                                
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control" type="number" id="billphone" name="billPhone" placeholder="Phone Number"></div>
                                        </div>
                                    </div> 
                                </dd>
                                <dt class="complete"> Shipping Address <span class="separator">|</span> 
                                    <div class="form-group">
                                        <label class="radio-inline"> 
                                            <input class="form-control" id="shipping_address" type="radio" value="1" name="change_shipping_address"> 
                                            <span id="change-shipping-address"> Change </span>  
                                        </label>
                                    </div>
                                </dt>
                                <dd class="complete">

                                    {{-- client shipping address --}}

                                    @if ($client->shipping)
                                    <address>
                                    Name: {{$client->shipping->name}}<br>
                                    Address: {{$client->shipping->address}}<br>
                                    Town: {{$client->shipping->town}}<br>
                                    Division: {{$client->shipping->division}}<br>
                                    Country: {{$client->shipping->country}}<br>
                                    Zip Code: {{$client->shipping->zipCode}}<br>
                                    Phone: {{$client->shipping->phone}}<br>
                                    Email: {{$client->shipping->email}}
                                    </address>
                                    @else
                                        <p style="color:red; font-size: 12px;">
                                            Your profile's shipping address is not specified. Please click on change and fill up the form with your shipping address details. You can update your profile's shipping address on your profile address book.
                                        </p>
                                    @endif

                                    {{-- changed shipping address --}}

                                    <div id="shipping-address" class="row hide"> 
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" type="text" id="shipName" name="shipName" placeholder="Name"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" type="text" id="shipAddress" name="shipAddress" placeholder="Address"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" type="email" id="shipEmail" name="shipEmail" placeholder="Email"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" type="text" id="shipTown" name="shipTown" placeholder="Town/City"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group selectpicker-wrapper">
                                                <select
                                                    class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                    data-toggle="tooltip" id="shipDivision" name="shipDivision" title="Division">
                                                    <option value="dhaka">Dhaka</option>
                                                    <option value="barisal">Barisal</option>
                                                    <option value="sylhet">Sylhet</option>
                                                    <option value="rajshahi">Rajshahi</option>
                                                    <option value="rangpur">Rangpur</option>
                                                    <option value="khulna">Khulna</option>
                                                    <option value="chattogram">Chattogram</option>
                                                    <option value="mymensingh">Mymensingh</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group selectpicker-wrapper">
                                                <select
                                                    class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                    data-toggle="tooltip" id="shipCountry" name="shipCountry" title="Country">
                                                    <option value="bangladesh">Bangladesh</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control" type="text" id="shipZipCode" name="shipZipCode" placeholder="Post Code / Zip Code"></div>
                                        </div>                                                
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control" type="number" id="shipPhone" name="shipPhone" placeholder="Phone Number"></div>
                                        </div>       
                                    </div>
                                </dd>
                                {{-- <dt class="complete"> Shipping Method <span class="separator">|</span> <a href="#">Change</a> </dt>
                                <dd class="complete"> Flat Rate - Fixed <br>
                                    <span class="price">$15.00</span> </dd> --}}
{{--                                 <h4 class="widget-title">Partial Payment</h4>
                                <div class="col-md-8" style="margin-top: 20px;">
                                    <div class="form-group selectpicker-wrapper">
                                        <select
                                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                                            data-toggle="tooltip" id="partial_payment" name="partial_payment" title="Payment Option">
                                            <option value="1" selected>Pay 100%</option>
                                            <option value=".75">Pay 75%</option>
                                            <option value=".5">Pay 50%</option>
                                            <option value=".25">Pay 25%</option>
                                            @if ($advancePayment == false)
                                                <option value="0"> pay none</option>                                                
                                            @endif
                                        </select>
                                    </div>
                                </div>  --}}   
    
                            </dl>    
                        </div>
                        {{-- payment --}}
{{--                         <div id="payment" class="col-lg-12 col-sm-6 border woocommerce-checkout-payment">
                            <h4 class="widget-title">Your Payment</h4>
                            <div class="woocommerce-checkout-payment-inner">
                                <ul class="payment_methods methods list-unstyled">
                                    @if ( $advancePayment == false)
                                        <li class="payment_method_cod">
                                            <div class="form-group">
                                                <label class="radio-inline"> 
                                                    <input class="form-control" id="cod" type="radio" value="3" name="payment_method"> 
                                                    <span> Cash on Delivery </span>  
                                                </label>
                                            </div>
                                            <div id="cod_details" class="hide">
                                                <div class="payment_box payment_method_cod">
                                                    <p> <strong> Pay with cash upon delivery. </strong> </p>
                                                </div>
                                            </div>                                                       
                                        </li>
                                    @endif

                                </ul>

                            </div>
                        </div> --}}
                    </div>
                </aside>
{{--                 <div class="form-group">
                    <label class="radio-inline"> 
                        <input class="form-control" id="payment_update" type="radio" value="1" name="payment_update"> 
                        <span> Update your profile's payment method with this method? </span>  
                    </label>
                </div> --}}
                <div class="form-group">
                    <label class="radio-inline"> 
                        <input class="form-control" id="terms" type="radio" value="1" name="terms"> 
                        <span> I have read and agree to the website terms and conditions * </span>  
                    </label>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-10">
                        <div class="wc-proceed-to-checkout text-center">
                            <button type="submit" class="checkout-button button alt wc-forward" href="{{url('#')}}">
                                <i class="fa fa-check-circle"></i>Proceed to Checkout
                            </button>
                        </div>
                    </div>
                </div> 
                <div>
                    <input type="number" name="quotation_id" class="hidden" value="{{$quotation->id}}">
                </div> 
            </form>
        </div>
        <div class="clear"></div>
    </div>
@endsection