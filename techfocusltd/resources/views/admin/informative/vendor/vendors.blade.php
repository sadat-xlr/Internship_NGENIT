@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Vendors</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">All vendor</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All vendors</h2>
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
                            <th>vendor image</th>
                            <th>
                                action
                                <a href="{{url('vendor-create')}}" class="btn btn-success btn-sm">
                                    <i class="halflings-icon white plus"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($vendors as $vendor)
                        <tr id="vendor{{$vendor->id}}">
                            <td><img src="{{asset('storage/images/logo/vendor/'.$vendor->image)}}" height="100px" width="100px"></td>
                            <td>
                                <div class="table-data-feature">
                                    {{-- <a href="#" class="edit-vendor btn btn-warning btn-sm" data-id="{{$vendor->id}}" data-image="{{asset('storage/images/logo/vendor/'.$vendor->image)}}">
                                        <i class="halflings-icon white edit"></i>
                                    </a> --}}
                                    <a href="#" class="delete-vendor btn btn-danger btn-sm" data-id="{{$vendor->id}}">
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
                                <h2><i class="halflings-icon edit"></i><span class="break"></span>Vendor image</h2>
                                <div class="box-icon">
                                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <form class="form-horizontal" action="{{url('vendors')}}" enctype="multipart/form-data" role="form" id="vendor_add-form">
                                    <fieldset>
                                        <div class="control-group hidden-phone">
                                            <label class="control-label" for="textarea2">Vendor image :</label>
                                            <div class="controls">
                                                <input type="file" class="form-control" name="image" required>
                                                <p class="error image text-center alert alert-danger hidden"></p>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            <button type="reset" class="btn">Cancel</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div><!--/span-->
                    </div><!--/row-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class="glyphicon glyphicon"></span>close
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
                    <div class="row-fluid sortable">
                        <div class="box span12">
                            <div class="box-header" data-original-title>
                                <h2><i class="halflings-icon edit"></i><span class="break"></span>Vendor image</h2>
                                <div class="box-icon">
                                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <form class="form-horizontal" action="{{url('vendors')}}" role="modal" id="vendor_update-form">
                                    <fieldset>
                                        <input type="hidden" class="form-control" name="id" id="fid" disabled>
                                        <div class="control-group hidden-phone">
                                            <label class="control-label" for="textarea2">Vendor image :</label>
                                            <div class="controls">
                                                <input type="file" class="form-control" name="image" required>
                                                <p class="error image text-center alert alert-danger hidden"></p>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            <button type="reset" class="btn">Cancel</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div><!--/span-->
                    </div><!--/row-->
                </div>
                {{-- Form Delete Post --}}
                <input type="hidden" name="_method" value="DELETE">
                <div class="deleteContent">
                    Are You sure want to delete this data?
                    <span class="hidden id" style="display:none"></span>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="deleteVendor btn actionBtn" data-dismiss="modal">
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