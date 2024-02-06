<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Riders</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }

    .app-container {
      text-align: center;
    }

    .header {
      background-color: #D6EADF;
      padding: 1rem;
      margin-bottom: 2rem;
    }

    .main button {
      background-color: #FFA500;
      border: none;
      padding: 1rem 2rem;
      margin-top: 1rem;
      cursor: pointer;
    }

    .main button:hover {
      background-color: #cc8400;
    }

    .collaboration {
      margin-top: 1rem;
    }

    .collaboration p {
      margin: 0;
    }

    .collaboration button {
      background-color: #00ADB5;
      color: white;
      margin-top: 0.5rem;
    }

    .collaboration button:hover {
      background-color: #007f87;
    }
  </style>
</head>
<body>
  <div id="app">
    <app-container></app-container>
  </div>

  <!-- Incluyendo Vue desde un CDN -->
  <script src="https://unpkg.com/vue@2.6.12/dist/vue.js"></script>
  <script>
    Vue.component('app-container', {
      template: `
        <div class="app-container">
          <header class="header">
            <nav>
              <ul>
                <li><a href="#quienes-somos">Quiénes somos?</a></li>
                <li><a href="#iniciar-sesion">Iniciar Sesión</a></li>
              </ul>
            </nav>
          </header>
          <main class="main">
            <h1>Título empresa de entrega de comida</h1>
            <button @click="registrateRider">Regístrate Rider!</button>
            
            <div class="collaboration">
              <div>
                <p>¿Eres una empresa y quieres colaborar?</p>
                <button @click="registroEmpresa">Regístrate ahora!</button>
              </div>
              <div>
                <p>¿Eres un comedor social?</p>
                <button @click="registroComedor">Regístrate ahora!</button>
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
