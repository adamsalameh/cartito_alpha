@extends('layout')
@section('content')

<a href="/subCategories/create">
	<button type="button" class="btn btn-outline-primary">Add New Category</button>
</a>

<h2>SubCategories:</h2>

<table class="table">    
    <tbody>
        @foreach($subCategories as $subCategory)
        <tr>
            <td>{{$subCategory->category->title}}</td>	
            <td>{{$subCategory->title}}</td>
            <td>
                <a href="/subCategories/{{$subCategory->id}}/edit" class="btn btn-outline-warning float-center btn-xs">
                	<i class="fas fa-edit" aria-hidden="true"></i>
                </a>
            </td>

            <td>
                <form method ="POST" action="/subCategories/{{$subCategory->id}}">
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