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
    $contrasena = $_POST['contrasena'];
    $rh = $_POST['rh'];
    $eps = $_POST['eps'];
    $contacto_emergencia = $_POST['contacto_emergencia'];
    $enfermedades = $_POST['enfermedades'];
    $alergias = $_POST['alergias'];

    $controller->actualizarUsuario($id, $nombres, $apellidos, $tipo_documento, $numero_documento, $telefono, $email, $contrasena, $rh, $eps, $contacto_emergencia, $enfermedades, $alergias);

    header('Location: ../index.php?vista=funcionario/usuariosData');
}

