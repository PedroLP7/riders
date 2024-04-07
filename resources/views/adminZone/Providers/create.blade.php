@extends('Layouts.principal')




@section('contenido')




<form  action="{{action([App\Http\Controllers\ProviderController::class,'store'])}}"  method="POST">
    @csrf
    @method('POST')
    <div class="card">
        <div class="card-title mt-3 px-3 ">

            <H2>Creating a provider...</H2>


        </div>
        @include('php_partials.mensajes')

        <div class="card-body">

            <div class="form-group row mt-3 px-2">
              <label for="user_name" class="col-sm-2 col-form-label">UserName</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="user_name" name="user_name" value="">
              </div>
            </div>

            <div class="form-group row mt-3 px-2">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" name="password" value="">
                </div>
              </div>

            <div class="form-group row mt-3 px-2">
                <label for="real_name" class="col-sm-2 col-form-label">RealName</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="real_name" name="real_name" value="">
                </div>
            </div>


            <div class="form-group row mt-3 px-2">
                <label for="dni_cif" class="col-sm-2 col-form-label">Dni</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="dni_cif" name="dni_cif" value="">
                </div>
            </div>



            <div class="form-group row mt-3 px-2">
                <label for="adress" class="col-sm-2 col-form-label">Adress</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="adress" name="adress" value="">
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







