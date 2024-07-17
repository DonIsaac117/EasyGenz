<?php

require_once ("./config/ConexionBd.php");

class IngresoSalida
{
    private $id_usuario;
    private $codigo_numeroficha;
    private $fecha;
    private $hora_entrada;

    private $hora_entradaa;
    private $hora_salida;
    private $observacion;
    private $estado;
    private $conectarse;

    //metodos - funciones

    public function __construct(){
        $this->conectarse = new ConexionBd();
    }

    //getter y setter
    public function getid_usuario(){return $this->id_usuario;}
    public function setid_usuario($id_usuario){$this ->id_usuario = $id_usuario;}

    public function gethora_entradaa() {return $this->hora_entradaa;}
    public function sethora_entradaa($hora_entradaa) {$this->hora_entradaa = $hora_entradaa;}

    public function getcodigo_numeroficha() {return $this->codigo_numeroficha;}
    public function setcodigo_numeroficha($codigo_numeroficha) { $this->codigo_numeroficha = $codigo_numeroficha;}

    public function getfecha() {return $this->fecha;}
    public function setfecha($fecha) {$this->fecha = $fecha;}

    public function gethora_entrada() {return $this->hora_entrada;}
    public function sethora_entrada($hora_entrada) {$this->hora_entrada = $hora_entrada;}

    public function gethora_salida() {return $this->hora_salida;}
    public function sethora_salida($hora_salida) {$this->hora_salida = $hora_salida;}

    public function getobservacion() {return $this->observacion;}
    public function setobservacion($observacion) {$this->observacion = $observacion;}

    public function getestado() {return $this->estado;}
    public function setestado($estado) {$this->estado = $estado;}

    public function listAll(){
        $cadenaSql = "SELECT * FROM ingresosalida_ficha";
        $resultado = $this->conectarse->consultaConRetorno($cadenaSql);
        $datos = $resultado->fetch_all();
        return $datos;
    }

    
    public function insertar()
    {
        $cadenaSql =
        "INSERT INTO
        ingresosalida_ficha(
            id_usuario,
            codigo_numeroficha,
            fecha,
            hora_entrada,
            hora_salida,
            observacion,
            estado
        )
        VALUES
        ('$this->id_usuario',
        '$this->codigo_numeroficha',
        '$this->fecha',
        '$this->hora_entrada',
        '$this->hora_salida',
        '$this->observacion',
        '$this->estado')";
        $this->conectarse->consultaSinRetorno($cadenaSql);  
    }

    public function eliminar($id_usuario, $hora_entrada) {
        $id_usuario = intval($id_usuario);
        $hora_entrada = strval($hora_entrada);
        $cadenaSql = "DELETE FROM `ingresosalida_ficha` WHERE id_usuario = $id_usuario and hora_entrada = '$hora_entrada';";
        $this->conectarse->consultaSinRetorno($cadenaSql);
    }    
    
    public function actualizar() {
        $cadenaSql = "UPDATE ingresosalida_ficha SET
                id_usuario = '$this->id_usuario',
                fecha = '$this->fecha',
                hora_entrada = '$this->hora_entrada',
                hora_salida = '$this->hora_salida',
                observacion = '$this->observacion',
                estado = '$this->estado'
                WHERE id_usuario = $this->id_usuario and hora_entrada = '$this->hora_entradaa'";
        $this->conectarse->consultaSinRetorno($cadenaSql);
    }

}