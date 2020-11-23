@extends('layout')
@section('content')

<!-- Content here -->
<h3>Modify your profile:</h3>
<form method="POST" action="/profiles/{{$profile->id}}">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" class="form-control" name="first_name" value="{{$profile->first_name}}">  
    </div>

    <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" class="form-control" name="last_name"value="{{$profile->last_name}}">    
    </div>

    <div class="form-group">
        <label for="telephone">Telephone:</label>
        <input type="text" class="form-control" name="telephone"value="{{$profile->telephone}}">
    </div>	

    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection