@extends('layouts.admin')
@section('title')
    <title>Colors</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Colors
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Products</li>
        <li class="active">Colors</li>
    </ol>
@endsection

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Color</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Color name</th>
                    <th>
                        action
                        <a href="#" class="addColor btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
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
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-color btn btn-danger btn-sm" data-id="{{$color->id}}">
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