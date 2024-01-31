@extends('Layouts.principal')
@section('contenido')




<form    method="POST">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-title mt-3 px-3 ">


        <h3>{{'Login'}}</h3>
        </div>
        {{-- @include('php_partials.mensajes') --}}

        <div class="card-body">
            <div class="form-group row px-2">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nombre" name="nombre" value="">
                </div>
            </div>
            <div class="form-group row mt-3 px-2">
              <label for="password" class="col-sm-2 col-form-label">NOM</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="password" name="password" value="">
              </div>
            </div>






          </form>

            </div>


        </div>




@endsection
