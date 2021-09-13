@extends('layouts.admin')

@section('breadcrumbhead')
    Sent
@endsection

@section('breadcrumb')
    <li class="active">Sent</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{url('/compose')}}" class="btn btn-primary btn-block margin-bottom">Compose</a>

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
                        <li class="active"><a href="{{url('/mailbox')}}"><i class="fa fa-inbox"></i> Inbox
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
                    <h3 class="box-title">Sent</h3>

                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <input type="text" class="form-control input-sm" placeholder="Search Mail">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3>{{$sent->subject}}</h3>
                        <h5>To: {{$sent->mail_to}}
                            <span class="mailbox-read-time pull-right">{{$sent->created_at}}</span></h5>
                    </div>
                    <!-- /.mailbox-read-info -->
                    <div class="mailbox-controls with-border text-center">
                        <div class="btn-group">
                            <button type="button" data-url="{{url('sents/'.$sent->id)}}" data-id="{{$sent->id}}" class="btn btn-default btn-sm delete-sentMail" data-toggle="tooltip" data-container="body" title="Delete">
                                <i class="fa fa-trash-o"></i></button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                                <i class="fa fa-reply"></i></button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                                <i class="fa fa-share"></i></button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                            <i class="fa fa-print"></i></button>
                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        {!! html_entity_decode($sent->mail_body) !!}
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                        <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
                    </div>
                    <button data-url="{{url('sents/'.$sent->id)}}" data-id="{{$sent->id}}" type="button" class="btn btn-default delete-sentMail"><i class="fa fa-trash-o"></i> Delete</button>
                    <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    {{-- Modal Form Delete Post --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">

                    {{-- Form Delete Post --}}
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="deleteContent">
                        Are You sure want to delete this data?
                        <span class="hidden id" style="display:none"></span>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class="glyphicon"></span>
                    </button>

                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class="glyphicon glyphicon"></span>close
                    </button>

                </div>
            </div>
        </div>
    </div>
@endsection