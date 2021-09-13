@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="{{url('sliders')}}">Slider</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">create Slider</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>create Slider</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon edit"></i><span class="break"></span>Slider image</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action="{{url('sliders')}}" enctype="multipart/form-data" role="form" id="slider_add-form">
                        {{-- <form class="form-horizontal" action="{{url('sliders')}}" enctype="multipart/form-data" role="form" > --}}
                            <fieldset>
                                <div class="control-group hidden-phone">
                                    <label class="control-label" for="textarea2">Slider image :</label>
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
            </div>
        </div><!--/span-->
    </div><!--/row-->
@endsection