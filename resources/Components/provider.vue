<template >
    <div>


<h1 id="titulo">Packs disponibles</h1>


        <div class="card" style="width: 18rem;">
  <img src="../images/menu.png" class="card-img-top" alt="imgmenu" id="imgmenu">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>

  </div>
</div>




<button class="btn btn-primary" type="button">Nuevo Menu</button>






    </div>
</template>
<script>
import axios from 'axios'

export default {
    data() {
        return {
            packs: []
        }
    },
    created() {
        this.getPacks()
    },
    methods: {
        getPacks() {
            axios.get('charity_menu')
                .then(response => {
                    this.packs = response.data
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }

}
</script>
<style >

</style>
