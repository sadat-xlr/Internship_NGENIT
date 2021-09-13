@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="{{url('contact-messages')}}">All Query</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Compose</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Mail Compose</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" action="{{url('/sendMail')}}" id="sendMail" onsubmit="sendMail(event)">
                    <fieldset>
                        <div class="success text-center alert alert-success hidden" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="mailto">To :</label>
                            <div class="controls">
                                <input class="form-control" name="mailto" placeholder="To:" value="{{$query->email}}">
                                <p class="error email text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="subject">Subject :</label>
                            <div class="controls">
                                <input class="form-control" name="subject" placeholder="Subject:" value="{{$query->subject}}">
                                <p class="error subject text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Query :</label>
                            <div class="controls">
                                <p> {{$query->message}}</p>
                            </div>
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Mailbody :</label>
                            <div class="controls">
                                <textarea class="cleditor" name="mailbody" rows="3"></textarea>
                                <p class="error mailbody text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Send email</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div><!--/span-->
    </div><!--/row-->
@endsection