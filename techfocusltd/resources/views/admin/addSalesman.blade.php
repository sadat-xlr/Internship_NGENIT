@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Salesmen</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Add Salesmen</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Salesmen</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" role="form" method="post" action="{{url('salesmen')}}">
                    {{csrf_field()}}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="salesmanName">Salesman Name :</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="salesmanName"
                                       placeholder="salesmanName Here" required>
                                <p class="error salesmanName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="designation">Designation :</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="designation"
                                       placeholder="designation Here" required>
                                <p class="error designation text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="email">E-mail :</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="email"
                                       placeholder="email Here" required>
                                <p class="error email text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="phone">Phone :</label>
                            <div class="controls">
                                <input type="number" class="form-control" name="phone"
                                       placeholder="phone Here" required>
                                <p class="error phone text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="zipCode">Zip-code:</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="zipCode" placeholder="Zip-code  here...">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="country">Country:</label>
                            <div class="controls">
                                <select class="form-control" name="country">
                                    <option value="">Select Country</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="division">State:</label>
                            <div class="controls">
                                <select class="form-control" name="division">
                                    <option value="">Select State</option>
                                    <option value="Dhaka">Dhaka</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="city">Town / City:</label>
                            <div class="controls">
                                <select class="form-control" name="city">
                                    <option value="">Select Town / City</option>
                                    <option value="Dhaka">Dhaka</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="address">Address :</label>
                            <div class="controls">
                                <textarea placeholder="Your address here..." class="form-control" name="address"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="password">Password :</label>
                            <div class="controls">
                                <input type="password" name="password" class="form-control" placeholder="password  here...">
                                <p class="error password text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div><!--/span-->
    </div><!--/row-->
@endsection