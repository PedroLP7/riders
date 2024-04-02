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





</template>

<script>
import axios from 'axios';
import provider from './provider/provider.vue'
import quantity from './quantity.vue'


export default {
  components: {
    provider,
    stepProgressBar,
    quantity
  },
  data() {
    return {
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

<style scoped>
/* Your scoped CSS styles go here */
</style>

