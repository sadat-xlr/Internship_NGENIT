@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Sizes</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">All Sizes</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Sizes</h2>
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
                        <th>Size</th>
                        <th>
                            action
                            <a href="#" class="addSize btn btn-success btn-sm">
                                <i class="halflings-icon white plus"></i>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sizes as $size)
                        <tr id="size{{$size->id}}">
                            <td>{{$size->size}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="#" class="edit-size btn btn-warning btn-sm" data-id="{{$size->id}}" data-size="{{$size->size}}">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a href="#" class="delete-size btn btn-danger btn-sm" data-id="{{$size->id}}">
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
				<form class="form-horizontal" role="form">
		          <div class="form-group">
		            <label class="control-label col-sm-2" for="sizeName">size Name :</label>
		            <div class="col-sm-10">
		              <input type="text" class="form-control" id="sizeName" name="sizeName"
		              placeholder="sizeName Here" required>
		              <p class="error size text-center alert alert-danger hidden"></p>
		            </div>
		          </div>
		        </form>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<button class="btn btn-warning" type="submit" id="addSize">
	              <span class="glyphicon glyphicon-plus"></span>Save size
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
        <form class="form-horizontal" role="modal">

          <div class="form-group">
            <label class="control-label col-sm-2" for="id">ID</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="fid" disabled>
            </div>
          </div>
		  <div class="form-group">
            <label class="control-label col-sm-2" for="sizeName">size Name :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="esizeName" name="sizeName"
              placeholder="sizeName Here" required>
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