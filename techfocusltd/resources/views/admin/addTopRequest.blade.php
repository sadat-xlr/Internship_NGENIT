@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="{{url('top-requests')}}">Top Request</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Add Top Request</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Top Request</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" action="{{url('top-requests')}}" method="post" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="label1">Label 1</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="label1" required>
                            </div>
                            <label class="control-label" for="label_url1">Url</label>
                            <div class="controls">
                                <input type="text" name="label_url1" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="Label2">Label 2</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="label2" required>
                            </div>
                            <label class="control-label" for="label_url2">Url</label>
                            <div class="controls">
                                <input type="text" name="label_url2" required>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="label3">Label 3</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="label3" required>
                            </div>
                            <label class="control-label" for="label_url3">Url</label>
                            <div class="controls">
                                <input type="text" name="label_url3" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="label4">Label 4</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="label4" required>
                            </div>
                            <label class="control-label" for="label_url4">Url</label>
                            <div class="controls">
                                <input type="text" name="label_url4" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="label5">Label 5</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="label5" required>
                            </div>
                            <label class="control-label" for="label_url5">Url</label>
                            <div class="controls">
                                <input type="text" name="label_url5" required>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="label6">Label 6</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="label6" required>
                            </div>
                            <label class="control-label" for="label_url6">Url</label>
                            <div class="controls">
                                <input type="text" name="label_url6" required>
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
@endsection