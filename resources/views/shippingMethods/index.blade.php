@extends('layout')
@section('content')

<div class="row">

    <a href="/shippingMethods/create">
        <button type="button" class="btn btn-outline-primary">Add New Shipping Method</button>
    </a>
    <div class="col-sm-12 mt-3">   
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#Shipping</th>
                    <th>Compnay name</th>
                    <th>Fees</th>
                    <th>Created At</th>
                    <th>updated At</th>          
                </tr>
            </thead>

            <tbody>
                @foreach ($shippingMethods as $shippingMethod)
                <tr class='clickable-row'>   
                    <td>{{ $shippingMethod->id}}</td>
                    <td> {{ $shippingMethod->company_name}}</td>
                    <td> {{ $shippingMethod->fee}}</td>
                    <td> {{ $shippingMethod->created_at}}</td>
                    <td> {{ $shippingMethod->updated_at}}</td>  
                    <td>
                        <a href="/shippingMethods/{{$shippingMethod->id}}/edit" class="btn btn-outline-warning float-center btn-xs"><i class="fas fa-edit" aria-hidden="true"></i>
                        </a>
                    </td>

                    <td>
                        <form method ="POST" action="/shippingMethods/{{$shippingMethod->id}}">
                            @csrf
                            @method("DELETE")

                            <button type="submit" class="btn btn-outline-danger float-right btn-xs"><i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>   
</div>

@endsection   
