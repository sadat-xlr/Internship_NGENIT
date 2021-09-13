@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Colors</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">All Colors</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Colors</h2>
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
                        <th>Color name</th>
                        <th>
                            action
                            <a href="#" class="addColor btn btn-success btn-sm">
                                <i class="halflings-icon white plus"></i>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($colors as $color)
                        <tr id="color{{$color->id}}">
                            <td>{{$color->color}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="#" class="edit-color btn btn-warning btn-sm" data-id="{{$color->id}}" data-color="{{$color->color}}">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a href="#" class="delete-color btn btn-danger btn-sm" data-id="{{$color->id}}">
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
		            <label class="control-label col-sm-2" for="colorName">color Name :</label>
		            <div class="col-sm-10">
		              <input type="text" class="form-control" id="colorName" name="colorName"
		              placeholder="colorName Here" required>
		              <p class="error color text-center alert alert-danger hidden"></p>
		            </div>
		          </div>
		        </form>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<button class="btn btn-warning" type="submit" id="addColor">
	              <span class="glyphicon glyphicon-plus"></span>Save color
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
            <label class="control-label col-sm-2" for="colorName">color Name :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="ecolorName" name="colorName"
              placeholder="colorName Here" required>
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