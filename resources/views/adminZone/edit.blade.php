@extends('Layouts.principal')




@section('contenido')




<form  action="{{action([App\Http\Controllers\UsuarioController::class,'update'],$usuario->id_user)}}"  method="POST">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-title mt-3 px-3 ">

            <H2>Editando el usuario {{$usuario->user_name}}</H2>

        </div>
        @include('php_partials.mensajes')

        <div class="card-body">
            <div class="form-group row px-2">
                <label for="id" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="id" name="id" value="{{$usuario->user_id}}">
                </div>
            </div>
            <div class="form-group row mt-3 px-2">
              <label for="username" class="col-sm-2 col-form-label">UserName</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" value="{{$usuario->userName}}">
              </div>
            </div>

            <div class="form-group row mt-3 px-2">
                <label for="realname" class="col-sm-2 col-form-label">RealName</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="realname" name="realname" value="{{$usuario->realName}}">
                </div>
            </div>



            <div class=" mt-3 ">
                <label class="form-check-label px-2" for="flexCheckChecked">
                   Actiu
                  </label>
                <input class="form-check-input" type="checkbox" value="actiu" id="activo" name="activo"
                @if ($usuario->isActive == 1) checked @endif >

              </div>
              <div class="form-group mt-3">
                <button  class="btn btn-secondary" type="submit">Aceptar</button>
              </div>
          </form>

            </div>


        </div>




@endsection







