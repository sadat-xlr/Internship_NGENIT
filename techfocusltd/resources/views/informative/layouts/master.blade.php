<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- Mirrored from kodeforest.net/html/baldiyat/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Sep 2019 03:52:56 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('informative/css/bootstrap.css')}}" rel="stylesheet">
    <!-- Slick Slider CSS -->
    <link href="{{ asset('informative/css/slick-theme.css')}}" rel="stylesheet"/>
    <!-- Font Awesome CSS -->
    <link href = "{{ asset('informative/css/all.css')}}" rel = "stylesheet" >
    <!-- ICONS CSS -->
    <link href="{{ asset('informative/css/font-awesome.css')}}" rel="stylesheet">
    <!-- ICONS CSS -->
    <link href="{{ asset('informative/css/animation.css')}}" rel="stylesheet">
    <!-- Pretty Photo CSS -->
    <link href="{{ asset('informative/css/prettyPhoto.css')}}" rel="stylesheet">
    <!-- Custom Main StyleSheet CSS -->
    <link href="{{ asset('informative/css/component.css')}}" rel="stylesheet">
    <!-- Pretty Photo CSS -->
    <link href="{{ asset('informative/css/jquery.bxslider.css')}}" rel="stylesheet">
    <!-- Pretty Photo CSS -->
    <link href="{{ asset('informative/css/style5.css')}}" rel="stylesheet">
    <!-- Pretty Photo CSS -->
    <link href="{{ asset('informative/css/demo.css')}}" rel="stylesheet">
    <!-- Pretty Photo CSS -->
    <link href="{{ asset('informative/css/fig-hover.css')}}" rel="stylesheet">
    <!-- Typography CSS -->
    <link href="{{ asset('informative/css/typography.css')}}" rel="stylesheet">
    <!-- Custom Main StyleSheet CSS -->
    <link href="{{ asset('informative/css/style.css')}}" rel="stylesheet">
    <!-- Custom Main StyleSheet CSS -->
    <link href="{{ asset('informative/css/component.css')}}" rel="stylesheet">
    <!-- Custom Main StyleSheet CSS -->
    <link href="{{ asset('informative/css/shotcode.css')}}" rel="stylesheet">
    <!-- Custom Main StyleSheet CSS -->
    <link href="{{ asset('informative/css/svg-icon.css')}}" rel="stylesheet">
    <!-- Color CSS -->
    <link href="{{ asset('informative/css/color.css')}}" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="{{ asset('informative/css/responsive.css')}}" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="{{ asset('informative/css/sidebar-widget.css')}}" rel="stylesheet">
    <link href="{{ asset('informative/css/selectric.css')}}" rel="stylesheet">
    <link href="{{ asset('informative/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('informative/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    

  
    <!-- Font Awesome CSS -->

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.png')}}">

    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>


    {{-- data table start --}}
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
    {{-- data table end --}}
</head>
<body class="demo-5">
    <div class="wrapper"> 
        <header>
            @php
               
                $about = \App\About::first();
                $siteInfo = \App\Siteinfo::all()->first();
                $contact  = \App\Contact::first();
                $digitalInnovations = \App\Digitalinnovation::all()->take(3)->sortByDesc('id');
                $dataCenterInfoes   = \App\Datacenter::all()->take(3)->sortByDesc('id');
                $connectedWorkforces = \App\Connectedworkforce::all()->take(3)->sortByDesc('id');
                $systemIntegrations = \App\Systemintegration::all()->take(3)->sortByDesc('id');
                $solutions = \App\Solution::all()->take(5);
                $featuredContents = \App\Featuredcontent::inRandomOrder()->take(3)->get();
                $categories = \App\Category::all()->take(5);
                $brands = \App\Brand::all()->take(5);
                $industries = \App\Industry::all()->take(5);
                $services = \App\Service::all();
				$industrySolutions = \App\Product::select('solutions.solutionName','solutions.id', 'solutions.slug', 'solutions.image', 'industries.industryName')->distinct('industries.industryName')->leftJoin('industries', 'industries.id', '=', 'products.industry_id')->leftJoin('solutions', 'solutions.id', '=', 'products.solution_id')->get();
            
            @endphp

            {{-- top navbar start --}}
            
            <div class="city_top_wrap">
                <div class="container-fluid">
                    <div class="city_top_logo">
                        <figure>
                            <h1><a href="{{url('/')}}"><img src="{{asset('informative/images/logo.png')}}" alt="techfocusltd"></a></h1>
                        </figure>
                    </div>
                    <div class="btn-group hidden-md hidden-sm hidden-xs" style="margin-top:1%;">
                        {{$contact->email}} &nbsp;|&nbsp;
                    </div>
                    <!-- Large button group -->
                    <div class="btn-group" style="margin-top:1%;">
                        <button id="shuvo"  class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:5%; background-color:#fff; color:#1b6492">
                                &nbsp;<i class="fa fa-whatsapp fa-lg" aria-hidden="true"></i>
                        </button>
                        <ul class="dropdown-menu" style="position:absolute;z-index:99999!important; margin-left:-100px;">
                            <li style="padding:5px; font-size:16px ; text-align:center"><i class="fa fa-phone" aria-hidden="true"></i> {{$contact->phone1}} </li>
                            <li style="padding:5px; font-size:16px ;text-align:center"><i class="fa fa-phone" aria-hidden="true"></i> {{$contact->phone2}} </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('contact')}}" style="padding:5%; font-size:16px;text-align:center">Contact Us </a></li>
                        </ul>
                    </div>
                    
                    <!-- Large button group -->
                    <div class="btn-group" style="margin-top:1%;">
                        <a id="messenger" href="https://www.messenger.com/t/techfocusltd" target="_blank" class="btn btn-default btn-lg hide" type="button"    style="padding:5%; background-color:#fff; color:#1b6492">
                                &nbsp;<i class="fab fa-facebook-messenger fa-lg"></i>
                        </a>
                    </div>
                    <div class="btn-group" style="margin-top:1%;">
                        <a id="whatsapp" href="https://api.whatsapp.com/send?phone=01714243446&text=&source=&data=" target="_blank" class="btn btn-default btn-lg hide" type="button"    style="padding:5%; background-color:#fff; color:#1b6492">
                                &nbsp;<i class="fa fa-whatsapp fa-lg" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="btn-group" style="margin-top:1%;">
                        <a id="skype" href="https://www.facebook.com/techfocusltd" target="_blank" class="btn btn-default btn-lg hide" type="button"    style="padding:5%; background-color:#fff; color:#1b6492">
                                &nbsp;<i class="fa fa-skype fa-lg" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="btn-group hidden-md hidden-sm hidden-xs" style="margin-top:1%;">
                        | &nbsp; {{$contact->phone1}}
                    </div>

                    <div  class="city_top_social">
                        <ul>
                            <li><a  href="{{$siteInfo->facebook}}" target="_blank"><i  class="fa fa-facebook"></i></a></li>
                            <li class="hidden-md hidden-sm hidden-xs"><a href="{{$siteInfo->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li class="hidden-md hidden-sm hidden-xs"><a href="{{$siteInfo->dribbble}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            
                        </ul>
                    </div>
                    
                </div>
            </div>
            {{-- top navbar end --}}

            <!--main navbar start-->
            <div class="city_top_navigation" style="padding:unset">
                <div class="container-fluid">
                    <div class="navbar navbar-default navbar-static-top" style="padding-top:0px; border:unset;!important; margin-bottom: unset;">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav list-inline">
                                    <li class="dropdown menu-large">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> What we do <b class="caret"></b> </a>
                                        {{--    for md, sm, xs display start --}}
                                        <ul class="dropdown-menu  row hidden-lg">
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header dropdown-header-border"><b>Digital Innovation</b></li>
                                                    @foreach ($digitalInnovations as $digitalInnovation)
                                                        <li><a class="dropdown-element-color" href="{{url('digital-innovation/'.$digitalInnovation->id)}}">{{$digitalInnovation->topic}}</a></li>
                                                    @endforeach
                                                    <li><a class="dropdown-element-color" href="{{url('feature-content')}}">Featured Content</a></li>
                                                    <li><a class="dropdown-element-color" href="{{url('services')}}">Services</a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header dropdown-header-border"><b>Cloud + Data Center</b></li>
                                                    <li><a class="dropdown-element-color" href="#">Cloud solutions & management</a></li>
                                                    @foreach ($dataCenterInfoes as $dataCenterInfo)
                                                        <li><a class="dropdown-element-color" href="{{url('cloud-datacenter/'.$dataCenterInfo->id)}}">{{$dataCenterInfo->topic}}</a></li>
                                                    @endforeach
                                                    <li><a class="dropdown-element-color" href="{{url('cloud-datacenter-font')}}">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header dropdown-header-border"><b>Connected Workforce</b></li>
                                                    <li><a class="dropdown-element-color" href="#">Empower employees that fuel productivity</a></li>
                                                    @foreach ($connectedWorkforces as $connectedWorkforce)
                                                        <li><a class="dropdown-element-color" href="{{url('connected-workforce/'.$connectedWorkforce->id)}}">{{$connectedWorkforce->topic}}</a></li>
                                                    @endforeach
                                                    <li><a class="dropdown-element-color" href="#">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header dropdown-header-border"><b>System Integration</b></li>
                                                    @foreach ($systemIntegrations as $systemIntegration)
                                                        <li><a class="dropdown-element-color" href="{{url('system-integration/'.$systemIntegration->id)}}">{{$systemIntegration->topic}}</a></li>
                                                    @endforeach
                                                    <li><a class="dropdown-element-color" href="{{url('services')}}">Support Services</a></li>
                                                    <li><a class="dropdown-element-color" href="#">Safety & Security</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        {{--    for small md xs display end  --}}

                                        {{--    for large display start      --}}
                                        <ul class="dropdown-menu megamenu row hidden-md hidden-sm hidden-xs">
                                            <div class="feature-part">
                                                <div class="col-sm-12">
                                                    <span class="top-span-two"></span>
                                                    <p class="menu-text text-center"><b>Featured content</b></p>
                                                    <a href="{{url('feature-content')}}" class="btn btn-view-all" style="float: right;margin-top:-3%">View all&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a>
                                                    <div class="feature-content-part" style="padding:unset">
                                                        @foreach ($featuredContents as $featuredContent)
                                                            <div class="width_control" style="padding:unset!importanr;; margin:unset!importanr;">
                                                                <div class="city_department_fig" style="padding:unset!importanr;; margin:unset!importanr;">
                                                                <figure class="box">
                                                                    <div class="box-layer layer-1"></div>
                                                                    <div class="box-layer layer-2"></div>
                                                                    <div class="box-layer layer-3"></div>
                                                                    <img src="{{asset('storage/images/feturedContent/'.$featuredContent->image)}}" alt="" style="width: 90px; height: 60px;!important">
                                                                    <a class="paly_btn" data-rel="prettyPhoto" href="{{asset('storage/images/feturedContent/'.$featuredContent->image)}}"><i class="fa fa-plus"></i></a>
                                                                </figure>
                                                                <div class="city_department_text" style="padding:unset!importanr;; margin:unset!importanr;">
                                                                    <p class="menu-text index-blog-text"><a href="{{url('feature-content/'.$featuredContent->id)}}">{{substr($featuredContent->title, 0, 100)}}</a></p>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12">
                                                <div class="menu-content">
                                                    <div class="special-part">
                                                        <div class="first-part">
                                                        <p class="menu-text"><b>A single portal for your needs</b><br>Manage all of your procurement, products and services with an account on TechFocus</p>
                                                        <a href="#" class="special-link">See the benefits of an account&nbsp;<i class="fas fa-long-arrow-alt-right"></i>&nbsp;</a><a href="{{url('info-login')}}" class="special-link">Create an account&nbsp;<i class="fas fa-long-arrow-alt-right"></i>&nbsp;&nbsp;</a><a href="{{url('info-login')}}" class="special-link">Log in to your account&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>&nbsp; &nbsp; &nbsp;</div>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header"><b>Digital Innovation</b></li>
                                                    <span class="top-span-three"></span>
                                                    @foreach ($digitalInnovations as $digitalInnovation)
                                                        <li><a class="special-link" href="{{url('digital-innovation/'.$digitalInnovation->id)}}">{{$digitalInnovation->topic}}</a></li>
                                                    @endforeach
                                                    <li><a href="{{url('feature-content')}}" class="special-link">Featured Content</a></li>
                                                    <li><a href="{{url('services')}}" class="special-link">Services</a></li>
                                                    <li><a href="{{url('digital-innovation')}}" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header"><b>Cloud + Data Center</b></li>
                                                    <span class="top-span-three"></span>
                                                    <li><a href="#">Cloud solutions & management</a></li>
                                                    @foreach ($dataCenterInfoes as $dataCenterInfo)
                                                        <li><a class="special-link" href="{{url('cloud-datacenter/'.$dataCenterInfo->id)}}">{{$dataCenterInfo->topic}}</a></li>
                                                    @endforeach
                                                    <li><a href="{{url('cloud-datacenter-font')}}" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header"><b>Connected Workforce</b></li>
                                                    <span class="top-span-three"></span>
                                                    <li><a href="#">Empower employees that fuel productivity</a></li>
                                                    @foreach ($connectedWorkforces as $connectedWorkforce)
                                                        <li><a class="special-link" href="{{url('connected-workforce/'.$connectedWorkforce->id)}}">{{$connectedWorkforce->topic}}</a></li>
                                                    @endforeach
                                                    <li><a href="{{url('connected-workforce-all')}}" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header"><b>System Integration</b></li>
                                                    <span class="top-span-three"></span>
                                                    @foreach ($systemIntegrations as $systemIntegration)
                                                        <li><a class="special-link" href="{{url('system-integration/'.$systemIntegration->id)}}">{{$systemIntegration->topic}}</a></li>
                                                    @endforeach
                                                    <li><a href="{{url('services')}}" class="special-link">Support Services</a></li>
                                                    <li><a href="{{url('system-integration-all')}}" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>

                                        <!-- Industries we serve-->
                                        {{-- <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="list-part">
                                                <p class="menu-text"><b>Industries we serve</b></p>
                                                <ul class="list_column">
                                                    @foreach ($solutions->take(3) as $solution)
                                                    <li><a href="{{url('solution/'.$solution->id.'/'.$solution->slug)}}" class="menu-text special-link">{{$solution->solutionName}} solution&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                    @endforeach
                                                </ul>
                                                <ul class="list_column">
                                                    @foreach ($services as $service)
                                                        //d
                                                    <li><a href="{{url('service/'.$service->id.'/'.$service->slug)}}" class="menu-text special-link">{{$service->title}}&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="quote-button"><a href="{{url('solutions')}}" class="btn btn-log">View all solutions&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a>
                                            </div>
                                        </div> --}}
                                        <!--<div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="list-part">
                                                <p class="heading-part"><b>Industries we serve</b></p>
                                                <ul class="nav-column">
                                                    <li>
                                                        <a href="#">Education</a>
                                                        <a href="#">Enterprise business</a>
                                                        <a href="#">Federal government</a>
                                                    </li>
                                                </ul>
                                                <ul class="nav-column">
                                                    <li>
                                                        <a href="#">Healthcare</a>
                                                        <a href="#">Service providers</a>
                                                        <a href="#">Small to medium business</a>
                                                    </li>
                                                </ul>
                                                <ul class="nav-column">
                                                    <li>
                                                        <a href="#">State & local government</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>-->
                                        </ul>
                                        {{--    for large display end         --}}
                                    </li>
                                    <li class="dropdown menu-large">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Our Services <b class="caret"></b></a>
                                        {{-- for md, sm, xs display Start --}}
                                        <ul class="dropdown-menu row hidden-lg">
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header dropdown-header-border"><b>By Product</b></li>
                                                    @foreach ($categories as $category)
                                                    <li><a class="dropdown-element-color" href="{{url('products-by-cat/'.$category->id)}}" class="special-link">{{$category->categoryName}}</a></li>
                                                    @endforeach
                                                    <li><a class="dropdown-element-color" href="{{url('all-category-info')}}" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header dropdown-header-border"><b>By Brand</b></li>
                                                    @foreach ($brands as $brand)
                                                        <li><a class="dropdown-element-color" href="{{url('brand-details/'.$brand->id)}}" class="special-link">{{$brand->brandName}}</a></li>                                                  
                                                    @endforeach
                                                    <li><a class="dropdown-element-color" href="{{url('all-brand')}}" class="special-link">View all&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header dropdown-header-border"><b>By Solution</b></li>
                                                    @foreach ($solutions as $solution)
                                                        <li><a class="dropdown-element-color" href="{{url('solution/'.$solution->id.'/'.$solution->slug)}}" class="special-link">{{$solution->solutionName}}</a></li>
                                                        
                                                    @endforeach
                                                    <li><a class="dropdown-element-color" href="{{url('solutions')}}" class="special-link ">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                @php
                                                    $industries = \App\Industry::all()->take(4);
                                                @endphp
                                                <ul>
                                                    <li class="dropdown-header dropdown-header-border"><b>By Industry</b></li>
                                                    @foreach ($industries as $industry)
                                                        <li><a class="dropdown-element-color" href="{{url('industry-details/'.$industry->id)}}" class="special-link">{{$industry->industryName}}</a></li>                                                  
                                                    @endforeach
                                                    <li><a class="dropdown-element-color" href="{{url('allIndustry')}}" class="special-link ">View all&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <div class="feature-part">
                                                <div class="col-sm-12" style="padding-top:1% !important;">
                                                    <span class="top-span-two"></span>
                                                    <p class="menu-text text-center"><b>Featured content</b></p>
                                                    <a href="{{url('feature-content')}}" class="btn btn-view-all" style="float: right;margin-top:-2%" >View all&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a>
                                                    <div class="feature-content-part" style="padding:unset">
                                                        @foreach ($featuredContents->take(2) as $featuredContent)
                                                            <div class="width_control" style="padding:unset!importanr;; margin:unset!importanr;">
                                                                <div class="city_department_fig" style="padding:unset!importanr;; margin:unset!importanr;">
                                                                <figure class="box">
                                                                    <div class="box-layer layer-1"></div>
                                                                    <div class="box-layer layer-2"></div>
                                                                    <div class="box-layer layer-3"></div>
                                                                    <img src="{{asset('storage/images/feturedContent/'.$featuredContent->image)}}" alt="" style="width: 90px; height: 60px;!important">
                                                                    <a class="paly_btn" data-rel="prettyPhoto" href="{{asset('storage/images/feturedContent/'.$featuredContent->image)}}"><i class="fa fa-plus"></i></a>
                                                                </figure>
                                                                <div class="city_department_text" style="padding:unset!importanr;; margin:unset!importanr;">
                                                                    <p class="menu-text index-blog-text"><a href="{{url('feature-content/'.$featuredContent->id)}}">{{substr($featuredContent->title, 0, 100)}}</a></p>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </ul>
                                        {{--  for md, sm, xs display End --}}
                                        {{-- for large display Start --}}
                                        <ul class="dropdown-menu megamenu row hidden-md hidden-sm hidden-xs" style="padding-top:15px !important;">
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header"><b>By Product</b></li>
                                                    <span class="top-span-three"></span>
                                                    @foreach ($categories as $category)
                                                    <li><a href="{{url('products-by-cat/'.$category->id)}}" class="special-link">{{$category->categoryName}}</a></li>
                                                    @endforeach
                                                    <li><a href="{{url('all-category-info')}}" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header"><b>By Brand</b></li>
                                                    <span class="top-span-three"></span>
                                                    @foreach ($brands as $brand)
                                                        <li><a href="{{url('brand-details/'.$brand->id)}}" class="special-link">{{$brand->brandName}}</a></li>                                                  
                                                    @endforeach
                                                    <li><a href="{{url('all-brand')}}" class="special-link">View all&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header"><b>By Solution</b></li>
                                                    <span class="top-span-three"></span>

                                                    @foreach ($solutions as $solution)
                                                        <li><a href="{{url('solution/'.$solution->id.'/'.$solution->slug)}}" class="special-link">{{$solution->solutionName}}</a></li>
                                                        
                                                    @endforeach
                                                    <li><a href="{{url('solutions')}}" class="special-link ">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                @php
                                                    $industries = \App\Industry::all()->take(4);
                                                @endphp
                                                <ul>
                                                    <li class="dropdown-header"><b>By Industry</b></li>
                                                    <span class="top-span-three"></span>
                                                    @foreach ($industries as $industry)
                                                        <li><a href="{{url('industry-details/'.$industry->id)}}" class="special-link">{{$industry->industryName}}</a></li>                                                  
                                                    @endforeach
                                                    <li><a href="{{url('allIndustry')}}" class="special-link ">View all&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <div class="col-xl-12 col-lg-12 col-md-12">
                                                <div class="menu-content">
                                                    <div class="special-part">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="feature-part">
                                                <div class="col-sm-12" style="padding-top:1% !important;">
                                                    <span class="top-span-two"></span>
                                                    <p class="menu-text text-center"><b>Featured content</b></p>
                                                    <a href="{{url('feature-content')}}" class="btn btn-view-all" style="float: right;margin-top:-2%" >View all&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a>
                                                    <div class="feature-content-part" style="padding:unset">
                                                        @foreach ($featuredContents as $featuredContent)
                                                            <div class="width_control" style="padding:unset!importanr;; margin:unset!importanr;">
                                                                <div class="city_department_fig" style="padding:unset!importanr;; margin:unset!importanr;">
                                                                <figure class="box">
                                                                    <div class="box-layer layer-1"></div>
                                                                    <div class="box-layer layer-2"></div>
                                                                    <div class="box-layer layer-3"></div>
                                                                    <img src="{{asset('storage/images/feturedContent/'.$featuredContent->image)}}" alt="" style="width: 90px; height: 60px;!important">
                                                                    <a class="paly_btn" data-rel="prettyPhoto" href="{{asset('storage/images/feturedContent/'.$featuredContent->image)}}"><i class="fa fa-plus"></i></a>
                                                                </figure>
                                                                <div class="city_department_text" style="padding:unset!importanr;; margin:unset!importanr;">
                                                                    <p class="menu-text index-blog-text"><a href="{{url('feature-content/'.$featuredContent->id)}}">{{substr($featuredContent->title, 0, 100)}}</a></p>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </ul>
                                        {{--  for large display End --}}
                                    </li>
                                    <li class="dropdown menu-large">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Connect with us<b class="caret"></b></a>    
                                        {{-- for md, sm, xs display Start --}}
                                        <ul class="dropdown-menu row hidden-lg">
                                            <li class="col-sm-4">
                                                {{-- <div class="row">
                                                    <div class="col-sm-12">
                                                        <ul>
                                                            <li class="dropdown-header" style="text-align:center;"><b>News</b></li>
                                                        </ul> 
                                                        <div>
                                                            <figure>
                                                                    <img src="{{asset('informative/extra-images/about_video.jpg')}}" alt="" style="width: 90%; height: 130px;!important">							
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <br><br><br><br>
                                                    </div>
                                                </div> --}}
                                                <div class="row" style="margin-bottom:0px !important;">
                                                    <div class="col-sm-12">
                                                        <ul>
                                                            <li class="dropdown-header" style="text-align:center"><b>About US</b></li>
                                                        </ul> 
                                                        <div style="border: #ddd 1px solid; padding:10px;">
                                                            <a href="{{url('/info-about')}}">
                                                                <figure>
                                                                        <img src="{{asset('informative/extra-images/blog-grid.jpg')}}" alt="" style="width: 100%; height: 150px;!important">							
                                                                </figure>
                                                            </a>
                                                            <div >
                                                                <p style="text-align: justify; font-size:13px; margin-top:10px;">
                                                                    
                                                                    {{substr( strip_tags($about->description),0,120) }}
                                                                <a style="color: #1B6492" href="{{url('info-about')}}"> ..more</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding-top:2%;">
                                                            <ul>
                                                                <li class="col-sm-12">
                                                                    <div class="social-links">
                                                                        <p class="menu-text text-center">Stay connected: &nbsp;&nbsp;<a href="{{$siteInfo->dribbble}}" target="_blank"><i class="fab fa-linkedin"></i></a>&nbsp;&nbsp;&nbsp;<a href="{{$siteInfo->facebook}}" target="_blank"><i class="fab fa-facebook-square"></i></a>&nbsp;&nbsp;&nbsp;<a href="{{$siteInfo->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a>&nbsp;&nbsp;&nbsp;</p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-sm-8">
                                                <div class="row" style="padding-bottom:2%;">
                                                    <ul>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                            <li class="dropdown-header menubar dropdown-header-border"><b>Email </b></li>
                                                            <li><a class="dropdown-element-color" href="mailto:Sales@techfocusltd.com" >Sales@techfocusltd.com</a></li>
                                                            <li><a class="dropdown-element-color" href="mailto:info@techfocusltd.com" >Info@techfocusltd.com</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header menubar dropdown-header-border"><b>Phone </b></li>
                                                                <li><a class="dropdown-element-color" href="#" class="special-link">{{$contact->phone1}}</a></li>
                                                                <li><a class="dropdown-element-color" href="#" class="special-link">{{$contact->phone2}}</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header menubar dropdown-header-border"><b>Query </b></li>
                                                                <li><a class="dropdown-element-color" href="{{url('contact')}}" class="special-link">Chat Now &nbsp; <i class="fa fa-whatsapp fa-lg" aria-hidden="true"></i></a></li>
                                                                <li><a class="dropdown-element-color" class="btn " data-toggle="modal" data-target="#myModal">Offline Query &nbsp;</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                            <li class="dropdown-header menubar dropdown-header-border"><b>Social Link</b></li>
                                                            <li><a class="dropdown-element-color" href="{{$siteInfo->facebook}}">Facebook</a></li>
                                                            <li><a class="dropdown-element-color" href="{{$siteInfo->dribbble}}">LinkedIn</a></li>
                                                            <li><a class="dropdown-element-color" href="{{$siteInfo->twitter}}">Twitter</a></li>

                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                                {{-- <div class="row">
                                                    <div class="col-sm-12">
                                                        <div>
                                                            <figure>
                                                                <img src="{{asset('informative/images/contact-us.jpg')}}" alt="">
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="row" style="padding-top:3%;">
                                                    <ul>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header menubar dropdown-header-border"><b>Partners</b></li>
                                                                <li><a class="dropdown-element-color" href="#">Be our partners</a></li>
                                                                <li><a class="dropdown-element-color" href="#">Partner benefits</a></li>
                                                                <li><a class="dropdown-element-color" href="#">Partner offers</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header menubar dropdown-header-border"><b>Careers</b></li>
                                                                <li><a class="dropdown-element-color" href="#">Sign In</a></li>
                                                                <li><a class="dropdown-element-color" href="#">Register as Job Seeker</a></li>
                                                                <li><a class="dropdown-element-color" href="#">Current Jobs</a></li>
                                                                <li><a class="dropdown-element-color" href="#">Submit your CV</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header menubar dropdown-header-border"><b>Media</b></li>
                                                                <li><a class="dropdown-element-color" href="{{url('/news')}}">News & Social Media</a></li>
                                                                <li><a href="{{url('/newsletter')}}" class="special-link">News Letters</a></li>
                                                                <li><a class="dropdown-element-color" href="{{url('/media-archive')}}">Media Archive</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header menubar dropdown-header-border"><b>Tech Support</b></li>
                                                                <li><a class="dropdown-element-color" href="{{url('informative-blog')}}">Tech Blogs</a></li>
                                                                <li><a class="dropdown-element-color" href="{{url('forum-questions')}}">Tech Forum</a></li>
                                                                
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                        {{-- for md, sm, xs display End --}}
                                        {{-- for large display Start --}}
                                        <ul class="dropdown-menu megamenu row hidden-md hidden-sm hidden-xs">
                                            <li class="col-sm-4">
                                                {{-- <div class="row">
                                                    <div class="col-sm-12">
                                                        <ul>
                                                            <li class="dropdown-header" style="text-align:center;"><b>News</b></li>
                                                        </ul> 
                                                        <div>
                                                            <figure>
                                                                    <img src="{{asset('informative/extra-images/about_video.jpg')}}" alt="" style="width: 90%; height: 130px;!important">							
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <br><br><br><br>
                                                    </div>
                                                </div> --}}
                                                <div class="row" style="margin-bottom:0px !important;">
                                                    <div class="col-sm-12">
                                                        <ul>
                                                            <li class="dropdown-header" style="text-align:center"><b>About US</b></li>
                                                        </ul> 
                                                        <div style="border: #ddd 1px solid; padding:10px;">
                                                            <a href="{{url('/info-about')}}">   
                                                                <img src="{{asset('informative/extra-images/blog-grid.jpg')}}" alt="" style="width: 100%; height: 150px;!important">							
                                                            </a>
                                                            <div >
                                                                <p style="text-align: justify; font-size:13px; margin-top:10px;">
                                                                    {{substr( strip_tags($about->description),0,120) }}
                                                                    
                                                                <a style="color: #1B6492" href="{{url('info-about')}}"> ..more</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding-top:2%;">
                                                            <ul>
                                                                <li class="col-sm-12">
                                                                    <div class="social-links">
                                                                        <p class="menu-text text-center">Stay connected: &nbsp;&nbsp;<a href="{{$siteInfo->dribbble}}" target="_blank"><i class="fab fa-linkedin"></i></a>&nbsp;&nbsp;&nbsp;<a href="{{$siteInfo->facebook}}" target="_blank"><i class="fab fa-facebook-square"></i></a>&nbsp;&nbsp;&nbsp;<a href="{{$siteInfo->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a>&nbsp;&nbsp;&nbsp;</p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-sm-8">
                                                {{-- <div class="row" style="padding-bottom:2%;">
                                                    <ul>
                                                        <li class="col-sm-12" style="text-align:center !important;">
                                                            <b>Contact Us</b>
                                                        </li>
                                                    </ul>
                                                </div> --}}
                                                <div class="row" style="padding-bottom:2%;">
                                                    <ul>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                            {{-- <span class="top-span-one"></span> --}}
                                                            <li class="dropdown-header menubar"><b>Email </b></li>
                                                            <span class="top-span-one menubar"></span>
                                                            <li><a href="mailto:Sales@techfocusltd.com" class="special-link">Sales@techfocusltd.com</a></li>
                                                            <li><a href="mailto:info@techfocusltd.com" class="special-link">Info@techfocusltd.com</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header menubar"><b>Phone </b></li>
                                                                <span class="top-span-one menubar"></span>
                                                                <li><a href="#" class="special-link">{{$contact->phone1}}</a></li>
                                                                <li><a href="#" class="special-link">{{$contact->phone2}}</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header menubar"><b>Query </b></li>
                                                                <span class="top-span-one menubar"></span>
                                                                <li><a href="{{url('contact')}}" class="special-link">Chat Now &nbsp; <i class="fa fa-whatsapp fa-lg" aria-hidden="true"></i></a></li>
                                                                <li><a class="btn " data-toggle="modal" data-target="#myModal">Offline Query &nbsp;</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                            <li class="dropdown-header menubar"><b>Social Link</b></li>
                                                            <span class="top-span-one menubar"></span>
                                                            <li><a href="{{$siteInfo->facebook}}" class="special-link">Facebook</a></li>
                                                            <li><a href="{{$siteInfo->dribbble}}" class="special-link">LinkedIn</a></li>
                                                            <li><a href="{{$siteInfo->twitter}}" class="special-link">Twitter</a></li>

                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                                {{-- <div class="row">
                                                    <div class="col-sm-12">
                                                        <div>
                                                            <figure>
                                                                    <img src="{{asset('informative/images/contact-us.jpg')}}" alt="">							
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="row" style="padding-top:3%;">
                                                    <ul>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header menubar"><b>Partners</b></li>
                                                                <span class="top-span-one menubar"></span>
                                                            <li><a href="{{url('/partnership')}}" class="special-link">Be our partners</a></li>
                                                            <li><a href="{{url('/partnership')}}" class="special-link">Partner benefits</a></li>
                                                            <li><a href="{{url('/partnership')}}" class="special-link">Partner offers</a></li>

                                                            {{-- <li class="special-link">
                                                                Online Call:
                                                                <br>
                                                                <div class="social-links" style="margin:unset !important;">
                                                                    &nbsp;&nbsp;<a href="#" target="_blank"><i class="fa fa-whatsapp fa-lg" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;<a href="#" target="_blank"><i class="fab fa-facebook-messenger fa-lg"></i></a>&nbsp;&nbsp;&nbsp;<a href="#" target="_blank"><i class="fa fa-skype fa-lg" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;
                                                                </div>
                                                            </li> --}}
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header menubar"><b>Careers</b></li>
                                                                <span class="top-span-one menubar"></span>
                                                                <li><a href="{{url('/info-login')}}" class="special-link">Sign In</a></li>
                                                                <li><a href="{{('/job-seeker')}}" class="special-link">Register as Job Seeker</a></li>
                                                                <li><a href="{{url('/career')}}" class="special-link">Current Jobs</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header menubar"><b>Media</b></li>
                                                                <span class="top-span-one menubar"></span>
                                                                <li><a href="{{url('/news')}}" class="special-link">News & Media Reporter</a></li>
                                                                <li><a href="{{url('/newsletter')}}" class="special-link">News Letters</a></li>
                                                                <li><a href="{{url('media-archive')}}" class="special-link">Media Archives</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header menubar"><b>Tech Support</b></li>
                                                                <span class="top-span-one menubar"></span>
                                                            <li><a href="{{url('/informative-blog')}}" class="special-link">Tech Blogs</a></li>
                                                            <li><a href="{{url('/forum-questions')}}" class="special-link">Tech Forum</a></li>
                                                            
                                                            </ul>
                                                        </li>
                                                    </ul>

                                                </div>
                                               
                                            </li>
                                        </ul>
                                        {{-- for large display End --}}
                                    </li>
                                    <li class="dropdown menu-large">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Shop<b class="caret"></b></a>    
                                        {{--    for md, sm, xs display Start --}}
                                        <ul class="dropdown-menu row" style="padding:unset!important;">
                                            <li class="col-sm-6">
                                                <ul>
                                                    <div class="row" style="padding:3% 10%;">
                                                        <li class="col-sm-4">
                                                            <ul>
                                                                <li class="dropdown-header menubar dropdown-header-border "><b>Shop by Products</b></li>
                                                                <span class="top-span-one menubar"></span>
                                                            @foreach ($categories as $category)
                                                                <li><a class="dropdown-element-color" href="{{url('productsByCat/'.$category->id)}}" class="special-link">{{$category->categoryName}}</a></li>                                                  
                                                            @endforeach
                                                                <li><a class="dropdown-element-color" href="{{url('/shop')}}" class="special-link menubox">All products&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                                <br>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-4">
                                                            <ul>
                                                                <li class="dropdown-header menubar dropdown-header-border"><b>Shop by Brand</b></li>
                                                                <span class="top-span-one menubar"></span>
                                                            @foreach ($brands as $brand)
                                                                <li><a class="dropdown-element-color" href="{{url('productsByBrand/'.$brand->id)}}" class="special-link">{{$brand->brandName}}</a></li>                                                  
                                                            @endforeach
                                                                <li><a class="dropdown-element-color" href="{{url('/brands')}}" class="special-link menubox">All brands&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                                <br>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-4">
                                                            <ul>
                                                                <li class="dropdown-header menubar dropdown-header-border"><b>Shop by Industry</b></li>
                                                                <span class="top-span-one menubar"></span>
                                                                @foreach ($industries as $industry)
                                                                    <li><a class="dropdown-element-color" href="{{url('productsByInd/'.$industry->id)}}" class="special-link">{{$industry->industryName}}</a></li>                                                  
                                                                @endforeach
                                                                <li><a class="dropdown-element-color" href="{{url('/productsByInd')}}" class="special-link menubox">All industries&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                                <br>
                                                            </ul>
                                                        </li>
                                                    </div>

                                                    <div class="row" style="padding:3% 10%;">
                                                        <li class="col-sm-9" style="background-color:#f7f6f5; padding:5%; height:150px !important;">
                                                            <p class="menu-text"><b>Manage your purchasing or create your profile</b></p>
                                                            <a href="{{url('/info-login')}}" class="btn btn-log" style="margin:unset;">Sign in / Sign up</a>
                                                        </li>
                                                        <li class="col-sm-3" style="background-color:#f7f6f5; padding:5%; height:100px !important;">
                                                            <div class="container-2" style="margin-top:10%">
                                                                <a href="{{url('/shop')}}" class="shopBtn shopBtn-two">
                                                                    <span>SHOP</span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    </div>
                                                </ul>
                                            </li>
                                            <li class="col-sm-6 shop-part">
                                                <ul>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="city_about_fig" style="padding:0% 15% 0% 15%;">
                                                                @php
                                                                    	$newProduct = \App\Product::select('id','productName', 'slug')->inRandomOrder()->take(1)->first();
                                                                @endphp
                                                                @if(!empty($newProduct))
                                                                    <a href="{{url('product-info/'.$newProduct->id.'/'.$newProduct->slug)}}">
                                                                        
                                                                        <figure class="">
                                                                            {{-- <img src="{{asset('informative/extra-images/about-fig.jpg')}}" alt=""> --}}
                                                                            <img src="{{asset('storage/images/product/'.$newProduct->image->image1)}}"  alt="" style="height: 300px;!important">
                                                                        </figure>
                                                                    </a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding-top:5%">
                                                        <li class="col-sm-4">
                                                            <ul>
                                                                <li class="dropdown-header menubar dropdown-element-color1"><b>Explore our deals</b></li>
                                                                <span class="top-span-one"></span>
                                                                <li><a href="#" class="special-link">Newproduct offer</a></li>
                                                                <li><a href="#" class="special-link">Monthly Deals</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-4">
                                                            <ul>
                                                                <li class="dropdown-header menubar dropdown-element-color1"><b>Exclusive Brands</b></li>
                                                                <span class="top-span-one"></span>
                                                                <li><a href="#" class="special-link">Brands of the month</a></li>
                                                                <li><a href="#" class="special-link">Brands offers</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-4">
                                                            <ul>
                                                                <li class="dropdown-header menubar dropdown-element-color1"><b>Explore our deals</b></li>
                                                                <span class="top-span-one"></span>
                                                                <li><a href="#" class="special-link">Corporate Purchase</a></li>
                                                                <li><a href="#" class="special-link">Individual Purchase</a></li>
                                                                <li><a href="#" class="special-link">Rwnewal contact</a></li>
                                                                <li><a href="#" class="special-link">Service contact</a></li>
                                                            </ul>
                                                        </li>
                                                    </div>
                                                </ul>
                                            </li>
                                        </ul>
                                        {{--    for md, sm, xs display end --}}
                                        {{--    for large display Start --}}
                                        <ul class="dropdown-menu megamenu row hidden-md hidden-sm hidden-xs" style="padding:unset!important;">
                                            <li class="col-sm-6">
                                                <ul>
                                                    <div class="row" style="padding:3% 10%;">
                                                        <li class="col-sm-4">
                                                            <ul>
                                                                <li class="dropdown-header menubar"><b>Shop by Products</b></li>
                                                                <span class="top-span-one menubar"></span>
                                                            @foreach ($categories as $category)
                                                                <li><a href="{{url('productsByCat/'.$category->id)}}" class="special-link">{{$category->categoryName}}</a></li>                                                  
                                                            @endforeach
                                                            <br>
                                                                <li><a href="{{url('/shop')}}" class="special-link menubox">All products&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-4">
                                                            <ul>
                                                                <li class="dropdown-header menubar"><b>Shop by Brand</b></li>
                                                                <span class="top-span-one menubar"></span>
                                                            @foreach ($brands as $brand)
                                                                <li><a href="{{url('productsByBrand/'.$brand->id)}}" class="special-link">{{$brand->brandName}}</a></li>                                                  
                                                            @endforeach
                                                            <br>
                                                                <li><a href="{{url('/brands')}}" class="special-link menubox">All brands&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-4">
                                                            <ul>
                                                                <li class="dropdown-header menubar"><b>Shop by Industry</b></li>
                                                                <span class="top-span-one menubar"></span>
                                                                @foreach ($industries as $industry)
                                                                    <li><a href="{{url('productsByInd/'.$industry->id)}}" class="special-link">{{$industry->industryName}}</a></li>                                                  
                                                                @endforeach
                                                                <br>
                                                                <li><a href="{{url('/productsByInd')}}" class="special-link menubox">All industries&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </div>

                                                    <div class="row" style="padding:3% 10%;">
                                                        <li class="col-sm-9" style="background-color:#f7f6f5; padding:5%; height:200px !important;">
                                                            <p class="menu-text"><b>Simplify and streamline with techfocus</b></p>
                                                            <p class="menu-text">We will help you procure and manage your production lifecycle.</p>
                                                            <a href="#" class="menu-text special-link"><i class="fas fa-desktop"></i>See the benefits of our e-procurement solution</a><br>
                                                            <a href="#" class="menu-text special-link"><i class="fas fa-box"></i>See our Supply Chain Optimization capability</a>
                                                        </li>
                                                        <li class="col-sm-3" style="background-color:#f7f6f5; padding:5%; height:200px !important;">
                                                            <div class="container-2" style="margin-top:50%">
                                                                <a href="{{url('/shop')}}" class="shopBtn shopBtn-two">
                                                                    <span>SHOP</span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    </div>
                                                    <div class="row" style="padding:3% 10%;">
                                                        <li class="col-sm-9">
                                                                <p class="menu-text"><b>Manage your purchasing or create your profile</b></p>
                                                        </li>
                                                        <li class="col-sm-3">
                                                            <a href="{{url('/info-login')}}" class="btn btn-log" style="margin:unset;">Sign in / Sign up</a>

                                                        </li>
                                                    </div>
                                                </ul>
                                            </li>
                                            <li class="col-sm-6 shop-part">
                                                <ul>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="city_about_fig" style="padding:0% 15% 0% 15%;">
                                                                @php
                                                                    	$newProduct = \App\Product::select('id','productName', 'slug')->inRandomOrder()->take(1)->first();
                                                                @endphp
                                                                @if(!empty($newProduct))
                                                                    <a href="{{url('product-info/'.$newProduct->id.'/'.$newProduct->slug)}}">
                                                                        
                                                                        <figure class="">
                                                                            {{-- <img src="{{asset('informative/extra-images/about-fig.jpg')}}" alt=""> --}}
                                                                            <img src="{{asset('storage/images/product/'.$newProduct->image->image1)}}"  alt="" style="height: 300px;!important">
                                                                        </figure>
                                                                    </a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding-top:5%">
                                                        <li class="col-sm-4">
                                                            <ul>
                                                                <li class="dropdown-header menubar"><b>Explore our deals</b></li>
                                                                <span class="top-span-one"></span>
                                                                <li><a href="#" class="special-link">Newproduct offer</a></li>
                                                                <li><a href="#" class="special-link">Monthly Deals</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-4">
                                                            <ul>
                                                                <li class="dropdown-header menubar"><b>Exclusive Brands</b></li>
                                                                <span class="top-span-one"></span>
                                                                <li><a href="#" class="special-link">Brands of the month</a></li>
                                                                <li><a href="#" class="special-link">Brands offers</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="col-sm-4">
                                                            <ul>
                                                                <li class="dropdown-header menubar"><b>Explore our deals</b></li>
                                                                <span class="top-span-one"></span>
                                                                <li><a href="#" class="special-link">Corporate Purchase</a></li>
                                                                <li><a href="#" class="special-link">Individual Purchase</a></li>
                                                                <li><a href="#" class="special-link">Rwnewal contact</a></li>
                                                                <li><a href="#" class="special-link">Service contact</a></li>
                                                            </ul>
                                                        </li>
                                                    </div>
                                                </ul>
                                            </li>
                                        </ul>
                                        {{--    for large display end --}}
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <div class="city_top_form" style="padding-top:6%;">
                                        <div class="city_top_search">
                                            <form>
                                                <input id="search" type="text" name="search" placeholder="Search" autocomplete="off">
                                                <a type="submit"><i class="fa fa-search"></i></a>
                                            </form>
                                        </div>
                                        <a class="top_user" data-toggle="tooltip" title="Client Login" data-placement="top" href="{{url('info-login')}}">
                                            <i class="fa fa-user"></i>
                                        </a>
                                        <div id="searchList" class="fade out" style="position:relative!importent;"></div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
            <!--main navbar end-->

            <div class="city_top_navigation hide">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="navigation">
                                <ul>
                                    <li><a href="index-2.html">Home</a></li>
                                    <li><a href="#">Services</a>
                                        <ul class="child">
                                            <li><a href="service.html">Services</a></li>
                                            <li><a href="service-02.html">Services 02</a></li>
                                            <li><a href="service-detail.html">Services detail</a></li>
                                            <li><a href="service-detail2.html">Services detail 02</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Government</a>
                                        <ul class="child">
                                            <li><a href="team.html">team</a></li>
                                            <li><a href="mayor.html">mayor</a></li>
                                            <li><a href="goverment.html">goverment</a></li>
                                            <li><a href="goverment-grid.html">goverment grid</a></li>
                                            <li><a href="health-department.html">health department</a></li>
                                            <li><a href="health-department02.html">health department 02 </a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">business</a>
                                        <ul class="child">
                                            <li><a href="business.html">business</a></li>
                                            <li><a href="business-detail.html">business detail</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Resident</a>
                                        <ul class="child">
                                            <li><a href="resident.html">Resident</a></li>
                                            <li><a href="resident-detail.html">Resident detail</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">feature</a>
                                        <ul class="child">
                                            <li><a href="#">blog</a>
                                                <ul class="child">
                                                    <li><a href="blog.html">blog</a></li>
                                                    <li><a href="blog-list.html">blog list</a></li>
                                                    <li><a href="blog-detail.html">blog detail</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">forum</a>
                                                <ul class="child">
                                                    <li><a href="forum.html">forum</a></li>
                                                    <li><a href="forum-01.html">forum 01</a></li>
                                                    <li><a href="forum-detail.html">forum detail</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">project</a>
                                                <ul class="child">
                                                    <li><a href="project.html">project</a></li>
                                                    <li><a href="project-01.html">project 01</a></li>
                                                    <li><a href="project-detail.html">project detail</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="login.html">login</a></li>
                                            <li><a href="error.html">404 page</a></li>
                                            <li><a href="coming-soon.html">coming soon</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">New & Event</a>
                                        <ul class="child">
                                            <li><a href="#">event</a>
                                                <ul class="child">
                                                    <li><a href="event.html">event</a></li>
                                                    <li><a href="event-01.html">event 01</a></li>
                                                    <li><a href="event-02.html">event 02</a></li>
                                                    <li><a href="event-detail.html">event detail</a></li>
                                                    <li><a href="event-listing.html">event listing</a></li>
                                                </ul>	
                                            </li>
                                            <li><a href="#">news</a>
                                                <ul class="child">
                                                    <li><a href="news.html">news page</a></li>
                                                    <li><a href="news-post.html">news post</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="contact-us.html">Contact Us</a></li>
                                </ul>									
                            </div>
                            <!--DL Menu Start-->
                            <div id="kode-responsive-navigation1" class="dl-menuwrapper">
                                <button class="dl-trigger">Open Menu</button>
                                <ul class="dl-menu">
                                    <li><a class="active" href="index-2.html">Home</a></li>
                                    <li class="menu-item kode-parent-menu"><a href="#">Services</a>
                                        <ul class="dl-submenu">
                                            <li><a href="service.html">Services</a></li>
                                            <li><a href="service-02.html">Services 02</a></li>
                                            <li><a href="service-detail.html">Services detail</a></li>
                                            <li><a href="service-detail2.html">Services detail 02</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item kode-parent-menu"><a href="#">Government</a>
                                        <ul class="dl-submenu">
                                            <li><a href="team.html">team</a></li>
                                            <li><a href="mayor.html">mayor</a></li>
                                            <li><a href="goverment.html">goverment</a></li>
                                            <li><a href="goverment-grid.html">goverment grid</a></li>
                                            <li><a href="health-department.html">health department</a></li>
                                            <li><a href="health-department02.html">health department 02 </a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item kode-parent-menu"><a href="#">business</a>
                                        <ul class="dl-submenu">
                                            <li><a href="business.html">business</a></li>
                                            <li><a href="business-detail.html">business detail</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item kode-parent-menu"><a href="#">Resident</a>
                                        <ul class="dl-submenu">
                                            <li><a href="resident.html">Resident</a></li>
                                            <li><a href="resident-detail.html">Resident detail</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item kode-parent-menu"><a href="#">feature</a>
                                        <ul class="dl-submenu">
                                            <li><a href="#">blog</a>
                                                <ul class="dl-submenu">
                                                    <li><a href="blog.html">blog</a></li>
                                                    <li><a href="blog-list.html">blog list</a></li>
                                                    <li><a href="blog-detail.html">blog detail</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">forum</a>
                                                <ul class="dl-submenu">
                                                    <li><a href="forum.html">forum</a></li>
                                                    <li><a href="forum-01.html">forum 01</a></li>
                                                    <li><a href="forum-detail.html">forum detail</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">project</a>
                                                <ul class="dl-submenu">
                                                    <li><a href="project.html">project</a></li>
                                                    <li><a href="project-01.html">project 01</a></li>
                                                    <li><a href="project-detail.html">project detail</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="login.html">login</a></li>
                                            <li><a href="error.html">404 page</a></li>
                                            <li><a href="coming-soon.html">coming soon</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item kode-parent-menu"><a href="#">New & Event</a>
                                        <ul class="dl-submenu">
                                            <li><a href="#">event</a>
                                                <ul class="dl-submenu">
                                                    <li><a href="event.html">event</a></li>
                                                    <li><a href="event-01.html">event 01</a></li>
                                                    <li><a href="event-02.html">event 02</a></li>
                                                    <li><a href="event-detail.html">event detail</a></li>
                                                    <li><a href="event-listing.html">event listing</a></li>
                                                </ul>	
                                            </li>
                                            <li><a href="#">news</a>
                                                <ul class="dl-submenu">
                                                    <li><a href="news.html">news page</a></li>
                                                    <li><a href="news-post.html">news post</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="contact-us.html">Contact Us</a></li>
                                </ul>
                            </div>
                            <!--DL Menu END-->
                        </div>
                        <div class="col-md-3">
                            <div class="city_top_form">
                                <div class="city_top_search">
                                    <input type="text" placeholder="Search">
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </div>
                                <a class="top_user" href="login.html"><i class="fa fa-user"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
            <!--CITY TOP NAVIGATION END-->
        </header>
        <div>
            {{-- @include('informative.inc.message') --}}
            @include('messages')
            @yield('content')
            
        </div>
        <footer>
            <div class="widget_wrap overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="widget_list">
                                <h4 class="widget_title">Find Us</h4>
                                <div class="widget_text">
                                    <p>{{$contact->address}}</p><br>
                                    <p>Saturday - Thursday 09:00 am - 06:00pm</p>
                                    <p>Email: {{$contact->email}}</p>
                                    <p>Phone: {{$contact->phone1}}, {{$contact->phone2}}</p>
                                </div> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="widget_list">
                                        <h6 class="widget_title">Customer Care</h6>
                                        <div class="widget_service">
                                            <ul>
                                                @if (Session::get('ID'))
                                                <li><a href="{{url('/my-account')}}">My Account</a></li>
                                                @endif

                                                <li><a href="{{url('contact')}}">Contact Us</a></li>
                                                <li><a href="{{url('info-login')}}">Sign in/Sign up</a></li>
                                                <li><a href="{{url('shop')}}">Online Purchase</a></li>
                                                <li><a href="{{url('info-faq#faq')}}">FAQ</a></li>
                                                <li><a href="{{url('info-faq#policy')}}">Terms & Policy</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="widget_list">
                                        <h6 class="widget_title">Services</h6>
                                        <div class="widget_service">
                                            <ul>
                                                <li><a href="{{url('allIndustry')}}">Industry</a></li>
                                                <li><a href="{{url('solutions')}}">Solution</a></li>
                                                <li><a href="{{url('all-category-info')}}">Category</a></li>
                                                <li><a href="{{url('services')}}">Support</a></li>
                                                <li><a href="{{url('info-about')}}">About</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="widget_list">
                                        <h6 class="widget_title">Features</h6>
                                        <div class="widget_service">
                                            <ul>
                                                <li class="informative_hover"><a href="#">Ask Quote</a></li>
                                                <li><a href="#">Call for meeting</a></li>
                                                <li><a href="{{url('informative-blog')}}">Blog</a></li>
                                                <li><a href="{{url('forum-questions')}}">Forum</a></li>
                                                <li><a href="#">Coming Soon</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget_copyright">
                            <div class="col-md-3 col-sm-6">
                                <div class="widget_logo">
                                    <a href="{{url('/')}}"><img src="{{asset('informative/images/another_logo.png')}}" alt=""></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="copyright_text">
                                    <p><span>{{$siteInfo->copyright}} </span><a href="http://techfocusltd.com/"></a>
                                    </p>
                                    <p style="display: inline-flex">
                                        <a style="color:#fff">Visitors :</a>
                                        <!-- Default Statcounter code for Techfocusltd
                                        http://techfocusltd.com/ -->
                                        <script type="text/javascript">
                                            var sc_project=12127351; 
                                            var sc_invisible=0; 
                                            var sc_security="d643b4f7"; 
                                            var sc_https=1; 
                                            var scJsHost = "https://";
                                            document.write("<sc"+"ript type='text/javascript' src='" +
                                            scJsHost+
                                            "statcounter.com/counter/counter.js'></"+"script>");
                                        </script>
                                        <noscript>
                                            <div class="statcounter">
                                                {{-- <a href="https://statcounter.com/p12127351/?guest=1" target="_blank" style="color:#fff">Visitors</a> --}}
                                                <a title="Web Analytics" href="https://statcounter.com/" target="_blank">
                                                   <img class="statcounter" src="https://c.statcounter.com/12127351/0/d643b4f7/0/" alt="Web Analytics">
                                                </a>
                                            </div>
                                        </noscript>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="city_top_social">
                                    <ul>
                                        <li><a href="{{$siteInfo->facebook}}"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="{{$siteInfo->twitter}}"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="{{$siteInfo->dribbble}}"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>		
            </div>
        </footer>
        <!--Modal Start -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Offline Query Form</h4>
                </div>
                <div class="modal-body">
                    <div class="city_event_detail contact">
                        <form action="{{url('send-guest-message')}}" method="post">
                            {{ csrf_field() }}
                            <div class="event_booking_form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="event_booking_field">
                                            <input type="text" name="name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="event_booking_field">
                                            <input type="text" name="email" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="event_booking_field">
                                            <input type="number" name="phoneNumber" placeholder="Phone" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="event_booking_field">
                                            {{-- <input type="text" name="subject" placeholder="subject" required> --}}
                                            <select name="subject" id="">
                                                <option value="Suport Service">Suport Service</option>
                                                <option value="Product Query">Product Query</option>
                                                <option value="Sales Meeting">Sales Meeting</option>
                                                <option value="Customer Call">Customer Call</option>
                                                <option value="Partner Call">Partner Call</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="event_booking_area">
                                            <textarea name="message" placeholder="Enter Your Message Here" required ></textarea>
                                        </div>
                                        <button class="theam_btn btn2" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
            </div>
        </div>
        <!--Modal End -->
    </div>

    <!--Jquery Library-->
    <script src="{{ asset('informative/js/jquery.js')}}"></script>
    <!--Bootstrap core JavaScript-->
    <script src="{{ asset('informative/js/bootstrap.js')}}"></script>
    <!--Slick Slider JavaScript-->
    <script src="{{ asset('informative/js/slick.min.js')}}"></script>
    <!--Pretty Photo JavaScript-->
    <script src="{{ asset('informative/js/jquery.prettyPhoto.js')}}"></script>
    <!--Pretty Photo JavaScript-->	
    <script src="{{ asset('informative/js/jquery.bxslider.min.js')}}"></script>
    <!--Pretty Photo JavaScript-->
    <script src="{{ asset('informative/js/index.js')}}"></script>
    <!--Pretty Photo JavaScript-->
    <script src="{{ asset('informative/js/modernizr.custom.js')}}"></script>
    <!--Pretty Photo JavaScript-->
    <script src="{{ asset('informative/js/jquery.dlmenu.js')}}"></script>
    <!--Pretty Photo JavaScript-->
    <script src="{{ asset('informative/js/downCount.js')}}"></script>
    <!--Counter up JavaScript-->
    <script src="{{ asset('informative/js/waypoints.js')}}"></script>
    <!--Pretty Photo JavaScript-->
    <script src="{{ asset('informative/js/waypoints-sticky.js')}}"></script>
    <!--owl JavaScript-->
    <script src="{{ asset('informative/OwlCarousel2-2.3.4/dist/owl.carousel.min.js')}}"></script>
    

    
    <!--Custom JavaScript-->
    <script src="{{ asset('informative/js/custom.js')}}"></script>
    <script>document.documentElement.className = 'js';</script>
    
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v3.2'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
         attribution=setup_tool
         page_id="319854214809357">
    </div>
    @yield('script')


</body>

</html>