<?php

require_once ("./config/ConectorBD.php");

class Usuarios
{
    private $id;
    private $nombres;
    private $apellidos;
    private $tipo_documento;
    private $numero_documento;
    private $telefono;
    private $email;
    private $contraseña;
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

    public function getContraseña() {return $this->contraseña;}
    public function setContraseña($contraseña) {$this->contraseña = $contraseña;}

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
          '$this->contraseña', 
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
                contrasena = '$this->contraseña',
                rh = '$this->rh',
                eps = '$this->eps',
                contacto_emergencia = '$this->contacto_emergencia',
                enfermedades = '$this->enfermedades',
                alergias = '$this->alergias'
                WHERE id = $this->id";
        $this->conectarse->consultaSinRetorno($cadenaSql);
    }


    public function verificarCredenciales() {
        $cadenaSql = "SELECT * FROM usuarios WHERE numero_documento = '$this->numero_documento' AND contrasena = '$this->contraseña'";
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
}
    


