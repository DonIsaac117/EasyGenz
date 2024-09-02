<?php

require_once("./config/ConectorBD.php");
require_once("./models/Programa.php");

class ProgramaController{
    private $programaModel;

    public function __construct() {
        $this->programaModel = new Programa();
    }

    public function listar() {
        return $this->programaModel->listAll();
    }

}
        
    


    
