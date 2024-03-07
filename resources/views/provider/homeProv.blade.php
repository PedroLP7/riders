
@vite(['resources/css/app.css','resources/css/app.scss', 'resources/js/app.js'])
<link rel="stylesheet" href="../../resources/css/styles.css">

@if (Auth::check())
{{Auth::user()->userName}} {{Auth::user()->user_type->type_name}}

<h2>Bienvenido/a {{Auth::user()->userName}} tu rol es de {{Auth::user()->user_type->type_name}}</h2>

@endif


<div id="provider">


</div>




