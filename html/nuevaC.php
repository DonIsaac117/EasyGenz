<?php
// Iniciar sesión
session_start();

// Verificar si hay un correo electrónico almacenado en la sesión
if (isset($_SESSION['reset_email'])) {
    $correo_usuario = $_SESSION['reset_email'];
    require_once('../cmv/controllers/clienteControllers.php');
    $ClienteController = new ClienteController();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los valores de los campos de contraseña
        $pass1 = $_POST["contra"];
        $pass2 = $_POST["contra2"];

        // Verificar si las contraseñas coinciden
        if ($pass1 != $pass2) {
            echo "<script>alert('Las contraseñas no coinciden.');</script>";
        } else {
            // Si las contraseñas coinciden, cambiar la contraseña
            $email = $correo_usuario;
            $contrasena = $_POST["contra"];
            $ClienteController->editarContrasena($contrasena, $email);
            
            // Mostrar mensaje de éxito y redireccionar
            echo "<script>alert('Contraseña cambiada exitosamente.');</script>";
            echo '<script>window.location.href = "../index.html";</script>';
            exit; // Detener la ejecución del script después de redirigir
        }
    }
} else {
     // Redirigir a la página de recuperación de contraseña si no hay correo electrónico en sesión
     header('Location: recuperar.php');
     exit;
}
?>

<!-- //Formulario para cambiar contraseña -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva contraseña</title>
    <link rel="stylesheet" href="../css/nuevaC.css">
</head>
<body>
    <div class="formularrio">
        <form action="nuevaC.php" method="post">
            <h1>Ingresa tu nueva contraseña</h1>
            <div class="formulario">
                <h2>Nueva contraseña</h2>
                <input type="password" name="contra" required>
                <h2>Repite la contraseña</h2>
                <input type="password" name="contra2"  required>
                <div class="registro">
                    <input type="submit" name="cambiar" placeholder="Cambiar" href="../index.php" class="boton-registrese">
                </div>
        </form>   
            </div>
    </div>
</body>
</html>