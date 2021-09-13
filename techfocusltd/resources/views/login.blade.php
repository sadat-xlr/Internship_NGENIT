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
									<a href="#" id="forgotPass" title="">Lost your password?</a>
								</div><!-- /.form-box -->
							</form><!-- /#form-login -->
						</div><!-- /.form-login -->
					</div><!-- /.col-md-6 -->
					<div class="col-md-6">
						<div class="form-register">
							<div class="title">
								<h3>Register</h3>
							</div>
							<form action="{{url('/register')}}" method="post" id="form-register" accept-charset="utf-8">
							{{csrf_field()}}
								<div class="form-box">
									<label for="name-register">Email address * </label>
									<input type="email" id="name-register" name="email" placeholder="Your email address" required>
								</div><!-- /.form-box -->
								<div class="form-box">
									<label for="password-register">Password * </label>
									<input type="password" id="password-register" name="password" placeholder="******" required>
								</div><!-- /.form-box -->
								<div class="form-box">
									<button type="submit" class="register">Register</button>
								</div><!-- /.form-box -->
							</form><!-- /#form-register -->
						</div><!-- /.form-register -->
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-account -->

		<section class="flat-row flat-iconbox style1 background">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-lg-3">
						<div class="iconbox style1 v1">
							<div class="box-header">
								<div class="image">
									<img src="{{asset('images/icons/car.png')}}" alt="">
								</div>
								<div class="box-title">
									<h3>Worldwide Shipping</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-6 col-lg-3 -->
					<div class="col-md-6 col-lg-3">
						<div class="iconbox style1 v1">
							<div class="box-header">
								<div class="image">
									<img src="{{asset('images/icons/order.png')}}" alt="">
								</div>
								<div class="box-title">
									<h3>Order Online Service</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-6 col-lg-3 -->
					<div class="col-md-6 col-lg-3">
						<div class="iconbox style1 v1">
							<div class="box-header">
								<div class="image">
									<img src="{{asset('images/icons/payment.png')}}" alt="">
								</div>
								<div class="box-title">
									<h3>Payment</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-6 col-lg-3 -->
					<div class="col-md-6 col-lg-3">
						<div class="iconbox style1 v1">
							<div class="box-header">
								<div class="image">
									<img src="{{asset('images/icons/return.png')}}" alt="">
								</div>
								<div class="box-title">
									<h3>Return 30 Days</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-6 col-lg-3 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-iconbox -->

		<!-- Modal -->
		<div class="modal fade" id="password_reset" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title"></h1>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="footer-subscribe">
							<form action="{{url('password_reset')}}" id="password-reset-form">
								<p class="success text-center alert alert-success hidden" style="display: none"></p>
								<p class="error text-center alert alert-danger hidden" style="display: none"></p>
								<input type="email" name="email" placeholder="Email Address..." required/>
								<input type="hidden" name="_method" value="PUT"/>
								<button class="btn btn-warning" type="submit">Send Password Reset Link</button>
							</form>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>

@endsection