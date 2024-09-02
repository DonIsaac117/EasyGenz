<?php

require_once(__DIR__ . '/../config/ConectorBD.php');

class Usuarios
{
    private $id;
    private $nombres;
    private $apellidos;
    private $tipo_documento;
    private $numero_documento;
    private $telefono;
    private $email;
    private $contrasena;
    private $huella;
    private $codigo;
    private $eps;
    private $rh;
    private $contacto_emergencia;
    private $enfermedades;
    private $alergias;
    private $conectarse;

    //metodos - funciones

    public function __construct(){
        $this->conectarse = new ConectorBD();
    }

    //getter y setter
    public function getId(){return $this->id;}
    public function setId($id){$this ->id = $id;}

    public function getNombres() {return $this->nombres;}
    public function setNombres($nombres) { $this->nombres = $nombres;}

    public function getApellidos() {return $this->apellidos;}
    public function setApellidos($apellidos) {$this->apellidos = $apellidos;}

    public function getTipoDocumento() {return $this->tipo_documento;}
    public function setTipoDocumento($tipo_documento) { $this->tipo_documento = $tipo_documento;}

    public function getNumeroDocumento() {return $this->numero_documento;}
    public function setNumeroDocumento($numero_documento) {$this->numero_documento = $numero_documento;}

    public function getTelefono() {return $this->telefono; }
    public function setTelefono($telefono) {$this->telefono = $telefono;}

    public function getEmail() {return $this->email;}
    public function setEmail($email) {$this->email = $email;}

    public function getContraseña() {return $this->contrasena;}
    public function setContraseña($contrasena) {$this->contrasena = $contrasena;}

    public function getRh() { return $this->rh; }
    public function setRh($rh) { $this->rh = $rh; }

    public function getEps() {return $this->eps;}
    public function setEps($eps) {$this->eps = $eps;}

    public function getContactoEmergencia() {return $this->contacto_emergencia;}
    public function setContactoEmergencia($contacto_emergencia) { $this->contacto_emergencia = $contacto_emergencia;}

    public function getEnfermedades() {return $this->enfermedades;}
    public function setEnfermedades($enfermedades) {$this->enfermedades = $enfermedades;}

    public function getAlergias() {return $this->alergias;}
    public function setAlergias($alergias) { $this->alergias = $alergias;}

    public function listAll(){
        $cadenaSql = "SELECT * FROM usuarios";
        $resultado = $this->conectarse->consultaConRetorno($cadenaSql);
        $datos = $resultado->fetch_all();
        return $datos;
    }

    public function listAllFilter($filters = [])
    {
        $cadenaSql = "SELECT id, nombres, apellidos, numero_documento FROM usuarios WHERE 1=1";

        // Aplicar filtros de búsqueda
        if (!empty($filters['nombre'])) {
            $cadenaSql .= " AND nombre LIKE '%" . $this->conectarse->conexion->real_escape_string($filters['nombre']) . "%'";
        }
        if (!empty($filters['apellido'])) {
            $cadenaSql .= " AND apellido LIKE '%" . $this->conectarse->conexion->real_escape_string($filters['apellido']) . "%'";
        }
        if (!empty($filters['numero_documento'])) {
            $cadenaSql .= " AND numero_documento = '" . $this->conectarse->conexion->real_escape_string($filters['numero_documento']) . "'";
        }

        $resultado = $this->conectarse->consultaConRetorno($cadenaSql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    
    public function insertar()
    {
        $cadenaSql =
        "INSERT INTO
        usuarios(
         nombres,
         apellidos, 
         tipo_documento, 
         numero_documento, 
         telefono, 
         email, 
         contrasena, 
         rh, 
         eps, 
         contacto_emergencia, 
         enfermedades, 
         alergias)
         VALUES
         ('$this->nombres',
          '$this->apellidos', 
          '$this->tipo_documento', 
          '$this->numero_documento', 
          '$this->telefono', 
          '$this->email', 
          '$this->contrasena', 
          '$this->rh', 
          '$this->eps', 
          '$this->contacto_emergencia', 
          '$this->enfermedades', 
          '$this->alergias')";
        $this->conectarse->consultaSinRetorno($cadenaSql);  
    }

    public function contraseñaExiste($contrasena) {
        $conexion = $this->conectarse->conexion;
        $sql = "SELECT COUNT(*) FROM usuarios WHERE contrasena = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('s', $contrasena);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }

    public function actualizar()
    {
        $conexion = $this->conectarse->conexion;
        $sql = "UPDATE usuarios SET 
                nombres = ?, apellidos = ?, tipo_documento = ?, numero_documento = ?, telefono = ?, email = ?, contrasena = ?, rh = ?, eps = ?, contacto_emergencia = ?, enfermedades = ?, alergias = ?
                WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('ssssssssssssi', $this->nombres, $this->apellidos, $this->tipo_documento, $this->numero_documento, $this->telefono, $this->email, $this->contrasena, $this->rh, $this->eps, $this->contacto_emergencia, $this->enfermedades, $this->alergias, $this->id);
        $stmt->execute();
    }

    public function eliminar($id)
    {
        $conexion = $this->conectarse->conexion;
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }


    public function verificarCredenciales($numero_documento, $contrasena) {
        $conexion = $this->conectarse->conexion;
        
        $sql = "SELECT * FROM usuarios WHERE numero_documento = ?";
        $stmt = $conexion->prepare($sql);

        if (!$stmt) {
            echo "Error en la preparación: " . $conexion->error;
            return false;
        }

        $stmt->bind_param('s', $numero_documento);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            echo "Error en la ejecución: " . $stmt->error;
            return false;
        }

        $usuario = $result->fetch_assoc();

        if ($usuario) {
            if ($contrasena === $usuario['contrasena']) {
                $this->id=$usuario['id'];
                return true;
            } else {
                echo "Contraseña incorrecta";
                return false;
            }
        } else {
            echo "Usuario no encontrado";
            return false;
        }
    }

    public function existedocumento() {
        $cadenaSql = "SELECT * FROM usuarios WHERE numero_documento = '$this->numero_documento'";
        $resultado = $this->conectarse->consultaConRetorno($cadenaSql);
    
        if ($resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        } else {
            return false;
        }
    }

    public function obtenerUsuarioPorCorreo($correo) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function actualizarContrasena($email, $nuevaContrasena) {
        $sql = "UPDATE usuarios SET contrasena = ? WHERE email = ?";
        $stmt = $this->conectarse->conexion->prepare($sql);
    
        if (!$stmt) {
            echo "Error en la preparación: " . $this->conectarse->conexion->error;
            return false;
        }
    
        $stmt->bind_param("ss", $nuevaContrasena, $email);
        
        if (!$stmt->execute()) {
            echo "Error en la ejecución: " . $stmt->error;
            return false;
        }
    
        return true;
    }


    
   
    //INGRESO Y SALIDA
    public function obtenerUsuarioPorContrasena($contrasena) {
        $sql = "SELECT * FROM usuarios WHERE contrasena = ?";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param('s', $contrasena);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
    
    public function obtenerPerfilPorIdUsuario($idUsuario) {
        $sql = "SELECT perfil.id FROM usuario_perfil 
                JOIN perfil ON usuario_perfil.id_perfil = perfil.id 
                WHERE usuario_perfil.id_usuario = ?";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $perfil = $resultado->fetch_assoc();
        return $perfil['id'];
    }
    
public function gestionarEntradaSalida($idUsuario, $observacion = null) {
    $fecha = date('Y-m-d');
    $horaActual = date('H:i:s');
    
    // Obtener perfil del usuario
    $perfil = $this->obtenerPerfilPorIdUsuario($idUsuario);
    
    if ($perfil == 3) {
        // Funcionario
        $tabla = "controlfuncionarios";
    } else {
        // Aprendiz o Instructor
        $tabla = "ingresosalida_ficha";
        $codigoFicha = $this->obtenerCodigoFicha($idUsuario);
    }
    
    // Verificar si ya hay una sesión activa
    $sqlVerificar = "SELECT * FROM $tabla WHERE id_usuario = ? AND fecha = ? AND hora_salida IS NULL";
    $stmtVerificar = $this->conectarse->conexion->prepare($sqlVerificar);
    $stmtVerificar->bind_param('is', $idUsuario, $fecha);
    $stmtVerificar->execute();
    $resultado = $stmtVerificar->get_result();
    
    if ($resultado->num_rows > 0) {
        // Registrar salida
        $sqlSalida = "UPDATE $tabla SET hora_salida = ?, observacion = ?, estado = 'inactivo' 
                      WHERE id_usuario = ? AND fecha = ? AND hora_salida IS NULL";
        $stmtSalida = $this->conectarse->conexion->prepare($sqlSalida);
        $stmtSalida->bind_param('ssis', $horaActual, $observacion, $idUsuario, $fecha);
        return $stmtSalida->execute() ? 'salida' : false;
    } else {
        // Registrar entrada
        if ($perfil == 3) {
            $sqlEntrada = "INSERT INTO $tabla (id_usuario, fecha, hora_entrada, observacion, estado) 
                           VALUES (?, ?, ?, ?, 'activo')";
            $stmtEntrada = $this->conectarse->conexion->prepare($sqlEntrada);
            $stmtEntrada->bind_param('isss', $idUsuario, $fecha, $horaActual, $observacion);
        } else {
            $sqlEntrada = "INSERT INTO $tabla (id_usuario, codigo_numeroficha, fecha, hora_entrada, observacion, estado) 
                           VALUES (?, ?, ?, ?, ?, 'activo')";
            $stmtEntrada = $this->conectarse->conexion->prepare($sqlEntrada);
            $stmtEntrada->bind_param('issss', $idUsuario, $codigoFicha, $fecha, $horaActual, $observacion);
        }
        return $stmtEntrada->execute() ? 'entrada' : false;
    }
}

    
    public function obtenerCodigoFicha($idUsuario) {
        $sql = "SELECT codigo FROM numero_ficha 
                WHERE codigo IN (SELECT codigo_numeroficha FROM aprendiz WHERE id_usuario = ?)";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $codigoFicha = $resultado->fetch_assoc();
        return $codigoFicha['codigo'] ?? null;
    }
    

    public function obtenerUsuarioPorId($id)
    {
        $conexion = $this->conectarse->conexion;
        $sql = "SELECT id, email, UPPER(tipo_documento) as tipo_documento, contrasena, telefono, UPPER(rh) as rh, contacto_emergencia, numero_documento,
        CONCAT(UPPER(SUBSTRING(alergias, 1, 1)), LOWER(SUBSTRING(alergias, 2))) AS alergias,
        CONCAT(UPPER(SUBSTRING(enfermedades, 1, 1)), LOWER(SUBSTRING(enfermedades, 2))) AS enfermedades,
        CONCAT(UPPER(SUBSTRING(eps, 1, 1)), LOWER(SUBSTRING(eps, 2))) AS eps,
        CONCAT(
            UPPER(LEFT(SUBSTRING_INDEX(nombres, ' ', 1), 1)),
            LOWER(SUBSTRING(SUBSTRING_INDEX(nombres, ' ', 1), 2)),
            IF(
                LOCATE(' ', nombres) > 0,
                CONCAT(' ', UPPER(LEFT(SUBSTRING_INDEX(nombres, ' ', -1), 1)), LOWER(SUBSTRING(SUBSTRING_INDEX(nombres, ' ', -1), 2))),
                ''
            )
        ) AS nombres,
        CONCAT(
            UPPER(LEFT(SUBSTRING_INDEX(apellidos, ' ', 1), 1)),
            LOWER(SUBSTRING(SUBSTRING_INDEX(apellidos, ' ', 1), 2)),
            IF(
                LOCATE(' ', apellidos) > 0,
                CONCAT(' ', UPPER(LEFT(SUBSTRING_INDEX(apellidos, ' ', -1), 1)), LOWER(SUBSTRING(SUBSTRING_INDEX(apellidos, ' ', -1), 2))),
                ''
            )
        ) AS apellidos
        FROM usuarios
        WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function obtenerPerfilUsuario($id) {
        $conexion = $this->conectarse->conexion;
        $sql= "SELECT CONCAT(UPPER(SUBSTRING(p.perfil, 1, 1)), LOWER(SUBSTRING(p.perfil, 2))) as perfil
            FROM perfil p
            INNER JOIN usuario_perfil up ON p.id = up.id_perfil
            WHERE up.id_usuario = ?";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        
    }

    public function search($searchTerm)
    {
        $conexion = $this->conectarse->conexion;
        $cadenaSql = "SELECT *
                   FROM usuarios 
                      WHERE numero_documento LIKE ? 
                      OR nombres LIKE ? 
                      OR apellidos LIKE ?
                      OR telefono LIKE ?
                      OR email LIKE ?";
        $stmt = $conexion->prepare($cadenaSql);
        $searchTerm = "%$searchTerm%";
        $stmt->bind_param('sssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function actualizarUsuario($id, $nombres, $apellidos, $tipo_documento, $numero_documento, $telefono, $email, $contrasena, $rh, $eps, $contacto_emergencia, $enfermedades, $alergias)
    {
        $sql = "UPDATE usuarios SET nombres=?, apellidos=?, tipo_documento=?, numero_documento=?, telefono=?, email=?, contrasena=?, rh=?, eps=?, contacto_emergencia=?, enfermedades=?, alergias=? WHERE id=?";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param('ssssssssssssi', $nombres, $apellidos, $tipo_documento, $numero_documento, $telefono, $email, $contrasena, $rh, $eps, $contacto_emergencia, $enfermedades, $alergias, $id);
        return $stmt->execute();
    }

    public function registrarAprendiz($idUsuario, $numeroFicha) {
        $sql = "INSERT INTO aprendiz (id_usuario, codigo_numeroficha) VALUES (?, ?)";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param('ii', $idUsuario, $numeroFicha);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function usuarioTieneFicha($idUsuario) {
        $sql = "SELECT COUNT(*) as count FROM aprendiz WHERE id_usuario = ?";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $row = $resultado->fetch_assoc();
        return $row['count'] > 0;
    }

    // Método para verificar si el número de ficha existe
    public function fichaExiste($numeroFicha) {
        // Consulta actualizada para la tabla `numero_ficha` y campo `codigo`
        $sql = "SELECT COUNT(*) as count FROM numero_ficha WHERE codigo = ?";
        $stmt = $this->conectarse->conexion->prepare($sql);
        
        if ($stmt === false) {
            die("Error en la preparación: " . $this->conectarse->conexion->error);
        }
        
        $stmt->bind_param('i', $numeroFicha);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado === false) {
            die("Error en la ejecución: " . $stmt->error);
        }
        
        $row = $resultado->fetch_assoc();
        return $row['count'] > 0;
    }
}
    


