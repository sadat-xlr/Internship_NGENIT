@extends('informative.layouts.master')

@section('content')
		

<!-- SAB BANNER START-->
<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>About</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("/")}}">Home</a></li>
                <li class="breadcrumb-item active">About</li>
            </ul>
        </div>
    </div>
</div>
<!-- SAB BANNER END-->

<!--D HELP LOGIN WRAP START-->
<div class="city_login_wrap" style="padding:20px 0px 140px 0px">
    <div class="container">
        <div class="city_login_list">
            <div class="city_login" style="width:100% !important;">
                <h4>About</h4>
                <div>
                        {!!$about->description!!}
                </div>
            </div>
            {{-- <div class="city_login register">
                <h4>create new account</h4>
            </div> --}}
        </div>
    </div>
</div>
<!--D HELP LOGIN WRAP END-->

@endsection