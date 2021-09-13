<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
	<!-- Basic Page Needs -->
	<meta charset="UTF-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<?php $siteinfos = DB::table('siteinfos')->get();?>
	<title>@foreach($siteinfos as $siteinfo) {{$siteinfo->title}} @endforeach</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="TECH FOCUS is a technology based solution provider to the customer of Bangladesh and other eligible countries. A good range of hardware, software, solution, training, products it serves to the customers. Techfocus continuously works on advanced technology solution for its' clients.">
	<meta name="keywords" content="New Technologies Manufacturers, New Technologies Suppliers, New Technologies, Manufacturer Directory, Exporters, Sellers, tech accessories, tech trends, tech products, tech reviews, Techfocus, Techfocus.com, Books, Online Shopping, Book Store, Magazine, Subscription, Music, CDs, DVDs, Videos, Electronics, Video Games, Computers, Cell Phones, Toys, Games, Apparel, Accessories, Shoes, Jewelry, Watches, Office Products, Sports & Outdoors, Sporting Goods, Baby Products, Health, Personal Care, Beauty, Home, Garden, Bed & Bath, Furniture, Tools, Hardware, Vacuums, Outdoor Living, Automotive Parts, Pet Supplies, Broadband, DSL" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Techfocus Limited">
	<meta name="subject" content="eCommerce, Corporate Supply">
	<meta name="Geography" content="89/2, Haque Chamber, Panthapath, Dhaka 1205">
	<meta name="Language" content="English">
	<meta http-equiv="CACHE-CONTROL" content="PUBLIC">
	<meta name="Copyright" content="Techfocus Limited">
	<meta name="Designer" content="Software Department, Techfocus Limited">
	<meta name="Publisher" content="Techfocus Limited">
	<meta name="distribution" content="Local">
	<meta name="Robots" content="INDEX,FOLLOW">
	<meta name="zipcode" content="1205">
	<meta name="city" content="Dhaka">
	<meta name="country" content="Bangladesh">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
	<meta property="og:url"           content="{{url()->current()}}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content=" TechFocus LTD - Focusing on Technology Solution" />
	<meta property="og:description"   content="TechFocus was founded, and continues to flourish based on a very unique culture. We cater to every client and their demanding requirements. We earn our customers trust and loyalty. We listen intently and respond to their needs with solutions that really work. Our services combine our technology expertise backed with a commitment of personable service and dependable support. We're driven to remain 'ahead of the curve' because technology evolves rapidly. This presents the opportunity for small and mid-sized businesses to dramatically improve the efficiency of their enterprise." />
	<meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Boostrap style -->
	<link rel="stylesheet" type="text/css" href="{{asset('stylesheets/bootstrap.min.css')}}">

	<!-- Theme style -->
	<link rel="stylesheet" type="text/css" href="{{asset('stylesheets/style.css')}}">

	<!-- Reponsive -->
	<link rel="stylesheet" type="text/css" href="{{asset('stylesheets/responsive.css')}}">
	
	<!-- start: jquery -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<!-- end: jquery -->
	
	<!-- Font-awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- data-table -->
	<link rel="stylesheet" href="{{asset('stylesheets/jquery.dataTables.min.css')}}">

	<link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.png')}}">

	<script>
	  <!-- App base_url-->
	  var base_url = {!! json_encode(url('/')) !!}
	</script>
</head>
<body class="header_sticky">
	<div class="boxed">

		<div class="overlay"></div>

		{{--<!-- Preloader -->
		<div class="preloader">
			<div class="clear-loading loading-effect-2">
				<span></span>
			</div>
		</div><!-- /.preloader -->--}}	
		<div class="mainContainer">
			@yield('content')
		</div>	
	</div><!-- /.boxed -->

		<!-- Javascript -->
		<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/tether.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/waypoints.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.circlechart.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/easing.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.zoom.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/isotope.pkgd.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.flexslider-min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/owl.carousel.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/smoothscroll.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.mCustomScrollbar.js')}}"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script>
	   	<script type="text/javascript" src="{{asset('js/gmap3.min.js')}}"></script>
	   	<script type="text/javascript" src="{{asset('js/waves.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.countdown.js')}}"></script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126368920-2"></script>
		
		<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>

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