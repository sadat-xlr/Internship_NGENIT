@extends('layouts.admin')
@section('breadcrumbhead')
    <h1>
        Blog list
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Blogs</li>
    </ol>
@endsection
@section('content')
<div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Table With Full Features</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Id</th>
              <th>Title</th>
              <th>Body</th>
              <th>Posted Time</th>
              <th>
                  Action 
                  @can('add blog')
                    <a href="{{url('add-blog')}}" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                    </a>
                  @endcan
              </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td>{{$blog->id}}</td>
                    <td>{{$blog->blogTitle}}</td>

                    <td>{{substr(strip_tags($blog->description), 0, 48)}}</td>
                    <td>{{$blog->created_at}}</td>
                    <td>
                        @can('edit blog')
                            <a class="btn" href="{{URL('edit-blog/'.$blog->id.'/edit')}}">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                        @endcan
                        @can('delete blog')
                            <form id="postDeleteForm" action="{{ url('blogs',$blog->id) }}" method="POST">
                                {{csrf_field()}}
                                {{ method_field('delete') }}

                                <a class="btn" onclick="if(confirm('Are you sure? You want to delete this?')){
                                  event.preventDefault();
                                  document.getElementById('postDeleteForm').submit();
                              }else {
                                  event.preventDefault();
                                      }"><span class="glyphicon glyphicon-trash"></span></a>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
@endsection
