<?php

require_once("./config/ConexionBd.php");
require_once("./models/IngresoSalida.php");

class IngresoSalidaController{
    private $ingresoSalidaModel;

    public function __construct() {
        $this->ingresoSalidaModel = new IngresoSalida();
    }

    public function listar() {
        return $this->ingresoSalidaModel->listAll();
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ingresoSalidaModel->setid_usuario($_POST['id_usuario']);
            $this->ingresoSalidaModel->setcodigo_numeroficha($_POST['codigo_numeroficha']);
            $this->ingresoSalidaModel->setfecha($_POST['fecha']);
            $this->ingresoSalidaModel->sethora_entrada($_POST['hora_entrada']);
            $this->ingresoSalidaModel->sethora_salida($_POST['hora_salida']);
            $this->ingresoSalidaModel->setobservacion($_POST['observacion']);
            $this->ingresoSalidaModel->setestado($_POST['estado']);

            $this->ingresoSalidaModel->insertar();
            header('Location: index.php?vista=ingresoSalida/inicio');
        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar']) && isset($_POST['eliminarh'])) {
            $id_usuario = intval($_POST['eliminar']);
            $hora_entrada = strval($_POST['eliminarh']);
            $this->ingresoSalidaModel->eliminar($id_usuario, $hora_entrada);
            header("Location: index.php?vista=ingresoSalida/inicio");
            exit();
        }
    }


    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ingresoSalidaModel->setid_usuario($_POST['id_usuario']);
            $this->ingresoSalidaModel->sethora_entradaa($_POST['hora_entradaa']);
            $this->ingresoSalidaModel->setcodigo_numeroficha($_POST['codigo_numeroficha']);
            $this->ingresoSalidaModel->setfecha($_POST['fecha']);
            $this->ingresoSalidaModel->sethora_entrada($_POST['hora_entrada']);
            $this->ingresoSalidaModel->sethora_salida($_POST['hora_salida']);
            $this->ingresoSalidaModel->setobservacion($_POST['observacion']);
            $this->ingresoSalidaModel->setestado($_POST['estado']);
    
            $this->ingresoSalidaModel->actualizar();
            header('Location: index.php?vista=ingresoSalida/inicio');
        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
    }
}
    
