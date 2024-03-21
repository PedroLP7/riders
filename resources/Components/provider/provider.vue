<template>
    <div class="container " id="menus">


        <h1 id="titulo">Packs disponibles</h1>

        <button class="btn btn-primary" id="crearPack" @click="showCreateMenu()" type="button">Crear Pack</button>

        <!-- <button class="btn btn-primary" @click="showBook()">Show bookings</button> -->
        <div id="cards-container-showPack">

            <div class="card mt-3" id="card-showPack" v-for="menu in user.provider.menus">
                <div class="card-body" id="card-body-showPack">
                    <img src="../../images/menu.png" class="card-img-top" alt="imgmenu" id="imgmenu-showPack">
                    <h5 class="card-title" id="card-title-showPack">Pack #{{ menu.id_menu }} </h5>
                    <p class="card-text" id="card-text-showPack">
                        item1 :{{ menu.item1 }}

                        item 2 :{{ menu.item2 }}

                        item 3 :{{ menu.item3 }}

                        cantidad : {{ menu.pivot.quantity }}
                        <!-- preguntar a pedro si esto puede estar en otra parte -->

                        <!-- id : {{  idUser }} -->
                    </p>


                </div>
                <button class="btn btn-primary" id="botonEditar">Editar</button>
            </div>
            <button @click="editMenu(menu.id_menu)" class="btn btn-primary">Editar menu </button>
        </div>
    </div>

    <div class="container-parte-inferior">
        <div class="container" id="bookings">
            <bookings v-if="showBookings" :usuario="idUser"/>
        </div>
        <div class="container" id="navbar">
            <navbar v-if="showComponente" />
        </div>
    </div>

</template>
<script>
import bookings from './bookings.vue'

import navbar from '../../Components/navbar.vue'
import axios from 'axios'
import editMenu from './editMenu.vue'


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
        editMenu(menuId) {
    window.location.href = `editMenu/${menuId}`;
    console.log('editar menu');
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
    box-sizing: border-box;
}

*::selection {
    background-color: #475941;
}

body {
    background-color: #1E1E1E;
}

.container-parte-inferior {
    height: 200px;
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
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    width: 210px;
    height: 68px;
    top: 81%;
    right: 4%;
    z-index: 999;
    border: none;
    border-radius: 19px;
    background-color: #8bb481ba;
    backdrop-filter: blur(3px);
    color: #1E1E1E;
    font-weight: bold;
    font-size: 24px;
}

@media (max-height: 740px) {
    #crearPack {
        top: 78%;
    }
}

#cards-container-showPack {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}

#card-showPack {
    background-color: #393939;
    width: 90%;
    height: 129px;
    flex-direction: row;
    --bs-card-spacer-y: 0;
    --bs-card-spacer-x: 0;
    --bs-card-title-spacer-y: 0;
    --bs-card-border-width: 0;
    border-radius: 26px;
    margin-right: 7px;
    margin-left: 7px;
}

.mt-3 {
    margin-top: 0.8rem !important;
}

#card-body-showPack {
    background-color: #393939;
    border: none;
    width: 374px;
    height: 129px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    border-radius: 26px;
}

#imgmenu-showPack {
    position: absolute;
    left: 10px;
    height: 85%;
    width: auto;
    border-radius: 19px;
}

#card-title-showPack {
    position: absolute;
    top: 14px;
    left: 44%;
    color: #FFFFFF;
    font-size: 24px;
    margin-left: 15px;
}

#card-text-showPack {
    position: absolute;
    left: 44%;
    top: 43px;
    color: #8F8F8F;
    font-size: 15px;
    margin-left: 15px;
    margin-right: 30px;
}

@media (max-width: 412px) {
    #card-title-showPack {
        margin-left: 25px;
    }

    #card-text-showPack {
        margin-left: 25px;
        font-size: 13px;
    }
}

@media (max-width: 380px) {
    #imgmenu-showPack {
        display: none;
    }

    #card-title-showPack {
        left: 5%;
    }

    #card-text-showPack {
        left: 5%;
    }
}


#botonEditar {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    width: 70px;
    height: 25px;
    border-radius: 50px;
    border: none;
    bottom: 0;
    right: 0;
    background-color: #8BB481;
    color: #1E1E1E;
    font-size: 13px;
    font-weight: bold;
    margin-bottom: 10px;
    margin-right: 10px;
}

#botonEditar:hover {
    color: #1E1E1E;
    background-color: #8BB481;
    border-color: none;
}
</style>
