@extends('layout')
@section('content')

<div class="row">

    <a href="/promotions/create">
        <button type="button" class="btn btn-outline-primary">Add New Promotion</button>
    </a>

    <div class="col-sm-12 mt-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#Promotion</th>
                    <th>title</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Created At</th>          
                </tr>
            </thead>

            <tbody>
                @foreach ($promotions as $promotion)        
                    <tr class='clickable-row'>   
                        <td>{{ $promotion->id}}</td>
                        <td> {{ $promotion->title}}</td>
                        <td> {{ $promotion->type}}</td>
                        <td> {{ $promotion->value}}</td>
                        <td> {{ $promotion->start_date}}</td>
                        <td> {{ $promotion->end_date}}</td>
                        <td>                            
                            @if($promotion->is_active)
                            Active
                            @else
                            Not Active
                            @endif
                        </td>           
                        <td> {{ $promotion->created_at}}</td>
                        <td> {{ $promotion->updated_at}}</td> 
  
                        <td>
                        <a href="/promotions/{{$promotion->id}}/edit" class="btn btn-outline-warning float-center btn-xs"><i class="fas fa-edit" aria-hidden="true"></i></a>
                        </td>

                        <td>
                        <form method ="POST" action="/promotions/{{$promotion->id}}">
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
