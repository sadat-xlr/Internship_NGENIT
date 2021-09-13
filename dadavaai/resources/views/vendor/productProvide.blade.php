@extends('layouts.vendor')
@section('title')
    <title>Product provide</title>
@endsection
@section('breadcrumbhead')
    <h1>
        Product provide
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/vendor-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product provide</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Product provide</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Product provide id</th>
                <th>Category</th>
                <th>subcategory</th>
                <th>minicategory</th>
                <th>
                    action
                    @if(!$productProvide)
                    <a href="#" class="addProductProvide btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                    </a>
                    @endif
                </th>
            </tr>
            </thead>
            <tbody>
            @if($productProvide)
                <tr id="productProvide{{$productProvide->id}}">
                    <td>{{$productProvide->id}}</td>
                    <td>
                        {{$productProvide->category->categoryName}}
                    </td>
                    <td>
                        @if($productProvide->subcategory_id)
                        {{$productProvide->subcategory->subCategoryName}}
                        @endif
                    </td>
                    <td>
                        @if($productProvide->minicategory_id)
                        {{$productProvide->minicategory->miniCategoryName}}
                        @endif
                    </td>
                    <td>
                        <a href="#" class="edit-productProvide btn btn-warning btn-sm" data-id="{{$productProvide->id}}" data-category_id="{{$productProvide->category_id}}" data-subcategory_id="{{$productProvide->subcategory_id}}" 
                            @if($productProvide->subcategory_id)
                            data-subcategory="{{$productProvide->subcategory->subCategoryName}}"
                            @endif

                            data-minicategory_id="{{$productProvide->minicategory_id}}" 
                            @if($productProvide->minicategory_id) 
                            data-minicategory="{{$productProvide->minicategory->miniCategoryName}}"
                            @endif
                            >
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="#" class="delete-productProvide btn btn-danger btn-sm" data-id="{{$productProvide->id}}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

    {{-- Modal Form Create Product --}}
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
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" id="product_provide-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="category_id">Category :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="subcategory_id">SubCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="subcategory_id" name="subcategory_id">
                                    <option value="">Select SubCategory</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            {{-- minicategory --}}
                            <label class="control-label col-sm-2" for="minicategory_id">MiniCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="minicategory_id" name="minicategory_id">
                                    <option value="">Select MiniCategory</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-sm-10" for="brandLogo"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit">
                                    <span class="glyphicon glyphicon-plus"></span>Save
                                </button>
                            </div>
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
    </div>

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
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" id="updateProductProvide">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="category_id">Category :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="ecategory_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="subcategory_id">SubCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="esubcategory_id" name="subcategory_id">
                                    <option value="">Select SubCategory</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            
                            {{-- Minicategory edit --}}

                            <label class="control-label col-sm-2" for="minicategory_id">MiniCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="eminicategory_id" name="minicategory_id">
                                    <option value="">Select MiniCategory</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-sm-10" for="brandLogo"><input type="hidden" id="ID"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-warning" type="submit">
                                    <span class="glyphicon glyphicon-edit"></span>Update product
                                </button>
                            </div>
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
    </div>

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