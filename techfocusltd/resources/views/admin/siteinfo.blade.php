@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Site Info</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Add Info</a>
			</li>
@endsection

@section('adminContent')
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Info</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="{{url('/addInfo')}}" method="post">
						{{csrf_field()}}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="text">Title & Slogan</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="title">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="text">Facebook Link</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="facebook">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="text">Twitter Link</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="twitter">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="text">Instagram Link</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="instagram">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="text">Pinterest Link</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="pinterest">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="text">Google+ Link</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="googleplus">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="text">Linkedin Link</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="dribbble">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="text">Copyright</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="copyright">
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