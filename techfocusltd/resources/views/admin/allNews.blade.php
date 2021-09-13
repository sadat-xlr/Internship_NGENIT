@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">News</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">All News</a>
			</li>
@endsection

@section('adminContent')


			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All News</h2>
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
								  <th>News Title</th>	
								  <th>Category</th>
								  <th>News Image</th>
								  <th>Date registered</th>
								  <th>Date updated</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($news as $singleNews)
							<tr>
								<td>{{$singleNews->newsTitle}}</td>							
								<td>{{$singleNews->category->categoryName}}</td>
								<td class="center"><img src="storage/images/news/{{$singleNews->newsImage}}" style="height: 70px; width:120px;"/></td>
								<td class="center">{{$singleNews->created_at}}</td>
								<td class="center">{{$singleNews->updated_at}}</td>
								<td class="center">
									<a class="btn btn-info" href="{{URL::to('editNews/'.$singleNews->id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('deleteNews/'.$singleNews->id)}}" onclick="return confirm('Are you sure want to delete this data?')">
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