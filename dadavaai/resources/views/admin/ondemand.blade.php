@extends('layouts.admin')
@section('title')
    <title>On demand Application</title>
@endsection

@section('breadcrumbhead')
    <h1>
        On demand
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ondemands</li>
    </ol>
@endsection

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">On demand</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>image</th>
                    <th>qty</th>
                    <th>unit</th>
                    <th>category</th>
                    <th>Expiry Date</th>
                    <th>Quotation</th>
                    <th>Status</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ondemands as $ondemand)
                    <tr id="ondemand{{$ondemand->id}}">
                        <td>{{$ondemand->product}}</td>
                        <td>
                            @if($ondemand->product_image)
                                <img src="{{asset('storage/images/ondemand/'.$ondemand->product_image)}}" height="100px" width="100px"/>
                            @endif
                        </td>
                        <td>{{$ondemand->qty}}</td>
                        <td>{{$ondemand->unit}}</td>
                        <td>{{$ondemand->category->categoryName}}</td>
                        <td><span style="color:red;">{{$ondemand->expiry_date}} </span></td>
                        <td>
                            <a href="{{url('ondemand-quotation/'.$ondemand->id)}}">see all</a>
                        </td>
                        <td>
                            @if($ondemand->status == true)
                                Active
                            @elseif($ondemand->status == false)
                                Inactive / order confirm 
                            @endif
                        </td>
                        <td>
                            <div class="table-data-feature">
                                @can('ondemand handle')
                                    <a href="#" class="update-ondemand btn btn-warning btn-sm" data-id="{{$ondemand->id}}" data-expiry_date="{{$ondemand->expiry_date}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" class="delete-ondemand btn btn-danger btn-sm" data-id="{{$ondemand->id}}">
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


    {{-- Modal Form Create Product --}}
{{--     <div id="create" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">
                    <form action="{{url("on-demand")}}" enctype="multipart/form-data" role="form" method="post">
                         {{csrf_field()}}
                        <div class="form-inline mb-5">
                            <div class="form-group">
                                <select class="form-control" id="ondemandCategory" name="ondemand_category" required>
                                    <option value="">select category</option>
                                    @foreach($categories as $ondemandCategory)
                                        <option value="{{$ondemandCategory->id}}">{{$ondemandCategory->categoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="ondemandSubCategory" name="ondemand_subcategory">
                                    <option value="">sub category</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="ondemandMiniCategory" name="ondemand_minicategory">
                                    <option value="">mini category</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-inline mb-5">
                            <div class="form-group">
                              <input type="text" class="form-control" id="ondemandProduct" name="ondemand_product" placeholder="Product" required>
                            </div>
                            &nbsp;
                            <div class="form-group">
                                <select class="form-control" name="qty" required>
                                    <option value="">Select Qty</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            &nbsp;
                            <div class="form-group">
                                <select class="form-control" name="unit">
                                    <option value="">Select Unit</option>
                                    <option value="kilogram">kilogram </option>
                                    <option value="meter">meter</option>
                                    <option value="pieces">pieces</option>
                                    <option value="liter">liter</option>
                                    <option value="inch">inch</option>
                                    <option value="gram">gram</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-inline mb-5 mt-10">
                            <div class="form-group left">
                                <textarea class="form-control" rows="3" name="ondemand_product_details" placeholder="Write product details" required ></textarea>
                            </div>
                            &nbsp;
                            <div class="form-group">
                              <input type="file" class="form-control"  name="input_img">
                            </div>
                        </div>
                        <div class="mt-60" style="padding:10px;">
                            <a href="#" class="left">
                                <u>
                                    Term & Condition
                                </u>
                            </a>
                            <button type="submit" class="btn btn-default right">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class="glyphicon glyphicon"></span>close
                    </button>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="clearfix"></div>

    {{-- Modal Form Update product --}}
    <div id="update" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" id="updateOndemand-form">
{{--                         <div class="form-group">
                            <label class="control-label col-sm-2" for="productName">Product Name :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="eproductName" name="productName"
                                       placeholder="productName Here" required>
                                <p class="error eproductName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="category_id">Product Category :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="ecategory_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="subcategory_id">Product SubCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="esubcategory_id" name="subcategory_id" required>
                                    <option value="">Select SubCategory</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="minicategory_id">Product MiniCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="eminicategory_id" name="minicategory_id" required>
                                    <option value="">Select MiniCategory</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="description">Product Description :</label>
                            <div class="col-sm-10">
                                <textarea id="uDescription" name="description" rows="10" cols="80" required></textarea>
                                <p class="error edescription text-center alert alert-danger hidden"></p>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="expiry_date">Expiry date :</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="expiry_date" id="eexpiry_date" required>
                                    <p class="error eexpiry_date text-center alert alert-danger hidden"></p>
                                    <input type="text" class="form-control pull-right hidden" name="" id="fid" required>
                                </div>
                            </div>
                        </div>

{{--                         <div class="form-group">
                            <label class="control-label col-sm-10" for="brandLogo"><input type="hidden" id="ID"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-warning" type="submit">
                                    <span class="glyphicon glyphicon-edit"></span>Update product
                                </button>
                            </div>
                        </div> --}}
                    </form>
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

    <div class="clearfix"></div>



    <div class="clearfix"></div>

    {{-- Modal Form Delete Post --}}
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

                    {{-- Form Delete Post --}}
                    <input type="hidden" name="_method" value="DELETE">
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
$('#expiry_date, #eexpiry_date').datepicker({
format: 'yyyy/mm/dd',
autoclose: true,
todayHighlight: true
})

//Initialize Select2 Elements
//$('.select2').select2()

@endsection