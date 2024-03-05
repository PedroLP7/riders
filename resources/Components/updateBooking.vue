<template>
<div>
        <div v-for="booking in bookings" :key="booking.id_booking" class="card" style="width: 18rem;">
            
            <div class="card-body">
                <h5 class="card-title">{{ booking.rider.user.user_name }}</h5>
                <p class="card-text">{{ booking.id_provider_fk }}</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      bookings: [],
    };
  },

  created() {
    const me = this;
    axios.get('/booking')
      .then(response => {
        console.log(response)
        me.bookings = response.data
      })
      .catch(error => {
        console.error('Error fetching booking data', error);
      });


  },
};
</script>

<style></style>