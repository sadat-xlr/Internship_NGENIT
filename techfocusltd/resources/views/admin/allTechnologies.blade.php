@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Technology</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">All Technologies</a>
			</li>
@endsection

@section('adminContent')
						
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Technologies</h2>
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
								  <th>Technology Name</th>	
								  <th>Technology Description</th>	
								  <th>Date registered</th>
								  <th>Date updated</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($technologies as $technology)
							<tr>
								<td>{{$technology->technologyName}}</td>
								<td>{!!html_entity_decode($technology->description)!!}</td>
								<td class="center">{{$technology->created_at}}</td>
								<td class="center">{{$technology->updated_at}}</td>
								<td class="center">
									<a class="btn btn-info" href="{{URL::to('/editTechnology/'.$technology->id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/deleteTechnology/'.$technology->id)}}" onclick="return confirm('Are you sure want to delete this data?')">
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