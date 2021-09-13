@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="{{url('all-news')}}">News</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Edit News</a>
			</li>
@endsection

@section('adminContent')
						
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit News</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="{{url('/updateNews/'.$id)}}" method="post">
						{{csrf_field()}}
						  <fieldset>
						  @foreach($news as $singleNews)
							<div class="control-group">
							  <label class="control-label" for="text">News Title</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="newsTitle" value="{{$singleNews->newsTitle}}">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Category</label>
								<div class="controls">
								  <select name="category_id" data-rel="chosen">
								  @foreach($categories as $category)
									<option value="{{$category->id}}" @if($singleNews->category_id == $category->id) selected="selected" @endif>{{$category->categoryName}}</option>
								  @endforeach
								  </select>
								</div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">News Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="description" rows="3">{{$singleNews->description}}</textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">News Image</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="newsImage" type="file">
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