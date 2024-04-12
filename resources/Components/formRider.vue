<template>
  <div>
    
    <div v-if="!formEnviado">
      <form-rider-parte1 @actualizar-datos="actualizarDatosUsuario" @enviar="formEnviado = true"></form-rider-parte1>
    </div>
  
   
    <form-rider-parte2 v-if="formEnviado && !formParte2Enviado" @actualizar-datos="actualizarDatosUsuario" @enviar="formParte2Enviado = true"></form-rider-parte2>  

 
    <form-rider-parte3 v-if="formParte2Enviado" @actualizar-datos="actualizarDatosUsuario" @enviar="insertRider"></form-rider-parte3>
  </div>
</template>

<script>
import axios from 'axios'; 
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
        const me = this;     
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


    
    },
  }
};
</script>