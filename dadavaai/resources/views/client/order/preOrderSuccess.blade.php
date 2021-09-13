@extends('layouts.client')

@section('title')
    <title>Dadavaai | Order complete </title>
@endsection
@php
$currentTime = \Carbon\Carbon::now()->format('d-m-Y');
@endphp
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
                        <span class="current"> Order </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container theme-container mb-20">
            <div class="col-md-12 alert alert-success">
                <h4>Booking no: {{$preorder->id}}</h4>
                <h4>Date:{{$preorder->created_at}}</h4>
                <p class="text-center">Thank you. Your order has been received.</p>
            </div>
            <main class="col-md-8 col-sm-8 blog-wrap">
                <article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                    <!-- Main Content of the Post -->
                    <div class="entry-content" itemprop="articleBody">
                        <div class="woocommerce checkout">
                            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="{{url('#')}}" enctype="multipart/form-data">
                                <div id="order_review" class="woocommerce-checkout-review-order ">
                                    <div class="col-lg-12 col-sm-6">
                                        <div class="chck-ttl">
                                            <h4 id="order_review_heading" class="cart-title-highlight title-3">Your Booking Details</h4>
                                            <table class="shop_table woocommerce-checkout-review-order-table">
                                                <thead>
                                                    <tr>
                                                        <th class="product-name" style="background: #cecece; border-left: black 1px solid;">Product</th>
                                                        <th class="product-total" style="background: #cecece;">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $currentTime = \Carbon\Carbon::now()->format('d-m-Y');
                                                    $price = 0;
                                                    $shipping = 100;
                                                    $vatTax = 7.5;
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
                                                        <td class=""><b class="amount">Tk {{number_format($proPrice, 2)}}</b></td>
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
                                                    <tr class="order-total">
                                                        <th>Paid:</th>
                                                        <td>
                                                            <b class="amount">Tk {{number_format($preorder->payment->amount,2)}}</b>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </article>
            </main>
            <aside class="col-md-4 col-sm-3">
                <div class="main-sidebar" >
                    <div class="widget sidebar-widget widget_categories clearfix">
                        <h6 class="widget-title">Address</h6>
                        <dl>
                            <dt class="complete"> Billing Address <span class="separator">|</span></dt>
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
                                    
                                @endif
                            </dd>
                            <dt class="complete"> Shipping Address <span class="separator">|</span></dt>
                            <dd class="complete">

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
                                @endif
                            </dd>
                        </dl>    
                    </div>
                </div>
            </aside>  
        </div>
        <div class="clear"></div>
    </div>
@endsection