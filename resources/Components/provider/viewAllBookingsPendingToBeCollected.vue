<template>
  <div>
    <button @click="goBack()" type="button" id="go-back-button"></button>
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

<style>
#go-back-button {
  position: absolute;
  left: 5%;
  top: 3%;
  width: 40px;
  height: 40px;
  background-image: url(http://[::1]:5173/resources/images/mingcute_arrow-up-line.png);
  background-color: transparent;
  border: none;
}


</style>