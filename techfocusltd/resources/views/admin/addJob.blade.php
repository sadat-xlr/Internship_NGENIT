@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Job</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Add Job</a>
			</li>
@endsection

@section('adminContent')
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Job</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="{{url('/insert-job')}}" method="post">
						{{csrf_field()}}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="text">Title</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="title">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="text">Deadline</label>
							  <div class="controls">
								<input type="date" class="input-xlarge" name="deadline">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError">Description</label>
								<div class="controls">
                                    <textarea class="controls" name="description" id="description" cols="30" rows="20" required></textarea>
                                </div>
                                <script>
                                    CKEDITOR.replace( 'description' );
                                </script>
                                {{-- <script>
                                    $(document).ready(function() {
                                        $('#description').summernote({
                                            placeholder: 'Description',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script> --}}
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