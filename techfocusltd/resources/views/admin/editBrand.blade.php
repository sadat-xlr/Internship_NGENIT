@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="{{url('all-brands')}}">Brands</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Edit Brands</a>
			</li>
@endsection

@section('adminContent')
						
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Brands</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="{{url('updateBrand/'.$id)}}" method="post">
						{{csrf_field()}}
						  <fieldset>
						  @foreach($brands as $brand)
							<div class="control-group">
							  <label class="control-label" for="text">Brand Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="brandName" value="{{$brand->brandName}}">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="fileInput">Brand Logo</label>
								<div class="controls">
								<input class="input-file uniform_on" name="brandLogo" type="file">
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