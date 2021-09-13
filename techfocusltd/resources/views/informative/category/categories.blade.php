@extends('informative.layouts.master')
@section('content')
    			<!-- SAB BANNER START-->
			<div class="sab_banner overlay">
				<div class="container">
					<div class="sab_banner_text">
						<h2>Categories</h2>
						<ul class="breadcrumb">
						  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						  <li class="breadcrumb-item active">Category</li>
						</ul>
                    </div>
				</div>
			</div>
			<!-- SAB BANNER END-->
			<!-- All Solution  WRAP START-->
			<div class="city_services2_wrap">
				<div class="container">
					<div class="row">
                        @foreach ($categories as $category)
						@if (count($category->product)>0)
							<div class="col-md-4 col-sm-6">
								<div class="city_service2_fig">
									<figure >
										@if ($category->categoryImage2)
											<img src="{{asset('storage/images/category/'.$category->categoryImage2)}}" alt="" style="height:250px">
										@else
											<img src="{{asset('informative/extra-images/cables_&_accessories.jpg')}}" alt="">
										@endif
										
                                        
										{{-- <img src="{{asset('storage/images/icons/menu/'.$category->categoryImage)}}" alt=""> --}}
										<div class="city_service2_list">
											{{-- <span><i class="fa icon-law-2"></i></span> --}}
											<div class="city_service2_caption">
												<h4>{{$category->categoryName}}</h4>
											</div>
										</div>
									</figure>
									<div class="city_business_list">
										<ul class="city_busine_detail">
											@foreach ($category->product->take(3) as $item)
												<li><a href="{{url('product-info/'.$item->id.'/'.$item->slug)}}"><i class="fa fa-star-o"></i><span class="block-text">{{substr($item->productName,0,26)}} </span></a></li>
											@endforeach
										</ul>
										<a class="see_more_btn" href="{{url('products-by-cat/'.$category->id)}}">See More <i class="fa icon-next-1"></i></a>
									</div>
								</div>
							</div>                           
                            @endif
						@endforeach
					</div>
				</div>	
			</div>
			<!-- All Solution WRAP END-->
@endsection