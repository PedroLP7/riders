<template>
    <div>

        <h1>PACKS EN CAMINO</h1>

        <div class="card mt-3" style="width: 18rem;" >

            <div class="card-body">
                <h5 class="card-title">Menu en camino</h5>
                <img src="../images/menu.png" class="card-img-top" alt="imgmenu" id="imgmenu">
                <p class="card-text"> item1 inc
                    <br>
                    item 2 :inc JESUS
                    <br>
                    item 3 :inc
                    cantidad : inc {{ usuario }}
                </p>

            </div>
        </div>

    </div>
</template>
<script>
export default {
    props: {
    usuario: Number,

  },
    name: 'bookings',
    data() {
        return {

        }
    },
    created() {
        this.saludar()
    },
    methods: {
        saludar() {
            console.log('Hola desde el componente bookings')
        },
        getBookings() {


    }

},
}
</script>
<style>


</style>
