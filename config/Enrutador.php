<?php

class Enrutador
{
    public function CargarVista($vista)
    {
        $carpetaArchivo = explode("/", $vista);

        if ($carpetaArchivo[0] == "usuario") {
            switch ($carpetaArchivo[1]) {
                case "recuperar":
                    $usuarioController = new UsuarioController();
                    $usuarioController->recuperar();
                    break;

                case "nuevaC":
                    $usuarioController = new UsuarioController();
                    $usuarioController->nuevaContrasena();
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
                case "ingreso":
                    $usuarioController = new UsuarioController();
                    $usuarioController->gestionarIngreso();
                break;
                default:
                    require_once ("./views/pageNotFound.php");
                    break;
            }

        } else if ($carpetaArchivo[0] == "programa") {
            switch ($carpetaArchivo[1]) {
                case "inicio":
                    echo $carpetaArchivo[1];
                    require_once ("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
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
                    require_once ("./views/pageNotFound.php");
                    break;
            }
        } else if ($carpetaArchivo[0] == "ingresoSalida") {
            switch ($carpetaArchivo[1]) {
                case "inicio":
                    require_once ("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
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
                    require_once ("./views/pageNotFound.php");
                    break;
            }
        } else if ($carpetaArchivo[0] == "numeroFicha") {
            switch ($carpetaArchivo[1]) {
                case "inicio":
                    require_once ("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
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
                    require_once ("./views/pageNotFound.php");
                    break;
            }
        } else if ($carpetaArchivo[0] == "funcionario") {
            switch ($carpetaArchivo[1]) {
                case "inicio":
                    require_once ("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
                    break;
                    case "registros":
                        require_once ("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
                        break;
                        case "soporte":
                            require_once ("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
                            break;

                default:
                    require_once ("./views/pageNotFound.php");
                    break;
            }
        }
    }
}


