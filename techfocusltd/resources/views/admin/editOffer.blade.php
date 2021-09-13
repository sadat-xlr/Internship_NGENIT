@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="#">Offer</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Edit Offer</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Offer</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" id="addOffer-form" method="post" action="{{url('offers/'.$offer->id)}}">
                    <fieldset>
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="control-group">
                            <label class="control-label" for="discount_value">Offer value</label>
                            <div class="controls">
                                <input type="number" class="form-control" name="discount_value"
                                       placeholder="Offer value Here" required value="{{$offer->discount_value}}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="date01">Valid until</label>
                            <div class="controls">
                                <input type="datetime-local" name="valid_until" value="{{date("Y-m-d\TH:i:s", strtotime($offer->valid_until))}}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError1">Products</label>
                            <div class="controls">
                                <select id="selectError1" name="product_id[]" multiple data-rel="chosen">
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}" @foreach($offer->products as $products) @if($products->id == $product->id) selected @endif @endforeach>{{$product->productName}}</option>
                                    @endforeach
                                </select>
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