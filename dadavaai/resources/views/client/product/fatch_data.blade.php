
        <div class="row text-center hvr2 clearfix">
                @foreach ($products as $productGrid)
                    <div class="col-md-4 col-sm-6">
                        <div class="portfolio-wrapper">
                            <div class="portfolio-thumb">
                                <img src="{{asset('storage/images/product/'.$productGrid->image->image1)}}" alt="">
                                <div class="portfolio-content">   
                                    <div class="pop-up-icon">                 
                                        <a class="center-link quick-view" data-toggle="modal"  data-target="#product-preview" title="Quick View" data-id="{{$productGrid->id}}" data-min_order_qty="{{$productGrid->min_order_qty}}" data-category="{{$productGrid->category->categoryName}}" data-brand="{{$productGrid->brand->brandName}}" data-slug="{{$productGrid->slug}}" data-name="{{$productGrid->productName}}" 
                                            data-image="{{asset('/storage/images/product/'.$productGrid->image->image1)}}" 
                                            data-desc="{{strip_tags($productGrid->shortDescription)}}" 
                                            @if ($productGrid->discount)
                                                @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                        
                                                    data-sale="{{number_format($productGrid->regularPrice-(($productGrid->regularPrice*($productGrid->deal->discount_value + $productGrid->discount))/100), 2)}}"

                                                    data-regular="{{$productGrid->regularPrice}}"
                                                            
                                                @else
                                                    data-sale="{{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->discount)/100), 2)}}"
                                                    data-regular="{{$productGrid->regularPrice}}"

                                                @endif
                                            @else
                                                @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                                    data-sale="{{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->deal->discount_value)/100), 2)}}"
                                                    data-regular="{{$productGrid->regularPrice}}"
                                                @else
                                                    data-regular="{{$productGrid->regularPrice}}"
                                                @endif
                                            @endif  
                                            data-url="{{url('product/'.$productGrid->id.'/'.$productGrid->slug)}}"><i class="fa fa-search"></i></a>

                                            <a href="#" class="left-link addWishlist" data-placement="top" data-slug="{{$productGrid->slug}}" title="Add To Wishlist" data-id="{{$productGrid->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></a>   
                                            <a href="#" class="right-link addCart" data-placement="top" data-slug="{{$productGrid->slug}}" title="Add To Cart" data-id="{{$productGrid->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="cart-icn"> </i></a>
                                    </div>                                                   
                                </div>
                            </div>
                            <div class="product-content">
                                <h3> <a class="title-3 fsz-12" href="{{url('product/'.$productGrid->id.'/'.$productGrid->slug)}}"> {{$productGrid->productName}} </a> </h3>
                                <p class="font-3">Price: 
                                    @if ($productGrid->discount)
                                        @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                            <span class="thm-clr"> Tk {{number_format($productGrid->regularPrice-(($productGrid->regularPrice*($productGrid->deal->discount_value + $productGrid->discount))/100), 2)}}</span>    
                                            <span class="thm-clr line-through"> Tk {{$productGrid->regularPrice}}</span>   
                                        @else
                                            <span class="thm-clr"> Tk {{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->discount)/100), 2)}}</span>
                                            <span class="thm-clr line-through"> Tk {{$productGrid->regularPrice}}</span>        
                                        @endif
                                    @else
                                        @if ($productGrid->deal_id && $productGrid->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                            <span class="thm-clr"> Tk {{number_format($productGrid->regularPrice-(($productGrid->regularPrice*$productGrid->deal->discount_value)/100), 2)}}</span>    
                                            <span class="thm-clr line-through"> Tk {{$productGrid->regularPrice}}</span>   
                                        @else
                                            <span class="thm-clr"> Tk {{$productGrid->regularPrice}}</span>    
                                        @endif
                                    @endif  
                                </p>    
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
        <a href="" id="categoryName" hidden>{{str_slug($singleCategory->categoryName)}}</a> 
        <a href="" id="cateroryId" hidden>{{$singleCategory->id}}</a> 
        <nav class="woocommerce-pagination">
            {{$products->links()}}
        </nav>


    <!-- Product List View -->
    {{-- <div id="list-view" class="tab-pane fade" role="tabpanel">
        <div class="cat-list-view">
            @foreach ($products as $productList)
                <div class="hvr2 row">
                    <div class="portfolio-wrapper">
                        <div class="col-md-4 col-sm-6">
                            <div class="portfolio-thumb">
                                <img src="{{asset('storage/images/product/'.$productList->image->image1)}}" alt="">
                                <div class="portfolio-content"> 
                                    <div class="pop-up-icon">                 
                                        <a class="center-link" href="#product-preview" data-toggle="modal"><i class="fa fa-search"></i></a>
                                        <a class="left-link" href="#"><i class="fa fa-heart"></i></a>   
                                        <a class="right-link" href="#"><i class="cart-icn"> </i></a>
                                    </div>                                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-6">
                            <div class="product-content">
                                <a class="title-3 fsz-16" href="{{url('product/'.$productList->id.'/'.$productList->slug)}}"> {{$productList->productName}} </a> 
                                <div class="rating">                                                              
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>                                           
                                    <span class="star"></span>
                                    <span class="star"></span>
                                </div>
                                <p class="font-3 line">Price:
                                    @if ($productList->discount)
                                        @if ($productList->deal_id)
                                            <span class="thm-clr">
                                                Tk {{number_format($productList->regularPrice-(($productList->regularPrice*($productList->deal->discount_value + $productList->discount))/100), 2)}}
                                            </span>    
                                            <span class="thm-clr line-through"> Tk {{$productList->regularPrice}}</span>   
                                        @else
                                            <span class="thm-clr">
                                                Tk {{number_format($productList->regularPrice-(($productList->regularPrice*$productList->discount)/100), 2)}}
                                            </span>
                                            <span class="thm-clr line-through"> Tk {{$productList->regularPrice}}</span>
                                        @endif
                                    @else
                                        @if ($productList->deal_id)
                                            <span class="thm-clr"> 
                                                Tk {{number_format($productList->regularPrice-(($productList->regularPrice*$productList->deal->discount_value)/100), 2)}}
                                            </span>    
                                            <span class="thm-clr line-through"> Tk {{$productList->regularPrice}}</span>   
                                        @else
                                            <span class="thm-clr"> Tk {{$productList->regularPrice}}</span>    
                                        @endif
                                    @endif 
                                </p> 
                                <p class="font-3"> Available:
                                    @if ($productList->availability == false)
                                    <span class="grn-clr"> In Stock </span>  
                                    @else
                                    <span class="red-clr"> Out of Stock </span>  
                                    @endif
                                </p>

                                <p> {!! $productList->shortDescription !!}</p>
                                <a class="fancy-btn fancy-btn-small" href="single-product.html">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="" id="cateroryName" hidden>{{str_slug($singleCategory->categoryName)}}</a> 
        <a href="" id="cateroryId" hidden>{{$singleCategory->id}}</a> 
        <nav class="woocommerce-pagination">
            {{$products->links()}}
        </nav>
    </div> --}}
    <!-- / Product List View -->

