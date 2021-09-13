@extends('layouts.admin')
@section('title')
    <title>Pre-launching Product</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Pre-launching Product list
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Pre-book</li>
        <li class="active">Pre-launching Product list</li>
    </ol>
@endsection

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Pre-launching Product list</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Pre-book Discount</th>
                <th>Launching Date</th>
                <th>Amount to Pay</th>
                <th>Number of prebook</th>
                <th>Product</th>
                <th>
                    action
                    @can('add product')
                        <a href="#" class="addLaunchingProduct btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </a>
                    @endcan
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($prebooks as $prebook)
                <tr id="prebook{{$prebook->id}}">
                    <td>{{$prebook->id}}</td>
                    <td>{{$prebook->prebook_discount}}</td>
                    <td>{{$prebook->launching_date}}</td>
                    <td>{{$prebook->amount_to_pay}}%</td>
                    <td>{{$prebook->number_of_prebook}}</td>
                    <td>{{$prebook->product->productName}}</td>
                    <td>
                        <div class="table-data-feature">
                            @can('edit product')
                                <a href="#" class="edit-prebook-launching-product btn btn-warning btn-sm" data-id="{{$prebook->id}}" data-amount_to_pay="{{$prebook->amount_to_pay}}" data-prebook_discount="{{$prebook->prebook_discount}}" data-launching_date="{{$prebook->launching_date}}" data-number_of_prebook="{{$prebook->number_of_prebook}}" data-product_id="{{$prebook->product->id}}" data-product_name="{{$prebook->product->preouctName}}" data-details="{{strip_tags($prebook->details)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('delete product')
                                <a href="#" class="delete-prebook-launching-product btn btn-danger btn-sm" data-id="{{$prebook->id}}">
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
                <form class="form-horizontal" role="form" id="addLaunchingProduct-form" action="{{url('pre-launching-product-store')}}">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="prebook_discount">Pre-Book Discount in (amount):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="prebook_discount"
                                   placeholder="Pre-Book Discount Here" required>
                            <p class="error prebook_discount text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="launching_date">Launching Date :</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" name="launching_date" id="launching_date">
                                <p class="error launching_date text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="amount_to_pay">Advance payment in (%):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="amount_to_pay"
                                   placeholder="Advance payment in (%) of this product to book" required>
                            <p class="error amount_to_pay text-center alert alert-danger hidden"></p>
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
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="details">Details :</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <textarea class="form-control pull-right" name="details" id="details" cols="30" rows="20" required></textarea>
                                <p class="error details text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#details').summernote({
                                            placeholder: 'Details',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <button class="btn btn-warning" type="submit" id="addLaunchingProduct">
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
                <form class="form-horizontal" role="form" id="updatePrebookLaunchingProduct-form" action="{{url('pre-launching-product-update')}}">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="prebook_discount">Pre-Book Discount in (amount):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="eprebook_discount" name="prebook_discount" placeholder="Discount value Here" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="launching_date">Launching Date :</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" name="launching_date" id="elaunching_date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="amount_to_pay">Advance payment in (%):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="amount_to_pay" id="eamount_to_pay"
                                   placeholder="Advance payment in (%) of this product to book" required>
                            <p class="error eamount_to_pay text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="product_id">Products :</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" id="product_id" name="product_id" data-placeholder="Search for product" style="width: 100%;">
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->productName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="details">Details :</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <textarea class="form-control pull-right" name="details" id="edetails" cols="30" rows="20" required></textarea>
                                <p class="error details text-center alert alert-danger hidden"></p>
                                {{-- <script>
                                    $(document).ready(function() {
                                        $('#edetails').summernote({
                                            placeholder: 'edetails',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script> --}}
                            </div>
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