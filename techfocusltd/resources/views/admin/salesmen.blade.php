@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Salesmen</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">All Salesmen</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Salesmen</h2>
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
                        <th>Salesman name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>State/Division</th>
                        <th>Town/City</th>
                        <th>Zipe-code</th>
                        <th>
                            action
                            <a href="{{url('salesmen/create')}}" class="btn btn-success btn-sm">
                                <i class="halflings-icon white plus"></i>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salesmen as $salesman)
                        <tr id="salesman{{$salesman->id}}">
                            <td>{{$salesman->salesmanName}}</td>
                            <td>{{$salesman->designation}}</td>
                            <td>{{$salesman->email}}</td>
                            <td>{{$salesman->phone}}</td>
                            <td>{{$salesman->address}}</td>
                            <td>{{$salesman->country}}</td>
                            <td>{{$salesman->division}}</td>
                            <td>{{$salesman->city}}</td>
                            <td>{{$salesman->zipCode}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="#" class="edit-salesman btn btn-warning btn-sm" data-id="{{$salesman->id}}" data-salesmanName="{{$salesman->salesmanName}}" data-designation="{{$salesman->designation}}" data-email="{{$salesman->email}}" data-phone="{{$salesman->phone}}" data-address="{{$salesman->address}}" data-country="{{$salesman->country}}" data-division="{{$salesman->division}}" data-division="{{$salesman->division}}" data-division="{{$salesman->division}}" data-city="{{$salesman->city}}" data-zipCode="{{$salesman->zipCode}}">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a href="#" class="delete-salesman btn btn-danger btn-sm" data-id="{{$salesman->id}}">
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
                    <form class="form-horizontal" role="form" id="salesman-update-form" action="{{url('salesmen')}}">
                        <div class="control-group">
                            <label class="control-label" for="salesmanName">Salesman Name :</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="salesmanName" id="salesmanName"
                                       placeholder="salesmanName Here" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="designation">Designation :</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="designation" id="designation"
                                       placeholder="designation Here" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="email">E-mail :</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="email" id="email" placeholder="email Here" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="phone">Phone :</label>
                            <div class="controls">
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="phone Here" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="zipCode">Zip-code:</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="Zip-code  here...">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="country">Country:</label>
                            <div class="controls">
                                <select class="form-control" name="country" id="country">
                                    <option value="">Select Country</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="division">State:</label>
                            <div class="controls">
                                <select class="form-control" name="division" id="division">
                                    <option value="">Select State</option>
                                    <option value="Dhaka">Dhaka</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="city">Town / City:</label>
                            <div class="controls">
                                <select class="form-control" name="city" id="city">
                                    <option value="">Select Town / City</option>
                                    <option value="Dhaka">Dhaka</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="address">Address :</label>
                            <div class="controls">
                                <textarea placeholder="Your address here..." class="form-control" id="address" name="address"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="password">Password :</label>
                            <div class="controls">
                                <input type="password" id="password" name="password" class="form-control" placeholder="password  here...">
                            </div>
                        </div>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" id="id">
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