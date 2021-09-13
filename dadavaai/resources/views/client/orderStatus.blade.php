@extends('layouts.client')

@section('title')
    <title>Order Status | Dadavaai </title>
@endsection

@section('content')
<div class="site-pagetitle jumbotron">
    <div class="container  theme-container">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="breadcrumbs">
                <i class="fa fa-home"></i>
                <span><a href="{{url('/')}}">Home</a></span>
                <i class="fa fa-arrow-circle-right"></i>
                <span class="current red-clr"> Order Status  </span>
            </div>
        </div>
    </div>
</div>
<div class="theme-container container">
    <div class="gst-spc3 row">
        <main class="col-md-12 col-sm-12 blog-wrap">
            <div class="flex  mt-4 spcbt-30" >
                @if ($order->status == 0)
                    <div class="bg-white flex flex-1 p-4 rounded-lg shadow-md">
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>order recived</h5>

                            {{date('d-M-Y', strtotime($order->tracking->step_1))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>payment</h5>
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>Order processing</h5>
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>On shipment</h5>
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>Delivered</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_5))}}
                            [Tentative]
                        </div>
                    </div>
                @endif

                @if ($order->status == 1)
                    <div class="bg-white flex flex-1 p-4 rounded-lg shadow-md">
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>order recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_1))}}
                            
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>payment pending</h5>
                            {{date('d-M-Y', strtotime($order->updated_at))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>Order processing</h5>
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>On shipment</h5>
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>Delivered</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_5))}}
                            [Tentative]

                        </div>
                    </div>
                @elseif ($order->status == 2)
                    <div class="bg-white flex flex-1 p-4 rounded-lg shadow-md">
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>order recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_1))}}
                            
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>payment recived</h5>
                            {{date('d-M-Y', strtotime($order->updated_at))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>Order processing</h5>
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>On shipment</h5>
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>Delivered</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_5))}}
                            [Tentative]
                        </div>
                    </div>
                @endif

                @if ($order->status == 3)
                    <div class="bg-white flex flex-1 p-4 rounded-lg shadow-md">
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>order recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_1))}}
                            
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>payment recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_2))}}
                            
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>Order processing</h5>
                            {{date('d-M-Y', strtotime($order->updated_at))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>On shipment</h5>
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>Delivered</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_5))}}
                            [Tentative]
                        </div>
                    </div>
                @elseif($order->status == 4)

                    <div class="bg-white flex flex-1 p-4 rounded-lg shadow-md">
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>order recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_1))}}
                            
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>payment recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_2))}}
                            
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-times fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>cancelled</h5>
                            {{date('d-M-Y', strtotime($order->updated_at))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>On shipment</h5>
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>Delivered</h5>
                        </div>
                    </div>

                @elseif($order->status == 5)

                    <div class="bg-white flex flex-1 p-4 rounded-lg shadow-md">
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>order recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_1))}}
                            
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>payment recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_2))}}
                            
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-times fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>refunded</h5>
                            {{date('d-M-Y', strtotime($order->updated_at))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>On shipment</h5>
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>Delivered</h5>
                        </div>
                    </div>

                @elseif($order->status == 6)
                    <div class="bg-white flex flex-1 p-4 rounded-lg shadow-md">
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>order recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_1))}}
                            
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>payment recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_2))}}
                            
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-times fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>failed</h5>
                            {{date('d-M-Y', strtotime($order->updated_at))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>On shipment</h5>
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>Delivered</h5>
                        </div>
                    </div>
                    
                @endif


                @if ($order->status == 7)
                    <div class="bg-white flex flex-1 p-4 rounded-lg shadow-md">
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>order recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_1))}}
                            
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>payment recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_2))}}
                            
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>Order processing</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_3))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>On shipment</h5>
                            {{date('d-M-Y', strtotime($order->updated_at))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true"></i>            
                            </span>
                            <h5>Delivered</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_5))}}
                            [Tentative]
                        </div>
                    </div>
                @endif
                @if ($order->status == 8)
                    <div class="bg-white flex flex-1 p-4 rounded-lg shadow-md">
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>order recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_1))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>payment recived</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_2))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>Order processing</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_3))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-long-arrow-right fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>On shipment</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_4))}}
                        </div>
                        <div class="col-md-2 p-20 m-10">
                            <span>
                                <i class="fa fa-check-circle fa-5x" aria-hidden="true" style="color:#ed1c24;"></i>            
                            </span>
                            <h5>Delivered</h5>
                            {{date('d-M-Y', strtotime($order->tracking->step_5))}}
                        </div>
                    </div>
                @endif
            </div>
            <div>
                <div class="login-wrap">                        
                    <div class="chat-form col-md-8 col-sm-6">
                        <h1 class="bold-font-2 fsz-18 signup"> Order Details </h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Qut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $item)
                                <tr>
                                    <td>{{$item->product->productName}}</td>
                                    <td>{{$item->quantity}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="chat-form col-md-4 col-sm-6">
                        <h1 class="bold-font-1 fsz-12 signup"> Delivery Address </h1>
                        Name:{{$order->shipping->name}} <br>
                        Phone:{{$order->shipping->phone}} <br>
                        {{$order->shipping->address}},{{$order->shipping->town}},{{$order->shipping->division}}-{{$order->shipping->zipCode}},{{$order->shipping->country}}

                    </div>
                </div>
            </div>
        </main>  
    </div>
</div>
<!-- / Contact Us Ends -->
<div class="clear"></div>
@endsection