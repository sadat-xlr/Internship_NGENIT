@extends('layouts.client')

@section('title')
    <title>Dadavaai | Client Dashboard </title>
@endsection

@section('content')
        <!-- CONTENT + SIDEBAR -->
        <div class="main-wrapper clearfix">
            <div class="site-pagetitle jumbotron">
                <div class="container  theme-container">
                    <!-- Breadcrumbs -->
                    <div class="breadcrumbs">
                        <div class="breadcrumbs">
                            <i class="fa fa-home"></i>
                            <span><a href="{{url('/')}}">Home</a></span>
                            <i class="fa fa-arrow-circle-right"></i>
                            <span> Client </span>
                            <i class="fa fa-arrow-circle-right"></i>
                            <span class="current red-clr"> Order History </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="theme-container container">
                <div class="gst-spc3 row">

                    @include('client.account.sidebar')


                    <main class="col-md-9 col-sm-8 blog-wrap">
                        <article class="" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                            <div class="account-details-wrap">
                                <div class="heading-2">                                
                                    <h3 class="title-3 fsz-18">CURRENT ORDERS</h3>                            
                                </div>

                                <div class="account-box">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <td>Order No</td>
                                                <td>Date</td>
                                                <td>Status</td>
                                                <td>Paid amount</td>
                                                <td>Action</td>
                                            </thead>
                                            <tbody>
                                            @foreach ($currentOrders->take(5) as $currentOrder)
                                                @if($currentOrder->payment_id != null)
                                                    @if($currentOrder->status != 8 || $currentOrder->status  != 5 )
                                                        <tr>
                                                            <td>#DVO{{$currentOrder->id}}</td>
                                                            <td>{{$currentOrder->created_at->format('Y-m-d')}}</td>
                                                            <td>
                                                                @if($currentOrder->status  == 0)
                                                                    order recived
                                                                @elseif($currentOrder->status  == 1)
                                                                    payment Pending
                                                                @elseif($currentOrder->status  == 2)
                                                                    payment recived
                                                                @elseif($currentOrder->status == 3)
                                                                    order processiong
                                                                @elseif($currentOrder->status  == 4)
                                                                    Cancelled
                                                                @elseif($currentOrder->status  == 5)
                                                                    Refunded
                                                                @elseif($currentOrder->status  == 6)
                                                                    Failed
                                                                @elseif($currentOrder->status  == 7)
                                                                    On shipment
                                                                @else
                                                                    Delivered
                                                                @endif
                                                            </td>
                                                            <td>Tk {{$currentOrder->payment->amount}}</td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a class="btn btn-default" target="_blank" href="{{url('client-order-invoice/'.$currentOrder->id)}}">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                                    </a>
                                                                    <a class="btn btn-default" href="#">
                                                                    <i class="fa fa-align-right" title="Align Right"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                            <div class="account-details-wrap">
                                <div class="heading-2">                                
                                    <h3 class="title-3 fsz-18">All your Order History</h3>                            
                                </div>

                                <div class="account-box">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <td>Order No</td>
                                                <td>Date</td>
                                                <td>Status</td>
                                                <td>Paid amount</td>
                                                <td>Action</td>
                                            </thead>
                                            <tbody>
                                            @foreach ($orders as $order)
                                                @if($order->payment_id != null)
                                                    <tr>
                                                        <td>#DVO{{$order->id}}</td>
                                                        <td>{{$order->created_at->format('Y-m-d')}}</td>
                                                        <td>
                                                            @if($order->status  == 0)
                                                                order recived
                                                            @elseif($order->status  == 1)
                                                                payment Pending
                                                            @elseif($order->status  == 2)
                                                                payment recived
                                                            @elseif($order->status == 3)
                                                                order processiong
                                                            @elseif($order->status  == 4)
                                                                Cancelled
                                                            @elseif($order->status  == 5)
                                                                Refunded
                                                            @elseif($order->status  == 6)
                                                                Failed
                                                            @elseif($order->status  == 7)
                                                                On shipment
                                                            @else
                                                                Delivered
                                                            @endif
                                                        </td>
                                                        <td>Tk {{$order->payment->amount}}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a class="btn btn-default" target="_blank" href="{{url('client-order-invoice/'.$order->id)}}">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                                </a>
                                                                <a class="btn btn-default" href="#">
                                                                <i class="fa fa-align-right" title="Align Right"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{ $orders->links() }}
                                    </div>
                                </div>
                            </div>
                        </article>
                    </main>  
                </div>
            </div>

            <div class="clear"></div>
        </div>
        <!-- / CONTENT + SIDEBAR -->
@endsection