<?php

require_once './config/ConexionBd.php';

class Registro
{
    private $conectarse;

    public function __construct()
    {
        $this->conectarse = new ConexionBd();
    }

    public function getByUserId($id, $fecha_desde = null, $fecha_hasta = null, $numero_documento = null, $nombre = null, $apellido = null)
    {
        $cadenaSql = "
            SELECT u.numero_documento, u.nombres, u.apellidos, cf.fecha, cf.hora_entrada, cf.hora_salida, cf.observacion
            FROM usuarios u
            LEFT JOIN controlfuncionarios cf ON u.id = cf.id_usuario
            LEFT JOIN ingresosalida_ficha is ON u.id = is.id_usuario
            WHERE u.id = ?";

        if ($fecha_desde && $fecha_hasta) {
            $cadenaSql .= " AND (cf.fecha BETWEEN ? AND ? OR is.fecha BETWEEN ? AND ?)";
        }

        if ($numero_documento) {
            $cadenaSql .= " AND u.numero_documento = ?";
        }

        if ($nombre) {
            $cadenaSql .= " AND u.nombres LIKE ?";
        }

        if ($apellido) {
            $cadenaSql .= " AND u.apellidos LIKE ?";
        }

        $stmt = $this->conectarse->conexion->prepare($cadenaSql);
        
        if ($stmt === false) {
            die("Error en la preparación: " . $this->conectarse->conexion->error);
        }

        if ($fecha_desde && $fecha_hasta) {
            $stmt->bind_param("ississ", $id, $fecha_desde, $fecha_hasta, $fecha_desde, $fecha_hasta, $numero_documento, $nombre, $apellido);
        } else {
            $stmt->bind_param("i", $id);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado;
    }
}