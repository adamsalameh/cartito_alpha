@extends('layout')
@section('content')

<div class='container'>

    @if(!$profile)

    <a href="/profiles/create"><button type="button" class="btn btn-outline-primary">Create Profile</button></a>

    @else

    <h1>Your Profile:</h1>
    <table class="table"> 
        <tr> 
            <td>{{ $profile->first_name }}</td>
            <td>{{ $profile->last_name  }}</td>
            <td>{{ $profile->telephone  }}</td>
            <td>{{ $profile->created_at }}</td>
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
    </table>

    @endif

</div>
@endsection   