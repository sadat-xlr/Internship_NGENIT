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
        <div class="container theme-container">
            <div class="col-md-12 alert alert-success">
                <h4>order no: {{$order->id}}</h4>
                <h4>Date:{{$order->created_at}}</h4>
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
                                            <h4 id="order_review_heading" class="cart-title-highlight title-3">Your order</h4>
                                            <table class="shop_table woocommerce-checkout-review-order-table">
                                                <thead>
                                                    <tr>
                                                        <th class="product-sl fsz-15"> Sl.</th>
                                                        <th class="product-name fsz-15">Product</th>
                                                        <th class="product-price fsz-15">Price</th>
                                                        <th class="fsz-15">qty</th>
                                                        <th class="fsz-15">hour</th>
                                                        <th class="product-total fsz-15">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $price = 0;
                                                    $shipping = 0;
                                                    $vatTax = 0;
                                                @endphp
                                                @foreach($order->serviceOrders as $key => $serviceOrder)
                                                    @php
                                                        $salePrice = $serviceOrder->service->regularPrice;

                                                        if ($serviceOrder->service->discount){
                                                            $proPrice = $salePrice-(($salePrice*$serviceOrder->service->discount)/100);
                                                        }
                                                        else{
                                                            $proPrice = $serviceOrder->service->regularPrice;
                                                        }

                                                        

                                                    @endphp
                                                    <tr class="">
                                                        <td class="blk-clr fsz-13" style="padding: 10px;">{{$key+1}}</td>
                                                        <td class="blk-clr fsz-13" style="padding: 10px;">{{$serviceOrder->service->serviceName}}</td>
                                                        <td class="blk-clr fsz-13" style="padding:10px;">Tk {{number_format($proPrice, 2)}}</td>
                                                        <td class="blk-clr" style="padding: 10px;"> {{$serviceOrder->quantity}}</td>
                                                        <td class="blk-clr" style="padding: 10px;"> {{$serviceOrder->hour}}</td>
                                                        <td class="blk-clr fsz-13" style="padding:10px;">Tk {{number_format($serviceOrder->quantity * $serviceOrder->hour * $proPrice, 2)}}</td>
                                                    </tr>
                                                    @php
                                                        $unitPrice = $serviceOrder->quantity * $serviceOrder->hour * $proPrice;
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

                                                    @if($redeem_point)
                                                    <tr class="shipping">
                                                        <th colspan="5">Redeem Point :</th>
                                                        <td>
                                                            <b class="blk-clr">Tk {{number_format($redeem_point,2)}}</b>
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
                            </form>
                        </div>
                        <div class="clearfix"></div>
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
                                @if ($order->billing)
                                    <table id="saved_billing_address" class="table borderless fsz-13">
                                            <tbody>
                                                <tr class="">
                                                    <td class=" hidden-sm hidden-xs">
                                                        Name
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Address
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->address}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Town
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->town}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Division
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->division}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Country
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->country}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Zip Code
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->zipCode}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Phone
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Email
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->billing->email}}</td>
                                                </tr>            
                                            </tbody>
                                        </table> 
                                    
                                @endif
                            </dd>
                            <dt class="complete"> Shipping Address <span class="separator">|</span></dt>
                            <dd class="complete">

                                {{-- client shipping address --}}
                                @if ($order->shipping)
                                    <table id="saved_shipping_address" class="table borderless fsz-13">
                                            <tbody>
                                                <tr class="">
                                                    <td class=" hidden-sm hidden-xs">
                                                        Name
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Address
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->address}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Town
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->town}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Division
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->division}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Country
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->country}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Zip Code
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->zipCode}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Phone
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td class=" hidden-sm hidden-xs">
                                                        Email
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{$order->shipping->email}}</td>
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