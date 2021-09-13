
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top: 100px;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <a href="{{url('/')}}" class="thm-logo fsz-10">
                        <img src="{{asset('client/img/logo/dadavaai.png')}}" width="300px" alt="Dadavaai" >
                        <!-- <b class="bold-font-3 wht-clr"> Dadavaai </b> <span class="thm-clr funky-font"> bikes </span> -->
                    </a>
                </div>

                <div class="panel-body">
                    <div class="text-center panel-heading">Reset Password</div>
    
                    
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

