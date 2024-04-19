<script setup>
import stepProgressBar from './stepProgressBar.vue';
import { ref } from 'vue';
const stepProgress = ref();
const dataSteps = {
  steps: ['Step 1', 'Step 2', 'Step 3'],
  currentStep: 1,
  activeColor: '#65a30d',
  passiveColor: '#84cc16',
};
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


  <h1 id="titulo" v-if="!showMenu">Proveedores disponibles {{ selectedProvider }}</h1>

  <!-- <div class="row">
    <div class="col-12">
      <stepProgressBar :data="dataSteps" ref="stepProgress" />
      <div v-if="this.showPreviousButton" @click="returnToInitialState()">
        <button @click="stepProgress.previousStep">Previous Step</button>

      </div>
      <button @click="stepProgress.nextStep">Next Step</button>

    </div>
  </div> -->

  <div class="row" style=" margin-top: 10%;">
    <div class="col-12">
      <div>
        <div class="card" id="card-providers">
          <div class="card-body" id="card-body-providers">
            <div v-if="providers !== null">
              <div v-for="prov in providers">
                <div v-if="!idSelectedProvider || idSelectedProvider === prov.id_user">
                  <div @click="stepProgress.nextStep">
                    <div v-if="!idSelectedProvider" class="card" @click="viewMenu(prov.id_user)" :key="prov.id_user"
                      id="restaurant-card" style=" border-radius: 22px;">
                      <img v-if="!idSelectedProvider" src="../images/resto.jpeg" class="card-img-top" alt="..."
                        id="restaurant-card-img" style=" border-top-left-radius: 22px; border-top-right-radius: 22px;">
                      <div v-if="!idSelectedProvider" class="card-body">
                        <h5 v-if="!idSelectedProvider" class="card-title" id="card-title-restaurant">{{ prov.real_name
                          }}</h5>
                        <p class="card-text" id="card-text-restaurant" v-if="!idSelectedProvider">{{
                          prov.provider.adress }}</p>

                      </div>
                    </div>
                  </div>

                  <div v-if="showMenu">
                    <div v-if="this.showPreviousButton" @click="returnToInitialState()">
                      <button type="button" @click="stepProgress.previousStep" id="previous-step-button"></button>
                    </div>

                    <div class="card" id="card-provider-big">
                      <div class="card-body" id="card-body-provider-big">
                        <h1 id="card-body-provider-big-title">Seleccione el pack a recoger</h1>

                        <provider :id="this.idSelectedProvider" :find="false" @selectedM="handleSelectedMenu" />
                        <div>
                          <h1 id="card-body-provider-big-title2">Cantidad que desea recoger:</h1>
                        </div>

                        <div class="quantity-selection-container">
                          <quantity @quantity-updated="handleQuantityUpdated" />
                        </div>

                        <form action="">

                          <div class="book-pack-container" @click="hidePreviousButton()">
                            <div class="button-container d-inline-block" id="boton-container-confirmar">
                              <!-- <button type="button" id="boton-confirmar" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" @click="stepProgress.nextStep">
                                Reservar
                              </button> -->
                              <button v-if="!selectedProvider" type="button" id="boton-confirmar-sombra"
                                class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                @click="stepProgress.nextStep">
                                Reservar
                              </button>
                              <button v-if="selectedProvider" type="button" id="boton-confirmar-sombra"
                                class="btn btn-primary" @click="createBooking()">
                                Reservar
                              </button>
                            </div>
                          </div>

                          <label for="menu" id="selected-pack-text">Pack seleccionado:</label>
                          <input type="text" class="pack-number-show" id="menu" @change="stepProgress.nextStep"
                            disabled />

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content" id="modal-content-confirm-booking">
                                <div class="modal-header" id="modal-header-confirm-booking">
                                  <div @click="stepProgress.stepZero">
                                    <button type="button" id="modal-close-button" data-bs-dismiss="modal"
                                      aria-label="Close" @click="returnToInitialState()"></button>
                                  </div>

                                  <!-- <h1 class="modal-title fs-5" id="exampleModalLabel" v-if="!showMessage">Confirmación
                                    de su reserva</h1>

                                  <h1 class="modal-title fs-5" id="exampleModalLabel" v-if="showMessage">Estado de su
                                    reserva</h1>                                   -->
                                </div>
                                <div class="modal-body">
                                  <div v-if="!this.showMessage">
                                    <h2 id="modal-body-heading">Su reserva está a punto de ser confirmada</h2>
                                    <h2 id="modal-body-heading2">Pack seleccionado:</h2>
                                    <provider v-if="!selectedProvider" :id="this.idSelectedProvider"
                                      :id_menu_selected="this.idSelectedMenu" :find="true"
                                      @selectedM="handleSelectedMenu" />
                                    <provider v-if="selectedProvider" :id="selectedProvider"
                                      :id_menu_selected="this.idSelectedMenu" :find="true"
                                      @selectedM="handleSelectedMenu" />
                                    <h2 id="modal-body-heading3">Restaurante seleccionado:</h2>
                                    <div v-for=" prov in providers ">
                                      <div v-if="this.idSelectedProvider == prov.id_user">
                                        <div class="card" :key="prov.id_user" id="restaurant-card"
                                          style=" border-radius: 22px;">
                                          <img src="../images/resto.jpeg" class="card-img-top" alt="..."
                                            id="restaurant-card-img"
                                            style=" border-top-left-radius: 22px; border-top-right-radius: 22px;">
                                          <div class="card-body">
                                            <h5 class="card-title" id="card-title-restaurant">{{ prov.real_name }}</h5>
                                            <p class="card-text" id="card-text-restaurant">{{ prov.provider.adress }}
                                            </p>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div v-if="this.showMessage" style="text-align: center;">

                                    <div v-if="this.messageType == 'i'" class="alert alert-success"
                                      id="alert-success-booking" role="alert">
                                      Su reserva ha sido tramitada correctamente
                                    </div>

                                    <div v-if="this.messageType == 'e'" class="alert alert-danger"
                                      id="alert-danger-booking" role="alert">
                                      Su reserva no ha podido ser tramitada, vuelva a probar mas tarde.

                                    </div>
                                    <div v-if="this.messageType == 'eb'" class="alert alert-danger"
                                      id="alert-danger-booking" role="alert">
                                      No se pueden reservar más paquetes de los disponibles.

                                    </div>
                                    <div v-if="this.messageType == 'rd'" class="alert alert-danger"
                                      id="alert-danger-booking" role="alert">
                                      Registro duplicado, esta intentando reservar un paquete que ya ha reservado en las
                                      ultimas 24 horas.

                                    </div>
                                  </div>
                                </div>

                                <div v-if="!showMessage" class="modal-footer" id="modal-footer-confirm-booking">
                                  <div class="button-container d-inline-block" id="boton-container-confirmar">
                                    <button type="button" id="boton-confirmar2" class="btn btn-primary"
                                      @click="createBooking()">
                                      Confirmar
                                    </button>
                                    <button type="button" id="boton-confirmar2-sombra" class="btn btn-primary"
                                      @click="createBooking()">
                                      Confirmar
                                    </button>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>


  <div class="container-parte-inferior-avalaible-providers">
    <div class="container" id="navbar-showAvailableProviders" v-if="!this.id">
      <navbar v-if="showComponente && !selectedProvider" />
    </div>
  </div>



</template>

<script>
import axios from 'axios';
import provider from './provider/provider.vue'
import quantity from './quantity.vue'
import navbar from './navbar.vue';

export default {
  name: 'reservation',
  components: {
    provider,
    stepProgressBar,
    quantity,
    navbar
  },
  props: {
    selectedProvider: Number,
  },
  data() {
    return {
      providers: [],
      myModal: {},
      showComponente: true,
      idSelectedProvider: null,
      idSelectedMenu: null,
      showMenu: false,
      showQuantity: false,
      recievedQuantity: null,
      showPreviousButton: false,
      usuario: null,
      showMessage: false,
      messageType: false,
      booking: {
        id_rider_fk: "",
        id_provider_fk: "",
        id_menu_fk: "",
        menu_quantity: "",
        id_status_fk: "",
        curr_date: "",
      },
      loading: true,

    };

  },

  created() {
    this.fetchProviders();
    this.fetchUser();
  },

  mounted() {
    this.idSelectedProvider = this.selectedProvider;
    console.log('Hola - ' + this.selectedProvider);
    console.log(this.idSelectedProvider);
    if (this.idSelectedProvider) {
      this.showMenu = true;
    }
  },

  methods: {
    hidePreviousButton() {
      this.showPreviousButton = false;
    },
    returnToInitialState() {
      this.idSelectedProvider = null,
        this.idSelectedMenu = null,
        this.showMenu = false,
        this.showQuantity = false,
        this.recievedQuantity = null,
        this.showMessage = false,
        this.messageType = null


    },
    fetchUser() {
      const me = this;
      axios.get('/usuario/getUsuario')
        .then(response => {
          console.log(response)
          me.usuario = response.data

        })
        .catch(error => {
          console.error('Error fetching loged in yser data', error);
        });

    },
    createBooking() {
      const me = this;
      if (me.usuario) {
        me.booking.id_rider_fk = me.usuario.id_user;
      }
      if (me.recievedQuantity == 0) {
        me.recievedQuantity = 1;
      }
      me.booking.id_provider_fk = me.idSelectedProvider;
      me.booking.id_menu_fk = me.idSelectedMenu;
      me.booking.menu_quantity = me.recievedQuantity;
      me.booking.id_status_fk = 1;
      me.booking.curr_date = me.getCurrentDate();

      axios.post('/booking', me.booking)
        .then(response => {
          console.log('Booking created successfully:', response.data);

          axios.put('/provider/updateQuantity/' + me.recievedQuantity + '/' + me.idSelectedProvider + '/' + me.idSelectedMenu)
            .then(response => {
              console.log('Response:', response.data);
              // Handle the response data
              me.messageType = "i";
              this.$emit('change-message-type', 'i');
              me.showMessage = true;
            })
            .catch(error => {
              console.error('Error:', error);
              me.messageType = "eb";
              this.$emit('change-message-type', 'eb');
              me.showMessage = true;
            });
          // Do something with the response if needed


        })
        .catch(error => {
          console.error('Error creating booking:', error);

          if (error.code === 'ER_DUP_ENTRY') {
            // Handle the duplicate entry error (code 1062) here
            me.messageType = "rd";
            this.$emit('change-message-type', 'rd');
            console.error('Duplicate entry error:', error.message);
          } else {
            this.$emit('change-message-type', 'e');
            me.messageType = "e";
          }
          me.showMessage = true;
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
    fetchProviders() {
      const me = this;

      axios.get('/usuario/getUsuariosWithType/3')
        .then(response => {
          console.log(response);
          this.providers = response.data;
          this.loading = false;

        })
        .catch(error => {
          console.error('Error fetching user type', error);

        });
    },
    handleQuantityUpdated(quantity) {
      console.log('Quantity updated to:', quantity);
      this.recievedQuantity = quantity
      // Handle the updated quantity here
    },
    handleSelectedMenu(selectedMenu) {
      // This method will be triggered when the child emits the event
      console.log('Selected Menu in parent:', selectedMenu);
      document.getElementById("menu").value = selectedMenu;
      this.idSelectedMenu = selectedMenu;
      console.log("step:" + this.stepProgress);
      this.showQuantity = true;
      console.log("show quantity: " + this.showQuantity);

      // Do whatever you want with the selectedMenu data here

      // Scroll to the desired element
      let quantityElement = document.getElementById("card-body-provider-big-title2");
      quantityElement.scrollIntoView({ behavior: "smooth" });
    },
    viewMenu(providerId) {
      this.idSelectedProvider = providerId
      console.log(this.idSelectedProvider);
      this.showMenu = true;
      this.showPreviousButton = true;

    },
  },

};
</script>

<style scoped>
.container-parte-inferior-avalaible-providers {
  height: 100px;
}

#navbar-showAvailableProviders {
  position: fixed;
  top: 90%;
  padding-left: 0px;
  padding-right: 25px;
}

#card-providers {
  background-color: #1E1E1E;
  border: 0;
}

#card-body-providers {
  background-color: #1E1E1E;
  border: 0;
  padding: 0;
}

#restaurant-card {
  height: 250px;
  border: 0;
  background-color: #141414;
  margin-bottom: 3%;
  width: 100%;
}

#restaurant-card-img {
  height: 150px;
  object-fit: cover;
  border: 0;
}

#card-title-restaurant {
  color: white;
  font-size: 24px;
  margin-bottom: 0;
}

#card-text-restaurant {
  color: #8F8F8F;
  font-size: 18px;
}

#card-provider-big {
  background-color: #141414;
  border-radius: 26px;
  margin-bottom: 5%;
}

#card-body-provider-big {
  background-color: #141414;
  border-radius: 26px;
}

#card-body-provider-big-title {
  margin-top: 2%;
  margin-left: 2%;
  margin-bottom: 5%;
  color: white;
  font-size: 36px;
}

#card-body-provider-big-title2 {
  margin-top: -35%;
  margin-left: 2%;
  margin-bottom: 5%;
  color: white;
  font-size: 36px;
}

#previous-step-button {
  position: relative;
  left: 2%;
  top: 3%;
  margin-bottom: 5%;
  width: 40px;
  height: 40px;
  background-image: url("../images/mingcute_arrow-up-line.png");
  background-color: transparent;
  border: none;
}

.quantity-selection-container {
  width: 100%;
}

.book-pack-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  margin-top: 5%;
  margin-bottom: 10%;
}

#boton-container-confirmar {
  position: relative;
  width: 90%;
}

#boton-confirmar {
  background-color: #8BB481;
  height: 67px;
  color: white;
  border: 3px solid #141414;
  border-radius: 40px;
  font-family: 'Outfit', sans-serif;
  font-weight: bold;
  font-size: 24px;
  cursor: pointer;
  position: relative;
  z-index: 1;
  width: 100%;
}

#boton-confirmar2 {
  background-color: #8BB481;
  height: 67px;
  color: white;
  border: 3px solid #1E1E1E;
  border-radius: 40px;
  font-family: 'Outfit', sans-serif;
  font-weight: bold;
  font-size: 24px;
  cursor: pointer;
  position: relative;
  z-index: 1;
  width: 100%;
}

#boton-confirmar-sombra {
  position: absolute;
  background-color: #677F61;
  height: 70px;
  color: white;
  border: none;
  border-radius: 40px;
  font-family: 'Outfit', sans-serif;
  font-weight: bold;
  font-size: 24px;
  cursor: pointer;
  z-index: 0;
  width: 100%;
  top: 1%;
  left: -1%;
}

#boton-confirmar2-sombra {
  position: absolute;
  background-color: #677F61;
  height: 70px;
  color: white;
  border: none;
  border-radius: 40px;
  font-family: 'Outfit', sans-serif;
  font-weight: bold;
  font-size: 24px;
  cursor: pointer;
  z-index: 0;
  width: 100%;
  top: 1%;
  left: -1%;
}

#selected-pack-text {
  color: white;
  font-size: 18px;
  margin-right: 10px;
}

.pack-number-show {
  background-color: #1E1E1E;
  width: 15%;
  height: 30px;
  border: none;
  color: white;
  font-size: 18px;
  font-weight: 400;
  border-radius: 50px;
  text-align: center;
}

#modal-content-confirm-booking {
  background-color: #1e1e1eb5;
  backdrop-filter: blur(9px);
  border-radius: 26px;
}

#modal-header-confirm-booking {
  border: none;
}

#modal-body-heading {
  color: white;
  font-size: 36px;
  margin-bottom: 5%;
}

#modal-body-heading2 {
  color: #8F8F8F;
  font-size: 24px;
  font-weight: 500;
}

#modal-body-heading3 {
  color: #8F8F8F;
  font-size: 24px;
  font-weight: 500;
  margin-top: -30%;
}

#modal-close-button {
  position: relative;
  left: 2%;
  top: 3%;
  margin-bottom: 5%;
  width: 40px;
  height: 40px;
  background-image: url("../images/mingcute_arrow-up-line.png");
  background-color: transparent;
  border: none;
}

#modal-footer-confirm-booking {
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
  padding-top: 0;
}

#alert-success-booking {
  margin-top: -8%;
  padding: 0;
  --bs-alert-color: #8BB481;
  font-size: 32px;
  font-weight: 500;
  --bs-alert-bg: transparent;
  --bs-alert-border-color: none;
  --bs-alert-link-color: var(--bs-success-text-emphasis);
  line-height: 1.3;
}

#alert-danger-booking {
  margin-top: -8%;
  padding: 0;
  --bs-alert-color: #E46962;
  font-size: 32px;
  font-weight: 500;
  --bs-alert-bg: transparent;
  --bs-alert-border-color: none;
  --bs-alert-link-color: var(--bs-success-text-emphasis);
  line-height: 1.3;
}
</style>