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
    <div class="container " id="profile">

        <h1 id="titulo">Perfil</h1>

        <div class="profile-header">
            <img src="../../images/profileImage.png" alt="profileimg" id="profileImg">
            <p>{{ user.user_name }}</p>

            <div class="profile-buttons-container">
                <a class="btn btn-primary" id="edit-profile-button" @click="editarPerfil()">Editar Perfil</a>
                <a class="btn btn-primary" id="logout-button" @click="logout()">Cerrar Sesión</a>
            </div>
        </div>

        <h1 id="titulo-estadisticas">Tus Estadísticas</h1>

        <div class="first-stats-line">
            <div class="small-stat">
                <div class="big-number-stat">
                    <h1>{{ deliverys }}</h1>
                </div>
                <div class="small-stat-text">
                    <h2 class="small-stat-title">Repartos</h2>
                    <p class="timerange-stat">este mes</p>
                </div>
            </div>

            <div class="small-stat">
                <div class="big-number-stat">
                    <h1>{{ consecutive }}</h1>
                </div>
                <div class="small-stat-text">
                    <h2 class="small-stat-title">Dias consecutivos</h2>
                    <p class="timerange-stat">Entregando alegria</p>
                </div>
            </div>
        </div>

        <div id="big-stat">
            <div class="card-body">
                <h1 class="big-stat-title">{{increment}}  % Pedidos</h1>
                <p class="timerange-stat">este mes</p>

                <div class="" id="chart2" v-if="isLoaded">
                    <chart2  :monthly="monthly"  />
                </div>
            </div>
        </div>


        <h1 id="titulo-ajustes">Ajustes</h1>
        <div class="setting-card">
            <h1 class="setting-card-title">Cambiar idioma</h1>
            <button type="button" class="language-button">
                <img src="../../images/iconamoon_arrow-up-2.png" alt="">
            </button>
        </div>
        <div class="setting-card">
            <h1 class="setting-card-title">Notificaciones</h1>

            <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="setting-card">
            <h1 class="setting-card-title">Ayuda</h1>
            <button  @click="openModal()" class="help-button">
                <img src="../../images/help.png" alt="">
                <img src="../../images/iconamoon_arrow-up-2.png" alt="">
            </button>
        </div>
    </div>


 <!-- modal insert -->
<div class="modal fade" id="modalAyuda" tabindex="-1" aria-labelledby="modalAyuda" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">VIDEO INTERACTIVO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        VIDEO AQUI PUTITAS
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>







    <div class="container-parte-inferior-rider-profile">
        <div class="container" id="navbar">
            <navbar v-if="showComponente" />
        </div>
    </div>


</template>
<script>
import navbar from '../../Components/navbar.vue';
import axios from 'axios';
import chart2 from './chart2.vue';
import * as bootstrap from 'bootstrap';
export default {

    name: 'profile',
    components: {
        chart2,



        navbar
    },
    data() {
        return {
            user: {},

            showComponente: true,

            userp: {},
            consecutive: {},
            deliverys: {},
            monthly: {},
            isLoaded: false,
            loading: true,
            increment: {}

        }
    },
    created() {
        this.getidUser()

    },
    methods: {
        getProvider() {
            const me = this;
            const idUser = me.userp.id_user
            axios.get('rider/' + idUser)
                .then(response => {
                    me.user = response.data
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getidUser() {
            const me = this;

            axios.get('usuario/getUsuario')
                .then(response => {
                    me.userp = response.data
                    console.log(response.data)
                    console.log(me.userp.id_user);

                    me.getProvider()
                    me.getConsecutive()
                    me.getDeliverys()
                    me.getMonthly()
                    me.getIncrement()
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getConsecutive(){
            const me = this;
            const idUser = me.userp.id_user
            axios.get('rider/consecutive/' + idUser)
                .then(response => {
                    me.consecutive = response.data
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                })
        },

        getDeliverys(){
            const me = this;
            const idUser = me.userp.id_user
            axios.get('rider/deliverys/' + idUser)
                .then(response => {
                    me.deliverys = response.data
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getMonthly(){
            const me = this;
            const idUser = me.userp.id_user
            axios.get('rider/totalDeliveries/' + idUser)
                .then(response => {
                    me.monthly = response.data
                    console.log(response.data)
                    me.isLoaded = true;
                    me.loading = false;
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getIncrement(){
            const me = this;
            const idUser = me.userp.id_user
            axios.get('rider/monthlyR/' + idUser)
                .then(response => {
                    me.increment = response.data
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                })


        },



        showCreateMenu() {
            window.location.href = "createMenu";
            console.log('crear menu');
        },
        logout() {
            window.location.href = "/riders/public/logout";
        },
        editarPerfil() {
            window.location.href = "/riders/public/rider/edit";
        },
        openModal() {
            const myModal = new bootstrap.Modal(document.getElementById('modalAyuda'), {

            });
            myModal.show();

        },


    },


}
</script>
<style scoped>
#titulo {
    color: #8F8F8F;
    font-weight: bold;
    margin-top: 20%;
    margin-left: 2%;
}

.container-parte-inferior-rider-profile {
    height: 100px;
}

.ocultar {
    display: none;

}

#profileImg {
    width: 150px;
    height: 150px;

}

.profile-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
}

.profile-header p {
    font-size: 24px;
    font-weight: 600;
    color: white;
    margin-bottom: 30px;
}

.profile-buttons-container {
    display: flex;
    justify-content: space-around;
    width: 90%;
}

#logout-button {
    width: 160px;
    height: 47px;
    background-color: #8BB481;
    border: 2px #8BB481 solid;
    border-radius: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #1E1E1E;
    font-size: 20px;
    font-weight: 600;
}

#edit-profile-button {
    width: 160px;
    height: 47px;
    background-color: transparent;
    border: 2px #8BB481 solid;
    border-radius: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #8BB481;
    font-size: 20px;
    font-weight: 600;
}

#logout-button:hover, #edit-profile-button:hover {
    cursor: pointer;
}

#titulo-estadisticas {
    color: #8F8F8F;
    font-weight: bold;
    margin-top: 10%;
    margin-left: 2%;
    margin-bottom: 7%;
}

.first-stats-line {
    display: flex;
    justify-content: space-between;
}

.small-stat {
    width: 49%;
    height: 80px;
    background-color: #393939;
    border-radius: 22px;
    display: flex;
    justify-content: left;
    align-items: center;
    padding: 20px;
}

.big-number-stat h1{
    font-size: 50px;
    font-weight: bold;
    color: #B4DAAA;
    margin: 0;
}

.small-stat-text {
    margin-left: 10%;
}

.small-stat-title {
    font-size: 16px;
    font-weight: 600;
    color: white;
    margin: 0;
}

.timerange-stat {
    font-size: 12px;
    color: #8F8F8F;
    margin: 0;
}

#big-stat {
    margin-top: 2%;
    background-color: #393939;
    border-radius: 22px;
    padding: 20px;
}

.big-stat-title {
    font-size: 32px;
    font-weight: bold;
    color: #B4DAAA;
    margin: 0;
}

#chart {
    margin-top: 20px;
    width: 85%;
    display: flex;
    justify-content: center;
}

#titulo-ajustes {
    color: #8F8F8F;
    font-weight: bold;
    margin-top: 10%;
    margin-left: 2%;
    margin-bottom: 7%;
}

.setting-card {
    width: 100%;
    height: 65px;
    background-color: #393939;
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    margin-bottom: 2%;
}

.setting-card-title {
    font-size: 24px;
    font-weight: 500;
    color: #8F8F8F;
    margin: 0;
}

.help-button {
    width: 85px;
    height: 50px;
    background-color: #8BB481;
    border: none;
    border-radius: 50px;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #B4DAAA;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: #43533E;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #8BB481;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.language-button {
    width: 48px;
    height: 48px;
    background-color: #8BB481;
    border: none;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

#navbar {
  width: 100%;
  left: 0%;
  right: 0%;
}

@media (min-width: 950px) {
    #titulo {
    color: #8F8F8F;
    font-weight: bold;
    margin-top: 10%;
    margin-left: 2%;
}

    #navbar {
        width: 38%;
        left: 0%;
        right: 0%;
    }

    .profile-buttons-container {
        display: flex;
        justify-content: space-around;
        width: 30%;
    }
}
</style>
