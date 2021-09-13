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
								<a href="#" title="">Product Compare</a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<section class="flat-compare">
			<div class="container">
			@if(!$compares->isEmpty())
				<div class="row">
					<div class="col-md-12">
						<div class="wrap-compare">
							<div class="title">
								<h3>Compare</h3>
							</div>
							<div class="compare-content">
								<table class="table-compare">
									<thead>
										<tr>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>Product</th>
											@foreach($compares as $compare)
											<td class="product">
												<a href="{{URL::to('/productDetails/'.$compare->product->slug)}}">
													<div class="image">
														<img src="{{asset('storage/images/product/'.$compare->product->image->image1)}}" alt="" height="300px" width="300px">
													</div>
													<div class="name">
														{{$compare->product->productName}}
													</div>
												</a>
											</td><!-- /.product -->
											@endforeach
										</tr>
										<tr>
											<th>Price</th>
											@foreach($compares as $compare)
											<td class="price">
												@if($compare->product->price)
												৳ {{number_format($compare->product->price)}}
												@else
													<a href="#" data-subject="Price quotation for {{$compare->product->productName}}" data-message="I would like to know the price of {{$compare->product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<th>Add to Cart</th>
											@foreach($compares as $compare)
											<td class="add-cart">
												@if($compare->product->price)
												<a href="{{URL::to('/addCart/'.$compare->product_id)}}" title=""><img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart</a>
												@else
												<p style="color: red">N/A</p>
												@endif
											</td><!-- /.add-cart -->
											@endforeach
										</tr>
										<tr>
											<th>Description</th>
											@foreach($compares as $compare)
											<td class="description">
												<p class="more text-justify">
													{{strip_tags($compare->product->description)}}...
												</p>
											</td><!-- /.description -->
											@endforeach
										</tr>
										<tr>
											<th>Color</th>
											@foreach($compares as $compare)
											<td class="color">
												<p>
													@if (count($compare->product->colors)>0)
														@foreach($compare->product->colors as $color)
															{{$color->color}}
														@endforeach
													@else
														--
													@endif
												
												</p>
											</td><!-- /.color -->
											@endforeach
										</tr>
										<tr>
											<th>Size</th>
											@foreach($compares as $compare)
												<td class="color">
													<p>
														@if (count($compare->product->sizes)>0)
															@foreach($compare->product->sizes as $size)
																{{$size->size}}
															@endforeach
														@else
															--
														@endif
													</p>
												</td><!-- /.color -->
											@endforeach
										</tr>
										<tr>
											<th>Tag</th>
											@foreach($compares as $compare)
												<td class="color">
													<p>
														@if (count($compare->product->tags)>0)
															@foreach($compare->product->tags as $tag)
																{{$tag->tag}}
															@endforeach
														@else
															--
														@endif
														
													</p>
												</td><!-- /.color -->
											@endforeach
										</tr>
										<tr>
											<th>Stock</th>
											@foreach($compares as $compare)
												@if ($compare->product->availablity == 0)
												<td class="stock">
													<p>
														In stock
													</p>
												</td><!-- /.stock -->
												@else
												<td class="stock">
													<p>
														Out of stock
													</p>
												</td><!-- /.stock -->
												@endif
											@endforeach
										</tr>
										<tr>
											<th>Specification</th>
											@foreach($compares as $compare)
												<td class="description">
													<p class="more text-justify">
														{{strip_tags($compare->product->specification)}}
													</p>
												</td><!-- /.description -->
											@endforeach
										</tr>
										<tr>
											<th>Delete</th>
											@foreach($compares as $compare)
											<td class="delete">
												<a href="{{URL::to('deleteCompare/'.$compare->id)}}" onclick="return confirm('Are you sure want to delete this data?')" title="">
													<img src="{{asset('images/icons/delete.png')}}" alt="">
												</a>
											</td><!-- /.delete -->
											@endforeach
										</tr>
									</tbody>
								</table><!-- /.table-compare -->
							</div><!-- /.compare-content -->
						</div><!-- /.wrap-compare -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			@else
				<div class="alert alert-danger">
				<h1 style="text-align:center">Your Compare list is empty! Add product to compare list to compare them.</h1>
				</div>
				<div class="box-cart style2" style="text-align:center">
					<div class="btn-add-cart">
						<a href="{{URL::to('/home')}}" title="">
							<img src="{{asset('images/icons/add-cart.png')}}" alt="">Continue Shopping
						</a>
					</div>
				</div><!-- /.box-cart -->
			@endif
			</div><!-- /.container -->
		</section><!-- /.flat-compare -->

@endsection
@section('script')
<script>
    jQuery(document).ready(function($){
        var showChar = 95;
        var ellipsestext = "...";
        var moretext = "more";
        var lesstext = "less";
        $('.more').each(function() {
        var content = $(this).html();
        var textcontent = $(this).text();

        if (textcontent.length > showChar) {

            var c = textcontent.substr(0, showChar);
            var h = content.substr(showChar-1, content.length - showChar);

            var html = '<span class="container"><span>' + c + '</span>' + '<span class="moreelipses">' + ellipsestext + '</span></span><span class="morecontent hide"> ' + content + '</span>';

            $(this).html(html);
            $(this).after('<a href="" class="morelink theam_btn bg-color color">' + moretext + '</a>');
        }

        });

        $(".morelink").click(function() {
        if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
            $(this).prev().children('.morecontent').fadeToggle(500, function(){
            $(this).prev().fadeToggle(500);
            });
        
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
            $(this).prev().children('.container').fadeToggle(500, function(){
            $(this).next().fadeToggle(500);
            });
        }
        // $(this).prev().children().fadeToggle();
        // $(this).parent().prev().prev().fadeToggle(500);
        // $(this).parent().prev().delay(600).fadeToggle(500);
        
        return false;
        });
    });
</script>
@endsection