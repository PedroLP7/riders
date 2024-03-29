<template>
    <button type="button" @click="goBack()" id="boton-cancelar-editar"></button>
    <div id="create-menu-container">
        <form id="create-form">
            <img src="../../images/menuEdit.png" id="createMenuImg" alt="imagen menu">
            <h1 id="pack-name">Nuevo Pack</h1>
            <p id="create-subtitle">Que vas a incluir en este pack?</p>

            <div id="items-container">
                <div class="mb-3 create-pack" id="item1-container">
                    <input type="text" v-model="menu.item1" class="form-control" id="item1" name="item1" placeholder="Item1">
                </div>

                <div class="mb-3 create-pack" id="item2-container">
                    <input type="text" class="form-control" id="item2" name="item2" v-model="menu.item2" placeholder="Item2">
                </div>

                <div class="mb-3 create-pack" id="item3-container">
                    <input type="text" class="form-control" id="item3" name="item3" v-model="menu.item3" placeholder="Item3">
                </div>
            </div>

            <div class="bottom-container">
                <input type="number" class="form-control" id="pack-quantity" name="quantity" v-model="menu.quantity" min="1" step="1" placeholder="nº Packs" required>
                
                <div class="button-container d-inline-block" id="buton-container-confirmar">
                    <button type="button" @click="createMenu()" class="btn btn-primary" id="boton-confirmar">Crear</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container" id="navbar">
        <navbar v-if="showComponente" />
    </div>
</template>
<script>
import axios from 'axios';
import navbar from '../../Components/navbar.vue'

export default {
    name: "createMenu",
    components: {
        navbar
    },
    data() {
        return {
            menu: {},
            provider_id:{},
            showComponente: true,
        };
    },
    methods: {

        createMenu() {
            const me = this;
            const requestData = {
        item1: me.menu.item1,
        item2: me.menu.item2,
        item3: me.menu.item3,
        quantity: me.menu.quantity,
        provider_id: me.provider_id.id_user,
    };

            console.log(me.menu);
            console.log(me.provider_id);
            axios.post('charity_menu',requestData)
            .then(response => {
                console.log(response.data)
                window.location.href = '/riders/public/provider/home'
            })
            .catch(error => {
                console.log(error)
            })
        },
        getidUser() {
        const me = this;

        axios.get('usuario/getUsuario')
            .then(response => {
                me.provider_id = response.data
                console.log(response.data)

            })
            .catch(error => {
                console.log(error)
            })
    },
    goBack() {
        window.location.href = '/riders/public/provider/home'

    }
    },

    created() {
        this.getidUser()
    }
}

</script>
<style>
#create-form {
    width: 100%;
    height: 100%;
}

#create-menu-container {
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

#createMenuImg {
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

#create-subtitle {
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

.mb-3 create-pack {
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

#item1 {
    overflow-wrap: break-word;
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

.form-control::placeholder {
    color: #88888890;
}

.form-control:focus {
    border-color: #8BB481;
    box-shadow: inset 0 0 4px #8bb481, 0 0 4px #8bb481;
    transition: ease-out 0.8s;
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

#boton-cancelar-editar {
    position: relative;
    right: 41%;
    top: 3%;
    width: 40px;
    height: 40px;
    background-image: url("../../images/mingcute_arrow-up-line.png");
    background-color: transparent;
    border: none;
}
</style>
