@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>Brands</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Brands</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->
    
    <!-- CITY SERVICES2 WRAP START-->
    <div class="city_services2_wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {{-- <ul class="brands-tablist">
                        <li data-filter="*" class="active">All</li>
                        <li data-filter=".a">A</li>
                        <li data-filter=".b">B</li>
                        <li data-filter=".c">C</li>
                        <li data-filter=".d">D</li>
                        <li data-filter=".e">E</li>
                        <li data-filter=".f">F</li>
                        <li data-filter=".g">G</li>
                        <li data-filter=".h">H</li>
                        <li data-filter=".i">I</li>
                        <li data-filter=".j">J</li>
                        <li data-filter=".k">K</li>
                        <li data-filter=".l">L</li>
                        <li data-filter=".m">M</li>
                        <li data-filter=".n">N</li>
                        <li data-filter=".o">O</li>
                        <li data-filter=".p">P</li>
                        <li data-filter=".q">Q</li>
                        <li data-filter=".r">R</li>
                        <li data-filter=".s">S</li>
                        <li data-filter=".t">T</li>
                        <li data-filter=".u">U</li>
                        <li data-filter=".v">V</li>
                        <li data-filter=".w">W</li>
                        <li data-filter=".x">X</li>
                        <li data-filter=".y">Y</li>
                        <li data-filter=".z">Z</li>
                    </ul> --}}
            </div>
            <div class="row">
                {{-- <div class="brands-list grid">
                    @foreach($brands as $brand)
                      <div class="brands-item ipsotope {{strtolower(substr($brand->brandName, 0, 1))}}">
                          <a href="{{url('brand-details/'.$brand->id)}}" class="box-cat" title="">
                              <div class="cat-name">
                              {{$brand->brandName}}
                          </div>
                          
                          </a>
                      </div>
                    @endforeach
                      <div class="clearfix"></div>
                </div> --}}
                @foreach ($brands as $brand)
                    @if (count($brand->product)>0)
                        <div class="col-md-4 col-sm-6">
                            <div class="city_business_fig">
                                <figure class="overlay">
                                    <img src="{{asset('informative/extra-images/cables_&_accessories.jpg')}}" alt="">
                                    <div class="city_service2_list">
                                        <span>
                                            <i class="fa icon-classroom"></i>
                                        </span>
                                        <div class="city_service2_caption">
                                            <h5>{{$brand->brandName}} </h5>
                                        </div>
                                    </div>
                                </figure>
                                <div class="city_business_list">
                                    <ul class="city_busine_detail">
                                        @foreach ($brand->product->take(3) as $product)
                                            <li><a href="{{url('product-info/'.$product->id.'/'.$product->slug)}}"><i class="fa fa-star-o"></i> <span class="block-text">{{$product->productName}} </span> </a></li>
                                        @endforeach
                                    </ul>
                                    <a class="see_more_btn" href="{{url('brand-details/'.$brand->id)}}">See More <i class="fa icon-next-1"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- CITY SERVICES2 WRAP END-->	
@endsection
