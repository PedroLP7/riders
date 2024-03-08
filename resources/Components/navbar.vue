<template>
    <nav id="navContainer" v-bind:class="active" v-on:click.prevent>
        <ul>
            <li id="homeButton" class="home"><a @click="homeRoute" v-on:click="makeActive('home')">Inicio</a></li>
            <li id="searchButton" class="search"><a @click="searchRoute" v-on:click="makeActive('search')">Buscar</a></li>
            <li id="savedButton" class="saved"><a @click="savedRoute" v-on:click="makeActive('saved')">Guardados</a></li>
            <li id="profileButton" class="profile"><a @click="profileRoute" v-on:click="makeActive('profile')">Perfil</a></li>
        </ul>
    </nav>
</template>

<script>
	// A DOM element to mount our view model.
	el: '#main',

    // This is the model.
	// Define properties and give them initial values.
	data; {
		active: 'home'
	}

    export default {
        methods: {
            makeActive: function(item){
			// When a model is changed, the view will be automatically updated.
			this.active = item;
		},
            
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
    nav.home .home,
    nav.search .search,
    nav.saved .saved,
    nav.profile .profile {
        background-color:#e35885;
    }

    #navContainer {
        height: 65px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #000000;
        overflow: hidden;
        border-radius: 50px;
    }
    #navContainer ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }
    #navContainer li {
        height: 50px;
        width: 140px;
        border-radius: 50px;
        float: left;
    }

    #navContainer li:hover {
        cursor: pointer;
    }

    #navContainer li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
</style>

