<header>
        <!--CITY TOP WRAP START--> 
        <div class="city_top_wrap">
            <div class="container-fluid">
                <div class="city_top_logo">
                    <figure>
                        <h1><a href="{{url('/')}}"><img src="{{asset('informative/images/logo.png')}}" alt="kodeforest"></a></h1>
                    </figure>
                </div>
                <!--<div class="city_top_news">
                    <span>Reach Us</span>
                    <div class="city-news-slider">
                        <div>
                            <p>Address: 89/2, Haque Chamber, Panthapath, Dhaka 1205<i class="fa fa-star"></i></p>
                        </div>
                        <div>
                            <p>Mobile: 01714-243446<i class="fa fa-star"></i></p>
                        </div>
                        <div>
                            <p>Email: sales@ngenitltd.com<i class="fa fa-star"></i></p>
                        </div>
                    </div>
                </div>-->
                @php
                    $siteInfo = \App\Siteinfo::all()->first();
                @endphp
                <div class="city_top_social">
                    <ul>
                        <li><a href="{{$siteInfo->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{$siteInfo->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="{{$siteInfo->dribbble}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                      
                    </ul>
                </div>
                
            </div>
        </div>
        <!--CITY TOP WRAP END-->
        @php
            $solutions = \App\Solution::all()->take(4);
            $featuredContents = \App\Featuredcontent::orderBy('created_at','desc')->take(2)->get();
            $categories = \App\Category::all()->take(5);
            $brands = \App\Brand::all()->take(5);
            $industries = \App\Industry::all()->take(5);
            $services = \App\Service::all();
        @endphp
        <!--CITY TOP NAVIGATION START-->
        <div class="city_top_navigation" style="padding:unset">
            <div class="container-fluid">
                <div class="row">
                    {{-- <div class="col-md-9">
                        <div class="navigation">
                            <ul>
                                <li><a href="{{url('/')}}">Home</a></li>
                                <li><a href="#">Industries</a>
                                    <ul class="child-special">
                                        @foreach ($industries as $industry)
                                        <li>
                                            <a href="{{URL::to('')}}" title="">{{$industry->industryName}}</a>
                                        </li>
                                        @endforeach
                                        <li>
                                            <a href="{{URL::to('/allIndustry')}}" title="">See all</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Real Menu-->
                                <li><a href="#">Solutions</a>
                                    <ul class="child-special">
                                    <div class="nav-column">
                                    <p class="text-center"><b><u>Cables & Accessories</u></b></p>
                                    <ul class="sub-child">
                                        <ul class="column_one">
                                        <li><a href="#">Power Tools</a></li>
                                        <li><a href="#">USB & I/O</a></li>
                                        <li><a href="#">Railway</a></li>
                                        </ul>
                                        <ul class="column_two">
                                        <li><a href="#">Leadwire</a></li>
                                        <li><a href="#">Cable Tray</a></li>
                                        <li><a href="#">Glands</a></li>
                                        </ul>
                                    </ul>
                                    </div>
                                    <div class="nav-column">
                                    <p class="text-center"><b><u>Consumer & Retails</u></b></p>
                                    <ul class="sub-child">
                                        <ul class="column_one">
                                        <li><a href="#">Appliances</a></li>
                                        <li><a href="#">Design</a></li>
                                        <li><a href="#">Creation</a></li>
                                        </ul>
                                        <ul class="column_two">
                                        <li><a href="#">Speakers</a></li>
                                        <li><a href="#">Headphones</a></li>
                                        <li><a href="#">Smart Devices</a></li>
                                        </ul>                         
                                    </ul>
                                    </div>
                                    <div class="nav-column">
                                    <p class="text-center"><b><u>Hardware & Tools</u></b></p>
                                    <ul class="sub-child">
                                        <ul class="column_one">
                                        <li><a href="#">Tool Kits</a></li>
                                        <li><a href="#">Storage</a></li>
                                        <li><a href="#">Routers</a></li>
                                        </ul>
                                        <ul class="column_two">
                                        <li><a href="#">Air Tools</a></li>
                                        <li><a href="#">Sheet Metal</a></li>
                                        <li><a href="#">Pipe Benders</a></li>
                                        </ul>
                                    </ul>
                                    </div>
                                    <div class="nav-column">
                                    <p class="text-center"><b><u>Safety & Security</u></b></p>
                                    <ul class="sub-child">
                                        <ul class="column_one">
                                        <li><a href="#">Self Defence</a></li>
                                        <li><a href="#">Key Control</a></li>
                                        <li><a href="#">Padlocks</a></li>
                                        </ul>
                                        <ul class="column_two">
                                        <li><a href="#">Key Control</a></li>
                                        <li><a href="#">Hearing Kit</a></li>
                                        <li><a href="#">EMT</a></li>
                                        </ul>
                                    </ul>
                                    </div>
                                    <div class="nav-column">
                                    <p class="text-center"><b><u>Software</u></b></p>
                                    <ul class="sub-child">
                                    <ul class="column_one">
                                        <li><a href="#">Industry 4.0</a></li>
                                        <li><a href="#">Safety2G</a></li>
                                        <li><a href="#">Robotics</a></li>
                                        </ul>
                                        <ul class="column_two">
                                        <li><a href="#">CMS</a></li>
                                        <li><a href="#">Collaboration</a></li>
                                        <li><a href="#">ERP</a></li>
                                        </ul>
                                    </ul>
                                    </div>
                                    <div class="nav-column">
                                    <p class="text-center"><b><u>Electrical & Electronics</u></b></p>
                                    <ul class="sub-child">
                                    <ul class="column_one">
                                        <li><a href="#">Batteries</a></li>
                                        <li><a href="#">Motor Controls</a></li>
                                        <li><a href="#">Voice & Data</a></li>
                                        </ul>
                                        <ul class="column_two">
                                        <li><a href="#">Generators</a></li>
                                        <li><a href="#">Replacement</a></li>
                                        <li><a href="#">Power Supplies</a></li>
                                        </ul>
                                    </ul>
                                    </div>
                                <div class="nav-column">
                                    <p class="text-center"><b><u>Service & Maintenance</u></b></p>
                                    <ul class="sub-child">
                                        <ul class="column_one">
                                        <li><a href="#">Valve</a></li>
                                        <li><a href="#">Callibration</a></li>
                                        <li><a href="#">Instrumentation</a></li>
                                        </ul>
                                        <ul class="column_two">
                                        <li><a href="#">Field Service</a></li>
                                        <li><a href="#">Global Support</a></li>
                                        <li><a href="#">Marketing</a></li>
                                        </ul>
                                    </ul>
                                    </div>
                                    <div class="nav-column">
                                    <p class="text-center"><b><u>AI, IoT & Others</u></b></p>
                                    <ul class="sub-child">
                                        <ul class="column_one">
                                        <li><a href="#">Networking</a></li>
                                        <li><a href="#">Gateways</a></li>
                                        <li><a href="#">Military</a></li>
                                        </ul>
                                        <ul class="column_two">
                                        <li><a href="#">Automation</a></li>
                                        <li><a href="#">Underwater</a></li>
                                        <li><a href="#">Healthcare</a></li>
                                        </ul>
                                    </ul>
                                    </div>
                                    <div class="nav-column">
                                    <p class="text-center"><b><u>Science & Research</u></b></p>
                                    <ul class="sub-child">
                                        <ul class="column_one">
                                        <li><a href="#">Analysis</a></li>
                                        <li><a href="#">Screening</a></li>
                                        <li><a href="#">Clinical</a></li>
                                        </ul>
                                        <ul class="column_two">
                                        <li><a href="#">Health Science</a></li>
                                        <li><a href="#">Visualization</a></li>
                                        <li><a href="#">Extract Data</a></li>
                                        </ul>
                                    </ul>
                                    </div>
                                    <div class="nav-column">
                                    <p class="text-center"><b><u>Training & Books</u></b></p>
                                    <ul class="sub-child">
                                    <ul class="column_one">
                                        <li><a href="#">Engineering</a></li>
                                        <li><a href="#">Defence</a></li>
                                        <li><a href="#">IT</a></li>
                                        </ul>
                                        <ul class="column_two">
                                        <li><a href="#">Industrial</a></li>
                                        <li><a href="#">Oil & Enengy</a></li>
                                        <li><a href="#">Simulation</a></li>
                                        </ul>
                                    </ul>
                                    </div>
                                
                                </ul>
                                </li>
                                <!-- Real Menu -->
                                <!-- Mega Menu-->
                                <li>
                                    <a href="{{url('/services')}}">Services</a>
                                </li>
                                <!-- Mega Menu-->
                                <li><a href="#">Products</a>
                                    <ul class="child">
                                        <li>
                                            <a href="resident.html">By Brands</a>
                                            <ul class="child-special-another">
                                               <div class="nav-column-another">
                                                  <p class="text-center"><b>A</b></p>
                                                    @php
                                                        $brands = \App\Brand::where("brandName", 'LIKE', "A".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                        <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>B</b></p>
                                                    @php
                                                        $brands = \App\Brand::where("brandName", 'LIKE', "b".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                        <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach                                                               
                                                </div>
                                                <div class="nav-column-another">
                                                   <p class="text-center"><b>C</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "c".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach                                                                
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>D</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "d".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach                                                                
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>E</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "e".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach                                                                
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>F</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "f".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach                                                                
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>G</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "g".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach                                                                
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>H</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "h".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach 
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>I</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "i".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach 
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>J</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "j".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach 
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>K</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "k".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach 
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>L</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "l".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach 
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>M</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "m".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach 
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>N</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "n".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach 
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>O</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "o".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach 
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>P</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "p".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach 
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>Q</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "q".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach 
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>R</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "r".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach 
                                                </div>
                                                <div class="nav-column-another">
                                                    <p class="text-center"><b>S</b></p>
                                                    @php
                                                    $brands = \App\Brand::where("brandName", 'LIKE', "s".'%')->get();
                                                    @endphp
                                                    @foreach($brands as $brand) 
                                                    <li><a href="#">{{$brand->brandName}}</a></li>
                                                    @endforeach 
                                                </div>

                                            </ul>
                                               
                                        </li>
                                        <li><a href="resident-detail.html">By Technology</a>
                                         <ul class="child">
                                        <li><a href="team.html">RFID & NFS</a>
                                           <ul class="gadgets-child">
                                               <li>
                                                   <img src="{{asset('informative/Gadgets_Images/intercom-1674053_640.jpg')}}" alt="abc">
                                               </li>
                                           </ul>
                                        </li>
                                        <li><a href="team.html">Drones & Robotics</a>
                                            <ul class="gadgets-child">
                                               <li>
                                                   <img src="{{asset('informative/Gadgets_Images/drone-1080844_640.jpg')}}" alt="abc">
                                               </li>
                                           </ul>
                                        </li>
                                        <li><a href="mayor.html">Architects & Engineering</a>
                                          <ul class="gadgets-child">
                                               <li>
                                                   <img src="{{asset('informative/Gadgets_Images/board-453758_640.jpg')}}" alt="abc">
                                               </li>
                                           </ul>
                                        </li>
                                        <li><a href="goverment.html">Healthcare & Life Science</a>
                                          <ul class="gadgets-child">
                                               <li>
                                                   <img src="{{asset('informative/Gadgets_Images/medic-563423_640.jpg')}}" alt="abc">
                                               </li>
                                           </ul>
                                        </li>
                                        <li><a href="goverment-grid.html">Safety & Security</a>
                                          <ul class="gadgets-child">
                                               <li>
                                                   <img src="{{asset('informative/Gadgets_Images/electric-1080584_640.jpg')}}" alt="abc">
                                               </li>
                                           </ul>
                                        </li>
                                        <li><a href="health-department.html">Environmental Science</a>
                                          <ul class="gadgets-child">
                                               <li>
                                                   <img src="{{asset('informative/Gadgets_Images/forest-931706_640.jpg')}}" alt="abc">
                                               </li>
                                           </ul>
                                        </li>
                                        <li><a href="health-department.html">Power & Energy</a>
                                          <ul class="gadgets-child">
                                               <li>
                                                   <img src="{{asset('informative/Gadgets_Images/light-bulb-3535435_640.jpg')}}" alt="abc">
                                               </li>
                                           </ul>
                                        </li>
                                        <li><a href="health-department.html">Artificial Intelligence
                                        </a>
                                         <ul class="gadgets-child">
                                               <li>
                                                   <img src="{{asset('informative/Gadgets_Images/girl-2181709_640.jpg')}}" alt="abc">
                                               </li>
                                           </ul>
                                      </li>
                                    </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#">More About</a>
                                    <ul class="child">
                                        <li><a href="{{url('blog')}}" target="_blank">Blog</a></li>
                                        <li><a href="{{url('forum-questions')}}">Tech Forums</a></li>
                                        <li><a href="{{url('/')}}">Our Projects</a></li>
                                        <li><a href="{{url('/')}}">About Us</a></li>
                                        <li><a href="{{url('/contact')}}">Contact Us</a></li>
                                        <li><a href="{{url('/')}}">Coming Soon</a></li>
                                    </ul>
                                </li>
                            </ul>									
                        </div>
                        <!--DL Menu Start-->
                        <div id="kode-responsive-navigation" class="dl-menuwrapper">
                            <button class="dl-trigger">Open Menu</button>
                            <ul class="dl-menu">
                                <li><a class="active" href="index-2.html">Home</a></li>
                                <li class="menu-item kode-parent-menu"><a href="#">Services</a>
                                    <ul class="dl-submenu">
                                        <li><a href="service.html">Services</a></li>
                                        <li><a href="service-02.html">Services 02</a></li>
                                        <li><a href="service-detail.html">Services detail</a></li>
                                        <li><a href="service-detail2.html">Services detail 02</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item kode-parent-menu"><a href="#">Government</a>
                                    <ul class="dl-submenu">
                                    <li><a href="team.html">team</a></li>
                                    <li><a href="mayor.html">mayor</a></li>
                                    <li><a href="goverment.html">goverment</a></li>
                                    <li><a href="goverment-grid.html">goverment grid</a></li>
                                    <li><a href="health-department.html">health department</a></li>
                                    <li><a href="health-department02.html">health department 02 </a></li>
                                </ul>
                                </li>
                                <li class="menu-item kode-parent-menu"><a href="#">business</a>
                                    <ul class="dl-submenu">
                                        <li><a href="business.html">business</a></li>
                                        <li><a href="business-detail.html">business detail</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item kode-parent-menu"><a href="#">Resident</a>
                                    <ul class="dl-submenu">
                                        <li><a href="resident.html">Resident</a></li>
                                        <li><a href="resident-detail.html">Resident detail</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item kode-parent-menu"><a href="#">feature</a>
                                    <ul class="dl-submenu">
                                        <li><a href="#">blog</a>
                                            <ul class="dl-submenu">
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="blog-list.html">blog list</a></li>
                                                <li><a href="blog-detail.html">blog detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">forum</a>
                                            <ul class="dl-submenu">
                                                <li><a href="forum.html">forum</a></li>
                                                <li><a href="forum-01.html">forum 01</a></li>
                                                <li><a href="forum-detail.html">forum detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">project</a>
                                            <ul class="dl-submenu">
                                                <li><a href="project.html">project</a></li>
                                                <li><a href="project-01.html">project 01</a></li>
                                                <li><a href="project-detail.html">project detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="login.html">login</a></li>
                                        <li><a href="error.html">404 page</a></li>
                                        <li><a href="coming-soon.html">coming soon</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item kode-parent-menu"><a href="#">New & Event</a>
                                    <ul class="dl-submenu">
                                        <li><a href="#">event</a>
                                            <ul class="dl-submenu">
                                                <li><a href="event.html">event</a></li>
                                                <li><a href="event-01.html">event 01</a></li>
                                                <li><a href="event-02.html">event 02</a></li>
                                                <li><a href="event-detail.html">event detail</a></li>
                                                <li><a href="event-listing.html">event listing</a></li>
                                            </ul>	
                                        </li>
                                        <li><a href="#">news</a>
                                            <ul class="dl-submenu">
                                                <li><a href="news.html">news page</a></li>
                                                <li><a href="news-post.html">news post</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="contact-us.html">Contact Us</a></li>
                            </ul>
                        </div>
                        <!--DL Menu END-->
                    </div> --}}
                    <div class="col-md-9">
                        <div class="navbar navbar-default navbar-static-top" style="padding-top:5px; border:unset;!important">
                            <div class="container">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="navbar-collapse collapse">
                                    <ul class="nav navbar-nav">
                                        <li class="dropdown menu-large">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> What we do <b class="caret"></b> </a>
                                        <ul class="dropdown-menu megamenu row">
                                            <li class="col-sm-3">
                                                <ul>
                                                    <span class="top-span-one"></span>
                                                    <li class="dropdown-header"><b>Digital Innovation</b></li>
                                                    <li><a href="#">Drive meaningful customer experiences</a></li>
                                                    <li><a href="{{url('feature-content')}}" class="special-link">Featured Content</a></li>
                                                    <li><a href="{{url('services')}}" class="special-link">Services</a></li>
                                                    {{-- <li><a href="#" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li> --}}
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <span class="top-span-one"></span>
                                                    <li class="dropdown-header"><b>Cloud + Data Center Transformation</b></li>
                                                    <li><a href="#">Cloud solutions & management</a></li>
                                                    <li><a href="#" class="special-link">Cloud & data center platforms</a></li>
                                                    <li><a href="#" class="special-link">Transformation services</a></li>
                                                    <li><a href="#" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <span class="top-span-one"></span>
                                                    <li class="dropdown-header"><b>Connected Workforce</b></li>
                                                    <li><a href="#">Empower employees that fuel productivity</a></li>
                                                    <li><a href="#" class="special-link">Managed Collaboration</a></li>
                                                    <li><a href="#" class="special-link">Managed deployment</a></li>
                                                    <li><a href="#" class="special-link">Managed mobility</a></li>
                                                    <li><a href="#" class="special-link">Managed Office</a></li>
                                                    <li><a href="#" class="special-link">Managed workplace services</a></li>
                                                    <li><a href="#" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <span class="top-span-one"></span>
                                                    <li class="dropdown-header"><b>System Integration</b></li>
                                                    <li><a href="#" class="special-link">Software Solutions & services</a></li>
                                                    <li><a href="#" class="special-link">Hardware Solution</a></li>
                                                    <li><a href="{{url('services')}}" class="special-link">Support Services</a></li>
                                                    <li><a href="#" class="special-link">Professional Consultancy</a></li>
                                                    <li><a href="#" class="special-link">Safety & Security</a></li>
                                                </ul>
                                            </li>
                                        <div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="menu-content">
                                                <div class="special-part">
                                                    <div class="first-part">
                                                    <p class="menu-text"><b>A single portal for your needs</b><br>Manage all of your procurement, products and services with an account on TechFocus</p>
                                                    <a href="#" class="special-link">See the benefits of an account&nbsp;<i class="fas fa-long-arrow-alt-right"></i>&nbsp;</a><a href="#" class="special-link">Create an account&nbsp;<i class="fas fa-long-arrow-alt-right"></i>&nbsp;&nbsp;</a><a href="#" class="special-link">Log in to your account&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="list-part">
                                                <p class="menu-text"><b>Industries we serve</b></p>
                                                <ul class="list_column">
                                                    @foreach ($solutions->take(3) as $solution)
                                                    <li><a href="{{url('solution/'.$solution->id.'/'.$solution->slug)}}" class="menu-text special-link">{{$solution->solutionName}} solution&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                    @endforeach
                                                </ul>
                                                <ul class="list_column">
                                                    @foreach ($services as $service)
                                                        
                                                    <li><a href="{{url('service/'.$service->id.'/'.$service->slug)}}" class="menu-text special-link">{{$service->title}}&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                    @endforeach
                                                </ul>
                                                <ul class="list_column">
                                                    {{-- <li><a href="#" class="menu-text special-link">State & local government&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="quote-button"><a href="{{url('solutions')}}" class="btn btn-log">View all solutions&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a>
                                            </div>
                                        </div>
                                        <!--<div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="list-part">
                                                <p class="heading-part"><b>Industries we serve</b></p>
                                                <ul class="nav-column">
                                                    <li>
                                                        <a href="#">Education</a>
                                                        <a href="#">Enterprise business</a>
                                                        <a href="#">Federal government</a>
                                                    </li>
                                                </ul>
                                                <ul class="nav-column">
                                                    <li>
                                                        <a href="#">Healthcare</a>
                                                        <a href="#">Service providers</a>
                                                        <a href="#">Small to medium business</a>
                                                    </li>
                                                </ul>
                                                <ul class="nav-column">
                                                    <li>
                                                        <a href="#">State & local government</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>-->
                                        </ul>
                                    </li>
                                    <li class="dropdown menu-large">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Content & Resources <b class="caret"></b></a>
                                        <ul class="dropdown-menu megamenu row">
                                            <div class="feature-part">
                                                <div class="col-sm-12">
                                                    <span class="top-span-two"></span>
                                                    <p class="menu-text text-center"><b>Featured content</b></p>
                                                    <div class="feature-content-part">
                                                        @foreach ($featuredContents as $featuredContent)
                                                            <div class="width_control">
                                                                <div class="city_department_fig">
                                                                <figure class="box">
                                                                    <div class="box-layer layer-1"></div>
                                                                    <div class="box-layer layer-2"></div>
                                                                    <div class="box-layer layer-3"></div>
                                                                    <img src="{{asset('storage/images/feturedContent/'.$featuredContent->image)}}" alt="" style="width: 120px; height: 90px;!important">
                                                                    <a class="paly_btn" data-rel="prettyPhoto" href="{{asset('storage/images/feturedContent/'.$featuredContent->image)}}"><i class="fa fa-plus"></i></a>
                                                                </figure>
                                                                <div class="city_department_text">
                                                                    <p class="menu-text text-center">{{$featuredContent->title}}</p>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <div class="col-sm-6 col-md-4">
                                                        <a href="{{url('feature-content')}}" class="btn btn-view-all">View all&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <span class="top-span-one"></span>
                                                    <li class="dropdown-header"><b>By Product</b></li>
                                                    @foreach ($categories as $category)
                                                    <li><a href="{{url('products-by-cat/'.$category->id)}}" class="special-link">{{$category->categoryName}}</a></li>
                                                    @endforeach
                                                    <li><a href="#" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                                </ul>
                                            </li>
                                        <li class="col-sm-3">
                                            <ul>
                                                <span class="top-span-one"></span>
                                                <li class="dropdown-header"><b>By Brand</b></li>
                                                @foreach ($brands as $brand)
                                                    <li><a href="#" class="special-link">{{$brand->brandName}}</a></li>                                                  
                                                @endforeach
                                                <li><a href="{{url('all-brand')}}" class="special-link">View all&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                            </ul>
                                        </li>
                                        <li class="col-sm-3">
                                            <ul>
                                                <span class="top-span-one"></span>
                                                <li class="dropdown-header"><b>By Solution</b></li>

                                                @foreach ($solutions as $solution)
                                                    <li><a href="{{url('solution/'.$solution->id.'/'.$solution->slug)}}" class="special-link">{{$solution->solutionName}}</a></li>
                                                    
                                                @endforeach
                                                <li><a href="{{url('solutions')}}" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                            </ul>
                                        </li>
                                        <li class="col-sm-3">
                                            @php
                                                $industries = \App\Industry::all()->take(4);
                                            @endphp
                                            <ul>
                                                <span class="top-span-one"></span>
                                                <li class="dropdown-header"><b>By Industry</b></li>
                                                @foreach ($industries as $industry)
                                                    <li><a href="#" class="special-link">{{$industry->industryName}}</a></li>                                                  
                                                @endforeach
                                                <li><a href="{{url('allIndustry')}}" class="special-link">View all&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                            </ul>
                                        </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown menu-large">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Connect with us<b class="caret"></b></a>    
                                        <ul class="dropdown-menu megamenu row">
                                            <li class="col-sm-4">
                                            <ul>
                                            <span class="top-span-one"></span>
                                            <li class="dropdown-header"><b>Upcoming events</b></li>
                                            </ul> 
                                            </li>
                                        <li class="col-sm-2">
                                            <ul>
                                            <span class="top-span-one"></span>
                                            <li class="dropdown-header"><b>Contact Us</b></li>
                                            <li><a href="{{url('contact')}}" class="special-link">Talk to a specialist</a></li>
                                            <li><a href="#" class="special-link">1,800 INSIGHT</a></li>
                                            </ul>
                                        </li>
                                        <li class="col-sm-2">
                                            <ul>
                                            <span class="top-span-one"></span>
                                            <li class="dropdown-header"><b>Careers</b></li>
                                            <li><p class="menu-text">At insight, we believe in putting people first.</p></li>
                                            <button type="button" class="btn btn-log">Join our team&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></button>
                                            </ul>
                                        </li>
                                        <li class="col-sm-2">
                                            <ul>
                                            <span class="top-span-one"></span>
                                            <li class="dropdown-header"><b>Media relations</b></li>
                                            <li><a href="#" class="special-link">Investor relations</a></li>
                                            <li><a href="#" class="special-link">Newsroom</a></li>
                                            </ul>
                                        </li>
                                        <li class="col-sm-2">
                                            <ul>
                                            <span class="top-span-one"></span>
                                            <li class="dropdown-header"><b>Tech Support</b></li>
                                            <li><a href="#" class="special-link">Blog</a></li>
                                            <li><a href="{{url('forum-questions')}}" class="special-link">Forum</a></li>
                                            <li><a href="#" class="special-link">Executing</a></li>
                                            </ul>
                                        </li>
                                        <li class="col-sm-12">
                                            <div class="social-links">
                                                <p class="menu-text text-center">Stay connected: &nbsp;&nbsp;<a href="#"><i class="fab fa-linkedin"></i></a>&nbsp;&nbsp;&nbsp;<a href="#"><i class="fab fa-facebook-square"></i></a>&nbsp;&nbsp;&nbsp;<a href="#"><i class="fab fa-twitter"></i></a>&nbsp;&nbsp;&nbsp;<a href="#"><i class="fab fa-youtube"></i></a>&nbsp;&nbsp;&nbsp;<a href="#"><i class="fab fa-instagram"></i></a></p>
                                            </div>
                                        </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown menu-large">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Shop<b class="caret"></b></a>    
                                        <ul class="dropdown-menu megamenu row">
                                        <li class="col-sm-2">
                                            <ul>
                                            <span class="top-span-one"></span>
                                            <li class="dropdown-header"><b>Shop by Products</b></li>
                                            @foreach ($categories as $category)
                                            <li><a href="{{url('productsByCat/'.$category->id)}}" class="special-link">{{$category->categoryName}}</a></li>                                                  
                                            @endforeach
                                            <li><a href="{{url('/ecommerce')}}" class="special-link">Shop all products&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                            </ul>
                                        </li>
                                        <li class="col-sm-2">
                                            <ul>
                                            <span class="top-span-one"></span>
                                            <li class="dropdown-header"><b>Shop by Brand</b></li>
                                            @foreach ($brands as $brand)
                                            <li><a href="{{url('productsByBrand/'.$brand->id)}}" class="special-link">{{$brand->brandName}}</a></li>                                                  
                                            @endforeach
                                            <li><a href="{{url('/brands')}}" class="special-link">Shop all brands&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                            </ul>
                                        </li>
                                        <li class="col-sm-2">
                                            <ul>
                                                <span class="top-span-one"></span>
                                                <li class="dropdown-header"><b>Shop by Industry</b></li>
                                                @foreach ($industries as $industry)
                                                    <li><a href="{{url('productsByInd/'.$industry->id)}}" class="special-link">{{$industry->industryName}}</a></li>                                                  
                                                @endforeach
                                                <li><a href="{{url('/productsByInd')}}" class="special-link">Shop all industries&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></li>
                                            </ul>
                                        </li>
                                        <div class="shop-part">
                                        <li class="col-sm-6">
                                        <p class="menu-text"><b>Manage your purchasing and products</b><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit<br>sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                        <a href="{{url('/login')}}" class="btn btn-log">Log in to your account</a>
                                        <a href="{{url('/login')}}" class="btn btn-log">Create an account</a>
                                        </li>
                                        </div>
                                        <li class="col-sm-2">
                                        <ul>
                                            <span class="top-span-one"></span>
                                            <li class="dropdown-header"><b>Purchasing guidance</b></li>
                                            <li><a href="#" class="special-link">Education</a></li>
                                            <li><a href="#" class="special-link">Federal government</a></li>
                                            <li><a href="#" class="special-link">Healthcare</a></li>
                                            <li><a href="#" class="special-link">Local government</a></li>
                                            <li><a href="#" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right">
                                            </i></a></li>
                                            </ul>
                                        </li>
                                        <li class="col-sm-2">
                                        <ul>
                                            <span class="top-span-one"></span>
                                            <li class="dropdown-header"><b>Purchasing contracts</b></li>
                                            <li><a href="#" class="special-link">Education</a></li>
                                            <li><a href="#" class="special-link">Federal government</a></li>
                                            <li><a href="#" class="special-link">Healthcare</a></li>
                                            <li><a href="#" class="special-link">Local government</a></li>
                                            <li><a href="#" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right">
                                            </i></a></li>
                                            </ul>
                                        </li>
                                        <li class="col-sm-2">
                                        <ul>
                                            <span class="top-span-one"></span>
                                            <li class="dropdown-header"><b>Explore our deals</b></li>
                                            <li><a href="#" class="special-link">Education</a></li>
                                            <li><a href="#" class="special-link">Federal government</a></li>
                                            <li><a href="#" class="special-link">Healthcare</a></li>
                                            <li><a href="#" class="special-link">Local government</a></li>
                                            <li><a href="#" class="special-link">View All&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right">
                                            </i></a></li>
                                            </ul>
                                        </li>
                                        <div class="shop-text">
                                            <li class="col-sm-6">
                                            <p class="menu-text"><b>Simplify and streamline with techfocus</b></p>
                                            <p class="menu-text">We will help you procure and manage your production lifecycle.</p>
                                            <a href="#" class="menu-text special-link"><i class="fas fa-desktop"></i>See the benefits of our e-procurement solution</a><br>
                                            <a href="#" class="menu-text special-link"><i class="fas fa-box"></i>See our Supply Chain Optimization capability</a>
                                            </li>
                                        </div>
                                        </ul>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="padding-top:5%;padding-right:20%">
                            <div class="city_top_form">
                                <div class="city_top_search">
                                    <input type="text" placeholder="Search">
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </div>
                                <a class="top_user" href="login.html"><i class="fa fa-user"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
        <!--CITY TOP NAVIGATION END-->
        
        <!--CITY TOP NAVIGATION START-->
        <div class="city_top_navigation hide">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="navigation">
                            <ul>
                                <li><a href="index-2.html">Home</a></li>
                                <li><a href="#">Services</a>
                                    <ul class="child">
                                        <li><a href="service.html">Services</a></li>
                                        <li><a href="service-02.html">Services 02</a></li>
                                        <li><a href="service-detail.html">Services detail</a></li>
                                        <li><a href="service-detail2.html">Services detail 02</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Government</a>
                                    <ul class="child">
                                        <li><a href="team.html">team</a></li>
                                        <li><a href="mayor.html">mayor</a></li>
                                        <li><a href="goverment.html">goverment</a></li>
                                        <li><a href="goverment-grid.html">goverment grid</a></li>
                                        <li><a href="health-department.html">health department</a></li>
                                        <li><a href="health-department02.html">health department 02 </a></li>
                                    </ul>
                                </li>
                                <li><a href="#">business</a>
                                    <ul class="child">
                                        <li><a href="business.html">business</a></li>
                                        <li><a href="business-detail.html">business detail</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Resident</a>
                                    <ul class="child">
                                        <li><a href="resident.html">Resident</a></li>
                                        <li><a href="resident-detail.html">Resident detail</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">feature</a>
                                    <ul class="child">
                                        <li><a href="#">blog</a>
                                            <ul class="child">
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="blog-list.html">blog list</a></li>
                                                <li><a href="blog-detail.html">blog detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">forum</a>
                                            <ul class="child">
                                                <li><a href="forum.html">forum</a></li>
                                                <li><a href="forum-01.html">forum 01</a></li>
                                                <li><a href="forum-detail.html">forum detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">project</a>
                                            <ul class="child">
                                                <li><a href="project.html">project</a></li>
                                                <li><a href="project-01.html">project 01</a></li>
                                                <li><a href="project-detail.html">project detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="login.html">login</a></li>
                                        <li><a href="error.html">404 page</a></li>
                                        <li><a href="coming-soon.html">coming soon</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">New & Event</a>
                                    <ul class="child">
                                        <li><a href="#">event</a>
                                            <ul class="child">
                                                <li><a href="event.html">event</a></li>
                                                <li><a href="event-01.html">event 01</a></li>
                                                <li><a href="event-02.html">event 02</a></li>
                                                <li><a href="event-detail.html">event detail</a></li>
                                                <li><a href="event-listing.html">event listing</a></li>
                                            </ul>	
                                        </li>
                                        <li><a href="#">news</a>
                                            <ul class="child">
                                                <li><a href="news.html">news page</a></li>
                                                <li><a href="news-post.html">news post</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="contact-us.html">Contact Us</a></li>
                            </ul>									
                        </div>
                        <!--DL Menu Start-->
                        <div id="kode-responsive-navigation1" class="dl-menuwrapper">
                            <button class="dl-trigger">Open Menu</button>
                            <ul class="dl-menu">
                                <li><a class="active" href="index-2.html">Home</a></li>
                                <li class="menu-item kode-parent-menu"><a href="#">Services</a>
                                    <ul class="dl-submenu">
                                        <li><a href="service.html">Services</a></li>
                                        <li><a href="service-02.html">Services 02</a></li>
                                        <li><a href="service-detail.html">Services detail</a></li>
                                        <li><a href="service-detail2.html">Services detail 02</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item kode-parent-menu"><a href="#">Government</a>
                                    <ul class="dl-submenu">
                                        <li><a href="team.html">team</a></li>
                                        <li><a href="mayor.html">mayor</a></li>
                                        <li><a href="goverment.html">goverment</a></li>
                                        <li><a href="goverment-grid.html">goverment grid</a></li>
                                        <li><a href="health-department.html">health department</a></li>
                                        <li><a href="health-department02.html">health department 02 </a></li>
                                    </ul>
                                </li>
                                <li class="menu-item kode-parent-menu"><a href="#">business</a>
                                    <ul class="dl-submenu">
                                        <li><a href="business.html">business</a></li>
                                        <li><a href="business-detail.html">business detail</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item kode-parent-menu"><a href="#">Resident</a>
                                    <ul class="dl-submenu">
                                        <li><a href="resident.html">Resident</a></li>
                                        <li><a href="resident-detail.html">Resident detail</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item kode-parent-menu"><a href="#">feature</a>
                                    <ul class="dl-submenu">
                                        <li><a href="#">blog</a>
                                            <ul class="dl-submenu">
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="blog-list.html">blog list</a></li>
                                                <li><a href="blog-detail.html">blog detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">forum</a>
                                            <ul class="dl-submenu">
                                                <li><a href="forum.html">forum</a></li>
                                                <li><a href="forum-01.html">forum 01</a></li>
                                                <li><a href="forum-detail.html">forum detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">project</a>
                                            <ul class="dl-submenu">
                                                <li><a href="project.html">project</a></li>
                                                <li><a href="project-01.html">project 01</a></li>
                                                <li><a href="project-detail.html">project detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="login.html">login</a></li>
                                        <li><a href="error.html">404 page</a></li>
                                        <li><a href="coming-soon.html">coming soon</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item kode-parent-menu"><a href="#">New & Event</a>
                                    <ul class="dl-submenu">
                                        <li><a href="#">event</a>
                                            <ul class="dl-submenu">
                                                <li><a href="event.html">event</a></li>
                                                <li><a href="event-01.html">event 01</a></li>
                                                <li><a href="event-02.html">event 02</a></li>
                                                <li><a href="event-detail.html">event detail</a></li>
                                                <li><a href="event-listing.html">event listing</a></li>
                                            </ul>	
                                        </li>
                                        <li><a href="#">news</a>
                                            <ul class="dl-submenu">
                                                <li><a href="news.html">news page</a></li>
                                                <li><a href="news-post.html">news post</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="contact-us.html">Contact Us</a></li>
                            </ul>
                        </div>
                        <!--DL Menu END-->
                    </div>
                    <div class="col-md-3">
                        <div class="city_top_form">
                            <div class="city_top_search">
                                <input type="text" placeholder="Search">
                                <a href="#"><i class="fa fa-search"></i></a>
                            </div>
                            <a class="top_user" href="login.html"><i class="fa fa-user"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
        <!--CITY TOP NAVIGATION END-->
    </header>