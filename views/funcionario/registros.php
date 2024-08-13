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
        <h1>Registros de Usuarios</h1>

<form id="filterForm"method="get" action="">
<input type="hidden" name="vista" value="funcionario/registros">
    <label for="numero_documento">Número de Documento:</label>
    <input type="text" id="numero_documento" name="numero_documento" value="<?= htmlspecialchars($_GET['numero_documento'] ?? '') ?>">
    <br>

    <label for="nombres">Nombre:</label>
    <input type="text" id="nombres" name="nombres" value="<?= htmlspecialchars($_GET['nombres'] ?? '') ?>">
    <br>

    <label for="apellidos">Apellido:</label>
    <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($_GET['apellidos'] ?? '') ?>">
    <br>

    <label for="fechaDesde">Fecha Desde:</label>
    <input type="date" id="fechaDesde" name="fechaDesde" value="<?= htmlspecialchars($_GET['fechaDesde'] ?? '') ?>">
    <br>

    <label for="fechaHasta">Fecha Hasta:</label>
    <input type="date" id="fechaHasta" name="fechaHasta" value="<?= htmlspecialchars($_GET['fechaHasta'] ?? '') ?>">
    <br>

    <button type="submit" >Filtrar</button>
    <button type="button" onclick="clearFilters()">Limpiar</button>
</form>

<table border="1">
    <thead>
        <tr>
        <th id="colDocumento">Documento <span class="material-icons-sharp">arrow_drop_down</span></th>
        <th id="colNombre">Nombre <span class="material-icons-sharp">arrow_drop_down</span></th>
        <th id="colApellido">Apellido <span class="material-icons-sharp">arrow_drop_down</span></th>
        <th id="colHoraEntrada">Hora Entrada <span class="material-icons-sharp">arrow_drop_down</span></th>
        <th id="colHoraSalida">Hora Salida <span class="material-icons-sharp">arrow_drop_down</span></th>
        <th id="colPerfil">Perfil</th>
        <th>Observacion</th>
        <th id="colFecha">Fecha <span class="material-icons-sharp">arrow_drop_down</span></th>
        </tr>
    </thead>
    <tbody>
      <?php
    function mostrarDato($dato) {
    return isset($dato) && !empty($dato) ? htmlspecialchars($dato) : 'N/A';
}

$usuarios = (new UsuarioController())->listUsuarios($_GET['numero_documento'] ?? null, $_GET['nombres'] ?? null, $_GET['apellidos'] ?? null, $_GET['fechaDesde'] ?? null, $_GET['fechaHasta'] ?? null);

if ($usuarios->num_rows > 0) {
    while ($usuario = $usuarios->fetch_assoc()) {
        $perfilUsuario = (new Usuarios())->obtenerPerfilUsuario($usuario['id']);
        ?>
        <tr onclick="mostrarModal(<?= $usuario['id'] ?>)">
            <td><?= mostrarDato($usuario['numero_documento']) ?></td>
            <td><?= mostrarDato($usuario['nombres']) ?></td>
            <td><?= mostrarDato($usuario['apellidos']) ?></td>
            <td><?= mostrarDato($usuario['hora_entrada']) ?></td>
            <td><?= mostrarDato($usuario['hora_salida']) ?></td>
            <td><?= mostrarDato($perfilUsuario['perfil'] ?? null) ?></td>
            <td><?= mostrarDato($usuario['observacion']) ?></td>
            <td><?= mostrarDato($usuario['fecha']) ?></td>
        </tr>

        <!-- Modal -->
        <div class="modal" id="modal-<?= $usuario['id'] ?>">
            <div class="modal-content">
                <span class="modal-close" onclick="ocultarModal(<?= $usuario['id'] ?>)">&times;</span>
                <div class="modal-header">
                    <h2><?= mostrarDato($usuario['nombres']) ?> <?= mostrarDato($usuario['apellidos']) ?></h2>
                    <div class="perfil">
                        <p>Perfil: <?= mostrarDato($perfilUsuario['perfil']) ?></p>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Correo: <?= mostrarDato($usuario['email']) ?></p>
                    <p>Teléfono: <?= mostrarDato($usuario['telefono']) ?></p>
                    <p>EPS: <?= mostrarDato($usuario['eps']) ?></p>
                    <p>Enfermedades: <?= mostrarDato($usuario['enfermedades']) ?></p>
                    <p>Alergias: <?= mostrarDato($usuario['alergias']) ?></p>
                    <p>RH: <?= mostrarDato($usuario['rh']) ?></p>
                    <p>Contacto de emergencia: <?= mostrarDato($usuario['contacto_emergencia']) ?></p>
                </div>
            </div>
        </div>
    <?php
    }
} else {
    echo "<tr><td colspan='7'>No se encontraron usuarios.</td></tr>";
}
?>
</tbody>
</table>

      </main>
    </div>

    <script src="./js/funcionario/registros.js"></script>
    <script>


    </script>
  </body>
</html>
