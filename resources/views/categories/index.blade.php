@extends('layout')
@section('content')	

<a href="/categories/create">
  <button type="button" class="btn btn-outline-primary">Add New Category</button>
</a>

<h2>Categories:</h2>
<table class="table">
    <tbody>
        @foreach($categories as $Category)
        <tr>
		        <td>{{$Category->title}}</td>
		        <td>
                <a href="/subCategories/create" class="btn btn-outline-primary float-right btn-xs"><i class="fa fa-tags" aria-hidden="true"></i></a>
            </td>
		        <td>
                <a href="/categories/{{$Category->id}}/edit" class="btn btn-outline-warning float-right btn-xs"><i class="fas fa-edit" aria-hidden="true"></i></a>
            </td>
            <td>
                <form method ="POST" action="/categories/{{$Category->id}}">
                    @csrf
                    @method("DELETE")

                    <button type="submit" class="btn btn-outline-danger float-right btn-xs">
                      <i class="fa             fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
            </td>           
		    </tr>
	      @endforeach    
      
    </tbody>
</table>
 
@endsection