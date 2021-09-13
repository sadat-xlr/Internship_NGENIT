@extends('layouts.admin')

@section('breadcrumbhead')
    Compose
    <small>New Message</small>
@endsection

@section('breadcrumb')
    <li class="active">Compose</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{url('/mailbox')}}" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Folders</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="{{url('/mailbox')}}"><i class="fa fa-inbox"></i> Inbox
                                <span class="label label-primary pull-right">12</span></a></li>
                        <li><a href="{{url('sents')}}"><i class="fa fa-envelope-o"></i> Sent</a></li>
                        <li><a href="{{url('drafts')}}"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                        <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
                        </li>
                        <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Labels</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Compose New Message</h3>
                </div>
                <form action="{{url('/sendMail')}}" id="sendMail" onsubmit="sendMail(event)">
                    <!-- /.box-header -->
                    <div class="success text-center alert alert-success hidden" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <input class="form-control" name="mailto" placeholder="To:">
                            <p class="error email text-center alert alert-danger hidden"></p>
                        </div>
                        <div class="form-group">
                            <select class="form-control select2" multiple="multiple" name="email[]" data-placeholder="Select email" style="width: 100%;">
                                <option value="All">All</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->email}}">{{$client->email}}</option>
                                @endforeach
                                @foreach($subscription as $subscription)
                                    <option value="{{$subscription->email}}">{{$subscription->email}}</option>
                                @endforeach
                            </select>
                            <p class="error email text-center alert alert-danger hidden"></p>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="subject" placeholder="Subject:">
                            <p class="error subject text-center alert alert-danger hidden"></p>
                        </div>
                        <div class="form-group">
                            <textarea id="editor1" name="mailbody" class="form-control" style="height: 300px"></textarea>
                            <p class="error mailbody text-center alert alert-danger hidden"></p>
                        </div>
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Attachment
                                <input type="file" name="attachment">
                            </div>
                            <p class="help-block">Max. 32MB</p>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="button" class="btn btn-default" id="addDraft"><i class="fa fa-pencil"></i> Draft</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                        </div>
                        <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@section('script')
    //Initialize Select2 Elements
    $('.select2').select2()
@endsection