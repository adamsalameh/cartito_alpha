@extends('layout')
@section('content')
@if(count($cartProducts) < 1)
    there is no products in the cart
    <a href="/"class="btn btn-outline-primary">Start Shopping </a>
@else
    <div class="row">
        <div class="col-sm-2 text-center">Product</div>
        <div class="col-sm-1 text-center">Title</div>
        <div class="col-sm-3 text-center">Description</div> 
        <div class="col-sm-2 text-center">Quantity</div>
        <div class="col-sm-1 text-center">Price</div>
        <div class="col-sm-1 text-center">SubTotal</div>
        
    </div>

    @foreach($cartProducts as $cartProduct)
    <div class="row mt-3">
        <div class="col-sm-2 text-center">                        
            <a class="thumbnail pull-left" href="/product{{$cartProduct->product->id}}">
                <img class="media-object" src="{{$cartProduct->product->productImage->first()['image_path']}}" style="width: 100px; height: 72px;">
            </a>
        </div> 

        <div class="col-sm-1 text-center">
            <a href="/product{{$cartProduct->product->id}}">{{$cartProduct->product->title}}</a>
        </div>

       {{--  <div class="col-sm-3 text-center">
            {{str_limit($cartProduct->product->description,50)}}
        </div> --}}

        <div class="col-sm-4 text-center">
            <form class="form-row" method ="POST" action="carts/{{$cartProduct->id}}">
                @csrf 
                @method('PATCH')
                <div class="col-sm-2 text-center">

                <input id="quantity" type="text" class="form-control" name="quantity" value="{{$cartProduct->quantity}}">
                </div>

                <div class="col-sm-2 text-center">
                <button type="submit" class="btn btn-outline-primary sm-2 btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>



        @if (is_null($cartProduct->product->promotionPrice))
            <div class="col-sm-1 text-center">        
                <strong><p>{{$cartProduct->product->price}} $</p></strong>
            </div>
        @else
            <div class="col-sm-1 text-center">  
            <p><del>{{$cartProduct->product->price}}</del> $
               <strong><span class="badge badge-danger">Now {{$cartProduct->product->promotionPrice}} $</span></strong></p>        
            </div>
        @endif

        <div class="col-sm-1 text-center">
                <strong>${{$cartProduct->subTotal}}</strong>
        </div>

        <div class="col-sm-2 text-center">
            <form method ="POST" action="carts/Product/{{$cartProduct->id}}">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn btn-outline-danger float-right btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </form>
        </div>

    </div>
    @endforeach

    <div class="row mt-3">
        <div class="col-sm-2 text-center">
                <form method ="POST" action="carts/{{$cart->id}}">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-outline-danger float-right btn-xs">Empty Cart</i></button>
                </form>
        </div>
    </div>

    @if(!Auth::user()->profile)
        You don't have a profile
        please create one
        <a href="/profiles/create" class="btn btn-outline-primary">Create Profile</a>

    @elseif(count(Auth::user()->address) <1)
        You don't have a address
        please create one
        <a href="/addresses/create" class="btn btn-outline-primary">Create address</a>

    @else
    {{-- shipping address radio button --}}
        <div class="row mt-3">
            <div class="col-md-4">
                <h3>Shipping Address: {{ Auth::user()->address->count() }} </h3> 
            </div>

            @for( $x =0;$x <count(Auth::user()->address);$x++)
            <div class="form-check-inline">
                <label><input id="radio{{$x}}" type="radio" name="shipping_address" > Address {{$x+1}}</label>
            </div>
            @endfor
        </div>

        {{--  Shipping address fields --}}
        <form id="form" method="POST" action="/orders">
        @csrf

            <div class="row"> 
                <div class="col-md-4">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" name="first_name" value="{{Auth::user()->name}}">
                </div>

                <div class="col-md-4">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" name="last_name" value="{{Auth::user()->name}}">
                </div>

                <div class="col-md-4">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}">
                </div>

                <div class="col-md-4">
                    <label for="telephone">Telephone:</label>
                    <input type="text" class="form-control" name="telephone" value="{{Auth::user()->profile->telephone}}">
                </div>

                <div class="col-md-4">
                    <label for="company">company:</label>
                    <input id="company" type="text" class="form-control" name="company" value="{{Auth::user()->address->first()->company}}">
                </div>

                <div class="col-md-4">
                    <label for="address">Address:</label>
                    <input id="address" type="text" class="form-control" name="address" value="{{Auth::user()->address->first()->address}}">
                </div>

                <div class="col-md-4">
                    <label for="post_code">Zip Code:</label>
                    <input id="post_code" type="text" class="form-control" name="post_code" value="{{Auth::user()->address->first()->post_code}}">
                </div>

                <div class="col-md-4">
                    <label for="city">City:</label>
                    <input id="city" type="text" class="form-control" name="city" value="{{Auth::user()->address->first()->city}}">
                </div>  


                <div class="col-md-4">
                    <label for="country">Country:</label>
                    <input id="country"type="text" class="form-control" name="country" value="{{Auth::user()->address->first()->country}}">
                </div>
            </div>

            <div class="row mt-3">
                {{-- shipping method --}}
                <div class="col-md-4">
                    @foreach($shippingMethods as $shippingMehtod)
                     <div class="radio">
                      <label><input id="{{$shippingMehtod->id}}" type="radio" name="shipping_method_id" value="{{$shippingMehtod->id}}">{{$shippingMehtod->company_name}}</label>
                      </div>
                    @endforeach
                </div>

              {{-- payment method --}}
                <div class="col-md-4">

                    <div class="radio">
                        <label><input id="paypal" type="radio" name="payment_method" value="paypal">PayPal</label>
                    </div>

                    <div class="radio">
                        <label><input id="creditCard" type="radio" name="payment_method" value="creditCard">Credit Card</label>
                    </div>

                    <div class="radio">
                        <label><input id="cash" type="radio" name="payment_method" value="cash" checked>Cash on Delivery</label>
                    </div>
                </div>

               
                <div class="col-md-4">
                    <h3><strong><p id="total" type="text" name="total">Total: ${{$total}}</p></strong></h3>        

                    <a href="/"><button type="button" class="btn btn-outline-primary">
                        <span class="fa fa-shopping-cart"></span> Continue Shopping
                    </button>
                    </a>
                {{-- <a href="/orders/create"><button type="button" class="btn btn-primary">checkout</button></a> --}}
                    <button type="submit" class="btn btn-outline-primary">CheckOut</button>
                </div>
            </div>
        </form>
    @endif

<script>
    $(document).ready(function(){

       @foreach($shippingMethods as $shippingMehtod) 
       $("#{{$shippingMehtod->id}}").change(function(){
        $("#total").text("Total: ${{$total + $shippingMehtod->fee}}");

    });
       @endforeach

       @for($i =0; $i<count(Auth::user()->address);$i++)  
       $("#radio{{$i}}").click(function(){
        $("#company").val("{{Auth::user()->address[$i]->company}}");
        $("#address").val("{{Auth::user()->address[$i]->address}}");
        $("#post_code").val("{{Auth::user()->address[$i]->post_code}}");
        $("#city").val("{{Auth::user()->address[$i]->city}}");
        $("#country").val("{{Auth::user()->address[$i]->country}}");
    });
       @endfor

   });
</script>
@endif 
@endsection

