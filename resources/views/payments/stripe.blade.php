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
  		<div class="card-body">Shipping Method: {{$order->shippingMethod->company_name}}</div>
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
</div>

<div class="row">	
	<div class="col-sm-4">
		<div class="card">
  		<div class="card-header">Payment Details</div>
  		<div class="card-body">Payment Method: {{$order->payment_method}}</div>
  		<div class="card-body">Sub-Total: {{$orderProduct->where('order_id',$order->id)->sum('subtotal')}}</div>
  		<div class="card-body">Shipping Fees: {{$order->shipping_fees}} </div>
  		<div class="card-body">Total: {{$order->total_amount}}</div>
  		<div class="card-body"></div>
	  </div>
  </div>


<div class="col-sm-4">
	<form method="POST" action="/payment/creditCard/{{$order->id}}" class="require-validation"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                    id="payment-form">
                       
    @csrf

    <label>
      <span><span>Card Holder's Name:</span></span>
      <input name="cardholder-name" class="field is-empty" placeholder="Jane Doe" />
    </label>
    {{-- <label>
      <span><span>Phone number</span></span>
      <input class="field is-empty" type="tel" placeholder="(123) 456-7890" />
    </label> --}}
    <label>
      <span><span>Credit or debit card</span></span>
      <div id="card-element" class="field is-empty"></div>
    </label>
    <button type="submit">Pay</button>
    {{-- <div class="outcome">
      <div class="error" role="alert"></div>
        <div class="success">
          Success! Your Stripe token is <span class="token"></span>
        </div>
    </div> --}}
  </form>
  </div>
  @endsection
  @section('js')
<script>
// Create a Stripe client.
var stripe = Stripe('pk_test_1ll9OzVSUfrVflaRvONT0alO00wScSPG9D');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
	</script>
@endsection