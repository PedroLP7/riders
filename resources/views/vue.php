<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../resources/css/styles.css">
  <title>Registro de Riders</title>
</head>
<body>
  <div id="app" class="container-fluid">
    <app-container></app-container>
  </div>
  <script src="https://unpkg.com/vue@2.6.12/dist/vue.js"></script>
  <script>
    Vue.component('app-container', {
      template: `
        <div class="app-container">
          <div class="row">
            <header class="col-12">
              <nav class="navbar justify-content-between">
                <a id="quienes" class="hyperlink" href="#quienes-somos">Quiénes somos?</a>
                <a id="sesion" class="hyperlink" @click="login" href="#iniciar-sesion">Iniciar Sesión</a>
              </nav>
            </header>
          </div>
          <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <main class="col-12 text-center">
              <h1 id="titulo">Food</h1>
              <h2 id="subtitulo">Una red de solidaridad</h2>
              <div class="button-container d-inline-block">
                <button id="register" @click="registrateRider">Regístrate Rider</button>
                <!-- Manteniendo el segundo botón, ajustado para trabajar con Bootstrap -->
                <div id="sombraBoton" @click="registrateRider"></div>
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
        },
        login() {
          window.location.href = '/riders/public/index';
        }
      }
    });

    new Vue({
      el: '#app'
    });
  </script>
</body>
</html>
