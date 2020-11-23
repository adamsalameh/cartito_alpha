@extends('layout')
@section('content')

<div class="row">

	<div class="col-sm-4">
		<div class="card">
		<div class="card-header">Customer Details</div>
		<div class="card-body">First Name: {{$order->first_name}} </div>
		<div class="card-body">Last Name: {{$order->last_name}}</div>
		<div class="card-body">E-mail: {{$order->email}}</div>
		<div class="card-body">Telephone: {{$order->telephone}}</div>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="card">
		<div class="card-header">Shipping Details</div>
		<div class="card-body">Shipping Method: {{$order->shippingMethod->companyName}}</div>
		<div class="card-body">Address: {{$order->address}}</div>
		<div class="card-body">Post code: {{$order->post_code}}</div>
		<div class="card-body">City: {{$order->city}}</div>
		<div class="card-body">Country: {{$order->country}}</div>
	    </div>
    </div>


	<div class="col-sm-4">
		<div class="card">
		<div class="card-header">Order Details No: {{$order->id}}</div>
		<table class="table">
			<thead>
				<tr>
					<th>Product</th>
					<th>price</th>
					<th>Quantity</th>
					<th>Sub-Total</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($orderProducts as $orderProduct)
				<tr>
					<td>{{$orderProduct->product_name}}</td>
					<td>{{$orderProduct->price}}</td>
					<td>{{$orderProduct->quantity}}</td>
					<td>{{$orderProduct->subtotal}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>
	</div>
	
	<div class="col-sm-4">
		<div class="card">
		<div class="card-header">Payment Details</div>
		<div class="card-body">Payment Method: {{$order->payment_method}}</div>
		<div class="card-body">Sub-Total: {{$orderProduct->where('order_id',$order->id)->sum('subtotal')}}</div>
		<div class="card-body">Shipping Fees: {{$order->shipping_fees}} </div>
		<div class="card-body">Total: {{$order->total_amount}}</div>
		<div class="card-body">
			<button type="submit" class="btn btn-outline-danger float-right btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></button>
		</div>
	</div>
</div>
@endsection