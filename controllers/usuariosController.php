<?php

require_once("./config/ConectorBD.php");
require_once("./models/Usuarios.php");

class UsuarioController { 
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuarios();
    }

    public function login($numero_documento,$contraseña) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->usuarioModel->getNumeroDocumento($numero_documento);
            $this->usuarioModel->getContrasena($contraseña);


            $contrasena = $_POST['contrasena'];
    
            $usuario = new Usuarios();
            $usuario->setNumeroDocumento($numero_documento);
            $usuario->setContrasena($contrasena);
            
            $user = $usuario->verificarCredenciales();
    
            if ($user) {
                // Las credenciales son correctas
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombres'];
                header('Location: principal.html');
            } else {
                // Las credenciales son incorrectas
                echo "<script>alert('Credenciales incorrectas');</script>";
                header("url=index.php");
                
            }
        }
    }
    
    public function listar() {
        return $this->usuarioModel->listAll();
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->usuarioModel->setNombres($_POST['nombre']);
            $this->usuarioModel->setApellidos($_POST['apellidos']);
            $this->usuarioModel->setTipoDocumento($_POST['tipo_doc']);
            $this->usuarioModel->setNumeroDocumento($_POST['num_doc']);
            $this->usuarioModel->setTelefono($_POST['telefono']);
            $this->usuarioModel->setEmail($_POST['email']);
            $this->usuarioModel->setContrasena($_POST['contrasena']);
            $this->usuarioModel->setRh($_POST['tipo-sangre']);
            $this->usuarioModel->setEps($_POST['eps']);
            $this->usuarioModel->setContactoEmergencia($_POST['contacto-emer']);
            $this->usuarioModel->setEnfermedades($_POST['enfermedades']);
            $this->usuarioModel->setAlergias($_POST['alergias']);

            $this->usuarioModel->insertar();
            header('Location: index.php?vista=usuario/inicio');
        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
            $id = intval($_POST['eliminar']);
            $this->usuarioModel->eliminar($id);
            header("Location: index.php?vista=usuario/inicio");
            exit();
        }
    }


    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->usuarioModel->setId($_POST['id']);
            $this->usuarioModel->setNombres($_POST['nombre']);
            $this->usuarioModel->setApellidos($_POST['apellidos']);
            $this->usuarioModel->setTipoDocumento($_POST['tipo_doc']);
            $this->usuarioModel->setNumeroDocumento($_POST['num_doc']);
            $this->usuarioModel->setTelefono($_POST['telefono']);
            $this->usuarioModel->setEmail($_POST['email']);
            $this->usuarioModel->setContrasena($_POST['contrasena']);
            $this->usuarioModel->setRh($_POST['tipo_sangre']);
            $this->usuarioModel->setEps($_POST['eps']);
            $this->usuarioModel->setContactoEmergencia($_POST['contacto_emer']);
            $this->usuarioModel->setEnfermedades($_POST['enfermedades']);
            $this->usuarioModel->setAlergias($_POST['alergias']);
    
            $this->usuarioModel->actualizar();
            header('Location: index.php?vista=usuario/inicio');
        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
    }
    
    
}

?>
