@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>Sub-Solution</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/sub-solution')}}">Sub-Solutions</a></li>
                    <li class="breadcrumb-item active">{{$subSolution->subSolutionName}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->
    
    <!-- CITY SERVICES2 WRAP START-->
    <div class="city_health_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="city_health_text">
                        <h2>{{$subSolution->subSolutionName}}</h2>
                        <p>{!!$subSolution->description!!}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="city_health_fig">
                        <figure class="box">
                            <div class="box-layer layer-1"></div>
                            <div class="box-layer layer-2"></div>
                            <div class="box-layer layer-3"></div>
                            <img src="{{asset('storage/images/subSolution/'.$subSolution->image)}}" alt="" style="height:250px">
                        </figure>
                    </div>
                </div>
            </div>
        </div>	
    </div>
    <!-- CITY SERVICES2 WRAP END-->

    @php
        $products = \App\Product::where('subsolution_id',$subSolution->id)->paginate(2);
    @endphp

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
                                    <img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style=" width: 50px; height: 50px;!important">
                                    <a class="paly_btn" data-rel="prettyPhoto" href="{{asset('storage/images/product/'.$product->image->image1)}}"><i class="fa fa-plus-circle"></i></a>
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
    
    
    <!-- CITY SERVICES2 WRAP START-->
    {{-- <div class="city_service_detail_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar_widget">
                        <!-- CITY SERVICE TABS START-->
                        <div class="city_service_tabs tabs">
                            <ul class="tab-links">
                                @foreach ($services as $item)
                                    @if ($service->id != $item->id)
                                        <li><a href="#tab{{$item->id}}">{{$item->title}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <!-- CITY SERVICE TABS END-->
                        
                        <!-- CITY SIDE INFO START-->
                        <div class="city_side_info">
                            <span><i class="fa fa-github"></i></span>
                            <h4>Let’s Help You</h4>
                            <h6>908-879-5100 89, <br>Avenue 454 <br> NY, USA</h6>
                        </div>
                        <!-- CITY SIDE INFO END-->
                        
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tabs">
                        <div class="tab-content">
                            @foreach ($services as $itemTab)
                                @if ($service->id != $itemTab->id)
                                    <div id="tab1" class="tab active">
                                        <div class="city_service_tabs_list">
                                            <figure class="box">
                                                <div class="box-layer layer-1"></div>
                                                <div class="box-layer layer-2"></div>
                                                <div class="box-layer layer-3"></div>
                                                <img src="{{asset('storage/images/service/'.$itemTab->image)}}" alt="">
                                            </figure>
                                            <div class="city_service_tabs_text">
                                                <h3>{{$itemTab->title}}</h3>
                                                <p>{!!$itemTab->description!!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>	
        </div>		
    </div>	 --}}
@endsection