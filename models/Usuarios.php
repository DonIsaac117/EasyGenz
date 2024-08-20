<?php

require_once './config/ConexionBd.php';

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
        $this->conectarse = new ConexionBD();
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

    public function eliminar($id) {
        $id = intval($id);
        $cadenaSql = "DELETE FROM usuarios WHERE id = $id";
        $this->conectarse->consultaSinRetorno($cadenaSql);
    }    
    
    public function actualizar() {
        $cadenaSql = "UPDATE usuarios SET 
                nombres = '$this->nombres',
                apellidos = '$this->apellidos',
                tipo_documento = '$this->tipo_documento',
                numero_documento = '$this->numero_documento',
                telefono = '$this->telefono',
                email = '$this->email',
                contrasena = '$this->contrasena',
                rh = '$this->rh',
                eps = '$this->eps',
                contacto_emergencia = '$this->contacto_emergencia',
                enfermedades = '$this->enfermedades',
                alergias = '$this->alergias'
                WHERE id = $this->id";
        $this->conectarse->consultaSinRetorno($cadenaSql);
    }


    public function verificarCredenciales() {
        $cadenaSql = "SELECT * FROM usuarios WHERE numero_documento = '$this->numero_documento' AND contrasena = '$this->contrasena'";
        $resultado = $this->conectarse->consultaConRetorno($cadenaSql);
    
        if ($resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        } else {
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

    public function obtenerPerfilPorIdUsuario($id_usuario) {
        $conexion = $this->conectarse->conexion;
        $sql = "SELECT perfil FROM perfil 
                INNER JOIN usuario_perfil ON perfil.id = usuario_perfil.id_perfil 
                WHERE usuario_perfil.id_usuario = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['perfil'];
    }
    

    public function obtenerUsuarioPorContrasena($contrasena) {
        $sql = "SELECT * FROM usuarios WHERE contrasena = ?";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param("s", $contrasena);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
    
    public function registrarEntrada($id_usuario) {
        // Obtén el código del número de ficha relacionado con este usuario
        $codigo_numeroficha = $this->obtenerCodigoFichaPorUsuario($id_usuario);
        
        // Establece la fecha y hora actuales
        $fecha = date("Y-m-d");
        $hora_entrada = date("H:i:s");
    
        // Inserta el registro de entrada en la tabla `ingresosalida_ficha`
        $sql = "INSERT INTO ingresosalida_ficha (id_usuario, codigo_numeroficha, fecha, hora_entrada, observacion, estado) 
                VALUES (?, ?, ?, ?, NULL, NULL)";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param("isss", $id_usuario, $codigo_numeroficha, $fecha, $hora_entrada);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function registrarSalida($id_usuario) {
        // Obtén el código del número de ficha relacionado con este usuario
        $codigo_numeroficha = $this->obtenerCodigoFichaPorUsuario($id_usuario);
        
        // Establece la fecha y hora actuales
        $fecha = date("Y-m-d");
        $hora_salida = date("H:i:s");
    
        // Actualiza el registro de salida en la tabla `ingresosalida_ficha`
        $sql = "UPDATE ingresosalida_ficha SET hora_salida = ? 
                WHERE id_usuario = ? AND codigo_numeroficha = ? AND fecha = ? AND hora_salida IS NULL";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param("siss", $hora_salida, $id_usuario, $codigo_numeroficha, $fecha);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function registrarEntradaFuncionario($id_usuario, $observacion = null) {
        $fecha = date('Y-m-d');
        $hora_entrada = date('H:i:s');
        $sql = "INSERT INTO controlfuncionarios (id_usuario, fecha, hora_entrada, observacion, estado) 
                VALUES (?, ?, ?, ?, 'activo')";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param('isss', $id_usuario, $fecha, $hora_entrada, $observacion);
        return $stmt->execute();
    }
    
    public function registrarSalidaFuncionario($id_usuario) {
        $fecha = date('Y-m-d');
        $hora_salida = date('H:i:s');
        $sql = "UPDATE controlfuncionarios SET hora_salida = ?, estado = 'inactivo' 
                WHERE id_usuario = ? AND fecha = ? AND hora_salida IS NULL";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param('sis', $hora_salida, $id_usuario, $fecha);
        return $stmt->execute();
    }
    
    private function obtenerCodigoFichaPorUsuario($id_usuario) {
        // Consulta el código del número de ficha desde la tabla `aprendiz`
        $sql = "SELECT codigo_numeroficha FROM aprendiz WHERE id_usuario = ?";
        $stmt = $this->conectarse->conexion->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();

        return $fila['codigo_numeroficha'];
    }
    
    

    public function obtenerUsuarioPorId($id) {
        $conexion = $this->conectarse->conexion;
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function obtenerPerfilUsuario($id) {
        $conexion = $this->conectarse->conexion;
        $sql= "SELECT p.perfil
            FROM perfil p
            INNER JOIN usuario_perfil up ON p.id = up.id_perfil
            WHERE up.id_usuario = ?";
            
        
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        
    }
}
    


