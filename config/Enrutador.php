<?php

class Enrutador { 
    public function CargarVista($vista) {
        $carpetaArchivo = explode("/", $vista);
        
        if ($carpetaArchivo[0] == "usuario") {
            switch ($carpetaArchivo[1]) {
                case "login":
                    $usuarioController = new UsuarioController();
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $numero_documento = $_POST['documento'];
                        $contraseña = $_POST['contrasena'];
                        $usuarioController->login($numero_documento, $contraseña);
                    } else {
                        include "./views/usuario/login.php";
                    }
                    break;
                case "recuperar":
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $usuarioController = new UsuarioController();
                        $usuarioController->recuperar();
                    } else {
                        include "./views/usuario/recuperar.php";
                    }
                    break;
                case "nuevaC":
                    $usuarioController = new UsuarioController();
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $usuarioController->nuevaContrasena(); // Procesa el cambio de contraseña
                    } else {
                       $usuarioController->redireccionNuevaC(); // Muestra el formulario de cambio de contraseña
                    }
                    break;
                    case "inicio":
                        echo $carpetaArchivo[1];
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
                default:
                    require_once("./views/pageNotFound.php");
                    break;
            }  
              
        }else if($carpetaArchivo[0] == "programa"){
            switch ($carpetaArchivo[1]) {
                case "inicio":
                    echo $carpetaArchivo[1];
                    require_once("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
                    break;
                case "registrar":
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $programaController = new ProgramaController();
                        $programaController->registrar();
                    } else {
                        include "./views/usuario/form.php";
                    }
                    break;
                case "eliminar":
                    $programaController = new programaController();
                    $programaController->eliminar();
                    break;
                case 'actualizar':
                    $programaController = new programaController();
                    $programaController->actualizar();
                    break;
                default:
                    require_once("./views/pageNotFound.php");
                    break;
            } 
        }else if($carpetaArchivo[0] == "ingresoSalida"){
            switch ($carpetaArchivo[1]) {
                case "inicio":
                    require_once("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
                    break;
                case "registrar":
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $IngresoSalidaController = new IngresoSalidaController();
                        $IngresoSalidaController->registrar();
                    } else {
                        include "./views/usuario/form.php";
                    }
                    break;
                case "eliminar":
                    $IngresoSalidaController = new IngresoSalidaController();
                    $IngresoSalidaController->eliminar();
                    break;
                case 'actualizar':
                    $IngresoSalidaController = new IngresoSalidaController();
                    $IngresoSalidaController->actualizar();
                    break;
                default:
                    require_once("./views/pageNotFound.php");
                    break;
            }
        }else if($carpetaArchivo[0] == "numeroFicha"){
            switch ($carpetaArchivo[1]) {
                case "inicio":
                    require_once("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
                    break;
                case "registrar":
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $NumeroFichaController = new NumeroFichaController();
                        $NumeroFichaController->registrar();
                    } else {
                        include "./views/usuario/form.php";
                    }
                    break;
                case "eliminar":
                    $NumeroFichaController = new NumeroFichaController();
                    $NumeroFichaController->eliminar();
                    break;
                case 'actualizar':
                    $NumeroFichaController = new NumeroFichaController();
                    $NumeroFichaController->actualizar();
                    break;
                default:
                    require_once("./views/pageNotFound.php");
                    break;   
            }
        }else if($carpetaArchivo[0] == "funcionario"){
            switch ($carpetaArchivo[1]) {
                case "inicio":
                    require_once("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
                    break;
            }
        }
    }
}


?>
