@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session('success'))
<div class="alert alert-success">
	{{Session('success')}}
	<?php 
	Session::put('success', null); 
	?> 
</div>
@endif

@if (Session('error'))
<div class="alert alert-danger">
	{{Session('error')}}
	<?php 
	Session::put('error', null); 
	?> 
</div>
@endif