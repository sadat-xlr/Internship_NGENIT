@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Salesmen target</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Salesmen target</h2>
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
                        <th>Salesman</th>
                        <th>Year</th>
                        <th>Quarter</th>
                        <th>Month</th>
                        <th>Sales target</th>
                        <th>New Client target</th>
                        <th>Existing Client target</th>
                        <th>Physical Mkt</th>
                        <th>Phone Mkt</th>
                        <th>Social Mkt</th>
                        <th>Email Mkt</th>
                        <th>
                            action
                            <a href="{{url('salesmantargets/create')}}" class="btn btn-success btn-sm">
                                <i class="halflings-icon white plus"></i>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salesmentarget as $salesmentarget)
                        <tr id="salesmentarget{{$salesmentarget->id}}">
                            <td>{{$salesmentarget->salesman->salesmanName}}</td>
                            <td>{{$salesmentarget->year}}</td>
                            <td>{{$salesmentarget->quarter}}</td>
                            <td>{{$salesmentarget->month}}</td>
                            <td>{{$salesmentarget->sales_target}}</td>
                            <td>{{$salesmentarget->new_client_target}}</td>
                            <td>{{$salesmentarget->existing_client_target}}</td>
                            <td>{{$salesmentarget->physical_mkt}}</td>
                            <td>{{$salesmentarget->phone_mkt}}</td>
                            <td>{{$salesmentarget->social_mkt}}</td>
                            <td>{{$salesmentarget->email_mkt}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="#" class="edit-salesman_target btn btn-warning btn-sm" data-id="{{$salesmentarget->id}}">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a href="#" class="delete-salesman_target btn btn-danger btn-sm" data-id="{{$salesmentarget->id}}">
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
                    <form class="form-horizontal" role="form" action="{{url('salesmantargets')}}" method="post" id="salesman_target-update-form">
                        <div class="control-group">
                            <label class="control-label" for="salesman_id">Salesman :</label>
                            <div class="controls">
                                <select class="form-control salesman_id" name="salesman_id" id="salesman_id" required>
                                    <option value="">Select Salesman</option>
                                    @foreach($salesmen as $salesman)
                                        <option value="{{$salesman->id}}">{{$salesman->salesmanName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="month">Month :</label>
                            <div class="controls">
                                <select class="form-control" name="month" id="month" required>
                                    <option value="">Select Month</option>
                                    <option value="January">January </option>
                                    <option value="February">February </option>
                                    <option value="March">March </option>
                                    <option value="April">April </option>
                                    <option value="May">May </option>
                                    <option value="June">June </option>
                                    <option value="July">July </option>
                                    <option value="August">August </option>
                                    <option value="September">September </option>
                                    <option value="October">October </option>
                                    <option value="November">November </option>
                                    <option value="December">December </option>
                                </select>
                                <p class="error month text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="year">Year :</label>
                            <div class="controls">
                                <input type="number" class="form-control" name="year" id="year" placeholder="Year Here" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="quarter">Quarter :</label>
                            <div class="controls">
                                <select class="form-control quarter" name="quarter" id="quarter" required>
                                    <option value="">Select Quarter</option>
                                    <option value="dummy">dummy</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="new_client_target">New Client target :</label>
                            <div class="controls">
                                <input type="number" class="form-control" name="new_client_target" id="new_client_target" placeholder="New Client target Here" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="existing_client_target">Existing Client target :</label>
                            <div class="controls">
                                <input type="number" class="form-control" name="existing_client_target" id="existing_client_target" placeholder="Existing Client target Here" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="sales_target">Sales target :</label>
                            <div class="controls">
                                <input type="number" class="form-control" name="sales_target" id="sales_target" placeholder="Sales target Here" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="physical_mkt">Physical Mkt :</label>
                            <div class="controls">
                                <input type="number" class="form-control" name="physical_mkt" id="physical_mkt" placeholder="Physical Mkt Here" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="phone_mkt">Phone Mkt :</label>
                            <div class="controls">
                                <input type="number" class="form-control" name="phone_mkt" id="phone_mkt" placeholder="Phone Mkt Here" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="social_mkt">Social Mkt :</label>
                            <div class="controls">
                                <input type="number" class="form-control" name="social_mkt" id="social_mkt" placeholder="Social Mkt Here" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="email_mkt">Email Mkt :</label>
                            <div class="controls">
                                <input type="number" class="form-control" name="email_mkt" id="email_mkt" placeholder="Email Mkt Here" required>
                            </div>
                        </div>
                        <input type="hidden" id="id">
                        <input type="hidden" name="_method" value="PUT">
                    </form>

                    {{-- Form Delete Post --}}
                    <input type="hidden" name="_method1" value="DELETE">
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