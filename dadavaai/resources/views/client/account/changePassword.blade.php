@extends('layouts.client')

@section('title')
    <title>Dadavaai | Client Pawwsord Change </title>
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
                            <span class="current red-clr"> Change Password </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="theme-container container">
                <div class="gst-spc3 row">

                    @include('client.account.sidebar')
                    <main class="col-md-6 col-sm-6 blog-wrap">
                        <div>
                            <div class="login-wrap text-center">                        
                                <div class="chat-form">
                                    <h1 class="bold-font-2 fsz-12 signup"> Change Password </h1>

                                    <form action="{{url('client-confirm-change-password')}}" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <input type="password" name="old_password" placeholder="Old Password" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="new_password" placeholder="New Password" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <button class="alt fancy-button" type="submit"> <span class="fa fa-lightbulb-o"></span> Submit</button>
                                        </div>
                                    </form>
                                    <a class="red-clr" href="{{url('/forgot-password')}}">Forget Password?</a>
                                </div>
                            </div>
                        </div>
                    </main> 

                </div>
            </div>

            <div class="clear"></div>
        </div>
        <!-- / CONTENT + SIDEBAR -->
@endsection