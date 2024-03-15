@extends('Layouts.principal')
@section('contenido')



@include('php_partials.mensajes')
@vite(['resources/css/loginFormStyles.css'])

<form method="POST" action="{{action([App\Http\Controllers\UsuarioController::class,'authenticate'])}}" >
    @csrf

    <h3>{{'Iniciar Sesión'}}</h3>

    <div class="card"> 
      <div class="card-body">
          <div class="form-group row px-2">
              <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="user_name" value="{{old('username')}}" placeholder="Nombre de Usuario">
              </div>
          </div>
          <div class="form-group row mt-3 px-2">
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" name="pswd" value="{{old('password')}}" placeholder="Contraseña">
            </div>
          </div>

          <button class="btn btn-primary"type="submit">Aceptar</button>
      </div>
    </div>

</form>



@endsection
