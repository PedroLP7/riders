<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">   
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{url('/index')}}">Index</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">




            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                @if (Auth::check()&&Auth::user()->user_type_id==1)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Zona admin
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{url('admin')}}">UserList</a></li>
                      <li><a class="dropdown-item" href="#">a</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="{{url('modul')}}">Stats</a></li>
                    </ul>
                  </li>

                @endif



            </ul>
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0 p-3">
                @if (Auth::check())
                <li class="nav-item">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          {{Auth::user()->real_name}} {{Auth::user()->surname1}}
                        </a>
                        <ul class="dropdown-menu">
                          <li> <a href="{{url('logout')}}" class="nav-link">Logout</a></li>

                        </ul>
                      </li>





                @else
                <li class="nav-item">
                    <a href="{{url('login')}}" class="nav-link">Login</a>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
