<?php
session_start();
$id_usuario = $_SESSION['id_usuario'];
if (!isset($id_usuario)){
    header("Location: index.php?vista=usuario/login"); 
    exit();
  }
require_once './controllers/usuariosController.php';
require_once './models/Usuarios.php';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $eliminar = $_POST['delete_id'];
    $usuarioController->eliminar($eliminar);

    // Redirigir después de la eliminación para evitar resubmisión del formulario
    header("Location: ?vista=funcionario/usuariosData");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePerfil'])) {
    $nuevo_perfil_id = $_POST['perfil'];
    $id_usuario = $_POST['userId'];
    
    // Asegúrate de que el perfil es válido
    if ($nuevo_perfil_id && $id_usuario) {
        $usuarioController->actualizarPerfilUsuario($id_usuario, $nuevo_perfil_id);
        
        // Redirigir para evitar reenvío de formulario
        header("Location: ?vista=funcionario/usuariosData");
        exit();
    }
}

$usuarios = [];

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $usuarios = $usuarioController->filtrarUsuarios($searchTerm);
} else {
    // Aquí podrías manejar la carga inicial de usuarios si se desea
    $usuarios = $usuarioController->filtrarUsuarios(""); // Dejar vacío para cargar todos
}
;
$userId = $_POST['userId'] ?? null;




if ($userId) {
    $usuario = $usuarioController->obtenerUsuarioPorId($userId);

    // Muestra los datos del usuario
    // Aquí puedes incluir HTML para mostrar los datos en el modal
    echo '<script>
        document.getElementById("modalNombres").value = "' . htmlspecialchars($usuario['nombres'] ?? 'N/A') . '";
        document.getElementById("modalApellidos").value = "' . htmlspecialchars($usuario['apellidos'] ?? 'N/A') . '";
        document.getElementById("modalTipoDocumento").value = "' . htmlspecialchars($usuario['tipo_documento'] ?? 'N/A') . '";
        document.getElementById("modalNumeroDocumento").value = "' . htmlspecialchars($usuario['numero_documento'] ?? 'N/A') . '";
        document.getElementById("modalTelefono").value = "' . htmlspecialchars($usuario['telefono'] ?? 'N/A') . '";
        document.getElementById("modalEmail").value = "' . htmlspecialchars($usuario['email'] ?? 'N/A') . '";
        document.getElementById("modalContrasena").value = "' . htmlspecialchars($usuario['contrasena'] ?? 'N/A') . '";
        document.getElementById("modalRh").value = "' . htmlspecialchars($usuario['rh'] ?? 'N/A') . '";
        document.getElementById("modalEps").value = "' . htmlspecialchars($usuario['eps'] ?? 'N/A') . '";
        document.getElementById("modalContactoEmergencia").value = "' . htmlspecialchars($usuario['contacto_emergencia'] ?? 'N/A') . '";
        document.getElementById("modalEnfermedades").value = "' . htmlspecialchars($usuario['enfermedades'] ?? 'N/A') . '";
        document.getElementById("modalAlergias").value = "' . htmlspecialchars($usuario['alergias'] ?? 'N/A') . '";
        document.getElementById("myModal").style.display = "block";
    </script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Soporte</title>
    <link rel="stylesheet" href="./css/funcionario/usuariosData.css" />
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
                <div>
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
            <a href="?vista=funcionario/usuariosData">
                <div style="background: rgb(0, 0, 0, 0.32);">
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

                        </div>

                        <div class="nameUser">
                            <h2>
                                <?php echo $datosUsuario['nombres']; ?>
                            </h2>
                            <h5>
                                <?php echo $datosUsuario['email']; ?>
                            </h5>
                        </div>
                    </div>

                    <div class="userData">
                        <div>
                            <h4>Primer nombre</h4>
                            <h5>
                                <?php echo $primerNombre; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Segundo nombre</h4>
                            <h5>
                                <?php echo $segundoNombre; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Primer apellido</h4>
                            <h5>
                                <?php echo $primerApellido; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Segundo apellido</h4>
                            <h5>
                                <?php echo $segundoApellido; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>N°Documento</h4>
                            <h5>
                                <?php echo isset($datosUsuario['numero_documento']) ? $datosUsuario['numero_documento'] : 'N/A'; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Teléfono</h4>
                            <h5>
                                <?php echo isset($datosUsuario['telefono']) ? $datosUsuario['telefono'] : 'N/A'; ?>
                            </h5>
                        </div>
                    </div>
                    <h3 style="text-align: center;">Datos Médicos</h3>
                    <div class="userData">
                        <div>
                            <h4>EPS</h4>
                            <h5>
                                <?php echo isset($datosUsuario['eps']) ? $datosUsuario['eps'] : 'N/A'; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>RH</h4>
                            <h5>
                                <?php echo isset($datosUsuario['rh']) ? $datosUsuario['rh'] : 'N/A'; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Tel Emergencia</h4>
                            <h5>
                                <?php echo isset($datosUsuario['contacto_emergencia']) ? $datosUsuario['contacto_emergencia'] : 'N/A'; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Enfermedades</h4>
                            <h5>
                                <?php echo isset($datosUsuario['enfermedades']) ? $datosUsuario['enfermedades'] : 'N/A'; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Alergias</h4>
                            <h5>
                                <?php echo isset($datosUsuario['alergias']) ? $datosUsuario['alergias'] : 'N/A'; ?>
                            </h5>
                        </div>
                    </div>

                    <div class="userEnd">
                        <a href="./events/cerrar_sesion.php"><button class="btnRed">Cerrar sesion</button></a>

                    </div>
                </div>
            </div>
        </header>
        <main class="main">
            <div class="mainLayout">
                <form method="GET" action="">
                    <div class="search">

                        <input type="hidden" name="vista" value="funcionario/usuariosData">
                        <input type="hidden" name="isFiltered" id="isFilteredInput" value="<?php echo isset($_GET['search']) && $_GET['search'] !== '' ? 'true' : 'false'; ?>">

                        <input type="text" id="searchInput" name="search"
                            placeholder="Buscar por nombre, apellido, documento, teléfono o email"
                            value="<?php echo htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        <button type="submit"><span class="material-icons-sharp">search</span></button>
                    </div>
                </form>
                <div class="table-container">
                    <table border="1" id="tabla" class="table">
                        <thead>
                            <tr>
                                <th>Número de Documento<span class="material-icons-sharp">arrow_drop_down</span></th>
                                <th>Nombres<span class="material-icons-sharp">arrow_drop_down</span></th>
                                <th>Apellidos<span class="material-icons-sharp">arrow_drop_down</span></th>
                                <th>Email<span class="material-icons-sharp">arrow_drop_down</span></th>
                                <th>Teléfono<span class="material-icons-sharp">arrow_drop_down</span></th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($usuario['numero_documento']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars(ucwords(strtolower($usuario['nombres']))); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars(ucwords(strtolower($usuario['apellidos']))); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($usuario['email']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($usuario['telefono']); ?>
                                </td>
                                <td class="actions">
                                    <button class="editBtn" data-id="<?php echo htmlspecialchars($usuario['id']); ?>">
                                        <span class="material-icons-sharp">edit</span>
                                    </button>

                                    <form method="POST" action="" style="display:inline;"
                                        onsubmit="return confirmDelete(event, '<?=htmlspecialchars($usuario['nombres']);?>', '<?=htmlspecialchars($usuario['apellidos']);?>')">
                                        <input type="hidden" name="delete_id"
                                            value="<?=htmlspecialchars($usuario['id']);?>">
                                        <button type="submit" class="deleteBtn" data-id="<?=$usuario['id'];?>">
                                            <i class="material-icons-sharp">delete</i>
                                        </button>
                                    </form>

                                 
                                          <!-- Botón para desplegar el menú de perfil -->
                                    <button class="profileBtn" onclick="toggleMenu(<?php echo $usuario['id']; ?>)" data-id="<?php echo $usuario['id']; ?>">
                                        <span class="material-icons-sharp">account_circle</span>
                                    </button>

                                    <!-- Menú desplegable de perfil -->
                                    <div id="profileMenu_<?php echo $usuario['id']; ?>" class="profile-menu"
                                        style="display: none;"  >
                                        <form method="post" action="">
                                            <input type="hidden" name="userId" value="<?php echo $usuario['id']; ?>">
                                            <?php  $perfil= $usuarioController->obtenerPerfil($usuario['id']); ?>
                                           

                                            <label>
                                                <input type="radio" name="perfil" value="1" 
                                                    <?php echo isset($perfil['id']) && $perfil['id'] == '1' ? 'checked' : ''; ?>>
                                                Aprendiz
                                            </label>
                                            <label>
                                                <input type="radio" name="perfil" value="2"
                                                    <?php echo isset($perfil['id']) && $perfil['id'] == '2' ? 'checked' : ''; ?>>
                                                Instructor
                                            </label>
                                            <label>
                                                <input type="radio" name="perfil" value="3"
                                                    <?php echo isset($perfil['id']) && $perfil['id'] == '3' ? 'checked' : ''; ?>>
                                                Funcionario
                                            </label>
                                            <button type="submit" name="updatePerfil" value="Actualizar Perfil">Actualizar</button>
                                        </form>
                                  
                                    </div>
                                  
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal -->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close material-icons-sharp">close</span>
                        <form id="userForm" method="POST" action="./events/update_usuarios.php" class="formEdit">

                            <input type="hidden" name="userId" id="modalUserId">

                            <div class="modalOrganized">
                                <label for="nombres">Nombres:</label>
                                <input type="text" name="nombres" id="modalNombres" required>
                            </div>
                            <div class="modalOrganized">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" name="apellidos" id="modalApellidos" required>
                            </div>
                            <div class="modalOrganized">
                                <label for="tipo_documento">Tipo de Documento:</label>
                                <input type="text" name="tipo_documento" id="modalTipoDocumento" required>
                            </div>

                            <div class="modalOrganized">
                                <label for="numero_documento">Número de Documento:</label>
                                <input type="text" name="numero_documento" id="modalNumeroDocumento" required>
                            </div>

                            <div class="modalOrganized">
                                <label for="telefono">Teléfono:</label>
                                <input type="tel" name="telefono" id="modalTelefono">
                            </div>

                            <div class="modalOrganized">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="modalEmail">
                            </div>

                            <div class="modalOrganized">
                            <div class="password-container">
                            <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" id="modalContrasena" required>
                    <span class="toggle-password material-icons-sharp">visibility_off</span>
                </div>
                            </div>

                            <div class="modalOrganized">
                                <label for="rh">RH:</label>
                                <input type="text" name="rh" id="modalRh" required>
                            </div>

                            <div class="modalOrganized">
                                <label for="eps">EPS:</label>
                                <input type="text" name="eps" id="modalEps">
                            </div>

                            <div class="modalOrganized">
                                <label for="contacto_emergencia">Contacto de Emergencia:</label>
                                <input type="text" name="contacto_emergencia" id="modalContactoEmergencia">
                            </div>

                            <div class="modalOrganized">
                                <label for="enfermedades">Enfermedades:</label>
                                <input type="text" name="enfermedades" id="modalEnfermedades">
                            </div>

                            <div class="modalOrganized">
                                <label for="alergias">Alergias:</label>
                                <input type="text" name="alergias" id="modalAlergias">
                            </div>


                            <button type="submit" id="saveChangesButton">Guardar Cambios</button>

                        </form>
                    </div>


                </div>
        </main>
    </div>

    <script src="./js/funcionario/usuariosData.js"></script>

</body>

</html>