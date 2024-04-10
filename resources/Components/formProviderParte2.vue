<template>
    <div>
      
        <header>
          <div class="progress-bar-container">
            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="alerta" ref="alertContainer"></div>
        </header>
        <h3 id="titulo">Registrarse</h3>
        <h3 id="subtitulo">Ahora necesitamos saber un poco más de ti</h3>
        <div class="card">
          <div class="card-body">
            <div class="form-group row px-5">
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nombre" placeholder="Nombre empresa" v-model="provider.real_name">
              </div>
            </div>
            <div class="form-group row mt-4 px-5">
              <div class="col-sm-10">
                <input type="text" class="form-control" id="apellido1" placeholder="Direccion" v-model="provider.adress">
              </div>
            </div>           
            <div class="form-group row mt-4 px-5">
              <div class="col-sm-10">
                <input type="text" class="form-control" id="dni" placeholder="CIF" v-model="provider.dni_cif">
              </div>
            </div>
            <div class="button-container d-inline-block">
              <button id="submitParte2" @click="enviar" type="button">Siguiente paso</button>
              <button id="sombraBotonParte2" type="button"></button>
            </div>
          </div>
        </div>
      </div> 
</template>

<script>

export default { 
  data() {
    return {
      
      provider: {
        real_name: '',
        adress: '',       
        dni_cif: ''
      }
    };
  },
  methods: {
    enviar() {      
      this.$emit('actualizar-datos', this.provider);  
      this.$emit('enviar');   
    }
  }
};
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
    height: 50%;
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
    height: 75px;
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
    margin-top: -100%;
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

#submitParte2 {    
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
}

#sombraBotonParte2 {
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
  