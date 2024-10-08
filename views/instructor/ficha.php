<?php
session_start();
$id_usuario = $_SESSION['id_usuario'];
if (!isset($id_usuario)){
  header("Location: index.php?vista=usuario/login"); 
  exit();
}
require_once './controllers/usuariosController.php';
require_once './controllers/programasController.php';

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
  <title>Ficha</title>
  <link rel="stylesheet" href="./css/instructor/ficha.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
</head>

<body>
<nav class="nav">
      <div class="sena">
          <img src="./imagenes/funcionario/logoSena.png" />Instructor
      </div>
      <div class="menu">
        <a href="?vista=instructor/inicio">
        <div>
          <span class="material-icons-sharp">home</span>
          <p>Calendario</p>
        </div>
        </a>

      </div>
      <div class="menu">
        <a href="?vista=instructor/ficha">
        <div style="background: rgb(0, 0, 0, 0.32);">
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
  <span class="material-icons-sharp" id="perfilIcon">account_circle</span>
  <div id="perfilMenu" class="perfilMenu">
    <div class="perfilIcon">
      <div>
        <span class="material-icons-sharp">account_circle</span>
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
        <h4>Tel Emergencia</h4>
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
    <a href="./events/cerrar_sesion.php"><button class="btnRed">Cerrar sesion</button></a>

    </div>
  </div>
</div>
    </header>
    <main class="main">
  <div class="main-container">
    <!-- Primera Columna -->
    <div class="column">
      <form action="index.php?vista=instructor/ficha" method="post" id="myForm">
        <div class="col1">
          <label for="ficha">N° Ficha</label>
          <input type="number" id="ficha" name="ficha" required>
          <label for="jornada">Jornada</label>
          <select required name="jornada" id="jornada">
            <option value="seleccione">Seleccione..</option>
            <option value="mañana">MAÑANA</option>
            <option value="tarde">TARDE</option>
            <option value="noche">NOCHE</option>
          </select>
        </div>
        <div class="col2">
          <label for="programa">Nombre del programa</label>
          <input type="text" id="programa" name="programa" maxlength="50" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>

          <label for="tipo">Tipo del programa</label>
          <select required name="tipo" id="tipo">
            <option value="seleccione">Seleccione..</option>
            <option value="2">Tecnico</option>
            <option value="1">Tecnologo</option>
            <option value="3">Curso corto</option>
            <option value="9">Virtual</option>
          </select>
        </div>
        <div class="observacion">
          <label for="observacion">Descripcion</label>
          <textarea name="observacion" id="observacion" cols="30" rows="10"></textarea>
        </div>
        <div class="btn">
          <button type="submit" value="ficha">Enviar</button>
        </div>
      </form>
    </div>

    <!-- Segunda Columna -->
    <div class="column">

        <!-- filtro -->
        <form id="filterForm" method="get" action="">
          <input type="hidden" name="vista" value="instructor/ficha">
         <div class="divInput">
          <label for="numero_documento">N°Documento:</label>
          <input type="text" id="numero_documento" class="filter-input" name="numero_documento"
            value="<?= htmlspecialchars($_GET['numero_documento'] ?? '') ?>">
            <button type="submit">Filtrar</button>
          </div>
        </form>


 <!-- TABLA -->
      <form id="formFicha" action="index.php?vista=instructor/aprendiz" method="POST">

            <input type="hidden" name="vista" value="instructor/aprendiz">
            <div class="divInput">
              <label for="numeroFicha">N° de ficha:</label>
              <input type="text" id="numeroFicha" name="numeroFicha"
                value="<?= htmlspecialchars($_GET['numeroFicha'] ?? '') ?>">
              <button type="submit" id="seleccionarBtn">Seleccionar</button>
            </div>


            <div class="table-container">
          <table border="2" id="tabla">
            <thead>
              <tr class="sticky">
                <th id="colDocumento">Documento <span class="material-icons-sharp">arrow_drop_down</span></th>
                <th id="colNombre">Nombre <span class="material-icons-sharp">arrow_drop_down</span></th>
                <th id="colApellido">Apellido <span class="material-icons-sharp">arrow_drop_down</span></th>
                <th id="select">Seleccion</th>
              </tr>
            </thead>
            <tbody>
              <?php
              function mostrarDato($dato)
              {
                return isset($dato) && !empty($dato) ? htmlspecialchars($dato) : 'N/A';
              }
              


              $usuarios = (new UsuarioController())->listAprendices($_GET['numero_documento'] ?? null, $_GET['nombres'] ?? null, $_GET['apellidos'] ?? null);

              if ($usuarios->num_rows > 0) {
                while ($usuario = $usuarios->fetch_assoc()) {
                  $perfilUsuario = (new Usuarios())->obtenerPerfilUsuario($usuario['id']);
                  ?>
                  <tr onclick="mostrarModal(<?= $usuario['id'] ?>)">
                    <td><?= htmlspecialchars($usuario['numero_documento']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombres']) ?></td>
                    <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                    <td class="checkbox-td">
                    <input type="checkbox" name="usuariosSeleccionados[]" value="<?= $usuario['id'] ?>">
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
    </form>
  </div>
</main>



  <script src="./js/instructor/ficha.js"></script>

  <script>
  </script>
</body>

</html>