@extends('informative.layouts.master')

@section('content')
		
{{-- 
<!-- SAB BANNER START-->
<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Login</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Login</li>
            </ul>
        </div>
    </div>
</div>
<!-- SAB BANNER END--> --}}

<!--D HELP LOGIN WRAP START-->
<div class="city_login_wrap" style="padding:20px 0px 140px 0px">
    <div class="container">
        <div class="city_login_list">
            <section id="faq">
                <div class="city_login register" style="width:100% !important;">
                    <h4>Faq</h4>
                        <div class="col-md-12">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                @foreach ($faqs as $item)
                                    <div class="panel panel-default"  style="margin:unset; padding:unset">
                                        <div class="panel-heading" role="tab" id="heading{{$item->id}}" style="padding:unset">
                                        <h4 class="panel-title" style="padding-bottom: unset;">
                                            <a class="accordion-section-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                                            {{$item->question}}
                                            </a>
                                        </h4>
                                        </div>
                                        <div id="collapse{{$item->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$item->id}}">
                                        <div class="panel-body">
                                            {!!$item->answer!!}
                                        </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                </div>
            </section>
            <section id="pilicy">
                <div class="city_login register" style="width:100% !important;">
                    <h4>Policy</h4>
                    <div class="col-md-12">
                        <div>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus aut sed, ut laudantium, officia voluptatum magnam accusamus harum tempore voluptate nisi, reprehenderit facilis architecto. Animi itaque maxime nesciunt tempora ipsam.
                        </div>
                    </div>
                </div>

            </section>
            <section id="world-shipping">
                <div class="city_login register" style="width:100% !important;">
                    <h4>Worldwide Shipping</h4>
                    <div class="col-md-12">
                        <div>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus aut sed, ut laudantium, officia voluptatum magnam accusamus harum tempore voluptate nisi, reprehenderit facilis architecto. Animi itaque maxime nesciunt tempora ipsam.
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!--D HELP LOGIN WRAP END-->

@endsection