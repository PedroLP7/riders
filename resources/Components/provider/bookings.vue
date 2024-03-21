<template>
  <div>

    <div v-if="bookings !== null && usuario !== null">
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
            <!-- if rider  -->
            <div v-if="usuario.user_type_id == 2">
              <div v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered' && booking.status.status_name !== 'Booked'">

              <button @click="sendPostRequest(booking.id_booking, false)" class="btn btn-success">{{
      buttonContent(booking.status.id_status)
                }}</button>
            </div>
            <div v-if="booking.status && booking.status.status_name && booking.status.status_name == 'On its way'">
              <button @click="sendPostRequest(booking.id_booking, true)" class="btn btn-danger">No encuentro al
                sin-techo</button>
            </div>
            </div>
            <!-- if provider -->
            <div v-else>
              <div v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered' && booking.status.status_name !== 'On its way'">

              <button @click="sendPostRequest(booking.id_booking, false)" class="btn btn-success">{{
      buttonContent(booking.status.id_status)
                }}</button>
            </div>

            </div>
          </div>

        </div>
      </div>
    </div>
        <div class="container" id="navbar">
        <navbar v-if="showComponente" />
        </div>
  </div>

</template>

<script>
import axios from 'axios';
import navbar from '../../Components/navbar.vue'

export default {
    name: 'bookings',
    components: {

         navbar
    },
  data() {
    return {
      bookings: null,
      usuario: null,
      type: null,
    showComponente: true,
    };
  },

  created() {

        this.fetchBookings();



  },
  methods: {
    fetchBookings() {
      const me = this;

      axios.get('/usuario/getUsuario')
        .then(response => {
          console.log(response)
          me.usuario = response.data

          axios.get('/booking/showBookingByUserId/' + me.usuario.id_user )
            .then(response => {
              console.log(response)
              me.bookings = response.data

            })
            .catch(error => {
              console.error('Error fetching user data', error);
            });

        })
        .catch(error => {
          console.error('Error fetching booking data', error);
        });


    },
    sendPostRequest(id, cancelButton) {
      const me = this;
      let postData;
      for (let index = 0; index < me.bookings.length; index++) {

        if (me.bookings[index].id_booking == id) {
          if (me.bookings[index].id_status_fk == 1) {
            me.bookings[index].id_status_fk = 2;
          } else if (me.bookings[index].id_status_fk == 2) {
            me.bookings[index].id_status_fk = 3;
          }

          if (cancelButton) {
            me.bookings[index].id_status_fk = 4;
          }
          postData = me.bookings[index];
        }

      }


      console.log(postData);

      
      axios.put('/booking/' + id, postData, id)
        .then(response => {
          console.log('PUT request successful', response);
          this.fetchBookings();
          
        })
        .catch(error => {
          console.error('Error making PUT request', error);
          // Handle the error

        });
      this.reloadComponent();
    },
    reloadComponent() {
      this.$forceUpdate();
      this.fetchBookings(); 
    },
    buttonContent(id) {
      
      if (id === 1) {
        return 'El rider ha llegado';
      } else if (id === 2) {
        return 'Entregar';
      } else if (id === 4) {
        return 'Default Button Content';
      }
    },
  },
};
</script>

<style></style>
