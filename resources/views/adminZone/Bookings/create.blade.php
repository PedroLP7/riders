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
                <label for="id_rider_fk" class="col-sm-2 col-form-label">Rider</label>
                <div class="col-sm-10">
                 <select class="form-select" name="id_rider_fk" id="id_rider_fk">
                        @foreach ($riders as $rider)


                        <option value="{{$rider->id_rider}}">{{$rider->user->user_name}}</option>


                        @endforeach
                 </select>
                </div>
            </div>





            <div class="form-group row mt-3 px-2">
                <label for="id_provider_fk" class="col-sm-2 col-form-label">Provider</label>
                <div class="col-sm-10">
                 <select class="form-select" name="id_provider_fk" id="id_provider_fk">
                        @foreach ($providers as $provider)


                        <option value="{{$provider->id_provider}}">{{$provider->user->user_name}}</option>


                        @endforeach
                 </select>
                </div>
            </div>


            <div class="form-group row mt-3 px-2">
                <label for="id_menu_fk" class="col-sm-2 col-form-label">Menu</label>
                <div class="col-sm-10">
                 <select class="form-select" name="id_menu_fk" id="id_menu_fk">
                        @foreach ($menus as $menu)


                        <option value="{{$menu->id_menu}}">{{$menu->item1 .  ' ' .$menu->item2 . ' ' . $menu->item3}}</option>


                        @endforeach
                 </select>
                </div>
            </div>


  <div class="form-group row mt-3 px-2">
                <label for="menu_quantity" class="col-sm-2 col-form-label">Cantidad</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="menu_quantity" name="menu_quantity" value="">
                </div>
            </div>

            <div class="form-group row mt-3 px-2">
                <label for="id_status_fk" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                 <select class="form-select" name="id_status_fk" id="id_status_fk">
                        @foreach ($status as $statu)


                        <option value="{{$statu->id_status}}">{{$statu->status_name}}</option>


                        @endforeach
                 </select>
                </div>
            </div>





              <div class="form-group mt-3">
                <button  class="btn btn-secondary" type="submit">Aceptar</button>
              </div>
              <div class="form-group mt-3">
                <a class="btn btn-primary" href="{{url('admin/bookings/')}}">Cancelar</a>
              </div>
          </form>

            </div>


        </div>




@endsection







