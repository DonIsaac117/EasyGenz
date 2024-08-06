<?php


class ConexionBd
{

    private $host = "localhost";
    private $userBd = "root";
    private $passwordBd = "";
    private $database = "proyectoez";
    private $conexion; 

    public function __construct()
    {
        $this->conexion = new mysqli($this->host, $this->userBd, $this->passwordBd, $this->database);
    if ($this->conexion->connect_error) {
            echo $this->conexion->connect_error;
            die();
    }
   
}

//insert delete update
public function consultaSinRetorno($cadenaSql){
    $this->conexion->query($cadenaSql);
}

// select
public function consultaConRetorno($cadenaSql){
    return $this->conexion->query($cadenaSql);
}

public function desConectarse(){
    $this->conexion->close();
}
}

