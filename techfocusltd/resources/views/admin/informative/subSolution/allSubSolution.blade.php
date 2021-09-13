@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">subSolutions</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">All subSolutions</a>
			</li>
@endsection

@section('adminContent')


			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All subSolutions</h2>
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
								  <th>subSolution Name</th>								  
                                  <th>subSolution Image</th>
                                  <th>Solution Name</th>
								  <th>Date registered</th>
								  <th>Date updated</th>
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($subSolutions as $subSolution)
							<tr>
                                <td>{{$subSolution->subSolutionName}}</td>								
                                <td class="center"><img src="{{asset('storage/images/subSolution/'.$subSolution->image)}}"/></td>
                                <td>{{$subSolution->solution->solutionName}}</td>
								<td class="center">{{$subSolution->created_at}}</td>
								<td class="center">{{$subSolution->updated_at}}</td>
								<td class="center">
									<a class="btn btn-info" href="{{URL::to('edit-subSolution/'.$subSolution->id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									{{-- <a class="btn btn-danger" href="{{URL::to('deleteCat/'.$subSolution->id)}}" onclick="return confirm('Are you sure want to delete this data?')">
										<i class="halflings-icon white trash"></i> 
									</a> --}}
									<form action="{{ url('/delete-Subsolution', ['id' => $subSolution->id]) }}" method="post">
										<input class="btn btn-default" type="submit" value="Delete" onclick="return confirm('Are you sure want to delete this data?')"/>
										<input type="hidden" name="_method" value="delete" />
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
									</form>
								</td>
							</tr>
						  @endforeach
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

@endsection