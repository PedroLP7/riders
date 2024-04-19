@extends('Layouts.admin')

@section('contenido')

@include('php_partials.mensajes')









<a class="btn btn-warning mt-3" href="{{url('admin/customers/create')}}">Create Customer</a>
<table class="table table-dark table-hover mt-3">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Location</th>











        <th>Active</th>


      </tr>

    <tbody>

        @foreach ($customers as $customer)
       <td>{{$customer->id_customer}}</td>
       <td>{{$customer->location}}</td>


       <td> @if ($customer->isActive == 1)
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
            <form method="GET" action="{{action( [App\Http\Controllers\CustomerController::class,'edit'],['customer' => $customer->id_customer] )}}">
                @csrf



                <button class="btn btn-warning" type="submit">Editar</button>

            </form>

        </td>
        <td>
            <form method="POST" action=" {{ action( [App\Http\Controllers\CustomerController::class,'destroy'],['customer' => $customer->id_customer] )}}">
                @csrf

                @method('DELETE')

                <button class="btn btn-danger" type="submit">Desactivar</button>
                </form>
         </td>




         <td>
            <form method="POST" action=" {{ action( [App\Http\Controllers\CustomerController::class,'reactivate'],['customer' => $customer->id_customer] )}}">
                @csrf

                @method('PUT')

                <button class="btn btn-primary" type="submit">Reactivate</button>
                </form>
         </td>
    </tbody>
     @endforeach
    </table>



@endsection


