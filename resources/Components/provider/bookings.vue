<script setup>
defineEmits(['found-booking'])
</script>

<template>
  <div v-if="loading" class="loading-overlay"> 
        <div id="manzanita">
          <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni1.png');"></div>
          <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni2.png');"></div>
          <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni3.png');"></div>
          <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni4.png');"></div>
          <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni5.png');"></div>
          <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni6.png');"></div>
          <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni7.png');"></div>
          <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni8.png');"></div>
        </div>
  </div>
  <div v-if="bookings !== null && usuario !== null" class="bookings-modal-container">
    <h1 class="titulo-bookings" v-if="screen == 1">Packs a Entregar</h1>
    <h1 class="titulo-bookings" v-if="screen == 2 && bookings.length >= 1">No te olvides:</h1>
    <!-- <h1 class="titulo-bookings" v-if="screen == 2 && bookings.length < 1">No tienes packs reservados</h1> -->
    <!-- <div v-for="booking in bookings" :key="booking.id_booking"> -->
    <div v-if="screen !== 1 && screen !== 2 && screen !== 3" class="container">
      <h1 id="titulo">Pedidos en curso</h1>
      <div class="cards-container-bookings">
        <div class="card" id="booking-card" v-for="booking in bookings" :key="booking.id_booking">
          <div class="card-header" id="booking-card-header">
            <div v-if="booking.menu && booking.menu.item1 && booking.menu.item2 && booking.menu.item3">
              <div class="quantityBubble">
                {{ booking.menu_quantity }}
              </div>
            </div>

            <div v-if="booking.rider && booking.rider.user">
              <div id="titulo-card-booking">Rider: {{ booking.rider.user.user_name }} </div>
            </div>
            <h5 id="subtitulo-card-booking">Booking {{ booking.id_booking }}</h5>
          </div>

          <div class="card-body" id="booking-card-body">
            <div class="info-pack-tracking">
              <!-- <div v-if="booking.provider && booking.provider.user">
                <div> <b> Restaurante: </b> {{ booking.provider.user.real_name }} </div>
              </div> -->

              <div v-if="booking.menu && booking.menu.item1 && booking.menu.item2 && booking.menu.item3">
                <div style="text-align: left;"> <b>Contenido</b> <br> {{ booking.menu.item1 }}, {{ booking.menu.item2
                  }}, {{ booking.menu.item3 }}
                </div>
              </div>

              <div v-if="booking.status && booking.status.status_name">
                <div style="text-align: right;"> <b>Estado</b> <br> {{ booking.status.status_name }} </div>
              </div>

              <div v-else>No DATA</div>
            </div>

            <div class="alerta-estado-rider">
              <!-- if rider  -->
              <div v-if="usuario.user_type_id == 2">
                <div
                  v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered' && booking.status.status_name !== 'Booked'">

                  <button @click="sendPostRequest(booking.id_booking, false)" class="btn btn-success">
                    {{ buttonContent(booking.status.id_status) }}
                  </button>
                </div>
                <div v-if="booking.status && booking.status.status_name && booking.status.status_name == 'On its way'">
                  <button @click="sendPostRequest(booking.id_booking, true)" class="btn btn-danger">No encuentro al
                    sin-techo</button>
                </div>
              </div>
              <!-- if provider -->
              <div v-else>
                <div
                  v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered' && booking.status.status_name !== 'On its way'">

                  <button @click="sendPostRequest(booking.id_booking, false)" class="btn btn-success">
                    {{ buttonContent(booking.status.id_status) }}</button>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>

    </div>

    <div v-if="screen === 1">


      <div class="cards-container-bookings-deliver">
        <div class="card" id="booking-card-deliver" v-for="booking in bookings" :key="booking.id_booking">
          <div v-if="booking.status.id_status == 2">
            <div class="card-header" id="booking-card-header">
              <div v-if="booking.rider && booking.rider.user">
                <div id="titulo-card-booking">Rider: {{ booking.rider.user.user_name }} </div>
              </div>
              <h5 id="subtitulo-card-booking">Booking {{ booking.id_booking }}</h5>
            </div>

            <div class="card-body" id="booking-card-body-deliver">
              <div class="info-pack-tracking">
                <!-- <div v-if="booking.provider && booking.provider.user">
                <div> <b> Restaurante: </b> {{ booking.provider.user.real_name }} </div>
              </div> -->

                <div v-if="booking.menu && booking.menu.item1 && booking.menu.item2 && booking.menu.item3">
                  <div style="text-align: left;"> <b>Contenido</b> <br> {{ booking.menu.item1 }}, {{ booking.menu.item2
                    }}, {{ booking.menu.item3
                    }}
                  </div>
                </div>

                <div v-if="booking.status && booking.status.status_name">
                  <div style="text-align: right;"> <b>Estado</b> <br> {{ booking.status.status_name }} </div>
                </div>

                <div v-else>No DATA</div>
              </div>

              <div class="alerta-estado-rider">
                <!-- if rider  -->
                <div v-if="usuario.user_type_id == 2">
                  <div
                    v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered' && booking.status.status_name !== 'Booked'">

                    <button @click="sendPostRequest(booking.id_booking, false)" class="btn btn-success">
                      {{ buttonContent(booking.status.id_status) }}
                    </button>
                  </div>
                  <!-- <div
                    v-if="booking.status && booking.status.status_name && booking.status.status_name == 'On its way'">
                    <button @click="sendPostRequest(booking.id_booking, true)" class="btn btn-danger">No encuentro al
                      sin-techo</button>
                  </div> -->
                </div>
                <!-- if provider -->
                <div v-else>
                  <div
                    v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered' && booking.status.status_name !== 'On its way'">

                    <button @click="sendPostRequest(booking.id_booking, false)" class="btn btn-success">
                      {{ buttonContent(booking.status.id_status) }}</button>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>


    </div>
  </div>
  <div v-if="screen === 2 && bookings">

    <div v-if="filteredBookings.length > 1">
      <div class="cards-container-bookings">
      <div class="card" id="booking-card" v-for="(booking, index) in filteredBookings.slice(0 , 1)" :key="index">
       
        <div v-if="booking.status.id_status == 1">

          <div class="card-header" id="booking-card-header">
            <div v-if="booking.menu && booking.menu.item1 && booking.menu.item2 && booking.menu.item3">
              <div class="quantityBubble">
                {{ booking.menu_quantity }}
              </div>
            </div>

            <div v-if="booking.rider && booking.rider.user">
              <div id="titulo-card-booking">Rider: {{ booking.rider.user.user_name }} </div>
            </div>
            <h5 id="subtitulo-card-booking">Booking {{ booking.id_booking }}</h5>
          </div>

          <div class="card-body" id="booking-card-body">
            <div class="info-pack-tracking">
              <!-- <div v-if="booking.provider && booking.provider.user">
               <div> <b> Restaurante: </b> {{ booking.provider.user.real_name }} </div>
             </div> -->

              <div v-if="booking.menu && booking.menu.item1 && booking.menu.item2 && booking.menu.item3">
                <div style="text-align: left;"> <b>Contenido</b> <br> {{ booking.menu.item1 }}, {{ booking.menu.item2
                  }}, {{ booking.menu.item3 }}
                </div>
              </div>
              <div v-if="booking.status && booking.status.status_name">
                <div style="text-align: right;"> <b>Estado</b> <br> {{ booking.status.status_name }} </div>
              </div>

              <div v-else>No DATA</div>
            </div>


            <div class="alerta-estado-rider">
              <!-- if rider  -->
              <div v-if="usuario.user_type_id == 2">
                <div
                  v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered' && booking.status.status_name !== 'Booked'">

                  <button @click="sendPostRequest(booking.id_booking, false)" class="btn btn-success">
                    {{ buttonContent(booking.status.id_status) }}
                  </button>
                </div>
                <div v-if="booking.status && booking.status.status_name && booking.status.status_name == 'On its way'">
                  <button @click="sendPostRequest(booking.id_booking, true)" class="btn btn-danger">No encuentro al
                    sin-techo</button>
                </div>
              </div>
              <!-- if provider -->
              <div v-else>
                <div
                  v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered' && booking.status.status_name !== 'On its way'">

                  <button @click="sendPostRequest(booking.id_booking, false)" class="btn btn-success">
                    {{ buttonContent(booking.status.id_status) }}</button>
                </div>
              </div>

            </div>

          </div>

        </div>
      </div>

      <button v-if="bookings.length > 0" @click="viewAllBookings" id="view-more-bookings">Ver los demás
        bookings</button>
      <button v-if="bookings.length < 1" @click="viewProviders" id="make-bookings">No tienes packs reservados, reserva
        un pack!</button>
    </div>
    </div>
    <div v-else>
      <div class="cards-container-bookings">
      <div class="card" id="booking-card-booked" v-for="booking in bookings">
       
        <div v-if="booking.status.id_status == 1">

          <div class="card-header" id="booking-card-header">
            <div v-if="booking.menu && booking.menu.item1 && booking.menu.item2 && booking.menu.item3">
              <div class="quantityBubble">
                {{ booking.menu_quantity }}
              </div>
            </div>

            <div v-if="booking.rider && booking.rider.user">
              <div id="titulo-card-booking">Rider: {{ booking.rider.user.user_name }} </div>
            </div>
            <h5 id="subtitulo-card-booking">Booking {{ booking.id_booking }}</h5>
          </div>

          <div class="card-body" id="booking-card-body">
            <div class="info-pack-tracking">
              <!-- <div v-if="booking.provider && booking.provider.user">
               <div> <b> Restaurante: </b> {{ booking.provider.user.real_name }} </div>
             </div> -->

              <div v-if="booking.menu && booking.menu.item1 && booking.menu.item2 && booking.menu.item3">
                <div style="text-align: left;"> <b>Contenido</b> <br> {{ booking.menu.item1 }}, {{ booking.menu.item2
                  }}, {{ booking.menu.item3 }}
                </div>
              </div>
              <div v-if="booking.status && booking.status.status_name">
                <div style="text-align: right;"> <b>Estado</b> <br> {{ booking.status.status_name }} </div>
              </div>

              <div v-else>No DATA</div>
            </div>


            <div class="alerta-estado-rider">
              <!-- if rider  -->
              <div v-if="usuario.user_type_id == 2">
                <div
                  v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered' && booking.status.status_name !== 'Booked'">

                  <button @click="sendPostRequest(booking.id_booking, false)" class="btn btn-success">
                    {{ buttonContent(booking.status.id_status) }}
                  </button>
                </div>
                <div v-if="booking.status && booking.status.status_name && booking.status.status_name == 'On its way'">
                  <button @click="sendPostRequest(booking.id_booking, true)" class="btn btn-danger">No encuentro al
                    sin-techo</button>
                </div>
              </div>
              <!-- if provider -->
              <div v-else>
                <div
                  v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered' && booking.status.status_name !== 'On its way'">

                  <button @click="sendPostRequest(booking.id_booking, false)" class="btn btn-success">
                    {{ buttonContent(booking.status.id_status) }}</button>
                </div>
              </div>

            </div>

          </div>

        </div>
      </div>

      <button v-if="bookings.length > 0" @click="viewAllBookings" id="view-more-bookings">Ver los demás
        bookings</button>
      <button v-if="bookings.length < 1" @click="viewProviders" id="make-bookings">No tienes packs reservados, reserva
        un pack!</button>
    </div>
    </div>
   


  </div>
  <div v-if="screen === 3 && bookings">


    <div class="cards-container-bookings">
      <div class="card" id="booking-card" v-for="booking in bookings" :key="booking.id_booking">
        <div v-if="booking.status.id_status == 1">

          <div class="card-header" id="booking-card-header">
            <div v-if="booking.rider && booking.rider.user">
              <div id="titulo-card-booking">Rider: {{ booking.rider.user.user_name }} </div>
            </div>
            <h5 id="subtitulo-card-booking">Booking {{ booking.id_booking }}</h5>
          </div>

          <div class="card-body" id="booking-card-body">
            <div class="info-pack-tracking">
              <!-- <div v-if="booking.provider && booking.provider.user">
           <div> <b> Restaurante: </b> {{ booking.provider.user.real_name }} </div>
         </div> -->

              <div v-if="booking.menu && booking.menu.item1 && booking.menu.item2 && booking.menu.item3">
                <div style="text-align: left;"> <b>Contenido</b> <br> {{ booking.menu.item1 }}, {{ booking.menu.item2
                  }}, {{ booking.menu.item3 }}
                </div>
              </div>

              <div v-if="booking.status && booking.status.status_name">
                <div style="text-align: right;"> <b>Estado</b> <br> {{ booking.status.status_name }} </div>
              </div>

              <div v-else>No DATA</div>
            </div>


            <div class="alerta-estado-rider">
              <!-- if rider  -->
              <div v-if="usuario.user_type_id == 2">
                <div
                  v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered' && booking.status.status_name !== 'Booked'">

                  <button @click="sendPostRequest(booking.id_booking, false)" class="btn btn-success">
                    {{ buttonContent(booking.status.id_status) }}
                  </button>
                </div>
                <div v-if="booking.status && booking.status.status_name && booking.status.status_name == 'On its way'">
                  <button @click="sendPostRequest(booking.id_booking, true)" class="btn btn-danger">No encuentro al
                    sin-techo</button>
                </div>
              </div>
              <!-- if provider -->
              <div v-else>
                <div
                  v-if="booking.status && booking.status.status_name && booking.status.status_name !== 'Not delivered' && booking.status.status_name !== 'On its way'">

                  <button @click="sendPostRequest(booking.id_booking, false)" class="btn btn-success">
                    {{ buttonContent(booking.status.id_status) }}</button>
                </div>
              </div>

            </div>

          </div>

        </div>
      </div>


      --
    </div>


  </div>

  <!-- </div> -->

  <div class="container-navbar-inferior">
    <div class="container" id="navbar" v-if="!screen">
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
  props: {
    screen: Number,
    customer: Number,
  },
  data() {
    return {
      bookings: null,
      usuario: null,
      type: null,
      showComponente: true,
      delivery: {
        id_booking_fk: "",
        delivery_date: "",
        delivery_hour: "",
        id_customer_fk: "",
        id_communityK_fk: "",
      },
      loading : true,
    };
  },
  computed: {
    filteredBookings() {
      // Filter bookings where status_id == 1
      return this.bookings.filter(booking => booking.status.id_status === 1);
    }
  },

  created() {

    this.fetchBookings();

    console.log("screen:" + this.screen)

  },
  methods: {
    createDelivery(idBooking, id_customer) {
      const me = this;
      me.delivery.id_booking_fk = idBooking;
      me.delivery.delivery_date = me.getCurrentDate();
      me.delivery.delivery_hour = me.getCurrentTime();
      me.delivery.id_customer_fk = id_customer;
      me.delivery.id_communityK_fk = null;

      axios.post('/delivery', me.delivery)
        .then(response => {
          console.log('Delivery created successfully:', response.data);
          // Do something with the response if needed
          this.$emit('successfull-delivery', 's');
        })
        .catch(error => {
          console.error('Error creating booking:', error)
          this.$emit('successfull-delivery', 'e');
        });
    },
    viewAllBookings() {
      window.location.href = './viewAllBookings'
    },

    viewProviders() {
      window.location.href = '/riders/public/rider/viewProviders'
    },

    fetchBookings() {
      const me = this;

      axios.get('/usuario/getUsuario')
        .then(response => {
          console.log(response)
          me.usuario = response.data         
          axios.get('/booking/showBookingByUserId/' + me.usuario.id_user)
            .then(response => {
              console.log(response)
              me.bookings = response.data
              me.loading = false;
              me.bookings.forEach(element => {
                if (element.status.id_status == 1) {

                  this.$emit('found-booking', true);
                }
              });

            })
            .catch(error => {
              console.error('Error fetching user data', error);
            });

        })
        .catch(error => {
          console.error('Error fetching booking data', error);
        });


    },
    getCurrentDate() {
      const currentDate = new Date();

      // Extract year, month, and day
      const year = currentDate.getFullYear();
      const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Months are zero-based
      const day = String(currentDate.getDate()).padStart(2, '0');

      // Format the date as YYYY-MM-DD
      const formattedDate = `${year}-${month}-${day}`;
      return formattedDate;
    },
    getCurrentTime() {
      const currentDate = new Date();

      // Extract hours, minutes, and seconds
      const hours = String(currentDate.getHours()).padStart(2, '0');
      const minutes = String(currentDate.getMinutes()).padStart(2, '0');
      const seconds = String(currentDate.getSeconds()).padStart(2, '0');

      // Format the time as HH:mm:ss
      const formattedTime = `${hours}:${minutes}:${seconds}`;
      return formattedTime;
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

          if (postData.id_status_fk === 3) {
            me.createDelivery(id, me.customer);
          }

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

<style>
.cards-container-bookings {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  margin-top: 5%;
}

.container-navbar-inferior {
  height: 100px;
}

.bookings-modal-container {
  height: 0;
  margin-bottom: 5%;
  margin-top: 1%;
}

.titulo-bookings {
  width: 100%;
  color: #8F8F8F;
  font-size: 24px;
  font-weight: 500;
  margin-bottom: 0;
}

#titulo {
  color: #8F8F8F;
  font-weight: bold;
  margin-top: 20%;
  margin-left: 2%;
}

#container-bookings {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: absolute;
  top: 20%;
  width: 100%;
}

#booking-card {
  background-color: #393939;
  border: none;
  width: 95%;
  margin-top: 10px;
  --bs-card-bg: none;
  border-radius: 26px;
}

#booking-card-body-deliver {
  display: flex;
  flex-direction: column;
  background-color: transparent;
  border-top-style: dashed;
  border-width: 2px;
  border-color: #8F8F8F;
  padding: 20px;
  padding-bottom: 10px;
}

#booking-card-deliver {
  background-color: #393939;
  border: none;
  --bs-card-bg: none;
  border-radius: 26px;
  width: 95%;
  margin-bottom: 2%;
}

#booking-card-header {
  background-color: transparent;
  display: flex;
  flex-direction: column;
  align-items: center;
}

#booking-card-body {
  display: flex;
  flex-direction: column;
  background-color: transparent;
  border-top-style: dashed;
  border-width: 2px;
  border-color: #8F8F8F;
  padding: 20px;
}

.info-pack-tracking {
  display: flex;
  justify-content: space-between;
  color: #8F8F8F;
}

.info-pack-tracking b {
  font-size: 22px;
}

.alerta-estado-rider {
  display: flex;
  justify-content: center;
  margin-top: 10px;
}

#titulo-card-booking {
  color: #ffffff;
  font-weight: bold;
  font-size: 28px;
}

#subtitulo-card-booking {
  color: #8F8F8F;
  font-size: 15px;
  margin-top: 2px;
}

#view-more-bookings {
  margin-top: 4%;
  text-decoration: underline;
}

#make-bookings {
  margin-top: 2%;
  text-decoration: underline;
}

.quantityBubble {
  position: absolute;
  background-color: #8BB481;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 34px;
  height: 34px;
  border-radius: 100%;
  right: -10px;
  top: -10px;
  font-weight: bold;
  font-size: 20px;
}

.btn-success {
  background-color: #8BB481;
  border-color: transparent;
  border-radius: 50px;
  color: #1E1E1E;
  font-weight: 600;
}

.btn-success {
  background-color: #8BB481;
  border-radius: 50px;
  color: #1E1E1E;
  font-weight: 600;
  font-size: 20px;
}

#booking-card-booked {
  background-color: #393939;
  border: none;
  width: 95%;
  margin-top: 2px;
  --bs-card-bg: none;
  border-radius: 26px;
}

.cards-container-bookings-deliver {
  height: 175px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  margin-top: 5%;
  overflow-x: hidden;
  overflow-y: scroll;
  scroll-behavior: smooth;
}
</style>
