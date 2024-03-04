<template>
  <div>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  
    <div class="carousel-item">
      
    </div>
</div>
  </div>
</template>

<script>
export default {
  data() {
    return {
        bookings: [],
    };
  },
  methods: {
    created(){
        const me = this;
        axios.get('/booking')
        .then(response => {
            console.log(response)
            me.bookings = response.data
        })
        .catch(error =>{
            console.error('Error fetching booking data', error);
        });
    }
    updateBooking() {
      // Call your API to update the booking using this.formData
      // Example: this.$axios.put('/api/bookings/' + bookingId, this.formData)
      // Remember to handle success and error responses accordingly
    },
  },
};
</script>

<style scoped>
/* Add your component-specific styles here if needed */
</style>