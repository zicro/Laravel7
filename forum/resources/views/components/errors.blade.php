@if($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach($errors->all() as $error)
    <li style="color:{{ $color }};">{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif