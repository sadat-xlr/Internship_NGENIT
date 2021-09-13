@extends('layouts.client')

@section('title')
    <title>Dadavaai | Checkout </title>
@endsection
@php
$currentTime = \Carbon\Carbon::now()->format('d-m-Y');
@endphp
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
                        <span class="current"> Order </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container theme-container">
            <main class="col-md-8 col-sm-8 blog-wrap">
                <article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                    <!-- Main Content of the Post -->
                    <div class="entry-content" itemprop="articleBody">
                        <div class="woocommerce checkout">

                        </div>
                    </div>
                </article>
            </main>
 
        </div>
        <div class="clear"></div>
    </div>
@endsection