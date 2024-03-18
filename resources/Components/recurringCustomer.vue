<template>
    <div>
      <!-- Your template content goes here -->
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
  