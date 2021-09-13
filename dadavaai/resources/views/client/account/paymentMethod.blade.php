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
                            <span class="current"> Payment Method </span>
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
                                    <h3 class="title-3 fsz-18">Change Your Payment Method</h3>                            
                                </div>

                                <div class="account-box">
                                    <form action="{{url('client-payment-method')}}" id="payment-details">
                                        <div id="payment">
                                            <h4 class="widget-title">Your Payment</h4>
                                            <div class="woocommerce-checkout-payment-inner">
                                                <ul class="payment_methods methods list-unstyled">
                
                                                    {{-- BKash --}}
                                                    <li class="payment_method_bkash">
                                                        <div class="form-group">
                                                            <label class="radio-inline"> 
                                                                <input class="form-control" id="bkash" type="radio" value="0" name="payment_method">
                                                                    <span> Bkash </span> 
                                                                    <img src="http://gamersbd.com/wp-content/plugins/bkash/images/bkash.png" alt="bKash">	 
                                                            </label>
                                                        </div>
                                                        <div id="bkash_details" class="hide">
                                                            <div class="payment_box payment_method_paypal">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="bkash_number">Bkash Number :</label>
                                                                        <input class="form-control" type="number" id="bkash_number" name="bkash_number" placeholder="Bkash Number" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="bkash_transaction_id ">Bkash Transaction ID :</label>
                                                                        <input class="form-control" type="text" id="bkash_transaction_id" name="bkash_transaction_id" placeholder="BkashTransaction Id" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                
                                                    {{-- Rocket --}}
                                                    <li class="payment_method_rocket">
                                                        <div class="form-group">
                                                            <label class="radio-inline"> 
                                                                <input class="form-control" id="rocket" type="radio" value="1" name="payment_method">
                                                                    <span> Rocket </span> 
                                                                    <img src="http://gamersbd.com/wp-content/plugins/woo-rocket/images/rocket.png" alt="Rocket">		 
                                                            </label>
                                                        </div>
                                                        <div id="rocket_details" class="hide">
                                                            <div class="payment_box payment_method_paypal">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="rocket_number">Rocket Number :</label>
                                                                        <input class="form-control" type="number" id="rocket_number" name="rocket_number" placeholder="Bkash Number" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                
                                                    <li class="payment_method_bank">
                                                        <div class="form-group">
                                                            <label class="radio-inline"> 
                                                                <input class="form-control" id="bank_payment" type="radio" value="2" name="payment_method"> 
                                                                <span> Direct Bank Transfer </span>  
                                                            </label>
                                                            <div id="bank_payment_details" class="hide">
                                                                <div class="payment_box payment_method_bacs" >
                                                                    <div class="col-md-10">
                                                                        <div class="form-group">
                                                                            <label for="bank_payment_account_name">Account Name :</label>
                                                                            <input class="form-control" type="text" name="bank_payment_account_name" placeholder="Account Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <div class="form-group">
                                                                            <label for="bank_payment_account_number">Account Number :</label>
                                                                            <input class="form-control" type="text" name="bank_payment_account_number" placeholder="Account Number">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <div class="form-group">
                                                                            <label for="bank_payment_bank_name">Bank Name :</label>
                                                                            <input class="form-control" type="text" name="bank_payment_bank_name" placeholder="Bank Name">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                
                                            </div>
                                            <div class="form-row place-order">
                                                <button class="button-one submit-button mt-15" data-text="Update" type="submit">Update</button>
                                            </div>
                                        </div>
                                    </form>
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