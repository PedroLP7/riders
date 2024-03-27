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
const method1 = () => {
  stepProgress.nextStep;
};
</script>
<template>
  <div class="row">
    <div class="col-12">
      <stepProgressBar :data="dataSteps" ref="stepProgress" />
      <button @click="stepProgress.previousStep">Previous Step</button>
      <button @click="stepProgress.nextStep">Next Step</button>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div>
        <div class="card">
          <div class="card-body">
            <div v-if="providers !== null">
              <div v-for="prov in providers">
                <div v-if="!idSelectedProvider || idSelectedProvider === prov.id_user">
                  <div @click="stepProgress.nextStep">
                    <div class="card" style="width: 18rem;" @click="viewMenu(prov.id_user)" :key="prov.id_user">
                      <img v-if="!idSelectedProvider" src="../images/resto.jpeg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 v-if="idSelectedProvider">provider:</h5>
                        <h5 class="card-title">{{ prov.real_name }}</h5>
                        <p class="card-text" v-if="!idSelectedProvider">Direccion: {{ prov.provider.adress }}</p>

                      </div>
                    </div>
                  </div>
                  <div v-if="showMenu">
                    <div class="card">
                      <div class="card-body">
                        <h1>Seleccione el menu a recoger en bar/restaurante {{ prov.real_name }}</h1>

                        <provider :id="this.idSelectedProvider" @selectedM="handleSelectedMenu" />

                        <form action="">
                          <input type="text" id="menu" @change="stepProgress.nextStep" style="hidden"> </input>

                          <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" @click="stepProgress.nextStep">
                            Reservar
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmación de su reserva</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <h2>Su reserva esta apunto de ser confirmada</h2>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  <button type="button" class="btn btn-primary">Confirmar</button>
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




</template>

<script>
import axios from 'axios';
import provider from './provider/provider.vue'


export default {
  components: {
    provider,
    stepProgressBar
  },
  data() {
    return {
      providers: [],
      myModal: {},
      idSelectedProvider: null,
      showMenu: false,
    };
  },

  created() {
    this.fetchProviders();

  },

  methods: {
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
    handleSelectedMenu(selectedMenu) {
      // This method will be triggered when the child emits the event
      console.log('Selected Menu in parent:', selectedMenu);
      document.getElementById("menu").value = selectedMenu;
      //this.currentStep++;
      console.log("step:" + this.stepProgress);

      // Do whatever you want with the selectedMenu data here
    },
    viewMenu(providerId) {
      this.idSelectedProvider = providerId
      console.log(this.idSelectedProvider);
      this.showMenu = true;

    },
  },

};
</script>

<style scoped>
/* Your scoped CSS styles go here */
</style>