@extends('Layouts.principal')


@section('contenido')



@if (Auth::check())
{{Auth::user()->userName}} {{Auth::user()->user_type->type_name}}

<h2>Bienvenido/a {{Auth::user()->userName}} tu rol es de {{Auth::user()->user_type->type_name}}</h2>

@endif



@endsection
