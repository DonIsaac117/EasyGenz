<?php

require_once __DIR__ . '/../config/ConectorBD.php';
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../models/Registros.php';
require_once __DIR__ . '/../models/Programa.php';
require_once __DIR__ . '/../models/NumeroFicha.php';


class UsuarioController {  
    private $usuarioModel;
   

    public function __construct() {
        $this->usuarioModel = new Usuarios();
    }
    
    public function listar() {
        return $this->usuarioModel->listAll();
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contrasena = $_POST['contrasena'];
    
            // Verificar si la contraseña ya existe
            if ($this->usuarioModel->contraseñaExiste($contrasena)) {
                echo '<script>alert("La contraseña ya está en uso. Por favor, elige otra."); window.location.href = "index.php?vista=usuario/registrar";</script>';
                exit();
            }
    
            // Si la contraseña no existe, proceder con el registro
            $this->usuarioModel->setNombres($_POST['nombre']);
            $this->usuarioModel->setApellidos($_POST['apellidos']);
            $this->usuarioModel->setTipoDocumento($_POST['tipo_doc']);
            $this->usuarioModel->setNumeroDocumento($_POST['num_doc']);
            $this->usuarioModel->setTelefono($_POST['telefono']);
            $this->usuarioModel->setEmail($_POST['email']);
            $this->usuarioModel->setContraseña($_POST['contrasena']);
            $this->usuarioModel->setRh($_POST['tipo-sangre']);
            $this->usuarioModel->setEps($_POST['eps']);
            $this->usuarioModel->setContactoEmergencia($_POST['contacto-emer']);
            $this->usuarioModel->setEnfermedades($_POST['enfermedades']);
            $this->usuarioModel->setAlergias($_POST['alergias']);
    
            $this->usuarioModel->insertar();
    
            header('location: index.php?vista=usuario/registrar&error=usuario_registrado');
        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
    }

    public function actualizarUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->usuarioModel->setId($_POST['id']);
            $this->usuarioModel->setNombres($_POST['nombres']);
            $this->usuarioModel->setApellidos($_POST['apellidos']);
            $this->usuarioModel->setTipoDocumento($_POST['tipo_documento']);
            $this->usuarioModel->setNumeroDocumento($_POST['numero_documento']);
            $this->usuarioModel->setTelefono($_POST['telefono']);
            $this->usuarioModel->setEmail($_POST['email']);
            $this->usuarioModel->setContraseña($_POST['contrasena']);
            $this->usuarioModel->setRh($_POST['rh']);
            $this->usuarioModel->setEps($_POST['eps']);
            $this->usuarioModel->setContactoEmergencia($_POST['contacto_emergencia']);
            $this->usuarioModel->setEnfermedades($_POST['enfermedades']);
            $this->usuarioModel->setAlergias($_POST['alergias']);

            $this->usuarioModel->actualizar();
            header('Location: index.php?vista=funcionario/usuariosData');
        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
    }

    public function eliminar($id)
    {
        return $this->usuarioModel->eliminar($id);
    }



    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtén los datos del formulario
            $numero_documento = $_POST['documento'] ?? null;
            $contrasena = $_POST['contrasena'] ?? null;
    
            // Verifica que se hayan proporcionado ambos datos
            if ($numero_documento === null || $contrasena === null) {
                header("Location: index.php?vista=usuario/login&error=datos_incompletos");
                exit;
            }
    
            $usuario = new Usuarios();
            $usuario->setNumeroDocumento($numero_documento);
    
            // Verifica si el documento existe
            if ($usuario->existedocumento()) {
                // Verifica las credenciales del usuario
                if ($usuario->verificarCredenciales($numero_documento, $contrasena)) {
                    session_start();
    
                    // Establece las variables de sesión
                    $_SESSION['id_usuario'] = $usuario->getId();
    
                    // Obtener el perfil del usuario
                    $perfil = $this->usuarioModel->obtenerPerfilUsuario($_SESSION['id_usuario']);
    
                    // Redirige al usuario según su perfil
                    switch ($perfil['perfil']) {
                        case 'Admin':
                            header('Location: index.php?vista=admin/inicio');
                            break;
                        case 'Funcionario':
                            header('Location: index.php?vista=funcionario/inicio');
                            break;
                        case 'Instructor':
                            header('Location: index.php?vista=instructor/inicio');
                            break;
                        default:
                            header('Location: index.php?vista=usuario/login&error=perfil_desconocido');
                            break;
                    }
                    exit;
                } else {
                    // Redirige en caso de credenciales incorrectas
                    header("Location: index.php?vista=usuario/login&error=credenciales_incorrectas");
                    exit;
                }
            } else {
                // Redirige si el usuario no existe
                header("Location: index.php?vista=usuario/login&error=usuario_no_existe");
                exit;
            }
        }
    }
    

    

    public function recuperar() {
        session_start(); // Asegúrate de iniciar la sesión
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
            $correo = $_POST['email'];
            $usuarioModel = new Usuarios();
            $usuario = $usuarioModel->obtenerUsuarioPorCorreo($correo);
    
            if ($usuario) {
                $_SESSION['reset_email'] = $correo; // Configura la sesión aquí
                if ($this->enviarCorreoRecuperacion($correo)) {
                    echo "<script>alert('Mensaje enviado con éxito.');</script>";
                } else {
                    echo "<script>alert('No se pudo enviar el correo.');</script>";
                }
            } else {
                echo "<script>alert('El correo $correo no existe en la base de datos.');</script>";
            }
        }

        include "./views/usuario/recuperar.php";
    }

    public function soporte() {
        if (isset($_POST['pqr']) && isset($_POST['reclamo']) && isset($_POST["userEmail"]) && !empty($_POST['pqr'] ) && !empty($_POST['reclamo']) && !empty($_POST["userEmail"])) {
            $motivo = $_POST['pqr'];
            $asunto = $_POST['reclamo'];
            $userEmail = $_POST["userEmail"];
            if ($this->enviarCorreoSoporte($motivo, $asunto, $userEmail)) {
                echo "<script>alert('Correo enviado correctamente.')</script>";
            } else {
                echo "<script>alert('No se pudo enviar el correo. Por favor, intenta de nuevo más tarde.')</script>";
            }
            include "./views/funcionario/soporte.php";
        } else {
            echo "<script>alert('Por favor, completa todos los campos del formulario.')</script>";
        }
    }
    
    private function enviarCorreoRecuperacion($correo) {
        $mail = $this->configurarPHPMailer();
        $mail->SetFrom("easygenz45@gmail.com", "Soporte EasyGenz");
        $mail->Subject = "Restablecer Contraseña";
        $mail->Body = 'Haz clic en este <a href="http://localhost/isaac/index.php?vista=usuario/nuevaC">enlace</a> para restablecer tu contraseña.';
        $mail->AddAddress($correo);

        return $mail->Send();
    }

    private function enviarCorreoSoporte($motivo, $asunto, $userEmail) {
        $mail = $this->configurarPHPMailer();
        $mail->SetFrom("easygenz45@gmail.com", "Soporte EasyGenz");
        $mail->Subject = $motivo;
        $mail->Body = "Correo del Usuario: $userEmail<br>Tipo de Reclamo: $motivo<br>Reclamo: $asunto";
        $mail->AddAddress("easygenz45@gmail.com");

        return $mail->Send();
    }

    private function configurarPHPMailer() {
        require("./PHPMailer-master/PHPMailer-master/src/PHPMailer.php");
        require("./PHPMailer-master/PHPMailer-master/src/SMTP.php");

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->Username = "easygenz45@gmail.com";
        $mail->Password = "aiwi lrnn dsto lmfa";

        return $mail;
    }


    public function redireccionNuevaC() {
        session_start();
        if (isset($_SESSION['reset_email'])) {
            include "./views/usuario/nuevaC.php"; // mostra el formulario si la sesión esta bien
        } else {
            echo "<script>alert('Sesión no válida. Por favor, intente el proceso de recuperación nuevamente.');</script>";
            echo '<script>window.location.href = "index.php?vista=usuario/login";</script>';
        }
    } 

    public function nuevaContrasena() {
        session_start(); // Inicia la sesión
        if (isset($_SESSION['reset_email'])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $correo = $_SESSION['reset_email']; // Usa la sesión para obtener el correo
                $nuevaContrasena = $_POST['contra'];
                $nuevaContrasena2 = $_POST['contra2'];

                if ($nuevaContrasena !== $nuevaContrasena2) {
                    echo "<script>alert('Las contraseñas no coinciden.'); window.history.back();</script>";
                } else {
                    $usuarioModel = new Usuarios();
                    if ($usuarioModel->actualizarContrasena($correo, $nuevaContrasena)) {
                        unset($_SESSION['reset_email']);
                        echo "<script>alert('Contraseña actualizada exitosamente.'); window.location.href = 'index.php?vista=usuario/login';</script>";
                    } else {
                        echo "<script>alert('Error al actualizar la contraseña.'); window.history.back();</script>";
                    }
                }
            } else {
                include "./views/usuario/nuevaC.php";
            }
        } else {
            echo "<script>alert('Sesión no válida. Por favor, intente el proceso de recuperación nuevamente.'); window.location.href = 'index.php?vista=usuario/login';</script>";
        }
    }
    public function gestionarIngreso() {
        session_start();
        $usuarioModel = new Usuarios();
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $contrasena = $_POST['contrasena'];
            $observacion = isset($_POST['observacion']) ? $_POST['observacion'] : null;
    
            // Verificar contraseña
            $usuario = $usuarioModel->obtenerUsuarioPorContrasena($contrasena);
    
            if ($usuario) {
                $idUsuario = $usuario['id'];
                $_SESSION['ingreso_usuario'] = $idUsuario;
    
                // Registrar entrada o salida
                $resultado = $usuarioModel->gestionarEntradaSalida($idUsuario, $observacion);
    
                if ($resultado === 'entrada') {
                    $perfil = $usuarioModel->obtenerPerfilPorIdUsuario($idUsuario);
                    if ($perfil === 3) {
                        header("Location: index.php?vista=usuario/ingreso&error=sesion_funcionario_activa");
                    exit;
                    } elseif ($perfil === 2) {
                        header("Location: index.php?vista=usuario/ingreso&error=sesion_instructor_activa");
                    exit;
                    } else {
                        header("Location: index.php?vista=usuario/ingreso&error=sesion_aprendiz_activa");
                    exit;
                    }
                } elseif ($resultado === 'salida') {
                    $perfil = $usuarioModel->obtenerPerfilPorIdUsuario($idUsuario);
                    if ($perfil === 3) {
                        header("Location: index.php?vista=usuario/ingreso&error=sesion_funcionario_cerrada");
                    exit;
                    } elseif ($perfil === 2) {
                        header("Location: index.php?vista=usuario/ingreso&error=sesion_instructor_cerrada");
                    exit;
                    } else {
                        header("Location: index.php?vista=usuario/ingreso&error=sesion_aprendiz_cerrada");
                    exit;
                    }
                    unset($_SESSION['ingreso_usuario']);
                } else {
                    echo "<script>alert('Error al registrar entrada/salida.');</script>";
                }
            } else {
                header("Location: index.php?vista=usuario/ingreso&error=contrasena_incorrecta");
                    exit;
            }
        }
    
        include "./views/usuario/ingreso.php";
    }
    


public function obtenerPerfilUsuario($id) {
    return $this->usuarioModel->obtenerUsuarioPorId($id);
}

public function obtenerPerfil($id) {
    return $this->usuarioModel->obtenerPerfilUsuario($id);
}
public function listAprendices($documento = null, $nombre = null, $apellido = null, $fechaDesde = null, $fechaHasta = null)
{
    $registro = new Registro();
    $usuarios = $registro->getAprendices($documento, $nombre, $apellido, $fechaDesde, $fechaHasta);
    return $usuarios;
}


public function listUsuarios($documento = null, $nombre = null, $apellido = null, $fechaDesde = null, $fechaHasta = null)
{
    $registro = new Registro();
    $usuarios = $registro->getAll($documento, $nombre, $apellido, $fechaDesde, $fechaHasta);
    return $usuarios;

    
}

public function funcionario($idUsuario) {
    $perfiles = $this->usuarioModel->obtenerPerfilUsuario($idUsuario);
        if ($perfiles['perfil'] === 'Funcionario') {
            return true;
        }
    return false;
}
public function filtrarUsuarios($searchTerm)
{
    return $this->usuarioModel->search($searchTerm);
}

public function obtenerUsuarioPorId($id)
{
    return $this->usuarioModel->obtenerUsuarioPorId($id);
}

public function actualizarUsuario($id, $nombres, $apellidos, $tipo_documento, $numero_documento, $telefono, $email, $contrasena, $rh, $eps, $contacto_emergencia, $enfermedades, $alergias)
{
    return $this->usuarioModel->actualizarUsuario($id, $nombres, $apellidos, $tipo_documento, $numero_documento, $telefono, $email, $contrasena, $rh, $eps, $contacto_emergencia, $enfermedades, $alergias);
}

public function actualizarPerfilUsuario($id_usuario, $nuevo_perfil_id) {
    $this->usuarioModel->actualizarPerfilUsuario($id_usuario, $nuevo_perfil_id);
}

public function asignarFichaAprendiz() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $numeroFicha = $_POST['numeroFicha'] ?? null;
        $usuariosSeleccionados = $_POST['usuariosSeleccionados'] ?? [];

        // Verificar si se ha recibido un número de ficha y usuarios seleccionados
        if ($numeroFicha && !empty($usuariosSeleccionados)) {
            $usuarioModel = new Usuarios();
            $errores = []; // Array para recopilar errores

            // Verificar si la ficha existe
            if (!$usuarioModel->fichaExiste($numeroFicha)) {
                echo "<script>alert('El número de ficha no existe.');</script>";
                include "./views/instructor/ficha.php";
                return;
            }

            foreach ($usuariosSeleccionados as $idUsuario) {
                // Verificar si el usuario ya tiene una ficha asignada
                if ($usuarioModel->usuarioTieneFicha($idUsuario)) {
                    $usuario = $usuarioModel->obtenerUsuarioPorId($idUsuario); // Obtener detalles del usuario para la alerta
                    $documento = $usuario['numero_documento'] ?? 'Desconocido'; // Número de documento del usuario
                    $errores[] = "El usuario con documento $documento ya tiene una ficha asignada.";
                    continue; // Salta al siguiente usuario
                }

                // Intentar registrar el aprendiz
                if (!$usuarioModel->registrarAprendiz($idUsuario, $numeroFicha)) {
                    $usuario = $usuarioModel->obtenerUsuarioPorId($idUsuario); // Obtener detalles del usuario para la alerta
                    $documento = $usuario['numero_documento'] ?? 'Desconocido'; // Número de documento del usuario
                    $errores[] = "Error al ingresar el aprendiz con documento $documento.";
                }
            }

            // Mostrar alertas consolidadas
            if (!empty($errores)) {
                $mensaje = implode('\n', $errores);
                echo "<script>alert('$mensaje');</script>";
            } else {
                echo "<script>alert('Aprendices ingresados correctamente.');</script>";
            }

            include "./views/instructor/ficha.php";
        } else {
            echo "<script>alert('ERROR: Número de ficha o usuarios seleccionados no válidos.');</script>";
            include "./views/instructor/ficha.php";
        }
    } else {
        echo "<script>alert('Método de solicitud no válido.');</script>";
        include "./views/instructor/ficha.php";
    }
}

}


class ProgramaNumeroFichaController {
    private $programaModel;
    private $numeroFichaModel;

    public function __construct() {
        $this->programaModel = new Programa();
        $this->numeroFichaModel = new NumeroFicha();
    }

    public function registrarPrograma() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_programa = $_POST['programa'] ?? null;
            $tipo_programa = $_POST['tipo'] ?? null;

            $this->programaModel->setNombre($nombre_programa);
            $this->programaModel->setid_tipo_programa($tipo_programa);

            if ($this->programaModel->existeprograma($nombre_programa)) {
                $id = $this->programaModel->obteneridprograma();
                return intval($id); // Devuelve el ID del programa existente
            } else {
                $this->programaModel->insertar();
                $id = $this->programaModel->obteneridprograma();
                return intval($id); // Devuelve el ID del nuevo programa
            }
        }
        return null; // Retorna null si no se realiza la solicitud POST
    }

    public function registrarFicha($idPrograma) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo = $_POST['ficha'] ?? null;
            $jornada = $_POST['jornada'] ?? null;
            $nombre = $_POST['programa'] ?? null;
            $descripcion = $_POST['observacion'] ?? null;
    
            $this->numeroFichaModel->setcodigo($codigo);
    
            // Verificar si la ficha ya existe
            if ($this->numeroFichaModel->existeFicha()) {
                echo "<script>alert('La ficha ya existe'); window.location.href='index.php?vista=instructor/ficha';</script>";
                exit;
            }
            // Configurar el resto de los datos
            $this->numeroFichaModel->setjornada($jornada);
            $this->numeroFichaModel->setnombre($nombre);
            $this->numeroFichaModel->setdescripcion($descripcion);
            $this->numeroFichaModel->setid_programa($idPrograma);
    
            // Insertar la nueva ficha
            $this->numeroFichaModel->insertar();
            echo "<script>alert(Ficha registrada);</script>";
            echo "<script>alert('Ficha registrada exitosamente'); window.location.href='index.php?vista=instructor/ficha';</script>";
        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
    
        include "./views/instructor/ficha.php";
    }

}



        


