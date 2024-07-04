<?php

require_once ("./config/ConectorBD.php");

class Usuarios
{
    private $id;
    private $nombres;
    private $apellidos;
    private $tipo_documento;
    private $numero_documento;
    private $telefono;
    private $email;
    private $contraseña;
    private $huella;
    private $codigo;
    private $eps;
    private $rh;
    private $contacto_emergencia;
    private $enfermedades;
    private $alergias;
    private $conectarse;

    //metodos - funciones

    public function __construct(){
        $this->conectarse = new ConectorBD();
    }

    //getter y setter
    public function getId(){
        return $this->id;
    }

    public function getinfoC(){
        return"
        id: $this->id" ."<br>".
        "Nombre: $this->nombres"."<br>".
        "identificacion: $this->apellidos"."<br>".
        "edad: $this->tipo_documento"."<br>"."";
    }
    public function setId($id){
        $this ->id = $id;
    }

    public function setinfoC($id, $nombres, $apellidos, $tipo_documento){
        $this -> id = $id;
        $this -> nombres = $nombres;
        $this -> apellidos = $apellidos;
        $this -> tipo_documento = $tipo_documento;
    }

    public function listAll(){
        $cadenaSql = "SELECT * FROM usuarios";
        $resultado = $this->conectarse->consultaConRetorno($cadenaSql);
        $datos = $resultado->fetch_all();
        return $datos;
    }

    public function insertar($nombre, $apellidos, $tipo_doc, $num_doc, $telefono, $email, $contraseña, $tipo_sangre, $eps, $contacto_emer, $enfermedades, $alergias)
    {
        $cadenaSql =
        "INSERT INTO usuarios(nombres, apellidos, tipo_documento, numero_documento, telefono, email, contrasena, rh, eps, contacto_emergencia, enfermedades, alergias)
         VALUES ('$nombre', '$apellidos', '$tipo_doc', '$num_doc', '$telefono', '$email', '$contraseña', '$tipo_sangre', '$eps', '$contacto_emer', '$enfermedades', '$alergias')";
        $this->conectarse->consultaSinRetorno($cadenaSql);  
    }

    public function eliminar($id) {
        $cadenaSql = "DELETE FROM usuarios WHERE id = $id";
        $this->conectarse->consultaSinRetorno($cadenaSql);
    }    

}
