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
                            <a href="#" title="">Salesman Login</a>
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
                        <form action="{{url('/salesmen_auth')}}" method="post" onsubmit="login(event)" id="login" accept-charset="utf-8">
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
                                <a href="#" title="">Lost your password?</a>
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

@section('script')
    <script>
        //Handle login form submit.
        function login(e) {
            // Stop the browser from submitting the form.
            e.preventDefault();

            // Get the form.
            var form = $('#login');

            // Serialize the form data.
            var formData = $(form).serialize();

            // Submit the form using AJAX.
            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: formData,
                success: function(data){
                    if ((data.errors)) {
                        $('.err').remove();
                        $('#message').modal('show');
                        $('.wmessage').css('color', 'red');
                        $('.modal-title').css('color', 'red');
                        $('.modal-title').text('Oops!');
                        if (typeof data.errors.email !== 'undefined') {
                            $('.wmessage').append("<li class='err'>" + data.errors.email + "</li>");
                        }
                        if (typeof data.errors.response !== 'undefined') {
                            $('.wmessage').append("<li class='err'>" + data.errors.response + "</li>");
                        }
                        if (typeof data.errors.password !== 'undefined') {
                            $('.wmessage').append("<li class='err'>" + data.errors.password + "</li>");
                        }
                    } else {
                        var id = data.id;
                        $(location).attr("href", "salesmen/" + data.id);
                    }
                }
            });
        }
    </script>
@endsection