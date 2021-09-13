@extends('layouts.admin')
@section('title')
    <title>Bundle Offers</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Bundle Offers
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Bundle Offers</li>
        <li class="active">Bundle Offers list</li>
    </ol>
@endsection

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Bundle Offers list</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Qty Start</th>
                <th>Qty End</th>
                <th>Discount</th>
                <th>Product</th>
                <th>
                    action
                    @can('add offer')
                        <a href="#" class="addBundleOffer btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </a>
                    @endcan
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($bundleOffers as $bundleOffer)
                <tr id="bundleOffer{{$bundleOffer->id}}">
                    <td>{{$bundleOffer->id}}</td>
                    <td>{{$bundleOffer->qty_start}}</td>
                    <td>{{$bundleOffer->qty_end}}</td>
                    <td>{{$bundleOffer->discount}}</td>
                    <td>{{$bundleOffer->product->productName}}</td>
                    <td>
                        <div class="table-data-feature">
                            @can('edit offer')
                                <a href="#" class="edit-bundleOffer btn btn-warning btn-sm" data-id="{{$bundleOffer->id}}" data-qty_start="{{$bundleOffer->qty_start}}" data-qty_end="{{$bundleOffer->qty_end}}" data-discount="{{$bundleOffer->discount}}" data-product_id="{{$bundleOffer->product->id}}" data-product_name="{{$bundleOffer->product->productName}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('delete offer')
                                <a href="#" class="delete-bundleOffer btn btn-danger btn-sm" data-id="{{$bundleOffer->id}}">
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
                <form class="form-horizontal" role="form" id="addBundleOffer-form" action="{{url('bundle-offers')}}">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="qty_start">Quantity start</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="qty_start"
                                   placeholder="quantity start" required>
                            <p class="error qty_start text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="qty_end">Quantity start</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="qty_end"
                                   placeholder="quantity end" required>
                            <p class="error qty_end text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="qty_end">Discount(%)</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="discount"
                                   placeholder="discount" required>
                            <p class="error discount text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="product_id">Products :</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="product_id" data-placeholder="Search for product" style="width: 100%;">
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->productName}}</option>
                                @endforeach
                            </select>
                            <p class="error product_id text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <button class="btn btn-warning" type="submit" id="addBundleOffer">
                    <span class="glyphicon glyphicon-plus"></span>Save
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
                <form class="form-horizontal" role="form" id="updateBundleOffer-form" action="{{url('bundle-offers')}}">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="qty_start">Quantity start</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="eqty_start" name="qty_start"
                                   placeholder="quantity start" required>
                            <p class="error eqty_start text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="qty_end">Quantity start</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="eqty_end" name="qty_end"
                                   placeholder="quantity end" required>
                            <p class="error eqty_end text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="qty_end">Discount(%)</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="ediscount" name="discount"
                                   placeholder="discount" required>
                            <p class="error ediscount text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="product_id">Products :</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" id="eproduct_id" name="product_id" data-placeholder="Search for product" style="width: 100%;">
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->productName}}</option>
                                @endforeach
                            </select>
                            <p class="error eproduct_id text-center alert alert-danger hidden"></p>
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