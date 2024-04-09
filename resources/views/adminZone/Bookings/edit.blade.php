@extends('Layouts.principal')




@section('contenido')




<form  action="{{action([App\Http\Controllers\BookingController::class,'update'],$booking->id_booking)}}"  method="POST">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-title mt-3 px-3 ">

            <H2>Editando un booking</H2>


        </div>
        @include('php_partials.mensajes')

        <div class="card-body">





            <div class="form-group row mt-3 px-2">
                <label for="id_booking" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="id_booking" name="id_booking" value="{{$booking->id_booking}}" disabled>
                </div>
            </div>




            <div class="form-group row mt-3 px-2">
                <label for="rider" class="col-sm-2 col-form-label">Rider</label>
                <div class="col-sm-10">
                 <select class="form-select" name="id_rider" id="id_rider">
                        @foreach ($riders as $rider)
                        @if ($rider->id_rider==$booking->id_rider_fk)
                            <option value="{{$rider->id_rider}}" selected>{{$rider->user->user_name}}</option>

                        @endif
                        <option value="{{$rider->id_rider}}">{{$rider->user->user_name}}</option>


                        @endforeach
                 </select>
                </div>
            </div>



            {{-- <div class="form-group row mt-3 px-2">
                <label for="id_provider" class="col-sm-2 col-form-label">Provider</label>
                <div class="col-sm-10">
                 <select class="form-select" name="id_provider" id="id_provider">
                        @foreach ($providers as $provider)
                        @if ($provider->id_provider==$booking->id_provider_fk)
                            <option value="{{$provider->id_provider}}" selected>{{$provider->user->user_name}}</option>

                        @endif
                        <option value="{{$provider->id_provider}}">{{$provider->user->user_name}}</option>


                        @endforeach
                 </select>
                </div>
            </div> --}}



            <div class="form-group row mt-3 px-2">
                <label for="quantity" class="col-sm-2 col-form-label">Cantidad</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="quantity" name="quantity" value="{{$booking->menu_quantity}}" >
                </div>
            </div>



            <div class="form-group row mt-3 px-2">
                <label for="id_status" class="col-sm-2 col-form-label">Satus</label>
                <div class="col-sm-10">
                 <select class="form-select" name="id_status" id="id_status">
                        @foreach ($status as $statu)
                        @if ($statu->id_status==$booking->id_status_fk)
                            <option value="{{$statu->id_status}}" selected>{{$statu->status_name}}</option>

                        @endif
                        <option value="{{$statu->id_status}}">{{$statu->status_name}}</option>


                        @endforeach
                 </select>
                </div>
            </div>

































          </form>

            </div>


        </div>




      @endsection







