@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#"> Target vs Achivement</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Target vs Achievement</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table id="example1" class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Salesman</th>
                            <th>Year</th>
                            <th>Quarter</th>
                            <th>Month</th>
                            <th>Sales target</th>
                            <th>Sales achieve</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($salesmentarget as $salesmentarget)
                        @php
                            if ($salesmentarget->month == 'January'){
                                $month = 1;
                            }elseif ($salesmentarget->month == 'February'){
                                $month = 2;
                            }elseif ($salesmentarget->month == 'March'){
                                $month = 3;
                            }elseif ($salesmentarget->month == 'April'){
                                $month = 4;
                            }elseif ($salesmentarget->month == 'May'){
                                $month = 5;
                            }elseif ($salesmentarget->month == 'June'){
                                $month = 6;
                            }elseif ($salesmentarget->month == 'July'){
                                $month = 7;
                            }elseif ($salesmentarget->month == 'August'){
                                $month = 8;
                            }elseif ($salesmentarget->month == 'September'){
                                $month = 9;
                            }elseif ($salesmentarget->month == 'October'){
                                $month = 10;
                            }elseif ($salesmentarget->month == 'November'){
                                $month = 11;
                            }else{
                                $month = 12;
                            }
                            $achieve = \App\Mydeal::whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $salesmentarget->year)->sum('pq_value');
                        @endphp
                        <tr id="salesmentarget{{$salesmentarget->id}}">
                            <td>{{$salesmentarget->salesman->salesmanName}}</td>
                            <td>{{$salesmentarget->year}}</td>
                            <td>{{$salesmentarget->quarter}}</td>
                            <td>{{$salesmentarget->month}}</td>
                            <td>৳ {{number_format($salesmentarget->sales_target)}}</td>
                            <td>৳ {{number_format($achieve)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!--/span-->
    </div><!--/row-->
@endsection

