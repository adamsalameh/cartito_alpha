@extends('layout')
@section('content')

<!-- Content here -->
<form method="POST" action="/shippingMethods">
    @csrf

    <div class="form-group">
        <label for="Shipping Company">Company Name:</label>
        <input type="text" class="form-control" name="company_name">
    </div>
	
    <div class="form-group">
        <label for="promotion value">Fee:</label>
        <input type="text" class="form-control" name="fee">
    </div>
	
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection