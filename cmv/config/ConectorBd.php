<?php

class ConectorBd{

    //atributos-propiedades
    private $servidor="localhost";//127.0.0.1
    private $usuarioBd="root";
    private $claveBd="";
    private $baseDatos="EASYGENZ";
    //
    private $conexion;//guardar la conexion

    //metodos-funciones
    public function __construct(){
        $this->conexion = new mysqli($this->servidor,$this->usuarioBd, $this->claveBd,$this->baseDatos);
       if($this->conexion->connect_error){
            echo $this->conexion->connect_error;
            die();
       }
       
    }

    public function consultaSinRetorno($cadenaSql)//insert delete update
    {
        $this->conexion->query($cadenaSql);
    }


    public function consultaConRetorno($cadenaSql)//select
    {
        return $this->conexion->query($cadenaSql);
    }

    public function desConectarse()
    {
        $this->conexion->close();
    }

}