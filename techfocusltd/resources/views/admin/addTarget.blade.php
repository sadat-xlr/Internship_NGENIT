@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Salesmen target</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Add Salesmen target</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Salesmen target</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" role="form" action="{{url('salesmantargets')}}" method="post">
                    {{csrf_field()}}
                    <div class="control-group">
                        <label class="control-label" for="salesman_id">Salesman :</label>
                        <div class="controls">
                            <select class="form-control salesman_id" name="salesman_id" data-rel="chosen" required>
                                <option value="">Select Salesman</option>
                                @foreach($salesmen as $salesman)
                                    <option value="{{$salesman->id}}">{{$salesman->salesmanName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="month">Month :</label>
                        <div class="controls">
                            <select class="form-control" name="month" data-rel="chosen" required>
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
                            <p class="error month text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="year">Year :</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="year" placeholder="Year Here" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="quarter">Quarter :</label>
                        <div class="controls">
                            <select class="form-control quarter" name="quarter" data-rel="chosen" required>
                                <option value="">Select Quarter</option>
                                    <option value="dummy">dummy</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="new_client_target">New Client target :</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="new_client_target" placeholder="New Client target Here" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="existing_client_target">Existing Client target :</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="existing_client_target" placeholder="Existing Client target Here" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="sales_target">Sales target :</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="sales_target" placeholder="Sales target Here" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="physical_mkt">Physical Mkt :</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="physical_mkt" placeholder="Physical Mkt Here" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="phone_mkt">Phone Mkt :</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="phone_mkt" placeholder="Phone Mkt Here" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="social_mkt">Social Mkt :</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="social_mkt" placeholder="Social Mkt Here" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email_mkt">Email Mkt :</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="email_mkt" placeholder="Email Mkt Here" required>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div><!--/span-->
    </div><!--/row-->
@endsection