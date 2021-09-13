@extends('layouts.client')

@section('title')
    <title>Dadavaai | Login Registration </title>
@endsection

@section('content')
        <!-- CONTENT + SIDEBAR -->
        <div class="main-wrapper clearfix">
            {{-- <div class="site-pagetitle jumbotron">
                <div class="container  theme-container">
                    <h3>Login Registration</h3>

                    <div class="breadcrumbs">
                        <div class="breadcrumbs">
                            <i class="fa fa-home"></i>
                            <span><a href="{{url('/')}}">Home</a></span>
                            <i class="fa fa-arrow-circle-right"></i>
                            <span class="current"> Account Information </span>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="theme-container container">
                <div class="gst-spc3 row">

                    <main id="signup_form" class="col-lg-6 col-md-8 col-sm-6 col-lg-offset-3 col-md-offset-2  hide blog-wrap">
                        <article class="" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                            <div class="account-details-wrap">
                                <div class="heading-2">                                
                                    <h3 class="title-3 fsz-18">Registration 
                                        <span  style="font-size: 13px !important; text-transform: none;">
                                            <u> <a id="signin_option" class="red-clr" href="#">(Have a account? Cliek here to sign in)</a></u>
                                        </span>
                                    </h3>                            
                                </div>

                                <div id="registration-block" class="account-box">
                                    <form id="registration" class="form-delivery" action="#" method="POST">
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group"><input class="form-control" type="text" name="clientName" placeholder="Name" style="text-transform:unset" required></div>
                                                <span class="right" style="position:absolute;
                                                    color:#f13f3f;
                                                    top:10px;
                                                    left: 5px;
                                                    font-size:18px;">*
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><input class="form-control" type="text" name="email" placeholder="Email" required></div>
                                                <span class="right" style="position:absolute;
                                                    color:#f13f3f;
                                                    top:10px;
                                                    left: 5px;
                                                    font-size:18px;">*
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><input class="form-control" type="text" name="address" placeholder="Address"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><input class="form-control" type="text" name="city" placeholder="City"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group selectpicker-wrapper">                                
                                                    <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Country" name="country">
                                                        <option value="bangladesh" selected>Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group selectpicker-wrapper">
                                                    <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Division" name="division">
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
                                            <div class="col-md-4">
                                                <div class="form-group"><input class="form-control" type="text" name="zipCode" placeholder="Postcode/ZIP"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group"><input class="form-control" type="text" name="phone" placeholder="Phone Number" required style="text-transform:unset"></div>
                                                <span class="right" style="position:absolute;
                                                    color:#f13f3f;
                                                    top:10px;
                                                    left: 5px;
                                                    font-size:18px;">*
                                                </span>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" required style="text-transform:unset"></div>
                                                <span class="right" style="position:absolute;
                                                    color:#f13f3f;
                                                    top:10px;
                                                    left: 5px;
                                                    font-size:18px;">*
                                                </span>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <p style="text-transform:unset;color: #f13f3f;">
                                                        ** Red input box is mandatory
                                                    </p>
                                                </div>
                                            </div>  
                                            <div class="col-md-12 col-sm-12">
                                                <button class="alt fancy-button" type="submit">Submit</button>                                                                       
                                            </div>
                                        </div>
                                    </form>                   
                                </div>
                                <div id="active-account" class="hide">
                                    <p class="wht-clr" style="background-color: green;padding: 10px;">
                                        Congratulations! You have successfully registered. We have send you an E-mail. Please check that E-mail & click on the link in the mail to activate your account and Do login. Thank you.
                                    </p>
                                </div>
                            </div>
                        </article>
                    </main>    

                    <main id="signin_form" class="col-lg-6 col-md-8 col-sm-6 col-lg-offset-3 col-md-offset-2 ">
                        <article class="" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                            <div class="account-details-wrap">
                                <div class="heading-2">                                
                                    <h3 class="title-3 fsz-18">Login
                                        <span  style="font-size: 13px !important; text-transform: none;">
                                            <u> <a id="signup_option" class="red-clr" href="#">( Not yet member? Click here to sign up )</a></u>
                                        </span>
                                    </h3>                            
                                </div>

                                <div class="account-box">
                                    <div class="modal-content login-1 blk-clr">   
                                        <div class="login-wrap text-center">                        
                                            <p class="fsz-15 bold-font-4"> Do you know that dadavaai is here for managing<br>all of your <span class="thm-clr">  on-demand  </span>products </p>                       
                         
                                            <div class="login-form">
                                                <a class="fb-btn btn spcbtm-15" href="{{url('/facebook-login-redirect')}}"> <i class="fa fa-facebook btn-icon"></i>Login with Facebook </a>
                        
                                                <p class="bold-font-2 fsz-12 signup"> OR SIGN IN </p>
                        
                                                <form action="{{url('client-login')}}" method="GET">
                                                    {{-- {{ csrf_field() }} --}}
                                                    <div class="form-group"><input type="text" name="email" placeholder="Email" class="form-control"></div>
                                                    <div class="form-group"><input type="password" name="password" placeholder="Password" class="form-control"></div>
                                                    <div class="form-group">
                                                        <button class="alt fancy-button" type="submit"> <span class="fa fa-lightbulb-o"></span> Login</button>
                                                        <u> <a class="blk-clr" href="{{url('forgot-password')}}">( Forget Password? )</a></u>
                                                    </div>
                                                </form>
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