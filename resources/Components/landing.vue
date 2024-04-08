<template>
  <div class="app-container" id="landing">
    <div class="row">
      <header class="col-12">
        <nav class="navbar justify-content-between">
          <a id="quienes" class="hyperlink" href="#quienes-somos">Quiénes somos?</a>
          <a id="sesion" class="hyperlink" @click="login" href="#iniciar-sesion">Iniciar Sesión</a>
        </nav>
      </header>
    </div>
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
      <main class="col-12 text-center" v-if="!showRiderForm && !showEmpresaForm && !showProviderForm">
        <h1 id="titulo-food">Food</h1>
        <h1 id="link">Link</h1>
        <h1 id="barra"></h1>
        <h2 id="subtitulo">Una red de solidaridad</h2>
        <div class="button-container d-inline-block">
          <button id="register" @click="registrateRider">Regístrate Rider</button>
          <button id="sombraBoton" @click="registrateRider">Regístrate Rider</button>
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
      <div v-if="showProviderForm" class="col-md-6 offset-md-3">
        <h3>Registro para Comedor Social</h3>
        <form>
          <div class="form-group">
            <label for="providerUserName">User Name</label>
            <input type="text" class="form-control" id="providerUserName" v-model="proveedor.user_name">
          </div>
          <div class="form-group">
            <label for="providerPassword">Password</label>
            <input type="password" class="form-control" id="providerPassword" v-model="proveedor.password">
          </div>
          <div class="form-group">
            <label for="providerDni">DNI</label>
            <input type="text" class="form-control" id="providerDni" v-model="proveedor.dni_cif">
          </div>
          <div class="form-group">
            <label for="providerRealName">Real Name</label>
            <input type="text" class="form-control" id="providerRealName" v-model="proveedor.real_name">
          </div>
          <div class="form-group">
            <label for="providerAddress">Dirección</label>
            <input type="text" class="form-control" id="providerAddress" v-model="proveedor.address">
          </div>
          <button @click="insertProvider()" class="btn btn-primary">Registrar</button>
          <button type="button" class="btn btn-secondary" @click="showProviderForm = false">Cancelar</button>
        </form>
      </div>
      <div v-if="showEmpresaForm" class="col-md-6 offset-md-3">
        <h3>Registro para Empresa</h3>
        <form>
          <div class="form-group">
            <label for="empresaUserName">User Name</label>
            <input type="text" class="form-control" id="empresaUserName" v-model="empresa.user_name">
          </div>
          <div class="form-group">
            <label for="empresaPassword">Password</label>
            <input type="password" class="form-control" id="empresaPassword" v-model="empresa.password">
          </div>
          <div class="form-group">
            <label for="empresaDni">DNI</label>
            <input type="text" class="form-control" id="empresaDni" v-model="empresa.dni_cif">
          </div>
          <div class="form-group">
            <label for="empresaRealName">Real Name</label>
            <input type="text" class="form-control" id="empresaRealName" v-model="empresa.real_name">
          </div>
          <div class="form-group">
            <label for="empresaDireccion">Dirección</label>
            <input type="text" class="form-control" id="empresaDireccion" v-model="empresa.address">
          </div>
          <button @click="insertEmpresa()" class="btn btn-primary">Registrar</button>
          <button type="button" class="btn btn-secondary" @click="showEmpresaForm = false">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      showRiderForm: false,
      showEmpresaForm: false,
      showProviderForm: false,
      usuario: { user_name: '', password: '', dni_cif: '', real_name: '', surname1: '', surname2: '', mail: '', phone: '' },
      proveedor: { user_name: '', password: '', dni_cif: '', real_name: '', address: '' },
      empresa: { user_name: '', password: '', dni_cif: '', real_name: '', address: '' },
    }
  },
  methods: {
    registrateRider() {
      this.showRiderForm = true;
      this.showEmpresaForm = false;
      this.showProviderForm = false;
    },
    registroEmpresa() {
      this.showEmpresaForm = true;
      this.showRiderForm = false;
      this.showProviderForm = false;
    },
    registroComedor() {
      this.showProviderForm = true;
      this.showRiderForm = false;
      this.showEmpresaForm = false;
    },
    login() {
      window.location.href = "/riders/public/usuario/create";
    },
    insertRider() {
      alert('Formulario enviado para Rider!');
      axios.post('/api/rider', this.usuario)
        .then(response => {
          console.log(response);
          this.usuario = { user_name: '', password: '', dni_cif: '', real_name: '', surname1: '', surname2: '', mail: '', phone: '' };
          this.showRiderForm = false;
        })
        .catch(error => {
          console.log(error.response.data.error);
        });
    },
    insertProvider() {
      alert('Formulario enviado para Comedor Social!');
      axios.post('/api/provider', this.proveedor)
        .then(response => {
          console.log(response);
          this.proveedor = { user_name: '', password: '', dni_cif: '', real_name: '', address: '' };
          this.showProviderForm = false;
        })
        .catch(error => {
          console.log(error.response.data.error);
        });
    },
    insertEmpresa() {
      alert('Formulario enviado para Empresa!');
      axios.post('/api/empresa', this.empresa)
        .then(response => {
          console.log(response);
          this.empresa = { user_name: '', password: '', dni_cif: '', real_name: '', address: '' };
          this.showEmpresaForm = false;
        })
        .catch(error => {
          console.log(error.response.data.error);
        });
    },
  }
}
</script>
  
   

