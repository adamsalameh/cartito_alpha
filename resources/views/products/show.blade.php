@extends('layout')
@section('content')

<div class="d-flex justify-content-around bg-gradient-light">
<div class="p-2">
<nav class="navbar navbar-expand-sm bg- navbar-dark">
<!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
            @foreach($categories as $category) 
                @if( count($category->subCategory) > 0)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            {{$category->title}}
                        </a>
                        <div class="dropdown-menu">
                            @foreach($category->subCategory as $subCat)
                                <a class="dropdown-item" href="/products/category/{{$subCat->id}}">
                                    {{$subCat->title}}
                                </a>
                            @endforeach
                        </div>      
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{$category->title}}</a>
                    </li>
                @endif                
            @endforeach        
        </ul>
    </div>  
</nav>
</div>
</div>
    
<div class="row">
    <div class="col-sm-6">
        <figure class="figure">
            @if(count($product->productImage))
                <img src="{{url($product->productImage[0]->image_path)}}" class="img-thumbnail" alt="...">
            @endif
        </figure>

        @foreach($product->productImage as $image)
            <img class="media-object" src="{{url($image->image_path)}}" style="width: 100px; height: 72px;">
        @endforeach
    </div>

    <div class="col-sm-6">
        <h3 class="text-center">{{$product->title}}</h3>
        @if (is_null($product->promotionPrice))
            <strong><p>Price: {{$product->price}} $</p></strong>
        @else
            <p><del>Price: {{$product->price}}</del> $
                <strong>
                    <span class="badge badge-danger float-right">Promotion {{$product->promotionPrice}} $</span>
                </strong>
            </p>
        @endif

        {{-- <strong><p>{{$product->promotionPrice()}} $</p></strong> --}}
        <div class="d-flex justify-content-around mb-3">
            <div class="p-1">
                <form method ="POST" action="{{url("/wishLists/$product->id")}}">
                    @csrf 
                    <button type="submit" class="btn btn-outline-primary float-center btn-xs">
                      <i class="fa fa-heart" aria-hidden="true"></i>
                    </button>
                </form>
            </div>

            <div class="p-1">
                <form method ="POST" action="{{url("/carts/$product->id")}}">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary float-right btn-xs">
                      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div> 
    </div>
</div>

<div class='row'>
    <div class="col-sm-12">
        <h3>Brand: </h3>
        <p>{{$product->brand->title}}</p> 
    </div>
  
    <div class="col-sm-12">
         <h3>Description: </h3>
         <p>{{$product->description}}</p>
    </div>
</div>

@endsection
