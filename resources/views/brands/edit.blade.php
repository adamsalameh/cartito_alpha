@extends('layout')
@section('content')

<!-- Content here -->
<form method="POST" action="/brands/{{$brand->id}}">
    @csrf
    @method('PATCH')
   
    <div class="form-group">
        <label for="title">Brand Title: </label>
        <input type="text" name = "title" class="form-control" id="exampleFormControlInput1" value="{{$brand->title}}">
    </div>
      
    <input type="submit" class="btn btn-outline-primary" value="Update">
</form>

@endsection