@extends('Layouts.principal')


@section('contenido')



@if (Auth::check())
{{Auth::user()->userName}} {{Auth::user()->user_type->type_name}}



@endif



@endsection
