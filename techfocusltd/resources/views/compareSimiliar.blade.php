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
                                        @foreach($products as $product)
                                            <td class="product">
                                                <div class="image">
                                                    <img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="" height="300px" width="300px">
                                                </div>
                                                <div class="name">
                                                    {{$product->productName}}
                                                </div>
                                            </td><!-- /.product -->
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        @foreach($products as $product)
                                            <td class="price">
                                            @if($product->price)
                                                ৳ {{number_format($product->price)}}
                                            @else
                                                    <a href="#" data-subject="Price quotation for {{$product->productName}}" data-message="I would like to know the price of {{$product->productName}}." class="btn btn-warning btn-sm quotation" title="" >Ask for Quotation</a>
                                            @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Add to Cart</th>
                                        @foreach($products as $product)
                                            <td class="add-cart">
                                                @if($product->price)
                                                <a href="{{URL::to('/addCart/'.$product->id)}}" title=""><img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart</a>
                                                @else
                                                <p style="color: red">N/A</p>
                                                @endif
                                            </td><!-- /.add-cart -->
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        @foreach($products as $product)
                                            <td class="description">
                                                <p>
                                                    {{substr(strip_tags($product->description), 0, 118)}}...
                                                </p>
                                            </td><!-- /.description -->
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Color</th>
                                        @foreach($products as $product)
                                            <td class="color">
                                                <p>
                                                    @foreach($product->colors as $color)
                                                        {{$color->color}}
                                                    @endforeach
                                                </p>
                                            </td><!-- /.color -->
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Size</th>
                                        @foreach($products as $product)
                                            <td class="color">
                                                <p>
                                                    @foreach($product->sizes as $size)
                                                        {{$size->size}}
                                                    @endforeach
                                                </p>
                                            </td><!-- /.color -->
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Tag</th>
                                        @foreach($products as $product)
                                            <td class="color">
                                                <p>
                                                    @foreach($product->tags as $tag)
                                                        {{$tag->tag}}
                                                    @endforeach
                                                </p>
                                            </td><!-- /.color -->
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Stock</th>
                                        @foreach($products as $product)
                                            @if ($product->availablity == 0)
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
                                        @foreach($products as $product)
                                            <td class="description">
                                                <p>
                                                    {{substr(strip_tags($product->specification), 0, 118)}}...
                                                </p>
                                            </td><!-- /.description -->
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table><!-- /.table-compare -->
                        </div><!-- /.compare-content -->
                    </div><!-- /.wrap-compare -->
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.flat-compare -->

@endsection