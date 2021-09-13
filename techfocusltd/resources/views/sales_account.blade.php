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
                            <a href="#" title="">My-account</a>
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
                                <li class="nav-item"><a href="#dashboard" class="nav-link active" data-toggle="tab" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a></li>
                                <li class="nav-item"><a href="#my-profile" class="nav-link" data-toggle="tab" role="tab" aria-controls="my-profile" aria-selected="true">My Profile</a></li>
                                <li class="nav-item"><a href="#my-deals" class="nav-link" data-toggle="tab" role="tab" aria-controls="my-deals" aria-selected="false">My Deals</a></li>
                                <li class="nav-item"><a href="#my-DMAR" class="nav-link" data-toggle="tab" role="tab" aria-controls="my-DMAR" aria-selected="false">My DMAR</a></li>
                                <li class="nav-item" ><a href="#my-plan" class="nav-link" data-toggle="tab" role="tab" aria-controls="my-plan" aria-selected="false">My Plan</a></li>
                                <li class="nav-item"><a href="#my-clients" class="nav-link" data-toggle="tab" role="tab" aria-controls="my-clients" aria-selected="false">My Clients</a></li>
                                <li class="nav-item" ><a href="#my-target" class="nav-link" data-toggle="tab" role="tab" aria-controls="my-target" aria-selected="false">My Target</a></li>
                                <li class="nav-item"><a href="#my-incentive" class="nav-link" data-toggle="tab" role="tab" aria-controls="my-incentive" aria-selected="false">My Incentive</a></li>
                                <li class="nav-item"><a href="#" id="logout">logout</a></li>
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
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <h3>{{$salesman->deal->count()}}</h3>
                                            <p>My Deals</p>
                                        </div>
                                        <div class="icon">
                                            <i class="zmdi zmdi-case"></i>
                                        </div>
                                        <a href="#my-deals" class="nav-link small-box-footer" data-toggle="tab" role="tab" aria-controls="my-deals" aria-selected="false">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3>{{$salesman->dmar->count()}}</h3>
                                            <p>My DMAR</p>
                                        </div>
                                        <div class="icon">
                                            <i class="zmdi zmdi-account"></i>
                                        </div>
                                        <a href="#my-DMAR" class="nav-link small-box-footer" data-toggle="tab" role="tab" aria-controls="my-DMAR" aria-selected="false">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h3>{{$salesman->plan->count()}}</h3>
                                            <p>My Plan</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>
                                        <a href="#my-plan" class="nav-link small-box-footer" data-toggle="tab" role="tab" aria-controls="my-plan" aria-selected="false">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h3>{{$salesman->client->count()}}</h3>
                                            <p>My Clients</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>
                                        <a href="#my-clients" class="nav-link small-box-footer" data-toggle="tab" role="tab" aria-controls="my-clients" aria-selected="false">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!--Small box ends-->
                            <!--Small box row2 start-->
                            <div class="row">
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-cyan">
                                        <div class="inner">
                                            <h3>{{$salesman->target->count()}}</h3>
                                            <p>My Target</p>
                                        </div>
                                        <div class="icon">
                                            <i class="zmdi zmdi-pin-account"></i>
                                        </div>
                                        <a href="#my-target" class="nav-link small-box-footer" data-toggle="tab" role="tab" aria-controls="my-target" aria-selected="false">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-jade">
                                        <div class="inner">
                                            <h3>{{$salesman->incentives->count()}}</h3>
                                            <p>My Incentive</p>
                                        </div>
                                        <div class="icon">
                                            <i class="zmdi zmdi-truck"></i>
                                        </div>
                                        <a href="#my-incentive" class="nav-link small-box-footer" data-toggle="tab" role="tab" aria-controls="my-incentive" aria-selected="false">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-Apricot">
                                        <div class="inner">
                                            <h3>Profile</h3>
                                            <p>profile</p>
                                        </div>
                                        <div class="icon">
                                            <i class="zmdi zmdi-money"></i>
                                        </div>
                                        <a href="#my-profile" class="nav-link small-box-footer" data-toggle="tab" role="tab" aria-controls="my-profile" aria-selected="true">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-peru">
                                        <div class="inner">
                                            <h3>logout</h3>
                                            <p>logout</p>
                                        </div>
                                        <div class="icon">
                                            <i class="zmdi zmdi-plus-circle"></i>
                                        </div>
                                        <a href="#" data-toggle="tab" id="logout" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!--Small box row2 ends-->
                        </div>
                        <div class="tab-pane" id="my-profile" role="tabpanel" aria-labelledby="my-profile-tab">
                            <div class="box-checkout">
                                <form action="{{url('sales_update')}}" id="update-salesman" onsubmit="sales_update(event)">
                                    <div class="billing-fields">
                                        <div class="fields-title">
                                            <h3>Privacy</h3>
                                            <span></span>
                                            <div class="clearfix"></div>
                                        </div><!-- /.fields-title -->
                                        <div class="fields-content">
                                            <div class="field-row">
                                                <label class="control-label" for="email">Email :</label>
                                                <input type="email" name="email" placeholder="Email address here..." value="{{$salesman->email}}" disabled>
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
                                                <button id="update_sales_pass">Update password</button>
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
                                                    <input type="text" name="salesmanName" placeholder="Your name here..." value="{{$salesman->salesmanName}}" required>
                                                </p>
                                                <p class="field-one-half">
                                                    <label for="phone">Phone *</label>
                                                    <input type="text" name="phone" placeholder="Phone here..." value="{{$salesman->phone}}" required>
                                                </p>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="field-row">
                                                <p class="field-one-half">
                                                    <label class="control-label" for="designation">Designation *:</label>
                                                    <input type="text" name="designation" placeholder="designation here..." value="{{$salesman->designation}}" required>
                                                </p>
                                                <p class="field-one-half">
                                                    <label class="control-label" for="office_email">Postcode / ZIP :</label>
                                                    <input type="text" name="zipCode" placeholder="Zip-code  here..." value="{{$salesman->zipCode}}">
                                                </p>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="field-row">
                                                <p class="field-one-half">
                                                    <label for="company-name">Town / City </label>
                                                    <select name="city">
                                                        <option value="">Select Town / City</option>
                                                        <option value="Dhaka" @if ($salesman->city === 'Dhaka') selected @endif>Dhaka</option>
                                                    </select>
                                                </p>
                                                <p class="field-one-half">
                                                    <label for="phone">State / Division </label>
                                                    <select name="division">
                                                        <option value="">Select State</option>
                                                        <option value="Dhaka" @if ($salesman->division === 'Dhaka') selected @endif>Dhaka</option>
                                                    </select>
                                                </p>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="field-row">
                                                <p class="field-one-half">
                                                    <label>Country </label>
                                                    <select name="country">
                                                        <option value="">Select Country</option>
                                                        <option value="Bangladesh" @if ($salesman->country === 'Bangladesh') selected @endif>Bangladesh</option>
                                                    </select>
                                                </p>
                                                <p class="field-one-half">
                                                    <label for="address">Address </label>
                                                    <textarea placeholder="Your address here..." class="custom-textarea" name="address" style="height: 50px;">{{$salesman->address}}</textarea>
                                                </p>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="field-row">
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" name="id" value="{{$salesman->id}}">
                                                <button type="submit">Save changes</button>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div><!-- /.fields-content -->
                                    </div><!-- /.billing-fields -->
                                </form><!-- /.checkout -->
                            </div><!-- /.box-checkout -->
                        </div>
                        <div class="tab-pane" id="my-deals" role="tabpanel" aria-labelledby="my-deals-tab">
                            <div class="table-content table-responsive">
                                <table class="table" id="deal-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                action
                                                <a href="#" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-deal">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </th>
                                            <th>Date</th>
                                            <th>Client</th>
                                            <th>Solution</th>
                                            <th>Product</th>
                                            <th>PQR</th>
                                            <th>Value</th>
                                            <th>Probability Status</th>
                                            <th>Probability Reason</th>
                                            <th>Comments by Sales</th>
                                            <th>Comemnts By Manager</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salesman->deal as $deal)
                                        <tr id="deal{{$deal->id}}">
                                            <td>
                                                <a href="#" class="edit-deal btn btn-warning btn-sm" data-id="{{$deal->id}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" class="delete-deal btn btn-danger btn-sm" data-id="{{$deal->id}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                            <td>{{$deal->date}}</td>
                                            <td>{{$deal->client->companyName}}</td>
                                            <td>{{$deal->category_solution}}</td>
                                            <td>{{$deal->category_product}}</td>
                                            <td>{{number_format($deal->pqr)}}</td>
                                            <td>{{number_format($deal->pq_value)}}</td>
                                            <td>{{$deal->probability_status}}</td>
                                            <td>{{$deal->probability_reason}}</td>
                                            <td>{{$deal->comments_by_sales}}</td>
                                            <td>{{$deal->comments_by_manager}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="my-DMAR" role="tabpanel" aria-labelledby="my-DMAR-tab">
                            <div class="table-content table-responsive">
                                <table class="table" id="dmar-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                action
                                                <a href="#" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-dmar">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </th>
                                            <th>Status</th>
                                            <th>Area</th>
                                            <th>Date</th>
                                            <th>Visiting Client Type</th>
                                            <th>Sector</th>
                                            <th>Company Name</th>
                                            <th>Acitivity</th>
                                            <th>Current Status</th>
                                            <th>Solution</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Mini Category</th>
                                            <th>Product (s)</th>
                                            <th>Contact</th>
                                            <th>Comments by Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salesman->dmar as $dmar)
                                        <tr id="dmar{{$dmar->id}}">
                                            <td>
                                                <a href="#" class="edit-dmar btn btn-warning btn-sm" data-id="{{$dmar->id}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" class="delete-dmar btn btn-danger btn-sm" data-id="{{$dmar->id}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                            <td>{{$dmar->status}}</td>
                                            <td>{{$dmar->area}}</td>
                                            <td>{{$dmar->date}}</td>
                                            <td>{{$dmar->clientType}}</td>
                                            <td>{{$dmar->sector->sectorName}}</td>
                                            <td>{{$dmar->companyName}}</td>
                                            <td>{{$dmar->acitivity}}</td>
                                            <td>{{$dmar->current_status}}</td>
                                            <td>{{$dmar->solution}}</td>
                                            <td>{{$dmar->minicategory->subcategory->category->categoryName}}</td>
                                            <td>{{$dmar->minicategory->subcategory->categoryName}}</td>
                                            <td>{{$dmar->minicategory->miniCategoryName}}</td>
                                            <td>{{$dmar->product}}</td>
                                            <td>{{$dmar->contact}}</td>
                                            <td>{{$dmar->comment_by_sales}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="my-plan" role="tabpanel" aria-labelledby="my-plan-tab">
                            <div class="table-content table-responsive">
                                <table class="table" id="plan-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                action
                                                <a href="#" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-plan">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </th>
                                            <th>Date</th>
                                            <th>Client</th>
                                            <th>Area</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Desig.</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Solution</th>
                                            <th>Category</th>
                                            <th>Sub-Catg.</th>
                                            <th>product</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                            <th>Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salesman->plan as $plan)
                                        @php $i = 0; @endphp
                                        @foreach($plan->client->contactpeople as $contactpeople)
                                            @php $i ++; @endphp
                                        @endforeach
                                        <tr id="plan{{$plan->id}}">
                                            <td rowspan="{{$i}}">
                                                <a href="#" class="edit-plan btn btn-warning btn-sm" data-id="{{$plan->id}}" data-minicategory="{{$plan->minicategory->miniCategoryName}}" data-minicategory_id="{{$plan->minicategory_id}}" data-subcategory="{{$plan->minicategory->subcategory->categoryName}}" data-subcategory_id="{{$plan->minicategory->subcategory_id}}" data-category="{{$plan->minicategory->subcategory->category->categoryName}}" data-category_id="{{$plan->minicategory->subcategory->category_id}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" class="delete-plan btn btn-danger btn-sm" data-id="{{$plan->id}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                            <td rowspan="{{$i}}">{{$plan->date}}</td>
                                            <td rowspan="{{$i}}">{{$plan->client->companyName}}</td>
                                            <td rowspan="{{$i}}">{{$plan->client->area}}</td>
                                            <td rowspan="{{$i}}">{{$plan->client->address}}</td>
                                            @foreach($plan->client->contactpeople as $contactpeople)
                                                <td>{{$contactpeople->contactPersonName}}</td>
                                                <td>{{$contactpeople->designation}}</td>
                                                <td>{{$contactpeople->cell}}</td>
                                                @if($i > 1)
                                                    @php break; @endphp
                                                @endif
                                            @endforeach
                                            <td rowspan="{{$i}}">{{$plan->client->email_office}}</td>
                                            <td rowspan="{{$i}}">{{$plan->solution}}</td>
                                            <td rowspan="{{$i}}">{{$plan->minicategory->subcategory->category->categoryName}}</td>
                                            <td rowspan="{{$i}}">{{$plan->minicategory->subcategory->categoryName}}</td>
                                            <td rowspan="{{$i}}">{{$plan->product}}</td>
                                            <td rowspan="{{$i}}">{{$plan->details}}</td>
                                            <td rowspan="{{$i}}">{{$plan->status}}</td>
                                            <td rowspan="{{$i}}">{{$plan->comments}}</td>
                                        </tr>
                                        @if($i > 1)
                                            @php $j = 0; @endphp
                                            @foreach($plan->client->contactpeople as $contactpeople)
                                                @php $j++; @endphp
                                                @if($j > 1)
                                                    <tr>
                                                        <td>{{$contactpeople->contactPersonName}}</td>
                                                        <td>{{$contactpeople->designation}}</td>
                                                        <td>{{$contactpeople->cell}}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="my-clients" role="tabpanel" aria-labelledby="my-clients-tab">
                            <div class="table-content table-responsive">
                                <table class="table" id="client-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                action
                                                <a href="#" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-client">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </th>
                                            <th>Sector</th>
                                            <th>SubSector</th>
                                            <th>Company Name</th>
                                            <th>Address</th>
                                            <th>Area</th>
                                            <th>Off Ph</th>
                                            <th>Contact</th>
                                            <th>Desig.</th>
                                            <th>Dept.</th>
                                            <th>Perso. Ph</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Tier</th>
                                            <th>Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salesman->client as $client)
                                        @php $i = 0; @endphp
                                        @foreach($client->contactpeople as $contactpeople)
                                            @php $i ++; @endphp
                                        @endforeach
                                        <tr id="client{{$client->id}}">
                                            <td rowspan="{{$i}}">
                                                <a href="#" class="edit-client btn btn-warning btn-sm" data-id="{{$client->id}}" data-companyName="{{$client->companyName}}" data-address="{{$client->address}}" data-area="{{$client->area}}" data-phone="{{$client->phone}}" data-sector="{{$client->subsector->sector_id}}" data-subsector="{{$client->subsector_id}}" data-subsectorname="{{$client->subsector->subSectorName}}" data-comments="{{$client->comments}}" data-web="{{$client->web}}" data-email_office="{{$client->email_office}}" data-status="{{$client->status}}" data-cell_office="{{$client->cell_office}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" class="delete-client btn btn-danger btn-sm" data-id="{{$client->id}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                            <td rowspan="{{$i}}">
                                                {{$client->subsector->sector->sectorName}}
                                            </td>
                                            <td rowspan="{{$i}}">{{$client->subsector->subSectorName}}</td>
                                            <td rowspan="{{$i}}">{{$client->companyName}}</td>
                                            <td rowspan="{{$i}}">{{$client->address}}</td>
                                            <td rowspan="{{$i}}">{{$client->area}}</td>
                                            <td rowspan="{{$i}}">{{$client->phone}}</td>
                                            @foreach($client->contactpeople as $contactpeople)
                                            <td>{{$contactpeople->contactPersonName}}</td>
                                            <td>{{$contactpeople->designation}}</td>
                                            <td>{{$contactpeople->department}}</td>
                                            <td>{{$contactpeople->cell}}</td>
                                                @if($i > 1)
                                                    @php break; @endphp
                                                @endif
                                            @endforeach
                                            <td rowspan="{{$i}}">{{$client->email_office}}</td>
                                            <td rowspan="{{$i}}">{{$client->status}}</td>
                                            <td rowspan="{{$i}}">
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
                                            <td rowspan="{{$i}}">{{$client->comments}}</td>
                                        </tr>
                                        @if($i > 1)
                                            @php $j = 0; @endphp
                                        @foreach($client->contactpeople as $contactpeople)
                                            @php $j++; @endphp
                                            @if($j > 1)
                                        <tr>
                                            <td>{{$contactpeople->contactPersonName}}</td>
                                            <td>{{$contactpeople->designation}}</td>
                                            <td>{{$contactpeople->department}}</td>
                                            <td>{{$contactpeople->cell}}</td>
                                        </tr>
                                            @endif
                                        @endforeach
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="my-target" role="tabpanel" aria-labelledby="my-target-tab">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Salesman</th>
                                            <th>Year</th>
                                            <th>Quarter</th>
                                            <th>Month</th>
                                            <th>Sales target</th>
                                            <th>New Client target</th>
                                            <th>Existing Client target</th>
                                            <th>Physical Mkt</th>
                                            <th>Phone Mkt</th>
                                            <th>Social Mkt</th>
                                            <th>Email Mkt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salesman->target as $salesmentarget)
                                        <tr>
                                            <td>{{$salesmentarget->salesman->salesmanName}}</td>
                                            <td>{{$salesmentarget->year}}</td>
                                            <td>{{$salesmentarget->quarter}}</td>
                                            <td>{{$salesmentarget->month}}</td>
                                            <td>{{number_format($salesmentarget->sales_target)}}</td>
                                            <td>{{$salesmentarget->new_client_target}}</td>
                                            <td>{{$salesmentarget->existing_client_target}}</td>
                                            <td>{{$salesmentarget->physical_mkt}}</td>
                                            <td>{{$salesmentarget->phone_mkt}}</td>
                                            <td>{{$salesmentarget->social_mkt}}</td>
                                            <td>{{$salesmentarget->email_mkt}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="my-incentive" role="tabpanel" aria-labelledby="my-incentive-tab">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Client</th>
                                            <th>Sales VALUE</th>
                                            <th>INCENTIVE</th>
                                            <th>Status</th>
                                            <th>Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salesman->incentives as $incentive)
                                        <tr>
                                            <td>{{$incentive->created_at}}</td>
                                            <td>{{$incentive->mydeal->client->companyName}}</td>
                                            <td>{{number_format($incentive->sales_value)}}</td>
                                            <td>{{number_format($incentive->incentive_value)}}</td>
                                            <td>{{$incentive->mydeal->final_status}}</td>
                                            <td>
                                                @if($incentive->is_paid)
                                                    Paid
                                                @else
                                                    Not paid
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col-lg-9 col-md-8 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </main><!-- /#shop -->

    <!-- Modal add-client -->
    <div class="modal fade" id="create-client" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Client</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-checkout">
                        <form action="{{url('clients')}}" id="form-add-client">
                            <div class="billing-fields">
                                <div class="fields-title">
                                    <h3>Client info</h3>
                                    <span></span>
                                    <div class="clearfix"></div>
                                </div><!-- /.fields-title -->
                                <div class="fields-content">
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="companyName">Company Name *</label>
                                            <input type="text" name="companyName" placeholder="Company Name here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label>Status *</label>
                                            <select name="status">
                                                <option value="">Select Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Sector *</label>
                                            <select name="sector" id="sector">
                                                <option value="">Select Sector</option>
                                                @foreach($sectors as $sector)
                                                <option value="{{$sector->id}}">{{$sector->sectorName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="address">SubSector *</label>
                                            <select name="subsector_id" id="subsector_id">
                                                <option value="">Select SubSector</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="area">Area *</label>
                                            <select name="area">
                                                <option value="">Select Area</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label class="control-label" for="cell_office">Mobile ( Official ) *:</label>
                                            <input type="number" name="cell_office" placeholder="Mobile ( Official ) here..."  required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="address">Address *</label>
                                            <input type="text" name="address" placeholder="Address here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label class="control-label" for="email_office">Email ( Official ) *:</label>
                                            <input type="email" name="email_office" placeholder="Email ( Official ) here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label class="control-label" for="phone">Phone No. *:</label>
                                            <input type="number" name="phone" placeholder="Phone No. here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="web">Web Address *</label>
                                            <input type="text" name="web" placeholder="Web Address here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- /.fields-content -->
                                <div class="fields-title">
                                    <h3>Contact Person</h3>
                                    <span></span>
                                    <div class="clearfix"></div>
                                </div><!-- /.fields-title -->
                                <div class="fields-content" id="contactPerson">
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <a href="#" type="button" id="addPerson" class="btn btn-success btn-sm">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <label class="control-label" for="contactPersonName">Contact Person *:</label>
                                            <input type="text" name="contactPersonName[]" placeholder="Contact Person here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label class="control-label" for="designation">Designation *:</label>
                                            <input type="text" name="designation[]" placeholder="designation here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label class="control-label" for="department">Department *:</label>
                                            <input type="text" name="department[]" placeholder="Department here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label class="control-label" for="cell">Mobile ( Personal  ) *:</label>
                                            <input type="number" name="cell[]" placeholder="Mobile ( Personal  ) here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- /.fields-content -->
                                <div class="fields-content">
                                    <div class="field-row">
                                        <label class="control-label" for="comments">Comments :</label>
                                        <textarea type="text" class="custom-textarea" name="comments" placeholder="Comments here..." ></textarea>
                                    </div>
                                    <div class="field-row">
                                        <input type="submit">
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- /.fields-content -->
                            </div><!-- /.billing-fields -->
                        </form><!-- /.checkout -->
                    </div><!-- /.box-checkout -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit-client -->
    <div class="modal fade" id="edit-client" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Client</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-checkout">
                        <form action="{{url('clients')}}" id="form-update-client">
                            <div class="billing-fields">
                                <div class="fields-title">
                                    <h3>Client info</h3>
                                    <span></span>
                                    <div class="clearfix"></div>
                                </div><!-- /.fields-title -->
                                <div class="fields-content">
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="companyName">Company Name *</label>
                                            <input type="text" name="companyName" id="companyName" placeholder="Company Name here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label>Status *</label>
                                            <select name="status" id="status">
                                                <option value="">Select Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Sector *</label>
                                            <select name="sector" id="esector">
                                                <option value="">Select Sector</option>
                                                @foreach($sectors as $sector)
                                                    <option value="{{$sector->id}}">{{$sector->sectorName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="address">SubSector *</label>
                                            <select name="subsector_id" id="esubsector_id">
                                                <option value="">Select SubSector</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="area">Area *</label>
                                            <select name="area" id="area">
                                                <option value="">Select Area</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label class="control-label" for="cell_office">Mobile ( Official ) *:</label>
                                            <input type="number" name="cell_office" id="cell_office" placeholder="Mobile ( Official ) here..."  required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="address">Address *</label>
                                            <input type="text" name="address" id="address" placeholder="Address here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label class="control-label" for="email_office">Email ( Official ) *:</label>
                                            <input type="email" name="email_office" id="email_office" placeholder="Email ( Official ) here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label class="control-label" for="phone">Phone No. *:</label>
                                            <input type="number" name="phone" id="phone" placeholder="Phone No. here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="web">Web Address *</label>
                                            <input type="text" name="web" id="web" placeholder="Web Address here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- /.fields-content -->
                                <div class="fields-title">
                                    <h3>Contact Person</h3>
                                    <span></span>
                                    <div class="clearfix"></div>
                                </div><!-- /.fields-title -->
                                <div class="fields-content" id="econtactPerson">
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <button type="button" id="addPerson" class="btn btn-success btn-sm">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <label class="control-label" for="contactPersonName">Contact Person *:</label>
                                            <input type="text" name="contactPersonName[]" placeholder="Contact Person here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label class="control-label" for="designation">Designation *:</label>
                                            <input type="text" name="designation[]" placeholder="designation here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label class="control-label" for="department">Department *:</label>
                                            <input type="text" name="department[]" placeholder="Department here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label class="control-label" for="cell">Mobile ( Personal  ) *:</label>
                                            <input type="number" name="cell[]" placeholder="Mobile ( Personal  ) here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- /.fields-content -->
                                <input type="hidden" id="fid" />
                                <input type="hidden" name="_method" value="PUT" />
                                <div class="fields-content">
                                    <div class="field-row">
                                        <label class="control-label" for="comments">Comments :</label>
                                        <textarea type="text" class="custom-textarea" name="comments" id="comments" placeholder="Comments here..." ></textarea>
                                    </div>
                                    <div class="field-row">
                                        <input type="submit">
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- /.fields-content -->
                            </div><!-- /.billing-fields -->
                        </form><!-- /.checkout -->
                    </div><!-- /.box-checkout -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Form Delete --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModalLabel">Large Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    {{-- Form Delete --}}
                    <div class="deleteContent">
                        Are You sure want to delete this data?
                        <span class="hidden id" style="display:none"></span>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class="glyphicon glyphicon-trash"></span>
                    </button>

                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class="glyphicon glyphicon"></span>close
                    </button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal add-plan -->
    <div class="modal fade" id="create-plan" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Plan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-checkout">
                        <form action="{{url('plans')}}" id="form-add-plan">
                            <div class="billing-fields">
                                <div class="fields-content">
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="month">Month *</label>
                                            <select name="month" required>
                                                <option value="">Select Month</option>
                                                <option value="January">January </option>
                                                <option value="February">February </option>
                                                <option value="March">March </option>
                                                <option value="April">April </option>
                                                <option value="May">May </option>
                                                <option value="June">June </option>
                                                <option value="July">July </option>
                                                <option value="August">August </option>
                                                <option value="September">September </option>
                                                <option value="October">October </option>
                                                <option value="November">November </option>
                                                <option value="December">December </option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>Year *</label>
                                            <input type="number" name="year" placeholder="Year here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Marketing Date *</label>
                                            <input type="date" name="date" placeholder="Marketing Date here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="marketingType">Marketing Type *</label>
                                            <select name="marketingType" required>
                                                <option value="">Select Marketing Type</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="area">Client *</label>
                                            <select name="client_id" required>
                                                <option value="">Select Client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}">{{$client->companyName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>Status *</label>
                                            <select name="status" required>
                                                <option value="">Select Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <label for="product">Product *</label>
                                        <input type="text" name="product" placeholder="Product here..." required>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <label class="control-label" for="details">Details *</label>
                                        <textarea type="text" class="custom-textarea" name="details" placeholder="Details here..."  required></textarea>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Category *</label>
                                            <select name="category_id" id="catId" required>
                                                <option value="">Choose a Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>SubCategory *</label>
                                            <select name="subcategory_id" id="subCatId" required>
                                                <option value="">Choose a SubCategory</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>MiniCategory *</label>
                                            <select name="minicategory_id" id="miniCatId" required>
                                                <option value=''>Choose Mini-Category</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label class="control-label" for="solution">Solution </label>
                                            <input type="text" name="solution" placeholder="Solution here...">
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <label class="control-label" for="comments">Comments </label>
                                        <textarea type="text" class="custom-textarea" name="comments" placeholder="Comments here..." ></textarea>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <input type="submit">
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- /.fields-content -->
                            </div><!-- /.billing-fields -->
                        </form><!-- /.checkout -->
                    </div><!-- /.box-checkout -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit-plan -->
    <div class="modal fade" id="edit-plan" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Plan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-checkout">
                        <form action="{{url('plans')}}" id="form-update-plan">
                            <div class="billing-fields">
                                <div class="fields-content">
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="month">Month *</label>
                                            <select name="month" id="month" required>
                                                <option value="">Select Month</option>
                                                <option value="January">January </option>
                                                <option value="February">February </option>
                                                <option value="March">March </option>
                                                <option value="April">April </option>
                                                <option value="May">May </option>
                                                <option value="June">June </option>
                                                <option value="July">July </option>
                                                <option value="August">August </option>
                                                <option value="September">September </option>
                                                <option value="October">October </option>
                                                <option value="November">November </option>
                                                <option value="December">December </option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>Year *</label>
                                            <input type="number" name="year" id="year" placeholder="Year here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Marketing Date *</label>
                                            <input type="date" name="date" id="date" placeholder="Marketing Date here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="marketingType">Marketing Type *</label>
                                            <select name="marketingType" id="marketingType" required>
                                                <option value="">Select Marketing Type</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="area">Client *</label>
                                            <select name="client_id" id="client_id" required>
                                                <option value="">Select Client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}">{{$client->companyName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>Status *</label>
                                            <select name="status" id="status" required>
                                                <option value="">Select Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <label for="product">Product *</label>
                                        <input type="text" name="product" id="product" placeholder="Product here..." required>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <label class="control-label" for="details">Details *</label>
                                        <textarea type="text" class="custom-textarea" name="details" id="details" placeholder="Details here..."  required></textarea>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Category *</label>
                                            <select name="category_id" id="ecatId" required>
                                                <option value="">Choose a Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>SubCategory *</label>
                                            <select name="subcategory_id" id="esubCatId" required>
                                                <option value="">Choose a SubCategory</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>MiniCategory *</label>
                                            <select name="minicategory_id" id="eminiCatId" required>
                                                <option value=''>Choose Mini-Category</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label class="control-label" for="solution">Solution </label>
                                            <input type="text" name="solution" id="solution" placeholder="Solution here...">
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <label class="control-label" for="comments">Comments </label>
                                        <textarea type="text" class="custom-textarea" name="comments" id="plan_comments" placeholder="Comments here..." ></textarea>
                                        <div class="clearfix"></div>
                                    </div>
                                    <input type="hidden" id="fid" />
                                    <input type="hidden" name="_method" value="PUT" />
                                    <div class="field-row">
                                        <input type="submit">
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- /.fields-content -->
                            </div><!-- /.billing-fields -->
                        </form><!-- /.checkout -->
                    </div><!-- /.box-checkout -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal add-dmar -->
    <div class="modal fade" id="create-dmar" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add DMAR</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-checkout">
                        <form action="{{url('dmars')}}" id="form-add-dmar">
                            <div class="billing-fields">
                                <div class="fields-content">
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Status *</label>
                                            <select name="status" required>
                                                <option value="">Select Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>Area *</label>
                                            <select name="area" required>
                                                <option value="">Select Area</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Marketing Date *</label>
                                            <input type="date" name="date" placeholder="Marketing Date here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="clientType">Visiting Client Type *</label>
                                            <select name="clientType" required>
                                                <option value="">Select Visiting Client Type</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Sector *</label>
                                            <select name="sector_id" id="dmar_sector">
                                                <option value="">Select Sector</option>
                                                @foreach($sectors as $sector)
                                                    <option value="{{$sector->id}}">{{$sector->sectorName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="companyName">Company Name *</label>
                                            <input type="text" name="companyName" placeholder="Company Name here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="acitivity">Acitivity *</label>
                                            <select name="acitivity" required>
                                                <option value="">Select Acitivity</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="current_status">Current Status *</label>
                                            <select name="current_status" required>
                                                <option value="">Select Current Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Category *</label>
                                            <select name="category_id" class="category_id" required>
                                                <option value="">Choose a Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>SubCategory *</label>
                                            <select name="subcategory_id" class="subcategory_id" required>
                                                <option value="">Choose a SubCategory</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>MiniCategory *</label>
                                            <select name="minicategory_id" class="minicategory_id" required>
                                                <option value=''>Choose Mini-Category</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label class="control-label" for="solution">Solution </label>
                                            <input type="text" name="solution" placeholder="Solution here...">
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="product">Product *</label>
                                            <input type="text" name="product" placeholder="Product here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="contact">Contact *</label>
                                            <input type="text" name="contact" placeholder="Contact here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <label class="control-label" for="comment_by_sales">Comments </label>
                                        <textarea type="text" class="custom-textarea" name="comment_by_sales" placeholder="Comments here..." ></textarea>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <input type="submit">
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- /.fields-content -->
                            </div><!-- /.billing-fields -->
                        </form><!-- /.checkout -->
                    </div><!-- /.box-checkout -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit-dmar -->
    <div class="modal fade" id="edit-dmar" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add DMAR</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-checkout">
                        <form action="{{url('dmars')}}" id="form-update-dmar">
                            <div class="billing-fields">
                                <div class="fields-content">
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Status *</label>
                                            <select name="status" id="status" required>
                                                <option value="">Select Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>Area *</label>
                                            <select name="area" id="area" required>
                                                <option value="">Select Area</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Marketing Date *</label>
                                            <input type="date" name="date" id="dmar_date" placeholder="Marketing Date here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="clientType">Visiting Client Type *</label>
                                            <select name="clientType" id="clientType" required>
                                                <option value="">Select Visiting Client Type</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Sector *</label>
                                            <select name="sector_id" id="edmar_sector">
                                                <option value="">Select Sector</option>
                                                @foreach($sectors as $sector)
                                                    <option value="{{$sector->id}}">{{$sector->sectorName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="companyName">Company Name *</label>
                                            <input type="text" name="companyName" id="dmar_companyName" placeholder="Company Name here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="acitivity">Acitivity *</label>
                                            <select name="acitivity" id="acitivity" required>
                                                <option value="">Select Acitivity</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="current_status">Current Status *</label>
                                            <select name="current_status" id="current_status" required>
                                                <option value="">Select Current Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Category *</label>
                                            <select name="category_id" class="category_id" required>
                                                <option value="">Choose a Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>SubCategory *</label>
                                            <select name="subcategory_id" class="subcategory_id" required>
                                                <option value="">Choose a SubCategory</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>MiniCategory *</label>
                                            <select name="minicategory_id" class="minicategory_id" required>
                                                <option value=''>Choose Mini-Category</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label class="control-label" for="solution">Solution </label>
                                            <input type="text" name="solution" id="dmar_solution" placeholder="Solution here...">
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="product">Product *</label>
                                            <input type="text" name="product" id="dmar_product" placeholder="Product here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="contact">Contact *</label>
                                            <input type="text" name="contact" id="contact" placeholder="Contact here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <label class="control-label" for="comment_by_sales">Comments </label>
                                        <textarea type="text" class="custom-textarea" name="comment_by_sales" id="comment_by_sales" placeholder="Comments here..." ></textarea>
                                        <div class="clearfix"></div>
                                    </div>
                                    <input type="hidden" id="fid" />
                                    <input type="hidden" name="_method" value="PUT" />
                                    <div class="field-row">
                                        <input type="submit">
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- /.fields-content -->
                            </div><!-- /.billing-fields -->
                        </form><!-- /.checkout -->
                    </div><!-- /.box-checkout -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal add-deal -->
    <div class="modal fade" id="create-deal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Deal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-checkout">
                        <form action="{{url('mydeals')}}" id="form-add-deal">
                            <div class="billing-fields">
                                <div class="fields-content">
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Date *</label>
                                            <input type="date" name="date" placeholder="Marketing Date here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label>Quarter *</label>
                                            <select name="quarter" required>
                                                <option value="">Select Quarter</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>PQR *</label>
                                            <input type="number" name="pqr" placeholder="PQR here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label>PQ Value *</label>
                                            <input type="number" name="pq_value" placeholder="PQ Value here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="area">Client *</label>
                                            <select name="client_id" id="deal_client_id" required>
                                                <option value="">Select Client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}">{{$client->companyName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>Category *</label>
                                            <select name="category_id" class="category_id" required>
                                                <option value="">Choose a Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>SubCategory *</label>
                                            <select name="subcategory_id" class="subcategory_id" required>
                                                <option value="">Choose a SubCategory</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>MiniCategory *</label>
                                            <select name="minicategory_id" class="minicategory_id" required>
                                                <option value=''>Choose Mini-Category</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="current_status">Current Status *</label>
                                            <select name="current_status" required>
                                                <option value="">Select Current Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="closing_status">Closing Status *</label>
                                            <select name="closing_status" required>
                                                <option value="">Select Closing Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="probability_status">Probability Status *</label>
                                            <select name="probability_status" required>
                                                <option value="">Select Probability Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="probability_reason">Probability Reason *</label>
                                            <select name="probability_reason" required>
                                                <option value="">Select Probability Reason</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="category_product">Product *</label>
                                            <input type="text" name="category_product" placeholder="Product here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="category_solution	">Solution *</label>
                                            <input type="text" name="category_solution" placeholder="Solution here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="final_status">Final Status *</label>
                                            <select name="final_status" required>
                                                <option value="">Select Final Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="project_status">Project Status *</label>
                                            <select name="project_status" required>
                                                <option value="">Select Project Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <label class="control-label" for="comments_by_sales">Comments by Sales </label>
                                        <textarea type="text" class="custom-textarea" name="comments_by_sales" placeholder="Comments by Sales here..." ></textarea>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <label class="control-label" for="comments_by_manager">Comemnts By Manager </label>
                                        <textarea type="text" class="custom-textarea" name="comments_by_manager" placeholder="Comemnts By Manager here..." ></textarea>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <input type="submit">
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- /.fields-content -->
                            </div><!-- /.billing-fields -->
                        </form><!-- /.checkout -->
                    </div><!-- /.box-checkout -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit-deal -->
    <div class="modal fade" id="edit-deal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Deal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-checkout">
                        <form action="{{url('mydeals')}}" id="form-update-deal">
                            <div class="billing-fields">
                                <div class="fields-content">
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>Date *</label>
                                            <input type="date" name="date" id="deal_date" placeholder="Marketing Date here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label>Quarter *</label>
                                            <select name="quarter" id="quarter" required>
                                                <option value="">Select Quarter</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>PQR *</label>
                                            <input type="number" name="pqr" id="pqr" placeholder="PQR here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label>PQ Value *</label>
                                            <input type="number" name="pq_value" id="pq_value" placeholder="PQ Value here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="area">Client *</label>
                                            <select name="client_id" id="deal_client_id" required>
                                                <option value="">Select Client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}">{{$client->companyName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>Category *</label>
                                            <select name="category_id" class="category_id" required>
                                                <option value="">Choose a Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label>SubCategory *</label>
                                            <select name="subcategory_id" class="subcategory_id" required>
                                                <option value="">Choose a SubCategory</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label>MiniCategory *</label>
                                            <select name="minicategory_id" class="minicategory_id" required>
                                                <option value=''>Choose Mini-Category</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="current_status">Current Status *</label>
                                            <select name="current_status" id="deal_current_status" required>
                                                <option value="">Select Current Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="closing_status">Closing Status *</label>
                                            <select name="closing_status" id="closing_status" required>
                                                <option value="">Select Closing Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="probability_status">Probability Status *</label>
                                            <select name="probability_status" id="probability_status" required>
                                                <option value="">Select Probability Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="probability_reason">Probability Reason *</label>
                                            <select name="probability_reason" id="probability_reason" required>
                                                <option value="">Select Probability Reason</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="category_product">Product *</label>
                                            <input type="text" name="category_product" id="category_product" placeholder="Product here..." required>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="category_solution	">Solution *</label>
                                            <input type="text" name="category_solution" id="category_solution" placeholder="Solution here..." required>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <p class="field-one-half">
                                            <label for="final_status">Final Status *</label>
                                            <select name="final_status" id="final_status" required>
                                                <option value="">Select Final Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <p class="field-one-half">
                                            <label for="project_status">Project Status *</label>
                                            <select name="project_status" id="project_status" required>
                                                <option value="">Select Project Status</option>
                                                <option value="dummy">dummy</option>
                                            </select>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <label class="control-label" for="comments_by_sales">Comments by Sales </label>
                                        <textarea type="text" class="custom-textarea" name="comments_by_sales" id="comments_by_sales" placeholder="Comments by Sales here..." ></textarea>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row">
                                        <label class="control-label" for="comments_by_manager">Comemnts By Manager </label>
                                        <textarea type="text" class="custom-textarea" name="comments_by_manager" id="comments_by_manager" placeholder="Comemnts By Manager here..." ></textarea>
                                        <div class="clearfix"></div>
                                    </div>
                                    <input type="hidden" id="fid" />
                                    <input type="hidden" name="_method" value="PUT" />
                                    <div class="field-row">
                                        <input type="submit">
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- /.fields-content -->
                            </div><!-- /.billing-fields -->
                        </form><!-- /.checkout -->
                    </div><!-- /.box-checkout -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('.table').DataTable();
        });
        // Logout function
        $(document).on('click', '#logout', function(e){
            // Stop the browser from submitting the form.
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: base_url + '/sales_logout',
                success: function(data){
                    $(location).attr("href", "/sales_login");
                }
            });
        });

        // Retrieve subcategories from category dynamically using ajax & jquery
        $('#catId').change(function() {
            $.ajax({
                type:"GET",
                url:base_url+"/getSubCat/"+$('#catId').val(),
                success : function(results) {
                    $("#subCatId").html(results);
                }
            });
        });

        // Retrieve minicategories from subcategory dynamically using ajax & jquery
        $('#subCatId').change(function() {
            $.ajax({
                type:"GET",
                url:base_url+"/getMiniCat/"+$('#subCatId').val(),
                success : function(results) {
                    $("#miniCatId").html(results);
                }
            });
        });

        // Retrieve subcategories from category dynamically using ajax & jquery
        $('#ecatId').change(function() {
            $.ajax({
                type:"GET",
                url:base_url+"/getSubCat/"+$('#ecatId').val(),
                success : function(results) {
                    $("#esubCatId").html(results);
                }
            });
        });

        // Retrieve minicategories from subcategory dynamically using ajax & jquery
        $('#esubCatId').change(function() {
            $.ajax({
                type:"GET",
                url:base_url+"/getMiniCat/"+$('#esubCatId').val(),
                success : function(results) {
                    $("#eminiCatId").html(results);
                }
            });
        });

        // Retrieve subcategories from category dynamically using ajax & jquery
        $('.category_id').change(function() {
            $.ajax({
                type:"GET",
                url:base_url+"/getSubCat/"+$(this).val(),
                success : function(results) {
                    $(".subcategory_id").html(results);
                }
            });
        });

        // Retrieve minicategories from subcategory dynamically using ajax & jquery
        $('.subcategory_id').change(function() {
            $.ajax({
                type:"GET",
                url:base_url+"/getMiniCat/"+$(this).val(),
                success : function(results) {
                    $(".minicategory_id").html(results);
                }
            });
        });

        // Logout function
        function sales_update(e){
            // Stop the browser from submitting the form.
            e.preventDefault();
            // Get the form
            var  form = $('#update-salesman');

            // Serialize the form data.
            var formData = $(form).serialize();

            // Submit the form using AJAX.
            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: formData,
                success: function(data){
                    // Show success message
                    $('#message').modal('show');
                    $('.wmessage').css('color', 'green');
                    $('.modal-title').css('color', 'green');
                    $('.modal-title').text('Congrats!');
                    $('.wmessage').text('Account details updated successfully.');
                }
            });
        };

        // -- ajax Form update password --
        $(document).on('click', '#update_sales_pass', function() {
            $.ajax({
                type: 'post',
                url: base_url + '/update_sales_pass',
                data: {
                    'oldpassword': $('input[name=oldpassword]').val(),
                    'password': $('input[name=password]').val(),
                    'id': $('input[name=id]').val(),
                    '_method': $('input[name=_method]').val()
                },
                success: function(data){
                    if ((data.errors)) {
                        $('.wmessage').html('');
                        $('#message').modal('show');
                        $('.wmessage').css('color', 'red');
                        $('.modal-title').css('color', 'red');
                        $('.modal-title').text('Oops!');
                        if (typeof data.errors.oldpassword !== 'undefined') {
                            $('.wmessage').append("<li class='err'>" + data.errors.oldpassword + "</li>");
                        };
                        if (typeof data.errors.password !== 'undefined') {
                            $('.wmessage').append("<li class='err'>" + data.errors.password + "</li>");
                        };
                        if (typeof data.errors.error !== 'undefined') {
                            $('.wmessage').append("<li class='err'>" + data.errors.error + "</li>");
                        };
                    } else {
                        $('#message').modal('show');
                        $('.wmessage').css('color', 'green');
                        $('.modal-title').css('color', 'green');
                        $('.modal-title').text('Congrats!');
                        $('.wmessage').text('Password updated successfully.');
                    }
                }
            });
            $('input[name=oldpassword]').val('');
            $('input[name=password]').val('');
        });
    </script>
@endsection