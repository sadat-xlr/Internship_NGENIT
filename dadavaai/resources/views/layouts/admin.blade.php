<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  {{-- title --}}
    
  @yield('title')

    <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="shortcut icon" href="{{asset('admin/dadavaai-favicon.png')}}" type="image/x-icon">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
{{-- summernote --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="{{url('/admin-dashboard')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>D</b>V</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Dada</b>Vaai</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
               <!-- Messages: style can be found in dropdown.less-->
               <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    @php
                        $messages = \App\Query::whereDate('created_at', '=', \Carbon\Carbon::today())->get();
                    @endphp
                    <span class="label label-success">@if($messages->count() != 0) {{$messages->count()}} @endif</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have {{$messages->count()}} messages</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            @foreach($messages as $message)
                            <li><!-- start message -->
                                <a href="{{url('query/'.$message->id)}}">
                                    <div class="pull-left">
                                        <img src="{{asset('admin/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                        {{$message->name}}
                                        <small><i class="fa fa-clock-o"></i>{{date_format($message->created_at, 'd-M-Y')}}</small>
                                    </h4>
                                    <p>{{substr($message->message, '0', '32')}}</p>
                                </a>
                            </li>
                            <!-- end message -->
                            @endforeach
                        </ul>
                    </li>
                    <li class="footer"><a href="{{url('mailbox')}}">See All Messages</a></li>
                </ul>
            </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        @php
                            $orders = \App\Order::where('status',0)->whereDate('created_at', '=', \Carbon\Carbon::today())->get()->count();
                            $clients = \App\Client::whereDate('created_at', '=', \Carbon\Carbon::today())->get()->count();
                        @endphp
                        <span class="label label-warning">@if($orders + $clients != 0) {{$orders + $clients}} @endif</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{$orders + $clients}} notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @if($clients != 0)
                                <li>
                                    <a href="{{url('#')}}">
                                        <i class="fa fa-users text-aqua"></i> {{$clients}} new members joined today
                                    </a>
                                </li>
                                @endif
                                @if($orders != 0)
                                <li>
                                    <a href="{{url('all-order')}}">
                                        <i class="fa fa-shopping-cart text-green"></i> {{$orders}} sales made
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-flag-o"></i>
                    <span class="label label-danger"></span>
                    </a>
                    <ul class="dropdown-menu">
                    <li class="header">You have 9 tasks</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                        <li><!-- Task item -->
                            <a href="#">
                            <h3>
                                Design some buttons
                                <small class="pull-right">20%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">20% Complete</span>
                                </div>
                            </div>
                            </a>
                        </li>
                        <!-- end task item -->
                        <li><!-- Task item -->
                            <a href="#">
                            <h3>
                                Create a nice theme
                                <small class="pull-right">40%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">40% Complete</span>
                                </div>
                            </div>
                            </a>
                        </li>
                        <!-- end task item -->
                        <li><!-- Task item -->
                            <a href="#">
                            <h3>
                                Some task I need to do
                                <small class="pull-right">60%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">60% Complete</span>
                                </div>
                            </div>
                            </a>
                        </li>
                        <!-- end task item -->
                        <li><!-- Task item -->
                            <a href="#">
                            <h3>
                                Make beautiful transitions
                                <small class="pull-right">80%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">80% Complete</span>
                                </div>
                            </div>
                            </a>
                        </li>
                        <!-- end task item -->
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="#">View all tasks</a>
                    </li>
                    </ul>
                </li>
                @if (Auth::user())
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                        {{-- @php
                            $roles = \App\Role::all();
                        @endphp --}}
                        <p>
                            {{Auth::user()->name}} <br>
                        
                            {{Auth::user()->roles->pluck('name')}}
                            <small>Member since: {{Auth::user()->created_at->format('d-m-Y')}}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                        {{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
                        </div>
                        <div class="pull-right">
                            <form action="{{route('logout')}}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-flat">Sign out</button>
                            </form>
                        </div>
                    </li>
                    </ul>
                </li>
                @endif

                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
                </ul>
            </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                    <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>

                    {{-- dashboard --}}
                    <li class="active">
                        <a href="{{url('admin-dashboard')}}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            <span class="pull-right-container">
                            {{-- <i class="fa fa-angle-left pull-right"></i> --}}
                            </span>
                        </a>
                    </li>
                    @hasanyrole('super admin|Admin|bloger')
                    {{-- blogs --}}
                    <li class="treeview">
                        <a href="{{url('#')}}">
                            <i class="fa fa-pie-chart"></i> <span>Blogs</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{url('/blogs')}}">Blogs</a>
                            </li>
                            <li><a href="{{url('/add-blog')}}">Add Blog</a></li>
                        </ul>
                    </li>
                    @endhasanyrole
                    @hasanyrole('super admin|Admin')
                    {{-- maill --}}
                    <li class="treeview">
                        <a href="{{url('/mailbox')}}">
                            <i class="fa fa-envelope"></i> <span>Mailbox</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{url('/mailbox')}}">Inbox
                                    <span class="pull-right-container">
                                      <span class="label label-primary pull-right">13</span>
                                    </span>
                                </a>
                            </li>
                            <li><a href="{{url('/compose')}}">Compose</a></li>
                            <li><a href="{{url('/sents')}}">Sent</a></li>
                            <li><a href="{{url('/drafts')}}">Draft</a></li>
                        </ul>
                    </li>
                    @endhasanyrole
                    @hasanyrole('super admin|Admin')
                    {{-- user start --}}
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Manage user</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('roles')}}"><i class="fa fa-circle-o"></i> Roles</a></li>
                            <li><a href="{{url('permissions')}}"><i class="fa fa-circle-o"></i> Permission</a></li>
                            <li><a href="{{url('users')}}"><i class="fa fa-circle-o"></i> Users</a></li>
                            @hasrole('super admin')
                            <li><a href="{{url('register')}}"><i class="fa fa-circle-o"></i> Add New user</a></li>
                            @endhasrole

                        </ul>
                    </li>
                    {{-- user end --}}
                    @endhasanyrole

                    {{-- siteinfo start --}}
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Site Info</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('sliders')}}"><i class="fa fa-circle-o"></i> Sliders</a></li>
                            <li><a href="{{url('banners')}}"><i class="fa fa-circle-o"></i> Banners</a></li>
                            <li><a href="{{url('contacts')}}"><i class="fa fa-circle-o"></i> Contacts</a></li>
                            <li><a href="{{url('siteinfos')}}"><i class="fa fa-circle-o"></i> Siteinfos</a></li>
                            <li><a href="{{url('abouts')}}"><i class="fa fa-circle-o"></i> About</a></li>
                            <li><a href="{{url('policies')}}"><i class="fa fa-circle-o"></i> Terms & Policies</a></li>
                            <li><a href="{{url('faqs')}}"><i class="fa fa-circle-o"></i> Faqs</a></li>
                        </ul>
                    </li>
                    {{-- siteinfo end --}}

                    {{-- Product start--}}
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Product</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('categories')}}"><i class="fa fa-circle-o"></i> Category</a></li>
                            <li><a href="{{url('sub-categories')}}"><i class="fa fa-circle-o"></i> Sub-category</a></li>
                            <li><a href="{{url('mini-categories')}}"><i class="fa fa-circle-o"></i> Mini-category</a></li>
                            <li><a href="{{url('tabs')}}"><i class="fa fa-circle-o"></i> Tab</a></li>
                            <li><a href="{{url('brands')}}"><i class="fa fa-circle-o"></i> Brands</a></li>
                            <li><a href="{{url('tags')}}"><i class="fa fa-circle-o"></i> Tags</a></li>
                            <li><a href="{{url('colors')}}"><i class="fa fa-circle-o"></i> Colors</a></li>
                            <li><a href="{{url('sizes')}}"><i class="fa fa-circle-o"></i> Sizes</a></li>
                            <li><a href="{{url('products')}}"><i class="fa fa-circle-o"></i> Products</a></li>
                            <li><a href="{{url('services')}}"><i class="fa fa-circle-o"></i> Services</a></li>

                        </ul>
                    </li>
                    {{-- Product end--}}

                    {{-- Offers start--}}
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Offers</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{'bundle-offers'}}"><i class="fa fa-circle-o"></i> Bundle Offers</a></li>
                            <li><a href="{{'deals'}}"><i class="fa fa-circle-o"></i> Deals</a></li>
                            <li><a href="{{'luky-today'}}"><i class="fa fa-circle-o"></i> Luky Today</a></li>
                            <li><a href="{{url('productsads')}}"><i class="fa fa-circle-o"></i> productsads</a></li>
                            <li><a href="{{url('product-Informations')}}"><i class="fa fa-circle-o"></i> Ads single page</a></li>

                        </ul>
                    </li>
                    {{-- Offers end--}}

                    {{-- Client Start --}}
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Pre-book</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('pre-launching-product-list')}}"><i class="fa fa-circle-o"></i> Luanching product list</a></li>
                            <li><a href="{{url('#')}}"><i class="fa fa-circle-o"></i> Morris</a></li>
                        </ul>
                    </li>
                    {{-- Client End --}}

                    {{-- Client Start --}}
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Client</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('all-order')}}"><i class="fa fa-circle-o"></i> Orders</a></li>
                            <li><a href="{{url('pre-order-list')}}"><i class="fa fa-circle-o"></i> Pre Orders</a></li>
                        </ul>
                    </li>
                    {{-- Client End --}}

                    {{-- vendor Start --}}
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Vendor</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('all-vendor')}}"><i class="fa fa-circle-o"></i> Vendors</a></li>
                            <li><a href="{{url('order-for-vendor')}}"><i class="fa fa-circle-o"></i> Order For vendor</a></li>
                        </ul>
                    </li>
                    {{-- Client End --}}

                    {{-- ondemand Start --}}
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>On Demand/RFQ/product</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('ondemands')}}"><i class="fa fa-circle-o"></i>Ondemands</a></li>
                            <li><a href="{{url('requested-products')}}"><i class="fa fa-circle-o"></i>Vendors requested  Product</a></li>
                        </ul>
                    </li>
                    {{-- ondemand End --}}
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('breadcrumbhead')
                @yield('breadcrumb')
            </section>
            <!-- Main content -->
            <section class="content">

                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <footer class="main-footer">
            <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.13
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark" style="display: none;">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                        <p>Will be 23 on April 24th</p>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-user bg-yellow"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                        <p>New phone +1(800)555-1234</p>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                        <p>nora@example.com</p>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                        <p>Execution time 5 seconds</p>
                    </div>
                    </a>
                </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                        Custom Template Design
                        <span class="label label-danger pull-right">70%</span>
                    </h4>

                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                        Update Resume
                        <span class="label label-success pull-right">95%</span>
                    </h4>

                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                        Laravel Integration
                        <span class="label label-warning pull-right">50%</span>
                    </h4>

                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                        Back End Framework
                        <span class="label label-primary pull-right">68%</span>
                    </h4>

                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                    </div>
                    </a>
                </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    Report panel usage
                    <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                    Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    Allow mail redirect
                    <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                    Other sets of options are available
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    Expose author name in posts
                    <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                    Allow the user to show his name in blog posts
                    </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    Show me as online
                    <input type="checkbox" class="pull-right" checked>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    Turn off notifications
                    <input type="checkbox" class="pull-right">
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    Delete chat history
                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div>
                <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('admin/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Morris.js charts -->
    <script src="{{asset('admin/bower_components/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/morris.js/morris.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('admin/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- datepicker -->
    <script src="{{asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- CK Editor -->
    <script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>

    <!-- DataTables -->
    <script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('admin/dist/js/demo.js')}}"></script>
    <script src="{{asset('admin/dist/js/ajaxcrud.js')}}"></script>

    {{-- summernote --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
    

    <script>
    $(function () {
        $('#example1').DataTable();
        $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
        });
    });
    </script>
    <!-- page script -->
<script>
    // $(function () {
    //     $('#example1').DataTable({
    //         "order": []
    //     });
    //     CKEDITOR.replace('editor1');
    //     CKEDITOR.replace('editor');
    // });

    $(function(){
        // this will get the full URL at the address bar
        var url = window.location.href;

        // passes on every "a" tag
        $(".sidebar-menu a").each(function() {
            // checks if its the same on the address bar
            if(url == (this.href)) {
                $(this).closest("li").addClass("active");
                $(this).parents('.treeview').addClass("active menu-open");
            }
        });
    });

    @yield('script')
</script>
</body>
</html>
