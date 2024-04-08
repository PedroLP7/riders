<template>
    <div id="raiderForm">
        <div class="registration-container">
            <h1>Registrarse</h1>
            <p>Primero rellena los datos que necesitarás para el momento en el que inicies sesión</p>
            <form>
                <input  type="text" placeholder="Nombre de Usuario" />
                <input  type="password" placeholder="Contraseña" />
                <input  type="password" placeholder="Repite la Contraseña" />
                <button class="inputContainer" type="button">Siguiente paso</button>
            </form>
            <div class="social-login">
                <button type="button" class="google-login">Continuar con Google</button>
                <button type="button" class="facebook-login">Continuar con Facebook</button>
            </div>
            </div>
    </div>
  </template>
  
  <style scoped>
  .registration-container {
    background-color: #393939;
    color: white;
    padding: 2rem;
    border-radius: 8px;
    max-width: 400px;
    margin: auto;
  }

  .registration-container input {
  margin-bottom: 1rem;
  padding: 0.8rem;
  border: none;
  border-radius: 20px; 
  background-color: #333; 
  color: white;
}


  .inputContainer{
    border-radius: 40px;
  }
  
  .registration-container h1 {
    margin-bottom: 1rem;
  }
  
  .registration-container p {
    margin-bottom: 2rem;
    color: #aaa;
  }
  
  .registration-container form {
    display: flex;
    flex-direction: column;
  }
  
  .registration-container input {
    margin-bottom: 1rem;
    padding: 0.8rem;
    border: none;
    border-radius: 5px;
  }
  
  .social-login {
    display: flex;
    flex-direction: column;
  }
  
  .google-login,
  .facebook-login {
    margin-bottom: 1rem;
    padding: 0.8rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .google-login {
    background-color: #db4437;
    color: white;
  }
  
  .facebook-login {
    background-color: #4267b2;
    color: white;
  }
  
  button {
    background-color: #4caf50;
    border: none;
    padding: 1rem;
    color: white;
    text-transform: uppercase;
    border-radius: 5px;
    cursor: pointer;
  }
  
  button:hover {
    opacity: 0.8;
  }
  </style>
  