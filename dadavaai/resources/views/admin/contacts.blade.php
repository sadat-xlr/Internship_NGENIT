@extends('layouts.admin')
@section('title')
    <title>Conpany Contacts</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Conpany Contacts
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Site Info</li>
        <li class="active">Conpany Contacts</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Contact info</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Company Address</th>
                <th>Phone Number 1</th>
                <th>Phone Number 2</th>
                <th>E-mail</th>
                @hasanyrole('super admin|Admin')
                <th>
                    action
                    <a href="#" class="addContact btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                    </a>
                </th>
                @endhasanyrole
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
                <tr id="contact{{$contact->id}}">
                    <td>{{$contact->address}}</td>
                    <td>{{$contact->phone1}}</td>
                    <td>{{$contact->phone2}}</td>
                    <td>{{$contact->email}}</td>
                    <td>
                        <div class="table-data-feature">
                            <a href="#" class="show-contact btn btn-info btn-sm" data-id="{{$contact->id}}" data-address="{{$contact->address}}" data-phone1="{{$contact->phone1}}" data-phone2="{{$contact->phone2}}" data-email="{{$contact->email}}">
                                <i class="fa fa-eye"></i>
                            </a>
                            @hasanyrole('super admin|Admin')
                                <a href="#" class="edit-contact btn btn-warning btn-sm" data-id="{{$contact->id}}" data-address="{{$contact->address}}" data-phone1="{{$contact->phone1}}" data-phone2="{{$contact->phone2}}" data-email="{{$contact->email}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-contact btn btn-danger btn-sm" data-id="{{$contact->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endhasanyrole
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
                <form class="form-horizontal" role="form" id="contact-form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="address">address :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="address Here" required>
                            <p class="error address text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="phone1">phone1 :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone1" name="phone1"
                                   placeholder="phone Here" required>
                            <p class="error phone1 text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="phone2">phone2 :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone2" name="phone2"
                                   placeholder="phone Here" required>
                            <p class="error phone2 text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">email :</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="email Here" required>
                            <p class="error email text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <button class="btn btn-warning" type="submit" id="addContact">
                    <span class="glyphicon glyphicon-plus"></span>Save Contact
                </button>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>

{{-- Modal Form Show POST --}}
<div id="show" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">ID :</label>
                    <b id="i"/>
                </div>
                <div class="form-group">
                    <label for="">address :</label>
                    <b id="ad"/>
                </div>
                <div class="form-group">
                    <label for="">phone1 :</label>
                    <b id="ph1"/>
                </div>
                <div class="form-group">
                    <label for="">phone2 :</label>
                    <b id="ph2"/>
                </div>
                <div class="form-group">
                    <label for="">email :</label>
                    <b id="em"/>
                </div>
            </div>
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
                        <label class="control-label col-sm-2" for="address">address :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="eaddress" name="address"
                                   placeholder="address Here" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="phone1">phone1 :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ephone1" name="phone"
                                   placeholder="phone Here" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="phone2">phone2 :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ephone2" name="phone"
                                   placeholder="phone Here" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">email :</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="eemail" name="email"
                                   placeholder="email Here" required>
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