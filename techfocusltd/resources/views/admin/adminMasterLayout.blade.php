<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bootstrapmaster.com/live/metro/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jan 2018 16:56:12 GMT -->
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>TechFocus Ltd Admin Panel - Focusing on Technology</title>
	<meta name="description" content="Metro Admin Template.">
	<meta name="author" content="Łukasz Holeczek">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('admin/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
	<link id="base-style" href="{{asset('admin/css/style.css')}}" rel="stylesheet">
	<link id="base-style-responsive" href="{{asset('admin/css/style-responsive.css')}}" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	
	<!-- start: jquery -->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 

	{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}
	<!-- App base_url-->
	<script> var base_url = {!! json_encode(url('/')) !!} </script>
	
	<!--<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>-->
	
	{{-- <link id="ie-style" href="css/ie.css" rel="stylesheet"> --}}
	
	{{-- <link id="ie9style" href="css/ie9.css" rel="stylesheet"> --}}
		
	<link rel="shortcut icon" href="{{asset('admin/img/favicon.ico')}}">
	<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

		
</head>

<body>
		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="{{URL::to('/dashboard')}}"><span>TechFocus</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white warning-sign"></i>
							</a>
							<ul class="dropdown-menu notifications">
								<li class="dropdown-menu-title">
 									<span>You have 11 notifications</span>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>	
                            	<li>
                                    <a href="#">
										<span class="icon blue"><i class="icon-user"></i></span>
										<span class="message">New user registration</span>
										<span class="time">1 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon green"><i class="icon-comment-alt"></i></span>
										<span class="message">New comment</span>
										<span class="time">7 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon green"><i class="icon-comment-alt"></i></span>
										<span class="message">New comment</span>
										<span class="time">8 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon green"><i class="icon-comment-alt"></i></span>
										<span class="message">New comment</span>
										<span class="time">16 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon blue"><i class="icon-user"></i></span>
										<span class="message">New user registration</span>
										<span class="time">36 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon yellow"><i class="icon-shopping-cart"></i></span>
										<span class="message">2 items sold</span>
										<span class="time">1 hour</span> 
                                    </a>
                                </li>
								<li class="warning">
                                    <a href="#">
										<span class="icon red"><i class="icon-user"></i></span>
										<span class="message">User deleted account</span>
										<span class="time">2 hour</span> 
                                    </a>
                                </li>
								<li class="warning">
                                    <a href="#">
										<span class="icon red"><i class="icon-shopping-cart"></i></span>
										<span class="message">Transaction was canceled</span>
										<span class="time">6 hour</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon green"><i class="icon-comment-alt"></i></span>
										<span class="message">New comment</span>
										<span class="time">yesterday</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon blue"><i class="icon-user"></i></span>
										<span class="message">New user registration</span>
										<span class="time">yesterday</span> 
                                    </a>
                                </li>
                                <li class="dropdown-menu-sub-footer">
                            		<a>View all notifications</a>
								</li>	
							</ul>
						</li>
						<!-- start: Notifications Dropdown -->
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white tasks"></i>
							</a>
							<ul class="dropdown-menu tasks">
								<li class="dropdown-menu-title">
 									<span>You have 17 tasks in progress</span>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>
								<li>
                                    <a href="#">
										<span class="header">
											<span class="title">iOS Development</span>
											<span class="percent"></span>
										</span>
                                        <div class="taskProgress progressSlim red">80</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="header">
											<span class="title">Android Development</span>
											<span class="percent"></span>
										</span>
                                        <div class="taskProgress progressSlim green">47</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="header">
											<span class="title">Django Project For Google</span>
											<span class="percent"></span>
										</span>
                                        <div class="taskProgress progressSlim yellow">32</div> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="header">
											<span class="title">SEO for new sites</span>
											<span class="percent"></span>
										</span>
                                        <div class="taskProgress progressSlim greenLight">63</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="header">
											<span class="title">New blog posts</span>
											<span class="percent"></span>
										</span>
                                        <div class="taskProgress progressSlim orange">80</div> 
                                    </a>
                                </li>
								<li>
                            		<a class="dropdown-menu-sub-footer">View all tasks</a>
								</li>	
							</ul>
						</li>
						<!-- end: Notifications Dropdown -->
						<!-- start: Message Dropdown -->
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white envelope"></i>
							</a>
							<ul class="dropdown-menu messages">
								
								@php
									$messages = DB::table('messages')->orderBy('id', 'desc')->limit(5)->get();
								@endphp

								<li class="dropdown-menu-title">
 									<span>You have {{$messages->count()}} messages</span>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>
								@foreach ($messages as $message)
									<li>
										<a href="#">
											<span class="avatar"><img src="{{asset('admin/img/avatar.jpg')}}" alt="Avatar"></span>
											<span class="header">
												<span class="from">
												{{$message->name}}
												 </span>
												<span class="time">
													{{$message->created_at}}
												</span>
											</span>
											<span class="message">
												{{$message->message}}
											</span>  
										</a>
									</li>
								@endforeach
							</ul>
						</li>
						<!-- end: Message Dropdown -->
						<li>
							<a class="btn" href="#">
								<i class="halflings-icon white wrench"></i>
							</a>
						</li>
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<img src="{{asset('storage/images/admin/'.Session::get('Image'))}}" alt="" height="40px" width="40px" style="border-radius: 50%">{{Session::get('Name')}}
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Account Settings</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="{{URL::to('/logout')}}"><i class="halflings-icon off"></i> Logout</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="{{URL::to('/dashboard')}}"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>	
						<li><a href="{{URL::to('/allMessages')}}"><i class="icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
						<li><a href="{{URL::to('/contact-messages')}}"><i class="icon-envelope"></i><span class="hidden-tablet"> Guest Query</span></a></li>
						<li><a href="{{URL::to('/compose')}}"><i class="icon-envelope"></i><span class="hidden-tablet"> Mail</span></a></li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> What We Do</span></a>
							<ul>
								<li><a class="submenu" href="{{url('/digital-innovations')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Digital Innovation</span></a></li>
								<li><a class="submenu" href="{{url('/cloud-datacenter')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Cloud+DataCenter</span></a></li>
								<li><a class="submenu" href="{{url('/connected-workforce')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Connected Workforce</span></a></li>
								<li><a class="submenu" href="{{url('/system-integration')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> System Integration</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Site Option</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/siteinfo')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Info</span></a></li>
								<li><a class="submenu" href="{{URL::to('/allInfo')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Info List</span></a></li>
								<li><a class="submenu" href="{{URL::to('/sliders')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sliders</span></a></li>
								<li><a class="submenu" href="{{URL::to('/vendors')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Vendors</span></a></li>
								<li><a class="submenu" href="{{URL::to('/principles')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> principles</span></a></li>

								<li><a class="submenu" href="{{URL::to('/banners')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Banners</span></a></li>
								<li><a class="submenu" href="{{URL::to('/top-requests')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Top request</span></a></li>
								<li><a class="submenu" href="{{URL::to('/announcements')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Announcement</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Update Pages</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addAbout')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> About Us</span></a></li>
								<li><a class="submenu" href="{{URL::to('/aboutInfo')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> About Info</span></a></li>
								<li><a class="submenu" href="{{URL::to('/addContact')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Contact Us</span></a></li>
								<li><a class="submenu" href="{{URL::to('/allContacts')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Contact Info</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Informative</span></a>
							<ul>	
								<li><a class="submenu" href="{{URL::to('/addWelcomeNote')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Welcome note</span></a></li>
								<li><a class="submenu" href="{{URL::to('/add-profile')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Profile </span></a></li>
								<li><a class="submenu" href="{{URL::to('/add-newsletter')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Newsletter </span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Solution </span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/add-solution')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Solution </span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-solutions')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> All Solution </span></a></li>

							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Sub-Solution </span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/add-subsolution')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Sub-Solution </span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-subSolutions')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> All Sub-Solution </span></a></li>

							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Service</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addservice')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add services</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Feature </span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/all-content')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> All feature</span></a></li>

								<li><a class="submenu" href="{{URL::to('/feature-content-create')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add feature</span></a></li>
							</ul>	
						</li>							
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Category</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addCategories')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Category</span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-category')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Category List</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Sub Category</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addSubCategory')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add SubCategory</span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-subCategories')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> SubCategory List</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Mini Category</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addMiniCategory')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add MiniCategory</span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-miniCategories')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> MiniCategory List</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Brand</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addBrands')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Brand</span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-brands')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Brand List</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Industry</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addIndustry')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Industry</span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-industries')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Industry List</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Technology</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addTechnology')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Technology</span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-technologies')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Technology List</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Color, Size, Tag</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/colors')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Color</span></a></li>
								<li><a class="submenu" href="{{URL::to('/sizes')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Size</span></a></li>
								<li><a class="submenu" href="{{URL::to('/tags')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Tag</span></a></li>
							</ul>
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Product</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addProduct')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Product</span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-products')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Product List</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Offers, Deals & Coupons</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/offers')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Offers</span></a></li>
								<li><a class="submenu" href="{{URL::to('/deals')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Deals</span></a></li>
								<li><a class="submenu" href="{{URL::to('/discounts')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Coupons</span></a></li>
							</ul>
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Client</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/customers')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Client</span></a></li>
								<li><a class="submenu" href="{{URL::to('/orders')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Order</span></a></li>
								<li><a class="submenu" href="{{URL::to('/membership_types')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Membership Type</span></a></li>
							</ul>
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Salseman</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/salesmen')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Salseman</span></a></li>
								<li><a class="submenu" href="{{URL::to('/salesmantargets')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Salseman target</span></a></li>
								<li><a class="submenu" href="{{URL::to('/targets')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Target vs Achieve</span></a></li>
								<li><a class="submenu" href="{{URL::to('/incentives')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Incentives</span></a></li>
								<li><a class="submenu" href="{{URL::to('/sectors')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sectors</span></a></li>
								<li><a class="submenu" href="{{URL::to('/subsectors')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Subsectors</span></a></li>
							</ul>
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Blog</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addBlog')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Blog</span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-blogs')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Blog List</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> News</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addNews')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add news</span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-news')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> News List</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Partner</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addPartner')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Partner</span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-partners')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Partner List</span></a></li>
							</ul>	
						</li>
						@if(Session::get('level') == 0)
						<li>
							<a class="dropmenu" href="#"><i class="icon-user"></i><span class="hidden-tablet"> User</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/addUser')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add User</span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-user')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> User List</span></a></li>
							</ul>	
						</li>
						@endif
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Job</span></a>
							<ul>
								<li><a class="submenu" href="{{URL::to('/add-job')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Job</span></a></li>
								<li><a class="submenu" href="{{URL::to('/all-jobs')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Job List</span></a></li>
								<li><a class="submenu" href="{{URL::to('/application-list')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Application List</span></a></li>
							</ul>	
						</li>
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="{{URL::to('/dashboard')}}">Home</a> 
						<i class="icon-angle-right"></i>
					</li>
					@yield('breadcrumb')
				</ul>
				@include('admin.messages')
				@yield('adminContent')
			</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<footer>

		<p>
			<span style="text-align:center;">&copy; <script>document.write(new Date().getFullYear());</script> <a href="#" alt="Bootstrap Themes">TechFocus Ltd - Focusing on Technology.</a></span>
		</p>

	</footer>
	
	<!-- start: JavaScript-->

		<script src="{{asset('admin/js/jquery-1.9.1.min.js')}}"></script>
		<script src="{{asset('admin/js/jquery-migrate-1.0.0.min.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery-ui-1.10.0.custom.min.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.ui.touch-punch.js')}}"></script>
	
		<script src="{{asset('admin/js/modernizr.js')}}"></script>
	
		<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.cookie.js')}}"></script>
	
		<script src="{{asset('admin/js/fullcalendar.min.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>

		<script src="{{asset('admin/js/excanvas.js')}}"></script>
		<script src="{{asset('admin/js/jquery.flot.js')}}"></script>
		<script src="{{asset('admin/js/jquery.flot.pie.js')}}"></script>
		<script src="{{asset('admin/js/jquery.flot.stack.js')}}"></script>
		<script src="{{asset('admin/js/jquery.flot.resize.min.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.chosen.min.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.uniform.min.js')}}"></script>
		
		<script src="{{asset('admin/js/jquery.cleditor.min.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.noty.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.elfinder.min.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.raty.min.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.iphone.toggle.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.uploadify-3.1.min.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.gritter.min.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.imagesloaded.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.masonry.min.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.knob.modified.js')}}"></script>
	
		<script src="{{asset('admin/js/jquery.sparkline.min.js')}}"></script>
	
		<script src="{{asset('admin/js/counter.js')}}"></script>
	
		<script src="{{asset('admin/js/retina.js')}}"></script>

		<script src="{{asset('admin/js/custom.js')}}"></script>

		<!-- Ajax CRUD -->
		<script src="{{asset('admin/js/ajaxcrud.js')}}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>

	<!-- end: JavaScript-->
		@yield('script')
	
</body>

</html>