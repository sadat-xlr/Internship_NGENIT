@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Service</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Add Service</a>
			</li>
@endsection

@section('adminContent')
						
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add service</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="{{url('/store-service')}}" method="post">
						{{csrf_field()}}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="text">Service Title</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="serviceTitle">
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Service Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="description" rows="3"></textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Service Image</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="serviceImage" type="file">
							  </div>
							</div>							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Save</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
			
@endsection