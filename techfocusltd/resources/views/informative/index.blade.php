@extends('informative.layouts.master')
@section('content')
			<!--CITY MAIN BANNER START-->
			@php
				$banner = \App\Banner::orderBy('created_at', 'desc')->first();
				$sliders = \App\Slider::orderBy('created_at', 'desc')->get();
			@endphp
			{{-- slider --}}
			<div class="city_main_banner">
				<div class="main-banner-slider">
					@foreach ($sliders as $slider)
						<div>
							<figure class="overlay">
									<img src="{{asset('storage/images/slider/'.$slider->image)}}" alt="" >							
									<div class="banner_text">
									<div class="small_text animated">Welcome to</div>
									<div class="medium_text animated"></div>
									<div class="large_text animated">Tech Focus</div>
									<!--<div class="large_text animated">Focus<span id='text'></span><div class='console-underscore' id='console'>&#95;</div></div>-->
									<div class="banner_btn">
										<a class="theam_btn animated" href="{{url('/info-about')}}">Read More</a>
										<a class="theam_btn animated" href="{{url('/services')}}">Explore Now</a>
									</div>
									<div class="banner_search_form" style="display: inline-flex">
										{{-- <label>Search Here</label> --}}
										<div class="banner_search_field animated">
											<form action="{{url('/search-page')}}" method="post">
												{{ csrf_field() }}
												<input type="text" name="query" placeholder="What  do you want to do" style="color:#fff">
												<a href="#" type="submit"><i class="fa fa-search"></i></a>
											</form>
										</div>
										
										<a class="theam_btn animated" href="{{url('/shop')}}" style="margin-left:10px;">Shop</a>
									</div>
								</div>
							</figure>
						</div>
					@endforeach
				</div>
			</div>
			<!-- MAIN BANNER END-->
			
			<!-- BANNER SERVICES START-->
			<div class="city_banner_services">
				<div class="container-fluid">
					<div class="city_service_list">
						<ul>
							<li>
								<div class="city_service_text">
									<span><i class="fas fa-truck"></i></span>
									<h5><a href="{{url('/info-faq/#world-shipping')}}">Worldwide Shipping</a></h5>
								</div>
							</li>
							<li>
								<div class="city_service_text">
									<span><i class="fas fa-headset"></i></span>
									<h5><a href="{{url('/info-faq/#')}}">Order Online Service</a></h5>
								</div>
							</li>
							<li>
								<div class="city_service_text">
									<span><i class="fas fa-credit-card"></i></span>
									<h5><a href="{{url('/info-faq/#')}}">Payment</a></h5>
								</div>
							</li>
							<li>
								<div class="city_service_text">
									<span><i class="fas fa-undo"></i></span>
									<h5><a href="{{url('/info-faq/#policy')}}">Return 30 Days</a></h5>
								</div>
							</li>							
						</ul>
					</div>
				</div>
			</div>
			<!-- BANNER SERVICES END-->

			
			<!--welcome note WRAP START-->
			<div class="city_about_wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="city_about_fig">
								<figure class="box">
									<div class="box-layer layer-1"></div>
									<div class="box-layer layer-2"></div>
									<div class="box-layer layer-3"></div>
									{{-- <img src="{{asset('informative/extra-images/about-fig.jpg')}}" alt=""> --}}
									<img src="{{asset('storage/images/banner/'.$banner->banner_one)}}" alt="">
								</figure>
								{{-- <div class="city_about_video">
									<figure class="">
										<img src="{{asset('informative/extra-images/about_video.jpg')}}" alt="">
										<a class="paly_btn hvr-pulse" data-rel="prettyPhoto" href="https://www.youtube.com/watch?v=SAaevusBnNI"><i class="fa icon-play-button"></i></a>
									</figure>
								</div> --}}
							</div>
						</div>
						<div class="col-md-6">
							<div class="city_about_list">
								<!--SECTION HEADING START-->
								<div class="section_heading border">
									<span>Welcome to</span>
									<h2>TechFocus</h2>
								</div>
								<!--SECTION HEADING END-->
								<div class="city_about_text">
									{{-- <h6>Focusing on Technology Solution</h6> --}}
									{{strip_tags($welcomeNote->description)}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--welcome note WRAP END-->
			@php
				$industries = \App\Industry::orderBy('industryName')->get();
				// $industrySolutions = \App\Product::select('solutions.solutionName','solutions.id', 'solutions.slug', 'solutions.description', 'solutions.image', 'industries.industryName', 'products.industry_id')->leftJoin('industries', 'industries.id', '=', 'products.industry_id')->leftJoin('solutions', 'solutions.id', '=', 'products.solution_id')->groupBy('products.industry_id')->get();
				// $industry = \App\Product::select('industries.industryName', 'products.industry_id')->leftJoin('industries', 'industries.id', '=', 'products.industry_id')->groupBy('products.industry_id')->get();
				//  dd($industries);
			@endphp
			
			<!-- Solutions WRAP START-->
			<div class="city_department_wrap overlay">
				<div class="bg_white">
					<div class="container">
						<!--SECTION HEADING START-->
						<div class="section_heading margin-bottom">
							<span>Explore</span>
							<h2>Industry base Solutions</h2>
						</div>
						<!--SECTION HEADING END-->
						{{-- <div class="city-department-slider">
							@php
								$solutions = \App\Solution::all();
							@endphp
							@foreach ($solutions as $solution)
								<div>
									@if (count($solution->subSolutions)>0)
										<h6 style="text-align:center;">{{$solution->solutionName}}</h6>
										@foreach ($solution->subSolutions as $subSolution)
											<div class="width_control">
												<div class="city_department_fig">
													<div>
														<figure class="box">
															<div class="box-layer layer-1"></div>
															<div class="box-layer layer-2"></div>
															<div class="box-layer layer-3"></div>
															<img src="{{asset('storage/images/subSolution/'.$subSolution->image)}}" alt="" style="width: 90px; height: 80px;!important">
														</figure>
													</div>
													<div class="city_department_text">
														<h6>{{$subSolution->subSolutionName}}</h6>
														<a href="{{url('sub-solution/'.$subSolution->id.'/'.$subSolution->slug)}}">See More<i class="fa fa-angle-double-right"></i></a>
													</div>
												</div>
											</div>	
										@endforeach
									@endif
								</div>
							@endforeach
						</div> --}}
						{{-- <div class="program-slider">
							@php
								$solutions = \App\Solution::all();
							@endphp
							@foreach ($solutions as $solution)
								<div>
									@if (count($solution->subSolutions)>0)
									<div class="jumbotron">
										<div class="container">
											<div class="row">
												<div class="col-md-4 col-sm-6">
													<div class="city_service2_fig">
														<figure class="overlay">
															<img src="{{asset('storage/images/solution/'.$solution->image)}}" alt="">
															
														</figure>
														<div class="city_business_list" style="padding:10px;">
															<a class="see_more_btn" href="{{url('solution/'.$solution->id.'/'.$solution->slug)}}" style="text-align: center"><strong>{{$solution->solutionName}}</strong> </a>
															<p class="text-justify" style="font-size: 12px;">
																{{strip_tags($solution->description)}}
															</p>
														</div>
													</div>
												</div>
												<div class="col-md-8 col-sm-6">
													@foreach ($solution->subSolutions as $subSolution)
														<div class="width_control">
															<div class="city_department_fig">
																<div>
																	<figure class="box">
																		<div class="box-layer layer-1"></div>
																		<div class="box-layer layer-2"></div>
																		<div class="box-layer layer-3"></div>
																		<img src="{{asset('storage/images/subSolution/'.$subSolution->image)}}" alt="" style="width: 170px; height: 80px;!important">
																	</figure>
																</div>
																<div class="city_department_text">
																	<h6 style="font-size: 15px;">{{$subSolution->subSolutionName}}</h6>
																	<a href="{{url('sub-solution/'.$subSolution->id.'/'.$subSolution->slug)}}">See More<i class="fa fa-angle-double-right"></i></a>
																</div>
															</div>
														</div>	
													@endforeach
												</div>
											</div>
										</div>
									</div>
									@endif
								</div>
							@endforeach
						</div> --}}
						<div class="row">
							<div class="col-md-12">		
								<!-- tabs left -->
								<div class="tabbable tabs-left">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#industry-all" data-toggle="tab" style="padding:5px 10px!important;">All</a></li>
										@foreach ($industries as $industryTab)
											@if (count($industryTab->product)>0)
												<li><a href="#industry-{{$industryTab->id}}" data-toggle="tab" style="padding:5px 10px!important;">{{$industryTab->industryName}}</a></li>
											@endif
										@endforeach
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="industry-all">
											<div class="row" style="margin-left: 150px!important;"> 
												<div class="owl-carousel industry-base-solution owl-theme">
													@php
														$solutions = \App\Solution::all();
													@endphp
													@foreach ($solutions as $solution)
														<div>
															@if (count($solution->subSolutions)>0)
																<div class="item">
																	<div class="col-md-4 col-sm-6">
																		<div class="city_service2_fig">
																			<figure class="overlay">
																				<img src="{{asset('storage/images/solution/'.$solution->image)}}" alt="">
																				
																			</figure>
																			<div class="city_business_list" style="padding:10px;">
																				<a class="see_more_btn" href="{{url('solution/'.$solution->id.'/'.$solution->slug)}}" style="text-align: center"><strong>{{$solution->solutionName}}</strong> 
																					<p class="text-justify" style="font-size: 11px; padding:10px;">
																						{{substr(strip_tags($solution->description),0,500)}}...
																					</p>
																				</a>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-8 col-sm-6">
																		@foreach ($solution->subSolutions->take(6) as $subSolution)
																			<div class="width_control">
																				<div class="city_department_fig">
																					<div>
																						<figure class="box">
																							<div class="box-layer layer-1"></div>
																							<div class="box-layer layer-2"></div>
																							<div class="box-layer layer-3"></div>
																							<img src="{{asset('storage/images/subSolution/'.$subSolution->image)}}" alt="" style="width: 170px; height: 80px;!important">
																						</figure>
																					</div>
																					<div class="city_department_text">
																						<h6 style="font-size: 15px;">{{$subSolution->subSolutionName}}</h6>
																						<a href="{{url('sub-solution/'.$subSolution->id.'/'.$subSolution->slug)}}">See More<i class="fa fa-angle-double-right"></i></a>
																					</div>
																				</div>
																			</div>	
																		@endforeach
																	</div>
																</div>
															@endif
														</div>
													@endforeach
												</div>
											</div>
										</div>
										@foreach ($industries as $industryTabPanel)
											@if (count($industryTabPanel->product)>0)
												<div class="tab-pane" id="industry-{{$industryTabPanel->id}}">
													@php
														$industryBaseSolutions = \App\Product::select('solutions.solutionName','solutions.id', 'solutions.slug', 'solutions.description', 'solutions.image')->leftJoin('solutions', 'solutions.id', '=', 'products.solution_id')->where('products.solution_id','!=', null)->where('industry_id',$industryTabPanel->id)->groupBy('solutions.id')->get();
														// dd($industryBaseSolutions);
													@endphp
													{{-- <div class="jumbotron">
														<div class="container"> --}}
															<div class="row" style="margin-left: 150px!important;"> 
																<div class="owl-carousel industry-base-solution owl-theme">
																	@if (count($industryBaseSolutions)>0)
																		@foreach ($industryBaseSolutions as $industryBaseSolution)
																			{{-- @if ($industryBaseSolution->id != null)
																				<div class="col-md-3 col-sm-6">
																					<div class="city_service2_fig">
																						<img src="{{asset('storage/images/solution/'.$industryBaseSolution->image)}}" alt="" style="width: 250px; height:100px;">
																						<div class="city_business_list">
																							<a class="see_more_btn" href="{{url('solution/'.$industryBaseSolution->id.'/'.$industryBaseSolution->slug)}}" style="text-align: center">{{$industryBaseSolution->solutionName}} 
																								<p class="text-justify" style="font-size: 11px; padding:10px;">
																									{{substr(strip_tags($industryBaseSolution->description),0,95)}}... <span style="color:#1B6492;">more</span>
																								</p>
																							</a>
																						</div>
																					</div>
																				</div>
																			@endif --}}
																			<div class="item">
																				<div class="col-md-4 col-sm-6">
																					<div class="city_service2_fig">
																						<figure class="overlay">
																							<img src="{{asset('storage/images/solution/'.$industryBaseSolution->image)}}" alt="">
																							
																						</figure>
																						<div class="city_business_list" style="padding:10px;">
																							<a class="see_more_btn" href="{{url('solution/'.$industryBaseSolution->id.'/'.$industryBaseSolution->slug)}}" style="text-align: center"><strong>{{$industryBaseSolution->solutionName}}</strong> 
																								<p class="text-justify" style="font-size: 11px; padding:10px;">
																									{{substr(strip_tags($industryBaseSolution->description),0,500)}}...
																								</p>
																							</a>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-8 col-sm-6">
																					@php
																						$subSolutions = \App\Subsolution::where('solution_id',$industryBaseSolution->id)->get();
																					@endphp
																					@foreach ($subSolutions as $subSolution)
																						<div class="width_control">
																							<div class="city_department_fig">
																								<div>
																									<figure class="box">
																										<div class="box-layer layer-1"></div>
																										<div class="box-layer layer-2"></div>
																										<div class="box-layer layer-3"></div>
																										<img src="{{asset('storage/images/subSolution/'.$subSolution->image)}}" alt="" style="width: 170px; height: 80px;!important">
																									</figure>
																								</div>
																								<div class="city_department_text">
																									<h6 style="font-size: 15px;">{{$subSolution->subSolutionName}}</h6>
																									<a href="{{url('sub-solution/'.$subSolution->id.'/'.$subSolution->slug)}}">See More<i class="fa fa-angle-double-right"></i></a>
																								</div>
																							</div>
																						</div>	
																					@endforeach
																				</div>
																			</div>
																		@endforeach
																	@else
																		<div class="col-md-8 col-sm-6">
																			<h3 class="text-justify">
																				Nothing Found For This Industry
																			</h3>
																		</div>
																	@endif
																</div>
															</div>
														{{-- </div>
													</div> --}}
												</div>
											@endif
										@endforeach
									</div>
								</div>
								<!-- /tabs -->
								
							</div>
						</div>
					</div>
				</div>
			</div>	
			<!-- solutions WRAP END-->

			
			<!-- Product WRAP START-->
			{{-- <div class="city_project_wrap">
				<div class="container-fluid">
					<div class="section_heading center">
						<span>All of our</span>
						<h2>Products</h2>
					</div>
					<div class="city_project_mansory" style="margin-bottom: 10px; border-bottom: solid 1px;">
						<ul class="nav nav-tabs product-tab">
							<li data-value="1" class="active"><a data-toggle="tab" href="#new-arraival" style="background-color:#1b6492; color:#fff;">New Arraival</a></li>
							<li data-value="2"><a data-toggle="tab" href="#hardware">Hardware</a></li>
							<li data-value="3"><a data-toggle="tab" href="#software">Software</a></li>
							<li data-value="4"><a data-toggle="tab" href="#services">Services</a></li>
						</ul>
					</div>
					<div class="tab-content city_health2_text text2 margin30">
						<div id="new-arraival" class="tab-pane active">
							<div class="city-project-slider">
								@foreach ($newProducts as $newProduct)
									<div>
										<a href="{{url('product-info/'.$newProduct->id.'/'.$newProduct->slug)}}">
										<div class="city_project_fig">
											<figure >
												<img src="{{asset('storage/images/product/'.$newProduct->image->image1)}}"  alt="" style=" width: 250px; height: 250px;!important">
											</figure>
											<div>
												<span style="padding:10px; text-align:center !important;"> {{substr($newProduct->productName,0,28) }} </span>
											</div>
										</div>
										</a>
									</div>
								@endforeach
							</div>
						</div>
						<div id="hardware" class="tab-pane">
							<div class="city-project-slider">
								@if (!empty($hardwares))
									@foreach ($hardwares as $hardware)
										<div>
											<a href="{{url('product-info/'.$hardware->id.'/'.$hardware->slug)}}">
											<div class="city_project_fig">
												<figure>
													<img src="{{asset('storage/images/product/'.$hardware->image->image1)}}"  alt="" style=" width: 300px; height: 300px;!important">
												</figure>
												<div>
													<span style="padding:10px; text-align:center !important;"> {{substr($hardware->productName,0,28) }} </span>
												</div>
											</div>
											</a>
										</div>
									@endforeach	
								@endif
							</div>
						</div>
						<div id="software" class="tab-pane">
							<div class="city-project-slider">
								@foreach ($softwares as $software)
									<div>
										<a href="{{url('product-info/'.$software->id.'/'.$software->slug)}}">
										<div class="city_project_fig">
											<figure>
												<img src="{{asset('storage/images/product/'.$software->image->image1)}}"  alt="" style=" width: 300px; height: 300px;!important">
											</figure>
											<div>
												<span style="padding:10px; text-align:center !important;"> {{substr($software->productName,0,28) }} </span>
											</div>
										</div>
										</a>
									</div>
								@endforeach
							</div>
						</div>
						<div id="services" class="tab-pane">
							<div class="city-project-slider">
								@foreach ($mostVieweds as $mostViewed)
									<div>
										<a href="{{url('product-info/'.$mostViewed->id.'/'.$mostViewed->slug)}}">
										<div class="city_project_fig">
											<figure>
												<img src="{{asset('storage/images/product/'.$mostViewed->image->image1)}}"  alt="" style=" width: 300px; height: 300px;!important">
											</figure>
											<div>
												<span style="padding:10px; text-align:center !important;"> {{substr($mostViewed->productName,0,28) }} </span>
											</div>
										</div>
										</a>
									</div>
								@endforeach
							</div>
						</div>
					</div>
					
				</div>
			</div>	 --}}

			<div class="city_project_wrap" style="padding: 50px 20px 0px;">
				<div class="container-fluid">
					<div class="section_heading center">
						<h2>Products</h2>
						
					</div>

					{{-- <div>
						<ul class="nav nav-tabs" role="tablist">
						  <li role="presentation" class="active"><a href="#new-arraival" aria-controls="home" role="tab" data-toggle="tab">New Arraival</a></li>
						  <li role="presentation"><a href="#hardware" aria-controls="profile" role="tab" data-toggle="tab">Hardware</a></li>
						  <li role="presentation"><a href="#software" aria-controls="messages" role="tab" data-toggle="tab">Software</a></li>
						  <li role="presentation"><a href="#services" aria-controls="settings" role="tab" data-toggle="tab">Services</a></li>
						</ul>
						<div class="tab-content">
						    <div role="tabpanel" class="tab-pane active" id="new-arraival">
								<div class="owl-carousel owl-theme">
									@foreach ($newProducts as $newProduct)
										<div class="item">
											<img src="{{asset('storage/images/product/'.$newProduct->image->image1)}}" alt="" style="width: 250px; height:250px;">							
											<span style="padding:10px; text-align:center !important;"> {{substr($newProduct->productName,0,28) }} </span>

										</div>
									@endforeach
								</div>
						    </div>
						  	<div role="tabpanel" class="tab-pane" id="hardware">
								<div class="owl-carousel owl-theme">
									@if (!empty($hardwares))
									
										@foreach ($hardwares as $hardware)
											<div class="item">
												<img src="{{asset('storage/images/product/'.$hardware->image->image1)}}" alt="" style="width: 250px; height:250px;">							
												<span style="padding:10px; text-align:center !important;"> {{substr($hardware->productName,0,28) }} </span>
											</div>
										@endforeach						
									@endif
								</div>
							</div>
						  	<div role="tabpanel" class="tab-pane" id="software">
								<div class="owl-carousel owl-theme">
									@foreach ($softwares as $software)
										<div class="item">
											<img src="{{asset('storage/images/product/'.$software->image->image1)}}" alt="" style="width: 250px; height:250px;">							
											<span style="padding:10px; text-align:center !important;"> {{substr($software->productName,0,28) }} </span>

										</div>
									@endforeach
								</div>
							</div>
						  	<div role="tabpanel" class="tab-pane" id="services">
								<div class="owl-carousel owl-theme">
									@foreach ($mostVieweds as $mostViewed)
										
										<div class="item">
											<img src="{{asset('storage/images/product/'.$mostViewed->image->image1)}}" alt="" style="width: 250px; height:250px;">							
											<span style="padding:10px; text-align:center !important;"> {{substr($mostViewed->productName,0,28) }} </span>

										</div>
									@endforeach
								</div>
							</div>
						</div>
					  
					</div> --}}


					<div class="city_project_mansory" style="margin-bottom: 20px;border-bottom: solid 1px #d5d5d5;">
						<ul class="nav nav-tabs product-tab">
							<li data-value="1" class="active"><a data-toggle="tab" href="#new-arraival" style="background-color:#1b6492; color:#fff;">New Arraival</a></li>
							<li data-value="2"><a data-toggle="tab" href="#hardware">Hardware</a></li>
							<li data-value="3"><a data-toggle="tab" href="#software">Software</a></li>
							<li data-value="4"><a data-toggle="tab" href="#services">Services</a></li>
						</ul>
					</div>
					<div class="tab-content city_health2_text text2 margin30">
						<div id="new-arraival" class="tab-pane active">
							<div class="owl-carousel new-arraival owl-theme">
								@foreach ($newProducts as $newProduct)
									<div class="item">
										<a href="{{url('product-info/'.$newProduct->id.'/'.$newProduct->slug)}}">
											<img src="{{asset('storage/images/product/'.$newProduct->image->image1)}}" alt="" style="width: 180px; height:180px;">							
											<span style="padding:10px; text-align:center !important;"> {{substr($newProduct->productName,0,28) }} </span>
										</a>
									</div>
								@endforeach
							</div>
						</div>
						<div id="hardware" class="tab-pane">
							<div class="owl-carousel hardware owl-theme">
								@if (!empty($hardwares))
								
									@foreach ($hardwares as $hardware)
										<div class="item">
											<a href="{{url('product-info/'.$hardware->id.'/'.$hardware->slug)}}">
												<img src="{{asset('storage/images/product/'.$hardware->image->image1)}}" alt="" style="width: 180px; height:180px;">							
												<span style="padding:10px; text-align:center !important;"> {{substr($hardware->productName,0,28) }} </span>
											</a>
										</div>
									@endforeach						
								@endif
							</div>
						</div>
						<div id="software" class="tab-pane">
							<div class="owl-carousel software owl-theme">
								@foreach ($softwares as $software)
									<div class="item">
										<a href="{{url('product-info/'.$software->id.'/'.$software->slug)}}">
											<img src="{{asset('storage/images/product/'.$software->image->image1)}}" alt="" style="width: 180px; height:180px;">							
											<span style="padding:10px; text-align:center !important;"> {{substr($software->productName,0,28) }} </span>
										</a>
									</div>
								@endforeach
							</div>
						</div>
						<div id="services" class="tab-pane">
							<div class="owl-carousel services owl-theme">
								@foreach ($mostVieweds as $mostViewed)
									
									<div class="item">
										<a href="{{url('product-info/'.$mostViewed->id.'/'.$mostViewed->slug)}}">
											<img src="{{asset('storage/images/product/'.$mostViewed->image->image1)}}" alt="" style="width: 180px; height:180px;">							
											<span style="padding:10px; text-align:center !important;"> {{substr($mostViewed->productName,0,28) }} </span>
										</a>
									</div>
								@endforeach
							</div>
						</div>
					</div>
					
				</div>
			</div>


			<!-- Product WRAP END-->
			{{-- @php
				$industrySolutions = \App\Product::select('solutions.solutionName','solutions.id', 'solutions.slug', 'solutions.description', 'solutions.image', 'industries.industryName', 'products.industry_id')->leftJoin('industries', 'industries.id', '=', 'products.industry_id')->leftJoin('solutions', 'solutions.id', '=', 'products.solution_id')->groupBy('products.industry_id')->get();
			@endphp --}}
			
			<!-- Industry WRAP START-->
			{{-- <div class="city_department_wrap overlay">
				<div class="bg_white">
					<div class="container-fluid">
						<div class="section_heading margin-bottom">
							<span>Explore</span>
							<h2>Industries</h2>
						</div>
						<div class="city-department-slider">
							@foreach ($industrySolutions as $industrySolution)
								@if ($industrySolution->solutionName)
									<div>
										<h6 style="text-align:center">{{$industrySolution->industryName}}</h6>
										<div class="width_control">
											<div class="city_department_fig">
												<div>
													<figure class="box">
														<div class="box-layer layer-1"></div>
														<div class="box-layer layer-2"></div>
														<div class="box-layer layer-3"></div>
														<img src="{{asset('storage/images/solution/'.$industrySolution->image)}}" alt="" style="width: 90px; height: 80px;!important">
														<a class="paly_btn" data-rel="prettyPhoto" href="{{asset('informative/extra-images/taxi-cab-381233_640.jpg')}}"><i class="fa fa-plus"></i></a>
													</figure>
												</div>
												<div class="city_department_text">
													<h6>{{$industrySolution->solutionName}}</h6>
													<a href="{{url('solution/'.$industrySolution->id.'/'.$industrySolution->slug)}}">See More<i class="fa fa-angle-double-right"></i></a>
												</div>
											</div>
										</div>	
									</div>
								@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>	 --}}
			<!-- Industry WRAP END-->
			@php
				$featuredContent = \App\Featuredcontent::orderBy('created_at','desc')->first();
				$featuredContentforli = \App\Featuredcontent::orderBy('created_at','desc')->take(4)->get();
			@endphp
			<!--Feature Content WRAP START-->
			<div class="city_jobs_wrap">
				@if(!empty($featuredContent))
				<div class="city_jobs_fig">
						<img src="{{url('storage/images/feturedContent/'.$featuredContent->image)}}" alt="">
					<div class="city_job_text">
						<h2>{{$featuredContent->title}}</h2>
						{{-- <p> {!!$featuredContent->description!!}</p> --}}
						{{-- <a class="theam_btn" href="#" tabindex="0">Get In Touch</a> --}}
					</div>
				</div>
				@endif
				@if (!empty($featuredContentforli))
					<div class="city_jobs_list">
						<ul>
							@foreach ($featuredContentforli as $item)
								@if ($item->id != $featuredContent->id)
									<li>
										<div class="city_jobs_item overlay">
											<span><img src="{{url('storage/images/feturedContent/'.$item->image)}}" alt="" style="width: 87px; height: 83px;!important"></span>
											<div class="ciy_jobs_caption">
												<h6 style="color:#ffffff">{{$item->title}}</h6>
											</div>
										</div>
									</li>			
								@endif
							@endforeach
						</ul>
					</div>					
				@endif

			</div>
			<!--Feature Content WRAP END-->
			
			<!-- Principals / client list WRAP START-->
			<div class="city_blog_wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
								<!--SECTION HEADING START-->
								<div class="heding_full">
									<div class="section_heading">
										{{-- <span>Welcome to </span> --}}
										<h4>Our Principals </h4>
										<span class="top-span-four "></span>

									</div>
								</div>
								@php
									$principles = \App\Principle::all()->sortByDesc('id');
								@endphp
								<!--SECTION HEADING END-->
								<div style="padding:1%">
									<div class="city-health2-slider">
										@foreach ($principles as $principle)
											<div>
												<div class="city_senior_team">
													<figure class="">
														{{-- <div class="box-layer layer-1"></div>
														<div class="box-layer layer-2"></div>
														<div class="box-layer layer-3"></div> --}}
														<img src="{{asset('storage/images/logo/principle/'.$principle->image)}}" alt="" style="width: 100px; height: 100px;!important">
													</figure>
												</div>
											</div>							
										@endforeach
									</div>	
								</div>
						</div>
						<div class="col-md-6">
								<!--SECTION HEADING START-->
								<div class="heding_full">
									<div class="section_heading">
										{{-- <span>Welcome to </span> --}}
										<h4>Our Client </h4>
										<span class="top-span-four "></span>

									</div>
								</div>
								@php
									$clients = \App\Vendor::all()->sortByDesc('id');
								@endphp
								<!--SECTION HEADING END-->
								<div style="padding:1%">
									<div class="city-health2-slider">
										@foreach ($clients as $client)
											<div>
												<div class="city_senior_team">
													<figure class="">
														{{-- <div class="box-layer layer-1"></div>
														<div class="box-layer layer-2"></div>
														<div class="box-layer layer-3"></div> --}}
														<img src="{{asset('storage/images/logo/vendor/'.$client->image)}}" alt="" style="width: 100px; height: 100px;!important">
													</figure>
												</div>
											</div>						
										@endforeach
									</div>	
								</div>
						</div>

					</div>
				</div>
			</div>
			<!-- BLOG WRAP END-->

			<!-- CLIENT Testimony WRAP START-->
			<div class="city_client_wrap">
				<div class="container">
					<div class="city_client_row">
						<ul class="bxslider bx-pager">
							<li>
								<div class="city_client_fig">
									<figure class="box">
										<div class="box-layer layer-1"></div>
										<div class="box-layer layer-2"></div>
										<div class="box-layer layer-3"></div>
										<img src="{{asset('informative/extra-images/client.jpg')}}" alt="">
									</figure>
									<div class="city_client_text">
										<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis. </p>
										<h4><a href="#">Likor Stom</a> </h4>
										<span><a href="#">Directio-Baseline</a></span>
									</div>
								</div>
							</li>
							{{-- <li>
								<div class="city_client_fig">
									<figure class="box">
										<div class="box-layer layer-1"></div>
										<div class="box-layer layer-2"></div>
										<div class="box-layer layer-3"></div>
										<img src="{{asset('informative/extra-images/client.jpg')}}" alt="">
									</figure>
									<div class="city_client_text">
										<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibha vel velit auctor aliquet. Aenean sollicitudin, lorem quis. </p>
										<h4><a href="#">Likor Stom</a> </h4>
										<span><a href="#">Directio-Baseline</a></span>
									</div>
								</div>
							</li> --}}
						</ul>
					</div>
					<div class="city_client_link" id="bx-pager">
						<a data-slide-index="0" href="#">
							<div class="client_arrow">
								<figure class="box">
									<div class="box-layer layer-1"></div>
									<div class="box-layer layer-2"></div>
									<div class="box-layer layer-3"></div>
								<img src="{{asset('informative/extra-images/client1.jpg')}}" alt="">
								</figure>
							</div>	
						</a>
						<a data-slide-index="1" href="#">					
							<div class="client_arrow">
								<figure class="box">
									<div class="box-layer layer-1"></div>
									<div class="box-layer layer-2"></div>
									<div class="box-layer layer-3"></div>
									<img src="{{asset('informative/extra-images/client2.jpg')}}" alt="">
								</figure>
							</div>
						</a>	
					</div>
				</div>
			</div>
			<!-- CLIENT WRAP END-->
			@php
				
				$singleBlog	=	\App\Blog::orderBy('created_at','desc')->first();
				$blogs	=	\App\Blog::orderBy('created_at','asc')->take(2)->get();
				$singleNews	=	\App\News::orderBy('created_at','desc')->first();
				$news	=	\App\News::orderBy('created_at','asc')->take(2)->get();
				
			@endphp

			<!-- NEWS WRAP START-->
			<div class="city_news_wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<!--SECTION HEADING START-->
							<div class="section_heading margin-bottom">
								<h4>Blogs</h4>
								<span class="top-span-four "></span>
							</div>
							<!--SECTION HEADING START-->
							<div class="row">
								@if(!empty($singleBlog))
									<div class="col-md-6 col-sm-6">
											<div class="city_news_fig">
												<figure class="box">
													<div class="box-layer layer-1"></div>
													<div class="box-layer layer-2"></div>
													<div class="box-layer layer-3"></div>
													<img src="{{asset('storage/images/blog/'.$singleBlog->blogImage)}}" alt="" style="width: 300px; height: 200px;!important">
												</figure>
												<div class="city_news_text">
													<h5><a href="{{url('informative-blog-details/'.$singleBlog->id)}}">{{$singleBlog->blogTitle}}</a></h5>
													<ul class="city_news_meta">
														<li><a href="#">May 22, 2018</a></li>
														<li><a href="#">{{$singleBlog->category->categoryName}}</a></li>
													</ul>
												</div>
											</div>
									</div>
								@endif
								<div class="col-md-6 col-sm-6">
									<div class="city_news_row">
										<ul>
											@if(!empty($blogs))
												@foreach ($blogs->take(2) as $blog)
													<li>
														<div class="city_news_list">
															<figure class="box">
																<div class="box-layer layer-1"></div>
																<div class="box-layer layer-2"></div>
																<div class="box-layer layer-3"></div>
																<img src="{{asset('storage/images/blog/'.$blog->blogImage)}}" alt="" style="width: 90px; height: 90px;!important">
															</figure>
															<div class="city_news_list_text">
																<h6><a href="{{url('informative-blog-details/'.$blog->id)}}">{{$blog->blogTitle}}</a></h6>
																<ul class="city_news_meta">
																	<li><a href="#">{{$blog->category->categoryName}}</a></li>
																</ul>
															</div>
														</div>
													</li>
												@endforeach
											@endif
										</ul>
									</div>
								</div>
							</div>	
							@if(!empty($singleNews))
							<!--SECTION HEADING START-->
							<div class="section_heading margin-bottom">
								<h4>News Releases</h4>
								<span class="top-span-four"></span>

							</div>
							@endif
							<!--SECTION HEADING START-->
							<div class="row">
								@if(!empty($singleNews))
									<div class="col-md-6 col-sm-6">
										<div class="city_news_fig">
											<figure class="box">
												<div class="box-layer layer-1"></div>
												<div class="box-layer layer-2"></div>
												<div class="box-layer layer-3"></div>
												<img src="{{asset('storage/images/news/'.$singleNews->newsImage)}}" alt="" style="width: 300px; height: 200px;!important">
											</figure>
											<div class="city_news_text">
												<h5><a href="{{url('news#news-'.$singleNews->id)}}">{{$singleNews->newsTitle}}</a></h5>
												<ul class="city_news_meta">
													<li><a href="#">{{$singleNews->created_at->format('M d,Y')}}</a></li>
													<li><a href="#">Public Notices</a></li>
												</ul>
											</div>
										</div>
									</div>
								@endif
								<div class="col-md-6 col-sm-6">
									<div class="city_news_row">
										<ul>
											@if(!empty($news))
												@foreach ($news->take(2) as $single_news)
													<li>
														<div class="city_news_list">
															<figure class="box">
																<div class="box-layer layer-1"></div>
																<div class="box-layer layer-2"></div>
																<div class="box-layer layer-3"></div>
																<img src="{{asset('storage/images/news/'.$single_news->newsImage)}}" alt="" style="width: 100px; height: 70px;!important">
															</figure>
															<div class="city_news_list_text">
																<h6><a href="{{url('news#news-'.$single_news->id)}}">{{$single_news->newsTitle}}</a></h6>
																<ul class="city_news_meta">
																	<li><a href="#">{{$single_news->category->categoryName}}</a></li>
																</ul>
															</div>
														</div>
													</li>
												@endforeach
											@endif
										</ul>
									</div>
								</div>
							</div>	
						</div>
						<div class="col-md-4">
							<div class="city_news_form">
								<div class="city_news_feild">
									<h4>Newsletter</h4>
									<div class="city_news_search">
										<form action="{{url('/subscribe')}}" method="post">
											{{ csrf_field() }}
											<input type="email" name="email" placeholder="Enter Your Email Adress Here" required>
											<button type="submit" class="theam_btn  color" style="text-align:center">Subcribe Now</button>

										</form>
									</div>
									<br>
								</div>
								<div class="city_news_feild feild2">
									@php
										$profile = \App\Profile::all()->first();
									@endphp
									<h4>Profile</h4>
									<div class="row">
										<div class="col-lg-7">
											<h6 class="profile-div" style="color: white!important;">Established: 2015</h6>
										</div>
										<div class="col-lg-5">
											@php
												$products = \App\Product::all();
											@endphp
											<h6 class="profile-div" style="margin-left:-25%; color: white!important;">Products: {{count($products)}}</h6>
										</div>
									</div>
									{{-- <div >
										<p>Some documents of our company Some documents of our company Some documents of our company Some documents of our company Some documents of our company Some documents of our company Some documents of our company</p>
									</div> --}}
									<div class="city_document_list">
										<ul>
											<li>
												<a href="{{asset('storage/profile/'.$profile->profile)}}" target="_blank">
													<i class="fa icon-document"></i>
													Company Profile
													<span>Last Update : {{$profile->updated_at->format('d-m-y')}}</span>
												</a>
											</li>
											<li>
												<a href="{{asset('storage/profile/'.$profile->brochure)}}" target="_blank">
													<i class="fa icon-document"></i>
													Brochure
													<span>Last Update : {{$profile->updated_at->format('d-m-y')}}</span>
												</a>
											</li>
											<li>
												<a href="{{asset('storage/profile/'.$profile->dataSheet)}}" target="_blank">
													<i class="fa icon-document"></i>
													Data Sheet
													<span>Last Update : {{$profile->updated_at->format('d-m-y')}}</span>
												</a>
												
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
			<!-- NEWS WRAP END-->

			<!-- REQUEST WRAP START-->
			<div class="city_requset_wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="city_request_list">
								<div class="city_request_row">
									<span><i class="fa icon-question"></i></span>
									<div class="city_request_text">
										<span>Recent</span>
										<h4>Top Request</h4>
									</div>
								</div>
								<div class="city_request_link">
									<ul>
										@if ($topRequest)
											<li><a href="{{$topRequest->label_url1}}">{{$topRequest->label1}}</a></li>
											<li><a href="{{$topRequest->label_url2}}">{{$topRequest->label2}}</a></li>
											<li><a href="{{$topRequest->label_url3}}">{{$topRequest->label3}}</a></li>
											<li><a href="{{$topRequest->label_url4}}">{{$topRequest->label4}}</a></li>
											<li><a href="{{$topRequest->label_url5}}">{{$topRequest->label5}}</a></li>
											<li><a href="{{$topRequest->label_url6}}">{{$topRequest->label6}}</a></li>
										@endif
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="city_request_list">
								<div class="city_request_row">
									<span><i class="fa icon-shout"></i></span>
									<div class="city_request_text">
										<span>Recent</span>
										<h4>Announcement</h4>
									</div>
								</div>
								<div class="city_request_link">
									<ul>
										@if ($announcement)
											<li><a href="{{$announcement->label_url1}}">{{$announcement->label1}}</a></li>
											<li><a href="{{$announcement->label_url2}}">{{$announcement->label2}}</a></li>
											<li><a href="{{$announcement->label_url3}}">{{$announcement->label3}}</a></li>
											<li><a href="{{$announcement->label_url4}}">{{$announcement->label4}}</a></li>
											<li><a href="{{$announcement->label_url5}}">{{$announcement->label5}}</a></li>
											<li><a href="{{$announcement->label_url6}}">{{$announcement->label6}}</a></li>
										@endif
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
			<!-- REQUEST WRAP END-->
			
@endsection
@section('script')
<script>
	jQuery(document).ready(function($){
		$('.industry-base-solution').owlCarousel({
		loop:true,
		margin:10,
		items:1,
		responsiveClass:true,
		autoplay:true,
		center:true,
		responsive:{
			0:{
				items:1,
				nav:false
			},
			600:{
				items:1,
				nav:false
			},
			1000:{
				items:1,
				nav:false,
				loop:true
			}
		}
		});


		$('.new-arraival').owlCarousel({
		loop:true,
		margin:10,
		items:1,
		responsiveClass:true,
		autoplay:true,
		center:true,
		responsive:{
			0:{
				items:1,
				nav:false
			},
			600:{
				items:3,
				nav:false
			},
			1000:{
				items:7,
				nav:false,
				loop:true
			}
		}
		});
		$('.hardware').owlCarousel({
		loop:true,
		margin:10,
		items:1,
		responsiveClass:true,
		autoplay:true,
		center:true,
		responsive:{
			0:{
				items:1,
				nav:false
			},
			600:{
				items:3,
				nav:false
			},
			1000:{
				items:7,
				nav:false,
				loop:true
			}
		}
		});
		$('.software').owlCarousel({
		loop:true,
		margin:10,
		items:1,
		responsiveClass:true,
		autoplay:true,
		center:true,
		responsive:{
			0:{
				items:1,
				nav:false
			},
			600:{
				items:3,
				nav:false
			},
			1000:{
				items:7,
				nav:false,
				loop:true
			}
		}
		});
		$('.services').owlCarousel({
		loop:true,
		margin:10,
		items:1,
		responsiveClass:true,
		autoplay:true,
		center:true,
		responsive:{
			0:{
				items:1,
				nav:false
			},
			600:{
				items:3,
				nav:false
			},
			1000:{
				items:7,
				nav:false,
				loop:true
			}
		}
		});
	});


</script>
@endsection