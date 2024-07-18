<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aprendiz</title>
    <link rel="stylesheet" href="./css/funcionario/inicio.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js"></script>
  </head>
  <body>
    <nav class="nav">
      <div class="sena">
        <img src="./imagenes/funcionario/logoSena.png" />Funcionario
      </div>
      <div class="menu">
        <div>
          <span class="material-icons-sharp">home</span>
          <p>Inicio</p>
        </div>
      </div>
      <div class="menu">
        <div>
          <span class="material-icons-sharp">description</span>
          <p>Mis Registros</p>
        </div>
      </div>
      <div class="menu">
        <div>
          <span class="material-icons-sharp">question_mark</span>
          <p>Soporte</p>
        </div>
      </div>
      <div class="menu">
        <div>
          <span class="material-icons-sharp">supervisor_account</span>
          <p>Usuarios</p>
        </div>
      </div>
    </nav>
    <div class="body">
      <header class="header">
        <div class="title">
          <p>Control de Registro</p>
        </div>
        <div class="perfil">
          <span class="material-icons-sharp" id="perfil">account_circle</span>
          <div id="perfilMenu" class="perfilMenu">
            <div class="perfilIcon">
              <div>
                <span class="material-icons-sharp">account_circle</span>
                <button class="btnBlue">Cambiar foto</button>
              </div>
              
              <div class="nameUser">
                <h2>USER</h2>
                <h5>user@gmail.com</h5>
              </div>
           
            </div>

            <div class="userData">
              <div>
                <h4>Primer nombre</h4>
                <h5>username</h5>
              </div>
              <div>
                <h4>Segundo nombre</h4>
                <h5>username2</h5>
              </div>
              <div>
                <h4>Primer aprellido</h4>
                <h5>userlastname</h5>
              </div>
              <div>
                <h4>Segundo apellido</h4>
                <h5>userlastname2</h5>
              </div>
              <div>
                <h4>N°Documento</h4>
                <h5>90129733</h5>
              </div>
            </div>
            <h3 style="text-align: center;">Datos Medicos</h3>
            <div class="userData">
              <div>
                <h4>EPS</h4>
                <h5>epsname</h5>
              </div>
              <div>
                <h4>RH</h4>
                <h5>o+</h5>
              </div>
              <div>
                <h4>Contacto de Emergencia</h4>
                <h5>100000</h5>
              </div>
              <div>
                <h4>Enfermedades</h4>
                <h5>N/A</h5>
              </div>
              <div>
                <h4>Alergias</h4>
                <h5>N/A</h5>
              </div>
            </div>

            <div class="userEnd">
              <button class="btnBlue">Actualizar mis datos</button>
              <button class="btnRed">Cerrar sesion</button>
            </div>
            
          </div>
        </div>
      </header>
      <main class="main">
        <div class="mainLayout">
          <div class="options"></div>
          <div class="calendar" id="calendar"></div>
        </div>
        <div class="description">
          <div class="titleDescription">
            <h2>JUEVES</h2>
            <h3>04/01/23</h3>
          </div>
          <div class="mainDescription">
            <div class="textDescription">
              <h3>HORA INGRESO:</h3>
              <h4 style="color: #20CA9A;">1:00 PM</h4>
            </div>
            <div class="textDescription">
              <h3>HORA SALIDA</h3>
              <h4 style="color: #1BA1EB;">5:45 PM</h4>
            </div>
            <div class="observacion">
              <h3>OBSERVACIONES:</h3>
              <h5>Este es un ejemplo de las observaciones que puede llegar a tener algun usuario de esta aplicacion ignorar...</h5>
            </div>
          </div>
     

        </div>
      </main>
    </div>

    <script src="./js/funcionario/inicio.js"></script>
    <script>

    </script>
  </body>
</html>
