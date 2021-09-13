@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Message</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">All Messages</a>
			</li>
@endsection

@section('adminContent')


			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Messages</h2>
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
								  <th>Name</th>	
								  <th>E-mail</th>
								  <th>Phone</th>
								  <th>Subject</th>
								  <th>Message</th>
								  <th>Date created</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($messages as $message)
							<tr>
								<td>{{$message->name}}</td>
								<td>{{$message->email}}</td>
								<td>{{$message->phone}}</td>
								<td>{{$message->subject}}</td>
								<td>{{$message->message}}</td>
								<td class="center">{{$message->created_at}}</td>
								<td class="center">
									<a class="btn btn-danger" href="{{URL::to('/deleteMessage/'.$message->id)}}" onclick="return confirm('Are you sure want to delete this data?')">
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