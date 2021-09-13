@extends('layouts.vendor')
@section('title')
    <title>Password Change</title>
@endsection
@section('breadcrumbhead')
    <h1>
        Password Change
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/vendor-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Password Change</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Password Change</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="login-box-body">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <p class="login-box-msg">You can change your password here</p>
                    <small>
                        @include('inc.message')
                    </small>

                    <form action="{{url('/vendor-confirm-change-password')}}" method="post">
                      {{csrf_field()}}
                      {{-- current password --}}
                      <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="old_password" placeholder="Old Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      </div>
                      {{-- new password --}}
                      <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      </div>
                      {{-- confirm new password --}}
                      <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      </div>

                      <div class="row">
                        <div class="col-xs-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                      </div>


                    </form>
                </div>
            </div>

        </div>

    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

@endsection