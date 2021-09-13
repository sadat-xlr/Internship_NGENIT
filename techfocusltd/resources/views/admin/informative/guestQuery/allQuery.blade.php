@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Guest Query</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">All query</a>
			</li>
@endsection

@section('adminContent')


			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All query</h2>
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
								  <th>Status</th>
								  <th>Date created</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($contactMessages as $contactMessage)
							<tr>
								<td>{{$contactMessage->name}}</td>
								<td>{{$contactMessage->email}}</td>
								<td>{{$contactMessage->phone}}</td>
								<td>{{$contactMessage->subject}}</td>
								<td>{{$contactMessage->message}}</td>
								<td>
									@if ($contactMessage->status == 0)
										<span style="color:red">Unread</span>
									@else
										<span style="color:green">Read</span>
									@endif
								</td>
								<td class="center">{{$contactMessage->created_at}}</td>
								<td class="center">
									<a id="guestQuery" data-id="{{$contactMessage->id}}" class="btn btn-info" href="{{url('send-query-reply/'.$contactMessage->id)}}"><i class="halflings-icon white envelope"></i></a>
									<a class="btn btn-danger" href="{{URL::to('delete-guest-message/'.$contactMessage->id)}}" onclick="return confirm('Are you sure want to delete this data?')">
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