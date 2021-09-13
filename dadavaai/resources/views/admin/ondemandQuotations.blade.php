@extends('layouts.admin')
@section('title')
    <title>Quotation list</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Quotation list
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('ondemands')}}">Ondemands</a> </li>
        <li class="active">Quotation list</li>
    </ol>
@endsection

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">On demand product details</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="col-lg-8">
                <dl class="dl-horizontal">
                    <dt>Product Name:</dt>
                    <dd>{{$ondemand->product}}</dd>
                    <dt>Quantity</dt>
                    <dd>{{$ondemand->qty}}</dd>
                    <dt>Unit</dt>
                    <dd>{{$ondemand->unit}}</dd>
                    <dt>Ondemand Type</dt>
                    <dd>{{$ondemand->category->categoryName}}/{{$ondemand->subcategory->subCategoryName }} / {{$ondemand->minicategory->miniCategoryName}}
                    </dd>
                    <dt>Details</dt>
                    <dd>{{$ondemand->product_details}}</dd>
                    <br><br>
                    <dt>Expiry date</dt>
                    <dd> <span style="color:red;">{{$ondemand->expiry_date}} </span> </dd>
                </dl>
            </div>
            <div class="col-lg-4">
                <img src="{{asset('storage/images/ondemand/'.$ondemand->product_image)}}" height="250px" width="300px"/>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">On demand's Quotation list</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped" style="margin-top: 10px;">
                <thead>
                <tr>
                    <th>Quotation Id</th>
                    <th>Price</th>
                    <th>Delivery days</th>
                    <th>Vendor</th>
                    <th>
                        Action
                        @can('ondemand handle')
                            <a href="#" class="allToQuote btn btn-success btn-sm" data-id="{{$ondemand->id}}">
                                All
                            </a>
                        @endcan
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($ondemand->quotations->sortBy('price') as $quotation)
                    <tr id="quotation{{$quotation->id}}">
                        <td>{{$quotation->id}}</td>
                        <td>{{$quotation->price}}</td>
                        <td>{{$quotation->delivery_day}}</td>
                        <td> <a  data-toggle="tooltip" title="{{$quotation->vendor->phone}}&nbsp;/&nbsp;{{$quotation->vendor->email}}"> {{$quotation->vendor->vendorName}}</a></td>
                        <td>
                            @if($quotation->quote_status == true)
                                <a href="#" class="order-quotation btn btn-success btn-sm" data-id="{{$quotation->id}}">
                                    Quoted to Client
                                    @if($quotation->confirmation == true)
                                        <span style="color:yellow;">(got the order) </span>
                                    @endif
                                </a>
                                
                            @endif
                            @if($quotation->quote_status == false)
                                @can('ondemand handle')
                                    <a href="#" class="quoteToClient order-quotation btn btn-danger btn-sm" data-ondemand_id="{{$ondemand->id}}" data-quotation_id="{{$quotation->id}}">
                                        Quote to Client
                                    </a>
                                @endcan
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Vendor Who can provide this product</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped" style="margin-top: 10px;">
                <thead>
                <tr>
                    <th>Vendor Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                @foreach($vendors_id as $vendor_id)
                    @php
                        $id = $vendor_id->vendor_id;
                        $vendor = \App\Vendor::find($id);
                        $quotedVendor = \App\Quotation::select('vendor_id')->where('vendor_id', $id)
                                                                            ->where('ondemand_id', $ondemand->id)
                                                                            ->first();
                    @endphp
                    @if(empty($quotedVendor))
                        <tr id="vendor{{$vendor->id}}">
                            <td>{{$vendor->id}}</td>
                            <td>{{$vendor->vendorName}}</td>
                            <td>{{$vendor->phone}}</td>
                            <td>{{$vendor->email}}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection