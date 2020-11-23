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
      <a class="dropdown-item" href="/products/category/{{$subCat->id}}">{{$subCat->title}}</a>
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



<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="views.upload/Dell-XPS-13.png" alt="Los Angeles" width="700" height="500">
    </div>
    <div class="carousel-item">
      <img src="views.upload/iPhone.jpg" alt="Chicago" width="700" height="500">
    </div>
    <div class="carousel-item">
      <img src="views.upload/MacBook.jpg" alt="New York" width="700" height="500">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>


</div>

@foreach($products->chunk(4) as $productChunk)
<div class="row">
    @foreach($productChunk as $product)
    <div class="col-sm-3">
       <figure class="figure">
            @if(count($product->productImage))
            <img src="{{url($product->productImage[0]->image_path)}}" class="img-thumbnail" alt="...">
            @endif
           <figcaption class="figure-caption">
                <h3>{{$product->title}}</h3>

                    {{-- @foreach($product->productImage as $image)
                    {{$image->image_path}}
                    @endforeach

                    {{count($product->productImage)}}
                    {{$product->productImage->first()['image_path']}} --}}

                     
                    <p>{{$product->description}}</p>
                    {{-- <strong><p>{{$product->price}} $</p></strong> --}}
                    {{-- @if (is_null($product->promotionPrice()))
                    <strong><p>{{$product->price}} $</p></strong>
                    @else
                    <p><del>{{$product->price}}</del> $
                       <strong><span class="badge badge-danger float-right">Promotion {{$product->promotionPrice()}} $</span></strong></p>
                    @endif --}}
                    @if (is_null($product->promotionPrice))
                    <strong><p>{{$product->price}} $</p></strong>
                    @else
                    <p><del>{{$product->price}}</del> $
                       <strong><span class="badge badge-danger float-right">Promotion {{$product->promotionPrice}} $</span></strong></p>
                    @endif




                       {{-- <strong><p>{{$product->promotionPrice()}} $</p></strong> --}}
                       <div class="d-flex justify-content-around mb-3">
                        <div class="p-1">
                            <a href="/products/{{$product->id}}" class="btn btn-outline-primary btn-xs"><i class="fa fa-reorder" aria-hidden="true"></i></a>
                        </div>
                        <div class="p-1">

                            <form method ="POST" action="wishLists/{{$product->id}}">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary float-center btn-xs"><i class="fa fa-heart" aria-hidden="true"></i></button>
                            </form>
                        </div>
                        <div class="p-1">
                            <form method ="POST" action="carts/{{$product->id}}">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary float-right btn-xs"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>




           </figcaption>
           </figure>
        </div>
        @endforeach
    </div>
    @endforeach

<div class="d-flex justify-content-around mb-3">
<div class="p-2">
{{ $products->links() }}
</div>
</div>
@endsection
