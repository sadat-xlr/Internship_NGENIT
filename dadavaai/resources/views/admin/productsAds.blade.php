@extends('layouts.admin')
@section('title')
    <title>All-Ads</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Product Ads
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Product</li>
        <li class="active">Ads</li>
    </ol>
@endsection

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Ads</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Ad1 image</th>
                    <th>Ad2 image</th>
                    <th>Ad3 image</th>
                    <th>Ad4 image</th>
                    <th>
                        action
                        <a href="#" class="addProductAds btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($productsAds as $productsAd)
                    <tr id="productsAd{{$productsAd->id}}">
                        <td> <img src="{{asset('storage/images/ads/'.$productsAd->ad1Image)}}" height="100px" width="100px"></td>
                        <td><img src="{{asset('storage/images/ads/'.$productsAd->ad2Image)}}" height="100px" width="100px"></td>
                        <td><img src="{{asset('storage/images/ads/'.$productsAd->ad3Image)}}" height="100px" width="100px"></td>
                        <td><img src="{{asset('storage/images/ads/'.$productsAd->ad4Image)}}" height="100px" width="100px"></td>

                        <td>
                            <div class="table-data-feature">
                                <a href="#" class="edit-ProductAds btn btn-warning btn-sm" data-id="{{$productsAd->id}}" data-product1="{{$productsAd->ad1Product_id}}" data-product2="{{$productsAd->ad2Product_id}}" data-product3="{{$productsAd->ad3Product_id}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-ProductAds btn btn-danger btn-sm" data-id="{{$productsAd->id}}">
                                    <i class="fa fa-trash"></i>
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

    {{-- Modal Form Create Post --}}
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
                    <form class="form-horizontal" action="{{url('productsads')}}" enctype="multipart/form-data" role="form" id="productsad_add_form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="ad1Image">Image for 1st ads :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="ad1Image" required>
                            </div>
                            <label class="control-label col-sm-2" for="ad1Product_id">Product :</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="ad1Product_id" data-placeholder="Search for product" style="width: 100%;">
                                    <option value="0" selected>select one</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="ad2Image">Image for 2nd ads :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="ad2Image" required>
                            </div>
                            <label class="control-label col-sm-2" for="ad2Product_id">Product :</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="ad2Product_id" data-placeholder="Search for product" style="width: 100%;" required>
                                    <option value="0" selected>select one</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                                <p class="error text-center alert alert-danger hidden"></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="ad3Image">Image for 3rd ads :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="ad3Image" required>
                            </div>
                            <label class="control-label col-sm-2" for="ad4Image">Image for 4th ads :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="ad4Image" required>
                            </div>
                            <label class="control-label col-sm-2" for="ad2Product_id">Product :</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="ad3Product_id" data-placeholder="Search for product" style="width: 100%;" required>
                                    <option value="0" selected>select one</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                                <p class="error text-center alert alert-danger hidden"></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-8" for="brandLogo"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit" id="addProductAds">
                                    <span class="glyphicon glyphicon-plus"></span>Save ProductsAds
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
                    <form class="form-horizontal" action="{{url('productsads')}}" role="modal" id="productsad_update_form">
                        <input type="hidden" id="fid">

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="ad1Image">Image for 1st ads :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="ad1Image">
                            </div>
                            <label class="control-label col-sm-2" for="shProduct1">Selected Product :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="shProduct1" disabled>
                            </div> 
                            <label class="control-label col-sm-2" for="ad1Product_id">Change Product :</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="ad1Product_id" id="eProduct1" data-placeholder="Search for product" style="width: 100%;" required>
                                    <option value="0" selected>select one</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                            </div>   
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="ad2Image">Image for 2nd ads :</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="ad2Image">
                            </div>
                            <label class="control-label col-sm-2" for="shProduct2">Selected Product :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="shProduct2" disabled>
                            </div>
                            <label class="control-label col-sm-2" for="ad2Product_id">Change Product :</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="ad2Product_id" id="eProduct2" data-placeholder="Search for product" style="width: 100%;" required>
                                    <option value="0" selected>select one</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-2" for="ad3Image">Image for 3rd ads :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="ad3Image">
                            </div>
                            <label class="control-label col-sm-2" for="ad4Image">Image for 4th ads :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="ad4Image">
                            </div>

                            <label class="control-label col-sm-2" for="shProduct3">Selected Product :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="shProduct3" disabled>
                            </div>
                            <label class="control-label col-sm-2" for="ad3Product_id">Change Product :</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="ad3Product_id" id="eProduct3" data-placeholder="Search for product" style="width: 100%;" required>
                                    <option value="0" selected>select one</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-8" for=""></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit">
                                    <span class="glyphicon glyphicon-plus"></span>Update ProductsAds
                                </button>
                            </div>
                        </div>
                    </form>
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
@section('script')

    //Initialize Select2 Elements
    $('.select2').select2()

@endsection