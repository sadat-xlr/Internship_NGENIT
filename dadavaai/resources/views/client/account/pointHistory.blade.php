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
                            <span class="current red-clr"> Dashboard </span>
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
                                <div class="heading-2"><h3 class="title-3 fsz-15">MEMBER CREDITS</h3></div>                                
                                <div class="account-box">
                                    
                                </div>

                                @php
                                    $totalPoint = 0;
                                    $totalRedeem = 0;

                                    foreach ($points as $tPoint)
                                    {
                                        $totalPoint += $tPoint->po_point + $tPoint->shared_ref_point + $tPoint->new_friend_purchase_point + $tPoint->pro_review_ref_point;
                                        $totalRedeem += $tPoint->redeem;
                                    }

                                @endphp
                                <div class="row">
                                    <div class="col-lg-4 col-xs-6 text-center">
                                        <div class="table-responsive">
                                            <table class="table table-responsive table-bordered table-compare">
                                                <tr>
                                                    <th class="compare-label">Total Point</th>
                                                    <td class="">{{$totalPoint}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="compare-label">Redeemed  Point</th>
                                                    <td class="">{{$totalRedeem}}</td>
                                                </tr>
                                                <tr>
                                                    <th  style="background: #f5f5f5; color: #000;">Available Point</th>
                                                    <td  style="background: #f5f5f5; color: #000;">{{$totalPoint - $totalRedeem }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <br><br>
                        <article class="" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                            <div class="account-details-wrap">
                                <div class="heading-2">                                
                                    <h3 class="title-3 fsz-18">Point Table</h3>                            
                                </div>

                                <div class="account-box">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <td>Date</td>
                                                <td>PO</td>
                                                <td>Shared ref</td>
                                                <td>New Friend Purchase</td>
                                                <td>Product Review ref </td>
                                                <td>Redeem Point</td>
                                                <td>Total</td>
                                            </thead>
                                            <tbody>

                                            @foreach ($points as $point)
                                                <tr>
                                                    <td>{{$point->created_at->format('d-m-Y')}}</td>
                                                    <td>
                                                        @if($point->po_point)
                                                            {{$point->po_point}}
                                                        @else
                                                            0
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        @if($point->shared_ref_point)
                                                            {{$point->shared_ref_point}}
                                                        @else
                                                            0
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($point->new_friend_purchase_point)
                                                            {{$point->new_friend_purchase_point}}
                                                        @else
                                                            0
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($point->pro_review_ref_point)
                                                            {{$point->pro_review_ref_point}}
                                                        @else
                                                            0
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($point->redeem)
                                                            {{$point->redeem}}
                                                        @else
                                                            0
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{$point->po_point + $point->shared_ref_point + $point->new_friend_purchase_point + $point->pro_review_ref_point- $point->redeem}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{ $points->links() }}
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