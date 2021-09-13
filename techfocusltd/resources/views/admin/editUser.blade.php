@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">User</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Edit User</a>
			</li>
@endsection

@section('adminContent')
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add User</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="{{url('/updateUser/'.$id)}}" method="post">
						{{csrf_field()}}
						  <fieldset>
						  @foreach($users as $user)
							<div class="control-group">
							  <label class="control-label" for="text">Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="adminName" value="{{$user->adminName}}">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="text">E-mail</label>
							  <div class="controls">
								<input type="email" class="input-xlarge" name="adminEmail" value="{{$user->adminEmail}}">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Admin access level</label>
								<div class="controls">
								  <select name="accessLabel" data-rel="chosen">
									<option value="0" @if($user->accessLabel == 0) selected="selected" @endif>Super Admin</option>
									<option value="1" @if($user->accessLabel == 1) selected="selected" @endif>Administrator</option>
									<option value="2" @if($user->accessLabel == 2) selected="selected" @endif>Editor</option>
									<option value="3" @if($user->accessLabel == 3) selected="selected" @endif>Author</option>
									<option value="4" @if($user->accessLabel == 4) selected="selected" @endif>Contributor</option>
								  </select>
								</div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Admin Image</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="adminImage" type="file">
							  </div>
							</div> 	
							<div class="control-group">
							  <label class="control-label" for="text">Password</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="password" value="{{$user->password}}">
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Save changes</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  @endforeach
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
@endsection