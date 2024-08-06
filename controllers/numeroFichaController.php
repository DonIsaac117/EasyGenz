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

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->NumeroFichaModel->setcodigo($_POST['codigo']);
            $this->NumeroFichaModel->setjornada($_POST['jornada']);
            $this->NumeroFichaModel->setnombre($_POST['nombre']);
            $this->NumeroFichaModel->setdescripcion($_POST['descripcion']);
            $this->NumeroFichaModel->setid_programa($_POST['id_programa']);
            $this->NumeroFichaModel->insertar();
            header('Location: index.php?vista=numeroFicha/inicio');
        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
            $codigo = intval($_POST['eliminar']);
            $this->NumeroFichaModel->eliminar($codigo);
            header("Location: index.php?vista=numeroFicha/inicio");
            exit();
        }
    }


    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->NumeroFichaModel->setcodigo($_POST['codigo']);
            $this->NumeroFichaModel->setjornada($_POST['jornada']);
            $this->NumeroFichaModel->setnombre($_POST['nombre']);
            $this->NumeroFichaModel->setdescripcion($_POST['descripcion']);
            $this->NumeroFichaModel->setid_programa($_POST['id_programa']);
            $this->NumeroFichaModel->actualizar();
            header('Location: index.php?vista=numeroFicha/inicio');
        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
    }
}
    
