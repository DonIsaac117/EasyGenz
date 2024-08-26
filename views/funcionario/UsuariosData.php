<?php
session_start();
$id_usuario = $_SESSION['id_usuario'];
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
    $usuarioModel = new Usuarios();
    $usuario = $usuarioModel->obtenerUsuarioPorId($userId);

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
    <style>
        /* Estilo básico para el modal */
        .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    </style>
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
                            <button class="btnBlue">Cambiar foto</button>
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
                            <h4>Contacto de Emergencia</h4>
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
                        <button class="btnRed">Cerrar sesión</button>
                    </div>
                </div>
            </div>
        </header>
        <main class="main">
            <div class="mainLayout">
            <h1>Lista de Usuarios</h1>

<form method="GET" action="">
<input type="hidden" name="vista" value="funcionario/usuariosData">
    <input type="text" name="search" placeholder="Buscar por nombre, apellido, documento, teléfono o email" value="<?php echo htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <button type="submit">Buscar</button>
</form>

<table>
    <thead>
        <tr>
            <th>Número de Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo htmlspecialchars($usuario['numero_documento']); ?></td>
            <td><?php echo htmlspecialchars($usuario['nombres']); ?></td>
            <td><?php echo htmlspecialchars($usuario['apellidos']); ?></td>
            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
            <td><?php echo htmlspecialchars($usuario['telefono']); ?></td>
            <td>
                <button class="editBtn" data-id="<?php echo htmlspecialchars($usuario['id']); ?>">
                    <span class="material-icons-sharp">edit</span>
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="userForm" method="POST" action="usuariosData.php">
            <input type="hidden" name="userId" id="modalUserId">
            <label for="nombres">Nombres:</label>
            <input type="text" name="nombres" id="modalNombres" readonly>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="modalApellidos" readonly>
            <label for="tipo_documento">Tipo de Documento:</label>
            <input type="text" name="tipo_documento" id="modalTipoDocumento" readonly>
            <label for="numero_documento">Número de Documento:</label>
            <input type="text" name="numero_documento" id="modalNumeroDocumento" readonly>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="modalTelefono" readonly>
            <label for="email">Email:</label>
            <input type="email" name="email" id="modalEmail" readonly>
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="modalContrasena" readonly>
            <label for="rh">RH:</label>
            <input type="text" name="rh" id="modalRh" readonly>
            <label for="eps">EPS:</label>
            <input type="text" name="eps" id="modalEps" readonly>
            <label for="contacto_emergencia">Contacto de Emergencia:</label>
            <input type="text" name="contacto_emergencia" id="modalContactoEmergencia" readonly>
            <label for="enfermedades">Enfermedades:</label>
            <input type="text" name="enfermedades" id="modalEnfermedades" readonly>
            <label for="alergias">Alergias:</label>
            <input type="text" name="alergias" id="modalAlergias" readonly>
        </form>
    </div>


            </div>
        </main>
    </div>

    <script src="./js/funcionario/usuariosData.js"></script>
    <script>


    </script>
</body>

</html>