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
                            <a href="#" title="">Password reset</a>
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
                    <div class="form-login" style="height: auto">
                        <div class="title">
                            <h3>Login</h3>
                        </div>
                        <form class="form-horizontal" id="reset" method="POST" onsubmit="resetPass(event)" action="{{ url('passwordReset') }}">
                            <div class="form-box">
                                <label for="name-login">Username or email address * </label>
                                <input id="email" type="email" placeholder="Your registered email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                                <p class="error-email text-center alert alert-danger hidden" style="display: none"></p>
                            </div><!-- /.form-box -->
                            <div class="form-box">
                                <label for="password-login">Password * </label>
                                <input id="password" type="password" class="form-control" placeholder="******" name="password" required>
                                <p class="error-password text-center alert alert-danger hidden" style="display: none"></p>
                            </div><!-- /.form-box -->
                            <div class="form-box">
                                <label for="password-login">Confirm Password * </label>
                                <input id="password-confirm" type="password" class="form-control" placeholder="******" name="password_confirmation" required>
                                <p class="error-password-confirm text-center alert alert-danger hidden" style="display: none"></p>
                            </div><!-- /.form-box -->
                            <div class="form-box">
                                <button type="submit" class="login">Reset Password</button>
                            </div><!-- /.form-box -->
                        </form><!-- /#form-login -->
                    </div><!-- /.form-login -->
                </div><!-- /.col-md-6 -->
                <div class="col-md-3">

                </div><!-- /.col-md-6 -->
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        //Handle register form submit.
        function resetPass(e) {
            // Stop the browser from submitting the form.
            e.preventDefault();

            // Get the form.
            var form = $('#reset');

            // Serialize the form data.
            var formData = $(form).serialize();

            // Submit the form using AJAX.
            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: formData,
                success: function(data){
                    if ((data.errors)) {
                        $('.alert').hide();
                        if (typeof data.errors.email !== 'undefined') {
                            $('.error-email').show();
                            $('.error-email').text(data.errors.email);
                        };
                        if (typeof data.errors.confirm !== 'undefined') {
                            $('.error-password-confirm').show();
                            $('.error-password-confirm').text(data.errors.confirm);
                        };
                    }else {
                        $(location).attr("href", "client-login");
                    }
                }
            });
        }
    </script>
@endsection
