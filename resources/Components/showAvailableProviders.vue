<template>
    <div v-if="providers !== null">
       <div v-for="provider in providers">
        <div class="card" style="width: 18rem;">
        <img src="../images/resto.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ provider.real_name }}</h5>
            <p class="card-text">Direccion: {{ provider.provider.adress }}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
       </div>
</div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        providers: [],
      };
    },
  
    created() {
      this.fetchProviders();
    },
  
    methods: {
      fetchProviders() {
        const me = this;

        axios.get('/usuario/getUsuariosWithType/3')
          .then(response => {
            console.log(response);
            this.providers = response.data;
          })
          .catch(error => {
            console.error('Error fetching user type', error);
          });
      },
    },
  };
  </script>
  
  <style scoped>
    body{
      background-color: #1E1E1E;
      color: #1E1E1E;
    }

    .class
    {
      background-color: #1E1E1E;
    }
  </style>
  