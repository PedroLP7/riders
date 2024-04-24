<template>
  <div class="app-container" id="landing">
    <div>
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
  
    <div>
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
          <div class="bienvenido-foodlink" style="text-align: left; margin-bottom: 100px;">
            <h2 class="section-heading">Bienvenido a FoodLink</h2>
            <p class="section-p">
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

          <div class="como-funciona-foodlink" style="text-align: right; margin-bottom: 100px;">
            <h2 class="section-heading">¿Cómo Funciona<br>FoodLink?</h2>
            <p class="section-p">
              Nuestra plataforma de vanguardia 
              está diseñada para conectar la 
              generosidad de los donantes con las 
              necesidades reales de la comunidad. 
              A través de una red solidaria de riders 
              voluntarios, aprovechamos los alimentos 
              excedentes de manera efectiva, los 
              recogemos y los distribuimos de manera 
              eficiente a aquellos que más lo necesitan.
            </p>
          </div>

          <div class="stats-container" style=" margin-bottom: 100px;">
            <div class="stat">
              <h3 class="counter-animate"><b>+</b>{{ activeUsers }}</h3>
              <p class="counter-p">usuarios activos</p>
            </div>
            <div class="stat">
              <h3 class="counter-animate"><b>+</b>{{ totalKg }}Kg</h3>
              <p class="counter-p">de comida salvados</p>
            </div>
          </div>

          <div class="nuestros-objetivos-foodlink" style="text-align: left; margin-bottom: 100px;">
            <h2 class="section-heading">Nuestros Objetivos</h2>
            <p class="section-p">
              <b>Reducción del Desperdicio Alimentario:</b>
              En FoodLink, cada entrega cuenta en 
              nuestra misión de combatir el 
              desperdicio alimentario, asegurando 
              que cada recurso se utilice de manera 
              significativa. <br> <br>

              <b>Apoyo a las Comunidades Vulnerables:</b>
              Nos dedicamos a proveer alimentos a 
              aquellos en situaciones de necesidad, 
              incluyendo personas sin hogar y 
              familias en riesgo de exclusión social. <br> <br>

              <b>Sensibilización Comunitaria:</b> Creamos 
              conciencia sobre la problemática del 
              desperdicio alimentario y la importancia 
              de la solidaridad en nuestra sociedad, 
              inspirando a otros a unirse a nuestra 
              causa. <br> <br>

              <b>Empoderamiento de Voluntarios:</b> En 
              FoodLink, ofrecemos a nuestros riders 
              voluntarios una plataforma donde pueden 
              contribuir de manera significativa, 
              sintiéndose parte de algo más grande 
              que ellos mismos.
            </p>
          </div>

        </section>
      </main>   
      </div>
    </div>
  
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {  
      showModal: false,    
      activeUsers: null,
      totalKg: null,
      scrolledToStats: false
    }            
  },

  created() {
    this.fetchActiveUsers();
    this.fetchTotalKg();
  },

  mounted() {   
    window.addEventListener('scroll', this.handleScroll);
  },

  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  },

  methods: {  
    handleScroll() {
      const statsSection = document.getElementById('quienes-somos-section');
      if (!statsSection || this.scrolledToStats) return;

      const statsSectionTop = statsSection.offsetTop;
      const windowHeight = window.innerHeight;
      const scrollY = window.scrollY || window.pageYOffset;

      // Si el usuario ha desplazado lo suficiente para que la sección de estadísticas esté visible
      if (scrollY + windowHeight >= statsSectionTop) {
        this.scrolledToStats = true;
        this.startCounterAnimation();
      }
    },

    toggleModal() {
      this.showModal = !this.showModal;
    }, 
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

    fetchActiveUsers() {
      const me = this;

      axios.get('admin/getActiveUsers')
      .then((response) => {
          console.log(response);
          me.activeUsers = response.data;
          console.log(response.data)
        })
      .catch((error) => {
          console.error("Error fetching data", error);
        });
    },

    fetchTotalKg() {
      const me = this;

      axios.get('admin/getTotalKg')
      .then((response) => {
          console.log(response);
          me.totalKg = response.data;
          console.log(response.data)
        })
      .catch((error) => {
          console.error("Error fetching data", error);
        });
    },

    startCounterAnimation() {
      const incrementValue = 10; // Valor por el que incrementar en cada paso
      const duration = 2000; // Duración total de la animación en milisegundos
      const steps = Math.ceil(duration / incrementValue); // Número de pasos

      let count = 0;
      const interval = setInterval(() => {
        count += incrementValue;
        if (count >= this.activeUsers) {
          count = this.activeUsers;
          clearInterval(interval);
        }
        this.activeUsersAnimated = count; // Actualiza el valor para mostrar en la animación
      }, incrementValue);

      let countKg = 0;
      const intervalKg = setInterval(() => {
        countKg += incrementValue;
        if (countKg >= this.totalKg) {
          countKg = this.totalKg;
          clearInterval(intervalKg);
        }
        this.totalKgAnimated = countKg; // Actualiza el valor para mostrar en la animación
      }, incrementValue);
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
  width: 85%;
  margin: 0 auto;
}

.modal-content {
    background-color: white;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    top: 63%;
    right: 4%;
    height: 230px;
    border-radius: 50px;
    width: 60px;
    position: fixed;
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

.circle-button {
    position: fixed;
    top:90%;  
    left: 82%;
    width: 60px;
    height: 60px;
    background-color: #007BFF;
    color: white;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 30px;
    cursor: pointer;
    z-index: 5100;
  }

  .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 5000;
  }

  /* .modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .modal-content a {
    display: block;
    margin: 10px 0;
  } */

  .close {
    position: absolute;
    top: 10px;
    right: 14px;
    font-size: 24px;
    cursor: pointer;
  }

  .counter-animate {
    transition: all 1s ease; /* Duración de la transición y función de aceleración */
    font-size: 96px;
    font-weight: bold;
    color: white;
    margin-bottom: -10px;
  }

  .counter-animate b {
    color: #8BB481;
  }

  .counter-p {
    font-size: 20px;
    font-weight: 500;
    color: #8F8F8F;
  }

  .section-heading {
    color: #8BB481;
    font-size: 36px;
    font-weight: bold;
  }

  .section-p {
    font-size: 20px;
    font-weight: 400;
    color: white;
  }

  .section-p b {
    font-weight: 600;
  }
</style>