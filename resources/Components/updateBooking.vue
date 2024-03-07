<template>
  <div>
    <div v-if="bookings !== null">
      <div v-for="booking in bookings" :key="booking.id_booking">
        <div class="card" style="width: 18rem;">
          <div class="card-header">
            <h5 class="card-title">Booking {{ booking.id_booking }}</h5>
          </div>
          <div class="card-body">
            <div v-if="booking.rider && booking.rider.user">
              <div><b> Rider: </b> {{ booking.rider.user.real_name }} </div>
            </div>
            <div v-if="booking.provider && booking.provider.user">
              <div> <b> Restaurante: </b> {{ booking.provider.user.real_name }} </div>
            </div>
            <div v-if="booking.menu && booking.menu.item1 && booking.menu.item2 && booking.menu.item3">
              <div> <b>Menu: </b> {{ booking.menu.item1 }}, {{ booking.menu.item2 }}, {{ booking.menu.item3 }} </div>
            </div>
            <div v-if="booking.status && booking.status.status_name">
              <div> <b> Estado: </b> {{ booking.status.status_name }} </div>
            </div>
            <div v-else>No DATA</div>
             <div v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered'">
              <button @click="sendPostRequest(booking.id_booking)" class="btn btn-success"> {{ buttonContent(booking.status.status_name)
                }}</button>
            </div>
            <div v-if="booking.status && booking.status.status_name && booking.status.status_name == 'On its way'">
              <button @click="sendPostRequest(booking.id_booking)" class="btn btn-danger">No encuentro al sin-techo</button>
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
      bookings: null,
    };
  },

  created() {

    this.fetchBookings();

  },
  methods: {
    fetchBookings() {
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
    sendPostRequest(id) {
      const me = this;
      let postData;
      for (let index = 0; index < me.bookings.length; index++) {

        if (me.bookings[index].id_booking == id) {
         if (me.bookings[index].id_status_fk == 1) {
            me.bookings[index].id_status_fk = 2;
          } else if (me.bookings[index].id_status_fk == 2) {
            me.bookings[index].id_status_fk = 3;
          }
          postData = me.bookings[index];
        }

      }


      console.log(postData);

      // Make a PUT request to API booking
      axios.put('/booking/' + id, postData, id)
        .then(response => {
          console.log('PUT request successful', response);
          // Handle the response as needed
        })
        .catch(error => {
          console.error('Error making PUT request', error);
          // Handle the error
        });
      this.reloadComponent();
    },
    reloadComponent() {
      this.$forceUpdate();
      this.fetchBookings(); // Optionally, you can fetch fresh data after reloading
    },
    buttonContent(statusName) {
      // Define your conditions and return the appropriate content
      if (statusName === 'Booked') {
        return 'El rider ha llegado';
      } else if (statusName === 'On its way') {
        return 'Entregar';
      } else if (statusName === 'Not delivered') {
        return 'Default Button Content';
      }
    },
  },
};
</script>

<style></style>