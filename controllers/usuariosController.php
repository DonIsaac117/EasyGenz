<?php

require_once("./models/Usuarios.php");

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuarios();
    }

    public function listar() {
        return $this->usuarioModel->listAll();
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $tipo_doc = $_POST['tipo_doc'];
            $num_doc = $_POST['num_doc'];
            $tipo_sangre = $_POST['tipo_sangre'];
            $contraseña = $_POST['contrasena'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $eps = $_POST['eps'];
            $contacto_emer = $_POST['contacto_emer'];
            $enfermedades = $_POST['enfermedades'];
            $alergias = $_POST['alergias'];

            $this->usuarioModel->insertar($nombre, $apellidos, $tipo_doc, $num_doc, $telefono, $email, $contraseña, $tipo_sangre, $eps, $contacto_emer, $enfermedades, $alergias);

            header("Location: index.php?vista=usuario/inicio");
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
            $id = $_POST['eliminar'];
            $usuario = new Usuarios();
            $usuario->eliminar($id);
            header("Location: index.php?vista=usuario/inicio");
            exit();
        }
    }
    
    
}

?>
