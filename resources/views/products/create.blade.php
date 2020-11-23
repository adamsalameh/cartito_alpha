@extends('layout')
@section('content')

<!-- Content here -->
<form method="POST" action="/products" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="Category">Category:</label>
        <select class="form-control selectpicker" name="sub_category_id">			
            @foreach($categories as $category)
                <optgroup label="{{$category->title}}">
                    @foreach($category->subCategory as $sub)
                        <option value={{$sub->id}}>{{$sub->title}}</option>
                    @endforeach
                </optgroup>
			@endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="usr">Title:</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="brand">Brand:</label>
        <select class="form-control" name="brand_id">			
            @foreach($brands as $brand)
                <option value={{$brand->id}}>{{$brand->title}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="usr">tag:</label>
        <input type="text" class="form-control" name="tag">
    </div>

    <div class="form-group">
        <label for="usr">quantity:</label>
        <input type="text" class="form-control" name="quantity">
    </div>

    <div class="form-group">
        <label for="usr">price:</label>
        <input type="text" class="form-control" name="price">
    </div>

    <div class="form-check">
        <label class="form-check-label">
        	<input type="hidden" name="in_stock" value="0">
            <input type="checkbox" class="form-check-input" name="in_stock" value="1">In stock
        </label>
    </div>
	
    <div class="form-group">
        <label for="promotion">Promotion:</label>
        <select class="form-control" name="promotion_id"> 			
            @foreach($promotions as $promotion)
                <option value={{$promotion->id}}>{{$promotion->title}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="comment">Description:</label>
        <textarea class="form-control" rows="5" name="description"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection