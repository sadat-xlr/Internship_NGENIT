@extends('layouts.admin')
@section('title')
    <title>Sub-Categories</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Sub-Categories
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Product</li>
        <li class="active">Sub-categories</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">SubCategory</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Category name</th>
                <th>SubCategory name</th>
                <th>
                    action
                    <a href="#" class="addSubcategory btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($subCategories as $subCategory)
                <tr id="subcategory{{$subCategory->id}}">
                    <td>{{$subCategory->category->categoryName}}</td>
                    <td>{{$subCategory->subCategoryName}}</td>
                    <td>
                        <div class="table-data-feature">
                            <a href="#" class="edit-subcategory btn btn-warning btn-sm" data-id="{{$subCategory->id}}" data-subCategoryName="{{$subCategory->subCategoryName}}" data-category_id="{{$subCategory->category_id}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="delete-subcategory btn btn-danger btn-sm" data-id="{{$subCategory->id}}">
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
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="category">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="category_id">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="subCategoryName">SubCategory :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="subCategoryName" name="subCategoryName"
                                   placeholder="subCategoryName Here" required>
                            <p class="error subCategoryName text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <button class="btn btn-warning" type="submit" id="addSubcategory">
                    <span class="glyphicon glyphicon-plus"></span>Save SubCategory
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
                <form class="form-horizontal" role="modal">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fid" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="category">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="ecategory_id">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="categoryName">SubCategory :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="esubCategoryName" name="subCategoryName"
                                   placeholder="subCategoryName Here" required>
                        </div>
                    </div>
                    <input type="hidden" name="_method1" value="PUT">
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