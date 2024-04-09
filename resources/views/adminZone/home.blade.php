@extends('Layouts.admin')

@section('contenido')

@include('php_partials.mensajes')

{{-- <div class="card">

    <h5 class="card-title">Filter by</h5>
    <div class="card-body">
        <form action=" {{ action( [App\Http\Controllers\UsuarioController::class,'admin'] )}}">

            @csrf
            <div class="form-row">
                <div class="col-1">



                <div class="custom-control custom checkbox">
                    <input type="checkbox" class="custom-control-input"id="ridersbuscar" name="Usuarios" value="" >
                    <label class="custom-control-label" for="ridersbuscar">Riders</label>
                </div>

                <div class="custom-control custom checkbox">
                    <input type="checkbox" class="custom-control-input"id="customer" name="customer" value="" >
                    <label class="custom-control-label" for="customer">Customer</label>
                </div>

                <div class="custom-control custom checkbox">
                    <input type="checkbox" class="custom-control-input"id="providers" name="providers" value="" >
                    <label class="custom-control-label" for="providers">Provider</label>
                </div>







                </div>
                <div class="col-1">
                    <button type="submit"class="btn btn-secondary">Search</i></button>


                </div>
            </div>
                </form>

    </div> --}}












</div>

<table class="table">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">UserName</th>
        <th scope="col">RealName</th>

        <th scope="col">UserType</th>


        <th>Dni/Cif</th>

        <th>Active</th>


      </tr>

    <tbody>

        @foreach ($usuarios as $usuario)
       <td>{{$usuario->id_user}}</td>
       <td>{{$usuario->user_name}}</td>
       <td>{{$usuario->real_name}}</td>

     <td>{{$usuario->user_type->type_name}}</td>


        <td>{{$usuario->dni_cif}}</td>

        <td> @if ($usuario->isActive == 1)
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


        <td>{{$usuario->size}}</td>
        <td>{{$usuario->location}}</td>
        <td>{{$usuario->fed}}</td>
        <td>
            {{-- <form method="GET" action="{{action( [App\Http\Controllers\UsuarioController::class,'edit'],['usuario' => $usuario->id_user] )}}">
                @csrf



                <button class="btn btn-primary" type="submit">Editar</button>

            </form> --}}

        </td>
        <td>
            {{-- <form method="POST" action=" {{ action( [App\Http\Controllers\UsuarioController::class,'destroy'],['usuario' => $usuario->user_id] )}}">
                @csrf

                @method('DELETE')

                <button class="btn btn-danger" type="submit">Borrar</button>
                </form> --}}
         </td>

    </tbody>
     @endforeach
    </table>



@endsection


