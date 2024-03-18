<template>
    <div class="container " id="menus">


        <h1 id="titulo">Packs disponibles</h1>

        <button class="btn btn-primary" id="crearPack" @click="showCreateMenu()" type="button">Crear Pack</button>
        
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
    <navbar v-if="showComponente" />
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


        showCreateMenu(){
        window.location.href = "createMenu";
        console.log('crear menu');
    },

    },


}
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');

.ocultar {
    display: none;
}

* {
    font-family: "Outfit", sans-serif;
}

*::selection {
    background-color: #475941;
}

body {
    background-color: #1E1E1E;
}

#navbar {
    position: fixed;
    top: 90%;
}

#titulo {
    color: #8F8F8F;
    font-weight: bold;
}

#crearPack {
    position: fixed;
    width: 50%;
    height: 7%;
    top: 81%;
    right: 5%;
    z-index: 999;
    border: none;
    background-color: #8bb481ba;
    backdrop-filter: blur(9px);
    color: #1E1E1E;
}

</style>
