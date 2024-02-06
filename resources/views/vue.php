<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../resources/css/styles.css">
  <title>Registro de Riders</title> 
</head>
<body>
  <div id="app">
    <app-container></app-container>
  </div> 
  <script src="https://unpkg.com/vue@2.6.12/dist/vue.js"></script>
  <script>
    Vue.component('app-container', {
      template: `
        <div class="app-container">
          <header class="header">
            <nav>
              <div>
                <a id="quienes" class="hyperlink" href="#quienes-somos">Quiénes somos?</a>
                <a id="sesion" class="hyperlink" href="#iniciar-sesion">Iniciar Sesión</a>
              </div>               
            </nav>
          </header>
          <main class="main">
            <div>
            <h1 id="titulo">FoodLink</h1>
            <h2 id="subtitulo">Una red de solidaridad</h2>
            </div>
            
            <div class="button-container">
            <button id="register"@click="registrateRider">Regístrate Rider</button>
            <button id="sombraBoton" @click="registrateRider">Regístrate Rider</button>
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
      `,
      methods: {
        registrateRider() {
          alert('Registro para Rider!');
        },
        registroEmpresa() {
          alert('Registro para Empresas!');
        },
        registroComedor() {
          alert('Registro para Comedores Sociales!');
        }
      }
    });

    new Vue({
      el: '#app'
    });
  </script>
</body>
</html>
