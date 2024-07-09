<?php

require_once ("./config/ConectorBD.php");

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

    
    public function insertar()
    {
        $cadenaSql =
        "INSERT INTO
        programa(
        id,
        nombre, 
        id_tipo_programa
        )
        VALUES
        ('$this->id',
        '$this->nombre',
        '$this->id_tipo_programa')";
        $this->conectarse->consultaSinRetorno($cadenaSql);  
    }

    public function eliminar($id) {
        $id = intval($id);
        $cadenaSql = "DELETE FROM programa WHERE id = $id";
        $this->conectarse->consultaSinRetorno($cadenaSql);
    }    
    
    public function actualizar() {
        $cadenaSql = "UPDATE programa SET 
                nombre = '$this->nombre',
                id_tipo_programa = '$this->id_tipo_programa'
                WHERE id = $this->id";
        $this->conectarse->consultaSinRetorno($cadenaSql);
    }

}