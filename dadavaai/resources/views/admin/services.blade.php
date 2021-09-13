@extends('layouts.admin')
@section('title')
    <title>Services</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Service
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Services</li>
        <li class="active">Services</li>
    </ol>
@endsection

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Service</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>SubCategory</th>
                    <th>MiniCategory</th>
                    <th>RegularPrice</th>
                    <th>
                        action
                        <a href="#" class="addService btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $service)
                    <tr id="service{{$service->id}}">
                        <td>{{$service->serviceName}}</td>
                        <td><img src="{{asset('storage/images/service/'.$service->image)}}" height="100px" width="100px"/></td>
                        <td>{{$service->sku}}</td>
                        <td>{{$service->category->categoryName}}</td>
                        <td>{{$service->subcategory->subCategoryName}}</td>
                        <td>{{$service->minicategory->miniCategoryName}}</td>
                        <td>Tk {{$service->regularPrice}}</td>
                        <td>
                            <div class="table-data-feature">
                                <a href="#" class="show-service btn btn-info btn-sm" data-id="{{$service->id}}"  data-unit="{{$service->unit}}" data-min_order_qty="{{$service->min_order_qty}}"  data-service_area="{{$service->service_area}}" data-serviceName="{{$service->serviceName}}" data-slug="{{$service->slug}}" data-image="{{$service->image}}" data-sku="{{$service->sku}}" data-category="{{$service->category->categoryName}}" data-subcategory="{{$service->subcategory->subCategoryName}}" data-minicategory="{{$service->minicategory->miniCategoryName}}"   @if($service->tab)data-tab="{{$service->tab->tabName}}"@endif  data-regularPrice="{{$service->regularPrice}}"  data-availability="@if($service->availability == 0) Yes @else No @endif"  data-description="{{$service->description}}" data-specification="{{$service->specification}}" data-short_description="{{$service->shortDescription}}" 
                                data-discount="{{$service->discount}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                
                                <a href="#" class="edit-service btn btn-warning btn-sm" data-id="{{$service->id}}" data-unit="{{$service->unit}}" data-min_order_qty="{{$service->min_order_qty}}" data-service_area="{{$service->service_area}}" data-serviceName="{{$service->serviceName}}" data-slug="{{$service->slug}}" data-sku="{{$service->sku}}" data-category_id="{{$service->category_id}}" data-subcategory_id="{{$service->subcategory_id}}" data-minicategory_id="{{$service->minicategory_id}}" data-minicategory="{{$service->minicategory->miniCategoryName}}" data-tab_id="{{$service->tab_id}}" @if($service->tab)data-tab="{{$service->tab->tabName}}"@endif data-regularPrice="{{$service->regularPrice}}" data-availability="{{$service->availability}}"
                                data-description="{{$service->description}}" data-specification="{{$service->specification}}" data-subcategory="{{$service->subcategory->subCategoryName}}" data-short_description="{{$service->shortDescription}}" data-discount="{{$service->discount}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-service btn btn-danger btn-sm" data-id="{{$service->id}}">
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


    {{-- Modal Form Create Service --}}
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
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" id="service-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="serviceName">service Name :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="serviceName" name="serviceName"
                                       placeholder="serviceName Here" required>
                                <p class="error serviceName text-center alert alert-danger hidden"></p>
                            </div>
                            <label class="control-label col-sm-2" for="sku">service sku :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sku" name="sku"
                                       placeholder="service sku Here" required>
                                <p class="error sku text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="category_id">service Category :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="subcategory_id">service SubCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="subcategory_id" name="subcategory_id" required>
                                    <option value="">Select SubCategory</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            {{-- minicategory --}}
                            <label class="control-label col-sm-2" for="minicategory_id">service MiniCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="minicategory_id" name="minicategory_id" required>
                                    <option value="">Select MiniCategory</option>
                                </select>
                            </div>

                            {{-- tab --}}
                            <label class="control-label col-sm-2" for="minicategory_id">service Tab :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="tab_id" name="tab_id">
                                    <option value="">Select Tab</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="availability">service Availablity :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="availability" name="availability" required>
                                    <option value="0">Available</option>
                                    <option value="1">Not-Available</option>
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="regularPrice">Service regularPrice :</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="regularPrice" name="regularPrice"
                                       placeholder="Service regularPrice Here">
                                <p class="error regularPrice text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image">Service Image :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image" name="image" required>
                                <p class="error image1 text-center alert alert-danger hidden"></p>
                            </div>                           
                        </div>

                        <div class="form-group">
                            {{-- Discount --}}
                            <label class="control-label col-sm-2" for="discount">Discount:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="discount" name="discount"
                                       placeholder="Service Discount % Here">
                                <p class="error discount text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- Unit --}}
                            <label class="control-label col-sm-2" for="unit">Unit :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="unit" name="unit" required>
                                    <option value="">Select Unit </option>
                                    <option value="person">person </option>
                                    <option value="pieces">pieces</option>
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
                            {{-- Service area --}}
                            <label class="control-label col-sm-2" for="service_area">Service area :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="service_area" name="service_area"
                                       placeholder="Service area">
                                <p class="error service_area text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="shortDescription">Service Short Description :</label>
                            <div class="col-sm-10">
                                <textarea id="shortDescription" name="shortDescription" rows="10" cols="80" required></textarea>
                                <p class="error shortDescription text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="description">Service Description :</label>
                            <div class="col-sm-10">
                                <textarea id="description" name="description" rows="10" cols="80" required></textarea>
                                <p class="error description text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="specification">Service Specification :</label>
                            <div class="col-sm-10">
                                <textarea id="specification" name="specification" rows="10" cols="80"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="brandLogo"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit">
                                    <span class="glyphicon glyphicon-plus"></span>Save
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

    {{-- Modal Form Update Service --}}
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
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" id="updateService">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="serviceName">Service Name :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="eserviceName" name="serviceName"
                                       placeholder="serviceName Here" required>
                                <p class="error eserviceName text-center alert alert-danger hidden"></p>
                            </div>
                            <label class="control-label col-sm-2" for="sku">Service sku :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="esku" name="sku"
                                       placeholder="Service sku Here" required>
                                <p class="error esku text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="category_id">Service Category :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="ecategory_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="subcategory_id">Service SubCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="esubcategory_id" name="subcategory_id" required>
                                    <option value="">Select SubCategory</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            
                            {{-- Minicategory edit --}}

                            <label class="control-label col-sm-2" for="minicategory_id">Service MiniCategory :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="eminicategory_id" name="minicategory_id" required>
                                    <option value="">Select MiniCategory</option>
                                </select>
                            </div>

                            {{-- Tab edit --}}
                            <label class="control-label col-sm-2" for="tab_id">Service Tab :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="etab_id" name="tab_id">
                                    <option value="">Select Tab</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="availability">Service Availablity :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="eavailability" name="availability" required>
                                    <option value="0">Available</option>
                                    <option value="1">Not-Available</option>
                                </select>
                            </div>
                            <label class="control-label col-sm-2" for="regularPrice">Service regularPrice :</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="eregularPrice" name="regularPrice"
                                       placeholder="Service regularPrice Here">
                                <p class="error eregularPrice text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image">Service Image  :</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image" name="image">
                                <p class="error eimage1 text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                                                        
                            <label class="control-label col-sm-2" for="discount">Discount:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="ediscount" name="discount"
                                       placeholder="Service Discount % Here">
                                <p class="error ediscount text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- Unit --}}
                            <label class="control-label col-sm-2" for="unit">Unit   :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="eunit" name="unit" required>
                                    <option value="">Select Unit </option>
                                    <option value="person">person </option>
                                    <option value="pieces">pieces</option>
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
                            {{-- Service Area --}}
                            <label class="control-label col-sm-2" for="eservice_area">Service Area:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="eservice_area" name="service_area"
                                       placeholder="Delivery From">
                                <p class="error eservice_area text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="shortDescription">Service Short Description :</label>
                            <div class="col-sm-10">
                                <textarea id="eshortDescription" name="shortDescription" rows="10" cols="80" required></textarea>
                                <p class="error eshortDescription text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="description">Service Description :</label>
                            <div class="col-sm-10">
                                <textarea id="uDescription" name="description" rows="10" cols="80" required></textarea>
                                <p class="error edescription text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="specification">Service Specification :</label>
                            <div class="col-sm-10">
                                <textarea id="uSpecification" name="specification" rows="10" cols="80"></textarea>
                                <p class="error especification text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for=""><input type="hidden" id="ID"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-warning" type="submit">
                                    <span class="glyphicon glyphicon-edit"></span>Update 
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
                            <label class="control-label col-sm-2" for="Service image">Service image :</label>
                            <div class="col-sm-4"><img id="img" style="height: 200px;"/></div>
                        </div>
                        <div class="form-group">
                            <label for="Service sku" class="control-label col-sm-2">Service sku :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sk" disabled>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="Service category" class="control-label col-sm-2">Service category :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="ct" disabled>
                            </div>
                            <label for="Service subcategory" class="control-label col-sm-2">Service subcategory :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sct" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Service miniCategory" class="control-label col-sm-2">Service miniCategory :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="mnctgr" disabled>
                            </div>

                            <label for="Service miniCategory" class="control-label col-sm-2">Service tab :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="stab" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Service availability" class="control-label col-sm-2">Service availability :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="av" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Service regularPrice" class="control-label col-sm-2">Service regularPrice :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="rPrice" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Service brand" class="control-label col-sm-2">Service slug :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sl" disabled>
                            </div>

                            <label class="control-label col-sm-2" for="discount">Discount:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="sdiscount" name="discount"
                                       placeholder="Service Discount % Here">
                                <p class="error ediscount text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- Unit  --}}
                            <label class="control-label col-sm-2" for="unit">Unit of unit  :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sunit" name="unit">
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

                            {{-- Service area --}}
                            <label class="control-label col-sm-2" for="eservice_area">Service area:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sservice_area" name="service_area"
                                       placeholder="Service area">
                                <p class="error sservice_area text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="shortDescription">Service short description :</label>
                            <div id="showShortDescription" class="col-sm-10"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="description">Service description :</label>
                            <div id="des" class="col-sm-10"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="specification">Service specification :</label>
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