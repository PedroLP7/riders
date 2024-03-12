<template>
    <div class="container " id="menus">


        <h1 id="titulo">PACKS DISPONIBLES</h1>

        <button class="btn btn-primary" type="button">Nuevo Menu</button>
        <div class="card mt-3" style="width: 18rem;" v-for="menu in user.provider.menus">

            <div class="card-body">
                <h5 class="card-title">Menu {{ menu.id_menu }} </h5>
                <img src="../images/menu.png" class="card-img-top" alt="imgmenu" id="imgmenu">
                <p class="card-text"> item1 :{{ menu.item1 }}
                    <br>
                    item 2 :{{ menu.item2 }}
                    <br>
                    item 3 :{{ menu.item3 }}
                    <br>
                    cantidad : {{ menu.pivot.quantity }}
                    id : {{  idUser }}

                </p>


            </div>
        </div>






        <button @click="showBook()">Show bookings</button>








    </div>
    <div class="container" id="bookings">
    <bookings v-if="showBookings" :usuario="idUser"/>
 </div>
 <div class="container" id="navbar">
    <navbar v-if="showComponente"/>
 </div>



    <!-- <div> {{  provider.id_user }}  {{ provider.user_name }}  </div> -->
</template>
<script>
 import bookings from '../Components/bookings.vue'

 import navbar from '../Components/navbar.vue'
import axios from 'axios'


export default {
    name: 'provider',
    components: {
        bookings,
        navbar
    },
    data() {
        return {
            user: {},
            idUser:{},
            showComponente: true,
            showBookings : false,
        }
    },
    created() {
        this.getidUser()

    },
    methods: {
        getUser() {
            const me = this;
            const idUser = me.idUser
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
                    me.idUser = response.data
                    console.log(response.data)
                    me.getUser()
                })
                .catch(error => {
                    console.log(error)
                })
        },
        showBook() {
            this.showBookings = true;
            document.getElementById('menus').classList.add('ocultar');



        }
    }

}
</script>
<style>

.ocultar {
    display: none;

}

</style>
