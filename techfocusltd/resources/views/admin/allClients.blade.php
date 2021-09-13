@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Industry</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Add Industry</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Colors</h2>
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
                        <th>Client name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Member Type</th>
                        <th>Promotional Points</th>
                        <th>Phone</th>
                        <th>Town/City</th>
                        <th>Account Status</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $client)
                        <tr id="client{{$client->id}}">
                            <td>{{$client->customerName}}</td>
                            <td>{{$client->company}}</td>
                            <td>{{$client->email}}</td>
                            <td>
                                @if($client->membership_type->membership_type  == 0)
                                    Prime
                                @elseif($client->membership_type->membership_type  == 1)
                                    Silver
                                @elseif($client->membership_type->membership_type  == 2)
                                    Gold
                                @elseif($client->membership_type->membership_type  == 3)
                                    Diamond
                                @else
                                    Platinum
                                @endif
                            </td>
                            <td>{{$client->promotional_reward_points}}</td>
                            <td>{{$client->phone}}</td>
                            <td>
                                @if($client->city  === 0)
                                    Dhaka
                                @endif
                            </td>
                            <td>
                                @if($client->status  == 0)
                                    Not Activated
                                @else
                                    Activated
                                @endif
                            </td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="#" class="delete-client btn btn-danger btn-sm" data-id="{{$client->id}}">
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

    {{-- Modal Form and Client Post --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
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