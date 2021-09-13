@extends('layouts.client')

@section('title')
    <title>Dadavaai | Rfq of {{$ondemand->product}} </title>
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
                            <span><a href="{{url('/client-dashboard')}}"></a> Client </span>
                            <i class="fa fa-arrow-circle-right"></i>
                            <span> <a href="{{url('/client-ondemand-history')}}"> ONDEMAND HISTORY</a></span>
                            <i class="fa fa-arrow-circle-right"></i>
                            <span class="current red-clr"> Ondemand </span>
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
                                    <h3 class="title-3 fsz-18">{{$ondemand->product}}</h3>                            
                                </div>

                                <div class="account-box">
                                    
                                    <div class="row">
                                        <div class="col-lg-8 col-sm-12 col-md-8 col-xs-12">
                                            <div class="summary entry-summary">
                                                <ul class="stock-detail list-items fsz-12">
                                                    <li> <strong> Qty : <span class="blk-clr"> {{$ondemand->qty}} </span> </strong> </li>
                                                    <li> <strong> Unit : <span class="blk-clr"> {{$ondemand->unit}} </span> </strong> </li>
                                                    <li> <strong> Type : <span>{{$ondemand->category->categoryName}} @if($ondemand->subcategory_id) -> {{$ondemand->subcategory->subCategoryName}} -> @endif  @if($ondemand->minicategory_id){{$ondemand->minicategory->miniCategoryName}}@endif </span> </strong> </li>

                                                </ul>

                                                <div itemprop="description" class="fsz-15">
                                                    <p>{{$ondemand->product_details}}</p>                                  
                                                </div>
                                            </div><!-- .summary -->
                                        </div>
                                        <div class="spc-15 hidden-lg clear"></div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div id="gallery-2" class="royalSlider">
                                                <a class="rsImg" data-rsw="300" data-rsh="300"> <img class="rsTmb" src="{{url('storage/images/ondemand/'.$ondemand->product_image)}}" alt=""></a>
                                            </div>
                                        </div>
                                    </div>


                                   
                                </div>
                            </div>
                            <div class="account-details-wrap">
                                <div class="heading-2">                                
                                    <h3 class="title-3 fsz-18">Quotation for this Rfq</h3>                            
                                </div>

                                <div class="account-box">
                                    <div class="table-responsive">
                                        @if(count($quotations)>0)
                                            <table class="table table-striped">
                                                <thead>
                                                    <td>Id</td>
                                                    <td>Date</td>
                                                    <td>Price</td>
                                                    <td>Action</td>
                                                </thead>
                                                <tbody>
                                                
                                                    @foreach ($quotations->sortBy('price') as $quotation)
                                                        <tr>
                                                            <td>{{$quotation->id}}</td>
                                                            <td>{{$quotation->created_at->format('Y-m-d')}}</td>
                                                            <td>Tk {{$quotation->price + ($quotation->price*(20/100))}} </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    
                                                                    @if($quotation->confirmation == false && $ondemand->status == true)
                                                                        <a class="btn btn-default" href="{{url('ondemand-checkout/?quotation_id='.$quotation->id)}}">
                                                                            Confirm
                                                                        </a>
                                                                    @elseif($quotation->confirmation == true && $ondemand->status == false)
                                                                        <a class="btn btn-success" href="#">
                                                                            Ordered
                                                                        </a>
                                                                    @else
                                                                        <a class="btn btn-danger" href="#" disabled>
                                                                            Cancel
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                
                                                </tbody>
                                            </table>
                                        @else
                                            <p>No quotes yet</p>
                                        @endif
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