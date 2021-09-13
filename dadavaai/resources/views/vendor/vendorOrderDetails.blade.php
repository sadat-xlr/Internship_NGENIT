@extends('layouts.vendor')
@section('title')
    <title>Products</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Order details
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/vendor-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/vendor-orders')}}"></i> order</a></li>
        <li class="active">Order details</li>
    </ol>
@endsection

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">order #{{$order_id}} </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>qunatity</th>
                    <th>Total Price(TK)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orderedProductDetails as $orderedProductDetail)
                    <tr id="orderedProductDetail{{$orderedProductDetail->id}}">
                        <td>{{$orderedProductDetail->product->productName}}</td>
                        <td><img src="{{asset('storage/images/product/'.$orderedProductDetail->product->image->image1)}}" height="100px" width="100px"/></td>
                        <td>{{$orderedProductDetail->qty}}</td>
                        <td>{{$orderedProductDetail->totalPrice}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection
