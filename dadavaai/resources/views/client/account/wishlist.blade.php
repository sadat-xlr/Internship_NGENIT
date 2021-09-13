@extends('layouts.client')

@section('title')
    <title>Dadavaai | Client Wishlist </title>
@endsection

@section('content')
        <!-- CONTENT + SIDEBAR -->
        <div class="main-wrapper clearfix">
            <div class="site-pagetitle jumbotron">
                <div class="container  theme-container">
                    <!-- Breadcrumbs -->
                    <div class="breadcrumbs">
                        <div class="breadcrumbs">
                            <i class="fa fa-home"></i>
                            <span><a href="{{url('/')}}">Home</a></span>
                            <i class="fa fa-arrow-circle-right"></i>
                            <span> Client </span>
                            <i class="fa fa-arrow-circle-right"></i>
                            <span class="current red-clr"> Wishlist </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="theme-container container">
                <div class="gst-spc3 row">

                    @include('client.account.sidebar')


                    <main class="col-md-9 col-sm-8 blog-wrap">
                        <div class="heading-2"> <h3 class="title-3 fsz-15">Wishlist</h3> </div>                                

                        @if ($wishlists)
                                <table class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wishlists as $wishlist)
                                            <tr class="cart_item" id="wishlist{{$wishlist->id}}">
                                                <td class="product-thumbnail">
                                                    <a href="#">
                                                        <img  src="{{asset('storage/images/product/'.$wishlist->product->image->image1)}}" alt="poster_2_up" />
                                                    </a>
                                                </td>
                                                <td class="product-name">
                                                    <div class="cart-product-title">
                                                        <a href="{{url('product/'.$wishlist->product->id.'/'.$wishlist->product->slug)}}">{{$wishlist->product->productName}}</a>
                                                    </div>
                                                    <p class="fsz-5 ">{{$wishlist->product->category->categoryName}}</p>
                                                </td>

                                                <td class="product-price">                                                    
                                                    <p class="font-3 fsz-15 no-mrgn"> 
                                                        @if ($wishlist->product->salePrice)
                                                            <b class="amount blk-clr">Tk {{$wishlist->product->salePrice}}</b> 
                                                            <del>Tk {{$wishlist->product->regularPrice}}</del> 
                                                        @else
                                                            <b class="amount blk-clr">Tk {{$wishlist->product->regularPrice}}</b>                                                 
                                                        @endif
                                                    </p>
                                                    {{-- <p class="fsz-14 no-mrgn"> <b class="gray-clr">Special Offers: </b> <b class="blk-clr">Discount 50%</b> </p> --}}
                                                </td>

                                                <td class="product-subtotal">
                                                    <a href="#" class="single_add_to_cart_button button alt fancy-button-blk addCart" data-placement="top" data-slug="{{$wishlist->product->slug}}" title="Add To Cart" data-id="{{$wishlist->product->id}}" data-url="{{url('/add-cart')}}" data-qty="1">Add to cart</a>
                                                    <a href="#" class="remove deleteWishlist" data-id="{{$wishlist->id}}" data-url="{{url('delete-from-wishlist')}}" title="Remove this item"> <i class="fa-times fa"></i> </a>
                                                </td>
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                        @else
                            <p class="text-center alert alert-danger">Your Wishlist is empty!</p>
                        @endif
                    </main>  

                </div>
            </div>

            <div class="clear"></div>
        </div>
        <!-- / CONTENT + SIDEBAR -->
@endsection