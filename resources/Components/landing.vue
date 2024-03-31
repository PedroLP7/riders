<template>
    <div class="app-container" id="landing">
      <div class="row">
        <header class="col-12" v-if="!showRiderForm">
          <nav class="navbar justify-content-between">
            <a id="quienes" class="hyperlink" href="#quienes-somos">Quiénes somos?</a>
            <a id="sesion" class="hyperlink" @click="login" href="#iniciar-sesion">Iniciar Sesión</a>
          </nav>
        </header>
      </div>
      <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <main class="col-12 text-center" v-if="!showRiderForm">
          <h1 id="titulo-foodLink">Food</h1>
          <h2 id="subtitulo">Una red de solidaridad</h2>
          <div class="button-container d-inline-block">
            <button id="register" @click="registrateRider">Regístrate Rider!</button>
            <button id="sombraBoton" @click="registrateRider">Regístrate Rider!</button>
          </div>
          <div class="collaboration">
            <div id="empresa">
              <p>¿Eres una empresa y quieres colaborar?</p>
              <a class="hyperlink" @click="registroEmpresa">Regístrate ahora!</a>
            </div>
            <div id="comedor">
              <p>¿Eres un comedor social?</p>
              <a class="hyperlink" @click="registroComedor">Regístrate ahora!</a>
            </div>
          </div>
        </main>
        <div v-if="showRiderForm" class="col-md-6 offset-md-3">
          <h3>Registro para Rider</h3>
          <form>
            <div class="form-group">
              <label for="userName">User Name</label>
              <input type="text" class="form-control" id="userName" v-model="usuario.user_name">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" v-model="usuario.password">
            </div>
            <div class="form-group">
              <label for="dni">DNI</label>
              <input type="text" class="form-control" id="dni" v-model="usuario.dni_cif">
            </div>
            <div class="form-group">
              <label for="realName">Real Name</label>
              <input type="text" class="form-control" id="realName" v-model="usuario.real_name">
            </div>
            <div class="form-group">
              <label for="surname1">Apellido 1</label>
              <input type="text" class="form-control" id="surname1" v-model="usuario.surname1">
            </div>
            <div class="form-group">
              <label for="surname2">Apellido 2</label>
              <input type="text" class="form-control" id="surname2" v-model="usuario.surname2">
            </div>
            <div class="form-group">
              <label for="mail">Correo Electrónico</label>
              <input type="email" class="form-control" id="mail" v-model="usuario.mail">
            </div>
            <div class="form-group">
              <label for="phoneNumber">Número de Teléfono</label>
              <input type="tel" class="form-control" id="phoneNumber" v-model="usuario.phone">
            </div>
            <button @click="insertRider()" class="btn btn-primary">Registrar</button>
            <button type="button" class="btn btn-secondary" @click="showRiderForm = false">Cancelar</button>

          </form>
        </div>
      </div>
    </div>
</template>

<script>
import axios from 'axios';
export default{
  data() {

    return {
      showRiderForm: false,
      usuario :{}
    }
  },
  methods: {
    registrateRider() {
      this.showRiderForm = true;
    },
    registroEmpresa() {
      alert('Registro para Empresas!');
    },
    registroComedor() {
      alert('Registro para Comedores Sociales!');
    },
    login() {
      window.location.href ="/riders/public/usuario/create";
    },
    insertRider() {
        const me = this;
      alert('Formulario enviado!');
      axios
      .post('rider', me.usuario)
        .then(response => {
            console.log(response);
        })
        .catch(error => {
            me.isError = true;
                me.messageError = error.response.data.error;
                console.log(error.response.data.error);
        });


    //   this.showRiderForm = false;
    },
  }
}


</script>
