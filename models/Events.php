<?php
session_start();
require_once './../config/ConexionBd.php';


class Event
{
    private $conectarse;

    public $id_usuario;
    public $fecha;
    public $hora_entrada;
    public $hora_salida;

    public $observaciones;

    public $estado;

    public function __construct()
    {
        $this->conectarse = new ConexionBd();
    }



    public function listAllFuncionarios()
    {
        $cadenaSql = "SELECT * FROM controlfuncionarios";
        $resultado = $this->conectarse->consultaConRetorno($cadenaSql);
        $datos = $resultado->fetch_all();
        return $datos;

    }


    public function create()
    {
        $cadenaSql = "INSERT INTO controlfuncionarios(id_usuario, fecha, hora_entrada, hora_salida) VALUES ('$this->id_usuario', '$this->fecha', '$this->hora_entrada', '$this->hora_salida')";

        $this->conectarse->consultaSinRetorno($cadenaSql);
    }


    public function getByUserId($id_usuario) {
        $cadenaSql = "SELECT fecha, hora_entrada, hora_salida FROM controlfuncionarios WHERE id_usuario = ?";
        $stmt = $this->conectarse->conexion->prepare($cadenaSql);
        if ($stmt === false) {
            die("Error en la preparación: " . $this->conectarse->conexion->error);
        }
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado;
    }}

