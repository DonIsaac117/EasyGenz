<?php
session_start();
require_once './config/ConexionBd.php';


class Event{
    private $conectarse;

    private $id_usuario;
    public $fecha;
    public $hora_entrada;
    public $hora_salida;

    public $observaciones;

    public $estado;

    public function __construct() {
        $this->conectarse = new ConexionBd();
    }


   public function getIdUsuario(){
    return $this->id_usuario;
   }

   public function setIdUsuario($id_usuario){
    $this->id_usuario = $id_usuario;
   }

   public function getFecha(){
    return $this->fecha;
   }

   public function setFecha($fecha){
    $this->fecha = $fecha;
   }

   public function getHora_entrada(){
    return $this->hora_entrada;
   }

   public function setHora_entrada($hora_entrada){
    $this->hora_entrada = $hora_entrada;
   }

   public function getHora_salida(){
    return $this->hora_salida;
   }

   public function setHora_salida($hora_salida){
    $this->hora_salida = $hora_salida;
   }

   public function listAllFuncionarios(){
    $cadenaSql= "SELECT * FROM controlfuncionarios";
    $resultado= $this->conectarse->consultaConRetorno($cadenaSql);
    $datos=$resultado->fetch_all();
    return $datos;

   }


   public function create() {
    $cadenaSql = "INSERT INTO controlfuncionarios(id_usuario, fecha, hora_entrada, hora_salida) VALUES ('$this->id_usuario', '$this->fecha', '$this->hora_entrada', '$this->hora_salida')";

    $this->conectarse->consultaSinRetorno($cadenaSql);
   }
    

   public function getByUserId($id_usuario) {
    $cadenaSql = "SELECT fecha, hora_entrada, hora_salida FROM controlfuncionarios WHERE id_usuario = $id_usuario";
    $resultado= $this->conectarse->consultaConRetorno($cadenaSql);
    return $resultado;
}

}

