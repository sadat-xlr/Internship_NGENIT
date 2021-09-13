@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Coupon</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Add Coupons</a>
    </li>
@endsection

@section('adminContent')

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon edit"></i><span class="break"></span>Add coupon</h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" role="form" method="post" action="{{url('discounts')}}">
                        {{csrf_field()}}
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="coupon_code">Coupon code :</label>
                                <div class="controls">
                                    <input type="text" name="coupon_code" placeholder="Coupon code Here" required>
                                    <p class="error coupon_code text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="is_redeem_allowed">Is reward point allowed :</label>
                                <div class="controls">
                                    <select class="form-control" id="is_redeem_allowed" name="is_redeem_allowed" required>
                                        <option value="0">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="discount_unit">Discount type :</label>
                                <div class="controls">
                                    <select class="form-control" name="discount_unit" id="discount_unit" required>
                                        <option value="0">Percentage discount</option>
                                        <option value="1">Fixed cart discount</option>
                                        <option value="2">Fixed product discount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="discount_value">Coupon amount :</label>
                                <div class="controls">
                                    <input type="number" class="form-control" id="discount_value" name="discount_value" placeholder="Coupon amount Here" required>
                                    <p class="error discount_value text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="valid_from">Valid from :</label>
                                <div class="controls">
                                    <input type="datetime-local" name="valid_from">
                                    <p class="error valid_from text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="valid_until">Valid till :</label>
                                <div class="controls">
                                    <input type="datetime-local" name="valid_until">
                                    <p class="error valid_until text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="minimum_order_value">Minimum spend :</label>
                                <div class="controls">
                                    <input type="number" class="form-control" id="minimum_order_value" name="minimum_order_value" placeholder="Minimum spend Here">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="maximum_order_value">Maximum spend :</label>
                                <div class="controls">
                                    <input type="number" class="form-control" id="maximum_order_value" name="maximum_order_value"
                                           placeholder="Maximum spend Here">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="maximum_discount_amount">Maximum discount amount :</label>
                                <div class="controls">
                                    <input type="number" class="form-control" id="maximum_discount_amount" name="maximum_discount_amount" placeholder="Maximum discount amount Here">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="is_free_shipping_active">Allow free shipping :</label>
                                <div class="controls">
                                    <select class="form-control" id="is_free_shipping_active" name="is_free_shipping_active">
                                        <option value="0">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="selectError1">Products :</label>
                                <div class="controls">
                                    <select id="selectError1" name="product_id[]" multiple data-rel="chosen">
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->productName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="selectError2">Exclude Products :</label>
                                <div class="controls">
                                    <select id="selectError2" name="exclude_product_id[]" multiple data-rel="chosen">
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->productName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="selectError3">Product categories :</label>
                                <div class="controls">
                                    <select id="selectError3" name="category_id[]" multiple data-rel="chosen">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="selectError4">Exclude categories :</label>
                                <div class="controls">
                                    <select id="selectError4" name="exclude_category_id[]" multiple data-rel="chosen">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="limit_per_coupon">Usage limit per coupon :</label>
                                <div class="controls">
                                    <input type="number" class="form-control" id="limit_per_coupon" name="limit_per_coupon" placeholder="Usage limit per coupon Here">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="limit_per_client">Usage limit per user :</label>
                                <div class="controls">
                                    <input type="number" class="form-control" id="limit_per_client" name="limit_per_client" placeholder="Usage limit per user Here">
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