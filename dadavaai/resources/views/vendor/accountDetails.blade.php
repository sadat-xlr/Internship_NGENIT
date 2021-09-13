@extends('layouts.vendor')
@section('title')
    <title>Profile</title>
@endsection
@section('breadcrumbhead')
    <h1>
        Profile
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/vendor-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Profile</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="login-box-body">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <p class="login-box-msg">You can change your Profile here</p>
                    <small>
                        @include('inc.message')
                    </small>

                    <form action="{{url('/vendor-profile-update/'.$vendor->id)}}" method="post">
                      {{ csrf_field() }}
                      <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="vendor_name" placeholder="Full name" value="{{$vendor->vendorName}}">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                      </div>
                      <div class="form-group has-feedback">
                        <input type="email" class="form-control" name="vendor_email" placeholder="Email" required value="{{$vendor->email}}" disabled>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                      </div>
                      <div class="form-group has-feedback">
                        <input type="number" class="form-control" name="vendor_phone" placeholder="Phone number" required value="{{$vendor->phone}}">
                        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                      </div>

                      <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="store_name" placeholder="Store Name" value="{{$vendor->storeName}}">
                        <span class="glyphicon glyphicon-name form-control-feedback"></span>
                      </div>

                      <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="vendor_address" placeholder="Address" value="{{$vendor->address}}">
                        <span class="glyphicon glyphicon-building form-control-feedback"></span>
                      </div>

                      <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="vendor_city" placeholder="City" value="{{$vendor->city}}">
                        <span class="glyphicon glyphicon-city form-control-feedback"></span>
                      </div>

                      <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="vendor_country" placeholder="Country" value="{{$vendor->country}}">
                        <span class="glyphicon glyphicon-country form-control-feedback"></span>
                      </div>

                      <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="vendor_zipCode" placeholder="Zip Code" value="{{$vendor->zipCode}}">
                        <span class="glyphicon glyphicon-zipcode form-control-feedback"></span>
                      </div>
                      
                      
                      <div class="row">
                        <div class="col-xs-8">
                          
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                          <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
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