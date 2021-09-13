@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Category</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Add Category</a>
			</li>
@endsection

@section('adminContent')
						
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Category</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="{{url('/insertCategory')}}" method="post">
						{{csrf_field()}}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="text">Category</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="category">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Status</label>
								<div class="controls">
								  <select name="status" data-rel="chosen">
									<option value="0">Published</option>
									<option value="1">Unpublished</option>
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="text">Description</label>
								<div class="controls">
									<textarea class="cleditor" name="description" rows="3"></textarea>
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Category Icon</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="categoryImage" type="file">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="fileInput">Category Image</label>
								<div class="controls">
								  <input class="input-file uniform_on" name="categoryImage2" type="file">
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