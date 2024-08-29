<?php

require_once(__DIR__ . '/../config/ConectorBD.php');

class Programa
{
    private $id;
    private $nombre;
    private $id_tipo_programa;
    private $conectarse;

    //metodos - funciones

    public function __construct(){
        $this->conectarse = new ConectorBD();
    }

    //getter y setter
    public function getId(){return $this->id;}
    public function setId($id){$this ->id = $id;}

    public function getNombre() {return $this->nombre;}
    public function setNombre($nombre) { $this->nombre = $nombre;}

    public function getid_tipo_programa() {return $this->id_tipo_programa;}
    public function setid_tipo_programa($id_tipo_programa) {$this->id_tipo_programa = $id_tipo_programa;}

    public function listAll(){
        $cadenaSql = "SELECT * FROM programa";
        $resultado = $this->conectarse->consultaConRetorno($cadenaSql);
        $datos = $resultado->fetch_all();
        return $datos;
    }

    public function existeprograma() {
        $cadenaSql = "SELECT * FROM programa WHERE nombre = '$this->nombre'";
        $resultado = $this->conectarse->consultaConRetorno($cadenaSql);
    
        if ($resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        } else {
            return false;
        }
    }

    public function obteneridprograma() {
        $cadenaSql = "SELECT id FROM programa WHERE nombre = ?";
        $stmt = $this->conectarse->conexion->prepare($cadenaSql);
        if ($stmt === false) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conectarse->conexion->error);
        }
        $stmt->bind_param('s', $this->nombre);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row ? $row['id'] : null;
    }
    
    
    public function insertar()
    {
        $cadenaSql =
        "INSERT INTO
        programa(
        nombre, 
        id_tipo_programa
        )
        VALUES
        ('$this->nombre',
        '$this->id_tipo_programa')";
        $this->conectarse->consultaSinRetorno($cadenaSql);  
    }


}