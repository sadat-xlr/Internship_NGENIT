@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Featured Content</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Add Featured content</a>
			</li>
@endsection

@section('adminContent')
						
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Featured content</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="{{url('/feature-content-store')}}" method="post">
						{{csrf_field()}}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="text">Content Title</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="title">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Category</label>
								<div class="controls">
								  <select name="category_id" data-rel="chosen" required>
								  @foreach($categories as $category)
									<option value="{{$category->id}}">{{$category->categoryName}}</option>
								  @endforeach
								  </select>
								</div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Short  Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="description" rows="3"></textarea>
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label">Tag</label>
								<div class="controls">
								@foreach($tags as $tag)
									<label class="checkbox inline">
										<div class="checker"><span><input type="checkbox" name="tag[]" value="{{$tag->id}}"></span></div> {{$tag->tag}}
									</label>
								@endforeach
								</div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Content Image</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="image" type="file">
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