@extends('layouts.vendor')

@section('title')
    <title>Dadavaai | Dashboard</title>
@endsection

@section('breadcrumbhead')
    <h1>Dashboard</h1>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/vendor-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@endsection

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-12">
            <small>
                @include('inc.message')
            </small>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-xs-6 col-lg-offset-1 text-center">
            <!-- small box -->
            <div class="small-box bg-green">
                <a href="#" class="small-box-footer"><h4>MY RFQS</h4></a>
                <div class="inner">
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-compare">
                            <tr>
                                <th class="compare-label">Total RFQs</th>
                                <td class="">{{$totalRfs}}</td>
                            </tr>
                            <tr>
                                <th class="compare-label">Total RFQ Values</th>
                                <td class="">###</td>
                            </tr>
                            <tr>
                                <th>Total Pending RFQs</th>
                                <td>{{$totalPendingRfqs}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6 col-lg-offset-1 text-center">
            <!-- small box -->
            <div class="small-box bg-green">
                <a href="#" class="small-box-footer"><h4>MY ORDER</h4></a>
                <div class="inner">
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-compare">
                            <tr>
                                <th class="compare-label">Total Orders</th>
                                <td class="">{{$totalOrders}}</td>
                            </tr>
                            <tr>
                                <th class="compare-label">Total Orders Values</th>
                                <td class="">###</td>
                            </tr>
                            <tr>
                                <th>Total Pending Orders</th>
                                <td>{{$totalPendingOrders}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-xs-6 col-lg-offset-1 text-center">
            <!-- small box -->
            <div class="small-box bg-green">
                <a href="#" class="small-box-footer"><h4>MY DELIVERY</h4></a>
                <div class="inner">
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-compare">
                            <tr>
                                <th class="compare-label">Total Delivered</th>
                                <td class="">{{$totalDelivered}}</td>
                            </tr>
                            <tr>
                                <th class="compare-label">Total Pending Delivery</th>
                                <td class="">{{$totalPendingDelivery}}</td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6 col-lg-offset-1 text-center">
            <!-- small box -->
            <div class="small-box bg-green">
                <a href="#" class="small-box-footer"><h4>MY PRODUCT</h4></a>
                <div class="inner">
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-compare">
                            <tr>
                                <th class="compare-label">Total Products</th>
                                <td class="">{{$totalProducts}}</td>
                            </tr>
                            <tr>
                                <th class="compare-label">Total Ordered Products</th>
                                <td class="">#000</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-4 col-xs-6 col-lg-offset-1 text-center">
            <!-- small box -->
            <div class="small-box bg-green">
                <a href="#" class="small-box-footer"><h4>MY POINT</h4></a>
                <div class="inner">
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-compare">
                            <tr>
                                <th class="compare-label">Service Point</th>
                                <td class="">###</td>
                            </tr>
                            <tr>
                                <th class="compare-label">Delivery Point</th>
                                <td class="">###</td>
                            </tr>
                            <tr>
                                <th>Quality Point</th>
                                <td>###</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6 col-lg-offset-1 text-center">
            <!-- small box -->
            <div class="small-box bg-green">
                <a href="#" class="small-box-footer"><h4>MY PAYMENT</h4></a>
                <div class="inner">
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-compare">
                            <tr>
                                <th class="compare-label">Total Sales</th>
                                <td class="">{{$totalSales}}</td>
                            </tr>
                            <tr>
                                <th class="compare-label">Total Payment Received</th>
                                <td class="">{{$paymentRecieved}}</td>
                            </tr>
                            <tr>
                                <th>Total Outstanding</th>
                                <td>{{$totalSales - $paymentRecieved}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
    </div>
    <!-- /.row (main row) --> 
@endsection