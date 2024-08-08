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

$filters = [
  'fecha_desde' => $_GET['fecha_desde'] ?? null,
  'fecha_hasta' => $_GET['fecha_hasta'] ?? null,
  'numero_documento' => $_GET['numero_documento'] ?? null,
  'nombre' => $_GET['nombre'] ?? null,
  'apellido' => $_GET['apellido'] ?? null
];

$usuarios = $usuarioController->listUsuarios($_SESSION['id_usuario'], $filters);
?>

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aprendiz</title>
    <link rel="stylesheet" href="./css/funcionario/registros.css" />
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
        <a href="?vista=funcionario/inicio">
        <div>
          <span class="material-icons-sharp">home</span>
          <p>Calendario</p>
        </div>
        </a>

      </div>
      <div class="menu">
       <a href="?vista=funcionario/registros">
       <div style="background: rgb(0, 0, 0, 0.32);">
          <span class="material-icons-sharp">description</span>
          <p>Registros</p>
        </div>
      </div>
       </a>

      <div class="menu">
       <a href="?vista=funcionario/soporte"> <div>
          <span class="material-icons-sharp">question_mark</span>
          <p>Soporte</p>
        </div></a>
      </div>

      <div class="menu">
      <a href="?vista=funcionario/inicio">
      <div>
          <span class="material-icons-sharp">supervisor_account</span>
          <p>Usuarios</p>
        </div>
      </a>
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
        <form method="GET">
    <input type="text" name="numero_documento" placeholder="Número de documento">
    <input type="text" name="nombre" placeholder="Nombre">
    <input type="text" name="apellido" placeholder="Apellido">
    <input type="date" name="fecha_desde">
    <input type="date" name="fecha_hasta">
    <button type="submit">Filtrar</button>
</form>

<table>
    <thead>
        <tr>
            <th>Número de Documento</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha</th>
            <th>Hora Entrada</th>
            <th>Hora Salida</th>
            <th>Observación</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['numero_documento']; ?></td>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['apellido']; ?></td>
                <td><?php echo $usuario['fecha']; ?></td>
                <td><?php echo $usuario['hora_entrada']; ?></td>
                <td><?php echo $usuario['hora_salida']; ?></td>
                <td><?php echo $usuario['observacion']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
        </div>
   


        </div>
      </main>
    </div>

    <script src="./js/funcionario/registros.js"></script>
    <script>


    </script>
  </body>
</html>
