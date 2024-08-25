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
  <title>Registros</title>
  <link rel="stylesheet" href="./css/funcionario/registros.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
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
      <a href="?vista=funcionario/soporte">
        <div>
          <span class="material-icons-sharp">question_mark</span>
          <p>Soporte</p>
        </div>
      </a>
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
  <span class="material-icons-sharp" id="perfilIcon">account_circle</span>
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
        <h4>Teléfono</h4>
        <h5><?php echo isset($datosUsuario['telefono']) ? $datosUsuario['telefono'] : 'N/A'; ?></h5>
      </div>
    </div>
    <h3 style="text-align: center;">Datos Médicos</h3>
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
      <button class="btnRed">Cerrar sesión</button>
    </div>
  </div>
</div>
    </header>
    <main class="main">
      <div class="mainLayout">

        <form id="filterForm" method="get" action="">
          <input type="hidden" name="vista" value="funcionario/registros">
         <div class="divInput">
          <label for="numero_documento">N°Documento:</label>
          <input type="text" id="numero_documento" class="filter-input" name="numero_documento"
            value="<?= htmlspecialchars($_GET['numero_documento'] ?? '') ?>">
          

          <label for="nombres">Nombres:</label>
          <input type="text" id="nombres" class="filter-input" name="nombres" value="<?= htmlspecialchars($_GET['nombres'] ?? '') ?>">
       

          <label for="apellidos">Apellidos:</label>
          <input type="text" id="apellidos" class="filter-input" name="apellidos" value="<?= htmlspecialchars($_GET['apellidos'] ?? '') ?>">
          </div>

          <div class="divInput">
          <label for="fechaDesde">Fecha Desde:</label>
          <input type="date" id="fechaDesde" class="filter-input" name="fechaDesde"
            value="<?= htmlspecialchars($_GET['fechaDesde'] ?? '') ?>">
      

          <label for="fechaHasta">Fecha Hasta:</label>
          <input type="date" id="fechaHasta" class="filter-input" name="fechaHasta"
            value="<?= htmlspecialchars($_GET['fechaHasta'] ?? '') ?>">
         

          <button type="submit">Filtrar</button>
          <button type="button" onclick="clearFilters()">Limpiar</button>
          </div>
        </form>
        <button id="downloadPDF" onclick="generatePDF()">Descargar PDF</button>
      <div class="table-container">
        <table border="1" id="tabla">
          <thead>
            <tr class="sticky">
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
            function mostrarDato($dato)
            {
              return isset($dato) && !empty($dato) ? htmlspecialchars($dato) : 'N/A';
            }

            $usuarios = (new UsuarioController())->listUsuarios($_GET['numero_documento'] ?? null, $_GET['nombres'] ?? null, $_GET['apellidos'] ?? null, $_GET['fechaDesde'] ?? null, $_GET['fechaHasta'] ?? null);

            if ($usuarios->num_rows > 0) {
              while ($usuario = $usuarios->fetch_assoc()) {
                $perfilUsuario = (new Usuarios())->obtenerPerfilUsuario($usuario['id']);
                ?>
                <tr onclick="mostrarModal(<?= $usuario['id'] ?>)">
                  <td>
                    <?= mostrarDato($usuario['numero_documento']) ?>
                  </td>
                  <td>
                    <?= mostrarDato($usuario['nombres']) ?>
                  </td>
                  <td>
                    <?= mostrarDato($usuario['apellidos']) ?>
                  </td>
                  <td>
                    <?= mostrarDato($usuario['hora_entrada']) ?>
                  </td>
                  <td>
                    <?= mostrarDato($usuario['hora_salida']) ?>
                  </td>
                  <td>
                    <?= mostrarDato($perfilUsuario['perfil'] ?? null) ?>
                  </td>
                  <td>
                    <?= mostrarDato($usuario['observacion']) ?>
                  </td>
                  <td>
                    <?= mostrarDato($usuario['fecha']) ?>
                  </td>
                </tr>

                <!-- Modal -->
                <div class="modal" id="modal-<?= $usuario['id'] ?>">
                  <div class="modal-content">
                    <span class="modal-close material-icons-sharp" onclick="ocultarModal(<?= $usuario['id'] ?>)">close</span>
                    <div class="modal-header">
                    <div>
                    <h2>
                        <?= mostrarDato($usuario['nombres']) ?>
                        <?= mostrarDato($usuario['apellidos']) ?>
                      </h2>
                      </div>
                      <div class="modal-perfil">
                        <p><span class="negrita">Perfil:</span> 
                          <?= mostrarDato($perfilUsuario['perfil'] ?? null) ?>
                        </p>
                      </div>
                    </div>
                    <div class="modal-body">
                      <p class="modal-description"><span class="negrita">Correo:</span> 
                        <?= mostrarDato($usuario['email']) ?>
                      </p>
                      <p class="modal-description"><span class="negrita">Telefono:</span>
                        <?= mostrarDato($usuario['telefono']) ?>
                      </p>
                      <p class="modal-description"><span class="negrita">EPS:</span>
                        <?= mostrarDato($usuario['eps']) ?>
                      </p>
                      <p class="modal-description"><span class="negrita">Enfermedades</span>
                        <?= mostrarDato($usuario['enfermedades']) ?>
                      </p>
                      <p class="modal-description"><span class="negrita">Alergias</span>
                        <?= mostrarDato($usuario['alergias']) ?>
                      </p>
                      <p class="modal-description"><span class="negrita">RH:</span>
                        <?= mostrarDato($usuario['rh']) ?>
                      </p>
                      <p class="modal-description"><span class="negrita">Contacto de emergencia:</span>
                        <?= mostrarDato($usuario['contacto_emergencia']) ?>
                      </p>
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
          </div>
    </main>
  </div>

  <script src="./js/funcionario/registros.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
  <script>


  </script>
</body>

</html>