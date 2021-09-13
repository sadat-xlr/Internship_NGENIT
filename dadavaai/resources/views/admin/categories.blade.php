@extends('layouts.admin')
@section('title')
    <title>All-Categories</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Categories
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Product</li>
        <li class="active">Categories</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Category</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Icon</th>
                    <th>Category name</th>
                    <th>ad</th>
                    <th>
                        action
                        <a href="#" class="addCategory btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr id="category{{$category->id}}">
                        <td><img src="{{asset('storage/images/category/'.$category->image_icon)}}" height="100px" width="100px"></td>
                        <td>{{$category->categoryName}}</td>
                        <td><img src="{{asset('storage/images/category/'.$category->image_ad)}}" height="100px" width="100px"></td>                        
                        <td>
                            <div class="table-data-feature">
                                <a href="#" class="edit-category btn btn-warning btn-sm" data-id="{{$category->id}}" data-categoryName="{{$category->categoryName}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-category btn btn-danger btn-sm" data-id="{{$category->id}}">
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
                    <form class="form-horizontal" enctype="multipart/form-data" id="category-form" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="categoryName">Category Name :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="categoryName" name="categoryName"
                                       placeholder="categoryName Here" required>
                                <p class="error categoryName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image_icon">Icon :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="image_icon">
                            </div>
                            <label class="control-label col-sm-2" for="image_ad">ads :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="image_ad">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="brandLogo"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit" id="addCategory">
                                    <span class="glyphicon glyphicon-plus"></span>Save Category
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
{{--                     <button class="btn btn-warning" type="submit" id="addCategory">
                        <span class="glyphicon glyphicon-plus"></span>Save Category
                    </button> --}}
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
                    <form class="form-horizontal" enctype="multipart/form-data" id="category_update-form" role="form">>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fid" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="categoryName">Category Name :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ecategoryName" name="categoryName"
                                       placeholder="categoryName Here" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image_icon">Icon :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="image_icon">
                            </div>
                            <label class="control-label col-sm-2" for="image_ad">ads :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="image_ad">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="brandLogo"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit">
                                    <span class="glyphicon glyphicon-plus"></span>Update category
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
