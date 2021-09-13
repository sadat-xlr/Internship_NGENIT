@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Product</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">All Products</a>
			</li>
@endsection

@section('adminContent')


			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon Product"></i><span class="break"></span>All Products</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<style>
						.table{
							height: 100%;
    						width: 1000px;
						}
						</style>
						<table class="table table-striped table-bordered bootstrap-datatable datatable"  >
						  <thead>
							  <tr>
								  <th width="220px" style="text-align:center">Product Name</th>								  
								  <th width="220px" style="text-align:center">Product SKU</th>
								  <th width="220px"  style="text-align:center">Solution</th>								  
								  <th width="220px"  style="text-align:center">Sub-Solution</th>								  
								  <th width="220px"  style="text-align:center">Product Category</th>								  
								  <th width="220px"  style="text-align:center">Product SubCategory</th>								  
								  <th width="220px"  style="text-align:center">Product MiniCategory</th>								  
								  <th width="220px"  style="text-align:center">Product Industry</th>								  
								  <th width="220px"  style="text-align:center">Product Technology</th>								  
								  <th width="220px"  style="text-align:center">Brand</th>
								  <th width="220px"  style="text-align:center">Product Image</th>
								  <th width="220px"  style="text-align:center">Product Price</th>
								  <th width="100px"  style="text-align:center">Availablity</th>
								  <th width="220px"  style="text-align:center">Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  @foreach($products as $product)
							<tr>
								<td>{{$product->productName}}</td>								
								<td>{{$product->sku}}</td>
								<td>@if(!empty($product->solution->solutionName)){{$product->solution->solutionName}}@endif</td>	
								<td>@if(!empty($product->subsolution->subSolutionName)){{$product->subSolution->subSolutionName}}@endif</td>											
								<td>{{$product->category->categoryName}}</td>	
								<td>{{$product->subcategory->categoryName}}</td>	
								<td>{{$product->minicategory->miniCategoryName}}</td>	
								<td>{{$product->industry->industryName}}</td>	
								<td>{{$product->technology->technologyName}}</td>	
								<td>{{$product->brand->brandName}}</td>									
								<td class="center"><img src="{{asset('storage/images/product/'.$product->image->image1)}}"/></td>
								<td>৳ {{$product->price}}</td>
								@if($product->availablity == 0)
									<td><span class="label label-success">Available</span></td>
								@else
									<td><span class="label label-error">Not-Available</span></td>
								@endif	
								<td class="center">
									<a class="btn btn-info" href="{{URL::to('/editProduct/'.$product->id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/deleteProduct/'.$product->id)}}" onclick="return confirm('Are you sure want to delete this data?')">
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

 