<?php 
require_once(__DIR__ . '/../config/ConectorBd.php');
class usuarioModel{
    //atributo-propiedades
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
    //metodos-funciones

    public function __construct(){
        $this->conectarse = new ConectorBd();
    }
    
    //getter y setter
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id=$id;
    }

    public function getNombres (){
        return $this->nombres;
    }

    public function setNombres ($nombres ){
        $this->nombres =$nombres ;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        $this->apellidos=$apellidos;
    }
    public function getTipoDocumento(){
        return $this->tipo_documento;
    }

    public function setTipoDocumento($tipo_documento){
        $this->tipo_documento=$tipo_documento;
    }
    public function getNumeroDocumento(){
        return $this->numero_documento;
    }

    public function setNumeroDocumento($numero_documento){
        $this->numero_documento=$numero_documento;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }
    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email=$email;
    }

    public function getContrasena(){
        return $this->contrasena;
    }

    public function setContrasena($contrasena){
        $this->contrasena=$contrasena;
    }
    public function getHuella(){
        return $this->huella;
    }

    public function setHuella($huella){
        $this->huella=$huella;
    }
    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }
    public function getEps(){
        return $this->eps;
    }

    public function setEps($eps){
        $this->eps=$eps;
    }
    public function getRh(){
        return $this->rh;
    }

    public function setRh($rh){
        $this->rh=$rh;
    }
    public function getContactoEmergencia(){
        return $this->contacto_emergencia;
    }

    public function setContactoEmergencia($contacto_emergencia){
        $this->contacto_emergencia=$contacto_emergencia;
    }
    public function getEnfermedades(){
        return $this->enfermedades;
    }

    public function setEnfermedades($enfermedades){
        $this->enfermedades=$enfermedades;
    }
    public function getAlergias(){
        return $this->alergias;
    }

    public function setAlergias($alergias){
        $this->alergias=$alergias;
    }

    //listar los datos
    public function listAll(){
        $cadenaSql = "SELECT * FROM usuarios";    
        $resultado = $this->conectarse->consultaConRetorno($cadenaSql);
        $datos = $resultado->fetch_all();
        return $datos;
    }

    // registrar

    public function insertar()
    {
        $cadenaSql =
        "INSERT INTO usuarios(nombres, apellidos, tipo_documento, numero_documento, telefono, email, contrasena, rh, eps, contacto_emergencia, enfermedades, alergias)
         VALUES ('$this->nombres', '$this->apellidos', '$this->tipo_documento', '$this->numero_documento', '$this->telefono', '$this->email', '$this->contrasena', '$this->rh', '$this->eps', '$this->contacto_emergencia', '$this->enfermedades', '$this->alergias')";
        $this->conectarse->consultaSinRetorno($cadenaSql);  
    }
    //cambiar contraseña
    public function cambiarContrasena() {
        $cadenaSql = "UPDATE usuarios SET contrasena = $this->contrasena WHERE email = '$this->email'";
        $this->conectarse->consultaSinRetorno($cadenaSql);  
    }


    //create, upadete, delete

}