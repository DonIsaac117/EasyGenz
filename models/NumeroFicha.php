<?php

require_once(__DIR__ . '/../config/ConectorBD.php');

class NumeroFicha
{
    private $codigo;
    private $jornada;
    private $nombre;
    private $descripcion;
    private $id_programa;
    private $conectarse;

    //metodos - funciones

    public function __construct(){
        $this->conectarse = new ConectorBD();
    }

    //getter y setter
    public function getcodigo(){return $this->codigo;}
    public function setcodigo($codigo){$this ->codigo = $codigo;}

    public function getjornada() {return $this->jornada;}
    public function setjornada($jornada) { $this->jornada = $jornada;}

    public function getnombre() {return $this->nombre;}
    public function setnombre($nombre) {$this->nombre = $nombre;}
    public function getdescripcion() {return $this->descripcion;}
    public function setdescripcion($descripcion) {$this->descripcion = $descripcion;}
    public function getid_programa() {return $this->id_programa;}
    public function setid_programa($id_programa) {$this->id_programa = $id_programa;}

    public function listAll(){
        $cadenaSql = "SELECT * FROM numero_ficha";
        $resultado = $this->conectarse->consultaConRetorno($cadenaSql);
        $datos = $resultado->fetch_all();
        return $datos;
    }

    
    public function insertar()
    {
        $cadenaSql =
        "INSERT INTO
        numero_ficha(
        codigo,
        jornada,
        nombre, 
        descripcion,
        id_programa 
        )
        VALUES
        ('$this->codigo',
        '$this->jornada',
        '$this->nombre',
        '$this->descripcion',
        '$this->id_programa')";
        $this->conectarse->consultaSinRetorno($cadenaSql);  
    }
}