<template>
  <div v-if="providers !== null">
    <div v-for="prov in providers">
      <div class="card" style="width: 18rem;">
        <img src="../images/resto.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ prov.real_name }}</h5>
          <p class="card-text">Direccion: {{ prov.provider.adress }}</p>
          <button @click="viewMenu(prov.id_user)" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>
         
        </div>
      </div>
      
    </div>
  </div>

  

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <provider />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios';
import provider from './provider/provider.vue'
export default {
  components: {
        provider
    },
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
    
    viewMenu(providerId) {
     const id = providerId;
    },
  },

};
</script>

<style scoped>
/* Your scoped CSS styles go here */
</style>