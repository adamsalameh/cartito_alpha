@extends('layout')
@section('content')

<!-- Content here -->
<form method="POST" action="/shippingMethods/{{$shippingMethod->id}}">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="Shipping Company">Company Name:</label>
        <input type="text" class="form-control" name="company_name" value="{{$shippingMethod->company_name}}">
    </div>
	
    <div class="form-group">
        <label for="promotion value">Fee:</label>
        <input type="text" class="form-control" name="fee" value="{{$shippingMethod->fee}}">
    </div>
	
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection