@extends('layouts.admin')
@section('title')
    <title>Vendor list</title>
@endsection
@section('breadcrumbhead')
    <h1>
        vendor list
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">vendor list</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Vendor List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>SL.</th>
                <th>Name</th>
                <th>Store Name</th>
                <th>address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>commission</th>
                <th>Joinning date</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
                
            @foreach($vendors as  $key => $vendor)
                <tr id="vendorList{{$vendor->id}}">
                    <td>{{$key +1}}</td>
                    <td>{{$vendor->vendorName}}</td>
                    <td>{{$vendor->storeName}}</td>
                    <td>{{$vendor->address}}</td>
                    <td>{{$vendor->phone}}</td>
                    <td>{{$vendor->email}}</td>
                    <td>{{$vendor->commission}}%</td>
                    <td>{{$vendor->created_at->format('Y-m-d')}}</td>
                    <td>
                        @can('vendor handle')
                            <a href="#" class="edit-commission btn btn-warning btn-sm" data-id="{{$vendor->id}}">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
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
<div id="set-commission" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
            </div>
            <div class="modal-body">
                <form id="commission-form" class="form-horizontal">
                    <div class="form-group">
                        <label for="ID" class="control-label col-sm-2">Vendor ID :</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="vendor_id" id="vendor_id">
                        </div>                              
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="commission">Commission :</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="commission" name="commission">
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
