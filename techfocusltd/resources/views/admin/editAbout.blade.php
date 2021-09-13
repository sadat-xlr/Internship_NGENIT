@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">About</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Edit About</a>
			</li>
@endsection

@section('adminContent')
						
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit About</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/updateAbout/'.$id)}}" method="post">
						{{csrf_field()}}
						  <fieldset>
						  @foreach($abouts as $about)
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">About Info</label>
							  <div class="controls">
								<textarea class="cleditor" name="description" rows="3">{{$about->description}}</textarea>
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