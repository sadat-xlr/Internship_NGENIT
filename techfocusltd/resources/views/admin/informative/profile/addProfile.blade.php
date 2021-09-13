@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Profile</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Add Profile</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Profile</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" action="{{url('store-profile')}}" method="post" enctype="multipart/form-data" role="form" id="banner_add-form">
                    {{csrf_field()}}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="profile">Company Profile</label>
                            <div class="controls">
                                <input type="file" class="form-control" name="profile" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="brochure">brochure</label>
                            <div class="controls">
                                <input type="file" class="form-control" name="brochure" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="dataSheet">Data Sheet</label>
                            <div class="controls">
                                <input type="file" class="form-control" name="dataSheet" required>
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