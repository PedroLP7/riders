<template>
    <div>

        <form action="{{ action([App\Http\Controllers\CustomerController::class, 'store']) }}" method="POST">


            <div class="mb-3">
                <label for="item1" class="form-item1">item1</label>
                <input type="text" v-model="menu.item1" class="form-control" id="item1" name="item1">
            </div>
            <div class="mb-3">
                <label class="form-label" for="item2">item2</label>
                <input type="text" class="form-control" id="item2" name="item2" v-model="menu.item2">
            </div>
            <div class="mb-3">
                <label class="form-label" for="item3">item3</label>
                <input type="text" class="form-control" id="item3" name="item3" v-model="menu.item3">
            </div>
            <div class="mb-3">
                <label class="form-label" for="quantity">quantity</label>
                <input type="text" class="form-control" id="quantity" name="quantity" v-model="menu.quantity" >
            </div>

            <button type="button" @click="createMenu()" class="btn btn-primary">Submit</button>
        </form>






    </div>
</template>
<script>
import axios from 'axios';

export default {
    name: "createMenu",
    data() {
        return {
            menu: {},
            provider_id:{},





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
        provider_id: me.provider_id
    };

            console.log(me.menu);
            console.log(me.provider_id);
            axios.post('charity_menu',requestData)
            .then(response => {
                console.log(response.data)
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
                // console.log(response.data)

            })
            .catch(error => {
                console.log(error)
            })
    },

    },

    created() {
        this.getidUser()
    }
}

</script>
<style></style>
