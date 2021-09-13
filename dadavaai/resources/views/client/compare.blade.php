@extends('layouts.client')

@section('title')
    <title>Dadavaai | compare </title>
@endsection
@php
$currentTime = \Carbon\Carbon::now()->format('d-m-Y');
@endphp

@section('content')
<div class="site-pagetitle jumbotron">
    <div class="container  theme-container">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="breadcrumbs">
                <i class="fa fa-home"></i>
                <span><a href="{{url('/')}}">Home</a></span>
                <i class="fa fa-arrow-circle-right"></i>
                <span class="current red-clr"> Compare </span>
            </div>
        </div>
    </div>
</div>
 <!-- Main Container --> 
  <section class="main-container col1-layout">
    <div class="main container">
      <div class="col-main">
          <br>
        <div class="compare-list">
            @if(Session::has('tab'))
            <header class="entry-header diblock spc-15" style="padding:10px; border: solid 1px #aaaaaa;">
                <!-- Post Title -->
                    @php
                        $tab_sessions = \Illuminate\Support\Facades\Session::get('tab'); 
                        // dd($tab_sessions);  
                    @endphp
                    @if ($tab_sessions)
                        @foreach ($tab_sessions as $tab_session)
                        @php
                            $tab = \App\Tab::find($tab_session['tab_id']);
                        @endphp
                            <div class="text-center inline">
                                <a class="btn btn-default" href="{{url('tabCompare?tab_id='.$tab->id)}}" data-placement="top" title="Book now">
                                    {{$tab->tabName}}
                                </a>
                            </div>
                        @endforeach
                    @endif
            </header>
            @endif
            <br><br>
            @if(count($compares))  
                @foreach($compares as $compare)
                    @php
                        $tab_id = $compare->product->tab_id ;
                    @endphp
                @endforeach

                @php
                    $products = \App\Product::where('tab_id', $tab_id)->get();
                @endphp

                <div class="table-responsive fsz-13">
                    <table class="table table-responsive table-bordered table-compare">
                        <tr class="text-center">
                            <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px; ">Product Name</th>
                            @foreach($compares as $compare)
                                <td class="blklt-clr" style="vertical-align:middle!important;">
                                    <a href="{{url('product/'.$compare->product->id.'/'.$compare->product->slug)}}">{{$compare->product->productName}}</a>
                                </td>
                            @endforeach
                            <td class="blklt-clr" style="vertical-align:middle!important;">
                                <h2 class="fsz-15 title-3 drk-gry pull-right">
                                    <select class="" name="product_id" id="addPreductToCompare" style="padding: 5px;">
                                        <option value="" selected>Add More Product</option>
                                            @foreach ($products as $product)
                                                <option value="{{$product->id}}">
                                                    <a href="{{url('addCompare/'.$product->id)}}" class="compare left-link red-clr" title="" data-comparelist="{{url('addCompare/'.$product->id)}}">{{substr($product->productName,0,26)}}</a>
                                                </option>
                                            @endforeach
                                    </select>
                                </h2>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px; ">Product Image</th>
                            @foreach($compares as $compare)
                                <td class="blklt-clr" style="vertical-align:middle!important;">
                                    <a href="#"><img src="{{asset('storage/images/product/'.$compare->product->image->image1)}}" alt="Product" height="230px" width="230px"></a>
                                </td>
                            @endforeach
                            <td class="blklt-clr" style="vertical-align:middle!important;">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px; ">Price</th>
                            @foreach($compares as $compare)
                                <td class="blklt-clr price" style="vertical-align:middle!important;">
                                    @if ($compare->product->discount)
                                        @if ($compare->product->deal_id && $compare->product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                            <span class="thm-clr">
                                                Tk {{number_format($compare->product->regularPrice-(($compare->product->regularPrice*($compare->product->deal->discount_value + $compare->product->discount))/100), 2)}}
                                            </span>    
                                            <span class="thm-clr line-through"> Tk {{$compare->product->regularPrice}}</span>   
                                        @else
                                            <span class="thm-clr">
                                                Tk {{number_format($compare->product->regularPrice-(($compare->product->regularPrice*$compare->product->discount)/100), 2)}}
                                            </span>
                                            <span class="thm-clr line-through"> Tk {{$compare->product->regularPrice}}</span>
                                        @endif
                                    @else
                                        @if ($compare->product->deal_id && $compare->product->deal->valid_until >= \Carbon\Carbon::parse($currentTime)->format('Y-m-d'))
                                            <span class="thm-clr"> 
                                                Tk {{number_format($compare->product->regularPrice-(($compare->product->regularPrice*$compare->product->deal->discount_value)/100), 2)}}
                                            </span>    
                                            <span class="thm-clr line-through"> Tk {{$compare->product->regularPrice}}</span>   
                                        @else
                                            <span class="thm-clr"> Tk {{$compare->product->regularPrice}}</span>    
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                            <td class="blklt-clr" style="vertical-align:middle!important;">
                            </td>
                            
                        </tr>

                        <tr class="text-center">
                            <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px; ">Brand</th>
                            @foreach($compares as $compare)
                                <td class="blklt-clr" style="vertical-align:middle!important;"> {{$compare->product->brand->brandName}}</td>
                            @endforeach
                            <td class="blklt-clr" style="vertical-align:middle!important;">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px; ">Secification</th>
                            @foreach($compares as $compare)
                                <td class="blklt-clr" style="vertical-align:middle!important;"> 
                                    <p class=" blklt-clr">
                                        {{substr(strip_tags($compare->product->specification), 0, 85)}}...
                                        <a href="{{url('product/'.$compare->product->id.'/'.$compare->product->slug.'#specification')}}"> 
                                            <span class="" style="color: red;!important">more</span> 
                                        </a> 
                                    </p>
                                </td>

                            @endforeach
                            <td class="blklt-clr" style="vertical-align:middle!important;">
                            </td>
                        </tr>
                    
                        <tr class="text-center">
                            <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px; ">Size</th>
                            @foreach($compares as $compare)
                                <td class="blklt-clr" style="vertical-align:middle!important;">
                                    <p>
                                        @php
                                            $size_length = count($compare->product->sizes);
                                            $i = 0;

                                        @endphp
                                        @foreach($compare->product->sizes as $size)
                                            {{$size->size}}
                                            @if($i < $size_length-1)
                                                ,
                                            @endif

                                            @php
                                                $i++;
                                            @endphp

                                        @endforeach

                                    </p>
                                </td><!-- /.size -->
                            @endforeach
                            <td class="blklt-clr" style="vertical-align:middle!important;">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px; ">Color</th>
                            @foreach($compares as $compare)
                                <td class="blklt-clr" style="vertical-align:middle!important;">
                                    <p>
                                        @php
                                            $color_length = count($compare->product->colors);
                                            $i = 0;

                                        @endphp
                                        @foreach($compare->product->colors as $color)
                                            {{$color->color}}
                                            @if($i < $color_length-1)
                                                ,
                                            @endif

                                            @php
                                                $i++;
                                            @endphp

                                        @endforeach
                                    </p>
                                </td><!-- /.color -->
                            @endforeach
                            <td class="blklt-clr" style="vertical-align:middle!important;">
                            </td>
                        </tr>        
                        <tr class="text-center">
                            <th class="compare-label blk-clr" style="vertical-align:middle!important; background: #edebeb; padding: 25px; ">Action</th>
                            @foreach($compares as $compare)
                                <td class="blklt-clr action" style="vertical-align:middle!important;">
                                    
                                    {{-- <button class="fancy-button add-cart button button-sm addCart" data-placement="top" data-slug="{{$compare->product->slug}}" title="Add To Cart" data-id="{{$compare->product->id}}" data-url="{{url('/add-cart')}}" data-qty="1"><i class="fa fa-shopping-cart"></i></button>
                                    <button class="fancy-button button button-sm addWishlist" data-placement="top" data-slug="{{$compare->product->slug}}" title="Add To Wishlist" data-id="{{$compare->product->id}}" data-url="{{url('/add-to-wishlist')}}"><i class="fa fa-heart"></i></button> --}}
                                    {{-- <button class="fancy-button button button-sm"><i class="fa fa-close"></i></button> --}}
                                    <a class="" href="{{url('deleteCompare/'.$compare->id)}}" onclick="return confirm('Are you sure want to delete this data?')" title="" 
                                        style="padding: 3px 3px 3px 3px;"><i class="fa fa-close"></i></a>
                                </td>
                            @endforeach
                            <td class="blklt-clr" style="vertical-align:middle!important;">
                            </td>
                        </tr>
                    </table>
            
                </div>
            @else
                <div class="alert alert-danger">
                <h1 style="text-align:center">Your Compare list is empty! Add product to compare list to compare them.</h1>
                </div>
            @endif
        </div>
        <br><br>
      </div>
    </div>
  </section>
@endsection