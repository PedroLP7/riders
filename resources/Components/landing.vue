<template>
  <div class="app-container" id="landing">
    <div class="row">
      <header class="col-12" style="margin-top: 5%;">
        <nav class="navbar justify-content-between">
          <a id="quienes" class="hyperlink" href="#quienes-somos-section">Quiénes somos?</a>
          <a id="sesion" class="hyperlink" @click="login" href="#iniciar-sesion">Iniciar Sesión</a>
        </nav>
      </header>
    </div>
    <div id="manzanita">
      <div class="image" style="background-image: url('../resources/images/animacion/ManzanaAni1.png');"></div>
      <div class="image" style="background-image: url('../resources/images/animacion/ManzanaAni2.png');"></div>
      <div class="image" style="background-image: url('../resources/images/animacion/ManzanaAni3.png');"></div>
      <div class="image" style="background-image: url('../resources/images/animacion/ManzanaAni4.png');"></div>
      <div class="image" style="background-image: url('../resources/images/animacion/ManzanaAni5.png');"></div>
      <div class="image" style="background-image: url('../resources/images/animacion/ManzanaAni6.png');"></div> 
    </div>
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
      <main class="col-12 text-center">
        <div>
        <h1 id="titulo-food">Food</h1>
        <h1 id="link">Link</h1>
        <div id="barra"></div>
        <h2 id="subtitulo">Una red de solidaridad</h2>
        </div>
        <div class="button-container d-inline-block">
          <button id="register" @click="registrateRider">Regístrate Rider!</button>
          <button id="sombraBoton" @click="registrateRider">Regístrate Rider!</button>
        </div>
        <div class="collaboration">
          <div id="empresa">
            <p>¿Eres una empresa y quieres colaborar?</p>
            <a class="hyperlink" @click="registroEmpresa">Regístrate ahora!</a>
          </div>
          <!-- <div id="comedor">
            <p>¿Eres un comedor social?</p>
            <a class="hyperlink" @click="registroComedor">Regístrate ahora!</a>
          </div> -->
        </div>

        <section id="quienes-somos-section">
          <div class="bienvenido-foodlink">
            <h2>Bienvenido a FoodLink</h2>
            <p>
              En FoodLink, no solo estamos 
              construyendo una plataforma, estamos 
              forjando un movimiento hacia un mundo 
              más justo y sostenible. Imagina un lugar 
              donde cada acción cuenta, donde cada 
              entrega de alimentos no solo reduce el 
              desperdicio, sino que también alimenta
              la esperanza y fortalece los lazos 
              comunitarios.
            </p>
          </div>
        </section>
      </main>   
      </div>
    </div>
  
</template>

<script>
export default {
  data() {
    return {      
    }            
  },
  mounted() {   
  },
  methods: {   
    registrateRider() {
      this.fadeOutRegisterButton();      
      window.location.href = "/riders/public/riderForm";

    },
    registroEmpresa() {     
      window.location.href = "/riders/public/providerForm";    
    },
    registroComedor() {      
      window.location.href = "/riders/public/kitchenForm";
    },
    login() {
      window.location.href = "/riders/public/usuario/create";
    },    
    fadeOutRegisterButton() {

      const registerBtn = document.getElementById('register');
      registerBtn.classList.add('disappear');
    },
  }  
}
</script>

<style scoped>
#manzanita {
  position: absolute;
  background-repeat: no-repeat;
  background-size: contain;
  top: 26%;
  left: 49%;
  transform: translate(-50%, -50%);
  width: 280px;
  height: 280px;
}

.image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  opacity: 0; /* Inicia todas las imágenes con opacidad 0 */
  animation: slideshow 1s steps(1) forwards; /* Aplica la animación a todas las imágenes */
}

@keyframes slideshow {
  /* Define un único conjunto de keyframes */
  0%, 100% { opacity: 0; }
  16.6%, 33.3% { opacity: 1; }
  33.4%, 100% { opacity: 0; }
}

/* Ajusta los delays para cada imagen de manera que solo la última permanezca visible */
.image:nth-child(1) { animation-delay: 0s; }
.image:nth-child(2) { animation-delay: 0.166s; }
.image:nth-child(3) { animation-delay: 0.332s; }
.image:nth-child(4) { animation-delay: 0.498s; }
.image:nth-child(5) { animation-delay: 0.664s; }
.image:nth-child(6) {
  animation-delay: 0.83s;
  animation: lastImage 1s steps(1) forwards; 
}

@keyframes lastImage {
  0%, 83% { opacity: 0; }
  83.1%, 100% { opacity: 1; } /* Solo hace visible la última imagen al final */
}

#quienes-somos-section {
  position: relative;
  top: 100vh;
}

@media (min-width: 1024px) { 
  #manzanita {
  position: relative;
  background-repeat: no-repeat;
  background-size: contain;
  top: 70%;
  left: 70%;
  transform: translate(-50%, -50%);
  width: 340px;
  height: 340px;
}
 

}
</style>