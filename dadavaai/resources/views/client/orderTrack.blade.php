@extends('layouts.client')

@section('title')
    <title>Track Order | Dadavaai </title>
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
                <span class="current red-clr"> Track Order  </span>
            </div>
        </div>
    </div>
</div>
<div class="theme-container container">
    <div class="gst-spc3 row">
        <main class="col-md-6 col-md-offset-3 col-sm-6 blog-wrap">
            <div>
                <div class="login-wrap text-center">                        
                    <div class="chat-form">
                        <h1 class="bold-font-2 fsz-12 signup"> Track your order Now </h1>

                        <form action="{{url('order-status')}}" method="GET">
                            <div class="form-group">
                                <input type="number" name="order_id" placeholder="Order Id" class="form-control" min="1" style="text-transform: unset;" required>
                            </div>
                            @php
                                $client_id = \Illuminate\Support\Facades\Session::get('CLIENT_ID');
                                $client = \App\Client::find($client_id);
                            @endphp
                            @if($client)
                                <div class="form-group">
                                    <input type="email" id="email" name="email" placeholder="Email" value="{{$client->email}}" class="form-control" required>
                                </div>
                            @else
                                <div class="form-group">
                                    <input type="email" id="email" name="email" placeholder="Email" class="form-control" required>
                                </div>
                            @endif
                            <div class="form-group">
                                <button class="alt fancy-button" type="submit"> <span class="fa fa-lightbulb-o"></span> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>  
    </div>
</div>
<!-- / Contact Us Ends -->
<div class="clear"></div>
@endsection