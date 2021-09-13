@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">User</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">All Users</a>
			</li>
@endsection

@section('adminContent')


			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Users</h2>
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
								  <th>User Name</th>								  
								  <th>User E-mail</th>								  
								  <th>User Access Level</th>									  
								  <th>User Image</th>
								  <th>Date registered</th>
								  <th>Date updated</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($users as $user)
							<tr>
								<td>{{$user->adminName}}</td>								
								<td>{{$user->adminEmail}}</td>										
								@if($user->accessLabel == 0)
									<td>Super Admin</td>
								@elseif($user->accessLabel == 1)
									<td>Administrator</td>
								@elseif($user->accessLabel == 2)
									<td>Editor</td>
								@elseif($user->accessLabel == 3)
									<td>Author</td>
								@else
									<td>Contributor</td>
								@endif	
								<td class="center"><img src="storage/images/admin/{{$user->adminImage}}"/></td>
								<td class="center">{{$user->created_at}}</td>
								<td class="center">{{$user->updated_at}}</td>
								<td class="center">
									<a class="btn btn-info" href="{{URL::to('/editUser/'.$user->id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/deleteUser/'.$user->id)}}" onclick="return confirm('Are you sure want to delete this data?')">
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