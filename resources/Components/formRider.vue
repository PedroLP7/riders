<template>
  <div>
    <!-- Primer formulario (si aún no se ha enviado) -->
    <div v-if="!formEnviado">
      <form-rider-parte1 @actualizar-datos="actualizarDatosUsuario" @enviar="formEnviado = true"></form-rider-parte1>
    </div>
  
    <!-- Segundo formulario (componente del segundo formulario) -->
    <form-rider-parte2 v-if="formEnviado && !formParte2Enviado" @actualizar-datos="actualizarDatosUsuario" @enviar="formParte2Enviado = true"></form-rider-parte2>  

    <!-- Tercer formulario -->
    <form-rider-parte3 v-if="formParte2Enviado" @actualizar-datos="actualizarDatosUsuario" @enviar="insertRider"></form-rider-parte3>
  </div>
</template>

<script>
import axios from 'axios'; // Asegúrate de tener axios disponible
import FormRiderParte1 from '../Components/formRiderParte1.vue';
import FormRiderParte2 from '../Components/formRiderParte2.vue';
import FormRiderParte3 from '../Components/formRiderParte3.vue';

export default {
  components: {
    'form-rider-parte1': FormRiderParte1,
    'form-rider-parte2': FormRiderParte2,
    'form-rider-parte3': FormRiderParte3,
  },
  data() {
    return {
      formEnviado: false,
      formParte2Enviado: false,
      usuario: {
        user_name: '', password: '', dni_cif: '', real_name: '', surname1: '', surname2: '', mail: '', phone: ''
      },
    };
  },
  methods: {
    actualizarDatosUsuario(datos) {
      this.usuario = { ...this.usuario, ...datos };
    },
    insertRider() {
      axios.post('rider', this.usuario)
      .then(response => {
          console.log(response);
          this.usuario = { user_name: '', password: '', dni_cif: '', real_name: '', surname1: '', surname2: '', mail: '', phone: '' };
          this.showRiderForm = false;
          
      })
      .catch(error => {
          console.log(error.response.data.error);          
      });
    },
  }
};
</script>