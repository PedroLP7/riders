<template>
    <div>        
        <h3 id="titulo">Editar</h3>     
        <div class="card">
          <div class="card-body">
            <div class="form-group row px-5">
              <div class="col-sm-10">
                <input type="text"  class="form-control" id="item1" name="user_name" v-model="user.user_name">
              </div>
            </div>
            <div class="form-group row mt-4 px-5">
              <div class="col-sm-10">
                <input type="text" class="form-control" id="real_name" name="real_name" v-model="user.real_name" >           
              </div>
            </div>
            <div class="form-group row mt-4 px-5">
              <div class="col-sm-10">
                <input type="text" class="form-control" id="cif" name="cif" v-model="user.dni_cif" >       
              </div>
            </div>
            <div class="form-group row mt-4 px-5">
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="adress" name="adress" v-model="user.rider.surname1">     
                </div>
              </div>
              <div class="form-group row mt-4 px-5">
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="adress" name="adress" v-model="user.rider.surname2">     
                </div>
            </div>
            <div class="form-group row mt-4 px-5">
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="adress" name="adress" v-model="user.rider.mail">
                </div>
            </div>
            <div class="form-group row mt-4 px-5">
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="adress" name="adress" v-model="user.rider.phone_number">

                </div>
            </div>
            <div class="button-container d-inline-block">
                <button id="signIn" @click="updateRider()">Confirmar cambios</button>
                <button id="signIn" @click="goBack()" type="button">Atras</button>              
            </div>
          </div>
        </div>
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
        getRider() {
            const me = this;
            const idUser = me.userp.id_user
            axios.get('rider/' + idUser)
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

                    me.getRider()
                })
                .catch(error => {
                    console.log(error)
                })
        },

        goBack(){
            window.location.href = "/riders/public/rider/profile";
        },
        updateRider(){
            const me = this;
            const data ={
                user_name: me.user.user_name,
                dni_cif: me.user.dni_cif,
                real_name: me.user.real_name,
                surname1: me.user.rider.surname1,
                surname2: me.user.rider.surname2,
                mail: me.user.rider.mail,
                phone_number: me.user.rider.phone_number,
            }
            const idUser = me.userp.id_user
            axios.put('rider/' + idUser, data)
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
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');

* {
    font-family: "Outfit", sans-serif;
}

*::selection {
    background-color: #475941;
}

body {
    background-color: #1E1E1E;
}

.card {
    background-color: #393939;
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translate(-50%, 0);
    width: 100%;
    height: 80%;
    border: none;
    border-radius: 60px 60px 0 0;
    box-shadow: 0 -2px 26.9px 1px rgba(0, 0, 0, 0.17);
}

.card-title {
    background-color: transparent;
}

.card-body {
    background-color: transparent;
    margin-top: 7%;
}

.col-sm-10 {
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
}

.form-control {
    width: 90%;
    height: 50px;
    border-radius: 50px;
    border: none;
    background-color: #444444;
    line-height: 65px;
    padding-left: 40px;
    color: #8F8F8F;
    font-size: 17px;
    flex: 1;
}

.form-control::placeholder {
    line-height: 65px;
    color: #8F8F8F;
    opacity: 38%;
    font-size: 17px;
}

.form-control:focus {
    background-color: rgba(103, 127, 97, 0.17);
    color: #677F61;
    font-weight: 400;
    font-size: 17px;
    border: none;
    box-shadow: none;
    transition: 0.2s;
}

.field-icon {
    float: right;
    margin-left: -25px;
    margin-top: -25px;
    position: relative;
    z-index: 2;
    color: #a13232;
}

.eye-active, .eye-unactive {
    position: absolute;
    cursor: pointer;
    right: 15%;
    color: #1E1E1E;
}

.form-group row px-2 {
    background-color: transparent;
    height: 60px;
}

#titulo{
  color: #393939;
    font-weight: 680px;
    font-size: 66px;
    margin-top: 10%;
    margin-left: 7%;

}

#subtitulo{
    color: #8F8F8F;
    font-weight: 12px;
    font-size: 12px;
    margin-top: -97%;
    margin-left: 16%;
   
}

form h3 {
    color: #393939;
    font-weight: 700;
    font-size: 80px;
    margin-top: 10%;
    margin-left: 5%;
}

.button-container {
    position: fixed;
    display: inline-block;
    top: 87%;
    left: 50%;
    transform: translate(-50%, -50%);    
    max-width: 75%;
    min-width: 75%;
}

#signIn {    
    background-color: #8BB481;       
    max-width: 100%;
    min-width: 100%;
    height: 70px;
    color: white;    
    border: 3px solid #393939; 
    border-radius: 40px;
    font-family: 'Outfit', sans-serif;  
    font-weight: bold;  
    font-size: 20px;
    padding: 1rem 2rem;
    cursor: pointer;
    position: relative; 
    z-index: 1; 
    margin-bottom: 4%;
}

#sombraBoton {
    position: absolute;
    max-width: 100%;
    min-width: 100%;
    height: 70px;
    top: 0.15rem; 
    left: -0.15rem;
    background-color: #677F61;
    border-radius: 40px;
    z-index: -1;
    border: none;
}

.alert {
    border-radius: 0;
    display: flex;
    position: absolute;
    width: 100%;
    height: 3%;
    margin: 0;
    top: 0;
    left: 0;
    background: #E46962;   
    border: none;
    align-items: center;
    justify-content: center;
    color: #1E1E1E;
    font-weight: 500;
  }

  .alert-dismissible {
    padding-right: 0;
}

.progress-bar-container {
    height: 12px; 
    background-color: #555;   
    width: 100%; 
    position: relative;
}

.progress-bar {
    height: 100%; 
    background-color: #8BB481;    
}
  </style>
