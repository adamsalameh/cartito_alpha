@extends('layout')
@section('content')

<!-- Content here -->
<form method="POST" action="/categories">
    @csrf

    <div class="form-group">
        <label for="exampleFormControlInput1">Category Title: </label>
        <input type="text" name = "title" class="form-control" id="exampleFormControlInput1" placeholder="Title">
    </div>
  
    <button type="submit" class="btn btn-outline-primary">Submit</button>
</form>

@endsection