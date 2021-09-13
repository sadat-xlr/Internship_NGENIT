@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Category</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">All Category</a>
			</li>
@endsection

@section('adminContent')


			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Categories</h2>
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
								  <th>Category Name</th>								  
								  <th>Category Image</th>
								  <th>Status</th>
								  <th>Date registered</th>
								  <th>Date updated</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($categories as $category)
							<tr>
								<td>{{$category->categoryName}}</td>								
								<td class="center"><img src="{{asset('storage/images/icons/menu/'.$category->categoryImage)}}"/></td>
								@if($category->status == 0)
									<td class="center">
										<span class="label label-success">Active</span>
									</td>
								@else
									<td class="center">
										<span class="label label-error">Inactive</span>
									</td>
								@endif
								<td class="center">{{$category->created_at}}</td>
								<td class="center">{{$category->updated_at}}</td>
								<td class="center">
									<a class="btn btn-info" href="{{URL::to('/editCat/'.$category->id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/deleteCat/'.$category->id)}}" onclick="return confirm('Are you sure want to delete this data?')">
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