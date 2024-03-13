<template>
    <nav id="navContainer">
        <ul>
            <div class="menu-indicator homepage-indicator" :style="{ left: positionToMove, width: sliderWidth }"></div>
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
                currentPageId: 1,
                links: [
                    // rider data
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
                    },

                    // provider data
                    {
                        id: 5,
                        icon: "home",
                        text: "Inicio",
                    },
                    {
                        id: 6,
                        icon: "track",
                        text: "Track",
                    },
                    {
                        id: 7,
                        icon: "profile",
                        text: "Profile",
                    },
                ]
            }
        },

        methods: {
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

            riderHomeRoute() {
                window.location.href = "/riders/public/rider/home";
            },
            riderSearchRoute() {
                window.location.href = "/riders/public/rider/search";
            },
            riderSavedRoute() {
                window.location.href = "/riders/public/rider/saved";
            },
            riderProfileRoute() {
                window.location.href = "/riders/public/rider/profile";
            },
            providerHomeRoute() {
                window.location.href = "/providers/public/provider/home";
            },
            providerTrackRoute() {
                window.location.href = "/providers/public/provider/track";
            },
            providerProfileRoute() {
                window.location.href = "/providers/public/provider/profile";
            }
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

