<template>
<div>
        <div v-for="booking in bookings" :key="booking.id_booking" class="card" style="width: 18rem;">
            
            <div class="card-body">
                <h5 class="card-title" v-for="rider in booking">
                  <ul v-for="user in rider">rider: {{ user.real_name }}  </ul>
                </h5>
                <h5 class="card-title" v-for="provider in booking">
                  <ul v-for="user in provider">provider: {{ user.real_name }}  </ul>
                </h5>
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
     rider: [],
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