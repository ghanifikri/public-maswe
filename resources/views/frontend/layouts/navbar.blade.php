<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

    <!-- <h1 class="logo"><a href="index.html">DevFolio</a></h1> -->
    <!-- Uncomment below if you prefer to use an image logo -->
    <a href="{{ route('home') }}" class="logo mr-auto"><img src="{{ asset('frontend/img/logo3.png') }}" alt="" class="img-fluid"></a>

    <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
        <li><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
        <li class="dropdown"><a class="{{ Request::is('AboutUs*') ? 'active' : '' }}" href="#"><span>About Us</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="{{ route('history') }}">History</a></li>
            <li><a href="{{ route('values') }}">Values & People</a></li>
            <li><a href="{{ route('field') }}">Our Fields</a></li>
            <li><a href="{{ route('research') }}">Research</a></li>
          </ul>
        </li>
        <li><a class="nav-link {{ Request::is('produk*') ? 'active' : '' }}" href="{{ route('produk') }}">Product</a></li>
        <li><a class="nav-link {{ Request::is('gallery*') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a></li>
        <li><a class="nav-link {{ Request::is('news*') ? 'active' : '' }}" href="{{ route('news') }}">News</a></li>
        <li><a class="nav-link {{ Request::is('kontak*') ? 'active' : '' }}" href="{{ route('kontak') }}">Contact</a></li>
        @auth
        <li class="dropdown">
          <a class="{{ Request::is('AboutUs*') ? 'active' : '' }}" href="#"><span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="{{ route('myDashboard') }}">My Dashboard</a></li>
            <li><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign Out</a></li>
            <form method="POST" id="logout-form" action="{{ route('logout') }}" style="display: none">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </form>
          </ul>
        </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
    <div class="d-flex">
      <a href="{{ route('cart') }}" class="single-icon">
        <i class='ri-shopping-bag-line'></i>
        @php
            $carts = \App\Models\Cart::where('user_id', Auth::user()->id)->count(); 
        @endphp
        @if ($carts > 0)
          <span class="total-count">{{ $carts }}</span>
        @else
          <span class="total-count">0</span> 
        @endif
        
      </a>
    </div>
    @else
    <div class="d-flex">
      <a href="{{ route('frontend.login') }}" class="login-btn px-5 py-2">LOGIN</a>
    </div>
    @endauth

    

    </div>
</header><!-- End Header -->