<?php

class Enrutador {
    public function CargarVista($vista) {
        $carpetaArchivo = explode("/", $vista);
        print_r($carpetaArchivo) ;

        switch ($carpetaArchivo[1]) {
            case "inicio":
                require_once("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
                break;
            case "registrar":
                $usuarioController = new UsuarioController();
                $usuarioController->registrar();
                break;
            case "eliminar":
                $usuarioController = new UsuarioController();
                $usuarioController->eliminar();
                break;
            default:
                require_once("./views/pageNotFound.php");
        }        
    }
}

?>
