@extends('layout')
@section('content')

<!-- Content here -->
<h3>Add Address:</h3>
<form method="POST" action="/addresses">
    @csrf

	<div class="form-group">
		<label for="company">Your Company:</label>
		<input type="text" class="form-control" name="company">
	</div>

	<div class="form-group">
		<label for="address">Address:</label>
		<input type="text" class="form-control" name="address">
	</div>

	<div class="form-group">
		<label for="post_code">Zip Code:</label>
		<input type="text" class="form-control" name="post_code">
	</div>

	<div class="form-group">
		<label for="city">City:</label>
		<input type="text" class="form-control" name="city">
	</div>

	<div class="form-group">
		<label for="country">Country:</label>
		<input type="text" class="form-control" name="country">
	</div>

	<button type="submit" class="btn btn-outline-primary">Submit</button>
</form>

@endsection