@extends('layouts.admin')

@section('breadcrumbhead')
    About Info
    <small>Control panel</small>
@endsection

@section('breadcrumb')
    <li class="active">About Info</li>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">About info</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>description</th>
                    @hasanyrole('super admin|Admin')
                    <th>
                        action
                        <a href="#" class="addAbout btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                    @endhasanyrole
                </tr>
                </thead>
                <tbody>
                @foreach($abouts as $about)
                    <tr id="about{{$about->id}}">
                        <td>{!! html_entity_decode($about->description) !!}</td>
                        <td>
                            <div class="table-data-feature">
                                <a href="#" class="show-about btn btn-info btn-sm" data-id="{{$about->id}}" data-description="{{strip_tags($about->description)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @hasanyrole('super admin|Admin')
                                    <a href="#" class="edit-about btn btn-warning btn-sm" data-id="{{$about->id}}" data-description="{{strip_tags($about->description)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" class="delete-about btn btn-danger btn-sm" data-id="{{$about->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @endhasanyrole
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

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
                    <form class="form-horizontal" role="form" id="insertAbout">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="description">description :</label>
                            <div class="col-sm-10">
                                <textarea id="description" name="description" rows="10" cols="80"></textarea>
                                <p class="error description text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#description').summernote({
                                            placeholder: 'Description',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    <button class="btn btn-warning" type="submit" id="addAbout">
                        <span class="glyphicon glyphicon-plus"></span>Save Info
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    {{-- Modal Form Show POST --}}
    <div id="show" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">ID :</label>
                        <b id="i"/>
                    </div>
                    <div class="form-group">
                        <label for="">description :</label>
                        <b id="des"/>
                    </div>
                </div>
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
                            <label class="control-label col-sm-2" for="description">description :</label>
                            <div class="col-sm-10">
                                <textarea id="edescription" name="description" rows="10" cols="80"></textarea>
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