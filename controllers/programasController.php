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

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->programaModel->setId($_POST['id']);
            $this->programaModel->setNombre($_POST['nombre']);
            $this->programaModel->setid_tipo_programa($_POST['tipo']);
            $this->programaModel->insertar();
            header('Location: index.php?vista=programa/inicio');
        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
            $id = intval($_POST['eliminar']);
            $this->programaModel->eliminar($id);
            header("Location: index.php?vista=programa/inicio");
            exit();
        }
    }


    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->programaModel->setId($_POST['id']);
            $this->programaModel->setNombre($_POST['nombre']);
            $this->programaModel->setid_tipo_programa($_POST['tipo']);

    
            $this->programaModel->actualizar();
            header('Location: index.php?vista=programa/inicio');
        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
    }
}
    
