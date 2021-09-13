@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>{{$category->categoryName}}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/all-category-info')}}">Categories</a></li>
                    <li class="breadcrumb-item active">{{$category->categoryName}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->
    <div class="city_health_wrap">
        <div class="container">
            <div class="row" style="margin-bottom: 10px;">
                @if ($category->description)
                    <div class="col-md-6">
                        <div class="">
                            <figure class="">
                                {{-- <div class="box-layer layer-1"></div>
                                <div class="box-layer layer-2"></div>
                                <div class="box-layer layer-3"></div> --}}
                                <img src="{{asset('storage/images/category/'.$category->categoryImage2)}}" alt="" style="height:250px">
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="city_health_text">
                            {{-- <h4>{{$category->categoryName}}</h4> --}}
                            <p>{!!$category->description!!}</p>
                        </div>
                    </div>
                @endif
                
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="side_notice_list">
                        <!-- EVENT SIDEBAR START-->
                            <h4 class="sidebar_title">Categories</h4>
                            <div class="categories_list" style="padding:15px">
                                <ul>
                                    @foreach($categories as $item)
                                    <li><a href="{{url('products-by-cat/'.$item->id)}}">{{$item->categoryName}}<span>({{count($item->product)}})</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        <!-- EVENT SIDEBAR END-->
                    </div>
                    <div class="side_notice_list" style="padding-left: 10px; margin-top:10px;">
                        {{-- <ul>
                            <li><a href="{{url('/solutions')}}">Solutions</a></li>
                            <li><a href="{{url('/all-brand')}}">Brands</a></li>
                            <li><a href="{{url('/shop')}}">Shop</a></li>
                        </ul> --}}
                        <a href="{{url('/solutions')}}" style="padding:10px;">Solutions</a>|
                        <a href="{{url('/all-brand')}}" style="padding:10px;">Brands</a>|
                        <a href="{{url('/allIndustry')}}" style="padding:10px;">Industry</a>
                        <hr style="margin: 10px 0px 10px 0px;">
                        <a href="{{url('/shop')}}" target="_blank" style="padding:10px;">Shop</a>
                        
                        
                    </div>
                    
                </div>
                <div class="col-md-9">
                <!-- products start  -->
                <!-- CITY EMERGENCY CALL START-->
                    <div class="city_emergency_info">
                        <div class="city_emergency_call">
                            {{-- <h5>Product List of {{$category->categoryName}}</h5>
                            <div>                        
                                <input type="text" id="myInput" onkeyup="searchInTable()" placeholder="Search for names.." title="Type in a name">
                                <div><br></div>
                            </div> --}}
                            <div>
                                <div class="left" >
                                    <h5>Product List of {{$category->categoryName}}</h5>
                                </div>
                                <div class="right">
                                    <input type="text" class="add" id="myInput" onkeyup="searchInTable()" placeholder="Search for names.." title="Type in a name">
                                </div>
                            </div>
                            <div>
                                <table id="myTable" class="table table-striped" >
                                    <tr>
                                        <th>Id</th>
                                        <th>Product Name</th>
                                        <th>Solution</th>
                                        <th>Industry</th>
                                        <th>Technology</th>
                                    </tr>
                                    @foreach ($products as $key => $product)
                                    <tr>
                                        <td style="font-size:12px!important;">
                                            {{-- {{$product->id}} --}}
                                            {{$key+1}}
                                            
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
                    <!-- products end  -->
                </div>
            </div>
        </div>
    </div>
@endsection