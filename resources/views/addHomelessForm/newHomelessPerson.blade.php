@extends('Layouts.principal')

@section('contenido')

@include('php_partials.mensajes')

<form action="{{ action([App\Http\Controllers\CustomerController::class, 'store']) }}" method="POST">

@csrf
  <div class="mb-3">
    <label for="location" class="form-label" >Address</label>
    <input type="text" class="form-control" id="location" name="address">
  </div>
  <div class="mb-3">
    <label class="form-label" for="x">X coordinates</label>
    <input type="number" class="form-control" id="x" name="x">
  </div>
  <div class="mb-3">
    <label class="form-label" for="y">Y coordinates</label>
    <input type="number" class="form-control" id="y" name="y">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endSection
