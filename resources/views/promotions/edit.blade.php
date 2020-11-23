@extends('layout')
@section('content')

<!-- Content here -->
<form method="POST" action="/promotions/{{$promotion->id}}">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="promotion title">Title:</label>
        <input type="text" class="form-control" name="title" value="{{$promotion->title}}">
    </div>

    <div class="form-group">
        <label for="sel1">Type:</label>
        <select class="form-control" id="sel1" name="type" value="{{$promotion->type}}">
            <option value="percentage" >Percentage</option>
            <option value="discount">Discount</option>
        </select>
    </div>

    <div class="form-group">
        <label for="promotion value">Value:</label>
        <input type="text" class="form-control" name="value" value="{{$promotion->value}}">
    </div>

    <div class="form-group">
        <label for="promotion coupon">Start Date:</label>
        <input type="date" class="form-control" name="start_date" value="{{$promotion->start_date}}">
    
    </div>

    <div class="form-group">
        <label for="promotion coupon">End Date:</label>
        <input type="date" class="form-control" name="end_date" value="{{$promotion->start_end}}">    
    </div>

    <div class="form-group">
    	       <input type="hidden" name="is_active" value="0">
        <label><input type="checkbox" name="is_active" value="1">Is Active</label>
    </div>	

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection