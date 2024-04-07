@extends('Layouts.admin')

@section('contenido')

@include('php_partials.mensajes')









<a class="btn btn-primary" href="{{url('admin/providers/create')}}">Create Provider</a>
<table class="table">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">UserName</th>
        <th scope="col">RealName</th>
        <th scope="col">Adress</th>







        <th>Dni/Cif</th>

        <th>Active</th>


      </tr>

    <tbody>

        @foreach ($providers as $provider)
       <td>{{$provider->id_provider}}</td>
       <td>{{$provider->user->user_name}}</td>
       <td>{{$provider->user->real_name}}</td>
         <td>{{$provider->adress}}</td>





        <td>{{$provider->user->dni_cif}}</td>

        <td> @if ($provider->user->isActive == 1)
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
            <form method="GET" action="{{action( [App\Http\Controllers\ProviderController::class,'edit'],['provider' => $provider->id_provider] )}}">
                @csrf



                <button class="btn btn-primary" type="submit">Editar</button>

            </form>

        </td>
        <td>
            <form method="POST" action=" {{ action( [App\Http\Controllers\ProviderController::class,'destroy'],['provider' => $provider->id_provider] )}}">
                @csrf

                @method('DELETE')

                <button class="btn btn-danger" type="submit">Desactivar</button>
                </form>
         </td>




         <td>
            <form method="POST" action=" {{ action( [App\Http\Controllers\ProviderController::class,'reactivateP'],['provider' => $provider->id_provider] )}}">
                @csrf

                @method('PUT')

                <button class="btn btn-primary" type="submit">Reactivate</button>
                </form>
         </td>
    </tbody>
     @endforeach
    </table>



@endsection


