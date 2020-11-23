@extends('layout')
@section('content')

<div class='container'>    

    <a href="/products/create">
        <button type="button" class="btn btn-outline-primary">Add New Product</button>
    </a>
    <h1>The Products :</h1>
    <table class="table">  
        @foreach($products as $product)       
            <tr> 
                <td>{{ $product->title}} </td>
                <td>  {{ $product->description}} </td>
                <td> {{ $product->quantity}} </td>
                <td> {{ $product->price}} </td>
                <td> {{ $product->tag}} </td>
                <td> {{ $product->brand->title}} </td>
                <td> {{ $product->subCategory->title}} </td>
                <td> {{ $product->in_stock}} </td>
                <td> {{ $product->created_at}} </td>

                <td>
                    <a href="/products/{{$product->id}}/edit" role="button" class="btn btn-outline-warning float-right btn-xs">
                        <i class="fas fa-edit" aria-hidden="true"></i>
                    </a>
                </td>

                <td>
                    <a href="/productImages/create/{{$product->id}}">
                        <button type="button" class="btn btn-outline-warning float-right btn-xs">
                            <i class="fas fa-image" aria-hidden="true"></i>
                        </button>
                    </a>
                </td>

                <td>
                    <form method ="POST" action="/products/{{$product->id}}">
                        @csrf
                        @method("DELETE") 
                        <button type="submit" class="btn btn-outline-danger float-right btn-xs"><i class="fa fa-trash" aria-hidden="true"></i>
                        </button>   

                    </form>
                </td>
                
            </tr>        
        @endforeach       
    </table>
</div>

@endsection   
