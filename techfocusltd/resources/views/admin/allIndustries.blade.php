@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Industry</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">All Industries</a>
			</li>
@endsection

@section('adminContent')
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Industry</h2>
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
								  <th>Industry Name</th>	
								  <th>Date registered</th>
								  <th>Date updated</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($industries as $industry)
							<tr>
								<td>{{$industry->industryName}}</td>
								<td class="center">{{$industry->created_at}}</td>
								<td class="center">{{$industry->updated_at}}</td>
								<td class="center">
									<a class="btn btn-info" href="{{URL::to('/editIndustry/'.$industry->id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/deleteIndustry/'.$industry->id)}}" onclick="return confirm('Are you sure want to delete this data?')">
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