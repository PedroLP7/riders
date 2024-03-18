<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css','resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
    @if (Auth::check())
    {{Auth::user()->user_name}} {{Auth::user()->user_type->type_name}}

    <h2>Bienvenido/a {{Auth::user()->user_name}} tu rol es de {{Auth::user()->user_type->type_name}}</h2>

    @endif


    <div id="provider"></div>

    {{-- <a class="btn btn-primary" href="{{url('logout')}}"> LOGOUT TEMPORAL</a> --}}
</body>
</html>

















