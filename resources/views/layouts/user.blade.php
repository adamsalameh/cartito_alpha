
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">WebSite</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">+1-111-1111-111</a></li>
   
        <li class="nav-item"><a class="nav-link" href="/">Contact Us</a></li>
        
      </ul>
    </div> 

      <!-- Right-aligned nav -->
      <ul class="nav justify-content-end">
        <li class="nav-item" ><a class="nav-link"  href="{{ route('wishLists') }}"><i class='nav-link fas fa-heart' style='font-size:18px;color:white'></i>WishList</a>
        </li>

        <li class="nav-item" ><a class="nav-link"  href="{{ route('carts') }}"><i class='nav-link fas fa-shopping-cart' style='font-size:18px;color:white'></i>Cart</a>
        </li>

          @guest
          {{-- @if (Route::has('register'))

          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">
              <i class='nav-link far fa-user' style='font-size:18px;color:white'></i>{{ __('Register') }}</a>
          </li>

          @endif --}}


            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">
             <i class='nav-link far fa-user' style='font-size:18px;color:white'></i>{{ __('Login / Register') }}</a>
            </li>

            @else

            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" {{-- aria-haspopup="true" aria-expanded="false" v-pre --}}>
                <i class='nav-link fas fa-user' style='font-size:18px;color:white'></i>{{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu" {{-- aria-labelledby="navbarDropdown" --}}>
               
             <a class="dropdown-item" href="/profiles/{{Auth::user()->id}}">Profile</a>
             <a class="dropdown-item" href="/addresses/">Adresses</a>
             <a class="dropdown-item" href="/orders/">Orders</a>
             <a class="dropdown-item" href="/payments">Payments</a>
             <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
               {{ __('Logout') }}
             </a>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    
  </div>

</nav>