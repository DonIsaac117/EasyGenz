<?php
class ConectarBD{
    private $servidor = "localhost";
    private $usuario = "root";
    private $clave = "";
    private $basededatos = "proyectoez";
    private $conexion;

    public function __construct(){
        $this->conexion = new mysqli($this->servidor, $this->usuario, $this->clave, $this->basededatos);
        if($this->conexion->connect_error){
            echo $this->conexion->connect_error;
            die();
        }
    }

    public function consultasinRetorno($cadenasql){
        $this->conexion->query($cadenasql);
    }

    public function consultaconRetorno($cadenasql){
        return $this->conexion->query($cadenasql);
    }

    public function desConectarse(){
        $this->conexion->close();
    }
}