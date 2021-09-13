@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Incentive</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">All Incentive</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Incentive</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table id="example1" class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Sales VALUE</th>
                        <th>INCENTIVE</th>
                        <th>Status</th>
                        <th>Paid</th>
                        <th>
                            action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($incentives as $incentive)
                        <tr id="incentive{{$incentive->id}}">
                            <td>{{$incentive->created_at}}</td>
                            <td>{{$incentive->mydeal->client->companyName}}</td>
                            <td>৳ {{$incentive->sales_value}}</td>
                            <td>৳ {{$incentive->incentive_value}}</td>
                            <td>{{$incentive->mydeal->final_status}}</td>
                            <td id="paid{{$incentive->id}}">
                                @if($incentive->is_paid)
                                    Paid
                                @else
                                    Not paid
                                @endif
                            </td>
                            <td id="action{{$incentive->id}}">
                                <div class="table-data-feature">
                                    <a href="#" class="edit-incentive btn btn-warning btn-sm" data-id="{{$incentive->id}}" data-is_paid="{{$incentive->is_paid}}">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a href="#" class="delete-incentive btn btn-danger btn-sm" data-id="{{$incentive->id}}">
                                        <i class="halflings-icon white trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->

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
                    <form class="form-horizontal" role="modal" id="edit-incentive-form">

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fid" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="tagName">Is paid :</label>
                            <div class="col-sm-10">
                                <select name="is_paid" id="is_paid" required>
                                    <option value="0">Not Paid</option>
                                    <option value="1">paid</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="_method" value="PUT">
                    </form>
                    {{-- Form Delete Post --}}
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
