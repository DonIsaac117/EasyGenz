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
        $this->usuarioModel->getNombres($nombres);
        $this->usuarioModel->getApellidos($apellidos);
        $this->usuarioModel->getTipoDocumento($tipo_documento);
        $this->usuarioModel->getNumeroDocumento($numero_documento);
        $this->usuarioModel->getRh($rh);
        $this->usuarioModel->getContrasena($contrasena);
        $this->usuarioModel->getTelefono($telefono);
        $this->usuarioModel->getEmail($email);
        $this->usuarioModel->getEps($eps);
        $this->usuarioModel->getContactoEmergencia($contacto_emergencia);
        $this->usuarioModel->getEnfermedades($enfermedades);
        $this->usuarioModel->getAlergias($alergias);
        $this->usuarioModel->insertar();
    }
    // funcion cambiar contraseña
    public function editarContrasena($contrasena, $email) {
        $this->usuarioModel->setContrasena($contrasena);
        $this->usuarioModel->setEmail($email);
        $this->usuarioModel->cambiarContrasena();
    }

}
