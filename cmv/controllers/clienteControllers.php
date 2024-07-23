<?php
require_once(__DIR__ . '/../config/ConectorBd.php');
require_once(__DIR__ . '/../models/Cliente.php');
class ClienteController{
    //atributos-propiedades
    private $usuarioModel;

    public function __construct(){
        $this->usuarioModel = new usuarioModel();
    }
    
    //metodos
    public function listar(){
        $listado =$this->usuarioModel->listAll();
        return $listado;
    }

    ///registrar usuario
    public function registrar($nombres, $apellidos, $tipo_documento, $numero_documento, $telefono, $email, $contrasena, $rh, $eps, $contacto_emergencia, $enfermedades, $alergias) {
        $this->usuarioModel->setNombres($nombres);
        $this->usuarioModel->setApellidos($apellidos);
        $this->usuarioModel->setTipoDocumento($tipo_documento);
        $this->usuarioModel->setNumeroDocumento($numero_documento);
        $this->usuarioModel->setRh($rh);
        $this->usuarioModel->setContrasena($contrasena);
        $this->usuarioModel->setTelefono($telefono);
        $this->usuarioModel->setEmail($email);
        $this->usuarioModel->setEps($eps);
        $this->usuarioModel->setContactoEmergencia($contacto_emergencia);
        $this->usuarioModel->setEnfermedades($enfermedades);
        $this->usuarioModel->setAlergias($alergias);
        $this->usuarioModel->insertar();
        header("Location: form.php?error=usuario_registrado");
        
    }
    // funcion cambiar contraseña
    public function editarContrasena($contrasena, $email) {
        $this->usuarioModel->setContrasena($contrasena);
        $this->usuarioModel->setEmail($email);
        $this->usuarioModel->cambiarContrasena();
    }

    public function login($numero_documento,$contrasena) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->usuarioModel->getNumeroDocumento($numero_documento);
            $this->usuarioModel->getContrasena($contrasena);


            $contrasena = $_POST['contrasena'];
    
            $usuario = new usuarioModel();
            $usuario->setNumeroDocumento($numero_documento);
            $usuario->setContrasena($contrasena);
            

            $user = $usuario->existedocumento();
            
            if ($user) {
                $user = $usuario->verificarCredenciales();
                if ($user) {
                    // Las credenciales son correctas
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['nombres'];
                    header('Location: html/principal.php');
                    exit; // Asegúrate de salir después de redirigir
                } else {
                    // Las credenciales son incorrectas
                    header("Location: index.php?error=credenciales_incorrectas");
                    exit;
                }
            } else {
                // El usuario no existe en la base de datos
                header("Location: index.php?error=usuario_no_existe");
                exit;
            }
        }
    }
    

}
