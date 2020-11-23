@extends('layout')
@section('content')

<!-- Content here -->
<h3>Add Profile:</h3>
<form method="POST" action="/profiles">
    @csrf

    <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" class="form-control" name="first_name">
    </div>

    <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" class="form-control" name="last_name">
    </div>

    <div class="form-group">
        <label for="telephone">Telephone:</label>
        <input type="text" class="form-control" name="telephone">
    </div>
    
    <button type="submit" class="btn btn-outline-primary">Submit</button>    
</form>

@endsection