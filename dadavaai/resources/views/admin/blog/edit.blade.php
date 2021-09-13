@extends('layouts.admin')

@section('breadcrumbhead')
    <h1>
        Blog Edit
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('blogs')}}"><i class="fa fa-dashboard"></i>Blogs</a></li>
        <li class="active">Edit Blog {{$blog->id}}</li>
    </ol>
@endsection
@section('content')
<div class="col-md-6 col-lg-12 col-sm-4">
        <!-- general form elements -->
        <div class="box ">
          <div class="box-header with-border">
          <h3 class="box-title">Edit Blog {{$blog->id}}</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('blogs', $blog->id)}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              {{ method_field('PUT') }}
            <div class="box-body">
              <div class="form-group">
                <label for="title">Title</label>
              <input type="text" name="blogTitle" class="form-control" id="blogTitle" placeholder="Enter Title" value="{{$blog->blogTitle}}" required>
              </div>
              <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                    <option value="{{$blog->category->id}}" selected>{{$blog->category->categoryName}}</option>
                        @foreach ($categories as $category)
                          <option value="{{$category->id}}">{{$category->categoryName}}</option>
                        @endforeach
                    </select>
                </div>
              <div class="form-group">
                    <label for="Body">Body</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="20" placeholder="Edit description" required>{{strip_tags($blog->description)}}</textarea>
                    <script>
                        $(document).ready(function() {
                            $('#description').summernote({
                                placeholder: 'Edit description',
                                tabsize: 2,
                                height: 100
                            });
                        });
                    </script>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Cover Image</label>
                <input type="file" name="coverImage" id="exampleInputFile">


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
