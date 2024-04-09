<template>
  <div>
    <button @click="goBack()" type="button" class="btn btn-success">Go Back</button>
    <bookings :screen= "3" />
  </div>
</template>

<script>
import bookings from './bookings.vue';

export default {
  components: {
    bookings
  },
  methods:{
    goBack(){
      window.location.href = './home'
    }
  },
  data() {
    return {
      
     
      
    };
  }
}
</script>

<style></style>