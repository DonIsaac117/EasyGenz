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

    public function actualizarUser() {
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

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
            $id = intval($_POST['eliminar']);
            $this->usuarioModel->eliminar($id);
            header("Location: index.php?vista=funcionario/usuariosData");
            exit();
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
    
                    // Redirige al usuario
                    header('Location: index.php?vista=funcionario/inicio');
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
                $this->enviarCorreoRecuperacion($correo);
                echo "<script>alert('Éxito', 'Mensaje enviado con éxito.', 'success');</script>";
            } else {
                echo "<script>Swal.fire('Error', 'El correo $correo no existe en la base de datos.', 'error');</script>";
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
        $mail->Body = 'Haz clic en este <a href="http://localhost/isaac/index.php?vista=usuario/nuevaC">enlace</a> para restablecer tu contraseña.';
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
    public function manejarEntradaSalida() {
        session_start();
        
        // Verificar si la sesión está iniciada y si el ID de usuario está presente
        if (!isset($_SESSION['usuario_id'])) {
            echo "<script>alert('Sesión no válida.'); window.location.href = 'index.php?vista=usuario/login';</script>";
            return;
        }
    
        $usuarioModel = new Usuarios();
        $usuarioId = $_SESSION['usuario_id'];
        $perfil = $usuarioModel->obtenerPerfilPorIdUsuario($usuarioId);
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $contrasena = $_POST['contrasena'];
    
            // Verificar la contraseña
            $usuario = $usuarioModel->obtenerUsuarioPorId($usuarioId);
            if (password_verify($contrasena, $usuario['contrasena'])) {
                if (!isset($_SESSION['sesion_activa'])) {
                    $_SESSION['sesion_activa'] = true;
    
                    if ($perfil === 'aprendiz' || $perfil === 'instructor') {
                        $usuarioModel->registrarEntrada($usuarioId);
                    } elseif ($perfil === 'funcionario') {
                        $usuarioModel->registrarEntradaFuncionario($usuarioId, null);
                    }
    
                    echo "<script>alert('Sesión iniciada exitosamente.');</script>";
                } else {
                    if ($perfil === 'aprendiz' || $perfil === 'instructor') {
                        $usuarioModel->registrarSalida($usuarioId);
                    } elseif ($perfil === 'funcionario') {
                        $usuarioModel->registrarSalidaFuncionario($usuarioId);
                    }
    
                    unset($_SESSION['sesion_activa']);
                    echo "<script>alert('Sesión cerrada.');</script>";
                }
            } else {
                echo "<script>alert('Contraseña incorrecta.'); window.history.back();</script>";
            }
        }
        include "./views/usuario/entradaSalida.php";
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


  // Método para buscar usuarios
  public function filtrarUsuarios($searchTerm) {
    return $this->usuarioModel->search($searchTerm);
}

public function obtenerUsuarioPorId($id) {
    return $this->usuarioModel->obtenerUsuarioPorId($id);
}

public function obtenerTodosLosUsuarios() {
    return $this->usuarioModel->obtenerTodosLosUsuarios();
}public function actualizarUsuario($id, $nombres, $apellidos, $tipo_documento, $numero_documento, $telefono, $email, $contrasena, $rh, $eps, $contacto_emergencia, $enfermedades, $alergias) {
    return $this->usuarioModel->actualizarUsuario($id, $nombres, $apellidos, $tipo_documento, $numero_documento, $telefono, $email, $contrasena, $rh, $eps, $contacto_emergencia, $enfermedades, $alergias);
}

}


