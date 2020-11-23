@extends('layout')
@section('content')

<!-- Content here -->
<form method="POST" action="/subCategories">
    @csrf
    <div class="form-group">
        <label for="Sub Category">Sub Category:</label>
        <select class="form-control" name="category_id">			
            
            @foreach($categories as $category)
            <option value={{$category->id}}>{{$category->title}}</option>
            @endforeach

		</select>
	</div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Sub Category Title: </label>
        <input type="text" name = "title" class="form-control" id="exampleFormControlInput1" placeholder="Title">
    </div>
  
    <button type="submit" class="btn btn-outline-primary">Submit</button>
</form>

@endsection