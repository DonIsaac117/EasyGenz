<?php

class Enrutador
{
    public function CargarVista($vista)
    {
        $carpetaArchivo = explode("/", $vista);

        if ($carpetaArchivo[0] == "usuario") {
            switch ($carpetaArchivo[1]) {
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
                case "registrar":
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $usuarioController = new UsuarioController();
                        $usuarioController->registrar();
                    } else {
                        include "./views/usuario/form.php";
                    }
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
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $usuarioController = new UsuarioController();
                        $usuarioController->gestionarIngreso();
                    } else {
                        include "./views/usuario/ingreso.php";
                    }
                    break;
                    
                case "TYC":
                    require_once ("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
                    break;

                default:
                    require_once ("./views/pageNotFound.php");
                    break;


            }

        }else if ($carpetaArchivo[0] == "ingresoSalida") {
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
        }else if ($carpetaArchivo[0] == "instructor") {
            switch ($carpetaArchivo[1]) {
                case "inicio":
                    require_once ("./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php");
                    break;
                    case "ficha":
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $programaNumeroFichaController = new ProgramaNumeroFichaController();
                            // Obtén el ID del programa
                            $idPrograma = $programaNumeroFichaController->registrarPrograma();
                    
                            if ($idPrograma !== null) {
                                // Registra la ficha usando el ID del programa
                                $programaNumeroFichaController->registrarFicha($idPrograma);
                            } else {
                                echo "Error: No se pudo obtener el ID del programa.";
                            }
                        } else {
                            include "./views/instructor/ficha.php";
                        }
                        break;
                    case "aprendiz":
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $usuarioController = new UsuarioController();
                            $usuarioController->asignarFichaAprendiz();
                        }else {
                          include "./views/instructor/ficha.php";
                        }
                        break;
                    
                case "soporte":
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $usuarioController = new UsuarioController();
                        $usuarioController->soporte();
                    } else {
                        include "./views/instructor/soporte.php";
                    }
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

                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $usuarioController = new UsuarioController();
                            $usuarioController->soporte();
                        } else {
                            include "./views/funcionario/soporte.php";
                        }
                        break;
                        case "usuariosData":
                            require_once "./views/" . $carpetaArchivo[0] . "/" . $carpetaArchivo[1] . ".php";
                            break;
                default:
                    require_once ("./views/pageNotFound.php");
                    break;
            }
        }
    }
}


