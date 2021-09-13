@extends('layouts.admin')
@section('title')
    <title>Tags</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Tags
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Product</li>
        <li class="active">Tags</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tag</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Tag Name</th>
                <th>
                    action
                    <a href="#" class="addTag btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr id="tag{{$tag->id}}">
                    <td>{{$tag->tagName}}</td>
                    <td>
                        <div class="table-data-feature">
                            <a href="#" class="edit-tag btn btn-warning btn-sm" data-id="{{$tag->id}}" data-tag="{{$tag->tagName}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="delete-tag btn btn-danger btn-sm" data-id="{{$tag->id}}">
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
                        <label class="control-label col-sm-2" for="tagName">Tag Name :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tagName" name="tagName"
                                   placeholder="tagName Here" required>
                            <p class="error tag text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <button class="btn btn-warning" type="submit" id="addTag">
                    <span class="glyphicon glyphicon-plus"></span>Save tag
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
                        <label class="control-label col-sm-2" for="tagName">tag Name :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="etagName" name="tagName"
                                   placeholder="tagName Here" required>
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