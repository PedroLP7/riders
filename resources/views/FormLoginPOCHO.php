<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../resources/css/styles.css">
  <title>Iniciar Sesión</title>
</head>
<body class="landing">
  <div id="app" class="container-fluid">
    <login-container></login-container>
  </div>
  <script src="https://unpkg.com/vue@2.6.12/dist/vue.js"></script>
  <script>
    Vue.component('login-container', {
      template: `
        <div class="app-container">
          <div class="row">
            <!-- Aquí puedes agregar una barra de navegación o cabecera si es necesario -->
          </div>
          <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-6 col-sm-8 col-xs-12">
              <div class="login-container" @submit.prevent="submitForm">
                <button class="back-button">←</button>
                <h1>Iniciar Sesión</h1>
                <div class="input-wrapper">
                  <input type="text" placeholder="Nombre de Usuario" required />
                </div>
                <div class="input-wrapper">
                  <input type="password" placeholder="Contraseña" required />
                </div>
                <a href="#" class="forgot-password">Has olvidado la contraseña?</a>
                <button type="submit" class="login-button">Iniciar Sesión</button>
                <div class="social-login">
                  <button class="google-button">Continuar con Google</button>
                  <button class="facebook-button">Continuar con Facebook</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      `,
      data() {
        return {
          
        };
      },
      methods: {
        goBack() {
        
        },
        submitForm() {         
          alert('Formulario de inicio de sesión enviado!');
        }
      },
      mounted() {      
      }
    });

    new Vue({
      el: '#app'
    });
  </script>
</body>
</html>
