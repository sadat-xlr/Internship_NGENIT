@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Announcement</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Announcement</h2>
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
                            <th>Label 1</th>
                            <th>Label 2</th>
                            <th>Label 3</th>
                            <th>Label 4</th>
                            <th>
                                action
                                @if (!count($announcements)>0)
                                    <a href="{{url('announcements/create')}}" class="btn btn-success btn-sm">
                                        <i class="halflings-icon white plus"></i>
                                    </a>
                                @endif
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($announcements as $announcement)
                        <tr id="announcement{{$announcement->id}}">
                            <td>{{$announcement->label1}}</td>
                            <td>{{$announcement->label2}}</td>
                            <td>{{$announcement->label3}}</td>
                            <td>{{$announcement->label4}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="#" class="edit-announcement btn btn-warning btn-sm" data-id="{{$announcement->id}}" data-label1="{{$announcement->label1}}" data-label2="{{$announcement->label2}}" data-label3="{{$announcement->label3}}" data-label4="{{$announcement->label4}}" data-label5="{{$announcement->label5}}" data-label6="{{$announcement->label6}}" data-label_url1="{{$announcement->label_url1}}" data-label_url2="{{$announcement->label_url2}}" data-label_url3="{{$announcement->label_url3}}" data-label_url4="{{$announcement->label_url4}}" data-label_url5="{{$announcement->label_url5}}" data-label_url6="{{$announcement->label_url6}}" >
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a href="#" class="delete-announcement btn btn-danger btn-sm" data-id="{{$announcement->id}}">
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
                    <div class="row-fluid sortable">
                        <div class="box span12">
                            <div class="box-header" data-original-title>
                                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit announcement</h2>
                                <div class="box-icon">
                                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <form class="form-horizontal" action="{{url('announcements')}}" role="modal" id="announcement_update-form">
                                    <fieldset>
                                        <input type="hidden" class="form-control" name="id" id="fid" disabled>
                                        <div class="control-group">
                                            <label class="control-label" for="label1">Label 1</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="label1" id="label1" required>
                                            </div>
                                            <label class="control-label" for="label_url1">Url</label>
                                            <div class="controls">
                                                <input type="text" name="label_url1" id="label_url1" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Label2">Label 2</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="label2" id="label2" required>
                                            </div>
                                            <label class="control-label" for="label_url2">Url</label>
                                            <div class="controls">
                                                <input type="text" name="label_url2" id="label_url2" required>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="label3">Label 3</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="label3" id="label3" required>
                                            </div>
                                            <label class="control-label" for="label_url3">Url</label>
                                            <div class="controls">
                                                <input type="text" name="label_url3" id="label_url3" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="label4">Label 4</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="label4" id="label4" required>
                                            </div>
                                            <label class="control-label" for="label_url4">Url</label>
                                            <div class="controls">
                                                <input type="text" name="label_url4" id="label_url4" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="label5">Label 5</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="label5" id="label5" required>
                                            </div>
                                            <label class="control-label" for="label_url5">Url</label>
                                            <div class="controls">
                                                <input type="text" name="label_url5" id="label_url5" required>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="label6">Label 6</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="label6" id="label6" required>
                                            </div>
                                            <label class="control-label" for="label_url6">Url</label>
                                            <div class="controls">
                                                <input type="text" name="label_url6" id="label_url6" required>
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