@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Subsectors</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">All Subsectors</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Subsectors</h2>
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
                        <th>Subsector name</th>
                        <th>Sector name</th>
                        <th>
                            action
                            <a href="#" class="addSubSector btn btn-success btn-sm">
                                <i class="halflings-icon white plus"></i>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subsectors as $subsectors)
                        <tr id="subSector{{$subsectors->id}}">
                            <td>{{$subsectors->subSectorName}}</td>
                            <td>{{$subsectors->sector->sectorName}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="#" class="edit-subSector btn btn-warning btn-sm" data-id="{{$subsectors->id}}" data-subSectorName="{{$subsectors->subSectorName}}" data-sector_id="{{$subsectors->sector_id}}">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a href="#" class="delete-subSector btn btn-danger btn-sm" data-id="{{$subsectors->id}}">
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
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="subSectorName">subSectorName Name :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subSectorName"
                                       placeholder="subSectorName Here" required>
                                <p class="error subSectorName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="subSectorName">subSectorName Name :</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="sector_id" id="sector_id" required>
                                    @foreach($sectors as $sector)
                                    <option value="{{$sector->id}}">{{$sector->sectorName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    <button class="btn btn-warning" type="submit" id="addSubSector">
                        <span class="glyphicon glyphicon-plus"></span>Save sectorName
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
                    <form class="form-horizontal" role="modal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fid" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="subSectorName">subSectorName Name :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subSectorName" id="subSectorName"
                                       placeholder="subSectorName Here" required>
                                <p class="error subSectorName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="subSectorName">subSectorName Name :</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="sector_id" id="esector_id" required>
                                    @foreach($sectors as $sector)
                                        <option value="{{$sector->id}}">{{$sector->sectorName}}</option>
                                    @endforeach
                                </select>
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