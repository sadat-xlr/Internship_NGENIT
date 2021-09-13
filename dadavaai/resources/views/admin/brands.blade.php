@extends('layouts.admin')
@section('title')
    <title>Brands</title>
@endsection

@section('breadcrumbhead')
    <h1>
        All Brands
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Product</li>
        <li class="active">Brands</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Brand</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Brand Name</th>
                <th>Brand Image</th>
                <th>
                    action
                    <a href="#" class="addBrand btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($brands as $brand)
                <tr id="brand{{$brand->id}}">
                    <td>{{$brand->brandName}}</td>
                    <td><img src="{{asset('storage/images/brand/'.$brand->brandImage)}}" height="90px" width="90px"></td>
                    <td>
                        <div class="table-data-feature">
                            <a href="#" class="edit-brand btn btn-warning btn-sm" data-id="{{$brand->id}}" data-brand_name="{{$brand->brandName}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="delete-brand btn btn-danger btn-sm" data-id="{{$brand->id}}">
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
                <form class="form-horizontal" action="{{url('brands')}}" enctype="multipart/form-data" role="form" id="brand_add_form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="image">brand image:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="image" required>
                            <p class="error image text-center alert alert-danger hidden"></p>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="brand_name">Brand Name :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="brand_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-10" for=""></label>
                        <div class="col-sm-2">
                            <button class="btn btn-success" type="submit" id="addBrand">
                                <span class="glyphicon glyphicon-plus"></span>Save slider
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
                <form class="form-horizontal" action="{{url('brands')}}" role="modal" id="brand_update_form">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="id" id="fid" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="image">Brand image:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="image">
                            <p class="error image text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="brand_name">Brand Name :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="brand_name" id="brand_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-10" for=""></label>
                        <div class="col-sm-2">
                            <button class="btn btn-warning" type="submit">
                                <span class="glyphicon glyphicon-check"></span>Update Brand
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