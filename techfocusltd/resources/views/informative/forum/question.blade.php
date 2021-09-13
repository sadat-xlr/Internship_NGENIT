@extends('informative.layouts.master')

@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
            <div class="container">
                <div class="sab_banner_text">
                    <h2>Tech Forums</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('forum-questions')}}">Tech Forums</a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- SAB BANNER END-->    
<!-- CITY EVENT2 WRAP START-->
    <div class="city_blog2_wrap">
        <div class="container">
            <form action="{{url('forum-question-store')}}" method="post" id="form-login" accept-charset="utf-8">
                {{csrf_field()}}
                <label for="title">Title:</label>
                <input type="text" name="title" required>
                <br>
                <label for="body">Description:</label>
                <textarea name="description" id="" cols="30" rows="10" required></textarea> 
                <br>
                <label for="tag">Select Tag:</label>
                <select name="tag" id="tag">
                    <option value="">select Tag</option>
                    @foreach ($tages as $item)
                        <option value="{{$item->id}}">{{$item->tag}}</option>
                    @endforeach
                </select>
                <br><br>
                <button class="theam_btn  color" type="submit">Submit</button>
            </form>
        </div>	
    </div>
    <!-- CITY EVENT2 WRAP END-->
@endsection
