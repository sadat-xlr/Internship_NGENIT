
@extends('informative.layouts.master')
@section('content')
<!-- SAB BANNER START-->
<div class="sab_banner overlay">
	<div class="container">
		<div class="sab_banner_text">
			{{-- <h5 style="color: white">ff</h5> --}}
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
				<li class="breadcrumb-item active">Career</li>
			</ul>
		</div>
	</div>
</div>
<!-- SAB BANNER END-->
			
<!-- CITY EVENT2 WRAP START-->
{{-- <div class="city_services2_wrap" style="padding:unset;">
	<div class="container">
		
	</div>
</div> --}}
<!-- CITY EVENT2 WRAP END-->

<!-- CITY EVENT2 WRAP START-->
<div class="city_blog2_wrap">
    <div class="container">
        <div class="city_mayor_row">
			<div class="city_health2_fig">
                <figure class="box">
                    <div class="box-layer layer-1"></div>
                    <div class="box-layer layer-2"></div>
                    <div class="box-layer layer-3"></div>
                    <img src="{{asset('informative/extra-images/service-banner.jpg')}}" alt="">
                </figure>	
            </div>
        </div>
        <div class="city_news2_post">
            <ul>
                @foreach ($jobs as $job)
                    <li>
                        <div class="city_news2_detail">
                            <ul class="city_meta_list">
                                <li><a href="#"><i class="fa fa-calendar"></i>Posted: {{$job->created_at->format('d/m/y')}}</a></li>
                                <li><a href="#"><i class="fa fa-calendar"></i>Deadline: {{ \Carbon\Carbon::parse($job->Deadline)->format('d/m/Y')}}</a></li>
                            </ul>
                            <h3>{{$job->title}}</h3>
                            <p>{{substr(strip_tags($job->description),0,200)}}</p>
                            <a class="theam_btn bg-color color" href="{{url('career/'.$job->id)}}" tabindex="0">Read More</a>
                        </div>
                    </li>
                    
                @endforeach
            </ul>
        </div>
        <div class="pagination">
            
        </div>	
    </div>
</div>
<!-- CITY EVENT2 WRAP END-->
@endsection