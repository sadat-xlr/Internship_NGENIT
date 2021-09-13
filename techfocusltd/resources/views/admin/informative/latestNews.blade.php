@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Informative</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Add latest News</a>
			</li>
@endsection
@section('adminContent')
						
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Latest News</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/add-latest-news')}}" method="post">
						{{csrf_field()}}
						  <fieldset>
                            <div class="control-group hidden-phone">
							  <label class="control-label" for="news-one-title">News one Title</label>
							  <div class="controls">
								<input type="text" name="news-one-title" >
							  </div>
                            </div>
                            <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">News one </label>
							  <div class="controls">
								<textarea class="cleditor" name="news-one" rows="3"></textarea>
							  </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="banner_one">Background image for News one </label>
                                <div class="controls">
                                    <input type="file" class="form-control" name="background-image-news-one" required>
                                </div>
                            </div>
                            <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">News two </label>
							  <div class="controls">
								<textarea class="cleditor" name="news-two" rows="3"></textarea>
							  </div>
                            </div>
                            <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">News three </label>
							  <div class="controls">
								<textarea class="cleditor" name="news-three" rows="3"></textarea>
							  </div>
                            </div>
                            <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">News four </label>
							  <div class="controls">
								<textarea class="cleditor" name="news-four" rows="3"></textarea>
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