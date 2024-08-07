<?php

require_once("./config/ConectorBD.php");
require_once("./models/Usuarios.php");

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
            header('Location: index.php?vista=usuario/login');
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

    public function login($numero_documento, $contraseña) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuarios();
            $usuario->setNumeroDocumento($numero_documento);
            $usuario->setContraseña($contraseña);
    
            $user = $usuario->existedocumento();
    
            if ($user) {
                $user = $usuario->verificarCredenciales();
                if ($user) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['nombres'];
                    header('Location: index.php?vista=funcionario/inicio');
                    exit;
                } else {
                    header("Location: index.php?vista=usuario/login&error=credenciales_incorrectas");
                    exit;
                }
            } else {
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
                $this->enviarCorreoRecuperacion($correo);
                echo "<script>alert('Éxito', 'Mensaje enviado con éxito.', 'success');</script>";
            } else {
                echo "<script>alert('Error', 'El correo $correo no existe en la base de datos.', 'error');</script>";
            }
        }
        include "./views/usuario/recuperar.php";
    }

    private function enviarCorreoRecuperacion($correo) {
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
        $mail->SetFrom("easygenz45@gmail.com");
        $mail->Subject = "Restablecer Contraseña";
        $mail->Body = 'Haz clic en este <a href="http://localhost/EasyGenz/index.php?vista=usuario/nuevaC">enlace</a> para restablecer tu contraseña.';
        $mail->AddAddress($correo);
    
        if (!$mail->Send()) {
            echo "<script>alert('No se pudo enviar el correo.')</script>";
        }
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
    
    
    
}

?>
