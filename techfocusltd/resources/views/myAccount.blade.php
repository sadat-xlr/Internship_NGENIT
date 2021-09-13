@extends('masterLayout')

@section('content')

        <style>
            .nav-link{
                padding: 0;
            }
        </style>

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
								<a href="#" title="">My Account</a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->
		
		<main id="shop">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="sidebar ">
							<div class="widget widget-categories">
								<div class="widget-title">
									<h3>My Account<span></span></h3>
								</div>
								<ul class="cat-list style1 widget-content">
									<!-- Nav tabs -->
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
                                    </li>
                                    <li class="nav-item">
										<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="order-details-tab" data-toggle="tab" href="#order-details" role="tab" aria-controls="order-details" aria-selected="false">Order Details</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="membership-type-tab" data-toggle="tab" href="#membership-type" role="tab" aria-controls="membership-type" aria-selected="false">Membership type</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="point-log-tab" data-toggle="tab" href="#point-log" role="tab" aria-controls="point-log" aria-selected="false">Point-log</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="offer-tab" data-toggle="tab" href="#offer" role="tab" aria-controls="offer" aria-selected="false">Offer & discount</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="wishlist-tab" data-toggle="tab" href="#wishlist" role="tab" aria-controls="wishlist" aria-selected="false">Wishlist</a>
									</li>
									<li><a href="{{URL::to('/cmrLogout')}}" title="">Logout</a></li>
								</ul><!-- /.cat-list -->
							</div><!-- /.widget-categories -->
						</div><!-- /.sidebar -->
					</div><!-- /.col-lg-3 col-md-4 -->
					<div class="col-lg-9 col-md-8">
						<!-- Tab panes -->
						<div class="tab-content">
                            <div class="tab-pane active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <!-- Small boxes (Stat box) -->
                                <div class="row">
                                    <div class="col-lg-4 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-ash">
                                            <div class="inner">
                                                <h3>{{$client->order->count()}}</h3>
                                                <p>Orders</p>
                                            </div>
                                            <div class="icon">
                                                <i class="zmdi zmdi-case"></i>
                                            </div>
                                            <a href="#order-details" data-toggle="tab" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-4 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-ash">
                                            <div class="inner">
                                                <h3>
                                                    @if($client->membership_type->membership_type  == 0)
                                                        Prime
                                                    @elseif($client->membership_type->membership_type  == 1)
                                                        Silver
                                                    @elseif($client->membership_type->membership_type  == 2)
                                                        Gold
                                                    @elseif($client->membership_type->membership_type  == 3)
                                                        Diamond
                                                    @else
                                                        Platinum
                                                    @endif
                                                </h3>
                                                <p>MemberShip Type</p>
                                            </div>
                                            <div class="icon">
                                                <i class="zmdi zmdi-account"></i>
                                            </div>
                                            <a href="#membership-type" data-toggle="tab"class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-4 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-ash">
                                            <div class="inner">
                                                <h3>{{$offers->count()+$deals->count()}}</h3>
                                                <p>Offers & deals</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-person-add"></i>
                                            </div>
                                            <a href="#offer" data-toggle="tab" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                </div>
                                <!--Small box ends-->
                                <!--Small box row2 start-->
                                <div class="row">
                                    <div class="col-lg-4 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-ash">
                                            <div class="inner">
                                                <h3>{{$client->wishlist->count()}}</h3>

                                                <p>Wishlist</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-person-add"></i>
                                            </div>
                                            <a href="#wishlist" data-toggle="tab" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-4 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-ash">
                                            <div class="inner">
                                                <h3>{{$client->promotional_reward_points}}</h3>
                                                <p>Point</p>
                                            </div>
                                            <div class="icon">
                                                <i class="zmdi zmdi-plus-circle"></i>
                                            </div>
                                            <a href="#point-log" data-toggle="tab" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-4 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-ash">
                                            <div class="inner">
                                                <h3>logout</h3>
                                                <p>logout</p>
                                            </div>
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <a href="{{URL::to('/cmrLogout')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                </div>
                                <!--Small box row2 ends-->
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="box-checkout">
                                    <form action="{{url('customers/'.\Illuminate\Support\Facades\Session::get('ID'))}}" method="post" class="checkout" accept-charset="utf-8" id="update-client">
                                        <input type="hidden" value="PUT" name="_method">
                                        <div class="billing-fields">
                                            <div class="fields-title">
                                                <h3>Privacy</h3>
                                                <span></span>
                                                <div class="clearfix"></div>
                                            </div><!-- /.fields-title -->
                                            <div class="fields-content">
                                                <div class="field-row">
                                                    <label class="control-label" for="email">Email :</label>
                                                    <input type="email" name="email" placeholder="Email address here..." value="{{$client->email}}" disabled>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="field-row">
                                                    <div class="field-one-half">
                                                        <label class="control-label" for="oldpassword">Old Password :</label>
                                                        <input type="text" name="oldpassword" placeholder="old password here...">
                                                    </div>
                                                    <div class="field-one-half">
                                                        <label class="control-label" for="password">New Password :</label>
                                                        <input type="text" name="password" placeholder="new password here..." value="">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="field-row">
                                                    <button id="updatePass">Update password</button>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="fields-title">
                                                <h3>Account details</h3>
                                                <span></span>
                                                <div class="clearfix"></div>
                                            </div><!-- /.fields-title -->
                                            <div class="fields-content">
                                                <div class="field-row">
                                                    <p class="field-one-half">
                                                        <label for="first-name">Name *</label>
                                                        <input type="text" name="customerName" value="{{$client->customerName}}">
                                                    </p>
                                                    <p class="field-one-half">
                                                        <label for="phone">Phone *</label>
                                                        <input type="number" name="phone" value="{{$client->phone}}">
                                                    </p>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="field-row">
                                                    <p class="field-one-half">
                                                        <label class="control-label" for="company">Company :</label>
                                                        <input type="text" name="company" placeholder="Company name here..." value="{{$client->company}}">
                                                    </p>
                                                    <p class="field-one-half">
                                                        <label class="control-label" for="office_email">Email (Office):</label>
                                                        <input type="email" name="office_email" placeholder="office_email here..." value="{{$client->office_email}}">
                                                    </p>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="field-row">
                                                    <p class="field-one-half">
                                                        <label for="company-name">Town / City *</label>
                                                        <select name="city">
                                                            <option value="">Select Town / City</option>
                                                            <option value="Dhaka" @if ($client->city == 'Dhaka') selected @endif>Dhaka</option>
                                                        </select>
                                                    </p>
                                                    <p class="field-one-half">
                                                        <label for="phone">State / Division *</label>
                                                        <select name="division">
                                                            <option value="">Select State</option>
                                                            <option value="Dhaka" @if ($client->division == 'Dhaka') selected @endif>Dhaka</option>
                                                        </select>
                                                    </p>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="field-row">
                                                    <p class="field-one-half">
                                                        <label>Country *</label>
                                                        <select name="country">
                                                            <option value="">Select Country</option>
                                                            <option value="Bangladesh" @if ($client->country == 'Bangladesh') selected @endif>Bangladesh</option>
                                                        </select>
                                                    </p>
                                                    <p class="field-one-half">
                                                        <label for="address">Address *</label>
                                                        <input type="text" name="address" value="{{$client->address}}">
                                                    </p>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="field-row">
                                                    <p class="field-one-half">
                                                        <label for="post-code">Postcode / ZIP *</label>
                                                        <input type="text" name="zipCode" value="{{$client->zipCode}}">
                                                    </p>
                                                    <p class="field-one-half">
                                                        <label class="control-label" for="office_phone">Phone(Office)</label>
                                                        <input type="text" name="office_phone" placeholder="Phone here..." value="{{$client->office_phone}}">
                                                    </p>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="field-row">
                                                    <button type="submit">Save changes</button>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div><!-- /.fields-content -->
                                        </div><!-- /.billing-fields -->
                                    </form><!-- /.checkout -->
                                </div><!-- /.box-checkout -->
                            </div>
							<div class="tab-pane" id="order-details" role="tabpanel" aria-labelledby="order-details-tab">
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ORDER ID</th>
                                                <th>DATE</th>
                                                <th>STATUS</th>
                                                <th>TOTAL</th>
                                                <th>DETAILS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($client->order as $order)
                                            @php $total_price = 0; @endphp
                                            @foreach($order->orderDetails as $orderDetail)
                                                @php
                                                    $price = 0;
                                                    foreach($orderDetail->product->deals as $deals){
                                                        if ($deals){
                                                            if ($deals->valid_until >= \Carbon\Carbon::now()){
                                                                $price = $orderDetail->product->price-(($orderDetail->product->price*$deals->discount_value)/100);
                                                            }
                                                        }
                                                    }

                                                    foreach($orderDetail->product->offers as $offers){
                                                        if ($offers){
                                                            if ($offers->valid_until >= \Carbon\Carbon::now()){
                                                                $price = $orderDetail->product->price-(($orderDetail->product->price*$offers->discount_value)/100);
                                                            }
                                                        }
                                                    }

                                                    if(isset($price) && $price != 0)
                                                        $proPrice = $price;
                                                    else
                                                        $proPrice = $orderDetail->product->price;

                                                    $unitPrice = $orderDetail->quantity * $proPrice;
                                                    $total_price += $unitPrice;
                                                @endphp
                                            @endforeach
                                            @if($order->discount_id != null)
                                                @php
                                                    $discount = \App\Discount::find($order->discount_id);
                                                if($discount->discount_unit == 0){
                                                $discount_val = ($total_price*$discount->discount_value)/100;
                                                    $total_price = $total_price - $discount_val;
                                                }
                                                elseif($discount->discount_unit  == 1){
                                                    $discount_val = $total_price - $discount->discount_value;
                                                    $total_price = $total_price - $discount_val;
                                                }
                                                else{
                                                    $discount_val = $total_price - $discount->discount_value;
                                                    $total_price = $total_price - $discount_val;
                                                }
                                                @endphp
                                            @endif
                                            <tr>
                                                <td>
                                                    {{$order->id}}
                                                </td>
                                                <td>{{$order->created_at}}</td>
                                                <td>
                                                    @if($order->status  == 0)
                                                        On hold
                                                    @elseif($order->status  == 1)
                                                        Processing
                                                    @elseif($order->status  == 2)
                                                        Pending payment
                                                    @elseif($order->status  == 3)
                                                        Completed
                                                    @elseif($order->status  == 4)
                                                        Cancelled
                                                    @elseif($order->status  == 4)
                                                        Refunded
                                                    @else
                                                        Failed
                                                    @endif
                                                </td>
                                                <td>৳{{$total_price+($total_price*0.15)+15}}</td>
                                                <td class="product-remove">
                                                    <a href="{{url('orders/'.$order->id)}}"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
							<div class="tab-pane" id="membership-type" role="tabpanel" aria-labelledby="membership-type-tab">
                                <div class="wishlist">
                                    <div class="title">
                                        <h3>Member type</h3>
                                    </div>
                                </div>
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Member type</th>
                                            <td>
                                                @if($client->membership_type->membership_type  == 0)
                                                    Prime
                                                @elseif($client->membership_type->membership_type   == 1)
                                                    Silver
                                                @elseif($client->membership_type->membership_type  == 2)
                                                    Gold
                                                @elseif($client->membership_type->membership_type   == 3)
                                                    Diamond
                                                @else
                                                    Platinum
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Discount type</th>
                                            <td>
                                                @if($client->membership_type->discount_unit == 0)
                                                    Percentage discount
                                                @elseif($client->membership_type->discount_unit  == 1)
                                                    Fixed cart discount
                                                @else
                                                    Fixed product discount
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Discount value</th>
                                            <td>{{$client->membership_type->discount_value}}</td>
                                        </tr>
                                        <tr>
                                            <th>Valid until</th>
                                            <td>
                                                {{$client->membership_type->valid_until}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Free shipping</th>
                                            <td>
                                                @if($client->membership_type->is_free_shipping_active == 0)
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
							<div class="tab-pane" id="point-log" role="tabpanel" aria-labelledby="point-log-tab">
                                <div class="wishlist">
                                    <div class="title">
                                        <h3>Point log</h3>
                                    </div>
                                </div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Promotional point</td>
                                            <td>{{$client->promotional_reward_points}}</td>
                                        </tr>
                                        <tr>
                                            <td>Non-promotional point</td>
                                            <td>{{$client->non_promotional_reward_points}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
							<div class="tab-pane" id="offer" role="tabpanel" aria-labelledby="offer-tab">
                                <section class="flat-imagebox style1">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="flat-row-title">
                                                    <h3>Offers & deals</h3>
                                                </div>
                                            </div><!-- /.col-md-12 -->
                                        </div><!-- /.row -->
                                        <div class="row ">
                                            <div class="col-md-12 owl-carousel-10">
                                                <div class="owl-carousel-item">
                                                @foreach($offers as $offer)
                                                    @foreach($offer->products as $product)
                                                        @php
                                                            $price = $product->price-(($product->price*$offer->discount_value)/100);
                                                        @endphp
                                                    <div class="product-box style1">
                                                        <div class="imagebox style1">
                                                            <div class="box-image">
                                                                <a href="{{URL::to('/productDetails/'.$product->id)}}" title="">
                                                                    <img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="">
                                                                </a>
                                                            </div><!-- /.box-image -->
                                                            <div class="box-content">
                                                                <div class="cat-name">
                                                                    <a href="{{URL::to('/productsByCat/'.$product->category_id)}}" title="">{{$product->category->categoryName}}</a>
                                                                </div>
                                                                <div class="product-name">
                                                                    <a href="{{URL::to('/productDetails/'.$product->id)}}" title="">{{$product->productName}}</a>
                                                                </div>
                                                                <div class="price">
                                                                    <span class="regular">৳ {{number_format($product->regularPrice)}}</span>
                                                                    <span class="sale">৳ {{number_format($price)}}</span>
                                                                </div>
                                                            </div><!-- /.box-content -->
                                                            <div class="box-bottom">
                                                                <div class="compare-wishlist">
                                                                    <a href="{{URL::to('/addCompare/'.$product->id)}}" class="compare" title="">
                                                                        <img src="images/icons/compare.png" alt="">Compare
                                                                    </a>
                                                                    <a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
                                                                        <img src="images/icons/wishlist.png" alt="">Wishlist
                                                                    </a>
                                                                </div>
                                                                <div class="btn-add-cart">
                                                                    <a href="{{URL::to('/addCart/'.$product->id)}}" title="">
                                                                        Add to Cart
                                                                    </a>
                                                                </div>
                                                            </div><!-- /.box-bottom -->
                                                        </div><!-- /.imagebox style1 -->
                                                    </div><!-- /.product-box style1 -->
                                                    @endforeach
                                                @endforeach
                                                @foreach($deals as $deal)
                                                    @foreach($deal->products as $product)
                                                        @php
                                                            $price = $product->price-(($product->price*$deal->discount_value)/100);
                                                        @endphp
                                                        <div class="product-box style1">
                                                            <div class="imagebox style1">
                                                                <div class="box-image">
                                                                    <a href="{{URL::to('/productDetails/'.$product->id)}}" title="">
                                                                        <img src="{{asset('storage/images/product/'.$product->image->image1)}}" alt="">
                                                                    </a>
                                                                </div><!-- /.box-image -->
                                                                <div class="box-content">
                                                                    <div class="cat-name">
                                                                        <a href="{{URL::to('/productsByCat/'.$product->category_id)}}" title="">{{$product->category->categoryName}}</a>
                                                                    </div>
                                                                    <div class="product-name">
                                                                        <a href="{{URL::to('/productDetails/'.$product->id)}}" title="">{{$product->productName}}</a>
                                                                    </div>
                                                                    <div class="price">
                                                                        <span class="regular">৳ {{number_format($product->regularPrice)}}</span>
                                                                        <span class="sale">৳ {{number_format($price)}}</span>
                                                                    </div>
                                                                </div><!-- /.box-content -->
                                                                <div class="box-bottom">
                                                                    <div class="compare-wishlist">
                                                                        <a href="{{URL::to('/addCompare/'.$product->id)}}" class="compare" title="">
                                                                            <img src="images/icons/compare.png" alt="">Compare
                                                                        </a>
                                                                        <a href="{{URL::to('/addWishlist/'.$product->id)}}" class="wishlist" title="">
                                                                            <img src="images/icons/wishlist.png" alt="">Wishlist
                                                                        </a>
                                                                    </div>
                                                                    <div class="btn-add-cart">
                                                                        <a href="{{URL::to('/addCart/'.$product->id)}}" title="">
                                                                            Add to Cart
                                                                        </a>
                                                                    </div>
                                                                </div><!-- /.box-bottom -->
                                                            </div><!-- /.imagebox style1 -->
                                                        </div><!-- /.product-box style1 -->
                                                    @endforeach
                                                @endforeach
                                                </div><!-- /.owl-carousel-item -->
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.container -->
                                </section><!-- /.flat-imagebox style1 -->
                            </div>
							<div class="tab-pane" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                                @if(!$client->wishlist->isEmpty())
                                    <div class="wishlist">
                                        <div class="title">
                                            <h3>My wishlist</h3>
                                        </div>
                                        <div class="wishlist-content">
                                            <table class="table-wishlist">
                                                <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Unit Price</th>
                                                    <th>Stock Status</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($client->wishlist as $wishlist)
                                                    <tr>
                                                        <td>
                                                            <div class="delete">
                                                                <a href="{{URL::to('/deleteWishlist/'.$wishlist->id)}}" onclick="return confirm('Are you sure want to delete this data?')" title=""><img src="{{asset('images/icons/delete.png')}}" alt=""></a>
                                                            </div>
                                                            <div class="product">
                                                                <div class="image">
                                                                    <img src="{{asset('storage/images/product/'.$wishlist->product->image->image1)}}" alt="">
                                                                </div>
                                                                <div class="name">
                                                                    {{$wishlist->product->productName}}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="price">
                                                                ৳ {{number_format($wishlist->product->price)}}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if ($wishlist->product->availablity == 0)
                                                                <div class="status-product">
                                                                    <span>In stock</span>
                                                                </div>
                                                            @else
                                                                <div class="status-product">
                                                                    <span>Out of stock</span>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="add-cart">
                                                                <a href="{{URL::to('/addCart/'.$wishlist->product_id)}}" title="">
                                                                    <img src="{{asset('images/icons/add-cart.png')}}" alt="">Add to Cart
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table><!-- /.table-wishlist -->
                                        </div><!-- /.wishlist-content -->
                                    </div><!-- /.wishlist -->
                                @else
                                    <div class="alert alert-danger">
                                        <h1 style="text-align:center">Your Wish list is empty! Add product to Wish list to purchase them later.</h1>
                                    </div>
                                    <div class="box-cart style2" style="text-align:center">
                                        <div class="btn-add-cart">
                                            <a href="{{URL::to('/home')}}" title="">
                                                <img src="{{asset('images/icons/add-cart.png')}}" alt="">Continue Shopping
                                            </a>
                                        </div>
                                    </div><!-- /.box-cart -->
                                @endif
                            </div>
						</div>
					</div><!-- /.col-lg-9 col-md-8 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</main><!-- /#shop -->

@endsection