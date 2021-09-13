@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Informative</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Add welcome note</a>
			</li>
@endsection
@section('adminContent')
						
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Welcome Note</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/welcomeNote')}}" method="post">
						{{csrf_field()}}
						  <fieldset>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Welcome Note</label>
							  <div class="controls">
								<textarea class="cleditor" name="welcomeNote" rows="3"></textarea>
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