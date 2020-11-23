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
			<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_xclick" />
				<input type="hidden" name="no_note" value="1" />
				<input type="hidden" name="lc" value="UK" />
				<input type="hidden" name="currency_code" value="USD" />
				<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
				<input type="hidden" name="first_name" value="{{$order->first_name}}" />
				<input type="hidden" name="last_name" value="{{$order->last_name}}" />
				<input type="hidden" name="business" value="ahmed.salameh83-facilitator@gmail.com" />
				<input type="hidden" name="item_number" value="{{$order->id}}" / >
				<input type="hidden" name="item_name" value="Gold" />
				<input type="hidden" name="amount" value="{{$order->total_amount}}">
				<input type="hidden" name="cancel_return" value="http://demo.phpgang.com/payment_with_paypal/cancel.php">
				<input type="hidden" name="return" value="http://127.0.0.1:8000/payments/success">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
		</div>
	</div>
</div>
@endsection