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
                            <span class="current red-clr"> Payment History </span>
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
                                    <h3 class="title-3 fsz-18">Pre Book payment history</h3>                            
                                </div>

                                <div class="account-box">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <td>Order No</td>
                                                <td>Ordered date</td>
                                                <td>Payment Id</td>
                                                <td>Status</td>
                                                <td>Total Amount (Tk)</td>
                                                <td>Paid Amount (Tk)</td>
                                                <td>Due (Tk)</td>
                                            </thead>
                                            <tbody>
                                            @foreach ($preOrders->take(5) as $preOrder)
                                                @if($preOrder->payment_id != null)
                                                    @php
                                                        $paid_amount = 0;
                                                    
                                                        foreach($preOrder->preorderPayments as $preorderPayment)
                                                        {
                                                            $paid_amount += $preorderPayment->payment->amount;
                                                        }

                                                        $paid_amount += $preOrder->payment->amount;

                                                    @endphp
                                                    <tr>
                                                        <td>#DVPO{{$preOrder->id}}</td>
                                                        <td>{{$preOrder->created_at->format('Y-m-d')}}</td>
                                                        <td>#{{$preOrder->payment->id}}</td>
                                                        <td>
                                                            @if($preOrder->status  == 0)
                                                                order recived
                                                            @elseif($preOrder->status  == 1)
                                                                payment Pending
                                                            @elseif($preOrder->status  == 2)
                                                                payment recived
                                                            @elseif($preOrder->status == 3)
                                                                order processiong
                                                            @elseif($preOrder->status  == 4)
                                                                Cancelled
                                                            @elseif($preOrder->status  == 5)
                                                                Refunded
                                                            @elseif($preOrder->status  == 6)
                                                                Failed
                                                            @elseif($preOrder->status  == 7)
                                                                On shipment
                                                            @else
                                                                Delivered
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{$preOrder->totalAmount}}
                                                        </td>
                                                        <td>
                                                            {{$paid_amount}}
                                                        </td>
                                                        <td>
                                                            {{$preOrder->totalAmount - $paid_amount}}
                                                        </td>
                                                    </tr>
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
                                    <h3 class="title-3 fsz-18">DELIVERY LIST</h3>                            
                                </div>

                                <div class="account-box">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <td>Order No</td>
                                                <td>Ordered date</td>
                                                <td>Payment Id</td>
                                                <td>Total Amount (Tk)</td>
                                                <td>Paid Amount (Tk)</td>
                                                <td>Due (Tk)</td>
                                                <td>Status</td>
                                            </thead>
                                            <tbody>
                                            @foreach ($orders->take(5) as $order)
                                                @if($order->payment_id != null)
                                                    <tr>
                                                        <td>#DVPO{{$order->id}}</td>
                                                        <td>{{$order->created_at->format('Y-m-d')}}</td>
                                                        <td>#{{$order->payment->id}}</td>
                                                        <td>
                                                            {{$order->totalAmount}}
                                                        </td>
                                                        <td>
                                                            {{$order->payment->amount}}
                                                        </td>
                                                        <td>
                                                            {{$order->totalAmount - $order->payment->amount}}
                                                        </td>
                                                        <td>
                                                            @if($order->totalAmount == $order->payment->amount)
                                                                Paid
                                                            @else
                                                                Due
                                                            @endif
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