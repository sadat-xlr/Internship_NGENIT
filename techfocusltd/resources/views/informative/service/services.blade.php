@extends('informative.layouts.master')
@section('content')
    			<!-- SAB BANNER START-->
			<div class="sab_banner overlay">
				<div class="container">
					<div class="sab_banner_text">
						<h2>Our Services</h2>
						<ul class="breadcrumb">
						  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						  <li class="breadcrumb-item active">Services</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- SAB BANNER END-->
		@php
			$solutions = \App\Solution::all()->take(5);
			$categories = \App\Category::all()->take(5);
			$brands = \App\Brand::all()->take(5);
			$industries = \App\Industry::all()->take(5);
		@endphp
			
			<!-- CITY SERVICES2 WRAP START-->
			<div class="city_services2_wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<div class="city_service2_fig">
								<div class="city_service2_text">
									<h4>By product</h4>
									<ul>
										@foreach ($categories as $category)
										<li><a class="" href="{{url('products-by-cat/'.$category->id)}}" >{{$category->categoryName}}</a></li>
										@endforeach
									</ul>
									<a class="see_more_btn" href="{{url('all-category-info')}}">See More <i class="fa icon-next-1"></i></a>
								</div>
							</div>
						</div>  
						<div class="col-md-4 col-sm-6">
							<div class="city_service2_fig">
								<div class="city_service2_text">
									<h4>By Brand</h4>
									<ul>
										{{-- <li class="dropdown-header dropdown-header-border"><b>By Brand</b></li> --}}
										@foreach ($brands as $brand)
											<li><a  href="{{url('brand-details/'.$brand->id)}}" class="special-link">{{$brand->brandName}}</a></li>                                                  
										@endforeach
									</ul>
									<a class="see_more_btn" href="{{url('all-brand')}}">See More <i class="fa icon-next-1"></i></a>
								</div>
							</div>
						</div> 
						<div class="col-md-4 col-sm-6">
							<div class="city_service2_fig">
								<div class="city_service2_text">
									<h4>By Solution</h4>
									<ul>
										@foreach ($solutions as $solution)
											<li><a  href="{{url('solution/'.$solution->id.'/'.$solution->slug)}}" class="special-link">{{$solution->solutionName}}</a></li>
											
										@endforeach
									</ul>
									<a class="see_more_btn" href="{{url('solutions')}}">See More <i class="fa icon-next-1"></i></a>
								</div>
							</div>
						</div>                         
					</div>
					<div class="row">
						@if (count($services)>0)
							@foreach ($services as $service)
							<div class="col-md-4 col-sm-6">
								<div class="city_service2_fig">
									<figure class="overlay">
										<img src="{{asset('storage/images/service/'.$service->image)}}" alt="">
										<div class="city_service2_list">
											<span><i class="fa icon-law-2"></i></span>
											<div class="city_service2_caption">
												<h4><span> {{$service->title}}</span></h4>
											</div>
										</div>
									</figure>
									<div class="city_service2_text">
										<p id="description-text" >{!!$service->description!!}</p>
										<a class="see_more_btn" href="{{url('service/'.$service->id.'/'.$service->slug)}}">See More <i class="fa icon-next-1"></i></a>
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