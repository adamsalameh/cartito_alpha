@extends('layout')
@section('content')

<h3>Modify your address:</h3>
<!-- Content here -->
<form method="POST" action="/addresses/{{$address->id}} ">
	@csrf
	@method('PATCH')

	<div class="form-group">
		<label for="company">Your Company:</label>
		<input type="text" class="form-control" name="company" value="{{$address->company}}">
	</div>

	<div class="form-group">
		<label for="address">Address:</label>
		<input type="text" class="form-control" name="address" value="{{$address->address}}">
	</div>

	<div class="form-group">
		<label for="post_code">Zip Code:</label>
		<input type="text" class="form-control" name="post_code" value="{{$address->post_code}}">
	</div>

	<div class="form-group">
		<label for="city">City:</label>
		<input type="text" class="form-control" name="city" value="{{$address->city}}">
	</div>

	<div class="form-group">
		<label for="country">Country:</label>
		<input type="text" class="form-control" name="country" value="{{$address->country}}">
	</div>

	<button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection
