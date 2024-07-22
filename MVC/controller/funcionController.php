<?php
require_once("../models/Funcion.php");

class FuncionController{
    private $funcion;
    public function __construct(){
        $this->funcion= new Funcion();
    }

    public function listar(){
        $listado = $this->funcion->listAll();
        return $listado;
    }

    public function crear($id_usuario, $fecha, $hora_entrada, $hora_salida, $observacion, $estado){
        $this->funcion->setIdUsuario($id_usuario);
        $this->funcion->setFecha($fecha);
        $this->funcion->setHora_entrada($hora_entrada);
        $this->funcion->setHora_salida($hora_salida);
        $this->funcion->setObservacion($observacion);
        $this->funcion->setEstado($estado);

        $this->funcion->create();
    }
}