@extends('layout')
@section('content')

@if(count($cartProducts) < 1)
    there is no products in the cart
    <a href="/"class="btn btn-outline-primary">Start Shopping </a>
@else
    <div class="row">
        <div class="col-sm-2 text-center">Product</div>
        <div class="col-sm-1 text-center">Title</div>
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

        <div class="col-sm-1 text-center">
            <form class="form-row" method ="POST" action="carts/{{$cartProduct->id}}">
                @csrf 
                @method('PATCH')

                <input id="quantity" type="text" class="form-control" name="quantity" value="{{$cartProduct->quantity}}">
        </div>

        <div class="col-sm-1 text-center">
            <button type="submit" class="btn btn-outline-primary sm-2 btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i></button>
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

    <div class="row mt-4">
        <div class="col-sm-2 text-center">
            <form method ="POST" action="carts/{{$cart->id}}">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn btn-outline-danger float-right btn-xs">Empty Cart</i></button>
            </form>
        </div>
        <div class="col-sm-2 text-center">
            <a href="/"class="btn btn-outline-primary">continue Shopping </a>
        
        </div>

        <div class="col-sm-2 text-center">
            <a href="/"class="btn btn-outline-primary">check out </a>
        
        </div>
    </div>    
        
@endif 
@endsection

<script>

function checkCookie(){
    var cookieEnabled=(navigator.cookieEnabled)? true : false   
    if (typeof navigator.cookieEnabled=="undefined" && !cookieEnabled){ 
        document.cookie="testcookie";
        cookieEnabled=(document.cookie.indexOf("testcookie")!=-1)? true : false;
    }
    return (cookieEnabled)?true:showCookieFail();
}

function showCookieFail(){
  alert('Please enable cookie');
}
window.onload = function() {   checkCookie(); };
</script>
