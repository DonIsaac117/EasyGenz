<?php
require_once(__DIR__ . '/../config/ConectorBD.php');


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
        $this->conectarse = new ConectorBD();
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
        $cadenaSql = "SELECT IFNULL(cf.observacion, isa.observacion) as observacion, IFNULL(cf.hora_entrada, isa.hora_entrada) as hora_entrada,
                   IFNULL(cf.hora_salida, isa.hora_salida) as hora_salida,
                   IFNULL(cf.fecha, isa.fecha) as fecha
            FROM usuarios u
            LEFT JOIN controlfuncionarios cf ON u.id = cf.id_usuario
            LEFT JOIN ingresosalida_ficha isa ON u.id = isa.id_usuario WHERE u.id = ?";
        $stmt = $this->conectarse->conexion->prepare($cadenaSql);
        if ($stmt === false) {
            die("Error en la preparación: " . $this->conectarse->conexion->error);
        }
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado;
    }

    public function getInstructor($id_usuario) {
        $cadenaSql = "SELECT IFNULL(cf.observacion, isa.observacion) as observacion, IFNULL(cf.hora_entrada, isa.hora_entrada) as hora_entrada,
                   IFNULL(cf.hora_salida, isa.hora_salida) as hora_salida,
                   IFNULL(cf.fecha, isa.fecha) as fecha
            FROM usuarios u
            LEFT JOIN controlfuncionarios cf ON u.id = cf.id_usuario
            LEFT JOIN ingresosalida_ficha isa ON u.id = isa.id_usuario WHERE u.id = ?";
        $stmt = $this->conectarse->conexion->prepare($cadenaSql);
        if ($stmt === false) {
            die("Error en la preparación: " . $this->conectarse->conexion->error);
        }
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado;
    }

}

