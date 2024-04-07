@extends('Layouts.principal')




@section('contenido')




<form  action="{{action([App\Http\Controllers\ProviderController::class,'update'],$provider->id_provider)}}"  method="POST">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-title mt-3 px-3 ">

            <H2>Editando el provider {{$provider->user->user_name}}</H2>


        </div>
        @include('php_partials.mensajes')

        <div class="card-body">
            <div class="form-group row px-2">
                <label for="id" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="id" name="id" value="{{$provider->id_provider}}"disabled >
                </div>
            </div>
            <div class="form-group row mt-3 px-2">
              <label for="user_name" class="col-sm-2 col-form-label">UserName</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="user_name" name="user_name" value="{{$provider->user->user_name}}">
              </div>
            </div>

            <div class="form-group row mt-3 px-2">
                <label for="real_name" class="col-sm-2 col-form-label">RealName</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="real_name" name="real_name" value="{{$provider->user->real_name}}">
                </div>
            </div>

            <div class="form-group row mt-3 px-2">
                <label for="surname1" class="col-sm-2 col-form-label">Surname1</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="surname1" name="surname1" value="{{$provider->adress}}">
                </div>
            </div>











            <div class="form-group row mt-3 px-2">
                <label for="dni_cif" class="col-sm-2 col-form-label">Dni</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="dni_cif" name="dni_cif" value="{{$provider->user->dni_cif}}">
                </div>
            </div>





              <div class="form-group mt-3">
                <button  class="btn btn-secondary" type="submit">Aceptar</button>
              </div>
              <div class="form-group mt-3">
                <a  class="btn btn-primary "  href="{{url('/admin/providers')}}">Cancelar</a>
              </div>
          </form>

            </div>


        </div>




@endsection







