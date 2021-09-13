@extends('layouts.client')

@section('title')
    <title>Dadavaai | On demand history </title>
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
                            <span class="current red-clr"> Ondemand History </span>
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
                                    <h3 class="title-3 fsz-18">All your Ondemand/Rfq History</h3>                            
                                </div>

                                <div class="account-box">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <td>Id</td>
                                                <td>Date</td>
                                                <td>Name</td>
                                                <td>Qty</td>
                                                <td>Unit</td>
                                                <td>Quotation</td>
                                                <td>Action</td>
                                            </thead>
                                            <tbody>
                                            @foreach ($ondemands as $ondemand)
                                                <tr>
                                                    <td>{{$ondemand->id}}</td>
                                                    <td>{{$ondemand->created_at->format('Y-m-d')}}</td>
                                                    <td>{{$ondemand->product}}</td>
                                                    <td>{{$ondemand->qty}}</td>
                                                    <td>{{$ondemand->unit}}</td>
                                                    <td>
                                                        @php
                                                        $quotations = \App\Quotation::select('id')->where('ondemand_id', $ondemand->id)
                                                                                                  ->where('quote_status', true)
                                                                                                  ->get()
                                                        @endphp
                                                        {{count($quotations)}}
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a class="btn btn-default" href="{{url('client-ondemand/'.$ondemand->id)}}">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                            <a class="btn btn-default" href="#">
                                                              <i class="fa fa-align-right" title="Align Right"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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