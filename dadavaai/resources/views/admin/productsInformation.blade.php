@extends('layouts.admin')

@section('breadcrumbhead')
    Ad single page
    <small>Control panel</small>
@endsection

@section('breadcrumb')
    <li class="active">Ad single page</li>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Ad single page</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Description_1</th>
                    <th>Image_1</th>
                    <th>Product</th>
                    <th>
                        action
                        <a href="#" class="addProductInformation btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($productInformations as $productInformation)
                    <tr id="productInformation{{$productInformation->id}}">
                        <td>{!! html_entity_decode($productInformation->description_1) !!}</td>
                        <td> <img src="{{asset('storage/images/productInformation/'.$productInformation->image_1)}}" height="100px" width="100px"></td>
                        <td>{{$productInformation->product->productName}}</td>
                        <td>
                            <div class="table-data-feature">
                                {{-- <a href="#" class="show-productInformation btn btn-info btn-sm" data-id="{{$productInformation->id}}" data-description_1="{{strip_tags($productInformation->description_1)}}" data-description_2="{{strip_tags($productInformation->description_2)}}" data-description_3="{{strip_tags($productInformation->description_3)}}" data-description_4="{{strip_tags($productInformation->description_4)}}" data-product_id="{{$productInformation->product_id}}">
                                    <i class="fa fa-eye"></i>
                                </a> --}}

                                <a href="{{url('product-ad-Information/'.$productInformation->id)}}" class="btn btn-info btn-sm" target="_blank">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="#" class="edit-productInformation btn btn-warning btn-sm" data-id="{{$productInformation->id}}" data-description_1="{{strip_tags($productInformation->description_1)}}" data-description_2="{{strip_tags($productInformation->description_2)}}" data-description_3="{{strip_tags($productInformation->description_3)}}" data-description_4="{{strip_tags($productInformation->description_4)}}" data-product_id="{{$productInformation->product_id}}" data-product_name="{{$productInformation->product->productName}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-productInformation btn btn-danger btn-sm" data-id="{{$productInformation->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
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
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" id="insertProductInformation">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="product_id">Product :</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="product_id" data-placeholder="Search for product" style="width: 100%;">
                                    <option value="0" selected>select one</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image_1">Image 1 :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image_1">
                            </div>                            
                            <label class="control-label col-sm-2" for="description_1">description 1 :</label>
                            <div class="col-sm-10">
                                <textarea id="description_1" name="description_1" rows="10" cols="80"></textarea>
                                <p class="error description_1 text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#description_1').summernote({
                                            placeholder: 'description_1',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image_2">Image 2 :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image_2">
                            </div>                            
                            <label class="control-label col-sm-2" for="description_2">description 2 :</label>
                            <div class="col-sm-10">
                                <textarea id="description_2" name="description_2" rows="10" cols="80"></textarea>
                                <p class="error description_2 text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#description_2').summernote({
                                            placeholder: 'description_2',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image_3">Image 3 :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image_3">
                            </div>                            
                            <label class="control-label col-sm-2" for="description_3">description 3 :</label>
                            <div class="col-sm-10">
                                <textarea id="description_3" name="description_3" rows="10" cols="80"></textarea>
                                <p class="error description_3 text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#description_3').summernote({
                                            placeholder: 'description_3',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image_4">Image 4 :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image_4">
                            </div>                            
                            <label class="control-label col-sm-2" for="description_1">description 4 :</label>
                            <div class="col-sm-10">
                                <textarea id="description_4" name="description_4" rows="10" cols="80"></textarea>
                                <p class="error description_4 text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#description_4').summernote({
                                            placeholder: 'description_4',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label class="control-label col-sm-8" for="brandLogo"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit" id="addProductInformation">
                                    <span class="glyphicon glyphicon-plus"></span>Save Info
                                </button>
                            </div>
                        </div>                                                                     
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
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
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" id="updateProductInformation">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fid" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="product_id">Product :</label>
                            <div class="col-sm-10">
                                <span id="eproduct_name"></span>
                            </div>                            
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image_1">Image 1 :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image_1">
                            </div>                            
                            <label class="control-label col-sm-2" for="description_1">description 1 :</label>
                            <div class="col-sm-10">
                                <textarea id="edescription_1" name="description_1" rows="10" cols="80"></textarea>
                                <p class="error description_1 text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#edescription_1').summernote({
                                            placeholder: 'description_1',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image_2">Image 2 :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image_2">
                            </div>                            
                            <label class="control-label col-sm-2" for="description_2">description 2 :</label>
                            <div class="col-sm-10">
                                <textarea id="edescription_2" name="description_2" rows="10" cols="80"></textarea>
                                <p class="error description_2 text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#edescription_2').summernote({
                                            placeholder: 'description_2',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image_3">Image 3 :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image_3">
                            </div>                            
                            <label class="control-label col-sm-2" for="description_3">description 3 :</label>
                            <div class="col-sm-10">
                                <textarea id="edescription_3" name="description_3" rows="10" cols="80"></textarea>
                                <p class="error description_3 text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#edescription_3').summernote({
                                            placeholder: 'description_3',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image_4">Image 4 :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image_4">
                            </div>                            
                            <label class="control-label col-sm-2" for="description_1">description 4 :</label>
                            <div class="col-sm-10">
                                <textarea id="edescription_4" name="description_4" rows="10" cols="80"></textarea>
                                <p class="error description_4 text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#edescription_4').summernote({
                                            placeholder: 'description_4',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="control-label col-sm-8" for="brandLogo"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit" id="updateProductInformation">
                                    <span class="glyphicon glyphicon-plus"></span>Update Info
                                </button>
                            </div>
                        </div>                                                                     
                    </form>
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

    //Initialize Select2 Elements
    $('.select2').select2()

@endsection