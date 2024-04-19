@extends('Layouts.admin')

@section('contenido')

@include('php_partials.mensajes')









<a class="btn btn-warning mt-3" href="{{url('admin/riders/create')}}">Create Rider</a>
<table class="table table-dark table-hover mt-3">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">UserName</th>
        <th scope="col">RealName</th>
        <th scope="col">Surname1</th>
        <th scope="col">Surname2</th>
        <th scope="col">Mail</th>
        <th scope="col">Phone Numberf</th>







        <th>Dni/Cif</th>

        <th>Active</th>


      </tr>

    <tbody>

        @foreach ($riders as $rider)
       <td>{{$rider->id_rider}}</td>
       <td>{{$rider->user->user_name}}</td>
       <td>{{$rider->user->real_name}}</td>
         <td>{{$rider->surname1}}</td>
            <td>{{$rider->surname2}}</td>
            <td>{{$rider->mail}}</td>
            <td>{{$rider->phone_number}}</td>





        <td>{{$rider->user->dni_cif}}</td>

        <td> @if ($rider->user->isActive == 1)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="isActive" name="isActive" value="isActive" checked>
                <label class="custom-control-label" for="isActive"></label>
              </div>
        @else
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="isActive" name="isActive" value="isActive" >
            <label class="custom-control-label" for="isActive"></label>




            </div>

        @endif
    </td>


        <td>
            <form method="GET" action="{{action( [App\Http\Controllers\RiderController::class,'edit'],['rider' => $rider->id_rider] )}}">
                @csrf



                <button class="btn btn-warning" type="submit">Editar</button>

            </form>

        </td>
        <td>
            <form method="POST" action=" {{ action( [App\Http\Controllers\RiderController::class,'destroy'],['rider' => $rider->id_rider] )}}">
                @csrf

                @method('DELETE')

                <button class="btn btn-danger" type="submit">Desactivar</button>
                </form>
         </td>




         <td>
            <form method="POST" action=" {{ action( [App\Http\Controllers\RiderController::class,'reactivate'],['rider' => $rider->id_rider] )}}">
                @csrf

                @method('PUT')

                <button class="btn btn-primary" type="submit">Reactivate</button>
                </form>
         </td>
    </tbody>
     @endforeach
    </table>



@endsection


