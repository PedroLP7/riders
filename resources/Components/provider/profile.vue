<template>
    <div class="container " id="profile">



        PERFIL


        <div>
            <p>{{ user.user_name }}</p>
            <img src="../../images/lets-icons--user-alt-fill.svg" alt="profileimg" id="profileimg">
            <a class="btn btn-primary" @click="logout()">Logout</a>
            <a class="btn btn-primary" @click="editarPerfil()">Editar Perfil</a>


            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Tus estadisticas </h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Repartos este mes  : 9</h6>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Personas añadidas este mes  :8 </h6>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Pedidos este mes : +12%</h6>



                    <div class="" id="chart">
                        <chart1 />
                    </div>


                </div>

            </div>



        </div>

        <div>AJUSTES</div>
        <div class="card" style="width: 18rem;">
            <div class="card-body">

                <h6 class="card-subtitle mb-2 text-body-secondary">Cambiar idioma</h6>
                <h6 class="card-subtitle mb-2 text-body-secondary">Notificaciones</h6>
                <h6 class="card-subtitle mb-2 text-body-secondary"> <button  @click="openModal()" class="btn btn-primary">Ayuda</button></h6>



            </div>
        </div>












    </div>





 <!-- modal insert -->
<div class="modal fade" id="modalAyuda" tabindex="-1" aria-labelledby="modalAyuda" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>







    <div class="container" id="navbar">
        <navbar v-if="showComponente" />
    </div>


</template>
<script>
import navbar from '../../Components/navbar.vue';
import axios from 'axios';
import chart1 from '../../Components/provider/chart1.vue';
import * as bootstrap from 'bootstrap';

export default {

    name: 'profile',
    components: {
        chart1,



        navbar
    },
    data() {
        return {
            user: {},

            showComponente: true,

            userp: {},

        }
    },
    created() {
        this.getidUser()

    },
    methods: {
        getProvider() {
            const me = this;
            const idUser = me.userp.id_user
            axios.get('provider/' + idUser)
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
            window.location.href = "/riders/public/provider/edit";
        },
        openModal() {
            const myModal = new bootstrap.Modal(document.getElementById('modalAyuda'), {

            });
            myModal.show();

        },


    },


}
</script>
<style>
.ocultar {
    display: none;

}

#profileimg {
    width: 100px;
    height: 100px;

}
</style>
