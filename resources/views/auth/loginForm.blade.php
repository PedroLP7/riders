@extends('Layouts.principal')
@section('contenido')



@include('php_partials.mensajes')
@vite(['resources/css/loginFormStyles.css'])

<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>

<form method="POST" action="{{action([App\Http\Controllers\UsuarioController::class,'authenticate'])}}" >
    @csrf

    <h3>{{'Iniciar Sesión'}}</h3>

    <div class="card"> 
      <div class="card-body">
          <div class="form-group row px-2">
              <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="user_name" value="{{old('username')}}" placeholder="Nombre de Usuario">
              </div>
          </div>
          <div class="form-group row mt-3 px-2">
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" name="pswd" value="{{old('password')}}" placeholder="Contraseña">
              <iconify-icon class="eye-active" icon="mdi:eye" height="24"></iconify-icon>
              <iconify-icon class="eye-unactive" icon="ph:eye-closed" height="24"></iconify-icon>
            </div>
          </div>

          <button class="btn btn-primary"type="submit">Aceptar</button>
      </div>
    </div>

</form>

<script>

  // placeholder show/hide

  const usernameInput = document.getElementById('username');
  const passwordInput = document.getElementById('password');

  usernameInput.addEventListener('click', () => {
    usernameInput.placeholder = '';
  });

  usernameInput.addEventListener('blur', () => {
    usernameInput.placeholder = 'Nombre de Usuario';
  });

  passwordInput.addEventListener('click', () => {
    passwordInput.placeholder = '';
  });

  passwordInput.addEventListener('blur', () => {
    passwordInput.placeholder = 'Contraseña';
  });

  // toggle password visibility

  let eyeActive = document.querySelector('.eye-active');
  let eyeUnactive = document.querySelector('.eye-unactive');

  eyeActive.style.display = 'none';

  eyeActive.addEventListener('click', () => {
    eyeActive.style.display = 'none';
    eyeUnactive.style.display = 'block';
    passwordInput.type = 'text';
  });

  eyeUnactive.addEventListener('click', () => {
    eyeUnactive.style.display = 'none';
    eyeActive.style.display = 'block';
    passwordInput.type = 'password';
  });




</script>



@endsection
