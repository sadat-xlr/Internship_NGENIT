@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Contact Info</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Add Contact Info</a>
			</li>
@endsection

@section('adminContent')
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Contact Info</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="{{url('/insertContact')}}" method="post">
						{{csrf_field()}}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="text">Company Address</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="address">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="text">Phone Number One</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="phone1">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="text">Phone Number Two</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="phone2">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="text">E-mail</label>
							  <div class="controls">
								<input type="email" class="input-xlarge" name="email">
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