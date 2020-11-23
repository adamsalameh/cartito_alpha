@extends('layout')
@section('content')

<!-- Content here -->
<form method ="POST" action ="/subCategories/{{$subCategory->id}}">
    @csrf
    @method('PATCH')
    <div class ="form-group">
        <label for = "Sub Category">Sub Category:</label>
        <select class = "form-control" name = "category_id">

        @foreach($categories as $category)
            <option value = {{$category->id}}>{{$category->title}}</option>
        @endforeach

		</select>
	</div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Sub Category Title: </label>
        <input type="text" name = "title" class="form-control" id="exampleFormControlInput1" value="{{$subCategory->title}}">
    </div>
  
    <button type="submit" class="btn btn-outline-primary">Update</button>
</form>

@endsection