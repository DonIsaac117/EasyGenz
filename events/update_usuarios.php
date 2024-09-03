<?php
require_once './../controllers/usuariosController.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UsuarioController();

    $id = $_POST['userId'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $tipo_documento = $_POST['tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $nuevaContrasena = $_POST['contrasena'];
    $rh = $_POST['rh'];
    $eps = $_POST['eps'];
    $contacto_emergencia = $_POST['contacto_emergencia'];
    $enfermedades = $_POST['enfermedades'];
    $alergias = $_POST['alergias'];

    // Obtener la contraseña actual del usuario desde la base de datos
    $usuario = $controller->obtenerUsuarioPorId($id);
    $contrasenaActual = $usuario['contrasena'];

    // Verificar si la nueva contraseña es diferente a la actual
    if ($nuevaContrasena !== $contrasenaActual) {
        // Si la nueva contraseña es diferente, verificar si ya está en uso
        if ($controller->verificarContrasena($nuevaContrasena, $id)) {
            echo "<script>alert('La contraseña ya está en uso por otro usuario.'); window.history.back();</script>";
            exit;
        }
    }

    // Actualizar los datos del usuario, incluyendo la contraseña
    $controller->actualizarUsuario($id, $nombres, $apellidos, $tipo_documento, $numero_documento, $telefono, $email, $nuevaContrasena, $rh, $eps, $contacto_emergencia, $enfermedades, $alergias);
    header('Location: ../index.php?vista=funcionario/usuariosData');
    exit;
}
