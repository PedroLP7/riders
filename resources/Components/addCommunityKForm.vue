<template>
    <div>
      <form @submit.prevent="insertKitchen">
        <div class="form-group">
          <label for="userName">Nombre de usuario</label>
          <input
            type="text"
            class="form-control"
            id="user_name"
            v-model="usuario.user_name"
          />
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input
            type="password"
            class="form-control"
            id="password"
            v-model="usuario.password"
          />
        </div>
        <div class="form-group">
          <label for="dni">NIF</label>
          <input
            type="text"
            class="form-control"
            id="dni"
            v-model="usuario.dni_cif"
          />
        </div>
        <div class="form-group">
          <label for="realName">Real Name</label>
          <input
            type="text"
            class="form-control"
            id="realName"
            v-model="usuario.real_name"
          />
        </div>
        <div class="form-group">
          <label for="surname1">Apellido 1</label>
          <input
            type="text"
            class="form-control"
            id="surname1"
            v-model="usuario.surname1"
          />
        </div>
        <div class="form-group">
          <label for="surname2">Apellido 2</label>
          <input
            type="text"
            class="form-control"
            id="surname2"
            v-model="usuario.surname2"
          />
        </div>
        <div class="form-group">
          <label for="mail">Correo Electrónico</label>
          <input
            type="email"
            class="form-control"
            id="mail"
            v-model="usuario.mail"
          />
        </div>
        <div class="form-group">
          <label for="phoneNumber">Número de Teléfono</label>
          <input
            type="tel"
            class="form-control"
            id="phoneNumber"
            v-model="usuario.phone"
          />
        </div>
        <div class="form-group">
          <label for="mail">Dirección</label>
          <input
            type="text"
            class="form-control"
            id="adress"
            v-model="usuario.adress"
          />
        </div>
        <div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="1">
  <label class="form-check-label" for="flexRadioDefault1">
    Necesita comida ahora
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked value="0">
  <label class="form-check-label" for="flexRadioDefault2">
    No necesita comida por el momento
  </label>
</div>
        <button type="submit" class="btn btn-primary">Registrar</button>
        <button type="button" class="btn btn-secondary" @click="showRiderForm = false">Cancelar</button>
      </form>
    </div>


      <div class="container" id="navbar">
          <navbar v-if="showComponente" />
      </div>
  </template>
  
  <script>
  import axios from 'axios';
  import navbar from '../Components/navbar.vue';
  
  export default {
    name: "HomePage",

    components: {
      navbar
    },

    data() {
      return {
        usuario: {
          user_name: "",
          password: "",
          dni_cif: "",
          real_name: "",
          surname1: "",
          surname2: "",
          mail: "",
          phone: "",
          adress: "",
          needs_food: ""
        },
      };
    },
    methods: {
      insertKitchen() {
        // Implement your logic to insert rider here
        const me = this;

          axios.post('/communityk', me.usuario )
            .then(response => {
              console.log(response)
              me.bookings = response.data

            })
            .catch(error => {
              console.error('Error sending user data', error);
            });

        
      }
    }
  };
  </script>
  
  <style scoped>
  /* Your component-specific styles here */
  </style>
  