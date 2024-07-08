<?php

class Enrutador {
    public function CargarVista($vista) {
        $carpetaArchivo = explode("/", $vista);

        switch ($carpetaArchivo[1]) {
            case "inicio":
                require_once("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
                break;
            case "registrar":
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $usuarioController = new UsuarioController();
                    $usuarioController->registrar();
                } else {
                    include "./views/usuario/form.php";
                }
                break;
            case "eliminar":
                $usuarioController = new UsuarioController();
                $usuarioController->eliminar();
                break;
            case 'actualizar':
                $usuarioController = new UsuarioController();
                $usuarioController->actualizar();
                break;
            case "login":
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $usuarioController = new UsuarioController();
                    $usuarioController->login();
                } else {
                    include "./views/usuario/login.php";
                }
                break; 
            default:
                require_once("./views/pageNotFound.php");
        }        
    }
}

?>
