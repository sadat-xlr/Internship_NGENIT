@extends('layouts.admin')
@section('title')
    <title>All-Banners</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Banner
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Site Info</li>
        <li class="active">Banner</li>
    </ol>
@endsection

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Banner</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Banner image (Home one)</th>
                    <th>Banner image (Home two)</th>
                    @hasanyrole('super admin|Admin')
                    <th>
                        action
                        <a href="#" class="addBanner btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                    @endhasanyrole
                </tr>
                </thead>
                <tbody>
                @foreach($banners as $banner)
                    <tr id="banner{{$banner->id}}">
                        <td><img src="{{asset('storage/images/banner/'.$banner->home_one)}}" height="100px" width="100px"></td>
                        <td><img src="{{asset('storage/images/banner/'.$banner->home_two)}}" height="100px" width="100px"></td>
                        <td>
                            <div class="table-data-feature">
                                <a href="#" class="show-banner btn btn-info btn-sm" data-id="{{$banner->id}}" data-home_one="{{$banner->home_one}}" data-home_two="{{$banner->home_two}}" data-home_one_link="{{$banner->home_one_link}}" data-home_two_link="{{$banner->home_two_link}}" data-home_three="{{$banner->home_three}}" data-home_three_link="{{$banner->home_three_link}}" data-header_one="{{$banner->header_one}}" data-header_two="{{$banner->header_two}}" data-header_three="{{$banner->header_three}}" data-header_three_link="{{$banner->header_three_link}}" data-banner_link_brand_page="{{$banner->banner_link_brand_page}}" data-banner_brand_page="{{$banner->banner_brand_page}}" data-banner_brand_single_page="{{$banner->banner_brand_single_page}}" data-banner_link_brand_single_page="{{$banner->banner_link_brand_single_page}}" data-banner_category_page="{{$banner->banner_category_page}}" data-banner_link_category_page="{{$banner->banner_link_category_page}}"   data-banner_product_page="{{$banner->banner_product_page}}" data-banner_link_product_page="{{$banner->banner_link_product_page}}" data-banner_searched_product_page="{{$banner->banner_searched_product_page}}" data-banner_link_searched_product_page="{{$banner->banner_link_searched_product_page}}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                @hasanyrole('super admin|Admin')
                                <a href="#" class="edit-banner btn btn-warning btn-sm" data-id="{{$banner->id}}" data-home_one_link="{{$banner->home_one_link}}" data-home_two_link="{{$banner->home_two_link}}" data-home_three_link="{{$banner->home_three_link}}" data-header_one_link="{{$banner->header_one_link}}" data-header_two_link="{{$banner->header_two_link}}" data-header_three_link="{{$banner->header_three_link}}" data-banner_link_brand_page="{{$banner->banner_link_brand_page}}"  data-banner_link_brand_single_page="{{$banner->banner_link_brand_single_page}}"  data-banner_link_category_page="{{$banner->banner_link_category_page}}"  data-banner_link_product_page="{{$banner->banner_link_product_page}}"  data-banner_link_searched_product_page="{{$banner->banner_link_searched_product_page}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-banner btn btn-danger btn-sm" data-id="{{$banner->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endhasanyrole
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
                    <form class="form-horizontal" action="{{url('banners')}}" enctype="multipart/form-data" role="form" id="banner_add-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="home_one">Home one :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="home_one" required>
                            </div>
                            <label class="control-label col-sm-2" for="home_one_link">Home one link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="home_one_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="home_two">Home two :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="home_two" required>
                            </div>
                            <label class="control-label col-sm-2" for="home_two_link">Home two link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="home_two_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="home_three">Home three :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="home_three" required>
                            </div>
                            <label class="control-label col-sm-2" for="home_three_link">Home three link:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="home_three_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="header_one">Product :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="header_one" required>
                            </div>
                            <label class="control-label col-sm-2" for="header_one_link">Product link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="header_one_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="header_two">Offer page:</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="header_two" required>
                            </div>
                            <label class="control-label col-sm-2" for="header_two_link">Offer link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="header_two_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="header_three"> offer menu :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="header_three" required>
                            </div>
                            <label class="control-label col-sm-2" for="header_three_link">offer menu:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="header_three_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_category_page">Banner category page :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="banner_category_page" required>
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_category_page">Banner link category page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="banner_link_category_page" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_brand_page">Banner subcategory page :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="banner_brand_page">
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_brand_page">Banner link subcategory page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="banner_link_brand_page">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_brand_single_page">Banner brand single page :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="banner_brand_single_page">
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_brand_single_page">Banner link brand single page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="banner_link_brand_single_page">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_product_page">Banner minicategory page :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="banner_product_page">
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_product_page">Banner link minicategory page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="banner_link_product_page">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_searched_product_page">Banner offer page :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="banner_searched_product_page">
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_searched_product_page">Banner link offer page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="banner_link_searched_product_page">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="brandLogo"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit" id="addBanner">
                                    <span class="glyphicon glyphicon-plus"></span>Save banner
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
                    <form class="form-horizontal" action="{{url('banners')}}" role="modal" id="banner_update-form">
                        <input type="hidden" id="fid">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="home_one">Home one :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="home_one">
                            </div>
                            <label class="control-label col-sm-2" for="home_one_link">Home one link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="home_one_link" id="home_one_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="home_two">Home two :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="home_two">
                            </div>
                            <label class="control-label col-sm-2" for="home_two_link">Home two link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="home_two_link" id="home_two_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="home_three">Home three :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="home_three">
                            </div>
                            <label class="control-label col-sm-2" for="home_three_link">Home three :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="home_three_link" id="home_three_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="header_one">Product :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="header_one">
                            </div>
                            <label class="control-label col-sm-2" for="header_one_link">Product link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="header_one_link" id="header_one_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="header_two">Offer page:</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="header_two">
                            </div>
                            <label class="control-label col-sm-2" for="header_two_link">offer link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="header_two_link" id="header_two_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="header_three">offer menu:</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="header_three">
                            </div>
                            <label class="control-label col-sm-2" for="header_three_link">offer menu link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="header_three_link" id="header_three_link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_brand_page">Banner subcategory page :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="banner_brand_page">
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_brand_page">Banner link subcategory page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="banner_link_brand_page" id="banner_link_brand_page" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_brand_single_page">Banner brand single page :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="banner_brand_single_page">
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_brand_single_page">Banner link brand single page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="banner_link_brand_single_page" id="banner_link_brand_single_page" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_category_page">Banner category page :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="banner_category_page">
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_category_page">Banner link category page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="banner_link_category_page" id="banner_link_category_page" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_product_page">Banner minicategory page :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="banner_product_page">
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_product_page">Banner link minicategory page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="banner_link_product_page" id="banner_link_product_page" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_searched_product_page">Banner Offer page :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="banner_searched_product_page">
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_searched_product_page">Banner link offer page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="banner_link_searched_product_page" id="banner_link_searched_product_page" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="brandLogo"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit">
                                    <span class="glyphicon glyphicon-plus"></span>Update banner
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
                    <form class="form-horizontal" role="modal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="home_one">Home one :</label>
                            <div class="col-sm-4">
                                <img id="home_one" style="height: 200px;"/>
                            </div>
                            <label class="control-label col-sm-2" for="home_one_link">Home one link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="show_home_one_link" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="home_two">Home two :</label>
                            <div class="col-sm-4">
                                <img id="home_two" style="height: 200px;"/>
                            </div>
                            <label class="control-label col-sm-2" for="home_two_link">Home two link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="show_home_two_link" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="home_three">Home three :</label>
                            <div class="col-sm-4">
                                <img id="home_three" style="height: 200px;"/>
                            </div>
                            <label class="control-label col-sm-2" for="home_three_link">Home three link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="show_home_three_link" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="header_one">product :</label>
                            <div class="col-sm-4">
                                <img id="header_one" style="height: 200px;"/>
                            </div>
                            <label class="control-label col-sm-2" for="header_one_link">product link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="show_header_one_link" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="header_two">offer page:</label>
                            <div class="col-sm-4">
                                <img id="header_two" style="height: 200px;"/>
                            </div>
                            <label class="control-label col-sm-2" for="header_two_link">offer page link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="show_header_two_link"  disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="header_three">offer menu :</label>
                            <div class="col-sm-4">
                                <img id="header_three" style="height: 200px;"/>
                            </div>
                            <label class="control-label col-sm-2" for="header_three_link">offer menu link :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="show_header_three_link" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_brand_page">Banner subcategory page :</label>
                            <div class="col-sm-4">
                                <img id="banner_brand_page" style="height: 200px;"/>
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_brand_page">Banner link subcategory page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="show_banner_link_brand_page" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_brand_single_page">Banner brand single page :</label>
                            <div class="col-sm-4">
                                <img id="banner_brand_single_page" style="height: 200px;"/>
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_brand_single_page">Banner link brand single page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="show_banner_link_brand_single_page" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_category_page">Banner category page :</label>
                            <div class="col-sm-4">
                                <img id="banner_category_page" style="height: 200px; width: 200px;"/>
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_category_page">Banner link category page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="show_banner_link_category_page" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_product_page">Banner link minicategory page :</label>
                            <div class="col-sm-4">
                                <img id="banner_product_page" style="height: 200px;"/>
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_product_page">Banner link minicategory page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="show_banner_link_product_page" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="banner_searched_product_page">Banner offer page :</label>
                            <div class="col-sm-4">
                                <img id="banner_searched_product_page" style="height: 200px;"/>
                            </div>
                            <label class="control-label col-sm-2" for="banner_link_searched_product_page">Banner link offer page :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="show_banner_link_searched_product_page" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
