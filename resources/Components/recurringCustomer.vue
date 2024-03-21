<template>
    <div>
    <div>
      <div v-if="data != null">
        <div v-for="user in data.deliveries">
          <div class="card" style="width: 18rem;">
          <img src="../images/iconUser.jpg" class="card-img-top" alt="...">
          <div class="card-body">
          <h5 class="card-title">User {{ user.id_customer_fk }}</h5>
          <div v-if="user.customer">
          <p class="card-text">Adress: {{ user.customer.location }}</p>
        </div>
        <div v-if="user.count">
          <p class="card-text">Times eaten: {{ user.count }}</p>
        </div>
      </div>
    </div>

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
      data: null 
      };
    },
  
    created() {
      this.fetchRecurringCustomer();
    },
  
    methods: {
      fetchRecurringCustomer() {
        axios.get('/deliveriesByCustomer')
          .then(response => {
            console.log(response);
            this.data = response.data;
  
          })
          .catch(error => {
            console.error('Error fetching user data', error);
          });
      },
    }
  };
  </script>
  
  <style>
  /* Your CSS styles go here */
  </style>
  