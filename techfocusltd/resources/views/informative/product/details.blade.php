@extends('informative.layouts.master')
@section('content')
<!-- SAB BANNER START-->
<div class="sab_banner overlay">
	<div class="container">
		<div class="sab_banner_text">
			<h5 style="color: white">{{$product->productName}}</h5>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
				<li class="breadcrumb-item active">Product</li>
			</ul>
		</div>
	</div>
</div>
<!-- SAB BANNER END-->
			
<!-- CITY EVENT2 WRAP START-->
<div class="city_services2_wrap" style="padding:0px 0px 10%;">
	<div class="container">
		<div class="city_mayor_row">
			<div class="city_mayor_fig">
				<figure>
					<img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" style="width: 400px; height: 400px;!important">
				</figure>
				<div class="city_mayor_text">
					<strong>
						<h5>{{$product->productName}}</h5>
					</strong>
					
					<ul class="city_mayor_list">
						<li><h6 style="font-size:12px"><span>SKU</span>{{$product->sku}}</h6></li>
						<li><h6 style="font-size:12px"><span>Brand</span>{{$product->brand->brandName}}</h6></li>
						<li><h6 style="font-size:12px"><span>Industry</span>{{$product->industry->industryName}}</h6></li>
						<li><h6 style="font-size:12px"><span>Technology</span>{{$product->technology->technologyName}}</h6></li>
						<li><h6 style="font-size:12px"><span>Category</span>{{$product->category->categoryName}}</h6></li>
						<li><h6 style="font-size:12px"><span>MiniCategory</span>{{$product->minicategory->miniCategoryName}}</h6></li>
						<li>
							<h6 style="font-size:12px">
								<span>Solution</span>
									@if (!empty($product->solution->solutionName))
									{{$product->solution->solutionName}}
									@endif
							</h6>
						</li>
						<li><h6 style="font-size:12px"><span>Regular Price</span>{{$product->regularPrice}}</h6></li>
						<li><h6 style="font-size:12px"><span>Type</span>{{$product->availability}}</h6></li>
					</ul>
					<div class="city_mayor_contact">
						<a id="#quotation" class="theam_btn" href="{{url('quotation/'.$product->slug.'-id-'.$product->id)}}">Request Quotation</a>
						<div class="city_top_social">
							@php
								$socialSite = \App\Siteinfo::all()->first();
							@endphp
							<ul>
								<li><a href="{{$socialSite->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<li><a href="{{$socialSite->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<li><a href="{{$socialSite->dribbble}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="city_mayor_caption">
				<div class="row">
					<div class="col-md-3">
						<div class="sidebar_widget">
							<!-- SIDE SUBMIT FORM START-->
							<div class="side_submit_form">
								<h4 class="sidebar_title">Get In Touch</h4>
								<form action="{{url('send-guest-message')}}" method="post">
									{{ csrf_field() }}
									<div class="side_submit_field">
										<input type="text" name="name" placeholder="Name" required>
										<input type="text" name="email" placeholder="Email" required>
										<input type="text" name="phoneNumber" placeholder="Phone Number">
										<input type="text" name="subject" placeholder="Subject" required>
										<textarea name="message" placeholder="Enter Your Message Here" required></textarea>
										<button class="theam_btn btn2" type="submit" style="background-color: #083b5b !important;
										padding: 10px !important;">Submit Now</button>
									</div>
								</form>
							</div>
						</div>
						<!-- SIDE CONTACT INFO START-->
						<div class="side_contact_info">
							<h4 class="sidebar_title">key Contact</h4>
							@php
								$contact = \App\Contact::first();
								
							@endphp
							<ul class="side_contact_list">
								<li>
									<div class="side_contact_text">
										<h6><i class="fa fa-tty"></i>Phone Number</h6>
										<a href="#">{{$contact->phone1}}</a>
										<a href="#">{{$contact->phone2}}</a>
									</div>
								</li>
								<li>
									<div class="side_contact_text">
										<h6><i class="fa fa-envelope"></i>Email Address</h6>
										<a href="#">info@techfocusltd.com</a>
										<a href="#">{{$contact->email}}</a>
									</div>
								</li>
								<li>
									<div class="side_contact_text">
										<h6><i class="fa fa-phone"></i>Address</h6>
										<p>{{$contact->address}}</p>
									</div>
								</li>
							</ul>
						</div>
						<!-- SIDE CONTACT INFO END-->
						@php
							$profile = \App\Profile::orderBy('created_at', 'Desc')->first();
						@endphp
						<!-- Data sheet start -->
						<div class="side_notice_list">
							<h4 class="sidebar_title">Public Notice</h4>
							<ul class="side_notice_row">
								<li>
									<div class="side_notice_detail">
										<a href="#"><i class="fa icon-pdf"></i></a>
										<div class="side_notice_text">
											<h6><a href="{{asset('storage/profile/'.$profile->profile)}}" target="_blank">Download Profile</a></h6>
											<span>Last Update : {{$profile->updated_at->format('d-m-y')}}</span>
										</div>
									</div>
								</li>
								<li>
									<div class="side_notice_detail">
										<a href="#"><i class="fa icon-pdf"></i></a>
										<div class="side_notice_text">
											<h6><a href="{{asset('storage/profile/'.$profile->brochure)}}" target="_blank">Download Brochure</a></h6>
											<span>Last Update : {{$profile->updated_at->format('d-m-y')}}</span>
										</div>
									</div>
								</li>
								<li>
									<div class="side_notice_detail">
										<a href="#"><i class="fa icon-pdf"></i></a>
										<div class="side_notice_text">
											<h6><a href="{{asset('storage/profile/'.$profile->dataSheet)}}" target="_blank">Download DataSheet</a></h6>
											<span>Last Update : {{$profile->updated_at->format('d-m-y')}}</span>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<!-- DataSheet end -->
					</div>
					<div class="col-md-9">
						<!-- Product details tab start -->
						<ul class="nav nav-tabs">
							<li><a data-toggle="tab" href="#shortDescription">Short Descriotion</a></li>
							<li class="active"><a data-toggle="tab" href="#description">Description</a></li>
							<li><a data-toggle="tab" href="#specification">Specification</a></li>
						</ul>

						<div class="tab-content city_health2_text text2 margin30">
							<div id="shortDescription" class="tab-pane fade">
								<p>{!!$product->shortDescription!!}</p>
							</div>
							<div id="description" class="tab-pane fade in active">
								<p>{!!$product->description!!}</p>
							</div>
							<div id="specification" class="tab-pane fade">
								<p>{!!$product->specification!!}</p>
							</div>
						</div>
						<!-- Product details end -->
						<!-- related brand/ Solution/ Industry product start -->
						<div class="city_health2_text text2 margin30">
							<div class="row">
								<div class="col-md-6">
									<div class="sidebar_widget">
										<div class="side_notice_list">
											<h6 class="sidebar_title">Brand Related Products</h6>
											<!-- CITY EMERGENCY SLIDER START-->
											<div class="city_emergency_slider">
												@php
													$bProducts = \App\Product::where('brand_id', $product->brand_id)->get();
												@endphp
												<div class="city-emergency-slide">
													@foreach ($bProducts as $item)
														<div>
															<div class="city_emergency_slide_fig">
																<figure class="">
																	<div class="box-layer layer-1"></div>
																	<div class="box-layer layer-2"></div>
																	<div class="box-layer layer-3"></div>
																	<img src="{{asset('storage/images/product/'.$item->image->image1)}}" alt="" style="width: 100px; height:100px;">
																</figure>
																<div class="city_emergency_slide_text">
																	<a class="block-text" href="{{url('product-info/'.$item->id.'/'.$item->slug)}}">{{substr($item->productName,0,15)}}</a>
																</div>
															</div>
														</div>
													@endforeach
												</div>
											</div>
											<!-- CITY EMERGENCY SLIDER END-->
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="sidebar_widget">
										<div class="side_notice_list">
											<h6 class="sidebar_title">Solution Related Products</h6>
											<!-- CITY EMERGENCY SLIDER START-->
											<div class="city_emergency_slider">
												@php
													$sProducts = \App\Product::where('solution_id', $product->solution_id)->get();
												@endphp
												<div class="city-emergency-slide">
													@foreach ($sProducts as $sProduct)
														<div>
															<div class="city_emergency_slide_fig">
																<figure class="">
																	<div class="box-layer layer-1"></div>
																	<div class="box-layer layer-2"></div>
																	<div class="box-layer layer-3"></div>
																	<img src="{{asset('storage/images/product/'.$sProduct->image->image1)}}" alt="" style="width: 100px; height:100px;">
																</figure>
																<div class="city_emergency_slide_text">
																	<a class="block-text" href="{{url('product-info/'.$sProduct->id.'/'.$sProduct->slug)}}">{{substr($sProduct->productName,0,15)}}</a>
																</div>
															</div>
														</div>
													@endforeach
													
												</div>
											</div>
											<!-- CITY EMERGENCY SLIDER END-->
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="sidebar_widget">
										<div class="side_notice_list">
											<h6 class="sidebar_title">Industry Related Products</h6>
											<!-- CITY EMERGENCY SLIDER START-->
											<div class="city_emergency_slider">
												@php
													$iProducts = \App\Product::where('industry_id', $product->industry_id)->get();
												@endphp
												<div class="city-emergency-slide">
													@foreach ($iProducts as $iProduct)
														<div>
															<div class="city_emergency_slide_fig">
																<figure class="">
																	<div class="box-layer layer-1"></div>
																	<div class="box-layer layer-2"></div>
																	<div class="box-layer layer-3"></div>
																	<img src="{{asset('storage/images/product/'.$iProduct->image->image1)}}" alt="" style="width: 170px; height:170px;">
																</figure>
																<div class="city_emergency_slide_text">
																	<a class="block-text" href="{{url('product-info/'.$iProduct->id.'/'.$iProduct->slug)}}">{{substr($iProduct->productName,0,15)}}</a>
																</div>
															</div>
														</div>
													@endforeach
													
												</div>
											</div>
											<!-- CITY EMERGENCY SLIDER END-->
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- related brand product end -->
						<!-- Related Product start -->
							{{-- <div class="city_health2_text text2 margin30">
								<div class="section_heading center">
									<span>{{$product->solution->solutionName}} Solution </span>
									<h4>Related Product</h4>
								</div>
								@php
									$relatedProducts = \App\Product::select('productName', 'id', 'slug')->where('solution_id', $product->solution_id)->take(4)->get();
								@endphp
								@foreach ($relatedProducts as $item)
									<div class="col-md-3 col-sm-3">
										<div class="city_team_fig">
											<figure class="overlay">
												<img src="{{asset('storage/images/product/'.$item->image->image1)}}" alt="" style=" width: 200px; height: 200px;!important">
												<a class="paly_btn" data-rel="prettyPhoto" href="{{asset('storage/images/product/'.$item->image->image1)}}"><i class="fa fa-plus"></i></a>

											</figure>
											<div class="city_team_text">
												<h4><a href="{{url('product-info/'.$item->id.'/'.$item->slug)}}">{{$item->productName}}</a></h4>
											</div>
										</div>
									</div>
								@endforeach
							</div> --}}
						<!-- Related product end -->

						<!-- FQA Start -->
						<div class="city_health2_text text2 margin0">
							<!--SECTION HEADING START-->
							<div class="section_heading margin30">
								<h3> Asked Question</h3>
							</div>
							<!--SECTION HEADING END-->
							@php
								$faqs = \App\Faq::orderBy('created_at', 'asc')->get();
								$faqsDesc = \App\Faq::orderBy('created_at', 'Desc')->get();
								$number = count($faqs);
							@endphp
							<!--Start .accordion-->
							<div class="row">
								<div class="col-md-6">
									<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
										@foreach ($faqs->take($number/2) as $item)
											<div class="panel panel-default">
												<div class="panel-heading" role="tab" id="heading{{$item->id}}" style="padding:unset">
												<h4 class="panel-title">
													<a class="accordion-section-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
													{{$item->question}}
													</a>
												</h4>
												</div>
												<div id="collapse{{$item->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$item->id}}">
												<div class="panel-body">
													{!!$item->answer!!}
												</div>
												</div>
											</div>
										@endforeach
									</div>
								</div>
								<div class="col-md-6">
									<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
										@foreach ($faqsDesc->take($number/2) as $item)
											<div class="panel panel-default">
												<div class="panel-heading" role="tab" id="heading{{$item->id}}" style="padding:unset">
												<h4 class="panel-title">
													<a class="accordion-section-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
													{{$item->question}}
													</a>
												</h4>
												</div>
												<div id="collapse{{$item->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$item->id}}">
												<div class="panel-body">
													{!!$item->answer!!}
												</div>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							</div>
							<!--end .accordion-->
						</div>
						<!-- FQA End -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- CITY EVENT2 WRAP END-->
@endsection