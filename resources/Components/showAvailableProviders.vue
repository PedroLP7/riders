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

  <h1 id="titulo">Proveedores disponibles</h1>
        <div class="restaurants-container">
            <div v-if="providers !== null">
              <div v-for="prov in providers">
                <div v-if="!idSelectedProvider || idSelectedProvider === prov.id_user">
                  <div @click="stepProgress.nextStep">
                    <div class="card" id="restaurant-card" @click="viewMenu(prov.id_user)" :key="prov.id_user">
                      <img v-if="!idSelectedProvider" src="../images/resto.jpeg" class="card-img-top" id="restaurant-img" alt="..."
                           style=" border-top-left-radius: 22px; border-top-right-radius: 22px;"
                      >
                      <div class="card-body" id="restaurant-card-body">
                        <h5 v-if="idSelectedProvider">provider:</h5>
                        <h1 class="restaurant-name-card">{{ prov.real_name }}</h1>
                        <p class="restaurant-adress-card" v-if="!idSelectedProvider">{{ prov.provider.adress }}</p>

                      </div>
                    </div>
                  </div>

                  <div v-if="showMenu" id="view-restaurant">
                    <img id="restaurant-img-big" src="../images/resto.jpeg" alt="">
                    <!-- <div>
                        <stepProgressBar :data="dataSteps" ref="stepProgress" />
                        <div v-if="this.showPreviousButton" @click="returnToInitialState()">
                          <button @click="stepProgress.previousStep">Previous Step</button>

                        </div>
                        <button @click="stepProgress.nextStep">Next Step</button>
                    </div> -->

                    <div class="view-restaurant-content">
                        <h1 id="view-restaurant-content-name">{{ prov.real_name }}</h1>

                        <div class="provider-menus-container">
                          <provider :id="this.idSelectedProvider" :find="false" @selectedM="handleSelectedMenu" />
                        </div>
                        
                        <div v-if="showQuantity">
                          <p>Cantidad que desea recoger:</p>
                          <quantity @quantity-updated="handleQuantityUpdated" />
                        </div>

                        <form action="">
                          <input type="text" id="menu" @change="stepProgress.nextStep" style="hidden"> </input>
                          <div @click="hidePreviousButton()">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                              data-bs-target="#exampleModal" @click="stepProgress.nextStep">
                              Reservar
                            </button>
                          </div>

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel" v-if="!showMessage">Confirmación
                                    de su reserva</h1>
                                  <h1 class="modal-title fs-5" id="exampleModalLabel" v-if="showMessage">Estado de su
                                    reserva</h1>
                                  <div @click="stepProgress.stepZero">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                      @click="returnToInitialState()"></button>
                                  </div>
                                </div>
                                <div class="modal-body">
                                  <div v-if="!this.showMessage">
                                    <h2>Su reserva está a punto de ser confirmada</h2>
                                    <h2>Pack seleccionado:</h2>
                                    <provider :id="this.idSelectedProvider" :id_menu_selected="this.idSelectedMenu"
                                      :find="true" @selectedM="handleSelectedMenu" />
                                    <h2>Restaurante seleccionado:</h2>
                                    <div v-for=" prov  in  providers ">
                                      <div v-if="this.idSelectedProvider == prov.id_user">
                                        <div class="card" :key="prov.id_user">
                                          <img src="../images/resto.jpeg" class="card-img-top" alt="...">
                                          <div class="card-body">
                                            <h5 v-if="idSelectedProvider">provider:</h5>
                                            <h5 class="card-title">{{ prov.real_name }}</h5>
                                            <p class="card-text">Direccion: {{
        prov.provider.adress }}</p>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div v-if="this.showMessage">

                                    <div v-if="this.messageType == 'i'" class="alert alert-success" role="alert">
                                      Su reserva ha sido tramitada correctamente
                                    </div>

                                    <div v-if="this.messageType == 'e'" class="alert alert-danger" role="alert">
                                      Su reserva no ha podido ser tramitada, vuelva a probar mas tarde.

                                    </div>
                                  </div>
                                </div>

                                <div v-if="!showMessage" class="modal-footer">
                                  <button @click="stepProgress.stepZero">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                      @click="returnToInitialState()">Cancelar</button>
                                  </button>
                                  <button type="button" class="btn btn-primary"
                                    @click="createBooking()">Confirmar</button>
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




  <div class="container-parte-inferior">
      <div class="container" id="navbar-showAvailableProviders" v-if="!this.id">
          <navbar v-if="showComponente" />
      </div>
  </div>

</template>

<script>
import axios from 'axios';
import provider from './provider/provider.vue'
import quantity from './quantity.vue'
import navbar from './navbar.vue';

export default {
  components: {
    provider,
    stepProgressBar,
    quantity,
    navbar
  },
  data() {
    return {
      showComponente: true,
      providers: [],
      myModal: {},
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
      }
    };
  },

  created() {
    this.fetchProviders();
    this.fetchUser();
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
        this.messageType = 0


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

      me.booking.id_provider_fk = me.idSelectedProvider;
      me.booking.id_menu_fk = me.idSelectedMenu;
      me.booking.menu_quantity = me.recievedQuantity;
      me.booking.id_status_fk = 1;
      me.booking.curr_date = me.getCurrentDate();

      axios.post('/booking', me.booking)
        .then(response => {
          console.log('Booking created successfully:', response.data);
          // Do something with the response if needed
          me.messageType = "i";
          me.showMessage = true;
        })
        .catch(error => {
          console.error('Error creating booking:', error);
          me.messageType = "e";
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

<style>
  #navbar-showAvailableProviders {
    position: fixed;
    top: 90%;
    padding-left: 0px;
    padding-right: 25px;
  }

  .restaurants-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    align-items: center;
    margin-top: 20px;
  }

  #restaurant-card {
    background-color: #141414;
    border: none;
    border-radius: 22px;
    width: 400px;
  }

  .card {
    margin-bottom: 2%;
  }

  .card-img {
    border-top-left-radius: 22px;
    border-top-right-radius: 22px;
  }

  .card-img-top {
    height: 150px;
    object-fit: cover;
  }

  .restaurant-name-card {
    color: #FFFFFF;
    margin-bottom: 0;
  }

  .restaurant-adress-card {
    color: #8F8F8F;
  }

  #restaurant-card-body {
    height: 90px;
  }

  #restaurant-img-big {
    width: 100%;
    height: 300px;
    object-fit: cover;
  }

  #view-restaurant {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
  }

  .view-restaurant-content {
    background-color: #1E1E1E;
    border-radius: 33px 33px 0 0;
    position: relative;
    top: -25px;
    padding-top: 2%;
  }

  #view-restaurant-content-name {
    color: #FFFFFF;
    margin-top: 20px;
    font-size: 40px;
    font-weight: 500;
    margin-left: 6%;
  }

  .provider-menus-container {
    position: absolute;
    left: 0;
  }
</style>
