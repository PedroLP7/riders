<template>
    <div>

        <form >

            <div class="mb-3">
                <label for="user_name" class="form-label">Username</label>
                <input type="text"  class="form-control" id="item1" name="user_name" v-model="user.user_name">
            </div>
            <div class="mb-3">
                <label class="form-label" for="cif">cif</label>
                <input type="text" class="form-control" id="cif" name="cif" v-model="user.dni_cif" >
            </div>
            <div class="mb-3">
                <label class="form-label" for="real_name">real_name</label>
                <input type="text" class="form-control" id="real_name" name="real_name" v-model="user.real_name" >
            </div>
            <!-- <div class="mb-3">
                <label class="form-label" for="imgProfile">imgProfile</label>
                <input type="file" class="form-control" id="imgProfile" name="imgProfile">
            </div> -->
            <div class="mb-3">
                <label class="form-label" for="adress">Adress</label>
                <input type="text" class="form-control" id="adress" name="adress" v-model="user.provider.adress">
            </div>


            <button  type="button" @click="goBack()"  class="btn btn-danger">Cancelar</button>
            <button type="button" @click="updateProvider()"  class="btn btn-primary">Submit</button>






        </form>

    </div>
</template>
<script>
export default {
    name: 'editProfile',
    components: {


    },
    data() {
        return {
            user: {},

            showComponente: true,

            userp: {},

        }
    },
    created() {
        this.getidUser()

    },
    methods: {
        getProvider() {
            const me = this;
            const idUser = me.userp.id_user
            axios.get('provider/' + idUser)
                .then(response => {
                    me.user = response.data
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
                    me.userp = response.data
                    // console.log(response.data)
                    // console.log(me.userp.id_user);

                    me.getProvider()
                })
                .catch(error => {
                    console.log(error)
                })
        },

        goBack(){
            window.location.href = "/riders/public/provider/profile";
        },
        updateProvider(){
            const me = this;
            const data ={
                user_name: me.user.user_name,
                dni_cif: me.user.dni_cif,
                real_name: me.user.real_name,
                adress: me.user.provider.adress
            }
            const idUser = me.userp.id_user
            axios.put('provider/' + idUser, data)
                .then(response => {
                    console.log(response.data)
                    me.goBack()
                })
                .catch(error => {
                    console.log(error)
                })

        }


    },


}
</script>
<style>
.ocultar {
    display: none;

}

#profileimg{
    width: 100px;
    height: 100px;

}


.form-label{
    color: aliceblue   ;
}


</style>

