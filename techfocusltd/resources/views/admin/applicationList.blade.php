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
								  <th>Sl.</th>								  
								  <th>Name</th>								  
                                  <th>Phone Number</th>	
                                  <th>email</th>
                                  <th>experience</th>
                                  <th>cv</th>
                                  <th>job</th>								  
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($applications as $key => $application)
							<tr>
								<td>{{$key+1}}</td>								
								<td>{{$application->name}} </td>										
								<td class="center">{{$application->number}}</td>
                                <td class="center">{{$application->email}}</td>
                                <td class="center">{{$application->experience}}</td>
                                <td class="center">{{$application->experience}}</td>
                                <td>{{$application->job_id}}</td>
							</tr>
						  @endforeach
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
@endsection