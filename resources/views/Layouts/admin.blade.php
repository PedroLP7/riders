<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    @vite(['resources/css/app.css','resources/css/app.scss', 'resources/js/app.js'])

</head>
<body>





    <nav class="navbar navbar-expand-lg bg-warning">
        <div class="container-fluid">

                <a class="navbar-brand" href="{{url('/admin/home')}}">
                  <img src="{{ asset('img/homeadmin.png') }}" id="imglogo" alt="logia" width="30" height="24" class="d-inline-block align-text-top">

                </a>


          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">




            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
{{-- cambiar esto a un 3 para que sea para el admin  --}}
                @if (Auth::check()&&Auth::user()->user_type_id==1)
                <li class="nav-item dropdown  ">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Admin Functions
                    </a>
                    <ul class="dropdown-menu danger">
                      <li><a class="dropdown-item" href="{{url('/admin/home')}}">All users</a></li>
                      <li><a class="dropdown-item" href="{{url('/admin/riders')}}">Riders</a></li>
                      <li><a class="dropdown-item" href="{{url('admin/providers')}}">Providers</a></li>
                        <li><a class="dropdown-item" href="{{url('admin/customers')}}">Customers</a></li>

                      <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{url('admin/bookings')}}">Bookings</a></li>
                        <li><a class="dropdown-item" href="{{url('admin/deliverys')}}">Deliverys</a></li>
                        <li><a class="dropdown-item" href="{{url('admin/stats')}}">Stats</a></li>





                    </ul>
                  </li>
                  @endif










            </ul>
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0 p-2 m-3">
                @if (Auth::check())
                <li class="nav-item">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          {{Auth::user()->user_name}}
                        </a>
                        <ul class="dropdown-menu">
                          <li> <a href="{{url('logout')}}" class="nav-link">Logout</a></li>

                        </ul>
                      </li>





                @else
                <li class="nav-item">
                    <a href="{{url('/loginForm')}}" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('register')}}" class="nav-link">Register</a>
                </li>
                @endif









          </div>
        </div>
      </nav>
    <div class="container">
        @yield('contenido')

    </div>
</body>
</html>
