@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="{{url('/cloud-datacenter')}}">System Integration</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">All Content</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All System Integration Related Content</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table id="example2" class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>Title</th>
                            <th>
                                action
                                <a href="{{url('/create-system-integration')}}" class="btn btn-success btn-sm">
                                    <i class="halflings-icon white plus"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($systemIntegrations as $systemIntegration)
                            <tr>
                                <td>{{$systemIntegration->topic}}</td>
                                <td>{{$systemIntegration->title}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{url('edit-system-integration/'.$systemIntegration->id)}}" class="btn btn-warning btn-sm">
                                            <i class="halflings-icon white edit"></i>
                                        </a>
                                        {{-- <a href="#" class="delete-digitalInnovation btn btn-danger btn-sm" data-id="{{$digitalInnovation->id}}">
                                            <i class="halflings-icon white trash"></i>
                                        </a> --}}
                                        <form action="{{ url('/delete-system-integration', ['id' => $systemIntegration->id]) }}" method="post">
                                            <input class="btn btn-default" type="submit" value="Delete" onclick="return confirm('Are you sure want to delete this data?')"/>
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!--/span-->
    </div><!--/row-->
@endsection