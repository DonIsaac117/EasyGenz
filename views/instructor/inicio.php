<?php
session_start();
$id_usuario = $_SESSION['id_usuario'];
require_once './controllers/usuariosController.php';

$usuarioController = new UsuarioController();

// Obtener los datos del usuario
$datosUsuario = $usuarioController->obtenerPerfilUsuario($id_usuario);

// Separar nombres y apellidos
$nombres = explode(' ', $datosUsuario['nombres']);
$primerNombre = $nombres[0];
$segundoNombre = isset($nombres[1]) ? $nombres[1] : 'N/A';

$apellidos = explode(' ', $datosUsuario['apellidos']);
$primerApellido = $apellidos[0];
$segundoApellido = isset($apellidos[1]) ? $apellidos[1] : 'N/A';

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calendario</title>
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
          <img src="./imagenes/funcionario/logoSena.png" />Instructor
      </div>
      <div class="menu">
        <a href="?vista=instructor/inicio">
        <div style="background: rgb(0, 0, 0, 0.32);">
          <span class="material-icons-sharp">home</span>
          <p>Calendario</p>
        </div>
        </a>

      </div>
      <div class="menu">
        <a href="?vista=instructor/ficha">
      <div>
      <span class="material-icons-sharp">description</span>
      <p>Ficha</p>
      </div>
      </div>
      </a>
      <div class="menu">
       <a href="?vista=instructor/soporte"> <div>
          <span class="material-icons-sharp">question_mark</span>
          <p>Soporte</p>
        </div></a>
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
                            <h2><?php echo $datosUsuario['nombres']; ?></h2>
                            <h5><?php echo $datosUsuario['email']; ?></h5>
                        </div>
                    </div>

                    <div class="userData">
                        <div>
                            <h4>Primer nombre</h4>
                            <h5><?php echo $primerNombre; ?></h5>
                        </div>
                        <div>
                            <h4>Segundo nombre</h4>
                            <h5><?php echo $segundoNombre; ?></h5>
                        </div>
                        <div>
                            <h4>Primer apellido</h4>
                            <h5><?php echo $primerApellido; ?></h5>
                        </div>
                        <div>
                            <h4>Segundo apellido</h4>
                            <h5><?php echo $segundoApellido; ?></h5>
                        </div>
                        <div>
                <h4>N°Documento</h4>
                <h5><?php echo isset($datosUsuario['numero_documento']) ? $datosUsuario['numero_documento'] : 'N/A'; ?></h5>
              </div>
              <div>
                <h4>Telefono</h4>
                <h5><?php echo isset($datosUsuario['telefono']) ? $datosUsuario['telefono'] : 'N/A'; ?></h5>
              </div>
            </div>
            <h3 style="text-align: center;">Datos Medicos</h3>
            <div class="userData">
              <div>
                <h4>EPS</h4>
                <h5><?php echo isset($datosUsuario['eps']) ? $datosUsuario['eps'] : 'N/A'; ?></h5>
              </div>
              <div>
                <h4>RH</h4>
                <h5><?php echo isset($datosUsuario['rh']) ? $datosUsuario['rh'] : 'N/A'; ?></h5>
              </div>
              <div>
                <h4>Contacto de Emergencia</h4>
                <h5><?php echo isset($datosUsuario['contacto_emergencia']) ? $datosUsuario['contacto_emergencia'] : 'N/A'; ?></h5>
              </div>
              <div>
                <h4>Enfermedades</h4>
                <h5><?php echo isset($datosUsuario['enfermedades']) ? $datosUsuario['enfermedades'] : 'N/A'; ?></h5>
              </div>
              <div>
                <h4>Alergias</h4>
                <h5><?php echo isset($datosUsuario['alergias']) ? $datosUsuario['alergias'] : 'N/A'; ?></h5>
              </div>
                    </div>

            <div class="userEnd">
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
            <h2></h2>
            <h3></h3>
          </div>
          <div class="mainDescription">
            <div class="textDescription">
              <h3>HORA INGRESO:</h3>
              <h4 style="color: #20CA9A;"></h4>
            </div>
            <div class="textDescription">
              <h3>HORA SALIDA:</h3>
              <h4 style="color: #1BA1EB;"></h4>
            </div>
            <div class="observacion">
              <h3>OBSERVACIONES:</h3>
              <h5 ><ul></ul></h5>
             
            </div>
          </div>


        </div>
      </main>
    </div>

    <script src="./js/instructor/inicio.js"></script>
    <script>


    </script>
  </body>
</html>
