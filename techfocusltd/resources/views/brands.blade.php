@extends('masterLayout')

@section('content')
		
		<section class="flat-breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumbs">
							<li class="trail-item">
								<a href="{{url('/')}}" title="">Home</a>
								<span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
							</li>
							<li class="trail-end">
								<a href="#" title="">Brands</a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<section class="flat-brand style4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title">
							<h3>Brands</h3>
						</div>
					</div><!-- /.col-md-12 -->
					<div class="col-md-12">
						<ul class="brands-tablist">
							<li data-filter="*" class="active">All</li>
							<li data-filter=".a">A</li>
							<li data-filter=".b">B</li>
							<li data-filter=".c">C</li>
							<li data-filter=".d">D</li>
							<li data-filter=".e">E</li>
							<li data-filter=".f">F</li>
							<li data-filter=".g">G</li>
							<li data-filter=".h">H</li>
							<li data-filter=".i">I</li>
							<li data-filter=".j">J</li>
							<li data-filter=".k">K</li>
							<li data-filter=".l">L</li>
							<li data-filter=".m">M</li>
							<li data-filter=".n">N</li>
							<li data-filter=".o">O</li>
							<li data-filter=".p">P</li>
							<li data-filter=".q">Q</li>
							<li data-filter=".r">R</li>
							<li data-filter=".s">S</li>
							<li data-filter=".t">T</li>
							<li data-filter=".u">U</li>
							<li data-filter=".v">V</li>
							<li data-filter=".w">W</li>
							<li data-filter=".x">X</li>
							<li data-filter=".y">Y</li>
							<li data-filter=".z">Z</li>
						</ul><!-- /.brands-tablist -->
						<div class="brands-list grid">
						  @foreach($brands as $brand)
							<div class="brands-item ipsotope {{strtolower(substr($brand->brandName, 0, 1))}}">
								
								<a href="{{URL::to('/productsByBrand/'.$brand->id)}}" class="box-cat" title="" style="padding: 10px 0 10px;">
									<div>
										@if (!empty($brand->image))
											<img src="{{asset('storage/images/brand/logo/'.$brand->image)}}" alt="" style="height: 100px; width:150px;">
										@endif
									</div>
									<div class="cat-name">
										{{$brand->brandName}}
									</div>
									<div class="numb-product">
									<?php $i = 0; ?>
									@foreach($brand->product as $product)
									<?php $i++; ?>
									@endforeach
									{{$i}} Product
									</div>
								</a>
							</div><!-- /.brands-item ipsotope -->
						  @endforeach
							<div class="clearfix"></div>
						</div><!-- /.brands-list grid -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-brand style4 -->

@endsection