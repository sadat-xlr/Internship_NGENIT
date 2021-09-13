<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="online shop for Luxury Items, Costly Home & Decores, Luxury electronics & Mobiles, Luxury Pens & watches, office supplies,Fashion & Lifestyles, Men & Women High Society, Home made Items, Home made food & groceries,health & beauties, foreign luxury items, home made foods, home made crafts, exclusive & demanding items over Tk 5,000" />


    <meta name="keywords" content="Online Shop for Exclusive, Rare, Demanding, High Society, Costly, Valuable, Luxury Items for Elite class,  Office Supplies,Jewelry,Smart TVs,Electronics,Baby Products,Video Games,Computers,Laptops,Cell Phones,Games,Apparel,Clothing,Fashion,Accessories,Shoes,Watches,Sports & Outdoors, Sporting Goods,Office Products,Health,Vitamins,Personal Care,Beauty Products,Garden,Bed,Bath,Furniture,Tools,Hardware, Vacuums,Outdoor Living,Automotive Parts,Pet Food,Pet Supplies,iphone, samsung, huwaei, motorola, caviar, rolex, omega, watches, ebike, costly bicycle,foreign medicine, exclusive computers, rugged electronics, audio set, home & living items, exclusive books, best seller books, arts, cultural books, paintings, exclusive showpieces, military tools, leather items, Sweet, Ilish, Fishes, antique items, fragrance, sunglasses, underwear,nighties, drones, robots, on demand services, health & beauties  etc  " />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('og_property')

    {{-- Title --}}
    @yield('title')

    <!-- Styles -->
    <!-- Favicon -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('client/ico/dadavaai-favicon.png')}}">
    <link rel="shortcut icon" href="{{asset('client/ico/dadavaai-favicon.png')}}">

    <!-- CSS Global -->
    <link href="{{asset('client/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">        
    <link href="{{asset('client/plugins/bootstrap-select-1.9.3/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css">         
    <link href="{{asset('client/plugins/owl-carousel2/assets/owl.carousel.css')}}" rel="stylesheet" type="text/css"> 
    <link href="{{asset('client/plugins/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.min.css')}}" rel="stylesheet" type="text/css">   
    <link href="{{asset('client/plugins/royalslider/skins/universal/rs-universal.css')}}" rel="stylesheet">
    <link href="{{asset('client/plugins/royalslider/royalslider.css')}}" rel="stylesheet">
    <link href="{{asset('client/plugins/nouislider/nouislider.min.css')}}" rel="stylesheet">
    <link href="{{asset('client/plugins/subscribe-better-master/subscribe-better.css')}}" rel="stylesheet" type="text/css">
    {{-- for zoom image --}}
    <link rel="stylesheet" href="{{asset('client/plugins/picZoomer/css/jquery-picZoomer.css')}}">

    <!-- tostr notification CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>

    <!-- Icons Font CSS -->
    <link href="{{asset('client/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"> 


    {{-- product review --}}

    {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
    <!------ Include the above in your HEAD tag ---------->
 

    <!-- Theme CSS -->
    <link href="{{asset('client/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('client/css/header.css')}}" rel="stylesheet" type="text/css">  

    {{-- google recaptcha --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body class="home page woocommerce-cart" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    @php
        $siteInfos = \App\Siteinfo::first();
        $contact = \App\Contact::first();
        $categories =   \App\Category::all();
        $ondemand_category = \App\Category::select('categoryName', 'id')->where('categoryName', 'like', '%demand%')->first();
        $service_subcategory = \App\Subcategory::with('category')->where('subCategoryName', 'like', '%service%')->first();

        $bannerHeader  = \App\Banner::select('header_one', 'header_two', 'header_three', 'header_three_link')->first();

        $brands     =   \App\Brand::orderBy('brandName')->get();
        $deal_value = DB::table('deals')->max('discount_value');
        $topDeals = \App\Deal::select('id', 'discount_value', 'valid_until')->where('discount_value', $deal_value)->first();
        $navDeals = \App\Deal::inRandomOrder()->take(1)->get();
        $b1g1 = \App\Product::where('buy_get', true)->where('published', false)->inRandomOrder()->take(4)->get();
        $discount_val = \App\Product::where('published', false)->max('discount');
        $topDiscount   = \App\Product::select('id', 'slug', 'discount')->where('published', false)->where('discount',$discount_val)->get();
        $discounts   = \App\Product::select('id', 'slug', 'discount')->where('published', false)->where('discount', '>', 0)->inRandomOrder()->take(1)->get();

    @endphp
    <!-- HEADER -->
{{-- <header id="masthead" class="clearfix" itemscope="itemscope" itemtype="https://schema.org/WPHeader">--}}    
    <header id="masthead" class="clearfix">
        <div class="hidden-xs hidden-sm hidden-md site-subheader site-header" style="border-bottom: solid 1px #ffffff;">
            <div class="container theme-container">
                <div class="col-lg-4">
                    <!-- notification -->
                    <ul class="hidden-xs hidden-sm hidden-md pull-left list-unstyled list-inline">
                        <li class="nav-dropdown language-switcher">
                            <div style="color:#fff;">
                                @if ($siteInfos)
                                <marquee>{{$siteInfos->title}}</marquee>
                                @endif
                                Notification / Tips
                            </div>
                        </li>
                    </ul>                    
                </div>
                <div class="col-lg-4">
                    <!-- notification -->
                    <ul class="hidden-xs hidden-sm hidden-md list-unstyled list-inline text-center">
                        <li class="nav-dropdown language-switcher">
                            <div style="color: yellow;">
                                Hotline: &nbsp; @if ($contact){{$contact->phone1}}@endif
                            </div>
                        </li>
                    </ul>                     
                </div>
                <div class="col-lg-4">
                    <!-- account currency language -->
                    <ul class="pull-right list-unstyled list-inline">
                        <li class="nav-dropdown">
                            @if(!Session::has('CLIENT_ID'))
                            <a href="#" style="color:#fff"> 
                                <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                                    Sign In / Registration
                            </a>
                            <ul class="nav-dropdown-inner list-unstyled accnt-list" style="margin-top: -5px;">
                                <li class="menu-item">
                                    <a  href="#login-popup" data-toggle="modal">Sign In</a>
                                </li>
                                <li> <a href="{{url('/client-register-view')}}">Registration</a></li>
                                <li> <a href="{{url('/forgot-password')}}">Forget Password</a></li>
                            </ul>
                            @else
                            <a href="#" style="color:#fff">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                My Account
                            </a>
                            <ul class="nav-dropdown-inner list-unstyled accnt-list" style="margin-top: -5px;">
                                <li> <a href="{{url('/client-dashboard')}}">My Dashboard</a></li>                                                
                                <li> <a href="{{url('/wishlist')}}">My Wish List</a></li>
                                <li> <a href="{{url('/client-order-history')}}">Order History</a></li>
                                <li> <a href="{{url('/order-track')}}">Order Tracking</a></li>
                                <li> <a href="{{url('/client-ondemand-history')}}">On Demand Query</a></li>
                                <li class="menu-item">
                                    <a  href="{{url('/client-logout')}}" data-toggle="modal">Sign Out</a>
                                </li>
                            </ul>
                            @endif

                        </li>

                        {{-- For 2nd phase development --}}


                        {{--<li class="nav-dropdown language-switcher">
                            <div style="color:#fff;">EN</div>
                            <ul class="nav-dropdown-inner list-unstyled list-lang">
                                <li><span class="current">EN</span></li>
                                <li><a title="Russian" href="#">RU</a></li>
                                <li><a title="France" href="#">FR</a></li>
                                <li><a title="Brazil" href="#">IT</a></li>                                
                            </ul>
                        </li>
                        <li class="nav-dropdown language-switcher">
                            <div style="color:#fff;"><span class="fa fa-dollar"></span></div>
                            <ul class="nav-dropdown-inner list-unstyled list-currency">
                                <li><span class="current"><span class="fa fa-dollar"></span>USD</span></li>
                                <li><a title="Euro" href="#"><span class="fa fa-eur"></span>Euro</a></li>
                                <li><a title="GBP" href="#"><span class="fa fa-gbp"></span>GBP</a></li>
                            </ul>
                        </li> --}}
                    </ul>                    
                </div>
            </div>
        </div>

        <div class="header-wrap mt--35" style="border-bottom: solid 1px #cacaca;">
            <div class="container theme-container reltv-div ">   
                <div class="row">
                    {{-- Logo section--}}
                    <div class="col-md-3 col-sm-3">
                        <div class="top-header pull-left">
                            <div class="logo-area">
                                <a href="{{url('/')}}" class="thm-logo fsz-10">
                                    <img src="{{asset('client/img/logo/dadavaai.png')}}" alt="Dadavaai" >
                                    <!-- <b class="bold-font-3 wht-clr"> Dadavaai </b> <span class="thm-clr funky-font"> bikes </span> -->
                                </a>
                            </div>                              
                        </div>
                    </div>
                    <!-- search box start -->
                    <div class="col-lg-5 col-md-6 col-sm-12 static-div">
                        <div class="top-search">
                            <div id="searchBox">
                                <form action="{{url('search-page')}}" method="GET">
                                    <div class="input-group">
                                        <select id="global-dropdown" class="cate-dropdown hidden-xs">
                                            <option value="{{url('/all-categories')}}">All Products</option>

                                            <option value="{{url('/offers-discount')}}">
                                                <a href="{{url('/offers-discount')}}">All Offers</a>
                                            </option>

                                            <option @if($service_subcategory) 
                                                        value="{{url('/product-by-subcategory/'.$service_subcategory->id.'/'.str_slug($service_subcategory->subCategoryName).'?category_id='.$service_subcategory->category->id.'&subcategory_id='.$service_subcategory->id)}}"
                                                    @else
                                                        value="{{url('#')}}"
                                                    @endif >
                                                <a href="{{url('#')}}">All Services</a>
                                            </option>

                                            <option value="{{url('/all-brands')}}">
                                                <a href="{{url('/all-brands')}}">All Brands</a>
                                            </option>
                                            @if ($ondemand_category)
                                                <option value="{{url('/product-by-category/'.$ondemand_category->id.'/'.str_slug($ondemand_category->categoryName).'?category_id='.$ondemand_category->id)}}">
                                                    <a href="{{url('#')}}">On Demand</a>
                                                </option>
                                            @endif


                                            <option value="{{url('/all-faqs')}}">
                                                <a href="{{url('/all-faqs')}}">Help</a>
                                            </option>

                                            <option value="{{url('/dadavaai-blogs')}}">
                                                <a href="{{url('/dadavaai-blogs')}}">Blogs</a>
                                            </option>
                                        </select>

                                        <input id="search" type="text" class="form-control" placeholder="Search" name="search" autocomplete="off" style="text-transform:unset">
                                        <button class="btn-search" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                                <div id="searchList" class="fade out" style="position:relative!importent;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- search box end -->
                    @php
                        $price = 0;
                        $total = 0;
                        $carts = \Illuminate\Support\Facades\Session::get('cart');
                        $service_carts = \Illuminate\Support\Facades\Session::get('service_cart');
                        $currentTime = \Carbon\Carbon::now()->format('d-m-Y');                        
                    @endphp
                    {{-- for product cart --}}
                    @if($carts)
                        @foreach ($carts as $CartProductForTotal)
                            @php
                                $product = \App\Product::find($CartProductForTotal['product_id']);

                                $salePrice  = $product->regularPrice;
                                $proPrice   = 0;
                                if($product->discount){
                                    
                                    if($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                        $proPrice = $salePrice-(($salePrice*($product->deal->discount_value + $product->discount))/100);
                                    else
                                        $proPrice = $salePrice-(($salePrice*$product->discount)/100);
                                }
                                else
                                {
                                    if($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                        $proPrice = $salePrice-(($salePrice*$product->deal->discount_value)/100);
                                    else
                                        $proPrice = $product->regularPrice;
                                }

                                if ($product->bundleOffers) {
                                    foreach ($product->bundleOffers as  $bundleOffer) {
                                        if ($CartProductForTotal['qty'] >= $bundleOffer->qty_start) {
                                            $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                                        }
                                    }
                                }

                                $unitPrice = $CartProductForTotal['qty'] * $proPrice;
                                $total += $unitPrice;
                                
                            @endphp 
                        @endforeach
                    @endif
                    {{-- for service cart --}}
                    @if($service_carts)
                        @foreach ($service_carts as $CartServiceForTotal)
                            @php
                                $service = \App\Service::find($CartServiceForTotal['service_id']);

                                $salePrice  = $service->regularPrice;
                                $proPrice   = 0;
                                if($service->discount){

                                    $proPrice = $salePrice-(($salePrice*$service->discount)/100);
                                }
                                else
                                {
                                    $proPrice = $service->regularPrice;
                                }


                                $unitPrice = $CartServiceForTotal['qty'] * $CartServiceForTotal['hour'] * $proPrice;
                                $total += $unitPrice;
                                
                            @endphp 
                        @endforeach
                    @endif
                    
                    {{-- cart --}}
                    <!-- <div class="col-md-3 col-sm-3" style="margin-top: 40px!important;"> -->
                    <div class="col-md-4 col-sm-3 left">
                        <span class="hidden-sm hidden-xs" style="margin-left:50px; display: -webkit-inline-box;">
                            <ul>
                                <li style="display: -webkit-inline-box; padding-top: 30px; ">
                                    <a href="{{url('/compare')}}">
                                        <img src="{{asset('client/img/extra/compare.png')}}" alt="" style="padding: 5px; border:solid 1px rgb(160, 160, 160); border-radius:50%;">
                                            {{-- <span style="position:absolute;
                                        background-color:#f28b00;
                                        top: 20px;
                                        left: 85px;
                                        text-align:center;
                                        width:20px;
                                        height:20px;
                                        line-height:18px;
                                        color:#f4f4f4;
                                        font-size:11px;
                                        border-radius:50%;">0</span> --}}
                                    </a>
                                    
                                    
                                </li>
                                <li style="display: -webkit-inline-box; padding-top: 30px; margin-left:20px;">
                                    @if(!Session::has('CLIENT_ID'))
                                        <a class="minicart-checkout" href="#login-popup" data-toggle="modal" data-placement="top">
                                            <i class="fa fa-heart" style="padding: 8px; border:solid 1px rgb(160, 160, 160); border-radius:50%;"></i>
                                            {{-- <img src="{{asset('client/img/extra/wishlist.png')}}" alt="" style="padding: 5px; border:solid 1px rgb(160, 160, 160); border-radius:50%;"> --}}
                                            
                                        </a>
                                    @else
                                        <a href="{{url('/wishlist')}}">
                                            <i class="fa fa-heart-o" style="padding: 8px; border:solid 1px rgb(160, 160, 160); border-radius:50%;"></i>
                                            {{-- <img src="{{asset('client/img/extra/wishlist.png')}}" alt="" style="padding: 5px; border:solid 1px rgb(160, 160, 160); border-radius:50%;"> --}}
                                            {{-- <span style="position:absolute;
                                                background-color:#f28b00;
                                                top: 20px;
                                                left: 145px;
                                                text-align:center;
                                                width:20px;
                                                height:20px;
                                                line-height:18px;
                                                color:#f4f4f4;
                                                font-size:11px;
                                                border-radius:50%;">0</span> --}}
                                        </a>
                                    @endif
                                    
                                    
                                </li>
                            </ul>
                        </span>
                        <!-- <span id="cartContent" class="cartContent" style="margin-left: 50%;"> -->
                        <span id="cartContent" class="cartContent">
                            <div class="top-cart-contain">
                                <div class="mini-cart">
                                    <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="#">
                                        <div class="cart-icon-style"><i class="fa fa-shopping-cart"></i></div>
                                        <div class="shoppingcart-inner hidden-xs">
                                            <span class="cart-total fsz-10">
                                                @if ($carts)
                                                    Item Qty: <span id="count">{{count($carts)}}</span><br><br>Total: Tk <span id="total">{{number_format($total,2)}}</span>
                                                @elseif ($service_carts)
                                                    Item Qty: <span id="count">{{count($service_carts)}}</span><br><br>Total: Tk <span id="total">{{number_format($total,2)}}</span>
                                                @else
                                                    Item Qty: <span id="count">0</span><br><br>Total: Tk <span id="total">0.00</span>
                                                @endif 
                                                
                                            </span>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div id="miniCartView" class="cartView" style="top: 50px;left: -100%;">
                                @if ($carts)
                                    {{-- cart item --}}
                                    <ul id="minicartHeader" class="product_list_widget list-unstyled">

                                        @foreach ($carts as $miniCartProduct)
                                            @php
                                                $product = \App\Product::find($miniCartProduct['product_id']);

                                                $salePrice  = $product->regularPrice;
                                                $proPrice   = 0;
                                                if($product->discount){
                                                    
                                                    if($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        $proPrice = $salePrice-(($salePrice*($product->deal->discount_value + $product->discount))/100);
                                                    else
                                                        $proPrice = $salePrice-(($salePrice*$product->discount)/100);
                                                }
                                                else
                                                {
                                                    if($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        $proPrice = $salePrice-(($salePrice*$product->deal->discount_value)/100);
                                                    else
                                                        $proPrice = $product->regularPrice;
                                                }

                                                if ($product->bundleOffers) {
                                                    foreach ($product->bundleOffers as  $bundleOffer) {
                                                        if ($miniCartProduct['qty'] >= $bundleOffer->qty_start) {
                                                            $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                                                        }
                                                    }
                                                }

                                                $unitPrice = $miniCartProduct['qty'] * $proPrice;
                                                $price += $unitPrice;
                                                
                                            @endphp                                        
                                            <li class="product-items" id="cartproduct{{$product->id}}" data-price="{{$proPrice}}" data-qty="{{$miniCartProduct['qty']}}">
                                                <div class="media clearfix">
                                                    <div class="media-lefta product-thumbnail">
                                                        <a href="{{url('product/'.$product->id.'/'.$product->slug)}}">
                                                            <img  src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="hoodie_5_front" />
                                                        </a>
                                                    </div>
                                                    <div class="media-body fsz-11">
                                                        <a class="fsz-11" href="{{url('product/'.$product->id.'/'.$product->slug)}}">
                                                            {{substr($product->productName,0,20)}}  
                                                        </a>
                                                        <span class="price"><span class="amount" style="font-size: 11px !important;">Tk {{number_format($unitPrice,2)}}</span></span>
                                                        Qty:  <span class="quantity" style="font-size: 11px !important;">{{$miniCartProduct['qty']}}</span>Pcs
                                                    </div>
                                                </div>

                                                <div class="product-remove">
                                                    <a href="#" class="btn-remove" id="cart-delete" data-id="{{$product->id}}" data-url="{{url('delete-cart')}}" data-price="{{$unitPrice}}"  title="Remove this item"><i class="fa fa-close"></i></a>				
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="cartActions">
                                        <span class="pull-left">Subtotal</span>

                                        <span class="pull-right"><span class="amount" id="subtotal">Tk {{number_format($price,2)}}</span></span>
                                        <div class="clearfix"></div>

                                        <div class="minicart-buttons">
                                            <div class="col-lg-6">
                                                <a href="{{url('cart')}}">Your Cart</a>
                                            </div>
                                            <div class="col-lg-6">
                                                @if(!Session::has('CLIENT_ID'))
                                                    <a class="minicart-checkout" href="#login-popup" data-toggle="modal" data-placement="top">Checkout</a>
                                                @else
                                                    <a href="{{url('/checkout')}}" class="minicart-checkout">Checkout</a>
                                                @endif
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                @elseif ($service_carts)
                                    {{-- cart item --}}
                                    <ul id="minicartHeader" class="product_list_widget list-unstyled">

                                        @foreach ($service_carts as $miniCartService)
                                            @php
                                                $service = \App\Service::find($miniCartService['service_id']);

                                                $salePrice  = $service->regularPrice;
                                                $proPrice   = 0;
                                                if($service->discount){
                                                    
                                                    $proPrice = $salePrice-(($salePrice*$service->discount)/100);
                                                }
                                                else
                                                {
                                                    $proPrice = $service->regularPrice;
                                                }

                                                $unitPrice = $miniCartService['qty'] * $proPrice;
                                                $price += $unitPrice;
                                                
                                            @endphp                                        
                                            <li class="product-items" id="cartservice{{$service->id}}" data-price="{{$proPrice}}" data-qty="{{$miniCartService['qty']}}">
                                                <div class="media clearfix">
                                                    <div class="media-lefta product-thumbnail">
                                                        <a href="{{url('service/'.$service->id.'/'.$service->slug)}}">
                                                            <img  src="{{asset('storage/images/service/'.$service->image)}}" alt="hoodie_5_front" />
                                                        </a>
                                                    </div>
                                                    <div class="media-body fsz-11">
                                                        <a class="fsz-11" href="{{url('service/'.$service->id.'/'.$service->slug)}}">
                                                            {{substr($service->serviceName,0,20)}}  
                                                        </a>
                                                        <span class="price"><span class="amount" style="font-size: 11px !important;">Tk {{number_format($unitPrice,2)}}</span></span>
                                                        Qty:  <span class="quantity" style="font-size: 11px !important;">{{$miniCartService['qty']}}</span>Pcs
                                                    </div>
                                                </div>

                                                <div class="product-remove">
                                                    <a href="#" class="btn-remove" id="cart-delete" data-id="{{$service->id}}" data-url="{{url('delete-service-cart')}}" data-price="{{$unitPrice}}"  title="Remove this item"><i class="fa fa-close"></i></a>				
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="cartActions">
                                        <span class="pull-left">Subtotal</span>

                                        <span class="pull-right"><span class="amount" id="subtotal">Tk {{number_format($price,2)}}</span></span>
                                        <div class="clearfix"></div>

                                        <div class="minicart-buttons">
                                            <div class="col-lg-6">
                                                <a href="{{url('service-cart')}}">Your Cart</a>
                                            </div>
                                            <div class="col-lg-6">
                                                @if(!Session::has('CLIENT_ID'))
                                                    <a class="minicart-checkout" href="#login-popup" data-toggle="modal" data-placement="top">Checkout</a>
                                                @else
                                                    <a href="{{url('/service-checkout')}}" class="minicart-checkout">Checkout</a>
                                                @endif
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>                                    
                                @else
                                    <p id="empty-cart" class="text-center alert alert-danger">Your cart is empty!</p>
                                @endif
                            </div>
                        </span>
                    </div>
                </div>
            </div>          
        </div>

        <div class="header-wrap" id="typo-sticky-header">
            <div class="container theme-container reltv-div">   
                <div class="pull-right header-search visible-xs">
                    <a id="open-popup-menu" class="nav-trigger header-link-search" href="javascript:void(0)" title="Menu">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="row">
                    <!-- All Categories -->
                    <div class="col-md-3 col-sm-3">
                        <div class="navigation pull-left">
                            <nav>                                                               
                                <div class="" id="primary-navigation">                                        
                                    <ul class="nav navbar-nav primary-navbar">
                                        <li class="dropdown mega-dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" style="margin-left: -220px;">
                                                <i class="fa fa-list-ul"></i>    
                                                <span class="">All Categories</span>
                                            </a>                                            
                                            <div class="dropdown-menu mega-dropdown-menu ">
                                                <div class="col-lg-12 col-md-12 col-sm-12 menu-block">
                                                    <div class="sub-list">                                                           
                                                        <ul>
                                                            @php
                                                                $i = 1.5;
                                                                $mirginTop = 20;
                                                            @endphp
                                                            @foreach ($categories as $category)
                                                                @if ($category->categoryName != "Service & Support")
                                                                    @php
                                                                        $cName = $category->categoryName;
                                                                        $on_demand = 'On Demand';
                                                                        if($cName == $on_demand){ 

                                                                    @endphp

                                                                    <li role="separator" class="divider"></li>

                                                                    @php
                                                                        }
                                                                    @endphp

                                                                    <li class="dropdown mega-dropdown category-link">

                                                                        <img src="{{asset('storage/images/category/'.$category->image_icon)}}" height="16px" width="16px" style="display: inline-block;">
                                                                        &nbsp;&nbsp;
                                                                        <a href="{{url('product-by-category/'.$category->id.'/'.str_slug($category->categoryName).'?category_id='.$category->id)}}" data-id="{{$category->id}}" dada-slug="{{str_slug($category->categoryName)}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" style="display: inline-block;">{{$category->categoryName}}</a>

                                                                        @if (count($category->subcategory)>0)
                                                                            <div class="dropdown-menu mega-dropdown-menu mega-styl2" style="margin-top:-{{$mirginTop * $i}}px; margin-left:50px; width:800px;">
                                                                                <div class="row">
                                                                                    @foreach ($category->subcategory as $subcategory)
                                                                                    @if (count($subcategory->minicategory)>0)
                                                                                        <div class="col-md-4 col-sm-4">
                                                                                            <div class="sub-list">                                                           
                                                                                                <h2 class="blk-clr title">                                                                
                                                                                                    <b class="extbold-font-4 fsz-16"> {{$subcategory->subCategoryName}} </b>
                                                                                                </h2>
                                                                                                <ul>
                                                                                                    @foreach ($subcategory->minicategory->take(3) as $minicategory)
                                                                                                        <li><a href="{{url('product-by-minicategory/'.$minicategory->id.'?category_id='.$category->id.'&subcategory_id='.$subcategory->id.'&minicategory_id='.$minicategory->id)}}"> {{$minicategory->miniCategoryName}} </a></li>
                                                                                                    @endforeach
                                                                                                    <li role="separator" class="divider"></li>
                                                                                                    <li><a href="{{url('product-by-subcategory/'.$subcategory->id.'/'.str_slug($subcategory->subCategoryName).'?category_id='.$category->id.'&subcategory_id='.$subcategory->id)}}"> View All  </a></li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </div>                                                         
                                                                            </div>
                                                                        @endif
                                                                    </li>
                                                                
                                                                @endif
                                                                @if($category->categoryName == "Service & Support")
                                                                    <li class="dropdown mega-dropdown category-link">

                                                                        <img src="{{asset('storage/images/category/'.$category->image_icon)}}" height="16px" width="16px" style="display: inline-block;">
                                                                        &nbsp;&nbsp;
                                                                        <a href="{{url('service-by-category/'.$category->id.'/'.str_slug($category->categoryName).'?category_id='.$category->id)}}" data-id="{{$category->id}}" dada-slug="{{str_slug($category->categoryName)}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" style="display: inline-block;">{{$category->categoryName}}</a>
                                                                        @if (count($category->subcategory)>0)
                                                                            <div class="dropdown-menu mega-dropdown-menu mega-styl2" style="margin-top:-{{$mirginTop * $i}}px; margin-left:50px; width:800px;">
                                                                                <div class="row">
                                                                                    @foreach ($category->subcategory as $subcategory)
                                                                                    @if (count($subcategory->minicategory)>0)
                                                                                        <div class="col-md-4 col-sm-4">
                                                                                            <div class="sub-list">                                                           
                                                                                                <h2 class="blk-clr title">                                                                
                                                                                                    <b class="extbold-font-4 fsz-16"> {{$subcategory->subCategoryName}} </b>
                                                                                                </h2>
                                                                                                <ul>
                                                                                                    @foreach ($subcategory->minicategory->take(3) as $minicategory)
                                                                                                        <li><a href="{{url('service-by-minicategory/'.$minicategory->id.'?category_id='.$category->id.'&subcategory_id='.$subcategory->id.'&minicategory_id='.$minicategory->id)}}"> {{$minicategory->miniCategoryName}} </a></li>
                                                                                                    @endforeach
                                                                                                    <li role="separator" class="divider"></li>
                                                                                                    <li><a href="{{url('service-by-subcategory/'.$subcategory->id.'/'.str_slug($subcategory->subCategoryName).'?category_id='.$category->id.'&subcategory_id='.$subcategory->id)}}"> View All  </a></li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </div>                                                         
                                                                            </div>
                                                                        @endif
                                                                    </li>  
                                                                @endif
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div> 
                                            </div>
                                        </li> 
                                    </ul>
                                </div>    

                            </nav>
                        </div>
                        <!-- <div class="top-header pull-left"></div>
                            <div class="logo-area" style="padding: 33px 0 !important;">
                                <i class="fa fa-list-ul"></i>    
                                <span class="categories-span">All Categories</span>
                            </div>                              
                        </div> -->
                    </div>

                    <!-- Navigation / Menu Bar -->
                    
                    <div class="col-md-9 col-sm-9 static-div">
                        <div class="navigation pull-left">
                            <nav>                                                               
                                <div class="" id="primary-navigation"> 
                                    @if ($bannerHeader)
                                        <ul class="nav navbar-nav primary-navbar">
                                            <li class="dropdown {{ Request::is('/') ? 'active' : '' }}">
                                                <a href="{{url('/')}}">Home</a>
                                            </li>
                                            {{-- Products  --}}
                                            <li class="dropdown mega-dropdown {{ Request::is('product-by-category*') ? 'active' : '' }} {{ Request::is('product-by-minicategory*') ? 'active' : '' }} {{ Request::is('product/*') ? 'active' : '' }}">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" >Products</a>                                            
                                                <div class="dropdown-menu mega-dropdown-menu mega-styl2"  style="background: white no-repeat url(/storage/images/banner/{{$bannerHeader->header_one}}) right 25px center; ">
                                                    <div class="col-sm-6 menu-block">
                                                        <div class="sub-list">                                                           
                                                            <ul>
                                                                @foreach ($categories as $menuCategory)
                                                                    <li ><a href="{{url('product-by-category/'.$menuCategory->id.'/'.str_slug($menuCategory->categoryName).'?category_id='.$menuCategory->id)}}"> {{$menuCategory->categoryName}} </a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>                                                   
                                                </div>
                                            </li> 
                                            {{-- brand --}}
                                            <li class="dropdown mega-dropdown {{ Request::is('*brand*') ? 'active' : '' }}">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" >Brands</a>                                            
                                                <div class="dropdown-menu mega-dropdown-menu pr" style="padding-right: unset;">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 menu-block" style="background: #f7f5f5; border-radius: 5px;">
                                                        <div class="sub-list mt-5" >                                                           
                                                            <ul>  
                                                                @foreach ($categories as $brandCategory)
                                                                    <li id="tonu" class="text-center mb-5" style="border: #999 1px solid; border-radius: 5px;">
                                                                        <a class="brandCategory" data-id="{{$brandCategory->id}}" href="{{url('/all-brands?category_id='.$brandCategory->id)}}"> {{$brandCategory->categoryName}} </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <div class="gst-promo-text text-center mb-5" style="position: relative;left: 27%; margin-top: -20px;">
                                                                <div>
                                                                    <div class="vertical-align-text">
                                                                        <a href="{{url('all-brands')}}" class="fancy-btn fancy-btn-small">All Brands </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-12 menu-block">
                                                        <span id="brandItem">
                                                            @foreach ($brands->take(18) as $brand)
                                                                <a href="{{url('product-by-brand/'.$brand->id.'/'.str_slug($brand->brandName))}}" class="">
                                                                    <div class="col-lg-2 col-md-3 col-sm-3 menu-block mb-3" style="padding: 5px;">
                                                                        <div class="sub-list text-center" style="height: 120px">
                                                                            <div class="menu-card" style="border: #999 1px solid; border-radius: 5px;">
                                                                                <img class="" src="{{asset('storage/images/brand/'.$brand->brandImage)}}" height="100%" width="100%" alt="{{$brand->brandName}}" style="padding: 10px;">
                                                                            </div>
                                                                            <div>
                                                                                <h5 class="fsz-10 mt-20">{{$brand->brandName}}</h5>
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                    </div> 
                                                                </a>
                                                            @endforeach                                                            
                                                        </span>
                                                        <span id="brandSort">
                                                            
                                                        </span>
                                                            {{-- <div class="col-lg-4 col-md-4 col-sm-6">
                                                                <img  src="{{asset('storage/images/banner/'.$bannerHeader->header_one)}}" alt="" srcset="" style="height: 280px;">
                                                                <br><br>
                                                                <div class="vertical-align-text">
                                                                    <a href="{{url('all-brands')}}" class="fancy-btn fancy-btn-small">View All </a>
                                                                </div>
                                                            </div> --}}
                                                    </div>
                                                    {{-- <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-6">
                                                            @foreach ($brands->take(11) as $brand)
                                                                <a href="{{url('product-by-brand/'.$brand->id.'/'.str_slug($brand->brandName))}}">
                                                                    <div class="col-lg-3 col-md-3 col-sm-3 menu-block">
                                                                        <div class="sub-list">
                                                                            <div class="menu-card">
                                                                                <img src="{{asset('storage/images/brand/'.$brand->brandImage)}}" height="100%" width="100%" alt="Avatar">
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                    </div> 
                                                                </a>
                                                            @endforeach
                                                            <div class="col-lg-3 col-md-3 col-sm-3 menu-block">
                                                                <div class="vertical-align-text">
                                                                    <a href="{{url('all-brands')}}" class="fancy-btn fancy-btn-small mt-30">View All </a>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </li> 


                                            {{-- offers(updated version) --}}
                                            <li class="dropdown mega-dropdown {{ Request::is('offer/*') ? 'active' : '' }}">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" >Offers</a>
                                                <div class="dropdown-menu mega-dropdown-menu pr" style="padding-right: unset;">
                                                    <div class="col-lg-2 col-md-3 col-sm-3 menu-block" style="background: #f7f5f5; border-radius: 5px;">
                                                        <div class="sub-list text-left">                                                           
                                                            <ul>  
                                                                <li id="deals"><a href="{{url("#")}}" style="color:red"> Deals </a></li>                                            
                                                                <li id="discounts"><a href="{{url("#")}}"> Discounts</a></li>
                                                                <li id="b1g1"><a href="{{url("#")}}"> Buy & Get </a></li>
                                                                <li id="combo"><a href="{{url("#")}}"> Combo </a></li>                                            
                                                                <li id="emi-offer"><a href="{{url("#")}}"> EMI Offers </a></li>  
                                                                <li role="separator" class="divider"></li>
                                                                <li id="close-on-today"><a href="{{url("#")}}"> Close On Today </a></li>
                                                                <li id="clearence"><a href="{{url("#")}}"> Clearance Sales</a></li>
                                                                <li role="separator" class="divider"></li>
                                                                <li id="bidding-section"><a href="{{url("#")}}"> Bidding Section </a></li> 
                                                                <li id="auction-section"><a href="{{url("#")}}"> Auction Section </a></li> 
                                                            </ul>

                                                        </div>
                                                        <div class="deal-button gst-promo-text text-center mb-5" style="position: relative; margin-top: -20px;">
                                                            <div>
                                                                <div class="vertical-align-text">
                                                                    <a href="{{url('/offers-deals')}}" class="fancy-btn fancy-btn-small">All Deals </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="discount-button gst-promo-text text-center mb-5 hide" style="position: relative; margin-top: -20px;">
                                                            <div>
                                                                <div class="vertical-align-text">
                                                                    <a href="{{url('/offers-discount')}}" class="fancy-btn fancy-btn-small">All Discount </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="buy_get-button gst-promo-text text-center mb-5 hide" style="position: relative; margin-top: -20px;">
                                                            <div>
                                                                <div class="vertical-align-text">
                                                                    <a href="{{url('/offers-buy-get')}}" class="fancy-btn fancy-btn-small">All Buy & Get </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="combo-button gst-promo-text text-center mb-5 hide" style="position: relative; margin-top: -20px;">
                                                            <div>
                                                                <div class="vertical-align-text">
                                                                    <a href="{{url('/offers-combo')}}" class="fancy-btn fancy-btn-small">All Combo </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearence_sale-button gst-promo-text text-center mb-5 hide" style="position: relative; margin-top: -20px;">
                                                            <div>
                                                                <div class="vertical-align-text">
                                                                    <a href="{{url('/offers-clearance')}}" class="fancy-btn fancy-btn-small">Clearence Sale </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-10 col-md-9 col-sm-9 menu-block">
                                                        <div id="deals-show">
                                                            <div class="row">
                                                                @foreach ($categories as $dealCategory)
                                                                    @php
                                                                        $products = \App\Product::with('deal')->where('deal_id', '!=', null)
                                                                                                    ->where('published', false)
                                                                                                    ->where('category_id', $dealCategory->id)
                                                                                                    ->take(4)->get();
                                                                    @endphp
                                                                    @if (count($products)>0)
                                                                        <div class="col-lg-3 col-md-3 col-sm-3 mb-6">
                                                                            <ul>
                                                                                <li class="blk-clr text-center">{{$dealCategory->categoryName}}</li>
                                                                                <li role="separator" class="divider"></li>
                                                                                @foreach ($products as $product)
                                                                                <a href="{{url('product/'.$product->id.'/'.$product->slug)}}">
                                                                                        <li>
                                                                                            <i class="fa fa-circle fsz-8" aria-hidden="true"></i> &nbsp;
                                                                                            <span class="fsz-12">
                                                                                                {{substr($product->productName, 0,15)}}..({{$product->deal->discount_value}}%)
                                                                                            </span>
                                                                                        </li>
                                                                                    </a>
                                                                                @endforeach
                                                                                {{-- <li role="separator" class="divider"></li> --}}
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-10 col-md-8 col-sm-8 col-lg-offset-1 col-md-offset-2">
                                                                    <img class="ml-10" src="{{url('/storage/images/banner/'.$bannerHeader->header_three)}}" alt="banner-category-page" width="100%;" height="100px;"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="discounts-show" class="hide">
                                                            <div class="row">
                                                                @foreach ($categories as $discountCategory)
                                                                    @php
                                                                        $products = \App\Product::where('discount', '!=', null)
                                                                                                    ->where('published', false)
                                                                                                    ->where('category_id', $discountCategory->id)
                                                                                                    ->take(4)->get();
                                                                    @endphp
                                                                    @if (count($products)>0)
                                                                        <div class="col-lg-3 col-md-3 col-sm-3 mb-6">
                                                                            <ul>
                                                                                <li class="blk-clr text-center">{{$discountCategory->categoryName}}</li>
                                                                                <li role="separator" class="divider"></li>
                                                                                @foreach ($products as $product)
                                                                                <a href="{{url('product/'.$product->id.'/'.$product->slug)}}">
                                                                                        <li>
                                                                                            <i class="fa fa-circle fsz-8" aria-hidden="true"></i> &nbsp;
                                                                                            <span class="fsz-12">
                                                                                                {{substr($product->productName, 0,15)}}..({{$product->discount}}%)
                                                                                            </span>
                                                                                        </li>
                                                                                    </a>
                                                                                @endforeach
                                                                                {{-- <li role="separator" class="divider"></li> --}}
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-10 col-md-8 col-sm-8 col-lg-offset-1 col-md-offset-2 ">
                                                                    <img class="ml-10" src="{{url('/storage/images/banner/'.$bannerHeader->header_three)}}" alt="banner-category-page" width="100%;" height="100px;"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="b1g1-show" class="hide">
                                                            <div class="row">
                                                                @foreach ($categories as $buyGetCategory)
                                                                    @php
                                                                        $products = \App\Product::where('buy_get', true)
                                                                                                    ->where('published', false)
                                                                                                    ->where('category_id', $buyGetCategory->id)
                                                                                                    ->take(4)->get();
                                                                    @endphp
                                                                    @if (count($products)>0)
                                                                        <div class="col-lg-3 col-md-3 col-sm-3 mb-6">
                                                                            <ul>
                                                                                <li class="blk-clr text-center">{{$buyGetCategory->categoryName}}</li>
                                                                                <li role="separator" class="divider"></li>
                                                                                @foreach ($products as $product)
                                                                                <a href="{{url('product/'.$product->id.'/'.$product->slug)}}">
                                                                                        <li>
                                                                                            <i class="fa fa-circle fsz-8" aria-hidden="true"></i> &nbsp;
                                                                                            <span class="fsz-12">
                                                                                                {{substr($product->productName, 0,15)}} (1:1)
                                                                                            </span>
                                                                                        </li>
                                                                                    </a>
                                                                                @endforeach
                                                                                {{-- <li role="separator" class="divider"></li> --}}
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-10 col-md-10 col-sm-8 col-lg-offset-1 col-md-offset-2">
                                                                    <img class="ml-10" src="{{url('/storage/images/banner/'.$bannerHeader->header_three)}}" alt="banner-category-page" width="100%;" height="100px;"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="combo-show" class="hide">
                                                            <div class="row">
                                                                @foreach ($categories as $comboCategory)
                                                                    @php
                                                                        $products = \App\Product::where('combo', true)
                                                                                                    ->where('published', false)
                                                                                                    ->where('category_id', $comboCategory->id)
                                                                                                    ->take(4)->get();
                                                                    @endphp
                                                                    @if (count($products)>0)
                                                                        <div class="col-lg-3 col-md-3 col-sm-3 mb-6">
                                                                            <ul>
                                                                                <li class="blk-clr text-center">{{$comboCategory->categoryName}}</li>
                                                                                <li role="separator" class="divider"></li>
                                                                                @foreach ($products as $product)
                                                                                <a href="{{url('product/'.$product->id.'/'.$product->slug)}}">
                                                                                        <li>
                                                                                            <i class="fa fa-circle fsz-8" aria-hidden="true"></i> &nbsp;
                                                                                            <span class="fsz-12">
                                                                                                {{substr($product->productName, 0,15)}}
                                                                                            </span>
                                                                                        </li>
                                                                                    </a>
                                                                                @endforeach
                                                                                {{-- <li role="separator" class="divider"></li> --}}
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-10 col-md-10 col-sm-8 col-lg-offset-1 col-md-offset-2">
                                                                    <img class="ml-10" src="{{url('/storage/images/banner/'.$bannerHeader->header_three)}}" alt="banner-category-page" width="100%;" height="100px;"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="emi-offer-show" class="hide">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="speacial-day">
                                                                        <ul>  
                                                                            <li><a href="{{url("#")}}"> Banks </a></li>  
                                                                            <li role="separator" class="divider"></li>                                          
                                                                            <li><a href="{{url("#")}}"> Partner</a></li>
                                                                            <li role="separator" class="divider"></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="row">
                                                                        <ul>  
                                                                            <li><a href="{{url("#")}}"> Banks Name </a></li>  
                                                                            <li role="separator" class="divider"></li>
                                                                            <li><a href="{{url("#")}}"> City bank </a></li>  
                                                                            <li><a href="{{url("#")}}"> Basic bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Southeast bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Brac bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Dutch bangla bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Jamuna  bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Pubali bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Estern bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Sonali bank</a></li>
                                                                            <li><a href="{{url("#")}}"> National bank</a></li>

                                                                        </ul>
                                                                        <ul class="hide">  
                                                                            <li><a href="{{url("#")}}"> Partners Name </a></li>  
                                                                            <li role="separator" class="divider"></li>
                                                                            <li><a href="{{url("#")}}"> City bank </a></li>  
                                                                            <li><a href="{{url("#")}}"> Basic bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Southeast bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Brac bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Dutch bangla bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Jamuna  bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Pubali bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Estern bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Sonali bank</a></li>
                                                                            <li><a href="{{url("#")}}"> National bank</a></li>

                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="close-on-today-show" class="hide">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <img src="{{asset('client/img/banner/comingsoon.png')}}" alt="" style="padding:5px; height:355px; width:100%;"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="clearence-show" class="hide">
                                                            <div class="row">
                                                                @foreach ($categories as $clearenceSale)
                                                                    @php
                                                                        $products = \App\Product::where('clearance', true)
                                                                                                    ->where('published', false)
                                                                                                    ->where('category_id', $clearenceSale->id)
                                                                                                    ->take(4)->get();
                                                                    @endphp
                                                                    @if (count($products)>0)
                                                                        <div class="col-lg-3 col-md-3 col-sm-3 mb-6">
                                                                            <ul>
                                                                                <li class="blk-clr text-center">{{$clearenceSale->categoryName}}</li>
                                                                                <li role="separator" class="divider"></li>
                                                                                @foreach ($products as $product)
                                                                                <a href="{{url('product/'.$product->id.'/'.$product->slug)}}">
                                                                                        <li>
                                                                                            <i class="fa fa-circle fsz-8" aria-hidden="true"></i> &nbsp;
                                                                                            <span class="fsz-12">
                                                                                                {{substr($product->productName, 0,15)}}
                                                                                            </span>
                                                                                        </li>
                                                                                    </a>
                                                                                @endforeach
                                                                                {{-- <li role="separator" class="divider"></li> --}}
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            {{-- <br>
                                                            <div class="row">
                                                                <div class="col-lg-10 col-md-8 col-sm-8 col-lg-offset-1 col-md-offset-2">
                                                                    <img class="ml-10" src="{{url('/storage/images/banner/'.$bannerHeader->header_three)}}" alt="banner-category-page" width="100%;" height="100px;"/>
                                                                </div>
                                                            </div> --}}                                                   
                                                        </div>
                                                        <div id="bidding-section-show" class="hide">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <img src="{{asset('client/img/banner/comingsoon.png')}}" alt="" style="padding:5px; height:355px; width:100%;"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="auction-section-show" class="hide">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <img src="{{asset('client/img/banner/comingsoon.png')}}" alt="" style="padding:5px; height:355px; width:100%;"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            {{-- offers (old style) --}}
                                            {{-- <li class="dropdown mega-dropdown {{ Request::is('offer/*') ? 'active' : '' }}">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" >Offers</a>
                                                <div class="dropdown-menu mega-dropdown-menu pr"  style="background: white no-repeat url(/storage/images/banner/{{$bannerHeader->header_two}}) right top; ">
                                                    <div class="col-md-3 col-sm-3 menu-block" style="background: #f7f5f5; border-radius: 5px;">
                                                        <div class="sub-list">                                                           
                                                            <ul>  
                                                                <li id="deals"><a href="{{url("#")}}" style="color:red"> Deals </a></li>                                            
                                                                <li id="discounts"><a href="{{url("#")}}"> Discounts</a></li>
                                                                <li id="b1g1"><a href="{{url("#")}}"> Buy & Get </a></li>                                            
                                                                <li id="emi-offer"><a href="{{url("#")}}"> EMI Offers </a></li>  
                                                                <li role="separator" class="divider"></li>
                                                                <li id="close-on-today"><a href="{{url("#")}}"> Close On Today </a></li>
                                                                <li id="clearence"><a href="{{url("#")}}"> Clearance Sales</a></li>
                                                                <li role="separator" class="divider"></li>
                                                                <li id="bidding-section"><a href="{{url("#")}}"> Bidding Section </a></li> 
                                                                <li id="auction-section"><a href="{{url("#")}}"> Auction Section </a></li> 
                                                            </ul>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-8 col-sm-8 menu-block">                                                
                                                        <div id="deals-show">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-8">
                                                                    @if ($topDeals)
                                                                        @foreach ($topDeals->products->where('published', false)->take(1) as $topDealProduct)
                                                                        <a href="{{url('product/'.$topDealProduct->id.'/'.$topDealProduct->slug)}}">
                                                                            <div class="icon-sale-label sale-left">
                                                                                Get {{$topDeals->discount_value}}% on Tk {{number_format($topDealProduct->regularPrice, 2)}}
                                                                            </div>
                                                                            <img src="{{asset('storage/images/product/'.$topDealProduct->image->image1)}}" alt="" style="padding:0px; height:230px; width: 250px;"/>
                                                                        </a>
                                                                        @endforeach
                                                                    @endif                               
                                                                </div>
                                                                <div class="col-md-6 col-sm-8">
                                                                    @foreach ($navDeals as $navDeal)
                                                                        @foreach ($navDeal->products->where('published', false)->random(1) as $navDealProduct)
                                                                            <a href="{{url('product/'.$navDealProduct->id.'/'.$navDealProduct->slug)}}">
                                                                                <div class="icon-sale-label sale-left">
                                                                                    {{$navDeal->discount_value}}%
                                                                                </div>
                                                                                <img src="{{asset('storage/images/product/'.$navDealProduct->image->image1)}}" alt="" style="padding:0px; height:230px; width: 250px;"/>
                                                                            </a>
                                                                        @endforeach
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-8">
                                                                    <img class="" src="{{url('/storage/images/banner/'.$bannerHeader->header_three)}}" alt="banner-category-page" width="550px;" height="100px;"/>
                                                                    <div class="gst-promo-text" style="left:unset; right:38px;top:33%;">
                                                                        <div>
                                                                            <div class="vertical-align-text">
                                                                                <a href="{{url('/'.$bannerHeader->header_three_link)}}" class="fancy-btn fancy-btn-small">Deals </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="discounts-show" class="hide">
                                                            <div class="row">
                                                                <div class="col-md-4 col-sm-4">
                                                                    <div class=" speacial-day">                                                           
                                                                        <h2 class="blk-clr title" style="margin-top:-10px;">                                                                
                                                                            <span class="thm-clr funky-font fsz-25"> Discount </span>
                                                                        </h2>
                                                                        <ul>  
                                                                            <li><a href="{{url("offers-promotion")}}"> Promotion </a></li>
                                                                            <li role="separator" class="divider"></li>                                            
                                                                            <li><a href="{{url("offers-occasion")}}"> Occation </a></li>
                                                                            <li role="separator" class="divider"></li>                                            
                                                                            <li><a href="{{url("offers-clearance")}}"> Clearance </a></li> 
                                                                            <li role="separator" class="divider"></li> 
                                                                        </ul>
                                                                        <div class="vertical-align-text">
                                                                            <a href="{{url('offers')}}" class="fancy-btn fancy-btn-small" style="text-transform: unset;">All Discounts </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4">
                                                                    <div class="row">
                                                                        @foreach ($topDiscount->take(1) as $topDiscountProduct)
                                                                            <div class="col-md-12 col-sm-12" style="padding:5px;">
                                                                                <a href="{{url('product/'.$topDiscountProduct->id.'/'.$topDiscountProduct->slug)}}">
                                                                                    <div class="icon-sale-label sale-left" style="top:5px">
                                                                                        {{$topDiscountProduct->discount}}%
                                                                                    </div>
                                                                                    <img src="{{asset('storage/images/product/'.$topDiscountProduct->image->image1)}}" alt="" style="height:200px; width:200px"/>
                                                                                </a>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4">
                                                                    <div class="row">
                                                                        @foreach ($discounts as $discountProduct)
                                                                            <div class="col-md-12 col-sm-12" style="padding:5px;">
                                                                                <a href="{{url('product/'.$discountProduct->id.'/'.$discountProduct->slug)}}">
                                                                                    <div class="icon-sale-label sale-left" style="top:5px">
                                                                                        {{$discountProduct->discount}}%
                                                                                    </div>
                                                                                    <img src="{{asset('storage/images/product/'.$discountProduct->image->image1)}}" alt="" style="height:200px; width:200px"/>
                                                                                    
                                                                                </a>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-8" style="padding: 3px;">
                                                                    <img class="" src="{{url('/storage/images/banner/'.$bannerHeader->header_three)}}" alt="banner-category-page" width="100%" height="135px"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="b1g1-show" class="hide">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-6">
                                                                    <div class="row">

                                                                    @foreach ($b1g1->take(4) as $b1g1Product)
                                                                            <div class="col-md-6 col-sm-6" >
                                                                                <a href="{{url('product/'.$b1g1Product->id.'/'.$b1g1Product->slug)}}">
                                                                                    <div class="icon-sale-label sale-center">
                                                                                        Buy 1 Get 1
                                                                                    </div>
                                                                                    <img src="{{asset('storage/images/product/'.$b1g1Product->image->image1)}}" alt="" style="padding:5px; height:180px;width:100%;"/>
                                                                                </a>
                                                                            </div>
                                                                    @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="emi-offer-show" class="hide">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="speacial-day">
                                                                        <ul>  
                                                                            <li><a href="{{url("#")}}"> Banks </a></li>  
                                                                            <li role="separator" class="divider"></li>                                          
                                                                            <li><a href="{{url("#")}}"> Partner</a></li>
                                                                            <li role="separator" class="divider"></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="row">
                                                                        <ul>  
                                                                            <li><a href="{{url("#")}}"> Banks Name </a></li>  
                                                                            <li role="separator" class="divider"></li>
                                                                            <li><a href="{{url("#")}}"> City bank </a></li>  
                                                                            <li><a href="{{url("#")}}"> Basic bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Southeast bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Brac bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Dutch bangla bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Jamuna  bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Pubali bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Estern bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Sonali bank</a></li>
                                                                            <li><a href="{{url("#")}}"> National bank</a></li>

                                                                        </ul>
                                                                        <ul class="hide">  
                                                                            <li><a href="{{url("#")}}"> Partners Name </a></li>  
                                                                            <li role="separator" class="divider"></li>
                                                                            <li><a href="{{url("#")}}"> City bank </a></li>  
                                                                            <li><a href="{{url("#")}}"> Basic bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Southeast bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Brac bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Dutch bangla bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Jamuna  bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Pubali bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Estern bank</a></li>
                                                                            <li><a href="{{url("#")}}"> Sonali bank</a></li>
                                                                            <li><a href="{{url("#")}}"> National bank</a></li>

                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="close-on-today-show" class="hide">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <img src="{{asset('client/img/banner/comingsoon.png')}}" alt="" style="padding:5px; height:355px; width:100%;"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="clearence-show" class="hide">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <img src="{{asset('client/img/banner/comingsoon.png')}}" alt="" style="padding:5px; height:355px; width:100%;"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="bidding-section-show" class="hide">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <img src="{{asset('client/img/banner/comingsoon.png')}}" alt="" style="padding:5px; height:355px; width:100%;"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="auction-section-show" class="hide">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <img src="{{asset('client/img/banner/comingsoon.png')}}" alt="" style="padding:5px; height:355px; width:100%;"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> --}}

                                            {{-- help --}}
                                            <li class="dropdown {{ Request::is('contact-form') ? 'active' : '' }} {{ Request::is('all-faqs') ? 'active' : '' }} {{ Request::is('about') ? 'active' : '' }} {{ Request::is('terms-policies') ? 'active' : '' }}">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" >Help</a>
                                                <ul class="dropdown-menu">  
                                                    <li><a href="{{url('order-track')}}"> Track Order </a></li> 
                                                    <li><a href="{{url('compare')}}"> My Comapres  </a></li> 
                                                    <li role="separator" class="divider"></li>                                           
                                                    <li><a href="{{url('all-faqs')}}"> Help & FAQ</a></li>
                                                    <li><a href="{{url('terms-policies')}}"> Terms & Policies  </a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="{{url('contact-form')}}"> Contact Us  </a></li>      
                                                    <li><a href="{{url('about')}}"> About Us  </a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown {{ Request::is('dadavaai-blog*') ? 'active' : '' }}">
                                                <a href="{{url('dadavaai-blogs')}}" target="_blank"> Blogs  </a>
                                            </li>                                            
                                            {{-- My account visible for sm device--}}
                                            <li class="dropdown hidden-lg hidden-md">
                                                @if(!Session::has('CLIENT_ID'))
                                                <a class="wht-clr" href="{{url('client-login-register')}}">Login/Registration</a>
                                                <ul class="dropdown-menu list-unstyled accnt-list">
                                                    <li class="menu-item">
                                                        <a  href="#login-popup" data-toggle="modal">sign in/ Sign up</a>
                                                    </li>
                                                    <li> <a href="{{url('#')}}">Forgot Password</a></li>
                                                </ul>
                                                @else
                                                <a class="wht-clr" href="{{url('/client-dashboard')}}">My Account</a>
                                                <ul class="dropdown-menu list-unstyled accnt-list">
                                                    <li class="menu-item">
                                                        <a  href="{{url('/client-logout')}}" data-toggle="modal">Logout</a>
                                                    </li>
                                                    <li> <a href="{{url('/client-dashboard')}}">My Account</a></li>                                                
                                                    <li> <a href="{{url('/client-address')}}">Address Books</a></li>
                                                    <li> <a href="{{url('/wishlist')}}">Wishlist</a></li>
                                                    <li> <a href="{{url('/client-order-history')}}">Order History</a></li>
                                                </ul>
                                                @endif
                        
                                            </li>
                                            <li class="stickyCart dropdown hidden-sm hidden-xs hide">
                                                <!-- <span id="cartContent" class="cartContent" style="margin-left: 50%;"> -->
                                                <span id="cartContent" class="cartContent">
                                                    <div class="top-cart-contain" style="margin-top: 10px !important;">
                                                        <div class="mini-cart">
                                                            <div id="toTopShuvo" data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="#">
                                                                <div class="cart-icon-style"><i class="fa fa-shopping-cart"></i></div>
                                                                <div class="shoppingcart-inner hidden-xs">
                                                                    {{-- <span class="cart-title">Shopping Cart</span> --}} 
                                                                    <span class="cart-total fsz-8">
                                                                        @if ($carts)
                                                                            Item Qty: <span id="count">{{count($carts)}}</span> <br><br> Total: Tk <span id="total">{{number_format($total,2)}}</span>
                                                                        @elseif ($service_carts)
                                                                            Item Qty: <span id="count">{{count($service_carts)}}</span> <br><br> Total: Tk <span id="total">{{number_format($total,2)}}</span>
                                                                        @else
                                                                            Item Qty: <span id="count">0</span> <br><br> Total: Tk <span id="total">0.00</span>
                                                                        @endif 
                                                                    </span>
                                                                </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                {{--<div id="stickyMiniCartView" class="cartView" style="top: 80px;left: -100px;">
                                                        @if ($carts)
                                                            <ul id="minicartHeader" class="product_list_widget list-unstyled">

                                                                @foreach ($carts as $miniCartProduct)
                                                                    @php
                                                                        $product = \App\Product::find($miniCartProduct['product_id']);

                                                                        $salePrice  = $product->regularPrice;
                                                                        $proPrice   = 0;
                                                                        if($product->discount){
                                                                            
                                                                            if($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                                $proPrice = $salePrice-(($salePrice*($product->deal->discount_value + $product->discount))/100);
                                                                            else
                                                                                $proPrice = $salePrice-(($salePrice*$product->discount)/100);
                                                                        }
                                                                        else
                                                                        {
                                                                            if($product->deal_id && $product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                                                $proPrice = $salePrice-(($salePrice*$product->deal->discount_value)/100);
                                                                            else
                                                                                $proPrice = $product->regularPrice;
                                                                        }

                                                                        $unitPrice = $miniCartProduct['qty'] * $proPrice;
                                                                        $price += $unitPrice;
                                                                        
                                                                    @endphp                                        
                                                                    <li class="product-items" id="cartproduct{{$product->id}}" data-price="{{$proPrice}}" data-qty="{{$miniCartProduct['qty']}}">
                                                                        <div class="media clearfix">
                                                                            <div class="media-lefta product-thumbnail">
                                                                                <a href="{{url('product/'.$product->id.'/'.$product->slug)}}">
                                                                                    <img  src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="hoodie_5_front" />
                                                                                </a>
                                                                            </div>
                                                                            <div class="media-body fsz-10">
                                                                                <a class="fsz-10" href="{{url('product/'.$product->id.'/'.$product->slug)}}">
                                                                                    {{substr(strip_tags($product->productName), 0, 20)}}  
                                                                                </a>
                                                                                <span class="price"><span class="amount" style="font-size: 10px !important;">Tk {{number_format($unitPrice,2)}}</span></span>
                                                                                Qty:  <span class="quantity" style="font-size: 10px !important;">{{$miniCartProduct['qty']}}</span>Pcs
                                                                            </div>
                                                                        </div>

                                                                        <div class="product-remove">
                                                                            <a href="#" id="cart-delete" data-id="{{$product->id}}" data-url="{{url('delete-cart')}}" data-price="{{$unitPrice}}" class="btn-remove" title="Remove this item"><i class="fa fa-close"></i></a>               
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>

                                                            <div class="cartActions">
                                                                <span class="pull-left">Subtotal</span>

                                                                <span class="pull-right"><span class="amount" id="subtotal">Tk {{number_format($price,0)}}</span></span>
                                                                <div class="clearfix"></div>

                                                                <div class="minicart-buttons">
                                                                    <div class="col-lg-6">
                                                                        <a href="{{url('cart')}}">Your Cart</a>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <a href="{{url('/checkout')}}" class="minicart-checkout">Checkout</a>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </div>                                    
                                                        @else
                                                            <p id="empty-cart" class="text-center alert alert-danger">Your cart is empty!</p>
                                                        @endif
                                                    </div> --}}
                                                </span> 
                        
                                            </li>

                                        </ul>
                                    @endif                                       
                                </div>   
                            </nav>
                        </div>
                        
                        {{-- <div class="pull-right srch-box hidden-lg">
                            <a id="open-popup-search" class="header-link-search" href="javascript:void(0)" title="Search">
                                <i class="fa fa-search"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>          
        </div>
    </header>
    <!-- / HEADER -->
        @include('inc.message')
        @yield('content')

    {{-- chat --}}
    
{{--         <div class="container pull-right" id="chatbox">
            <div class="row chat-window col-xs-5 col-md-3 pull-right" id="chat_window_1">
                <div class="col-xs-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading top-bar">
                            <div class="col-md-8 col-xs-8">
                                <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;&nbsp; Message </h3>
                            </div>
                            <div class="col-md-4 col-xs-4" style="text-align: right;">
                                <a href="#"><span id="minim_chat_window" class="glyphicon icon_minim panel-collapsed glyphicon-plus"></span></a>
                                <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                            </div>
                        </div>

                        <div id="messagebody" class="panel-body msg_container_base">
                            @if(!Session::has('CLIENT_ID'))
                                <div class="row msg_container" style="justify-content: center;">
                                    <a href="#login-popup" data-toggle="modal"> Login </a>
                                </div>
                            @else
                                @php
                                    $messages =  \App\Message::where('client_id', Session::get('CLIENT_ID'))->orderBy('created_at', 'asc')->get();
                                @endphp
                                @if(count($messages)>0)
                                    @foreach($messages as $message)
                                        @if($message->owner == 1)
                                            <div class="row msg_container base_sent">
                                                <div class="col-md-10 col-xs-10">
                                                    <div class="messages msg_sent">
                                                        <p>{{$message->message}}</p>
                                                        <time datetime="2009-11-13T20:00"> • {{$message->created_at->format('F j,Y h:i')}}</time>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($message->owner == 0)
                                            <div class="row msg_container base_receive">
                                                <div class="col-md-2 col-xs-2 avatar">
                                                    <img src="{{url('client/img/extra/avatar5.png')}}" class="chatimg img-responsive ">
                                                </div>
                                                <div class="col-md-10 col-xs-10">
                                                    <div class="messages msg_receive">
                                                        <p>{{$message->message}}</p>
                                                        <time datetime="2009-11-13T20:00">Admin • {{$message->created_at->format('F j,Y h:i')}}</time>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="row msg_container" style="justify-content: center;">
                                        <p> start a new conversation </p>
                                    </div>
                                @endif
                            @endif
                        </div>
                        @if(Session::has('CLIENT_ID'))
                            <div class="panel-footer hide">
                                <div class="input-group">
                                    <input id="btn-input" type="text" class="form-control input-sm chat_input" style="color: white;" placeholder="Write your message here..." required="required" />
                                    <span class="input-group-btn">
                                    <button class="btn btn-primary btn-sm" id="btn-chat">Send</button>
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>


                </div>
            </div>
        </div>
 --}}

    {{-- /chat --}}    

@if ($siteInfos)
    <!-- FOOTER -->
    <footer class="site-footer clearfix" style="border-top:#979797 1px solid">
        <div class="site-main-footer container theme-container">
            <div class="row">
                <div class="col-md-3 col-sm-6 clearfix">
                    <section class="widget footer-widget widget_text clearfix">
                        <div class="textwidget">
                            <div class="top-header">
                                <div class="logo-area">
                                    <a href="{{url('/')}}" class="thm-logo fsz-10">
                                        <img src="{{asset('client/img/logo/dadavaai.png')}}" alt="Dadavaai" style="margin-left: -30px;">
                                    </a>
                                </div>                              
                            </div>
                            <div class="author-info-social">
                                <a class="goshop-share rcc-google" href="{{$siteInfos->googleplus}}" rel="nofollow" target="_blank">
                                    <i class="fa fa-google-plus red-clr"></i>
                                </a>
                                <a class="goshop-share rcc-twitter" href="{{$siteInfos->twitter}}" rel="nofollow" target="_blank">
                                    <i class="fa fa-twitter red-clr"></i>
                                </a>
                                <a class="goshop-share rcc-facebook" href="{{$siteInfos->facebook}}" rel="nofollow" target="_blank">
                                    <i class="fa fa-facebook red-clr"></i>
                                </a>
                                <a class="goshop-share rcc-linkedin" href="{{$siteInfos->linkedin}}" rel="nofollow" target="_blank">
                                    <i class="fa fa-linkedin red-clr"></i>
                                </a>
                            </div>
                        </div>
                        {{-- <h6 class="" style="margin:2px 0px 2px 0px;">Newsletter</h6> --}}
                        <div class="textwidget" style="width: 80%;">
                            <form action="{{url('subscribes')}}" method="POST" class="mc4wp-form">
                                {{ csrf_field() }}
                                <p>
                                    <label>Email address: </label>
                                    <input class="fsz-11" type="email" name="email" placeholder="subcribe for newsletter by email" required />
                                </p>
                                <p>
                                    <button class="submit"> <i class="fa fa-envelope-o"></i> </button>                                      
                                </p>
                            </form>
                        </div>
                    </section>
                </div>
                <div class="col-md-9 col-sm-9 clearfix">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 clearfix">
                            <section class="widget footer-widget widget_nav_menu clearfix">
                                <h6 class="widget-title" style="font-size: 12px !important;"> My Account Services</h6>
                                <ul class="fsz-12">
                                    @if(!Session::has('CLIENT_ID'))
                                        <li class="menu-item">
                                            <a  href="#login-popup" data-toggle="modal">Sign In / Sign Up</a>
                                        </li>
                                    @else
                                        <li class="menu-item"> <a href="{{url('client-dashboard')}}">My Account</a></li>                                                
                                        {{-- <li class="menu-item"> <a href="{{url('client-order-history')}}">Order History</a></li> --}}
                                    @endif
                                    <li class="menu-item"><a href="{{url('order-track')}}">Track My Order</a></li>
                                    <li class="menu-item"><a href="{{url('#')}}">Ask for Promo Code</a></li>
                                    <li class="menu-item"><a href="{{url('#')}}">Reedem My Points</a></li>
                                </ul>

                            </section>
                        </div>
        
                        <div class="col-md-4 col-sm-6 clearfix">
                            <section id="nav_menu-3" class="widget footer-widget widget_nav_menu clearfix">
                                <h6 class="widget-title" style="font-size: 12px !important;">Our Services</h6>
                                <ul class="fsz-12">
                                    <li class="menu-item"><a href="#">On Demand Query / Order</a></li>
                                    <li class="menu-item"><a href="#">Auction / Bidding</a></li>
                                    <li class="menu-item"><a href="#">Internation Shipment</a></li>
                                    <li class="menu-item"><a href="#">On Demand Service</a></li>
                                </ul>
                            </section>
                        </div>
        
                        <div class="col-md-4 col-sm-6 clearfix">
                            <section id="nav_menu-3" class="widget footer-widget widget_nav_menu clearfix">
                                <h6 class="widget-title" style="font-size: 12px !important;">Help & Support</h6>
                                <ul class="fsz-12">
                                    <li class="menu-item"><a href="{{url('contact-form')}}">Contact Us</a></li>
                                    <li class="menu-item"><a href="{{url('terms-policies')}}">Terms & Policy</a></li>
                                    <li class="menu-item"><a href="{{url('all-faqs')}}">FAQ</a></li>
                                    <li class="menu-item"><a href="{{url('dadavaai-blogs')}}" target="_blank">Blog</a></li>
                                </ul>
                            </section>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12" style="padding:unset;">
                            <a target="_blank" href="https://www.sslcommerz.com/" title="SSLCommerz" alt="SSLCommerz"><img style="width:100%;height:auto;" src="https://securepay.sslcommerz.com/public/image/SSLCommerz-Pay-With-logo-All-Size-03.png" /></a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-12 col-sm-12" style="padding:unset;">
                    <a target="_blank" href="https://www.sslcommerz.com/" title="SSLCommerz" alt="SSLCommerz"><img style="width:100%;height:auto;" src="https://securepay.sslcommerz.com/public/image/SSLCommerz-Pay-With-logo-All-Size-03.png" /></a>
                </div>
            </div> --}}
        </div>

        <div class="subfooter text-center">
            <div class="container theme-container">
                <p>Copyright &copy; <a href="#" class="thm-clr" style="pointer-events:none;"> {{$siteInfos->copyright}}</a></p>
                <p>
                    <a style="color:#fff">Visitors :</a>
                    <!-- Default Statcounter code for eCommerce http://dadavaai.com/ -->
                    <script type="text/javascript">
                    var sc_project=12348525; 
                    var sc_invisible=0; 
                    var sc_security="bc291f80"; 
                    var sc_https=1; 
                    var scJsHost = "https://";
                    document.write("<sc"+"ript type='text/javascript' src='" + scJsHost+
                    "statcounter.com/counter/counter.js'></"+"script>");
                    </script>
                    <noscript><div class="statcounter"><a title="Web Analytics"
                    href="https://statcounter.com/" target="_blank"><img class="statcounter"
                    src="https://c.statcounter.com/12348525/0/bc291f80/0/" alt="Web
                    Analytics"></a></div></noscript>
                    <!-- End of Statcounter Code -->
                    {{-- <a href="https://statcounter.com/p12348525/?guest=1">View My Stats</a> --}}

                    <!--END Default Statcounter code for eCommerce http://dadavaai.com/ -->

                </p>
            </div>
        </div>
    </footer>
    <!-- / FOOTER -->    
@endif

    <!-- Subscribe Popup 1 -->
{{--     <section class="subscribe-me">
        <a href="#close" class="sb-close-btn close popup-cls"><i class="fa-times fa"></i></a>      
        <div class="modal-content subscribe-1 wht-clr">   
            <div class="login-wrap text-center">                        
                <h2 class="fsz-35 spcbtm-15"> <span class="bold-font-3 wht-clr">Dadavaai</span> <span class="thm-clr funky-font">bikes</span> </h2>
                <h2 class="sec-title fsz-50">NEWSLETTER</h2>
                <h3 class="fsz-15 bold-font-4"> Did you know that we ship to over <span class="thm-clr"> 24 different countries </span> </h3>

                <div class="login-form spctop-30"> 
                    <form class="subscribe">
                        <div class="form-group"><input type="text" placeholder="Enter your name" class="form-control"></div>
                        <div class="form-group"><input type="text" placeholder="Enter your email address" class="form-control"></div>
                        <div class="form-group">
                            <button class="alt fancy-button" type="submit"> <span class="fa fa-envelope"></span> Subscribe </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
 --}}    <!-- / Subscribe Popup 1 -->

    <!-- Product Preview Popup -->
    <section class="modal fade" id="product-preview" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg product-modal">
            <button class="close close-btn popup-cls" aria-label="Close" data-dismiss="modal" type="button">
                <i class="fa-times fa"></i>
            </button>
            <div class="modal-content single-product">
                <div class="diblock">
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div id="">
                            {{-- <a class="rsImg" href="{{asset('client/img/products/single-1.jpg')}}" data-rsw="500" data-rsh="500">
                            </a> --}}
                            
                            <img id="img" src="{{asset('client/img/products/single-1.jpg')}}" alt="">
                        </div>
                    </div>
                    <div class="spc-15 hidden-lg clear"></div>
                    <div class=" col-sm-12 col-lg-6 col-xs-12">
                        <div class="summary entry-summary">
                            <div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                {{-- <div class="rating"> 
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>                                           
                                    <span class="star active"></span>
                                    <span class="star half"></span>
                                </div> --}}
                                <div>
                                    <p class="font-3 fsz-18 no-mrgn price"> 
                                        <span id="sale"  class="thm-clr"></span>    
                                        <span id="regular"  class="thm-clr line-through"></span>  
                                    </p> 
                                </div>


                                <div  class="posted_in">
                                    <h3 class="funky-font-2 fsz-20 category">Women Collection</h3>
                                </div>
                            </div>

                            <div class="product_title_wrapper">
                                <div id="name" itemprop="name" class="product_title entry-title">
                                    Flusas Denim 
                                    {{-- <p class="font-3 fsz-18 no-mrgn price"> 
                                        <span  class="thm-clr"> $990</span>    
                                        <span  class="thm-clr line-through"> $1000</span>  
                                    </p>        --}}
                                </div>
                            </div>

                            <div itemprop="description" class="fsz-15">
                                <p class="quick-desc">Qossi is an emerging company and dedicated to making high quality bags and fashions.Qossi designers are internationally renowned designers,having participated in many international fashion designing contests,and perform outstandingly</p>                                  
                            </div>

                            <ul class="stock-detail list-items fsz-12">
                                <li> <strong> Brand : <span class="blk-clr brand"> COTTON </span> </strong> </li>
                                <li> <strong>  Minimum Qty : <span class="blk-clr min_order_qty"> 5 </span> </strong> </li>
                            </ul>

                            <form class="variations_form cart" method="post">
                                <div class="row">
                                    {{-- <div class="col-sm-4">
                                        <div class="form-group selectpicker-wrapper">
                                            <label class="fsz-15 title-3"> <b> CHOOSE COLOR </b> </label>
                                            <div class="search-selectpicker selectpicker-wrapper">
                                                <select
                                                    class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                    data-toggle="tooltip" title="White">
                                                    <option>Pink</option>
                                                    <option>Blue</option>
                                                    <option>White</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group selectpicker-wrapper">
                                            <label class="fsz-15 title-3"> <b> CHOOSE SIZE </b> </label>
                                            <div class="search-selectpicker selectpicker-wrapper">
                                                <select
                                                    class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                    data-toggle="tooltip" title="Large">
                                                    <option>Small</option>
                                                    <option>Medium</option>
                                                    <option>Large</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group selectpicker-wrapper">
                                            <label class="fsz-15 title-3"> <b> QUANTITY </b> </label>
                                            <div class="search-selectpicker selectpicker-wrapper">
                                                <select
                                                    class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                    data-toggle="tooltip" title="Select Quantity">
                                                    <option value="1">1 Pcs</option>
                                                    <option value="2">2 Pcs</option>
                                                    <option value="3">3 Pcs</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <a  class="details red-clr">Details</a>
                                        </div>    
                                    </div>
                                </div>
                            </form>
                        </div><!-- .summary -->
                    </div>  
                </div>
            </div>
        </div>
    </section>
    <!-- / Product Preview Popup -->

    <!-- Search Popup -->
    <div class="popup-box page-search-box">
        <div>
            <div class="popup-box-inner">
                <form>
                    <input class="search-query" type="text" placeholder="Search and hit enter" />
                </form>
            </div>
        </div>
        <a href="javascript:void(0)" class="close-popup-box close-page-search"><i class="fa fa-close"></i></a>
    </div>
    <!-- / Search Popup -->

    <!-- Popup: Login 1 -->
    <div class="modal fade login-popup" id="login-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">                
            <button type="button" class="close close-btn popup-cls" data-dismiss="modal" aria-label="Close"> <i class="fa-times fa"></i> </button>

            <div class="modal-content login-1 blk-clr">   
                <div class="login-wrap text-center">                        
                    <p class="fsz-13 bold-font-4"> Did you know that dadavaai is here for managing<br>all of your <span class="thm-clr">  on-demand  </span>products </p>                       
 
                    <div class="login-form">
                        <a class="fb-btn btn spcbtm-15" href="{{url('/facebook-login-redirect')}}" disabled> <i class="fa fa-facebook btn-icon"></i>Login with Facebook </a>

                        <p class="bold-font-2 fsz-10 signup"> OR WITH EMAIL </p>

                        {{-- <form id="login-popup-form" class="login" method="GET"> --}}
                        <form id="login-popup-form" class="login" method="GET">
                            <div class="form-group"><input type="text" id="email" name="email" placeholder="Email" class="form-control"></div>
                            <div class="form-group"><input type="password" id="password" name="password" placeholder="Password" class="form-control" style="text-transform: unset;"></div>
                            <div class="form-group">
                                <button class="alt fancy-button" type="submit"> <span class="fa fa-lightbulb-o"></span> Login</button>
                            </div>
                        </form>
                        <a  href="{{url('client-login-register')}}" class="blk-clr fsz-12"> <u>If you are not a member, click here to register </u></a>

                    </div>
                </div>
            </div> 
        </div>
    </div>
    <!-- /Popup: Login 1 --> 

    <!-- Top -->
    <div class="to-top" id="to-top"> <i class="fa fa-long-arrow-up"></i> </div>

    <!-- JS Global -->
    <script src="{{asset('client/plugins/jquery/jquery-2.1.3.js')}}"></script>  
    <script src="{{asset('client/plugins/royalslider/jquery.royalslider.min.js')}}"></script>
    <script src="{{asset('client/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('client/plugins/bootstrap-select-1.9.3/dist/js/bootstrap-select.min.js')}}"></script>             
    <script src="{{asset('client/plugins/owl-carousel2/owl.carousel.min.js')}}"></script> 
    <script src="{{asset('client/plugins/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.concat.min.js')}}"></script> 

    <script src="{{asset('client/plugins/isotope-master/dist/isotope.pkgd.min.js')}}"></script>        
    <script src="{{asset('client/plugins/subscribe-better-master/jquery.subscribe-better.min.js')}}"></script> 
    
    <!-- tostr notification CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- product review --}}
    {{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}

    <!-- Page JS -->
    <script src="{{asset('client/js/countdown.js')}}"></script>
    <script src="{{asset('client/js/jquery.sticky.js')}}"></script>
    <script src="{{asset('client/js/custom.js')}}"></script>
    <script src="{{asset('client/js/chat.js')}}"></script>

    <script src="{{asset('client/plugins/nouislider/nouislider.min.js')}}"></script>

    {{-- multiple select --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}

    {{-- piczoom --}}
    {{-- <script src="{{asset('client/plugins/jQuery-Plugin-For-Image-Lightbox-with-Zoom-Effect-Zoomify/dist/zoomify.js')}}"></script> --}}
    <script src="{{asset('client/plugins/picZoomer/src/jquery.picZoomer.js')}}"></script>

    @yield('script')

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    $("#toTopShuvo").click(function () {
        //1 second of animation time
        //html works for FFX but not Chrome
        //body works for Chrome but not FFX
        //This strange selector seems to work universally
        $("html, body").animate({scrollTop: 0}, 1000);
    });
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5e922d5669e9320caac2ac80/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

    {{-- agile crm --}}
    <script id="_agile_min_js" async type="text/javascript" src="https://jara-ecommerce.agilecrm.com/stats/min/agile-min.js"> </script>
    <script type="text/javascript" >
    var Agile_API = Agile_API || {}; Agile_API.on_after_load = function(){
    _agile.set_account('72132oi7837cn7fkcfl98acdmm', 'jara-ecommerce', false);
    _agile.track_page_view();
    _agile_execute_web_rules();};
    </script>

</body>

</html>
