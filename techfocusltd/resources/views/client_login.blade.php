@extends('masterLayout')

@section('content')

    <section class="flat-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumbs">
                        <li class="trail-item">
                            <a href="{{url('/')}}" title="">Home</a>
                            <span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
                        </li>
                        <li class="trail-end">
                            <a href="#" title="">Login</a>
                        </li>
                    </ul><!-- /.breacrumbs -->
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.flat-breadcrumb -->

    <section class="flat-account background">
        <div class="container">
            <div class="row">
                <div class="col-md-3">

                </div><!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="form-login">
                        <div class="title">
                            <h3>Login</h3>
                        </div>
                        <form action="{{url('/loginAuthorization')}}" method="post" id="form-login" accept-charset="utf-8">
                            {{csrf_field()}}
                            <div class="form-box">
                                <label for="name-login">Username or email address * </label>
                                <input type="email" id="name-login" name="email" placeholder="Username or email address" required>
                            </div><!-- /.form-box -->
                            <div class="form-box">
                                <label for="password-login">Password * </label>
                                <input type="password" id="password-login" name="password" placeholder="******" required>
                            </div><!-- /.form-box -->
                            <div class="form-box checkbox">
                                <input type="checkbox" id="remember" checked name="remember">
                                <label for="remember">Remember me</label>
                            </div><!-- /.form-box -->
                            <div class="form-box">
                                <button type="submit" class="login">Login</button>
                            </div><!-- /.form-box -->
                        </form><!-- /#form-login -->
                    </div><!-- /.form-login -->
                </div><!-- /.col-md-6 -->
                <div class="col-md-3">

                </div><!-- /.col-md-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.flat-account -->

@endsection