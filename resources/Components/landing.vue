<template>
  <div class="app-container" id="landing">
    <div class="row">
      <header class="col-12">
        <nav class="navbar justify-content-between">
          <a id="quienes" class="hyperlink" href="#quienes-somos">Quiénes somos?</a>
          <a id="sesion" class="hyperlink" @click="login" href="#iniciar-sesion">Iniciar Sesión</a>
        </nav>
      </header>
    </div>
    <div id="logo"></div>
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
      <main class="col-12 text-center">
        <h1 id="titulo-food">Food</h1>
        <h1 id="link">Link</h1>
        <h1 id="barra"></h1>
        <h2 id="subtitulo">Una red de solidaridad</h2>
        <div class="button-container d-inline-block">
          <button id="register" @click="registrateRider">Regístrate Rider!</button>
          <button id="sombraBoton" @click="registrateRider">Regístrate Rider!</button>
        </div>
        <div class="collaboration">
          <div id="empresa">
            <p>¿Eres una empresa y quieres colaborar?</p>
            <a class="hyperlink" @click="registroEmpresa">Regístrate ahora!</a>
          </div>
          <div id="comedor">
            <p>¿Eres un comedor social?</p>
            <a class="hyperlink" @click="registroComedor">Regístrate ahora!</a>
          </div>
        </div>
      </main>   
      </div>
    </div>
  
</template>

<script>
export default {
  data() {
    return {  
      images: [
        'animacion/ManzanaAni1.png',
        'animacion/ManzanaAni2.png',
        'animacion/ManzanaAni3.png',
        'animacion/ManzanaAni4.png',
        'animacion/ManzanaAni5.png',
        'animacion/ManzanaAni6.png',
      ],
      currentImageIndex: 0,
      animationInterval: null
    }            
  },
  mounted() {
    this.startAnimation();
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
    startAnimation() {
      setInterval(() => {
        let nextImageIndex = this.currentImageIndex + 1;
        if (nextImageIndex >= this.images.length) {
          clearInterval(this.animationInterval);
          return;
        }
        this.currentImageIndex = nextImageIndex;
        this.updateLogo();
      }, 100); 
    },
    updateLogo() {
      const logo = document.getElementById('logo');
      logo.style.backgroundImage = `url(../../riders/resources/images/${this.images[this.currentImageIndex]})`;
    }
  }  
}
</script>