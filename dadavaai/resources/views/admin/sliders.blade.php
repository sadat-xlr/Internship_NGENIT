@extends('layouts.admin')
@section('title')
    <title>Sliders</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Slider
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Site Info</li>
        <li class="active">Slider</li>
    </ol>
@endsection

@section('content')
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Slider image</th>
                            <th>Slider link</th>
                            @hasanyrole('super admin|Admin')
                                <th>
                                    action
                                    <a href="#" class="addSlider btn btn-success btn-sm" >
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </th>
                            @endhasanyrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $slider)
                            <tr id="slider{{$slider->id}}">
                                <td><img src="{{asset('storage/images/slider/'.$slider->image)}}" height="100px" width="100px"></td>
                                <td>{{$slider->slider_link}}</td>
                                @hasanyrole('super admin|Admin')
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="#" class="edit-slider btn btn-warning btn-sm" data-id="{{$slider->id}}" data-image="{{asset('storage/images/slider/'.$slider->image)}}" data-slider_link="{{$slider->slider_link}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="delete-slider btn btn-danger btn-sm" data-id="{{$slider->id}}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                @endhasanyrole
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        </tr>
                    </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>


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
                    <form class="form-horizontal" action="{{url('sliders')}}" enctype="multipart/form-data" role="form" id="slider_add-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image">Slider image :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image" required>
                                <p class="error image text-center alert alert-danger hidden"></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image">Slider link :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="slider_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for=""></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit" id="addSlider">
                                    <span class="glyphicon glyphicon-plus"></span>Save slider
                                </button>
                            </div>
                        </div>
                    </form>
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
                    <form class="form-horizontal" action="{{url('sliders')}}" role="modal" id="slider_update-form">

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="id" id="fid" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image">Slider image :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image">
                                <p class="error image text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image">Slider link :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="slider_link" id="slider_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="brandLogo"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-warning" type="submit">
                                    <span class="glyphicon glyphicon-check"></span>Update Slider
                                </button>
                            </div>
                        </div>
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