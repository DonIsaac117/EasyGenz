<?php

require_once './config/ConexionBd.php';

class Registro
{
    private $conectarse;

    public function __construct()
    {
        $this->conectarse = new ConexionBd();
    }

    public function getAll($documento = null, $nombre = null, $apellido = null, $fechaDesde = null, $fechaHasta = null)
    {
        $params = [];
        $sql = "SELECT u.numero_documento, u.nombres, u.apellidos, 
                       IFNULL(cf.hora_entrada, isa.hora_entrada) as hora_entrada, 
                       IFNULL(cf.hora_salida, isa.hora_salida) as hora_salida, 
                       IFNULL(cf.observacion, isa.observacion) as observacion, 
                       IFNULL(cf.fecha, isa.fecha) as fecha
                FROM usuarios u
                LEFT JOIN controlfuncionarios cf ON u.id = cf.id_usuario
                LEFT JOIN ingresosalida_ficha isa ON u.id = isa.id_usuario
                WHERE 1=1";

        if ($documento) {
            $sql .= " AND u.numero_documento LIKE ?";
            $params[] = "%$documento%";
        }

        if ($nombre) {
            $sql .= " AND u.nombres LIKE ?";
            $params[] = "%$nombre%";
        }

        if ($apellido) {
            $sql .= " AND u.apellidos LIKE ?";
            $params[] = "%$apellido%";
        }

        if ($fechaDesde) {
            $sql .= " AND IFNULL(cf.fecha, isa.fecha) >= ?";
            $params[] = $fechaDesde;
        }

        if ($fechaHasta) {
            $sql .= " AND IFNULL(cf.fecha, isa.fecha) <= ?";
            $params[] = $fechaHasta;
        }

        $stmt = $this->conectarse->conexion->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación: " . $this->conectarse->conexion->error);
        }

        // Bind parameters dynamically
        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado;
    }
}
