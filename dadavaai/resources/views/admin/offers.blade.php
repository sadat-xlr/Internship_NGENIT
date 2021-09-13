@extends('layouts.admin')

@section('breadcrumbhead')
    Offer
    <small>Control panel</small>
@endsection

@section('breadcrumb')
    <li class="active">Offer</li>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Offer</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Offer value</th>
                    <th>Valid until</th>
                    <th>Product</th>
                    <th>
                        action
                        @can('add offer')
                            <a href="#" class="addOffer btn btn-success btn-sm">
                                <i class="fa fa-plus"></i>
                            </a>
                        @endcan
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($offers as $offer)
                    <tr id="offer{{$offer->id}}">
                        <td>{{$offer->discount_value}}</td>
                        <td>{{$offer->valid_until}}</td>
                        <td>
                            @foreach($offer->products as $product)
                                {{$product->productName}},
                            @endforeach
                        </td>
                        <td>
                            <div class="table-data-feature">
                                @can('edit offer')
                                    <a href="#" class="edit-offer btn btn-warning btn-sm" data-id="{{$offer->id}}" data-discount_value="{{$offer->discount_value}}" data-valid_until="{{$offer->valid_until}}" data-status="@if($offer->status == 0) Inactive @else Active @endif" data-product_ids="@foreach($offer->products as $product) {{$product->id}} @endforeach" data-gift_product_id="{{$offer->gift_product_id}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                                @can('delete offer')
                                    <a href="#" class="delete-offer btn btn-danger btn-sm" data-id="{{$offer->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    {{-- Modal Form Create Post --}}
    <div id="create" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="addOffer-form" action="{{url('luky-today')}}">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="discount_value">Offer value :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="discount_value"
                                       placeholder="Offer value Here in %" required>
                                <p class="error discount_value text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="valid_until">Valid till :</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    </div>
                                    {{-- <input type="text" class="form-control pull-right" name="valid_until" id="valid_until"> --}}
                                    <input type="time" class="form-control pull-right" name="valid_until" id="time">

                                    <p class="error valid_until text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="extra_offer">Extra offer :</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="extra_offer" style="width: 100%;">
                                    <option value="0" selected>select one</option>
                                    <option value="1">Buy & Get</option>
                                    <option value="2">Free Shipping</option>
                                </select>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="product_id">Products :</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" multiple="multiple" name="product_id[]" data-placeholder="Search for product" style="width: 100%;">
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                                <p class="error product_id text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="gift_product_id">Gift Products :</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="gift_product_id" data-placeholder="Search for product" style="width: 100%;">
                                    <option value="0" selected>select one</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                                <p class="error gift_product_id text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    <button class="btn btn-warning" type="submit" id="addOffer">
                        <span class="glyphicon glyphicon-plus"></span>Save offer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    {{-- Modal Form Edit and Delete Post --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="updateOffer-form" action="{{url('luky-today')}}">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="discount_value">Offer value :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="discount_value" name="discount_value" placeholder="Offer value Here" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="valid_until">Valid till :</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    </div>
                                    {{-- <input type="text" class="form-control pull-right" name="valid_until" id="evalid_until"> --}}
                                    <input type="time" class="form-control pull-right" name="valid_until" id="etime">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="extra_offer">Extra offer :</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="extra_offer" id="eextra_offer" style="width: 100%;">
                                    <option value="0" selected>select one</option>
                                    <option value="1">Buy & Get</option>
                                    <option value="2">Free Shipping</option>
                                </select>
                                <p class="error eextra_offer text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="status">status :</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="status" id="estatus" style="width: 100%;">
                                    <option value="Inactive">Inactive</option>
                                    <option value="Active">Active</option>
                                </select>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="product_id">Products :</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" multiple="multiple" id="product_id" name="product_id[]" data-placeholder="Search for product" style="width: 100%;">
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="gift_product_id">Gift Products :</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="gift_product_id" id="egift_product_id" data-placeholder="Search for product" style="width: 100%;">
                                    <option value="0" selected>select one</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                                <p class="error egift_product_id text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <input type="hidden" name="_method" value="PUT">
                        <input id="fid" type="hidden">
                    </form>
                    {{-- Form Delete Post --}}
                    <input type="hidden" name="_method1" value="DELETE">
                    <div class="deleteContent">
                        Are You sure want to delete this data?
                        <span class="hidden id" style="display:none"></span>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class="glyphicon"></span>
                    </button>

                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class="glyphicon glyphicon"></span>close
                    </button>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    //Date picker
    $('#valid_until, #evalid_until').datepicker({
    format: 'yyyy/mm/dd',
    autoclose: true,
    todayHighlight: true
    })

    //Initialize Select2 Elements
    $('.select2').select2()

@endsection