<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Dashboard - User</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/style/main.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    @yield('style')
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">User Dashboard</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fa fa-home fa-lg"></i> Home</a></li>
            <li><a class="dropdown-item" href="{{ route('profile.index', Auth::user()->id) }}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="page-login.html"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      @if (Auth::user()->avatar)
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ Auth::user()->avatar }}" width="60px" height="60px" alt="User Image">
      @else
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ asset('frontend/img/user.png') }}" width="60px" height="60px" alt="User Image">
      @endif
      
        <div>
          <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
          <p class="app-sidebar__user-designation">{{ Auth::user()->role }}</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item  {{ Request::is('myDashboard') ? 'active' : '' }}" href="{{ route('myDashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item {{ Request::is('myDashboard/userTransaction*') ? 'active' : '' }}" href="{{ route('transaction') }}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Transaction</span></a></li>
        <li><a class="app-menu__item {{ Request::is('myDashboard/reviews*') ? 'active' : '' }}" href="{{ route('reviews') }}"><i class="app-menu__icon fa fa-star"></i><span class="app-menu__label">Reviews</span></a></li>
      </ul>
    </aside>
    <main class="app-content">
      @yield('content')
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/library/jquery/jquery-min.3.6.0.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('frontend/js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('frontend/js/pace.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>
      @if(session()->has('success'))

      Swal.fire({
          icon: 'success',
          title: 'BERHASIL!',
          text: '{{ session('success') }}',
          showConfirmButton: false,
          timer: 3000
      })

      @elseif(session()->has('error'))

      Swal.fire({
          icon: 'error',
          text: 'GAGAL!',
          title: '{{ session('error') }}',
          showConfirmButton: false,
          timer: 10000
      })

      @endif
  </script>
  @yield('js')
  </body>
</html>