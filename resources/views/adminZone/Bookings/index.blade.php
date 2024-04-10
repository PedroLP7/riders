@extends('Layouts.admin')

@section('contenido')

@include('php_partials.mensajes')









<a class="btn btn-primary" href="{{url('admin/bookings/create')}}">Create Bookings</a>
<table class="table">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">RIDER</th>
        <th scope="col">PROVIDER</th>
        <th scope="col">MENU</th>
        <th scope="col">CANTIDAD</th>
        <th scope="col">STATUS</th>
        <th scope="col">DATE</th>

















      </tr>

    <tbody>

        @foreach ($bookings as $booking)
       <td>{{$booking->id_booking}}</td>
         <td>{{$booking->rider->user->user_name}}</td>
            <td>{{$booking->provider->user->user_name}}</td>
            <td>{{$booking->menu->item1}}
            <br>
            {{$booking->menu->item2}}
            <br>
            {{$booking->menu->item3}}
        </td>
        <td>{{$booking->menu_quantity}}</td>
        <td>{{$booking->status->status_name}}</td>

        <td>{{$booking->curr_date}}</td>










        <td>
            <form method="GET" action="{{action( [App\Http\Controllers\BookingController::class,'edit'],['booking' => $booking->id_booking] )}}">
                @csrf



                <button class="btn btn-primary" type="submit">Editar</button>

            </form>

        </td>
        <td>
            <form method="POST" action=" {{ action( [App\Http\Controllers\BookingController::class,'destroy'],['booking' => $booking->id_booking] )}}">
                @csrf

                @method('DELETE')

                <button class="btn btn-danger" type="submit">Borrar booking</button>
                </form>
         </td>





    </tbody>
     @endforeach
    </table>



@endsection


