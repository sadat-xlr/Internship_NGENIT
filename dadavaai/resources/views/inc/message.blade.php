@if(count($errors)>0)
  @foreach($errors->all() as $error)
    <div class="text-center alert alert-danger">
      {{$error}}
    </div>
  @endforeach
@endif

@if (\Session::has('error'))
<div class="text-center alert alert-danger">
    <ul>
        <li>{!! \Session::get('error') !!}</li>
    </ul>
</div>
@endif


@if (\Session::has('success'))
<div class="text-center alert alert-success">
    <ul>
        <li>{!! \Session::get('success') !!}</li>
    </ul>
</div>
@endif

