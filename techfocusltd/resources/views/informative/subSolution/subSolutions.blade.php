@extends('informative.layouts.master')
@section('content')
    			<!-- SAB BANNER START-->
			<div class="sab_banner overlay">
				<div class="container">
					<div class="sab_banner_text">
						<h2>Our Sub-Solutions</h2>
						<ul class="breadcrumb">
						  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						  <li class="breadcrumb-item active">Sub-Solutions</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- SAB BANNER END-->
			
			<!-- CITY SERVICES2 WRAP START-->
			<div class="city_services2_wrap">
				<div class="container">
					<div class="row">
						@if (count($subSolutions)>0)
							@foreach ($subSolutions as $subSolution)
							<div class="col-md-4 col-sm-6">
								<div class="city_service2_fig">
									<figure class="overlay">
										<img src="{{asset('storage/images/subSolution/'.$subSolution->image)}}" alt="">
										<div class="city_service2_list">
											{{-- <span><i class="fa icon-law-2"></i></span> --}}
											<div class="city_service2_caption">
												<h4>{{$subSolution->subSolutionName}}</h4>
											</div>
										</div>
									</figure>
									<div class="city_business_list">
										<ul class="city_busine_detail">
											@foreach ($subSolution->products->take(2) as $product)
												<li><a href="{{url('product-info/'.$product->id.'/'.$product->slug)}}"><i class="fa fa-star-o"></i><span class="block-text">{{$product->productName}} </span></a></li>
											@endforeach
										</ul>
										<a class="see_more_btn" href="{{url('sub-solution/'.$subSolution->id.'/'.$subSolution->slug)}}">See More <i class="fa icon-next-1"></i></a>
									</div>

								</div>
							</div>                           
							@endforeach
						@endif
					</div>
				</div>	
			</div>
			<!-- CITY SERVICES2 WRAP END-->
@endsection