<template>
    <div class="container " id="menus">


        <h1 id="titulo">PACKS DISPONIBLES</h1>

        <button class="btn btn-primary" @click="showCreateMenu()" type="button">Nuevo Menu</button>
        <button class="btn btn-primary" @click="showBook()">Show bookings</button>
        <div class="card mt-3" style="width: 18rem;" v-for="menu in user.provider.menus">

            <div class="card-body">
                <h5 class="card-title">Menu {{ menu.id_menu }} </h5>
                <img src="../../images/menu.png" class="card-img-top" alt="imgmenu" id="imgmenu">
                <p class="card-text"> item1 :{{ menu.item1 }}
                    <br>
                    item 2 :{{ menu.item2 }}
                    <br>
                    item 3 :{{ menu.item3 }}
                    <br>
                    cantidad : {{ menu.pivot.quantity }}
                    <!-- id : {{  idUser }} -->

                </p>


            </div>
            <button class="btn btn-primary">Editar menu</button>
        </div>















    </div>
    <div class="container" id="bookings">
    <bookings v-if="showBookings" :usuario="idUser"/>
 </div>
 <div class="container" id="navbar">
    <navbar v-if="showComponente" :showBookings="showBookings"  @update:bookings="showBookingComponent"/>
 </div>




</template>
<script>
 import bookings from './bookings.vue'

 import navbar from '../../Components/navbar.vue'
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

            showComponente: true,
            showBookings : false,
            userp:{},

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
                    me.userp= response.data
                    console.log(response.data)
                    console.log(me.userp.id_user);
                     me.getProvider()
                })
                .catch(error => {
                    console.log(error)
                })
        },
        showBook() {
            this.showBookings = true;
            document.getElementById('menus').classList.add('ocultar');



        },
        showBookingComponent(updatedBookings) {
            this.showBookings = updatedBookings;
            console.log(this.showBookings);


        },
        showCreateMenu(){
        window.location.href = "createMenu";
        console.log('crear menu');
    }
    },


}
</script>
<style>

.ocultar {
    display: none;

}

</style>
