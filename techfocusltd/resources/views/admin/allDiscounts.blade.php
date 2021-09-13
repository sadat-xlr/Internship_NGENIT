@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Coupon</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">All Coupons</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Coupons</h2>
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
                            <th>Coupon code</th>
                            <th>Coupon type</th>
                            <th>Coupon amount</th>
                            <th>Product IDs</th>
                            <th>Usage / Limit</th>
                            <th>Expiry date</th>
                            <th>
                                action
                                <a href="{{url('discounts/create')}}" class="btn btn-success btn-sm">
                                    <i class="halflings-icon white plus"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($discounts as $discount)
                        <tr id="discount{{$discount->id}}">
                            <td>{{$discount->coupon_code}}</td>
                            <td>
                                @if($discount->discount_unit == 0)
                                    Percentage discount
                                @elseif($discount->discount_unit  == 1)
                                    Fixed cart discount
                                @else
                                    Fixed product discount
                                @endif
                            </td>
                            <td>{{$discount->discount_value}}</td>
                            <td>{{$discount->product_id}}</td>
                            <td>{{$discount->client()->count()}}/{{$discount->limit_per_coupon}}</td>
                            <td>{{$discount->valid_until}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="#" class="show-discount btn btn-info btn-sm" data-id="{{$discount->id}}" data-product_id="{{$discount->product_id}}" data-exclude_product_id="{{$discount->exclude_product_id}}" data-category_id="{{$discount->category_id}}" data-exclude_category_id="{{$discount->exclude_category_id}}" data-limit_per_coupon="{{$discount->limit_per_coupon}}" data-limit_per_client="{{$discount->limit_per_client}}" data-discount_value="{{$discount->discount_value}}" data-discount_unit="{{$discount->discount_unit}}" data-valid_from="{{$discount->valid_from}}" data-valid_until="{{$discount->valid_until}}" data-coupon_code="{{$discount->coupon_code}}" data-minimum_order_value="{{$discount->minimum_order_value}}" data-maximum_order_value="{{$discount->maximum_order_value}}" data-is_free_shipping_active="{{$discount->is_free_shipping_active}}" data-maximum_discount_amount="{{$discount->maximum_discount_amount}}" data-is_redeem_allowed="{{$discount->is_redeem_allowed}}">
                                        <i class="halflings-icon white eye-open"></i>
                                    </a>
                                    <a href="{{url('discounts/'.$discount->id.'/edit')}}" class="edit-discount btn btn-warning btn-sm">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a href="#" class="delete-discount btn btn-danger btn-sm" data-id="{{$discount->id}}">
                                        <i class="halflings-icon white trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->

    {{-- Modal Form Show Coupon --}}
    <div id="show" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label" for="coupon_code">Coupon code :</label>
                            <div id="cp_code" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="is_redeem_allowed">Is reward point allowed :</label>
                            <div id="is_ra" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="discount_unit">Discount type :</label>
                            <div id="ds_unit" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="discount_value">Coupon amount :</label>
                            <div id="ds_value" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="valid_from">Valid from :</label>
                            <div id="vl_form" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="valid_until">Valid till :</label>
                            <div id="vl_untill" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="minimum_order_value">Minimum spend :</label>
                            <div id="mn_or_val" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="maximum_order_value">Maximum spend :</label>
                            <div id="mx_or_val" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="maximum_discount_amount">Maximum discount amount :</label>
                            <div id="mx_ds_am" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="is_free_shipping_active">Allow free shipping :</label>
                            <div id="is_f_s_a" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="product_id">Products :</label>
                            <div id="pr_id" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="Exclude products">Exclude products :</label>
                            <div id="ex_pr_id" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="category_id">Product categories :</label>
                            <div id="ct_id" class="controls" ></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="Exclude categories">Exclude categories :</label>
                            <div id="ex_ct_id" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="limit_per_coupon">Usage limit per coupon :</label>
                            <div id="lm_per_cp" class="controls"></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="limit_per_client">Usage limit per user :</label>
                            <div id="lm_per_user" class="controls"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    {{-- Modal Form Edit and Delete Post --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">

                    {{-- Form Delete Post --}}
                    <input type="hidden" name="_method1" value="DELETE">
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

@section('script')

    //Date picker
    $('#valid_from, #valid_until, #evalid_from, #evalid_until').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: true,
        todayHighlight: true
    })

    //Initialize Select2 Elements
    $('.select2').select2()

@endsection