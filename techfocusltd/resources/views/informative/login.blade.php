@extends('informative.layouts.master')

@section('content')
		
{{-- 
<!-- SAB BANNER START-->
<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Login</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Login</li>
            </ul>
        </div>
    </div>
</div>
<!-- SAB BANNER END--> --}}

<!--D HELP LOGIN WRAP START-->
<div class="city_login_wrap" style="padding:20px 0px 140px 0px">
    <div class="container">
        <div class="city_login_list">
            <div class="city_login">
                <h4>sing in</h4>
                {{-- <p>welcome back ; sing in your account</p> --}}
                <form action="{{url('/loginAuthorization')}}" method="post" id="form-login" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <div class="city_commet_field">
                        <label>email address</label>
                        <input placeholder="email address" id="name-login" name="email" type="text" value="" data-default="Name*" size="30" required>
                    </div>
                    <div class="city_commet_field">
                        <label>password</label>
                        <input placeholder="password" name="password" id="password-login" type="password" value="" data-default="Name*" size="30" required>
                    </div>
                    <div class="city_checked">
                        <div class="checkbox_radio">
                            <input id="forget" type="checkbox" />
                            <label for="forget">Remember me</label>
                        </div>
                        <a class="city_forget" href="#" data-toggle="modal" data-target="#resetPassword">Lost your Paswword?</a>
                    </div>
                    <button type="submit" class="theam_btn" style="background:#1b6492 !important;">login</button>
                </form>	
                <span class="city_or">or</span>
            </div>
            <div class="city_login register">
                <h4>create new account</h4>
                {{-- <p>welcome back ; sing in your account</p> --}}
                <form action="{{url('/register')}}" method="post" id="form-register" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <div class="city_commet_field">
                        <label>email address</label>
                        <input placeholder=" email address" id="name-login" name="email" type="text" value="" data-default="Name*" size="30" required>
                    </div>
                    <div class="city_commet_field">
                        <label>password</label>
                        <input placeholder="password" name="password" id="password-login" type="password" value="" data-default="Name*" size="30" required>
                    </div>
                    <button type="submit" class="theam_btn" style="background:#1b6492 !important;">register</button>
                </form>
                <div class="city_register_list">
                    {{-- <h6>sing up today and you will be able to:</h6> --}}
                    {{-- <ul class="city_checkout_list"> --}}
                    <ul class="">
                        <li></li>
                    </ul>
                    @if(Session::has('register_mail'))
                        @php
                            $register_mail = \Illuminate\Support\Facades\Session::get('register_mail');
                        @endphp
                        <a href="{{url('/user/resend-verify-mail/'.$register_mail)}}">If not get verification mail, click here.</a>
                    @else
                        <a data-toggle="modal" data-target="#resendVerify" href="#">If not get verification mail, click here.</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!--D HELP LOGIN WRAP END-->
<!--reset password Modal Start -->
<div class="modal fade" id="resetPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Password Reset</h4>
        </div>
        <div class="modal-body">
            <div class="">
                <form action="{{url('password_reset')}}" method="post">
                    {{ csrf_field() }}
                    <div class="event_booking_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="event_booking_field">
                                    <input type="text" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="_method" value="PUT"/>
                                <button class="theam_btn btn2" type="submit">Send Password Reset Link</button>
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

<!--resend verification mail Modal Start -->
<div class="modal fade" id="resendVerify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Verification mail</h4>
        </div>
        <div class="modal-body">
            <div class="">
                <form action="{{url('/user/resend-verify-mail')}}" method="post">
                    {{ csrf_field() }}
                    <div class="event_booking_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="event_booking_field">
                                    <input type="text" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                
                                <button class="theam_btn btn2" type="submit">Send Verification Link</button>
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

@endsection