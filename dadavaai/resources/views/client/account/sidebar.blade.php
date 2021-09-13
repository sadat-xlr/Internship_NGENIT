<aside class="col-md-3 col-sm-4">
    <div class="main-sidebar" >
{{--         <div id="search-2" class="widget sidebar-widget widget_search clearfix">
            <form method="get" id="searchform" class="form-search" action="http://localhost/goshopwp">
                <input class="form-control search-query" type="text" placeholder="Type Keyword" name="s" id="s" />
                <button class="btn btn-default search-button" type="submit" name="submit"><i class="fa fa-search"></i></button>
            </form>
        </div> --}}
        <div class="widget sidebar-widget widget_categories clearfix">
            <h6 class="widget-title">My Account</h6>
            <ul>
                <li  class="accout-item active"><a href="{{url('/client-dashboard')}}">Dashboard</a></li>
                <li  class="accout-item"><a href="{{url('/client-order-history')}}">My Order</a></li>
                <li  class="accout-item"><a href="{{'/client-order-delivery-history'}}">My Delivery</a></li> 
                <li  class="accout-item"><a href="{{'/client-order-payment-history'}}">My Payment</a></li>   
                <li  class="accout-item"><a href="{{'/client-offers'}}">My Offer</a></li>
                <li  class="accout-item"><a href="{{'/my-point'}}">My Credit</a></li>                                  
                <li  class="accout-item"><a href="{{url('/client-address')}}">Address Books</a></li>
                <li  class="accout-item"><a href="{{url('/client-change-password')}}">Change Password</a></li>
            </ul>  
        </div>
    </div>
</aside>