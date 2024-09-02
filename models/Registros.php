<?php

require_once(__DIR__ . '/../config/ConectorBD.php');


class Registro
{
    private $conectarse;

    public function __construct()
    {
        $this->conectarse = new ConectorBD();
    }

    public function getAll($documento = null, $nombre = null, $apellido = null, $fechaDesde = null, $fechaHasta = null)
    {
        $params = [];
        $sql = "SELECT id, email, telefono, UPPER(rh) as rh, contacto_emergencia, u.numero_documento,
                   CONCAT(UPPER(SUBSTRING(alergias, 1, 1)), LOWER(SUBSTRING(alergias, 2))) AS alergias,
                   CONCAT(UPPER(SUBSTRING(enfermedades, 1, 1)), LOWER(SUBSTRING(enfermedades, 2))) AS enfermedades,
                   CONCAT(UPPER(SUBSTRING(eps, 1, 1)), LOWER(SUBSTRING(eps, 2))) AS eps,
                    CONCAT(
                       UPPER(LEFT(SUBSTRING_INDEX(u.nombres, ' ', 1), 1)),
                       LOWER(SUBSTRING(SUBSTRING_INDEX(u.nombres, ' ', 1), 2)),
                       IF(
                           LOCATE(' ', u.nombres) > 0,
                           CONCAT(' ', UPPER(LEFT(SUBSTRING_INDEX(u.nombres, ' ', -1), 1)), LOWER(SUBSTRING(SUBSTRING_INDEX(u.nombres, ' ', -1), 2))),
                           ''
                       )
                   ) AS nombres,
                   CONCAT(
                       UPPER(LEFT(SUBSTRING_INDEX(u.apellidos, ' ', 1), 1)),
                       LOWER(SUBSTRING(SUBSTRING_INDEX(u.apellidos, ' ', 1), 2)),
                       IF(
                           LOCATE(' ', u.apellidos) > 0,
                           CONCAT(' ', UPPER(LEFT(SUBSTRING_INDEX(u.apellidos, ' ', -1), 1)), LOWER(SUBSTRING(SUBSTRING_INDEX(u.apellidos, ' ', -1), 2))),
                           ''
                       )
                   ) AS apellidos,
                   CONCAT(UPPER(SUBSTRING(IFNULL(cf.observacion, isa.observacion), 1, 1)), LOWER(SUBSTRING(IFNULL(cf.observacion, isa.observacion), 2))) AS observacion,

                   IFNULL(cf.hora_entrada, isa.hora_entrada) as hora_entrada,
                   IFNULL(cf.hora_salida, isa.hora_salida) as hora_salida,
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

        $sql .= " ORDER BY IFNULL(cf.fecha, isa.fecha) DESC";

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

    public function getAprendices($documento = null, $nombre = null, $apellido = null, $fechaDesde = null, $fechaHasta = null)
    {
        $params = [];
        $sql = "SELECT u.id, email, telefono, UPPER(rh) as rh, contacto_emergencia, u.numero_documento,
        CONCAT(UPPER(SUBSTRING(alergias, 1, 1)), LOWER(SUBSTRING(alergias, 2))) AS alergias,
        CONCAT(UPPER(SUBSTRING(enfermedades, 1, 1)), LOWER(SUBSTRING(enfermedades, 2))) AS enfermedades,
        CONCAT(UPPER(SUBSTRING(eps, 1, 1)), LOWER(SUBSTRING(eps, 2))) AS eps,
         CONCAT(
            UPPER(LEFT(SUBSTRING_INDEX(u.nombres, ' ', 1), 1)),
            LOWER(SUBSTRING(SUBSTRING_INDEX(u.nombres, ' ', 1), 2)),
            IF(
                LOCATE(' ', u.nombres) > 0,
                CONCAT(' ', UPPER(LEFT(SUBSTRING_INDEX(u.nombres, ' ', -1), 1)), LOWER(SUBSTRING(SUBSTRING_INDEX(u.nombres, ' ', -1), 2))),
                ''
            )
        ) AS nombres,
        CONCAT(
            UPPER(LEFT(SUBSTRING_INDEX(u.apellidos, ' ', 1), 1)),
            LOWER(SUBSTRING(SUBSTRING_INDEX(u.apellidos, ' ', 1), 2)),
            IF(
                LOCATE(' ', u.apellidos) > 0,
                CONCAT(' ', UPPER(LEFT(SUBSTRING_INDEX(u.apellidos, ' ', -1), 1)), LOWER(SUBSTRING(SUBSTRING_INDEX(u.apellidos, ' ', -1), 2))),
                ''
            )
        ) AS apellidos
                FROM usuarios u
                INNER JOIN usuario_perfil up ON u.id = up.id_usuario
                INNER JOIN perfil p ON up.id_perfil = p.id
                WHERE perfil = 'Aprendiz'";
    
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
            $sql .= " AND u.created_at >= ?";
            $params[] = $fechaDesde;
        }
    
        if ($fechaHasta) {
            $sql .= " AND u.created_at <= ?";
            $params[] = $fechaHasta;
        }
    
        $sql .= " ORDER BY u.nombres ASC";
    
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