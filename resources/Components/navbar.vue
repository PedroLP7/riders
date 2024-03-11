<template>
    <nav id="navContainer">
        <ul>
            <div class="menu-indicator" :style="{ left: positionToMove, width: sliderWidth }"></div>
            <li class="menu-item" v-for="link in links" :key="link.id" @click="sliderIndicator(link.id)" :ref="'menu-item_' + link.id">
                <a href="#" class="menu-link">
                    <i class="menu-icon" :class="link.icon"></i>
                    <span>{{ link.text }}</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                sliderPosition: 0,
                selectedElementWidth: 0,
                selectedIndex: 0,
                links: [
                    {
                        id: 1,
                        icon: "home",
                        text: "Inicio",
                    },
                    {
                        id: 2,
                        icon: "search",
                        text: "Buscar",
                    },
                    {
                        id: 3,
                        icon: "pin",
                        text: "Guardados",
                    },
                    {
                        id: 4,
                        icon: "profile",
                        text: "Perfil",
                    }
                ]
            }
        },

        methods: {
            sliderIndicator(id) {
                let el = this.$refs['menu-item_' + id][0];
                this.sliderPosition = el.offsetLeft;
                this.selectedElementWidth = el.offsetWidth;
                this.selectedIndex = id;

                if (id === 1) {
                    this.homeRoute();
                } else if (id === 2) {
                    this.searchRoute();
                } else if (id === 3) {
                    this.savedRoute();
                } else if (id === 4) {
                    this.profileRoute();
                }
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
        },

        computed: {
            positionToMove() {
                return this.sliderPosition + "px";
            },
            sliderWidth() {
                return this.selectedElementWidth + "px";
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

