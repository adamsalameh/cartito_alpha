@extends('layout')
@section('content')

<div class='container'>
    <div class="row">
        <div class="col-sm-12 mt-3">            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#Customer</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Created At</th>
                        <th>Modified At</th>
                        <th>Customer IP</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($profiles as $profile)
                    <tr> 
                        <td> {{ $profile->user->id}}   </td>
                        <td> {{ $profile->first_name}} </td>
                        <td> {{ $profile->last_name}}  </td>
                        <td> {{ $profile->user->email}}</td>
                        <td> {{ $profile->telephone}}  </td>
                        <td> {{ $profile->created_at}} </td>
                        <td> {{ $profile->updated_at}} </td>
                        <td>
                            <a href="/profiles/{{$profile->id}}/edit" class="btn btn-outline-warning float-right btn-xs">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>
                        <form method ="POST" action="/profiles/{{$profile->id}}">
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
        </div>
    </div>
</div>
@endsection   