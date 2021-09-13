@extends('informative.layouts.master')
@section('content')
    			<!-- SAB BANNER START-->
			<div class="sab_banner overlay">
				<div class="container">
					<div class="sab_banner_text">
						<h2>Our Solutions</h2>
						<ul class="breadcrumb">
						  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						  <li class="breadcrumb-item active">Solutions</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- SAB BANNER END-->
			
			<!-- All Solution  WRAP START-->
			<div class="city_services2_wrap">
				<div class="container">
					<div class="row">
						@if (count($solutions)>0)
							@foreach ($solutions as $solution)
							<div class="col-md-4 col-sm-6">
								<div class="city_service2_fig">
									<figure class="overlay">
										<img src="{{asset('storage/images/solution/'.$solution->image)}}" alt="">
										<div class="city_service2_list">
											{{-- <span><i class="fa icon-law-2"></i></span> --}}
											<div class="city_service2_caption">
												<h4>{{$solution->solutionName}}</h4>
											</div>
										</div>
									</figure>
									<div class="city_business_list">
										<ul class="city_busine_detail">
											@foreach ($solution->subSolutions->take(3) as $item)
												<li><a href="{{url('sub-solution/'.$item->id.'/'.$item->slug)}}"><i class="fa fa-star-o"></i><span class="block-text">{{$item->subSolutionName}} </span></a></li>
											@endforeach
										</ul>
										<a class="see_more_btn" href="{{url('solution/'.$solution->id.'/'.$solution->slug)}}">See More <i class="fa icon-next-1"></i></a>
									</div>
									{{-- <div class="city_service2_text">
									</div> --}}
								</div>
							</div>                           
							@endforeach
						@endif
					</div>
				</div>	
			</div>
			<!-- All Solution WRAP END-->
@endsection