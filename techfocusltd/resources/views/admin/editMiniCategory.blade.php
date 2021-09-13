@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">MiniCategory</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Edit MiniCategory</a>
			</li>
@endsection

@section('adminContent')
						
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit MiniCategory</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/updateMiniCategory/'.$id)}}" method="post">
						{{csrf_field()}}
						  <fieldset>
						  @foreach($miniCategories as $miniCategory)
							<div class="control-group">
							  <label class="control-label" for="text">MiniCategory Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="miniCategoryName" value="{{$miniCategory->miniCategoryName}}">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Category</label>
								<div class="controls">
								  <select name="category_id" data-rel="chosen" id="catId">
									<option value="">Choose a Category</option>
								  @foreach($categories as $category)
									<option value="{{$category->id}}" @if ($miniCategory->subcategory->category_id == $category->id) selected="selected" @endif>{{$category->categoryName}}</option>
								  @endforeach
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">SubCategory</label>
								<div class="controls">
								  <select name="subcategory_id" id="subCatId">
										<option value='{{$miniCategory->subcategory_id}}'>{{$miniCategory->subcategory->categoryName}}</option>
								  </select>
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