@extends('informative.layouts.master')
@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>Industries</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Industries</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->
    
    <!-- CITY SERVICES2 WRAP START-->
    <div class="city_services2_wrap">
        <div class="container">
            <div class="row">
                @foreach ($industries as $industry)
                @if (count($industry->product)>0)
                    <div class="col-md-4 col-sm-6">
                        <div class="city_business_fig">
                            <figure class="overlay">
                                <img src="{{asset('informative/extra-images/cables_&_accessories.jpg')}}" alt="">
                                <div class="city_service2_list">
                                    <span><i class="fa icon-classroom"></i></span>
                                    <div class="city_service2_caption">
                                        <h5>{{$industry->industryName}} </h5>
                                    </div>
                                </div>
                            </figure>
                            <div class="city_business_list">
                                <ul class="city_busine_detail">
                                    @foreach ($industry->product->take(3) as $product)
                                        <li><a href="{{url('product-info/'.$product->id.'/'.$product->slug)}}"><i class="fa fa-star-o"></i><span class="block-text">{{$product->productName}}</span></a></li>
                                    @endforeach
                                </ul>
                                <a class="see_more_btn" href="{{url('industry-details/'.$industry->id)}}">See More <i class="fa icon-next-1"></i></a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- CITY SERVICES2 WRAP END-->			
        
    {{-- <!--CITY NEWS2 WRAP START-->
    <div class="city_news2_wrap">
        <div class="container">
            <!--SECTION HEADING START-->
            <div class="section_heading center">
                <span>Tech World</span>
                <h2>Most Recent News</h2>
            </div>
            <!--SECTION HEADING END-->
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="city_news2_fig">
                        <figure class="overlay">
                            <img src="extra-images/news-01.jpg" alt="">
                            <div class="city_news2_text">
                                <h5>Day 3 of Amazon Great Indian Festival: 25 gadgets from JBL, Samsung and more available at Rs 999 and less</h5>
                                <p>velit auctor aliquet. Aenean sollicitudin lore uisbibendum auctor nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio</p>
                                <a class="theam_btn border-color color" href="#">Read More</a>
                            </div>
                            <div class="city_blog_social social2">
                                <a href="#" tabindex="0">Charity & Funding</a>
                                <div class="city_blog_icon_list">
                                    <ul class="social_icon">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        
                                    </ul>
                                    <a class="share_icon" href="#"><i class="fa icon-social"></i></a>
                                </div>
                            </div>
                        </figure>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="city_news2_fig">
                        <figure class="overlay">
                            <img src="extra-images/news-02.jpg" alt="">
                            <div class="city_news2_text">
                                <h5>Day 3 of Amazon Great Indian Festival: 25 gadgets from JBL, Samsung and more available at Rs 999 and less</h5>
                                <p>velit auctor aliquet. Aenean sollicitudin lore uisbibendum auctor nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio</p>
                                <a class="theam_btn border-color color" href="#">Read More</a>
                            </div>
                            <div class="city_blog_social social2">
                                <a href="#" tabindex="0">Charity & Funding</a>
                                <div class="city_blog_icon_list">
                                    <ul class="social_icon">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        
                                    </ul>
                                    <a class="share_icon" href="#"><i class="fa icon-social"></i></a>
                                </div>
                            </div>
                        </figure>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="city_news2_fig">
                        <figure class="overlay">
                            <img src="extra-images/news-03.jpg" alt="">
                            <div class="city_news2_text">
                                <h5>Day 3 of Amazon Great Indian Festival: 25 gadgets from JBL, Samsung and more available at Rs 999 and less</h5>
                                <p>velit auctor aliquet. Aenean sollicitudin lore uisbibendum auctor nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio</p>
                                <a class="theam_btn border-color color" href="#">Read More</a>
                            </div>
                            <div class="city_blog_social social2">
                                <a href="#" tabindex="0">Charity & Funding</a>
                                <div class="city_blog_icon_list">
                                    <ul class="social_icon">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        
                                    </ul>
                                    <a class="share_icon" href="#"><i class="fa icon-social"></i></a>
                                </div>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--CITY NEWS2 WRAP END--> --}}
@endsection
