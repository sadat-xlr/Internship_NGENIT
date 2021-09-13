@extends('layouts.admin')
@section('title')
    <title>User list</title>
@endsection
@section('breadcrumbhead')
    <h1>
        User list
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User list</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">User List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>SL.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Permission</th>
                <th>Joinning date</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
                
            @foreach($users as  $key => $user)
                <tr id="userlist{{$user->id}}">
                    <td>{{$key +1}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->roles()->pluck('name')}}</td>
                    <td>{{$user->permissions()->pluck('name')}}</td>
                    <td>{{$user->created_at->format('Y-m-d')}}</td>
                    <td>
                        @hasrole('super admin')
                            <a href="#" class="user-role btn btn-warning btn-sm" data-id="{{$user->id}}" data-permission="@foreach($user->permissions as $permission) {{$permission->id}} @endforeach">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endhasrole

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

{{-- Modal for set commission--}}
<div id="set-role" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
            </div>
            <div class="modal-body">
                <form id="role_permission-form" class="form-horizontal">
                    <div class="form-group">
                        <input id="fid" type="" name="user_id" hidden>
                        <label for="" class="control-label col-sm-2">Role:</label>
                        <div class="col-sm-10">
                            <select id="role" class="form-control role" name="role_id"  required>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
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
                        <label class="control-label col-sm-10"></label>
                        <div class="col-sm-2">
                            <button class="btn btn-success" type="submit">
                                Send
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


@endsection
