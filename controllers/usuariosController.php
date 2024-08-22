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

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero_documento = $_POST['documento'];
            $contrasena = $_POST['contrasena'];
    
            $usuario = new Usuarios();
            if ($usuario->verificarCredenciales($numero_documento, $contrasena)) {
                session_start();
                
                $id_usuario= $usuario->getId();
                $_SESSION['id_usuario']= $id_usuario;
                
                if(isset($_SESSION['id_usuario'])){
                    echo "<script>
                   
                    window.location.href = 'index.php?vista=funcionario/inicio';
                    ;
                </script>";
                }else{
                    echo '<script>alert("La sesion no esta iniciada");</script>';
                }
                
              
            } else {
                echo "<script>
                    console.log('Credenciales incorrectas');
                    Swal.fire({
                        title: 'Credenciales incorrectas',
                        icon: 'error'
                    }).then(function() {
                        window.location.href = 'index.php?vista=usuario/login';
                    });
                </script>";
            }
        } else {
            include "./views/usuario/login.php";
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
                echo "<script>Swal.fire('Éxito', 'Mensaje enviado con éxito.', 'success');</script>";
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

public function nuevaContrasena() {
    session_start(); // Asegúrate de iniciar la sesión
    if (isset($_SESSION['reset_email'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correo = $_SESSION['reset_email']; // Usa la sesión para obtener el correo
            $nuevaContrasena = $_POST['contra'];
            $nuevaContrasena2 = $_POST['contra2'];

            if ($nuevaContrasena !== $nuevaContrasena2) {
                echo "<script>Swal.fire('Error', 'Las contraseñas no coinciden.', 'error');</script>";
            } else {
                $usuarioModel = new Usuarios();

                if ($usuarioModel->actualizarContrasena($correo, $nuevaContrasena)) {
                    echo "<script>Swal.fire('Éxito', 'Contraseña actualizada exitosamente.', 'success');</script>";
                    echo '<script>window.location.href = "index.php?vista=usuario/login";</script>';
                } else {
                    echo "<script>Swal.fire('Error', 'Error al actualizar la contraseña.', 'error');</script>";
                }
            }
        }
        include "./views/usuario/nuevaC.php";
    } else {
        echo "<script>Swal.fire('Error', 'Sesión no válida.', 'error');</script>";
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

public function obtenerPerfilUsuario($id) {
    return $this->usuarioModel->obtenerUsuarioPorId($id);
}


public function listUsuarios($documento = null, $nombre = null, $apellido = null, $fechaDesde = null, $fechaHasta = null)
{
    $registro = new Registro();
    $usuarios = $registro->getAll($documento, $nombre, $apellido, $fechaDesde, $fechaHasta);
    return $usuarios;

    
}

}


