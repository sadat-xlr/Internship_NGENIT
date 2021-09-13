@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Member type</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">All Member type</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Member type</h2>
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
                        <th>Member type</th>
                        <th>Discount type</th>
                        <th>Discount value</th>
                        <th>Valid until</th>
                        <th>Free shipping</th>
                        <th>
                            action
                            <a href="#" class="addMembership btn btn-success btn-sm">
                                <i class="halflings-icon white plus"></i>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($memberships as $membership)
                        <tr id="membership{{$membership->id}}">
                            <td>
                                @if($membership->membership_type  == 0)
                                    Prime
                                @elseif($membership->membership_type  == 1)
                                    Silver
                                @elseif($membership->membership_type  == 2)
                                    Gold
                                @elseif($membership->membership_type  == 3)
                                    Diamond
                                @else
                                    Platinum
                                @endif
                            </td>
                            <td>
                                @if($membership->discount_unit == 0)
                                    Percentage discount
                                @elseif($membership->discount_unit  == 1)
                                    Fixed cart discount
                                @else
                                    Fixed product discount
                                @endif
                            </td>
                            <td>{{$membership->discount_value}}</td>
                            <td>{{$membership->valid_until}}</td>
                            <td>
                                @if($membership->is_free_shipping_active == 0)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="#" class="edit-membership btn btn-warning btn-sm" data-id="{{$membership->id}}" data-membership_type="{{$membership->membership_type}}" data-discount_unit="{{$membership->discount_unit}}" data-discount_value="{{$membership->discount_value}}" data-is_free_shipping_active="{{$membership->is_free_shipping_active}}" data-valid_until="{{$membership->valid_until}}">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a href="#" class="delete-membership btn btn-danger btn-sm" data-id="{{$membership->id}}">
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
                    <div class="row-fluid sortable">
                        <div class="box span12">
                            <div class="box-header" data-original-title>
                                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Member type</h2>
                                <div class="box-icon">
                                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <form class="form-horizontal" id="membershipAdd-form" action="{{url('membership_types')}}">
                                    <fieldset>
                                        <div class="control-group">
                                            <label class="control-label" for="membership_type">Member type :</label>
                                            <div class="controls">
                                                <select class="form-control" name="membership_type" id="membership_type" required>
                                                    <option value="0">Prime</option>
                                                    <option value="1">Silver</option>
                                                    <option value="2">Gold</option>
                                                    <option value="3">Diamond</option>
                                                    <option value="4">Platinum</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="membership_type">Discount type :</label>
                                            <div class="controls">
                                                <select class="form-control" name="discount_unit" id="discount_unit" required>
                                                    <option value="0">Percentage discount</option>
                                                    <option value="1">Fixed cart discount</option>
                                                    <option value="2">Fixed product discount</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="discount_value">Discount value :</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="discount_value" name="discount_value" placeholder="discount_value Here" required>
                                                <p class="error discount_value text-center alert alert-danger hidden"></p>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="is_free_shipping_active">Valid until :</label>
                                            <div class="controls">
                                                <input type="datetime-local" name="valid_until">
                                                <p class="error valid_until text-center alert alert-danger hidden"></p>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="is_free_shipping_active">Allow free shipping :</label>
                                            <div class="controls">
                                                <select class="form-control" id="is_free_shipping_active" name="is_free_shipping_active" required>
                                                    <option value="0">Yes</option>
                                                    <option value="1">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div><!--/span-->
                    </div><!--/row-->
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    <button class="btn btn-warning" type="submit" id="addMembership">
                        <span class="glyphicon glyphicon-plus"></span>Save Membership
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
                    <form class="form-horizontal" role="form" id="membershipEdit-form" action="{{url('membership_types')}}">
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="membership_type">Member type :</label>
                                <div class="controls">
                                    <select class="form-control" name="membership_type" id="emembership_type" required>
                                        <option value="0">Prime</option>
                                        <option value="1">Silver</option>
                                        <option value="2">Gold</option>
                                        <option value="3">Diamond</option>
                                        <option value="4">Platinum</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="membership_type">Discount type :</label>
                                <div class="controls">
                                    <select class="form-control" name="discount_unit" id="ediscount_unit" required>
                                        <option value="0">Percentage discount</option>
                                        <option value="1">Fixed cart discount</option>
                                        <option value="2">Fixed product discount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="discount_value">Discount value :</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="ediscount_value" name="discount_value" placeholder="discount_value Here" required>
                                    <p class="error discount_value text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="is_free_shipping_active">Valid until :</label>
                                <div class="controls">
                                    <input type="datetime-local" name="valid_until" id="evalid_until">
                                    <p class="error valid_until text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="is_free_shipping_active">Allow free shipping :</label>
                                <div class="controls">
                                    <select class="form-control" id="eis_free_shipping_active" name="is_free_shipping_active" required>
                                        <option value="0">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" class="form-control pull-right" name="_method" value="PUT">
                            <input type="hidden" class="form-control pull-right" name="id" id="fid">
                        </fieldset>
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

@section('script')

    //Date picker
    $('#valid_until, #evalid_until').datepicker({
    format: 'yyyy/mm/dd',
    autoclose: true,
    todayHighlight: true
    })

@endsection