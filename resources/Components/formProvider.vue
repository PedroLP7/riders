<template>
    <div>
      
      <div v-if="!formEnviado">
        <form-provider-parte1 @actualizar-datos="actualizarDatosUsuario" @enviar="formEnviado = true"></form-provider-parte1>
      </div>
    
     
      <form-provider-parte2 v-if="formEnviado && !formParte2Enviado" @actualizar-datos="actualizarDatosUsuario" @enviar="insertProvider"></form-provider-parte2>  
  
   
      
    </div>
  </template>
  
  <script>
  import axios from 'axios'; 
  import FormProviderParte1 from '../Components/formProviderParte1.vue';
  import FormProviderParte2 from '../Components/formProviderParte2.vue';

  
  export default {
    components: {
      'form-provider-parte1': FormProviderParte1,
      'form-provider-parte2': FormProviderParte2,      
    },
    data() {
      return {
        formEnviado: false,
        formParte2Enviado: false,
        proveedor: { user_name: '', password: '', dni_cif: '', real_name: '', address: '' },
      };
    },
    methods: {
      actualizarDatosUsuario(datos) {
        this.proveedor = { ...this.proveedor, ...datos };
      },
      insertProvider() {     
      axios.post('/provider', this.proveedor)
        .then(response => {
          console.log(response);
          this.proveedor = { user_name: '', password: '', dni_cif: '', real_name: '', address: '' };          
        })
        .catch(error => {
          console.log(error.response.data.error);
        });
    },
    }
  };
  </script>