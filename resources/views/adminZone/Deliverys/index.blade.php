@extends('Layouts.admin')

@section('contenido')

@include('php_partials.mensajes')









<a class="btn btn-primary" href="{{url('admin/providers/create')}}">Create Delivery</a>
<table class="table table-dark table-hover">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">ID booking</th>
        <th scope="col">delivery Date</th>
        <th scope="col">delivery hour</th>
        <th scope="col">customer</th>
        <th scope="col">customer location </th>












      </tr>

    <tbody>

        @foreach ($deliverys as $delivery)
       <td>{{$delivery->id_delivery}}</td>
       <td>{{$delivery->id_booking_fk}}</td>
       <td>{{$delivery->delivery_date}}</td>
         <td>{{$delivery->delivery_hour}}</td>





        <td>{{$delivery->customer->id_customer}}</td>7
        <td>{{$delivery->customer->location}}</td>7




        <td>
            {{-- <form method="GET" action="{{action( [App\Http\Controllers\ProviderController::class,'edit'],['provider' => $provider->id_provider] )}}">
                @csrf



                <button class="btn btn-primary" type="submit">Editar</button>

            </form> --}}

        </td>
        <td>
            {{-- <form method="POST" action=" {{ action( [App\Http\Controllers\ProviderController::class,'destroy'],['provider' => $provider->id_provider] )}}">
                @csrf

                @method('DELETE')

                <button class="btn btn-danger" type="submit">Desactivar</button>
                </form> --}}
         </td>




         <td>
            {{-- <form method="POST" action=" {{ action( [App\Http\Controllers\ProviderController::class,'reactivate'],['provider' => $provider->id_provider] )}}">
                @csrf

                @method('PUT')

                <button class="btn btn-primary" type="submit">Reactivate</button>
                </form> --}}
         </td>
    </tbody>
     @endforeach
    </table>



@endsection


