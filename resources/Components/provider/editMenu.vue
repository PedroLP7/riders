<template>
    <div id="edit-menu-container">
        <form>
            <div class="mb-3">
                <label for="item1" class="form-item1">item1</label>
                <input
                    type="text"
                    class="form-control"
                    id="item1"
                    name="item1"
                    v-model="menu.item1"
                />
            </div>

            <div class="mb-3">
                <label class="form-label" for="item2">Item2</label>
                <input
                    type="text"
                    class="form-control"
                    id="item2"
                    name="item2"
                    v-model="menu.item2"
                />
            </div>

            <div class="mb-3">
                <label class="form-label" for="item3">Item3</label>
                <input
                    type="text"
                    class="form-control"
                    id="item3"
                    name="item3"
                    v-model="menu.item3"
                />
            </div>

            <div class="mb-3">
                <label class="form-label" for="adress">cantidad</label>

                <input
                    type="text"
                    class="form-control"
                    id="quantity"
                    name="quantity"
                    v-model="cantidad.pivot.quantity"
                />
            </div>

            <button type="button" @click="goBack()" class="btn btn-danger">Cancelar</button>
            <button type="button" @click="updateMenu()" class="btn btn-primary">
                Submit
            </button>
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
#edit-menu-container {
    position: absolute;
    background-color: #000000;
    height: 75%;
    width: 90%;
    top: 10%;
    border-radius: 26px;
}
</style>
