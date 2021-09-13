@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Jobs</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">All Jobs</a>
			</li>
@endsection

@section('adminContent')


			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Jobs</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Title</th>								  
								  <th>Deadline</th>								  
								  <th>Status</th>									  
								  <th>
										Actions
										<a href="{{url('add-job')}}" class="btn btn-success btn-sm">
											<i class="halflings-icon white plus"></i>
										</a>
									</th>
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($jobs as $job)
							<tr>
								<td>{{$job->title}}</td>								
								<td> {{ \Carbon\Carbon::parse($job->Deadline)->format('d/m/Y')}}</td>										
								<td class="center">active</td>
								<td class="center">
									<a class="btn btn-info" href="{{URL::to('edit-job/'.$job->id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('delete-job/'.$job->id)}}" onclick="return confirm('Are you sure want to delete this data?')">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						  @endforeach
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
@endsection