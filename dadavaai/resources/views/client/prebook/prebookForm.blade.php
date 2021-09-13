@extends('layouts.client')

@section('title')
    <title>Pre-launching book product </title>
@endsection

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
                        <span><a href="{{url('pre-launching-product-details/'.$prebook->id)}}">{{$prebook->product->productName}}</a></span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span class="current red-clr">Book</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="theme-container container">
{{--             <main id="main-content" class="main-content">                  
                <div itemscope itemtype="http://schema.org/Product" class="product has-post-thumbnail product-type-variable">

                    <div class="row">
                        <form action="{{url('pre-order')}}" method="POST" class="no-padding col-md-12 col-sm-12" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group col-sm-8 form-alert">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <td>prebook Id</td>
                                            <td>discount </td>
                                            <td>product</td>
                                            <td>Price</td>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$prebook->id}}</td>
                                                <td>{{$prebook->prebook_discount}}</td>
                                                <td>{{$prebook->product->productName}}</td>
                                                <td>{{$prebook->product->regularPrice}}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>Prebook Total:</td>
                                                <td>{{$prebook->product->regularPrice - $prebook->prebook_discount}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="contact-form">
                                    <div class="form-group col-sm-6">
                                        <input type="hidden" class="form-control" name="prebook_id" value="{{$prebook->id}}" >
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>

                </div>                    
            </main> --}}

            <main class="col-md-8 col-sm-8 blog-wrap">
                <article itemprop="blogPost">
                    <!-- Main Content of the Post -->
                    <div class="entry-content" itemprop="articleBody">
                        <div class="woocommerce checkout">
                            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="{{url('/pre-order')}}" enctype="multipart/form-data">
                              {{ csrf_field() }}

                                <div id="order_review" class="woocommerce-checkout-review-order ">
                                    <div class="col-lg-12 col-sm-6">
                                        <div class="chck-ttl">
                                            <h4 id="order_review_heading" class="cart-title-highlight title-3">Your pre order</h4>
                                            <table class="shop_table woocommerce-checkout-review-order-table">
                                                <thead>
                                                    <tr>
                                                        <th class="product-name" style="border-left: black 1px solid; background: #cecece;">Product</th>
                                                        <th class="product-total" style="background: #cecece;">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $currentTime = \Carbon\Carbon::now()->format('d-m-Y');
                                                    $price = 0;
                                                    $shipping = 100;
                                                    $vatTax = 7.5;
                                                    $client = '';
                                                    if (Session::get('CLIENT_ID')) {
                                                        $client_id = Session::get('CLIENT_ID');
                                                        $client = \App\Client::where('id', $client_id)->first();
                                                    }

                                                    $product = $prebook->product;
                                                    $salePrice = $product->regularPrice;

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

                                                @endphp
                                                    <tr class="cart_item">
                                                        <td class="fsz-14" style="padding-left:25px;">{{$product->productName}}</td>
                                                        <td class="product-total"><b class="amount">Tk {{number_format($proPrice, 2)}}</b></td>
                                                    </tr>
                                                    @php
                                                        $unitPrice = $proPrice;
                                                        $price += $unitPrice;
                                                        $discount = $prebook->prebook_discount;
                                                    @endphp
                                                
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sub Total:</th>
                                                        <td><b class="drk-gry">Tk {{number_format($price,2)}}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount:</th>
                                                        <td><b class="drk-gry">Tk {{number_format($discount,2)}}</b></td>
                                                    </tr>

                                                    <tr class="cart-discount">
                                                        <th>Shipping Charge :</th>
                                                        <td><b class="drk-gry">Tk {{number_format($shipping,2)}}</b></td>
                                                    </tr>
                                                    <tr class="shipping">
                                                        <th>VAT :</th>
                                                        <td>
                                                            <b class="drk-gry">Tk {{number_format($price * ($vatTax/100),2)}}</b>
                                                        </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Order Total</th>
                                                        <td><b class="amount">Tk {{number_format($price - $discount +($price * ($vatTax/100)) + $shipping,2)}}</b> </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Advance Payment ({{$prebook->amount_to_pay}}%) :</th>
                                                        <td>
                                                            <b class="amount">Tk {{number_format(($price - $discount +($price * ($vatTax/100)) + $shipping)*($prebook->amount_to_pay/100),2)}}</b>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="hidden" class="form-control" name="prebook_id" value="{{$prebook->id}}" >
                                </div>
                                <div class="form-check text-center">
                                    <label class="radio-inline  mt-30"> 
                                        <input class="form-control-check" id="terms" type="checkbox" value="1" name="terms"> 
                                        <span> <u> I have read and agree to the website terms and conditions * </u> </span>  
                                    </label>
                                </div>

                                @if(!Session::has('CLIENT_ID'))
                                    <div class="form-group col-sm-12 text-center">
                                        <a class="fancy-btn fancy-btn-small" href="#login-popup" data-toggle="modal" data-placement="top" title="Book now">
                                            Login to Book now
                                        </a>
                                    </div>
                                @else
                                    <div class="form-group col-sm-12 text-center">
                                        <button type="submit" class="fancy-btn fancy-btn-small">
                                            <i class="fa fa-shopping-cart"></i> Checkout
                                        </button>
                                    </div>
                                @endif
                           </form> 
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </article>
            </main>
            {{-- <form action="{{url('pre-order')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }} --}}
                <aside class="col-md-4 col-sm-3">
                    <div class="main-sidebar" >
                        <div class="widget sidebar-widget widget_categories clearfix">
                            <h6 class="widget-title">Address</h6>
                            @if($client)
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
                            @else
                                <p>You have to Login Or Signup to book this Product </p>
                                <a class="fancy-btn fancy-btn-small" href="#login-popup" data-toggle="modal" data-placement="top" title="Book now" style="text-transform: unset;">
                                    Login
                                </a>
                            @endif   
                        </div>
                    </div>
                </aside>
                {{-- <div class="row">
                    <div class="col-md-12 mb-10">
                        <div class="form-group col-sm-6">
                            <input type="hidden" class="form-control" name="prebook_id" value="{{$prebook->id}}" >
                        </div>
                        <div class="form-group" style="margin-top: 50px;">
                            <label class="radio-inline"> 
                                <input class="form-control" id="terms" type="radio" value="1" name="terms"> 
                                <span> I have read and agree to the website terms and conditions * </span>  
                            </label>
                        </div>

                        @if(!Session::has('CLIENT_ID'))
                            <div class="form-group col-sm-12 text-center">
                                <a class="fancy-btn fancy-btn-small" href="#login-popup" data-toggle="modal" data-placement="top" title="Book now">
                                    Login to Book now
                                </a>
                            </div>
                        @else
                            <div class="form-group col-sm-12 text-center">
                                <button type="submit" class="fancy-btn fancy-btn-small">
                                    <i class="fa fa-shopping-cart"></i> Checkout
                                </button>
                            </div>
                        @endif
                    </div>
                </div> --}}  
            {{-- </form> --}}
        </div>
        <div class="clear"></div>
    </div>
@endsection