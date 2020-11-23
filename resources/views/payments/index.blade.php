@extends('layout')
@section('content')
<h1>The payments :</h1>
<table class="table table-striped">

 @foreach($payments as $payment)

 <tr> 
   <td>{{ $payment->id}}</td>
   <td> {{ $payment->user_id}}</td>
   <td> {{ $payment->order_id}}</td>
   <td> {{ $payment->payment_method}}</td>
   <td> {{ $payment->transaction_id}}</td>
   <td> {{ $payment->total_amount}}</td> 
    <td> {{ $payment->currency}}</td>         
   <td> {{ $payment->status}}</td>
   <td> {{ $payment->customer_ip}}</td> 
   <td> {{ $payment->created_at}}</td>
   <td> {{ $payment->updated_at}}</td>         
   
</tr>    

@endforeach


</table>

@endsection   
