<template>
    <div>
      
      <div v-if="!formEnviado">
        <form-kitchen-parte1 @actualizar-datos="actualizarDatosUsuario" @enviar="formEnviado = true"></form-kitchen-parte1>
      </div>
    
     
      <form-kitchen-parte2 v-if="formEnviado && !formParte2Enviado" @actualizar-datos="actualizarDatosUsuario" @enviar="insertEmpresa"></form-kitchen-parte2>  
  
   
      
    </div>
  </template>
  
  <script>
  import axios from 'axios'; 
  import FormKitchenParte1 from '../Components/formKitchenParte1.vue';
  import FormKitchenParte2 from '../Components/formKitchenParte2.vue';

  
  export default {
    components: {
      'form-kitchen-parte1': FormKitchenParte1,
      'form-kitchen-parte2': FormKitchenParte2,      
    },
    data() {
      return {
        formEnviado: false,
        formParte2Enviado: false,
        empresa: { user_name: '', password: '', dni_cif: '', real_name: '', address: '' },
      };
    },
    methods: {
      actualizarDatosUsuario(datos) {
        this.proveedor = { ...this.empresa, ...datos };
      },
      insertEmpresa() {
      alert('Formulario enviado para Empresa!');
      axios.post('/empresa', this.empresa)
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