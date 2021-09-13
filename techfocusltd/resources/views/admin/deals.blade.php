@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Deal</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">All Deal</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Deal</h2>
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
                        <th>Deal value</th>
                        <th>Valid until</th>
                        <th>Product</th>
                        <th>
                            action
                            <a href="#" class="addDeal btn btn-success btn-sm">
                                <i class="halflings-icon white plus"></i>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deals as $deal)
                        <tr id="deal{{$deal->id}}">
                            <td>{{$deal->discount_value}}</td>
                            <td>{{$deal->valid_until}}</td>
                            <td>
                                @foreach($deal->products as $product)
                                    {{$product->productName}},
                                @endforeach
                            </td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{url('deals/'.$deal->id.'/edit')}}" class="edit-deal btn btn-warning btn-sm">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a href="#" class="delete-deal btn btn-danger btn-sm" data-id="{{$deal->id}}">
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
                    <div class="row-fluid sortable">
                        <div class="box span12">
                            <div class="box-header" data-original-title>
                                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add deal</h2>
                                <div class="box-icon">
                                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <form class="form-horizontal" id="addDeal-form" action="{{url('deals')}}">
                                    <fieldset>
                                        <div class="control-group">
                                            <label class="control-label" for="discount_value">Deal value</label>
                                            <div class="controls">
                                                <input type="number" class="form-control" name="discount_value"
                                                       placeholder="deal value Here" required>
                                                <p class="error discount_value text-center alert alert-danger hidden"></p>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="date01">Valid until</label>
                                            <div class="controls">
                                                <input type="datetime-local" name="valid_until">
                                                <p class="error valid_until text-center alert alert-danger hidden"></p>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="selectError1">Products</label>
                                            <div class="controls">
                                                <select id="selectError1" name="product_id[]" multiple data-rel="chosen">
                                                    @foreach($products as $product)
                                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                                    @endforeach
                                                </select>
                                                <p class="error product_id text-center alert alert-danger hidden"></p>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div><!--/span-->
                    </div><!--/row-->
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    <button class="btn btn-warning" type="submit" id="addDeal">
                        <span class="glyphicon glyphicon-plus"></span>Save deal
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