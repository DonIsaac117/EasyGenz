<?php
// Iniciar la sesión si no está ya iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión o cualquier otra página
header("Location: ../index.php?vista=usuario/login"); // Cambia 'login.php' por la página a la que quieres redirigir
exit();
