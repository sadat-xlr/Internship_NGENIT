@extends('layouts.admin')
@section('title')
    <title>All-Roles</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Roles
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Roles</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Sl no.</th>
                    <th>Role name</th>
                    <th>Permission</th>
                    @hasrole('super admin')
                        <th>
                            action
                            <a href="#" class="addRole btn btn-success btn-sm">
                                <i class="fa fa-plus"></i>
                            </a>
                        </th>
                    @endhasrole
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $key => $role)
                    <tr id="role{{$role->id}}">
                        <td>{{$key + 1}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->permissions()->pluck('name')}}</td>
                        @hasrole('super admin')
                        <td>
                            <div class="table-data-feature">
                                <a href="#" class="edit-role btn btn-warning btn-sm" data-id="{{$role->id}}" data-name="{{$role->name}}" data-permission="@foreach($role->permissions as $permission) {{$permission->id}} @endforeach">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-role btn btn-danger btn-sm" data-id="{{$role->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                        @endhasrole
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    {{-- Modal Form Create role --}}
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
                    <form class="form-horizontal" enctype="multipart/form-data" id="role-form" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="categoryName">Role Name :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="roleName" name="roleName"
                                       placeholder="Role Name Here" required>
                                <p class="error roleName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="color">Permission :</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="checkbox">
                                        @foreach ($permissions as $permission)
                                            <label>
                                                <input type="checkbox" class="permission" name="permission_id[]" value="{{$permission->id}}" data-value="{{$permission->id}}">{{$permission->name}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="addRole"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit" id="addRole">
                                    <span class="glyphicon glyphicon-plus"></span>Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    {{--<button class="btn btn-warning" type="submit" id="addCategory">
                        <span class="glyphicon glyphicon-plus"></span>Save Category
                    </button> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    {{-- Modal Form Edit and Delete role --}}
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
                    <form class="form-horizontal" enctype="multipart/form-data" id="role_update-form" role="form">>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fid" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="roleName">Role Name :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="eroleName" name="roleName"
                                       placeholder="roleName Here" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="color">Permission :</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="checkbox">
                                        @foreach ($permissions as $permission)
                                            <label>
                                                <input type="checkbox" class="permission" name="permission_id[]" value="{{$permission->id}}" data-value="{{$permission->id}}">{{$permission->name}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="roleName"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit">
                                    <span class="glyphicon glyphicon-plus"></span>Update
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
