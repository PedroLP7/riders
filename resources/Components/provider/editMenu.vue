<template >
    <div>



        <form >

<div class="mb-3">
    <label for="user_name" class="form-item1">item1</label>
    <input type="text"  class="form-control" id="item1" name="user_name" v-model="menu.item1">
</div>

<div class="mb-3">
    <label class="form-label" for="real_name">Item2</label>
    <input type="text" class="form-control" id="real_name" name="real_name" v-model="menu.item2" >
</div>

<div class="mb-3">
    <label class="form-label" for="adress">Item3</label>
    <input type="text" class="form-control" id="adress" name="adress" v-model="menu.item3">
</div>


<!-- <div class="mb-3">
    <label class="form-label" for="adress">cantidad</label>
    <input type="text" class="form-control" id="adress" name="adress" v-model="menu.pivot.quantity">
</div> -->




<button  type="button"  class="btn btn-danger">Cancelar</button>
<button type="button"  class="btn btn-primary">Submit</button>






</form>








    </div>
</template>
<script>
export default {
    data() {
        return {
            idMenu: {},
            menu: {},
        };
    },
    methods: {

        getidMenu() {
            const me = this;
            const idMenu = document.getElementById('editMenu').getAttribute('data-id');
            console.log(me.idMenu);
            me.idMenu = idMenu;
        },
        getMenu() {
            const me = this;
            axios.get('charity_menu/' + me.idMenu)
                .then(function (response) {
                    console.log(response.data);
                    me.menu = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },




    created() {
        this.getidMenu();
        this.getMenu();
    }
};


</script>
<style >

</style>
