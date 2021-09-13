@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>{{$brand->brandName}}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/all-brand')}}">Brands</a></li>
                    <li class="breadcrumb-item active">{{$brand->brandName}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->
    @php
        $products = \App\Product::where('brand_id',$brand->id)->paginate(30);
    @endphp

    <!-- CITY SERVICES2 WRAP START-->
    <div class="city_health_department">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    
                    <div class="city_about_fig fig2">
                        <figure class="">
                            @if (!empty($brand->image))
                                <img src="{{asset('storage/images/brand/logo/'.$brand->image)}}" alt="">
                            @endif
                        </figure>
                    </div>
                    <div class="side_notice_list">
                        <!-- EVENT SIDEBAR START-->
                            <h5 class="sidebar_title">Other Brands</h5>
                            <div class="categories_list" style="padding:15px">
                                <ul>
                                    @foreach($brands->take(15) as $item)
                                    <li><a href="{{url('brand-details/'.$item->id)}}">{{$item->brandName}}<span>({{count($item->product)}})</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        <!-- EVENT SIDEBAR END-->
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="city_about_list list2">
							<!-- CITY EMERGENCY CALL START-->
							<div class="city_emergency_info">
								<div class="city_emergency_call">
                                    {{-- <h5>Product list of {{$brand->brandName}}</h5>
                                    <div>                        
                                        <input type="text" id="myInput" onkeyup="searchInTable()" placeholder="Search for names.." title="Type in a name">
                                        <div><br></div>
                                    </div> --}}
                                    <div>
                                        <div class="left" >
                                            <h5>Product List of {{$brand->brandName}}</h5>
                                        </div>
                                        <div class="right">
                                            <input type="text" class="add" id="myInput" onkeyup="searchInTable()" placeholder="Search for names.." title="Type in a name">
                                        </div>
                                    </div>
                                    <div>
                                        <table id="myTable" class="table table-striped">
                                            <tr>
                                                <th>Id</th>
                                                <th>Product Name</th>
                                                <th>Solution</th>
                                                <th>Industry</th>
                                                <th>Technology</th>
                                            </tr>
                                            @foreach ($products as $product)
                                            <tr>
                                                <td style="font-size:12px!important;">
                                                    {{$product->id}}
                                                    {{-- <figure class="box">
                                                        <div class="box-layer layer-1"></div>
                                                        <div class="box-layer layer-2"></div>
                                                        <div class="box-layer layer-3"></div>
                                                        <img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style=" width: 60px; height: 50px;!important">
                                                        <a class="paly_btn" data-rel="prettyPhoto" href="{{asset('storage/images/product/'.$product->image->image1)}}"><i class="fa fa-plus"></i></a>
                                                    </figure> --}}
                                                </td>
                                                <td>
                                                    <a href="{{url('product-info/'.$product->id.'/'.$product->slug)}}" style="font-size:12px!important;">{{$product->productName}}</a> 
                                                </td>
                                                <td style="font-size:12px!important;">
                                                    @if (!empty($product->solution->solutionName))
                                                        {{$product->solution->solutionName}}
                                                    @endif
                                                </td>
                                                <td style="font-size:12px!important;">
                                                    {{$product->industry->industryName}}
                                                </td>
                                                <td style="font-size:12px!important;">
                                                    {{$product->technology->technologyName}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
								</div>
                                <div id="pagination" style="margin-left: 45%">
                                        {{ $products->links() }}
                                </div>
                            </div>
							<!-- CITY EMERGENCY CALL END-->
                    </div>
                </div>
            </div>
        </div>	
    </div>
    <br><br>
    <!-- CITY SERVICES2 WRAP END-->
{{-- 
    <!-- products start  -->
    <div class="city_health_wrap">
        <div class="container">
            <div>                        
                <input type="text" id="myInput" onkeyup="searchInTable()" placeholder="Search for names.." title="Type in a name">
                <div><br></div>
            </div>
            <div>
                <table id="myTable" class="table table-striped table-bordered bootstrap-datatable datatable">
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Brand</th>
                        <th>Industry</th>
                        <th>Technology</th>
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <figure class="box">
                                <div class="box-layer layer-1"></div>
                                <div class="box-layer layer-2"></div>
                                <div class="box-layer layer-3"></div>
                                <img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style=" width: 60px; height: 50px;!important">
                                <a class="paly_btn" data-rel="prettyPhoto" href="{{asset('storage/images/product/'.$product->image->image1)}}"><i class="fa fa-plus"></i></a>
                            </figure>
                        </td>
                        <td>
                            <a href="{{url('product-info/'.$product->id.'/'.$product->slug)}}">{{$product->productName}}</a> 
                        </td>
                        <td>
                            {{$product->brand->brandName}}
                        </td>
                        <td>
                            {{$product->industry->industryName}}
                        </td>
                        <td>
                            {{$product->technology->technologyName}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div id="pagination" style="margin-left: 45%">
                    {{ $products->links() }}
            </div>
        </div>	
    </div>
    <!-- products end  --> 
--}}
@endsection