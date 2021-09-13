@extends('admin.adminMasterLayout')

@section('breadcrumb')
    <li>
        <a href="{{url('/digital-innovations')}}">Connected Workforce</a>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Edit Content</a>
    </li>
@endsection

@section('adminContent')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Content</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" action="{{url('update-connected-workforce/'.$connectedWorkforce->id)}}" method="post" enctype="multipart/form-data" role="form" id="banner_add-form">
                    {{csrf_field()}}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="topic">Topic</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="topic" maxlength="35" required placeholder="topic should be in 35 characters " value="{{$connectedWorkforce->topic}}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="title">Title</label>
                            <div class="controls">
                                <input type="text" name="title" required value="{{$connectedWorkforce->title}}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="description">Description</label>
                            <div class="controls">
                                <textarea class="controls" name="description" id="description" cols="30" rows="20" required>{!! $connectedWorkforce->description !!}</textarea>
                            </div>
                            {{-- <script>
                                CKEDITOR.replace( 'description' );
                            </script> --}}
                            <script>
                                $(document).ready(function() {
                                    $('#description').summernote({
                                        placeholder: 'This input is must',
                                        tabsize: 2,
                                        height: 200
                                    });
                                });
                            </script>

                        </div>

                        <div class="control-group">
                            <label class="control-label" for="description_1">Description 1</label>
                            <div class="controls">
                                <textarea class="controls" name="description_1" id="description_1" cols="30" rows="20" required>{!! $connectedWorkforce->description_1 !!}</textarea>
                            </div>
                            {{-- <script>
                                CKEDITOR.replace( 'description_1' );
                            </script> --}}
                            <script>
                                $(document).ready(function() {
                                    $('#description_1').summernote({
                                        placeholder: 'This input is must',
                                        tabsize: 2,
                                        height: 200
                                    });
                                });
                            </script>
                            
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="description_2">Description 2</label>
                            <div class="controls">
                                <textarea class="controls" name="description_2" id="description_2" cols="30" rows="20">{!! $connectedWorkforce->description_2 !!}</textarea>
                            </div>
                            {{-- <script>
                                CKEDITOR.replace( 'description_2' );
                            </script> --}}
                            <script>
                                $(document).ready(function() {
                                    $('#description_2').summernote({
                                        placeholder: 'Description',
                                        tabsize: 2,
                                        height: 200
                                    });
                                });
                            </script>

                        </div>

                        <div class="control-group">
                            <label class="control-label" for="description_3">Description 3</label>
                            <div class="controls">
                                <textarea class="controls" name="description_3" id="description_3" cols="30" rows="20">{!! $connectedWorkforce->description_3 !!}</textarea>
                            </div>
                            {{-- <script>
                                CKEDITOR.replace( 'description_3' );
                            </script> --}}
                            <script>
                                $(document).ready(function() {
                                    $('#description_3').summernote({
                                        placeholder: 'Description',
                                        tabsize: 2,
                                        height: 200
                                    });
                                });
                            </script>


                        </div>
                        <div class="control-group">
                            <label class="control-label" for="description_4">Description 4</label>
                            <div class="controls">
                                <textarea class="controls" name="description_4" id="description_4" cols="30" rows="20">{!! $connectedWorkforce->description_4 !!}</textarea>
                            </div>
                            {{-- <script>
                                CKEDITOR.replace( 'description_4' );
                            </script> --}}
                            <script>
                                $(document).ready(function() {
                                    $('#description_4').summernote({
                                        placeholder: 'Description',
                                        tabsize: 2,
                                        height: 200
                                    });
                                });
                            </script>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="selectError1">Related Products</label>
                            <div class="controls">
                                <ul>
                                    @foreach ($connectedWorkforce->products as $relatedProduct)
                                        <li>{{$relatedProduct->productName}}</li>                                        
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError2">Related Solutions</label>
                            <div class="controls">
                                <ul>
                                    @foreach ($connectedWorkforce->solutions as $relatedSolution)
                                        <li>{{$relatedSolution->solutionName}}</li>                                        
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="selectError1">Add related Products</label>
                            <div class="controls">
                                <select id="selectError1" name="product_id[]" multiple data-rel="chosen">
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                                <p class="error product_id text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError2">Add related Solutions</label>
                            <div class="controls">
                                <select id="selectError2" name="solution_id[]" multiple data-rel="chosen">
                                    @foreach($solutions as $solution)
                                        <option value="{{$solution->id}}">{{$solution->solutionName}}</option>
                                    @endforeach
                                </select>
                                <p class="error product_id text-center alert alert-danger hidden"></p>
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