@extends('layout')
@section('content')
<div class='container'>
    

<a href="/addresses/create"><button type="button" class="btn btn-outline-primary">Add New address</button></a>
<h1>Addresses :</h1>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Compnay</th>
          <th>Address</th>
          <th>Post Code</th>
          <th>City</th>
          <th>Country</th>
          <th>Created At</th>
          <th>Modified At</th>
          
          
        </tr>
      </thead>
  <tbody>
       @foreach($addresses as $address)
       
       <tr> 
           <td> {{ $address->company}} </td>
           <td> {{ $address->address}} </td>
           <td> {{ $address->post_code}} </td>
           <td> {{ $address->city}} </td>
           <td> {{ $address->country}} </td>
           <td> {{ $address->created_at}} </td>
           <td> {{ $address->updated_at}} </td>


           <td>    
       

                
        
        <a href="/addresses/{{$address->id}}/edit" class="btn btn-outline-warning float-right btn-xs"><i class="fas fa-edit" aria-hidden="true"></i></a>

     


    </td>
    

           <td>

      <form method ="POST" action="/addresses/{{$address->id}}">
        @csrf
        @method("DELETE")

                
        
        <button type="submit" class="btn btn-outline-danger float-right btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></button>

     

          </form>

    </td>



       </tr>    
        
       @endforeach
       
      </tbody> 
    </table>
</div>
 @endsection   
