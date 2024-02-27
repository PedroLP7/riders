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
            <main class="col-12 text-center" v-if="!showRiderForm">
              <h1 id="titulo">Food</h1>
              <h2 id="subtitulo">Una red de solidaridad</h2>
              <div class="button-container d-inline-block">
                <button id="register" @click="registrateRider">Regístrate Rider</button>
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
            <div v-if="showRiderForm" class="col-md-6 offset-md-3">
              <h3>Registro para Rider</h3>
              <form @submit.prevent="submitRiderForm">
                <div class="form-group">
                  <label for="userName">User Name</label>
                  <input type="text" class="form-control" id="userName">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                  <label for="dni">DNI</label>
                  <input type="text" class="form-control" id="dni">
                </div>
                <div class="form-group">
                  <label for="realName">Real Name</label>
                  <input type="text" class="form-control" id="realName">
                </div>
                <div class="form-group">
                  <label for="surname1">Apellido 1</label>
                  <input type="text" class="form-control" id="surname1">
                </div>
                <div class="form-group">
                  <label for="surname2">Apellido 2</label>
                  <input type="text" class="form-control" id="surname2">
                </div>
                <div class="form-group">
                  <label for="mail">Correo Electrónico</label>
                  <input type="email" class="form-control" id="mail">
                </div>
                <div class="form-group">
                  <label for="phoneNumber">Número de Teléfono</label>
                  <input type="tel" class="form-control" id="phoneNumber">
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
                <button type="button" class="btn btn-secondary" @click="showRiderForm = false">Cancelar</button>
              </form>
            </div>
          </div>
        </div>
      `,
      data() {
        return {
          showRiderForm: false
        };
      },
      methods: {
        registrateRider() {
          this.showRiderForm = true;
        },
        registroEmpresa() {
          alert('Registro para Empresas!');
        },
        registroComedor() {
          alert('Registro para Comedores Sociales!');
        },
        login() {
          window.location.href = '/riders/public/index';
        },
        submitRiderForm() {
          // Aquí deberías implementar la lógica para manejar el envío del formulario.
          alert('Formulario enviado!');
          this.showRiderForm = false;
        }
      }
    });

    new Vue({
      el: '#app'
    });
  </script>
</body>
</html>
