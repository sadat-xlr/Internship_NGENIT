@extends('layouts.admin')
@section('title')
    <title>Tabs</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Tabs
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Product</li>
        <li class="active">Tabs</li>
    </ol>
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tabs</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Tab name</th>
                <th>MiniCategory name</th>
                <th>SubCategory name</th>
                <th>Category name</th>
                <th>
                    action
                    <a href="#" class="addTab btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($tabs as $tab)
                <tr id="tab{{$tab->id}}">
                    <td>{{$tab->tabName}}</td>
                    <td>{{$tab->minicategory->miniCategoryName}}</td>
                    <td>{{$tab->minicategory->subcategory->subCategoryName}}</td>
                    <td>{{$tab->minicategory->subcategory->category->categoryName}}</td>
                    <td>
                        <div class="table-data-feature">
                            <a href="#" class="edit-tab btn btn-warning btn-sm" data-id="{{$tab->id}}" data-tabName="{{$tab->tabName}}" data-category_id="{{$tab->minicategory->subcategory->category_id}}" data-minicategory_id="{{$tab->minicategory_id}}" data-minicategoryname="{{$tab->minicategory->miniCategoryName}}" data-subcategory_id="{{$tab->minicategory->subcategory_id}}" data-subcategoryname="{{$tab->minicategory->subcategory->subCategoryName}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="delete-tab btn btn-danger btn-sm" data-id="{{$tab->id}}">
                                <i class="fa fa-trash"></i>
                            </a>
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
                <form class="form-horizontal" role="form" action="{{url('tabs')}}" id="add_tab_form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="category">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                @endforeach
                            </select>
                            <p class="error category_id text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="subcategory_id">SubCategory :</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="subcategory_id" id="subcategory_id">
                                <option value="">Select subcategory</option>
                            </select>
                            <p class="error subcategory_id text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="minicategory_id">MiniCategory :</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="minicategory_id" id="minicategory_id">
                                <option value="">Select MiniCategory</option>
                            </select>
                            <p class="error minicategory_id text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="tabName">Tab :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tabName"
                                   placeholder="tabName Here" required>
                            <p class="error tabName text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <button class="btn btn-warning" type="submit" id="addTab">
                    <span class="glyphicon glyphicon-plus"></span>Save Tab
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
                <form class="form-horizontal" role="modal" action="{{url('tabs')}}" id="update_tab_form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="category">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category_id" id="ecategory_id">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                @endforeach
                            </select>
                            <p class="error category_id text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="subcategory_id">SubCategory :</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="subcategory_id" id="esubcategory_id">
                                <option value="">Select subcategory</option>
                            </select>
                            <p class="error subcategory_id text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="minicategory_id">MiniCategory :</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="minicategory_id" id="eminicategory_id">
                                <option value="">Select minicategory</option>
                            </select>
                            <p class="error minicategory_id text-center alert alert-danger hidden"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="tabName">Tab :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tabName" id="tabName"
                                   placeholder="tabName Here" required>
                            <p class="error tabName text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="fid">
                </form>
                {{-- Form Delete Post --}}
                <input type="hidden" name="_method1" value="DELETE">
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