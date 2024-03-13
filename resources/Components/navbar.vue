<template>
    <nav id="navContainer">
        <ul>
            <div class="menu-indicator homepage-indicator" :style="{ left: positionToMove, width: sliderWidth }"></div>
            <li v-for="link in filteredLinks" :key="link.id" @click="sliderIndicator(link.id)" :ref="'menu-item_' + link.id" class="menu-item">
                <a href="#" class="menu-link">
                    <i class="menu-icon" :class="link.icon"></i>
                    <span>{{ link.text }}</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            usuario: {},
            type: {},
            sliderPosition: 0,
            selectedElementWidth: 0,
            selectedIndex: 0,
            currentPageId: 1,
            links: [
                // rider data
                {
                    id: 1,
                    icon: "home",
                    text: "Inicio",
                    userType: [2]
                },
                {
                    id: 2,
                    icon: "search",
                    text: "Buscar",
                    userType: [2]
                },
                {
                    id: 3,
                    icon: "pin",
                    text: "Guardados",
                    userType: [2]
                },
                {
                    id: 4,
                    icon: "profile",
                    text: "Perfil",
                    userType: [2]
                },

                // provider data
                {
                    id: 5,
                    icon: "home",
                    text: "Inicio",
                    userType: [3]
                },
                {
                    id: 6,
                    icon: "track",
                    text: "Track",
                    userType: [3]
                },
                {
                    id: 7,
                    icon: "profile",
                    text: "Profile",
                    userType: [3]
                },
            ]
        }
    },

    created() {
        this.checkUser();
    },

    methods: {
        checkUser() {
            const me = this;

            axios.get('/usuario/getUsuario')
                .then(response => {
                    console.log(response)
                    me.usuario = response.data

                    axios.get('/usuario/getUsuarioType/' + me.usuario)
                        .then(response => {
                            console.log(response)
                            me.type = response.data

                        })
                        .catch(error => {
                            console.error('Error fetching user type', error);
                        });

                })
                .catch(error => {
                    console.error('Error fetching bookingD data', error);
                });
        },

        sliderIndicator(id) {
            let el = this.$refs['menu-item_' + id][0];
            this.sliderPosition = el.offsetLeft;
            this.selectedElementWidth = el.offsetWidth;
            this.selectedIndex = id;
            this.currentPageId = id;

            if (id === 1) {
                this.homeRoute();
            } else if (id === 2) {
                this.searchRoute();
            } else if (id === 3) {
                this.savedRoute();
            } else if (id === 4) {
                this.profileRoute();
            } else if (id === 5) {
                this.providerHomeRoute();
            } else if (id === 6) {
                this.providerTrackRoute();
            } else if (id === 7) {
                this.providerProfileRoute();
            }
        },

        // Define tus métodos para rutas aquí

    },

    computed: {
        positionToMove() {
            return this.sliderPosition + "px";
        },
        sliderWidth() {
            return this.selectedElementWidth + "px";
        },
        isHomePage() {
            return this.currentPageId === 1;
        },
        filteredLinks() {
            const userType = this.type.user_type_id; // Suponiendo que aquí tienes el user_type_id

            return this.links.filter(link => {
                return link.userType.includes(userType);
            });
        }
    }
}
</script>

<style>
    :root {
    --background-color: #000000;
    --text-selected: #000000;
    --text-unselected: #8F8F8F;
    --accent-color: #8BB481;
    }

    #navContainer {
        height: 65px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--background-color);
        overflow: hidden;
        border-radius: 50px;
    }
    #navContainer ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    .menu-indicator {
    position: absolute;
    height: 50px;
    width: 140px;
    border-radius: 50px;
    background-color: var(--accent-color);
    transition: all ease 0.5s;
    }

    .menu-indicator.homepage-indicator {
        opacity: 1; /* Always visible on homepage */
    }

    .menu-item {
        display: inline-flex;
    }

    #navContainer li:hover {
        cursor: pointer;
    }

    #navContainer li a {
        display: block;
        color: var(--text-unselected);
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    </style>

