@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Product</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Update Product</a>
			</li>
@endsection

@section('adminContent')
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Product</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="{{url('updateProduct/'.$product->id)}}" method="post">
						{{csrf_field()}}
						  <fieldset>
						    <h3><i class="halflings-icon edit"></i><span class="break"></span>General</h3><hr/>
							<div class="control-group">
							<div class="control-group">
							  <label class="control-label" for="text">Product Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="productName" value="{{$product->productName}}">
							  </div>
							</div>

							<div class="control-group">
								<div class="control-group">
								  <label class="control-label" for="text">Slug</label>
								  <div class="controls">
									<input type="text" class="input-xlarge" name="slug" value="{{$product->productName}}">
								  </div>
								</div>


							<div class="control-group">
							  <label class="control-label" for="text">SKU</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="sku" value="{{$product->sku}}">
							  </div>
							</div>


							<div class="control-group">
								<label class="control-label" for="selectError">Solution</label>
								<div class="controls">
								  <select name="solution_id" data-rel="chosen" id="solutionId">
								  @foreach($solutions as $solution)
									<option value="{{$solution->id}}" @if($product->solution_id == $solution->id) selected = "selected" @endif>{{$solution->solutionName}}</option>
								  @endforeach
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Sub-Solution</label>
								<div class="controls">
								  <select name="subSolution_id"  id="subSolutionId" >
										<option value="{{$product->subsolution_id}}"> @if(!empty($product->subsolution->subSolutionName)) {{$product->subsolution->subSolutionName}} @endif</option>
								  </select>
								</div>
							</div>



							<div class="control-group">
								<label class="control-label" for="selectError">Category</label>
								<div class="controls">
								  <select name="category_id" data-rel="chosen" id="catId">
									@foreach($categories as $category)
										<option value="{{$category->id}}" @if($product->category_id == $category->id) selected="selected" @endif>{{$category->categoryName}}</option>
									@endforeach
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">SubCategory</label>
								<div class="controls">
								  <select name="subcategory_id" id="subCatId">
										<option value="{{$product->subcategory_id}}">{{$product->subcategory->categoryName}}</option>
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">MiniCategory</label>
								<div class="controls">
								  <select name="minicategory_id" id="miniCatId">
										<option value="{{$product->minicategory_id}}">{{$product->minicategory->miniCategoryName}}</option>
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Brand</label>
								<div class="controls">
								  <select name="brand_id" data-rel="chosen">
									@foreach($brands as $brand)
										<option value="{{$brand->id}}" @if($product->brand_id == $brand->id) selected="selected" @endif>{{$brand->brandName}}</option>
									@endforeach
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Industry</label>
								<div class="controls">
								  <select name="industry_id" data-rel="chosen">
								  @foreach($industries as $industry)
									<option value="{{$industry->id}}" @if($product->industry_id == $industry->id) selected="selected" @endif>{{$industry->industryName}}</option>
								  @endforeach
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Technology</label>
								<div class="controls">
								  <select name="technology_id" data-rel="chosen">
								  @foreach($technologies as $technology)
									<option value="{{$technology->id}}" @if($product->technology_id == $technology->id) selected="selected" @endif>{{$technology->technologyName}}</option>
								  @endforeach
								  </select>
								</div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Product Regular Price</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="regularPrice" type="number" value="{{$product->regularPrice}}">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Product Sale Price</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="price" type="number" value="{{$product->price}}">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label">Product Color</label>
								<div class="controls">
									@foreach($colors as $color)
										<label class="checkbox inline">
											<div class="checker"><span><input type="checkbox" name="color[]" @foreach($product->colors as $clr) @if($clr->id == $color->id) checked @endif @endforeach value="{{$color->id}}"></span></div> {{$color->color}}
										</label>
									@endforeach
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Product Size</label>
								<div class="controls">
									@foreach($sizes as $size)
										<label class="checkbox inline">
											<div class="checker"><span><input type="checkbox" name="size[]" @foreach($product->sizes as $sz) @if($sz->id == $size->id) checked @endif @endforeach value="{{$size->id}}"></span></div> {{$size->size}}
										</label>
									@endforeach
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Product Tag</label>
								<div class="controls">
									@foreach($tags as $tag)
										<label class="checkbox inline">
											<div class="checker"><span><input type="checkbox" name="tag[]" @foreach($product->tags as $tg) @if($tg->id == $tag->id) checked @endif @endforeach value="{{$tag->id}}"></span></div> {{$tag->tag}}
										</label>
									@endforeach
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Product Type</label>
								<div class="controls">
								  <select name="type" data-rel="chosen">
									<option value="0" @if($product->type == 0) selected="selected" @endif>Featured</option>
									<option value="1" @if($product->type == 1) selected="selected" @endif>Non-Featured</option>
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Product Availablity</label>
								<div class="controls">
								  <select name="availablity" data-rel="chosen">
									<option value="0" @if($product->availablity == 0) selected="selected" @endif>Available</option>
									<option value="1" @if($product->availablity == 1) selected="selected" @endif>Not-Available</option>
								  </select>
								</div>
							</div>
							<div class="control-group hidden-phone">
								<label class="control-label" for="textarea2">Product Short Description</label>
								<div class="controls">
									<textarea class="cleditor" name="shortDescription" rows="3">{{$product->shortDescription}}</textarea>
								</div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="description" rows="3">{{$product->description}}</textarea>
							  </div>
							</div>
							<hr/><h3><i class="halflings-icon edit"></i><span class="break"></span>Image</h3><hr/>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Image 1</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="image1" type="file">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Image 2</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="image2" type="file">
							  </div>
							</div> 
							<div class="control-group">
							  <label class="control-label" for="fileInput">Image 3</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="image3" type="file">
							  </div>
							</div> 
							<div class="control-group">
							  <label class="control-label" for="fileInput">Image 4</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="image4" type="file">
							  </div>
							</div> 
							<div class="control-group">
							  <label class="control-label" for="fileInput">Image 5</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="image5" type="file">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Description Image 1</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="image6" type="file">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Description Image 2</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="image7" type="file">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Description Image 3</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="image8" type="file">
							  </div>
							</div>
							<hr/><h3><i class="halflings-icon edit"></i><span class="break"></span>Technical Specification. (If have any)</h3><hr/>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Technical Specification</label>
							  <div class="controls">
								<textarea class="cleditor" name="specification" rows="3">{{$product->specification}}</textarea>
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