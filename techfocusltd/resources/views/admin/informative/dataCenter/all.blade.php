@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="{{url('/cloud-datacenter')}}">Cloud & Data Center</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">All Content</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Cloud & data center Related Content</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table id="example2" class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>Title</th>
                            <th>
                                action
                                <a href="{{url('create-cloud-datacenter')}}" class="btn btn-success btn-sm">
                                    <i class="halflings-icon white plus"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataCenterInfoes as $dataCenterInfo)
                            <tr>
                                <td>{{$dataCenterInfo->topic}}</td>
                                <td>{{$dataCenterInfo->title}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{url('edit-cloud-datacenter/'.$dataCenterInfo->id)}}" class="btn btn-warning btn-sm">
                                            <i class="halflings-icon white edit"></i>
                                        </a>
                                        {{-- <a href="#" class="delete-digitalInnovation btn btn-danger btn-sm" data-id="{{$digitalInnovation->id}}">
                                            <i class="halflings-icon white trash"></i>
                                        </a> --}}
                                        <form action="{{ url('/delete-cloud-datacenter', ['id' => $dataCenterInfo->id]) }}" method="post">
                                            <input class="btn btn-default" type="submit" value="Delete" onclick="return confirm('Are you sure want to delete this data?')"/>
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
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
    {{-- <div id="myModal" class="modal fade" role="dialog">
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
                                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Banner</h2>
                                <div class="box-icon">
                                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <form class="form-horizontal" action="{{url('banners')}}" role="modal" id="banner_update-form">
                                    <fieldset>
                                        <input type="hidden" class="form-control" name="id" id="fid" disabled>
                                        <div class="control-group">
                                            <label class="control-label" for="banner_one">Banner image one</label>
                                            <div class="controls">
                                                <input type="file" class="form-control" name="banner_one">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="link1">Url one</label>
                                            <div class="controls">
                                                <input type="text" name="link1" id="link1" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="banner_two">Banner image two</label>
                                            <div class="controls">
                                                <input type="file" class="form-control" name="banner_two">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="link2">Url two</label>
                                            <div class="controls">
                                                <input type="text" name="link2" id="link2" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="banner_three">Banner image three</label>
                                            <div class="controls">
                                                <input type="file" class="form-control" name="banner_three">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="link3">Url three</label>
                                            <div class="controls">
                                                <input type="text" name="link3" id="link3" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="banner_four">Banner image four</label>
                                            <div class="controls">
                                                <input type="file" class="form-control" name="banner_four">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="link4">Url four</label>
                                            <div class="controls">
                                                <input type="text" name="link4" id="link4" required>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            <button type="reset" class="btn">Cancel</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>

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
    </div> --}}
@endsection