<?php 

class ConectorBD {
    //atributos / propiedades
    private $host = "localhost";
    private $port = 3306;
    private $user = "root";
    private $password;
    private $database = "easygenz";
    private $conexion;

    //metodos / funciones
    public function __construct() {
            $this ->conexion = new mysqli(
            $this ->host,
            $this ->user,
            $this ->password,
            $this ->database,
            $this ->port
        );
        if ($this->conexion->connect_error) {
            echo $this-> conexion->connect_error;
            die();
        }else {
            echo "si hay conexion";
        }
    }
    public function consultaSinRetorno($cadenasql) {
        $this->conexion->query($cadenasql);
    }
    

    public function consultaConRetorno($cadenasql){
        return $this->conexion->query($cadenasql);
    }

    public function desconectarse()
    {
        $this->conexion->close();
    }

}



