
@vite(['resources/css/app.css','resources/css/app.scss', 'resources/js/app.js'])


@if (Auth::check())
{{Auth::user()->user_name}} {{Auth::user()->user_type->type_name}}

<h2>Bienvenido/a {{Auth::user()->user_name}} tu rol es de {{Auth::user()->user_type->type_name}}</h2>

@endif


<div id="provider"></div>


<div id="bookings"></div>

