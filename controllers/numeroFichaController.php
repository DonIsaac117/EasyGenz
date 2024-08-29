<?php

require_once("./config/ConectorBD.php");
require_once("./models/NumeroFicha.php");

class NumeroFichaController{
    private $NumeroFichaModel;

    public function __construct() {
        $this->NumeroFichaModel = new NumeroFicha();
    }

    public function listar() {
        return $this->NumeroFichaModel->listAll();
    }

}
    
