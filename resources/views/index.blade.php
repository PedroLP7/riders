@extends('Layouts.principal')


@section('contenido')



<a class="btn btn-primary" href="{{action([App\Http\Controllers\LoginController::class,'login'])}}">   prueba</a>



@endsection
