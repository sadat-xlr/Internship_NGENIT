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
                        <span><a href="{{url('/service-cart')}}">Cart</a>  </span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span class="current"> Checkout </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container theme-container">
            <main class="col-md-8 col-sm-8 blog-wrap">
                <article itemprop="blogPost">
                    <!-- Main Content of the Post -->
                    <div class="entry-content" itemprop="articleBody">
                        <div class="woocommerce checkout">
                            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="{{url('/service-order-store')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div id="order_review" class="woocommerce-checkout-review-order ">
                                    <div class="col-lg-12 col-sm-6">
                                        <div class="chck-ttl">
                                            <h4 id="order_review_heading" class="cart-title-highlight title-3">Your order</h4>
                                            <table class="shop_table woocommerce-checkout-review-order-table">
                                                <thead>
                                                    <tr>
                                                        <th class="product-sl fsz-15" style="background: #cecece;"> Sl.</th>
                                                        <th class="product-name fsz-15" style="background: #cecece;">Product</th>
                                                        <th class="product-price fsz-15" style="background: #cecece;">Price</th>
                                                        <th class="fsz-15" style="background: #cecece;">qty</th>
                                                        <th class="fsz-15" style="background: #cecece;">Hour</th>
                                                        <th class="product-total fsz-15" style="background: #cecece;">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $advancePayment = false;
                                                    $currentTime = \Carbon\Carbon::now()->format('d-m-Y');

                                                    $price = 0;
                                                    $shipping = 0;
                                                    $vatTax = 0;
                                                    $service_carts = \Illuminate\Support\Facades\Session::get('service_cart');
                                                @endphp
                                                @foreach($service_carts as $key => $service_cart)
                                                    @php
                                                        $service = \App\Service::find($service_cart['service_id']);
                                                        $salePrice = $service->regularPrice;

                                                        
                                                        if ($service->discount){
                                                            $proPrice = $salePrice-(($salePrice*$service->discount)/100);
                                                        }
                                                        else{
                                                            $proPrice = $service->regularPrice;
                                                        }

                                                    @endphp
                                                    <tr class="">
                                                        <td class="blk-clr fsz-13" style="padding: 10px;">{{$key+1}}</td>
                                                        <td class="blk-clr fsz-13" style="padding: 10px;">{{$service->serviceName}}</td>
                                                        <td class="blk-clr fsz-13" style="padding:10px;">Tk {{number_format($proPrice, 2)}}/hr</td>
                                                        <td class="blk-clr" style="padding: 10px;"> {{$service_cart['qty']}}</td>
                                                        <td class="blk-clr" style="padding: 10px;"> {{$service_cart['hour']}}</td>
                                                        <td class="blk-clr fsz-13" style="padding:10px;">Tk {{number_format($service_cart['qty']* $service_cart['hour'] * $proPrice, 2)}}</td>
                                                    </tr>
                                                    @php
                                                        $unitPrice = $service_cart['qty']* $service_cart['hour'] * $proPrice;
                                                        $price += $unitPrice;
                                                    @endphp
                                                @endforeach
                                                
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="5">Sub Total:</th>
                                                        <td><b class="blk-clr">Tk {{number_format($price,2)}}</b></td>
                                                    </tr>

                                                    <tr class="cart-discount">
                                                        <th colspan="5">Shipping Charge :</th>
                                                        <td><b class="blk-clr">Tk {{number_format($shipping,2)}}</b></td>
                                                    </tr>
                                                    <tr class="shipping">
                                                        <th colspan="5">VAT :</th>
                                                        <td>
                                                            <b class="blk-clr">Tk {{number_format($price * ($vatTax/100),2)}}</b>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $redeem_point = null;
                                                        $redeem_point = \Illuminate\Support\Facades\Session::get('redeem_point');
                                                    @endphp

                                                    @if($redeem_point != null)
                                                        <tr class="redeem_point">
                                                            <th colspan="5">Redeem Point :</th>
                                                            <td>
                                                                <b class="blk-clr">Tk {{number_format($redeem_point, 2)}}</b>
                                                            </td>
                                                        </tr>

                                                    @endif
                                                    <tr class="order-total">
                                                        <th colspan="5">Order Total</th>
                                                        <td><b class="amount">Tk {{number_format($price+($price * ($vatTax/100)) + $shipping - $redeem_point,2)}}</b> </td>
                                                    </tr>
                                                </tfoot>
                                            </table>                                            

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-check text-center">
                                    <label class="radio-inline  mt-30"> 
                                        <input class="form-control-check" id="payment_method" value="1" name="payment_method" hidden> 
                                        <input class="form-control-check" id="terms" type="checkbox" value="1" name="terms"> 
                                        <span> <u> I have read and agree to the website terms and conditions * </u> </span>  
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
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </article>

            </main>
            {{-- <form action="{{url('order-store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }} --}}
                <aside class="col-md-4 col-sm-3">
                    <div class="main-sidebar" >
                        <div class="widget sidebar-widget widget_categories clearfix">
                            <h6 class="widget-title">Address</h6>
                            <a href="{{url('/client-use-address?shipping=true&billing=true')}}"><u>To use your address as a shipping and billing address click here</u></a>
                            <dl>

                                <dt class="complete">  
                                    <div class="form-group">
                                        Shipping Address &nbsp; &nbsp;| &nbsp; &nbsp;
                                        <label class="radio-inline"> 
                                            <input class="form-control" id="shipping_address" type="radio" value="1" name="change_shipping_address"> 
                                            <span id="change-shipping-address"> Change </span>  
                                        </label>
                                    </div>
                                </dt>
                                <dd class="complete mb-10">

                                    {{-- client shipping address --}}

                                    @if ($client->shipping)
                                        <table id="saved_shipping_address" class="table borderless fsz-13">
                                            <tbody>
                                                <tr class="">
                                                    <td class=" hidden-sm hidden-xs">
                                                        Name
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->shipping->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Address
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->shipping->address}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Town
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->shipping->town}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Division
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->shipping->division}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Country
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->shipping->country}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Zip Code
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->shipping->zipCode}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Phone
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->shipping->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Email
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->shipping->email}}</td>
                                                </tr>            
                                            </tbody>
                                        </table>  
                                         {{-- changed shipping address --}}

                                        <div id="shipping-address" class="row hide"> 
                                            <form id="shippingAddressForm" action="#">
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="text" id="shipName" name="shipName" placeholder="Name" value="{{$client->shipping->name}}"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="text" id="shipAddress" name="shipAddress" placeholder="Address" required value="{{$client->shipping->address}}"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="email" id="shipEmail" name="shipEmail" placeholder="Email" required value="{{$client->shipping->email}}"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="text" id="shipTown" name="shipTown" placeholder="Town/City" required value="{{$client->shipping->town}}"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group selectpicker-wrapper">
                                                        <select
                                                            class="selectpicker input-price form-control" data-live-search="true" data-width="100%"
                                                            data-toggle="tooltip" id="shipDivision" name="shipDivision" title="Division" required>
                                                            <option value="{{$client->shipping->division}}" selected>{{$client->shipping->division}}</option>
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
                                                            class="selectpicker input-price form-control" data-live-search="true" data-width="100%"
                                                            data-toggle="tooltip" id="shipCountry" name="shipCountry" title="Country" required>
                                                            <option value="{{$client->shipping->country}}" selected>{{$client->shipping->country}}</option>
                                                            <option value="bangladesh">Bangladesh</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><input class="form-control" type="text" id="shipZipCode" name="shipZipCode" placeholder="Post Code / Zip Code" required value="{{$client->shipping->zipCode}}"></div>
                                                </div>                                                
                                                <div class="col-md-6">
                                                    <div class="form-group"><input class="form-control" type="number" id="shipPhone" name="shipPhone" placeholder="Phone Number" required value="{{$client->shipping->phone}}"></div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 text-right">
                                                    <button id="close_shipping" class="alt fancy-button">Close</button> 
                                                    <button class="alt fancy-button" type="submit">Update</button>       
                                                </div> 
                                            </form>      
                                        </div>                                   
                                    @else
                                        <p style="color:red; font-size: 12px;">
                                            Your profile's shipping address is not specified. Please click on change and fill up the form with your shipping address details. You can update your profile's shipping address on your profile address book.
                                        </p>
                                        <a href="{{url('/client-use-address?shipping=true')}}"><u>To use your address as a shipping address click here</u></a>

                                        {{-- changed shipping address --}}

                                        <div id="shipping-address" class="row hide"> 
                                            <form id="shippingAddressForm" action="#">
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="text" id="shipName" name="shipName" placeholder="Name"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="text" id="shipAddress" name="shipAddress" placeholder="Address" required ></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="email" id="shipEmail" name="shipEmail" placeholder="Email" required ></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="text" id="shipTown" name="shipTown" placeholder="Town/City" required ></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group selectpicker-wrapper">
                                                        <select
                                                            class="selectpicker input-price form-control" data-live-search="true" data-width="100%"
                                                            data-toggle="tooltip" id="shipDivision" name="shipDivision" title="Division" required>
                                                            <option value="dhaka" selected>Dhaka</option>
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
                                                            class="selectpicker input-price form-control" data-live-search="true" data-width="100%"
                                                            data-toggle="tooltip" id="shipCountry" name="shipCountry" title="Country" required>
                                                            
                                                            <option value="bangladesh" selected>Bangladesh</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><input class="form-control" type="text" id="shipZipCode" name="shipZipCode" placeholder="Post Code / Zip Code" required></div>
                                                </div>                                                
                                                <div class="col-md-6">
                                                    <div class="form-group"><input class="form-control" type="number" id="shipPhone" name="shipPhone" placeholder="Phone Number" required ></div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 text-right">
                                                    <button id="close_shipping" class="alt fancy-button">Close</button> 
                                                    <button class="alt fancy-button" type="submit">Update</button>       
                                                </div> 
                                            </form>      
                                        </div>
                                    @endif
                                </dd>


                                <dt class="complete"> 
                                    <div class="form-group">
                                        Billing Address &nbsp; &nbsp;| &nbsp; &nbsp;
                                        <label class="radio-inline"> 
                                            <input class="form-control" id="billing_address" type="radio" value="1" name="change_billing_address"> 
                                            <span id="change-billing-address"> Change </span>  
                                        </label>
                                    </div>
                                </dt>
                                <dd class="complete">

                                    {{-- Client billing address --}}

                                    @if ($client->billing)
                                        <table id="saved_billing_address" class="table borderless fsz-13">
                                            <tbody>
                                                <tr class="">
                                                    <td class=" hidden-sm hidden-xs">
                                                        Name
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->billing->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Address
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->billing->address}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Town
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->billing->town}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Division
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->billing->division}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Country
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->billing->country}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Zip Code
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->billing->zipCode}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Phone
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->billing->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Email
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$client->billing->email}}</td>
                                                </tr>            
                                            </tbody>
                                        </table> 
                                        {{-- Changed billing address --}}

                                        <div id="billing-address" class="row hide"> 
                                            <form id="billingAddressForm" action="#">
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="text" id="billname" name="billName" placeholder="Name" value="{{$client->billing->name}}"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="text" id="billaddress" name="billAddress" placeholder="Address" required value="{{$client->billing->address}}"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="email" id="billemail" name="billEmail" placeholder="Email" required value="{{$client->billing->email}}"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="text" id="billtown" name="billTown" placeholder="Town/City" required value="{{$client->billing->town}}"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group selectpicker-wrapper">
                                                        <select
                                                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                            data-toggle="tooltip" id="billdivision" name="billDivision" title="Division" required>
                                                            <option value="{{$client->billing->division}}" selected>{{$client->billing->division}}</option>
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
                                                            data-toggle="tooltip" id="billcountry" name="billCountry" title="Country" required>
                                                            <option value="{{$client->billing->country}}" selected>{{$client->billing->country}}</option>
                                                            <option value="bangladesh">Bangladesh</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><input class="form-control" type="text" id="billzipCode" name="billZipCode" placeholder="Post Code / Zip Code" required value="{{$client->billing->zipCode}}"></div>
                                                </div>                                                
                                                <div class="col-md-6">
                                                    <div class="form-group"><input class="form-control" type="number" id="billphone" name="billPhone" placeholder="Phone Number" required value="{{$client->billing->phone}}"></div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 text-right">
                                                    <button id="close_billing" class="alt fancy-button">Close</button> 
                                                    <button class="alt fancy-button" type="submit">Update</button>       
                                                </div>
                                            </form>
                                        </div>   
                                    @else 
                                        <p style="color:red; font-size: 12px;">
                                            Your profile's billing address is not specified. Please click on change and fill up the form with your billing address details. You can update your profile's billing address on your profile address book.
                                        </p>
                                        <a href="{{url('/client-use-address?billing=true')}}"><u>To use your address as a billing address click here</u></a>

                                        {{-- Changed billing address --}}

                                        <div id="billing-address" class="row hide"> 
                                            <form id="billingAddressForm" action="#">
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="text" id="billname" name="billName" placeholder="Name" ></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="text" id="billaddress" name="billAddress" placeholder="Address" required ></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="email" id="billemail" name="billEmail" placeholder="Email" required ></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><input class="form-control" type="text" id="billtown" name="billTown" placeholder="Town/City" required ></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group selectpicker-wrapper">
                                                        <select
                                                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                            data-toggle="tooltip" id="billdivision" name="billDivision" title="Division" required>
                                                            
                                                            <option value="dhaka" selected>Dhaka</option>
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
                                                            data-toggle="tooltip" id="billcountry" name="billCountry" title="Country" required>
                                                            
                                                            <option value="bangladesh" selected>Bangladesh</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><input class="form-control" type="text" id="billzipCode" name="billZipCode" placeholder="Post Code / Zip Code" required ></div>
                                                </div>                                                
                                                <div class="col-md-6">
                                                    <div class="form-group"><input class="form-control" type="number" id="billphone" name="billPhone" placeholder="Phone Number" required ></div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 text-right">
                                                    <button id="close_billing" class="alt fancy-button">Close</button> 
                                                    <button class="alt fancy-button" type="submit">Update</button>       
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </dd>
                              
                            </dl>    
                        </div>
                        {{-- payment --}}
                        @if ( $advancePayment == false)
                            <div id="payment" class="col-lg-12 col-sm-6 border woocommerce-checkout-payment">
                                <h4 class="widget-title">Your Payment</h4>
                                <div class="woocommerce-checkout-payment-inner">
                                    <ul class="payment_methods methods list-unstyled">
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
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </aside>
                
            {{-- </form> --}}
        </div>
        <div class="clear"></div>
    </div>
@endsection