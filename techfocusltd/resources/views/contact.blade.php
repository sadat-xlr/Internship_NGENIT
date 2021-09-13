@extends('masterLayout')

@section('content')

			<section class="flat-breadcrumb" id="breacrumbs">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<ul class="breadcrumbs">
								<li class="trail-item">
									<a href="{{URL::to('/home')}}" title="">Home</a>
									<span><img src="{{asset('images/icons/arrow-right.png')}}" alt=""></span>
								</li>
								<li class="trail-end">
									<a href="#" title="">Contact</a>
								</li>
							</ul><!-- /.breacrumbs -->
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</section><!-- /.flat-breadcrumb -->				

		<section class="flat-map">
            <div class="container">
            	<div class="row">
            		<div class="col-md-12">
            			<div id="flat-map" class="pdmap">
				           	<div class="flat-maps" data-address="17872 US-90, Greenville, FL 32331" data-height="444" data-images="{{asset('images/icons/map.png')}}" data-name="Themesflat Map"></div>
				            <div class="gm-map">                
				                <div class="map"></div>                        
				            </div>
            			</div><!-- /#flat-map -->
            		</div><!-- /.col-md-12 -->
            	</div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /#flat-map -->

        <section class="flat-iconbox style4">
        	<div class="container">
        		<div class="row">
				@foreach ($contacts as $contact)
        			<div class="col-md-6 col-lg-3">
        				<div class="iconbox style2">
        					<div class="box-header">
        						<div class="image">
        							<img src="{{asset('images/icons/address.png')}}" alt="">
        						</div>
        						<div class="title">
        							<h3>Address</h3>
        						</div>
        					</div><!-- /.box-header -->
        					<div class="box-content">
        						<p>
								{{$contact->address}}
        						</p>
        					</div><!-- /.box-content -->
        				</div><!-- /.iconbox style2 -->
        			</div><!-- /.col-md-6 col-lg-3 -->
        			<div class="col-md-6 col-lg-3">
        				<div class="iconbox style2">
        					<div class="box-header">
        						<div class="image">
        							<img src="{{asset('images/icons/phone.png')}}" alt="">
        						</div>
        						<div class="title">
        							<h3>Phone</h3>
        						</div>
        					</div><!-- /.box-header -->
        					<div class="box-content">
        						<p>
        							{{$contact->phone1}}
        						</p>
        						<p>
        							{{$contact->phone2}}
        						</p>
        					</div><!-- /.box-content -->
        				</div><!-- /.iconbox style2 -->
        			</div><!-- /.col-md-6 col-lg-3 -->
        			<div class="col-md-6 col-lg-3">
        				<div class="iconbox style2">
        					<div class="box-header">
        						<div class="image">
        							<img src="{{asset('images/icons/mail-2.png')}}" alt="">
        						</div>
        						<div class="title">
        							<h3>Email</h3>
        						</div>
        					</div><!-- /.box-header -->
        					<div class="box-content">
        						<p>
        							{{$contact->email}}
        						</p>
        					</div><!-- /.box-content -->
        				</div><!-- /.iconbox style2 -->
        			</div><!-- /.col-md-6 col-lg-3 -->
        			<div class="col-md-6 col-lg-3">
        				<div class="iconbox style2">
        					<div class="box-header">
        						<div class="image">
        							<img src="{{asset('images/icons/share.png')}}" alt="">
        						</div>
        						<div class="title">
        							<h3>Follow Us</h3>
        						</div>
        					</div><!-- /.box-header -->
        					<div class="box-content">
        						<ul class="social-list style2">
								@foreach($siteinfos as $siteinfo)
									<li>
										<a href="{{$siteinfo->facebook}}" title="" target="blank">
											<i class="fa fa-facebook" aria-hidden="true"></i>
										</a>
									</li>
									<li>
										<a href="{{$siteinfo->twitter}}" title="" target="blank">
											<i class="fa fa-twitter" aria-hidden="true"></i>
										</a>
									</li>
									<li>
										<a href="{{$siteinfo->instagram}}" title="" target="blank">
											<i class="fa fa-instagram" aria-hidden="true"></i>
										</a>
									</li>
									<li>
										<a href="{{$siteinfo->pinterest}}" title="" target="blank">
											<i class="fa fa-pinterest" aria-hidden="true"></i>
										</a>
									</li>
									<li>
										<a href="{{$siteinfo->dribbble}}" title="" target="blank">
											<i class="fa fa-linkedin" aria-hidden="true"></i>
										</a>
									</li>
									<li>
										<a href="{{$siteinfo->googleplus}}" title="" target="blank">
											<i class="fa fa-google" aria-hidden="true"></i>
										</a>
									</li>
								@endforeach
								</ul>
        					</div><!-- /.box-content -->
        				</div><!-- /.iconbox style2 -->
        			</div><!-- /.col-md-6 col-lg-3 -->
					@endforeach
        		</div><!-- /.row -->
        	</div><!-- /.container -->
        </section><!-- /.flat-iconbox style4 -->

        <section class="flat-contact">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-2">
        			</div>
        			<div class="col-lg-8 col-md-12">
        				<div class="form-contact center">
        					<div class="form-contact-header">
        						<h3>Leave us a Message</h3>
        						<p>
        							Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
        						</p>
        					</div><!-- /.form-contact-header -->
        					<div class="form-contact-content">
        						<form action="{{url('/addMessage')}}" method="post" id="form-contact" accept-charset="utf-8">
									{{csrf_field()}}
									<div class="form-box one-half name-contact">
										<label for="name-contact">First name*</label>
										<input type="text" id="name-contact" name="firstName" placeholder="First name" required>
									</div>
									<div class="form-box one-half password-contact">
										<label for="password-contact">Last name*</label>
										<input type="text" id="password-contact" name="lastName" placeholder="Last name" required>
									</div>
									<div class="form-box">
										<label for="subject-email">E-mail*</label>
										<input type="text" id="subject-contact" name="email" placeholder="E-mail" required>
									</div>
									<div class="form-box">
										<label for="phone-contact">Phone*</label>
										<input type="number" name="phone" placeholder="Phone" required>
									</div>
									<div class="form-box">
										<label for="subject-contact">Subject*</label>
										<input type="text" id="subject-contact" name="subject" placeholder="Subject" required>
									</div>
									<div class="form-box">
										<label for="comment-contact">Comment*</label>
										<textarea id="comment-contact" name="comment" placeholder="Your Comment" required></textarea>
									</div>
									<div class="form-box">
										<button type="submit" class="contact">Send</button>
									</div>
								</form>
        					</div><!-- /.form-contact-content -->
        				</div><!-- /.form-contact center -->
        			</div><!-- /.col-lg-8 col-md-12 -->
        			<div class="col-lg-2">
        			</div>
        		</div><!-- /.row -->
        	</div><!-- /.container -->
        </section><!-- /.flat-contact -->

@endsection