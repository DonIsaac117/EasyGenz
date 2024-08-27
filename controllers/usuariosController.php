<?php

require_once './config/ConectorBD.php';
require_once './models/Usuarios.php';
require_once './models/Registros.php';

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

            header('Location: index.php?vista=usuario/registrar&error=usuario_registrado');

        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
            $id = intval($_POST['eliminar']);
            $this->usuarioModel->eliminar($id);
            header("Location: index.php?vista=usuario/inicio");
            exit();
        }
    }


    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->usuarioModel->setId($_POST['id']);
            $this->usuarioModel->setNombres($_POST['nombre']);
            $this->usuarioModel->setApellidos($_POST['apellidos']);
            $this->usuarioModel->setTipoDocumento($_POST['tipo_doc']);
            $this->usuarioModel->setNumeroDocumento($_POST['num_doc']);
            $this->usuarioModel->setTelefono($_POST['telefono']);
            $this->usuarioModel->setEmail($_POST['email']);
            $this->usuarioModel->setContraseña($_POST['contrasena']);
            $this->usuarioModel->setRh($_POST['tipo_sangre']);
            $this->usuarioModel->setEps($_POST['eps']);
            $this->usuarioModel->setContactoEmergencia($_POST['contacto_emer']);
            $this->usuarioModel->setEnfermedades($_POST['enfermedades']);
            $this->usuarioModel->setAlergias($_POST['alergias']);
    
            $this->usuarioModel->actualizar();
            header('Location: index.php?vista=usuario/inicio');
        } else {
            echo "Error: La solicitud no es de tipo POST.";
        }
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
        $mail->AddAddress("javierbasto28@gmail.com");

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
                        echo "<script>alert('Éxito, sesión del funcionario iniciada.');</script>";
                    } elseif ($perfil === 2) {
                        echo "<script>alert('Éxito, sesión del instructor iniciada.');</script>";
                    } else {
                        echo "<script>alert('Éxito, sesión del aprendiz iniciada.');</script>";
                    }
                } elseif ($resultado === 'salida') {
                    $perfil = $usuarioModel->obtenerPerfilPorIdUsuario($idUsuario);
                    if ($perfil === 3) {
                        echo "<script>alert('Éxito, sesión del funcionario cerrada.');</script>";
                    } elseif ($perfil === 2) {
                        echo "<script>alert('Éxito, sesión del instructor cerrada.');</script>";
                    } else {
                        echo "<script>alert('Éxito, sesión del aprendiz cerrada.');</script>";
                    }
                    unset($_SESSION['ingreso_usuario']);
                } else {
                    echo "<script>alert('Error al registrar entrada/salida.');</script>";
                }
            } else {
                echo "<script>alert('Contraseña incorrecta.');</script>";
            }
        }
    
        include "./views/usuario/ingreso.php";
    }
    


public function obtenerPerfilUsuario($id) {
    return $this->usuarioModel->obtenerUsuarioPorId($id);
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

}


