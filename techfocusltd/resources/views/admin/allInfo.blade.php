@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Site Info</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">All Info</a>
			</li>
@endsection

@section('adminContent')


			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Info</h2>
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
								  <th>Site Title</th>	
								  <th>Facebook Link</th>	
								  <th>Twitter Link</th>	
								  <th>Instagram Link</th>	
								  <th>Pinterest Link</th>	
								  <th>Google+ Link</th>	
								  <th>Dribbble Link</th>	
								  <th>Copyright</th>	
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($data as $data)
							<tr>
								<td>{{$data->title}}</td>
								<td>{{$data->facebook}}</td>
								<td>{{$data->twitter}}</td>
								<td>{{$data->instagram}}</td>
								<td>{{$data->pinterest}}</td>
								<td>{{$data->googleplus}}</td>
								<td>{{$data->dribbble}}</td>
								<td>{{$data->copyright}}</td>
								<td class="center">
									<a class="btn btn-info" href="{{URL::to('/editInfo/'.$data->id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/deleteInfo/'.$data->id)}}" onclick="return confirm('Are you sure want to delete this data?')">
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