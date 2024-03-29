@extends('layouts.admin')

@section('title')
    <title>Dadavaai | Dashboard</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@endsection

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                @php
                    $products = \App\Product::select('id')->get();
                @endphp
                <h3>{{count($products)}}</h3>

            <p>Total Product</p>
            </div>
            <div class="icon">
            <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                @php
                    $Orders = \App\Order::select('id')->get();
                @endphp
                <h3>{{count($Orders)}}</h3>

            <p>Total Orders</p>
            </div>
            <div class="icon">
            <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('all-order')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                @php
                    $clients = \App\Client::select('id')->get();
                @endphp
                <h3>{{count($clients)}}</h3>

            <p>Client Registrations</p>
            </div>
            <div class="icon">
            <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                @php
                    $preOrders = \App\Preorder::select('id')->get();
                @endphp
                <h3>{{count($preOrders)}}</h3>

            <p>Booking Order</p>
            </div>
            <div class="icon">
            <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">

         <!-- quick email widget -->
        <div class="box box-info">
            <div class="box-header">
            <i class="fa fa-envelope"></i>

            <h3 class="box-title">Quick Email</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
            <!-- /. tools -->
            </div>
            <form action="{{url('/sendMail')}}" id="sendMail" onsubmit="sendMail(event)">
                <div class="box-body">
                    <div class="success text-center alert alert-success hidden" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="form-group">
                    <input type="email" class="form-control" name="mailto" placeholder="Email to:" required>
                    </div>
                    <div class="form-group">
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                    </div>
                    <div>
                    <textarea id="editor1" name="mailbody" class="textarea" placeholder="Message"
                                style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                    </div>
                </div>
                <div class="box-footer clearfix">
                <button type="submit" class="pull-right btn btn-default">Send
                    <i class="fa fa-arrow-circle-right"></i></button>
                </div>
            </form>
        </div>

        <!-- Custom tabs (Charts with tabs)-->
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
            <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
            <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding">
            <!-- Morris chart - Sales -->
            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
        </div>
        <!-- /.nav-tabs-custom -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">


        <!-- solid sales graph -->
        <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
            <i class="fa fa-th"></i>

            <h3 class="box-title">Sales Graph</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
            </div>
            </div>
            <div class="box-body border-radius-none">
            <div class="chart" id="line-chart" style="height: 250px;"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-border">
            <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                        data-fgColor="#39CCCC">

                <div class="knob-label">Mail-Orders</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                        data-fgColor="#39CCCC">

                <div class="knob-label">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                        data-fgColor="#39CCCC">

                <div class="knob-label">In-Store</div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->

        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
            <i class="fa fa-calendar"></i>

            <h3 class="box-title">Calendar</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                </ul>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
            </div>
            <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
            <!--The calendar -->
            <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">
            <div class="row">
                <div class="col-sm-6">
                <!-- Progress bars -->
                <div class="clearfix">
                    <span class="pull-left">Task #1</span>
                    <small class="pull-right">90%</small>
                </div>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                </div>

                <div class="clearfix">
                    <span class="pull-left">Task #2</span>
                    <small class="pull-right">70%</small>
                </div>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                <div class="clearfix">
                    <span class="pull-left">Task #3</span>
                    <small class="pull-right">60%</small>
                </div>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                </div>

                <div class="clearfix">
                    <span class="pull-left">Task #4</span>
                    <small class="pull-right">40%</small>
                </div>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            </div>
        </div>
        <!-- /.box -->

        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) --> 
@endsection