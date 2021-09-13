@extends('layouts.admin')
@section('breadcrumbhead')
    <h1>
        Blog create
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('blogs')}}"><i class="fa fa-dashboard"></i>Blogs</a></li>
        <li class="active">create Blog </li>
    </ol>
@endsection


@section('content')
<div class="col-md-6 col-lg-12 col-sm-4">
        <!-- general form elements -->
        <div class="box ">

          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{URL('/blogs')}}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
            <div class="box-body">
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="blogTitle" class="form-control" id="blogTitle" placeholder="Enter Title" required>
              </div>
              <div class="form-group">
                    <label>categories</label>
                    <select class="form-control" name="category_id" required>
                        @foreach ($categories as $categorie)
                        <option value="{{$categorie->id}}">{{$categorie->categoryName}}</option>
                        @endforeach
                    </select>
                </div>
              <div class="form-group">
                    <label for="Body">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="20" placeholder="Enter description" required></textarea>
                    <script>
                        $(document).ready(function() {
                            $('#description').summernote({
                                placeholder: 'Enter description',
                                tabsize: 2,
                                height: 100
                            });
                        });
                    </script>
              </div>
              <div class="form-group">
                <label for="blogImage">Cover Image <small>(Image size would be 600*250)</small></label>
                <input type="file" name="blogImage" id="blogImage" to>


              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <!-- /.box -->
</div>
@endsection
