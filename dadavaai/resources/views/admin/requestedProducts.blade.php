@extends('layouts.admin')
@section('title')
    <title>Products</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Product
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>products</li>
        <li class="active">products</li>
    </ol>
@endsection

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Product</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>SubCategory</th>
                    <th>MiniCategory</th>
                    <th>Brand</th>
                    <th>RegularPrice</th>
                    <th>
                        action
                        {{-- <a href="#" class="addProduct btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </a> --}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr id="product{{$product->id}}">
                        <td>{{$product->productName}}</td>
                        <td><img src="{{asset('storage/images/product/'.$product->image->image1)}}" height="100px" width="100px"/></td>
                        <td>{{$product->sku}}</td>
                        <td>{{$product->category->categoryName}}</td>
                        <td>{{$product->subcategory->subCategoryName}}</td>
                        <td>{{$product->minicategory->miniCategoryName}}</td>
                        <td>{{$product->brand->brandName}}</td>
                        <td>Tk {{$product->regularPrice}}</td>
                        <td>
                            <div class="table-data-feature">
                                <a href="#" class="show-product btn btn-info btn-sm" data-id="{{$product->id}}" data-delivery_charge="{{$product->delivery_charge}}" data-return_policy="{{strip_tags($product->return_policy)}}" data-measurement="{{$product->measurement}}" data-min_order_qty="{{$product->min_order_qty}}" data-delivery_time="{{$product->delivery_time}}" data-delivery_from="{{$product->delivery_from}}" data-productName="{{$product->productName}}" data-slug="{{$product->slug}}" data-image="{{$product->image->image1}}" data-sku="{{$product->sku}}" data-category="{{$product->category->categoryName}}" data-subcategory="{{$product->subcategory->subCategoryName}}" data-minicategory="{{$product->minicategory->miniCategoryName}}" data-tab="{{$product->tab->tabName}}"  data-brand="{{$product->brand->brandName}}" data-color="@foreach($product->colors as $color) {{$color->color}} @endforeach" data-size="@foreach($product->sizes as $size) {{$size->size}} @endforeach" data-tag="@foreach($product->tags as $tag) {{$tag->tagName}} @endforeach" data-regularPrice="{{$product->regularPrice}}" @if ($product->deal_id)
                                    data-deal="{{$product->deal->discount_value}}% till {{$product->deal->valid_until}}"
                                @endif  data-availability="@if($product->availability == 0) Yes @else No @endif" data-type="@if($product->type == 0) Featured @else Non-Featured @endif" data-payment="@if($product->paymentOption == 0) Cash on Delivery @else Advance Payment @endif" data-description="{{$product->description}}" data-specification="{{$product->specification}}" data-short_description="{{$product->shortDescription}}" 
                                data-discount="{{$product->discount}}" data-occasion="{{$product->occasion}}" data-promotion="{{$product->promotion}}" data-clearance="{{$product->clearance}}" data-buy_get="{{$product->buy_get}}" >
                                    <i class="fa fa-eye"></i>
                                </a>
                                
                                <a href="#" class="edit-product btn btn-warning btn-sm" data-id="{{$product->id}}" data-delivery_charge="{{$product->delivery_charge}}" data-return_policy="{{strip_tags($product->return_policy)}}" data-measurement="{{$product->measurement}}" data-min_order_qty="{{$product->min_order_qty}}" data-delivery_time="{{$product->delivery_time}}" data-delivery_from="{{$product->delivery_from}}" data-productName="{{$product->productName}}" data-slug="{{$product->slug}}" data-sku="{{$product->sku}}" data-category_id="{{$product->category_id}}" data-subcategory_id="{{$product->subcategory_id}}" data-minicategory_id="{{$product->minicategory_id}}" data-minicategory="{{$product->minicategory->miniCategoryName}}" data-tab_id="{{$product->tab_id}}" data-tab="{{$product->tab->tabName}}"  data-brand_id="{{$product->brand_id}}" data-color="@foreach($product->colors as $color) {{$color->color}} @endforeach" data-size="@foreach($product->sizes as $size) {{$size->size}} @endforeach" data-tag="@foreach($product->tags as $tag) {{$tag->tagName}} @endforeach" data-regularPrice="{{$product->regularPrice}}" data-availability="{{$product->availability}}" data-type="{{$product->type}}" data-payment="{{$product->paymentOption}}"
                                @if ($product->deal_id)
                                    data-deal_id="{{$product->deal_id}}"
                                @endif  
                                data-description="{{$product->description}}" data-specification="{{$product->specification}}" data-subcategory="{{$product->subcategory->subCategoryName}}" data-short_description="{{$product->shortDescription}}" data-discount="{{$product->discount}}" data-occasion="{{$product->occasion}}" data-promotion="{{$product->promotion}}" data-clearance="{{$product->clearance}}" data-buy_get="{{$product->buy_get}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-product btn btn-danger btn-sm" data-id="{{$product->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <a href="#" class="publish-product btn btn-danger btn-sm" data-id="{{$product->id}}">
                                    Publish
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->


    {{-- Modal Form Create Product --}}
    <div id="create" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" id="product-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="productName">Product Name :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="productName" name="productName"
                                       placeholder="productName Here" required>
                                <p class="error productName text-center alert alert-danger hidden"></p>
                            </div>
                            <label class="control-label col-sm-2" for="sku">Product sku :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sku" name="sku"
                                       placeholder="Product sku Here" required>
                                <p class="error sku text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="category_id">Product Category :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="subcategory_id">Product SubCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="subcategory_id" name="subcategory_id" required>
                                    <option value="">Select SubCategory</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            {{-- minicategory --}}
                            <label class="control-label col-sm-2" for="minicategory_id">Product MiniCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="minicategory_id" name="minicategory_id" required>
                                    <option value="">Select MiniCategory</option>
                                </select>
                            </div>

                            {{-- tab --}}
                            <label class="control-label col-sm-2" for="minicategory_id">Product Tab :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="tab_id" name="tab_id" required>
                                    <option value="">Select Tab</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="type">Product Type :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="type" name="type" required>
                                    <option value="0">Featured</option>
                                    <option value="1">Non-Featured</option>
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="paymentOption">Payment option :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="paymentOption" name="paymentOption" required>
                                    <option value="0">Cash On Delivery</option>
                                    <option value="1">Advance Payment</option>
                                </select>
                                <p class="error paymentOption text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="availability">Product Availablity :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="availability" name="availability" required>
                                    <option value="0">Available</option>
                                    <option value="1">Not-Available</option>
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="regularPrice">Product regularPrice :</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="regularPrice" name="regularPrice"
                                       placeholder="Product regularPrice Here">
                                <p class="error regularPrice text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image1">Product Image One :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image1" name="image1" required>
                                <p class="error image1 text-center alert alert-danger hidden"></p>
                            </div>
                            <label class="control-label col-sm-2" for="image2">Product Image Two :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image2" name="image2">
                                <p class="error image2 text-center alert alert-danger hidden"></p>
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image3">Product Image Three :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image3" name="image3">
                                <p class="error image3 text-center alert alert-danger hidden"></p>
                            </div>
                            <label class="control-label col-sm-2" for="image4">Product Image Four :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image4" name="image4">
                                <p class="error image4 text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image5">Product Image Five :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image5" name="image5">
                                <p class="error image5 text-center alert alert-danger hidden"></p>
                            </div>
                            <label class="control-label col-sm-2" for="deal_id">Deal :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="deal_id" name="deal_id">
                                    <option value="0">None</option>
                                    @foreach($deals as $deal)
                                        <option value="{{$deal->id}}">{{$deal->discount_value}} % till {{$deal->valid_until}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- Product Brand --}}
                            <label class="control-label col-sm-2" for="brand_id">Product Brand :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="brand_id" name="brand_id" required>
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->brandName}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                            {{-- Discount --}}
                            <label class="control-label col-sm-2" for="discount">Discount:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="discount" name="discount"
                                       placeholder="Product Discount % Here">
                                <p class="error discount text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- Unit of measure --}}
                            <label class="control-label col-sm-2" for="measurement">Unit of measurement  :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="measurement" name="measurement" required>
                                    <option value="">Select Unit of measurement </option>
                                    <option value="kilogram">kilogram </option>
                                    <option value="meter">meter</option>
                                    <option value="pieces">pieces</option>
                                    <option value="liter">liter</option>
                                    <option value="inch">inch</option>
                                    <option value="gram">gram</option>
                                </select>
                            </div>                            
                            {{-- Minimum order qty --}}
                            <label class="control-label col-sm-2" for="min_order_qty">Minimum order qty:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="min_order_qty" name="min_order_qty"
                                       placeholder="Minimum order qty">
                                <p class="error min_order_qty text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- delivery charge --}}
                            <label class="control-label col-sm-2" for="delivery_charge">Delivery charge  :</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="delivery_charge" name="delivery_charge"
                                       placeholder="delivery charge">
                                <p class="error delivery_charge text-center alert alert-danger hidden"></p>
                            </div>                            
                        </div>

                        
                        <div class="form-group">                           
                            {{-- return policy --}}
                            <label class="control-label col-sm-2" for="return_policy"> Return policy:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control pull-right" name="return_policy" id="return_policy" cols="30" rows="20"></textarea>
                                <p class="error return_policy text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#return_policy').summernote({
                                            placeholder: 'return_policy',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- Estimate time of delivery --}}
                            <label class="control-label col-sm-2" for="delivery_time">Estimate time of delivery  :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="delivery_time" name="delivery_time"
                                       placeholder="Estimate time of delivery">
                                <p class="error delivery_time text-center alert alert-danger hidden"></p>
                            </div>                            
                            {{-- Delivery From --}}
                            <label class="control-label col-sm-2" for="delivery_from">Delivery From:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="delivery_from" name="delivery_from"
                                       placeholder="Delivery From">
                                <p class="error delivery_from text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="other_offer">Other Offers:</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="occasion" value="1">
                                            Occasion
                                        </label>
                                        <label>
                                            <input type="checkbox" name="promotion" value="1">
                                            Promotion
                                        </label>
                                        <label>
                                            <input type="checkbox" name="clearance" value="1">
                                            Clearence
                                        </label>
                                        <label>
                                            <input type="checkbox" name="buy_get" value="1">
                                            Buy-1 & Get-1
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="color">Product Color :</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="checkbox">
                                        @foreach($colors as $color)
                                        <label>
                                            <input type="checkbox" name="color[]" value="{{$color->id}}">
                                            {{$color->color}}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="size">Product Size :</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="checkbox">
                                        @foreach($sizes as $size)
                                        <label>
                                            <input type="checkbox" name="size[]" value="{{$size->id}}">
                                            {{$size->size}}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="tag">Product Tag :</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="checkbox">
                                        @foreach($tags as $tag)
                                        <label>
                                            <input type="checkbox" name="tag[]" value="{{$tag->id}}">
                                            {{$tag->tagName}}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="shortDescription">Product Short Description :</label>
                            <div class="col-sm-10">
                                <textarea id="shortDescription" name="shortDescription" rows="10" cols="80" required></textarea>
                                <p class="error shortDescription text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="description">Product Description :</label>
                            <div class="col-sm-10">
                                <textarea id="description" name="description" rows="10" cols="80" required></textarea>
                                <p class="error description text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="specification">Product Specification :</label>
                            <div class="col-sm-10">
                                <textarea id="specification" name="specification" rows="10" cols="80"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="brandLogo"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit">
                                    <span class="glyphicon glyphicon-plus"></span>Save product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class="glyphicon glyphicon"></span>close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    {{-- Modal Form Update product --}}
    <div id="update" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" id="updateProduct">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="productName">Product Name :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="eproductName" name="productName"
                                       placeholder="productName Here" required>
                                <p class="error eproductName text-center alert alert-danger hidden"></p>
                            </div>
                            <label class="control-label col-sm-2" for="sku">Product sku :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="esku" name="sku"
                                       placeholder="Product sku Here" required>
                                <p class="error esku text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="category_id">Product Category :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="ecategory_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="subcategory_id">Product SubCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="esubcategory_id" name="subcategory_id" required>
                                    <option value="">Select SubCategory</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            
                            {{-- Minicategory edit --}}

                            <label class="control-label col-sm-2" for="minicategory_id">Product MiniCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="eminicategory_id" name="minicategory_id" required>
                                    <option value="">Select MiniCategory</option>
                                </select>
                            </div>

                            {{-- Tab edit --}}
                            <label class="control-label col-sm-2" for="tab_id">Product Tab :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="etab_id" name="tab_id" required>
                                    <option value="">Select Tab</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="type">Product Type :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="etype" name="type" required>
                                    <option value="0">Featured</option>
                                    <option value="1">Non-Featured</option>
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="paymentOption">Payment option :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="epaymentOption" name="paymentOption" required>
                                    <option value="0">Cash On Delivery</option>
                                    <option value="1">Advance Payment</option>
                                </select>
                                <p class="error epaymentOption text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="availability">Product Availablity :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="eavailability" name="availability" required>
                                    <option value="0">Available</option>
                                    <option value="1">Not-Available</option>
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="regularPrice">Product regularPrice :</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="eregularPrice" name="regularPrice"
                                       placeholder="Product regularPrice Here">
                                <p class="error eregularPrice text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image1">Product Image One :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image1" name="image1">
                                <p class="error eimage1 text-center alert alert-danger hidden"></p>
                            </div>
                            <label class="control-label col-sm-2" for="image2">Product Image Two :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image2" name="image2">
                                <p class="error eimage2 text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image3">Product Image Three :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image3" name="image3">
                                <p class="error eimage3 text-center alert alert-danger hidden"></p>
                            </div>
                            <label class="control-label col-sm-2" for="image4">Product Image Four :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image4" name="image4">
                                <p class="error eimage4 text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image5">Product Image Five :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image5" name="image5">
                                <p class="error eimage5 text-center alert alert-danger hidden"></p>
                            </div>
                            <label class="control-label col-sm-2" for="edeal_id">Deal :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="edeal_id" name="deal_id">
                                    <option value="0">None</option>
                                    @foreach($deals as $deal)
                                        <option value="{{$deal->id}}">{{$deal->discount_value}} % till {{$deal->valid_until}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="brand_id">Product Brand :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="ebrand_id" name="brand_id" required>
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->brandName}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                            <label class="control-label col-sm-2" for="discount">Discount:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="ediscount" name="discount"
                                       placeholder="Product Discount % Here">
                                <p class="error ediscount text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- Unit of measure --}}
                            <label class="control-label col-sm-2" for="measurement">Unit of measurement  :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="emeasurement" name="measurement" required>
                                    <option value="">Select Unit of measurement </option>
                                    <option value="kilogram">kilogram </option>
                                    <option value="meter">meter</option>
                                    <option value="pieces">pieces</option>
                                    <option value="liter">liter</option>
                                    <option value="inch">inch</option>
                                    <option value="gram">gram</option>
                                </select>
                            </div>                            
                            {{-- Minimum order qty --}}
                            <label class="control-label col-sm-2" for="min_order_qty">Minimum order qty:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="emin_order_qty" name="min_order_qty"
                                       placeholder="Minimum order qty">
                                <p class="error emin_order_qty text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- Estimate time of delivery --}}
                            <label class="control-label col-sm-2" for="delivery_time">Estimate time of delivery  :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="edelivery_time" name="delivery_time"
                                       placeholder="Estimate time of delivery">
                                <p class="error edelivery_time text-center alert alert-danger hidden"></p>
                            </div>                            
                            {{-- Delivery From --}}
                            <label class="control-label col-sm-2" for="edelivery_from">Delivery From:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="edelivery_from" name="delivery_from"
                                       placeholder="Delivery From">
                                <p class="error edelivery_from text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- delivery charge --}}
                            <label class="control-label col-sm-2" for="delivery_charge">Delivery charge  :</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="edelivery_charge" name="delivery_charge"
                                       placeholder="delivery charge">
                                <p class="error edelivery_charge text-center alert alert-danger hidden"></p>
                            </div>                            
                        </div>

                        
                        <div class="form-group">                           
                            {{-- return policy --}}
                            <label class="control-label col-sm-2" for="return_policy"> Return policy:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control pull-right" name="return_policy" id="ereturn_policy" cols="30" rows="20"></textarea>
                                <p class="error ereturn_policy text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#ereturn_policy').summernote({
                                            placeholder: 'return_policy',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="other_offer">Other Offers:</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="occasion" id="eoccasion" value="1">
                                            Occasion
                                        </label>
                                        <label>
                                            <input type="checkbox" name="promotion" id="epromotion" value="1">
                                            Promotion
                                        </label>
                                        <label>
                                            <input type="checkbox" name="clearance" id="eclearance" value="1">
                                            Clearence
                                        </label>
                                        <label>
                                            <input type="checkbox" name="buy_get" id="ebuy_get" value="1">
                                            Buy-1 & Get-1
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-sm-2" for="color">Product Color :</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="checkbox">
                                        @foreach($colors as $color)
                                            <label>
                                                <input type="checkbox" class="color" name="color[]" value="{{$color->id}}" data-value="{{$color->color}}">{{$color->color}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="size">Product Size :</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="checkbox">
                                        @foreach($sizes as $size)
                                            <label>
                                                <input type="checkbox" class="size" name="size[]" value="{{$size->id}}" data-value="{{$size->size}}">
                                                {{$size->size}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="tag">Product Tag :</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="checkbox">
                                        @foreach($tags as $tag)
                                            <label>
                                                <input type="checkbox" class="tag" name="tag[]" value="{{$tag->id}}" data-value="{{$tag->tagName}}">
                                                {{$tag->tagName}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="shortDescription">Product Short Description :</label>
                            <div class="col-sm-10">
                                <textarea id="eshortDescription" name="shortDescription" rows="10" cols="80" required></textarea>
                                <p class="error eshortDescription text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="description">Product Description :</label>
                            <div class="col-sm-10">
                                <textarea id="uDescription" name="description" rows="10" cols="80" required></textarea>
                                <p class="error edescription text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="specification">Product Specification :</label>
                            <div class="col-sm-10">
                                <textarea id="uSpecification" name="specification" rows="10" cols="80"></textarea>
                                <p class="error especification text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="brandLogo"><input type="hidden" id="ID"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-warning" type="submit">
                                    <span class="glyphicon glyphicon-edit"></span>Update product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class="glyphicon glyphicon"></span>close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    {{-- Modal Form Show POST --}}
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
                        <div class="form-group">
                            <label for="ID" class="control-label col-sm-2">ID :</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="i" disabled>
                            </div>
                            <label class="control-label col-sm-2" for="Product image">Product image :</label>
                            <div class="col-sm-4"><img id="img" style="height: 200px;"/></div>
                        </div>
                        <div class="form-group">
                            <label for="Product sku" class="control-label col-sm-2">Product sku :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sk" disabled>
                            </div>
                            <label for="Product type" class="control-label col-sm-2">Product type :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="tp" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Product category" class="control-label col-sm-2">Product category :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="ct" disabled>
                            </div>
                            <label for="Product subcategory" class="control-label col-sm-2">Product subcategory :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sct" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Product miniCategory" class="control-label col-sm-2">Product miniCategory :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="mnctgr" disabled>
                            </div>

                            <label for="Product miniCategory" class="control-label col-sm-2">Product tab :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="stab" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Product brand" class="control-label col-sm-2">Product brand :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="br" disabled>
                            </div>
                            <label for="Product availability" class="control-label col-sm-2">Product availability :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="av" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Product Deal" class="control-label col-sm-2">Deal :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sdeal" disabled>
                            </div>
                            <label for="Product regularPrice" class="control-label col-sm-2">Product regularPrice :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="rPrice" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Product brand" class="control-label col-sm-2">Product slug :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sl" disabled>
                            </div>

                            <label class="control-label col-sm-2" for="discount">Discount:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="sdiscount" name="discount"
                                       placeholder="Product Discount % Here">
                                <p class="error ediscount text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- Unit of measure --}}
                            <label class="control-label col-sm-2" for="measurement">Unit of measurement  :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="smeasurement" name="measurement">
                            </div>                            
                            {{-- Minimum order qty --}}
                            <label class="control-label col-sm-2" for="min_order_qty">Minimum order qty:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="smin_order_qty" name="min_order_qty"
                                       placeholder="Minimum order qty">
                                <p class="error smin_order_qty text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- Estimate time of delivery --}}
                            <label class="control-label col-sm-2" for="delivery_time">Estimate time of delivery  :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sdelivery_time" name="delivery_time"
                                       placeholder="Estimate time of delivery">
                                <p class="error sdelivery_time text-center alert alert-danger hidden"></p>
                            </div>                            
                            {{-- Delivery From --}}
                            <label class="control-label col-sm-2" for="edelivery_from">Delivery From:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sdelivery_from" name="delivery_from"
                                       placeholder="Delivery From">
                                <p class="error sdelivery_from text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- delivery charge --}}
                            <label class="control-label col-sm-2" for="delivery_charge">Delivery charge  :</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="sdelivery_charge" name="delivery_charge"
                                       placeholder="delivery charge">
                                <p class="error sdelivery_charge text-center alert alert-danger hidden"></p>
                            </div>                            
                        </div>

                        
                        <div class="form-group">                           
                            {{-- return policy --}}
                            <label class="control-label col-sm-2" for="return_policy"> Return policy:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control pull-right" name="return_policy" id="sreturn_policy" cols="30" rows="20" required></textarea>
                                <p class="error sreturn_policy text-center alert alert-danger hidden"></p>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-sm-2" for="other_offer">Other Offers:</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="occasion" id="soccasion" value="1">
                                            Occasion
                                        </label>
                                        <label>
                                            <input type="checkbox" name="promotion" id="spromotion" value="1">
                                            Promotion
                                        </label>
                                        <label>
                                            <input type="checkbox" name="clearance" id="sclearance" value="1">
                                            Clearence
                                        </label>
                                        <label>
                                            <input type="checkbox" name="buy_get" id="sbuy_get" value="1">
                                            Buy-1 & Get-1
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="spaymentOption" class="control-label col-sm-2">Payment option :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="spaymentOption" disabled>
                            </div>
                            <label for="Product color" class="control-label col-sm-2">Product color :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="cl" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Product size" class="control-label col-sm-2">Product size :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sz" disabled>
                            </div>
                            <label for="Product tag" class="control-label col-sm-2">Product tag :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="tg" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="shortDescription">Product short description :</label>
                            <div id="showShortDescription" class="col-sm-10"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="description">Product description :</label>
                            <div id="des" class="col-sm-10"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="specification">Product specification :</label>
                            <div id="spc" class="col-sm-10"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    {{-- Modal Form Delete Post --}}
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

    {{-- Modal Form published product --}}
    <div id="publish" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
                </div>
                <div class="modal-body">

                    {{-- Form Publish Post --}}
                    <input type="hidden" name="_method" value="POST">
                    <div class="publishContent">
                        Are You sure want to Published this data?
                        <span class="hidden pId" style="display:none"></span>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class="glyphicon"></span>Publish
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
        {{-- instance, using default configuration. --}}
        {{-- for create --}}
        CKEDITOR.replace('shortDescription');
        CKEDITOR.replace('description');
        CKEDITOR.replace('specification');
        {{-- for update --}}
        CKEDITOR.replace('uDescription');
        CKEDITOR.replace('uSpecification');
        CKEDITOR.replace('eshortDescription');
@endsection