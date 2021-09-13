@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Product</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Add Product</a>
			</li>
@endsection

@section('adminContent')
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="{{url('/insertProduct')}}" method="post">
						{{csrf_field()}}
						  <fieldset>
						    <h3><i class="halflings-icon edit"></i><span class="break"></span>General</h3><hr/>
							<div class="control-group">
							  <label class="control-label" for="text">Product Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="productName">
							  </div>
							</div>

							<div class="control-group">
								<label class="control-label" for="text">Product Slug</label>
								<div class="controls">
								  <input type="text" class="input-xlarge" name="slug">
								</div>
							  </div>

							<div class="control-group">
							  <label class="control-label" for="text">Product SKU</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="sku">
							  </div>
							</div>


							<div class="control-group">
								<label class="control-label" for="selectError">Solution</label>
								<div class="controls">
								  <select name="solution_id" data-rel="chosen" id="solutionId" >
									<option value="">Choose a Solution</option>
								  @foreach($solutions as $solution)
									<option value="{{$solution->id}}">{{$solution->solutionName}}</option>
								  @endforeach
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Sub-Solution</label>
								<div class="controls">
								  <select name="subSolution_id"  id="subSolutionId" >
										<option value='$key'>Choose Sub-Solution</option>
								  </select>
								</div>
							</div>



							<div class="control-group">
								<label class="control-label" for="selectError">Category</label>
								<div class="controls">
								  <select name="category_id" data-rel="chosen" id="catId">
									<option value="">Choose a Category</option>
								  @foreach($categories as $category)
									<option value="{{$category->id}}">{{$category->categoryName}}</option>
								  @endforeach
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">SubCategory</label>
								<div class="controls">
								  <select name="subcategory_id" id="subCatId">
										<option value='$key'>Choose Sub-Category</option>
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">MiniCategory</label>
								<div class="controls">
								  <select name="minicategory_id" id="miniCatId">
										<option value='$key'>Choose Mini-Category</option>
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Brand</label>
								<div class="controls">
								  <select name="brand_id" data-rel="chosen">
								  @foreach($brands as $brand)
									<option value="{{$brand->id}}">{{$brand->brandName}}</option>
								  @endforeach
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Industry</label>
								<div class="controls">
								  <select name="industry_id" data-rel="chosen">
								  @foreach($industries as $industry)
									<option value="{{$industry->id}}">{{$industry->industryName}}</option>
								  @endforeach
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Technology</label>
								<div class="controls">
								  <select name="technology_id" data-rel="chosen">
								  @foreach($technologies as $technology)
									<option value="{{$technology->id}}">{{$technology->technologyName}}</option>
								  @endforeach
								  </select>
								</div>
							</div> 
							<div class="control-group">
							  <label class="control-label" for="fileInput">Product Regular Price</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="regularPrice" type="number">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Product Sale Price</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="price" type="number">
							  </div>
							</div>
							  <div class="control-group">
								  <label class="control-label">Product Color</label>
								  <div class="controls">
								  @foreach($colors as $color)
									  <label class="checkbox inline">
										  <div class="checker"><span><input type="checkbox" name="color[]" value="{{$color->id}}"></span></div> {{$color->color}}
									  </label>
								  @endforeach
								  </div>
							  </div>
							  <div class="control-group">
								  <label class="control-label">Product Size</label>
								  <div class="controls">
								  @foreach($sizes as $size)
									  <label class="checkbox inline">
										  <div class="checker"><span><input type="checkbox" name="size[]" value="{{$size->id}}"></span></div> {{$size->size}}
									  </label>
								  @endforeach
								  </div>
							  </div>
							  <div class="control-group">
								  <label class="control-label">Product Tag</label>
								  <div class="controls">
								  @foreach($tags as $tag)
									  <label class="checkbox inline">
										  <div class="checker"><span><input type="checkbox" name="tag[]" value="{{$tag->id}}"></span></div> {{$tag->tag}}
									  </label>
								  @endforeach
								  </div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="selectError">Product Type</label>
								<div class="controls">
								  <select name="type" data-rel="chosen">
									<option value="0">Featured</option>
									<option value="1">Non-Featured</option>
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Product Availablity</label>
								<div class="controls">
								  <select name="availablity" data-rel="chosen">
									<option value="0">Global Stock</option>
									<option value="1">In Stock</option>
									<option value="2">Out of Stock</option>
								  </select>
								</div>
							</div>
							  <div class="control-group hidden-phone">
								  <label class="control-label" for="textarea2">Product Short Description</label>
								  <div class="controls">
									  <textarea class="cleditor" name="shortDescription" rows="3"></textarea>
								  </div>
							  </div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="description" rows="3"></textarea>
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
								<textarea class="cleditor" name="specification" rows="3"></textarea>
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