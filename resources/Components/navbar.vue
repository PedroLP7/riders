<template>
    <nav id="navContainer">
        <ul>
            <li><a @click="homeRoute">Inicio</a></li>
            <li><a @click="searchRoute" >Buscar</a></li>
            <li><a @click="savedRoute">Guardados</a></li>
            <li><a @click="profileRoute">Perfil</a></li>
        </ul>
    </nav>
</template>

<script>
    export default {
        methods: {
            homeRoute() {
                window.location.href = "/riders/public/rider/home";
            },
            searchRoute() {
                window.location.href = "/riders/public/rider/search";
            },
            savedRoute() {
                window.location.href = "/riders/public/rider/saved";
            },
            profileRoute() {
                window.location.href = "/riders/public/rider/profile";
            }
        }
    }
</script>

<style scoped>
    #navContainer {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #333;
        overflow: hidden;
    }
    #navContainer ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }
    #navContainer li {
        float: left;
    }
    #navContainer li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    #navContainer li a:hover {
        background-color: #111;
    }
</style>

