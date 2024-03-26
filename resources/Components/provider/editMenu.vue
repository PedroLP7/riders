<template>
    <div id="edit-menu-container">
        <form id="edit-form">
            <img src="../../images/menuEdit.png" id="editMenuImg" alt="imagen menu">
            <h1 id="pack-name">Pack #{{menu.id_menu}}</h1>
            <p id="edit-subtitle">Que vas a incluir en este pack?</p>

            <div id="items-container">
                <div class="mb-3 edit-pack" id="item1-container">
                    <input
                        type="text"
                        class="form-control"
                        id="item1"
                        name="item1"
                        v-model="menu.item1"
                        placeholder="Item1"
                    />
                </div>

                <div class="mb-3 edit-pack" id="item2-container">
                    <input
                        type="text"
                        class="form-control"
                        id="item2"
                        name="item2"
                        v-model="menu.item2"
                        placeholder="Item2"
                        />
                </div>

                <div class="mb-3 edit-pack" id="item3-container">
                    <input
                        type="text"
                        class="form-control"
                        id="item3"
                        name="item3"
                        v-model="menu.item3"
                        placeholder="Item3"
                    />
                </div>
            </div>
            
            <div class="bottom-container">
                <input
                    type="number"
                    class="form-control"
                    id="pack-quantity"
                    name="quantity"
                    min="1" 
                    step="1"
                    v-model="cantidad.pivot.quantity"
                />
                <!-- <button type="button" @click="goBack()" class="btn btn-danger">Cancelar</button> -->
                <div class="button-container d-inline-block" id="buton-container-confirmar">
                    <button type="button" @click="updateMenu()" class="btn btn-primary" id="boton-confirmar">Editar</button>
                    <!-- <button id="sombraBoton">Editar</button> -->
                </div>
            </div>
        </form>
    </div>

    <div class="container" id="navbar">
        <navbar v-if="showComponente" />
    </div>
</template>
<script>
import axios from "axios";
import navbar from '../../Components/navbar.vue'
import provider from "./provider.vue";

export default {
    components: {
        navbar,
    },
    data() {
        return {
            idMenu: {},
            menu: {},
            provider: {},
            cantidad: {},
            showComponente: true,
        };
    },
    methods: {
        getidMenu() {
            const me = this;
            const idMenu = document
                .getElementById("editMenu")
                .getAttribute("data-id");
            console.log(me.idMenu);
            me.idMenu = idMenu;
        },
        getMenu() {
            const me = this;
            axios
                .get("charity_menu/" + me.idMenu)
                .then(function (response) {
                    console.log(response.data);
                    me.menu = response.data;
                    me.cantidad = response.data.providers.find(
                        (c) => c.id_provider === me.provider
                    );
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        getidUser() {
            const me = this;

            axios
                .get("usuario/getUsuario")
                .then((response) => {
                    me.provider = response.data.id_user;
                    console.log(me.provider);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        updateMenu() {
            const me = this;
            const data = {
                item1: me.menu.item1,
                item2: me.menu.item2,
                item3: me.menu.item3,
                provider_id: me.provider,
                quantity: me.cantidad.pivot.quantity,
            };
            console.log(data);
            axios.put("charity_menu/" + me.idMenu, data).then((response) => {
                console.log(response);
                window.location.href = "/riders/public/provider/home";
            })
            .catch((error) => {
                console.log(error);
            });
        },




        goBack() {
            window.location.href = "/riders/public/provider/home";
        },
    },

    created() {
        this.getidMenu();
        this.getMenu();
        this.getidUser();
    },
};
</script>
<style>
#edit-form {
    width: 100%;
    height: 100%;
}

#edit-menu-container {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    background-color: #000000;
    height: 77%;
    width: 90%;
    top: 10%;
    border-radius: 26px;
    padding: 3%;
}

#editMenuImg {
    border-radius: 15px;
    object-fit: cover;
    height: 160px;
    width: 100%;
}       

#pack-name {
    color: white;
    font-size: 48px;
    font-weight: bold;
    margin-top: 15px;
    margin-left: 10px;
}

#edit-subtitle {
    color: #8F8F8F;
    font-size: 24px;
    font-weight: 500;
    margin-top: -10px;
    margin-left: 10px;
}

#items-container {
    height: 40%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    margin-top: 30px;
}

.mb-3 edit-pack {
    background-color: #1E1E1E;
}

#item1-container {
    height: 200%;
    grid-column: 1 / 2;
    grid-row: 1 / 2;
    margin-right: 2%;
}

#item1-container input {
    background-color: #1E1E1E;
    width: 100%;
    height: 100%;
    border: none;
    color: white;
}

#item2-container {
    height: 98%;
    grid-column: 2 / 2;
    grid-row: 1 / 2;
    margin-left: 2%;
}

#item3-container {
    height: 98%;
    grid-column: 2 / 2;
    grid-row: 2 / 2;
    margin-left: 2%;
    margin-top: 2%;
}

#item2-container input, #item3-container input {
    background-color: #1E1E1E;
    width: 100%;
    height: 100%;
    border: none;
    color: white;
}

#item1-container input, #item2-container input, #item3-container input{
    font-size: 32px;
    font-weight: 500;
    border-radius: 12px;
    text-align: start;
}

.bottom-container {
    display: flex;
    margin-top: 40px;
    width: 100%;
    height: 10%;
    justify-content: space-between;
    align-items: center;
}

#pack-quantity {
    background-color: #1E1E1E;
    width: 45%;
    height: 65px;
    border: none;
    color: white;
    font-size: 32px;
    font-weight: 500;
    border-radius: 50px;
    text-align: center;
}

#boton-confirmar {
    background-color: #8BB481;
    height: 70px;
    color: white;
    border: 3px solid #393939;
    border-radius: 40px;
    font-family: 'Outfit', sans-serif;
    font-weight: bold;
    font-size: 24px;
    cursor: pointer;
    position: relative;
    z-index: 1;
    width: 100%;
}

#buton-container-confirmar {
    width: 52%;
}
</style>
