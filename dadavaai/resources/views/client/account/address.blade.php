@extends('layouts.client')

@section('title')
    <title>Dadavaai | Client Address Book </title>
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
                            <span class="current red-clr"> Address Book </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="theme-container container">
                <div class="gst-spc3 row">

                    @include('client.account.sidebar')


                    <main class="col-md-9 col-sm-8 blog-wrap">
                        <article class="" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                            <div class="account-details-wrap">
                                <div class="heading-2">                                
                                    <h3 class="title-3 fsz-18">Change Your Personal Details</h3>                            
                                </div>

                                <div class="account-box">
                                    <form id="editAddress" action="#" class="form-delivery">
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group"><input class="form-control" type="text" id="clientName" name="clientName" placeholder="Name" value="{{$client->clientName}}"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><input class="form-control" type="email" id="clientEmail" name="email" placeholder="Email" value="{{$client->email}}"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><input class="form-control" type="text" id="clientAddress" name="address" placeholder="Address" value="{{$client->address}}"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><input class="form-control" type="text" id="clientCity" name="city" placeholder="City" value="{{$client->city}}"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group selectpicker-wrapper">                                
                                                    <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Country" id="clientCountry" name="country">
                                                        <option value="{{$client->country}}" selected>{{$client->country}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group selectpicker-wrapper">
                                                    <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Division" id="clientDivision" name="division">
                                                        <option value="{{$client->division}}" selected>{{$client->division}}</option>
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
                                            <div class="col-md-3">
                                                <div class="form-group"><input class="form-control" type="text" id="clientZipCode" name="zipCode" placeholder="Postcode/ZIP" value="{{$client->zipCode}}"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group"><input class="form-control" type="text" id="clientPhone" name="phone" placeholder="Phone Number" value="{{$client->phone}}"></div>
                                            </div> 
                                            <div class="col-md-12 col-sm-12 mb-10">
                                                <button class="alt fancy-button" type="submit">Update</button>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <a href="{{url('/client-use-address?shipping=true&billing=true')}}"><u>To use your address as a shipping and billing address click here</u></a>                                                                                       
                                            </div>
                                        </div>
                                    </form>                    
                                </div>
                            </div>
                        </article>
                        <article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                            <!-- Main Content of the Post -->
                            <div class="entry-content" itemprop="articleBody">
                                <div class="woocommerce checkout">
                                    <div class="col2-set clearfix" id="customer_details">
                                        <div class="col-1 col-lg-6 col-sm-6">
                                            <h4 class="cart-title-highlight title-3">Billing Details</h4>
                                            @if ($billingAddress)
                                                <form id="billingAddressForm" action="#">
                                                    <div class="row"> 
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" id="billname" name="name" placeholder="Name" value="{{$billingAddress->name}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group"><input class="form-control" type="text" id="billaddress" name="address" placeholder="Address" value="{{$billingAddress->address}}"></div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group"><input class="form-control" type="email" id="billemail" name="email" placeholder="Email" value="{{$billingAddress->email}}"></div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group"><input class="form-control" type="text" id="billtown" name="town" placeholder="Town/City" value="{{$billingAddress->town}}"></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group selectpicker-wrapper">
                                                                <select
                                                                    class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                                    data-toggle="tooltip" id="billdivision" name="division" title="Division">
                                                                    <option value="{{$billingAddress->division}}" selected>{{$billingAddress->division}}</option>
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
                                                                    data-toggle="tooltip" id="billcountry" name="country" title="Country">
                                                                    <option value="{{$billingAddress->country}}" selected>{{$billingAddress->country}}</option>
                                                                    <option value="bangladesh">Bangladesh</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group"><input class="form-control" type="text" id="billzipCode" name="zipCode" placeholder="Post Code / Zip Code" value="{{$billingAddress->zipCode}}"></div>
                                                        </div>                                                
                                                        <div class="col-md-6">
                                                            <div class="form-group"><input class="form-control" type="number" id="billphone" name="phone" placeholder="Phone Number" value="{{$billingAddress->phone}}"></div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 mb-10">
                                                            <a href="{{url('/client-use-address?billing=true')}}"><u>To use your address as a billing address click here</u></a>                                                                                       
                                                        </div> 
                                                        <div class="col-md-12 col-sm-12">
                                                            <button class="alt fancy-button" type="submit">Update</button>                                                                                       
                                                        </div>       
                                                    </div>    
                                                </form>
                                            @else
                                                <form id="billingAddressForm" action="#">
                                                    <div class="row"> 
                                                        <div class="col-md-12">
                                                            <div class="form-group"><input class="form-control" type="text" id="billname" name="name" placeholder="Name"></div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group"><input class="form-control" type="text" id="billaddress" name="address" placeholder="Address"></div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group"><input class="form-control" type="email" id="billemail" name="email" placeholder="Email" required></div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group"><input class="form-control" type="text" id="billtown" name="town" placeholder="Town/City"></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group selectpicker-wrapper">
                                                                <select
                                                                    class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                                    data-toggle="tooltip" id="billdivision" name="division" title="Division">
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
                                                                    data-toggle="tooltip" id="billcountry" name="country" title="Country">
                                                                    <option value="bangladesh">Bangladesh</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group"><input class="form-control" type="text" id="billzipCode" name="zipCode" placeholder="Post Code / Zip Code"></div>
                                                        </div>                                                
                                                        <div class="col-md-6">
                                                            <div class="form-group"><input class="form-control" type="number" id="billphone" name="phone" placeholder="Phone Number" required></div>
                                                        </div>  
                                                        <div class="col-md-12 col-sm-12 mb-10">
                                                            <a href="{{url('/client-use-address?billing=true')}}"><u>To use your address as a billing address click here</u></a>                                                                                       
                                                        </div>
                                                        <div class="col-md-12 col-sm-12">
                                                            <button class="alt fancy-button" type="submit">Update</button>                                                                                       
                                                        </div>     
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                        <div class="col-2 col-lg-6 col-sm-6 border">
                                            <div class="woocommerce-shipping-fields">
                                                <h4 class="cart-title-highlight title-3">Ship to a different address?</h4>
                                                @if ($shippingAddress)
                                                    <form id="shippingAddressForm" action="#">
                                                        <div class="row"> 
                                                            <div class="col-md-12">
                                                                <div class="form-group"><input class="form-control" type="text" id="shipName" name="name" placeholder="Name" value="{{$shippingAddress->name}}"></div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group"><input class="form-control" type="text" id="shipAddress" name="address" placeholder="Address" value="{{$shippingAddress->address}}"></div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group"><input class="form-control" type="email" id="shipEmail" name="email" placeholder="Email" value="{{$shippingAddress->email}}" required></div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group"><input class="form-control" type="text" id="shipTown" name="town" placeholder="Town/City" value="{{$shippingAddress->town}}"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group selectpicker-wrapper">
                                                                    <select
                                                                        class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                                        data-toggle="tooltip" id="shipDivision" name="division" title="Division">
                                                                        <option value="{{$shippingAddress->division}}" selected>{{$shippingAddress->division}}</option>
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
                                                                        data-toggle="tooltip" id="shipCountry" name="country" title="Country">
                                                                        <option value="{{$shippingAddress->country}}" selected>{{$shippingAddress->country}}</option>
                                                                        <option value="bangladesh">Bangladesh</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group"><input class="form-control" type="text" id="shipZipCode" name="zipCode" placeholder="Post Code / Zip Code" value="{{$shippingAddress->zipCode}}"></div>
                                                            </div>                                                
                                                            <div class="col-md-6">
                                                                <div class="form-group"><input class="form-control" type="number" id="shipPhone" name="phone" placeholder="Phone Number" value="{{$shippingAddress->phone}}" required></div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 mb-10">
                                                                <a href="{{url('/client-use-address?shipping=true')}}"><u>To use your address as a shipping address click here</u></a>                                                                                       
                                                            </div> 
                                                            <div class="col-md-12 col-sm-12">
                                                                <button class="alt fancy-button" type="submit">Update</button>                                                                                       
                                                            </div>       
                                                        </div>    
                                                    </form>
                                                @else
                                                    <form id="shippingAddressForm" action="#">
                                                        <div class="row"> 
                                                            <div class="col-md-12">
                                                                <div class="form-group"><input class="form-control" type="text" id="shipName" name="name" placeholder="Name"></div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group"><input class="form-control" type="text" id="shipAddress" name="address" placeholder="Address"></div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group"><input class="form-control" type="email" id="shipEmail" name="email" placeholder="Email" required></div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group"><input class="form-control" type="text" id="shipTown" name="town" placeholder="Town/City"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group selectpicker-wrapper">
                                                                    <select
                                                                        class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                                        data-toggle="tooltip" id="shipDivision" name="division" title="Division">
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
                                                                        data-toggle="tooltip" id="shipCountry" name="country" title="Country">
                                                                        <option value="bangladesh">Bangladesh</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group"><input class="form-control" type="text" id="shipZipCode" name="zipCode" placeholder="Post Code / Zip Code"></div>
                                                            </div>                                                
                                                            <div class="col-md-6">
                                                                <div class="form-group"><input class="form-control" type="number" id="shipPhone" name="phone" placeholder="Phone Number" required></div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 mb-10">
                                                                <a href="{{url('/client-use-address?shipping=true')}}"><u>To use your address as a shipping address click here</u></a>                                                                                       
                                                            </div> 
                                                            <div class="col-md-12 col-sm-12">
                                                                <button class="alt fancy-button" type="submit">Update</button>                                                                                       
                                                            </div>       
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </main>  

                </div>
            </div>

            <div class="clear"></div>
        </div>
        <!-- / CONTENT + SIDEBAR -->
@endsection