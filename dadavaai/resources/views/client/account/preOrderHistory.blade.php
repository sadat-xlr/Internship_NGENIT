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
                                    <h3 class="title-3 fsz-18">All your Pre Book History</h3>                            
                                </div>

                                <div class="account-box">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <td>Pre Order No</td>
                                                <td>Date</td>
                                                <td>Paid amount</td>
                                                <td>Due</td>
                                                <td>Action</td>
                                            </thead>
                                            <tbody>
                                            @foreach ($preOrders as $preOrder)
                                                <tr>
                                                    <td>#{{$preOrder->id}}</td>
                                                    <td>{{$preOrder->created_at->format('Y-m-d')}}</td>

                                                    @php
                                                        $paid_amount = 0;
                                                       
                                                        foreach($preOrder->preorderPayments as $preorderPayment)
                                                        {
                                                            $paid_amount += $preorderPayment->payment->amount;
                                                        }

                                                        $paid_amount += $preOrder->payment->amount;

                                                    @endphp


                                                    <td>Tk {{number_format($paid_amount, 2)}}</td>
                                                    <td>Tk {{ number_format($preOrder->totalAmount - $paid_amount, 2)}}</td>
                                                    <td>
                                                        <form action="{{url('pre-order-remaining-payment')}}" method="post">
                                                            <div class="btn-group">
                                                                <a class="btn btn-default" target="_blank" href="{{url('client-preorder-invoice/'.$preOrder->id)}}">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                                </a>
                                                                @if ($paid_amount < $preOrder->totalAmount)
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="preorder_id" value="{{$preOrder->id}}">
                                                                        <button class="btn btn-danger" type="submit">
                                                                            Pay now
                                                                        </button>
                                                                    
                                                                @elseif( $paid_amount == $preOrder->totalAmount)
                                                                    <a class="btn btn-success" target="_blank" href="{{url('client-preorder-invoice/'.$preOrder->id)}}">
                                                                        payment complete
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{ $preOrders->links() }}
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