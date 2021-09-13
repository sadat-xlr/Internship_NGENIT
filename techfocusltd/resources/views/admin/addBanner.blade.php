@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Banner</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Add Banner</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Banner</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" action="{{url('banners')}}" method="post" enctype="multipart/form-data" role="form" id="banner_add-form">
                    {{csrf_field()}}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="banner_one">Banner image one</label>
                            <div class="controls">
                                <input type="file" class="form-control" name="banner_one" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="link1">Url one</label>
                            <div class="controls">
                                <input type="text" name="link1" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="banner_two">Banner image two</label>
                            <div class="controls">
                                <input type="file" class="form-control" name="banner_two" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="link2">Url two</label>
                            <div class="controls">
                                <input type="text" name="link2" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="banner_three">Banner image three</label>
                            <div class="controls">
                                <input type="file" class="form-control" name="banner_three" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="link3">Url three</label>
                            <div class="controls">
                                <input type="text" name="link3" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="banner_four">Banner image four</label>
                            <div class="controls">
                                <input type="file" class="form-control" name="banner_four" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="link4">Url four</label>
                            <div class="controls">
                                <input type="text" name="link4" required>
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