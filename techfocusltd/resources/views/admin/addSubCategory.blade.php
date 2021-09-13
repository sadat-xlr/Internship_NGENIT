@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">SubCategory</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Add SubCategory</a>
			</li>
@endsection

@section('adminContent')
						
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add SubCategory</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/insertSubCategory')}}" method="post">
						{{csrf_field()}}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="text">SubCategory Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="categoryName">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Category</label>
								<div class="controls">
								  <select name="category_id" data-rel="chosen">
								  @foreach($categories as $category)
									<option value="{{$category->id}}">{{$category->categoryName}}</option>
								  @endforeach
								  </select>
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