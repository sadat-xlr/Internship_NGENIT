@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Contact Info</a>
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
								  <th>Company Address</th>	
								  <th>Phone Number One</th>	
								  <th>Phone Number Two</th>		
								  <th>E-mail</th>	
								  <th>Date registered</th>
								  <th>Date updated</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($contacts as $contact)
							<tr>
								<td>{{$contact->address}}</td>
								<td>{{$contact->phone1}}</td>
								<td>{{$contact->phone2}}</td>
								<td>{{$contact->email}}</td>
								<td class="center">{{$contact->created_at}}</td>
								<td class="center">{{$contact->updated_at}}</td>
								<td class="center">
									<a class="btn btn-info" href="{{URL::to('/editContact/'.$contact->id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/deleteContact/'.$contact->id)}}" onclick="return confirm('Are you sure want to delete this data?')">
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