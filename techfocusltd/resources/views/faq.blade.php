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
								<a href="#" title="">FAQ</a>
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<section class="flat-row flat-accordion">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="accordion">
							<div class="title">
								<h3>Answers to Your Questions</h3>
							</div>
							<div class="accordion-toggle">
								<div class="toggle-title">
									What is your international returns policy?
								</div>
								<div class="toggle-content">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent in accumsan dui. In hac habitasse platea dictumst. Donec sit amet auctor leo. Sed venenatis posuere risus quis dictum. Vivamus ullamcorper orci vitae eros tincidunt, a aliquet lacus dapibus. Sed consectetur, est vel tincidunt imperdiet, justo est dignissim lorem, nec tincidunt lacus lacus ac risus. Cras pretium enim nec vestibulum aliquam. Vestibulum ante ipsum primis in
										faucibus orci luctus et ultrices posuere cubilia Curae;
									</p>
								</div>
							</div><!-- /.accordion-toggle -->
							<div class="accordion-toggle">
								<div class="toggle-title">
									How can I find your international delivery policy?
								</div>
								<div class="toggle-content">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent in accumsan dui. Donec imperdiet, nisl non pharetra convallis, nunc sapien laoreet massa, ac elementum
										arcu neque vitae enim. Praesent convallis leo est, scelerisque tincidunt magna ultricies eu. Ut placerat est a eros faucibus feugiat. Nullam a urna sit amet sem porttitor malesuada a 
										quis nibh. In hac habitasse platea dictumst. Donec sit amet auctor leo. Sed venenatis posuere risus quis dictum. Vivamus ullamcorper orci vitae eros tincidunt, a aliquet lacus dapibus.
									</p>
								</div>
							</div><!-- /.accordion-toggle -->
							<div class="accordion-toggle">
								<div class="toggle-title active">
									What should I do if my order hasn't been delivered yet?
								</div>
								<div class="toggle-content">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent in accumsan dui. Donec imperdiet, nisl non pharetra convallis, nunc sapien laoreet massa, ac elementum
										arcu neque vitae enim. Praesent convallis leo est, scelerisque tincidunt magna ultricies eu. Ut placerat est a eros faucibus feugiat. Nullam a urna sit amet sem porttitor malesuada a 
										quis nibh. In hac habitasse platea dictumst. Donec sit amet auctor leo. Sed venenatis posuere risus quis dictum. Vivamus ullamcorper orci vitae eros tincidunt, a aliquet lacus dapibus. 
										Sed consectetur, est vel tincidunt imperdiet, justo est dignissim lorem, nec tincidunt lacus lacus ac risus. Cras pretium enim nec vestibulum aliquam. Vestibulum ante ipsum primis in
										faucibus orci luctus et ultrices posuere cubilia Curae;
									</p>
								</div>
							</div><!-- /.accordion-toggle -->
							<div class="accordion-toggle">
								<div class="toggle-title">
									I'm an international customer, have you received my returned items?
								</div>
								<div class="toggle-content">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent in accumsan dui. In hac habitasse platea dictumst. Donec sit amet auctor leo. Sed venenatis posuere risus quis dictum. Vivamus ullamcorper orci vitae eros tincidunt, a aliquet lacus dapibus. Sed consectetur, est vel tincidunt imperdiet, justo est dignissim lorem, nec tincidunt lacus lacus ac risus. Cras pretium enim nec vestibulum aliquam. Vestibulum ante ipsum primis in
										faucibus orci luctus et ultrices posuere cubilia Curae;
									</p>
								</div>
							</div><!-- /.accordion-toggle -->
							<div class="accordion-toggle">
								<div class="toggle-title">
									How can I get a new returns note?
								</div>
								<div class="toggle-content">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent in accumsan dui. Donec imperdiet, nisl non pharetra convallis, nunc sapien laoreet massa, ac elementum
										arcu neque vitae enim. Praesent convallis leo est, scelerisque tincidunt magna ultricies eu. Ut placerat est a eros faucibus feugiat. Nullam a urna sit amet sem porttitor malesuada a 
										quis nibh. In hac habitasse platea dictumst. Donec sit amet auctor leo. Sed venenatis posuere risus quis dictum. Vivamus ullamcorper orci vitae eros tincidunt, a aliquet lacus dapibus.
									</p>
								</div>
							</div><!-- /.accordion-toggle -->
							<div class="accordion-toggle">
								<div class="toggle-title">
									What should I do if my order hasn't been delivered yet?
								</div>
								<div class="toggle-content">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, nisl non pharetra convallis, nunc sapien laoreet massa, ac elementum
										arcu neque vitae enim. Praesent convallis leo est, scelerisque tincidunt magna ultricies eu. Ut placerat est a eros faucibus feugiat. Nullam a urna sit amet sem porttitor malesuada a 
										quis nibh. In hac habitasse platea dictumst. Donec sit amet auctor leo. Vivamus ullamcorper orci vitae eros tincidunt, a aliquet lacus dapibus.
									</p>
								</div>
							</div><!-- /.accordion-toggle -->
						</div><!-- /.accordion -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-accordion -->

@endsection