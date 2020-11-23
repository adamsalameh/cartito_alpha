@extends('layout')
@section('content')

<!-- Content here -->
<form method="POST" action="/categories/{{$category->id}}">
    @csrf
    @method('PATCH')
   
    <div class="form-group">
        <label for="title">Title: </label>
        <input type="text" name = "title" class="form-control" id="exampleFormControlInput1" value="{{$category->title}}">
    </div>
  
    <input type="submit" class="btn btn-outline-primary" value="Submit Button">
</form>

@endsection