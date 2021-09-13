@extends('layouts.admin')
@section('title')
    <title>Title Name</title>
@endsection

@section('breadcrumbhead')
    <h1>
        Page Name
        <small>Control panel</small>
    </h1>
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Site Info</li>
        <li class="active">Page Name</li>
    </ol>
@endsection

@section('content')

    Page Body

@endsection