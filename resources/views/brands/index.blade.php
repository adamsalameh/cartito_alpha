@extends('layout')
@section('content')

<a href="/brands/create">
	<button type="button" class="btn btn-outline-primary">Add New Brand</button>
</a>

<h2>Brands:</h2>

<table class="table">	   
    <tbody>
    @foreach($brands as $brand)
		<tr>
		    <td>{{$brand->title}}</td>
		    <td>
		    	<a href="/brands/{{$brand->id}}/edit" class="btn btn-outline-warning float-right btn-xs">
		    	    <i class="fas fa-edit" aria-hidden="true"></i>
		    	</a>
		    </td>
		    <td>
		    	<form method ="POST" action="/brands/{{$brand->id}}">
		    		@csrf
		  	        @method("DELETE")
		  	        <button type="submit" class="btn btn-outline-danger float-right btn-xs">
		  	        	<i class="fa fa-trash" aria-hidden="true"></i>
		  	        </button>
		  	    </form>
		    </td>
		</tr>
	@endforeach      
    </tbody>
</table>

@endsection