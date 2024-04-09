@extends('Layouts.principal')




@section('contenido')




<form  action="{{action([App\Http\Controllers\BookingController::class,'store'])}}"  method="POST">
    @csrf
    @method('POST')
    <div class="card">
        <div class="card-title mt-3 px-3 ">

            <H2>Creating a booking</H2>


        </div>
        @include('php_partials.mensajes')

        <div class="card-body">





            <div class="form-group row mt-3 px-2">
                <label for="location" class="col-sm-2 col-form-label">Location</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="location" name="location" value="">
                </div>
            </div>






            <div class="form-group row mt-3 px-2">
                <label for="rider" class="col-sm-2 col-form-label">Xcoord</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="rider" name="rider" value="">
                </div>
            </div>









              <div class="form-group mt-3">
                <button  class="btn btn-secondary" type="submit">Aceptar</button>
              </div>
              <div class="form-group mt-3">
                <a class="btn btn-primary" href="{{url('admin/customers/')}}">Cancelar</a>
              </div>
          </form>

            </div>


        </div>




@endsection







