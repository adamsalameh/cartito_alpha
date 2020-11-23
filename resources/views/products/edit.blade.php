@extends('layout')
@section('content')

<!-- Content here -->
<form method="POST" action="/products/{{$product->id}}">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="sub_category_id">Category:</label>
        <select class="form-control" name="sub_category_id">
            @foreach($categories as $category)
                <optgroup label="{{$category->title}}">
                    @foreach($subCategories as $subCategory)
                        <option value={{$subCategory->id}} {{($subCategory->id == $product->sub_category_id) ? 'selected' : ''}}>{{$subCategory->title}}
                        </option>
                    @endforeach
                </optgroup>
            @endforeach
		</select>
    </div>

    <div class="form-group">
        <label for="usr">Title:</label>
        <input type="text" class="form-control" name="title" value="{{$product->title}}">
	</div>

    <div class="form-group">
        <label for="brand">Brand:</label>
        <select class="form-control" name="brand_id">
			
            @foreach($brands as $brand)
                <option value={{$brand->id}} {{($brand->id == $product->brand_id) ? 'selected' : ''}}>{{$brand->title}}
                </option>
            @endforeach
		</select>
    </div>

    <div class="form-group">
        <label for="usr">tag:</label>
        <input type="text" class="form-control" name="tag" value={{$product->tag}}>
    </div>

    <div class="form-group">
        <label for="usr">quantity:</label>
        <input type="text" class="form-control" name="quantity" value={{$product->quantity}}>
    </div>
    <div class="form-group">
        <label for="usr">price:</label>
        <input type="text" class="form-control" name="price" value={{$product->price}}>
    </div>
    <div class="form-check">
        <label class="form-check-label">
			<input type="hidden" name="in_stock" value="0">
			<input type="checkbox" name="in_stock" value="1" {{($product->inStock =='1' ) ? 'checked':''}}>In stock
        </label>
    </div>

	<div class="form-group">
		<label for="brand">Promotion:</label>
		<select class="form-control" name="promotion_id">			
			@foreach($promotions as $promotion)
				<option value={{$promotion->id}} {{($promotion->id == $product->promotion_id) ? 'selected' : ''}}>{{$promotion->title}}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="comment">Description:</label>
		<textarea class="form-control" rows="5" name="description">{{$product->description}}</textarea>
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection