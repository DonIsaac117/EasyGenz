<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECUPERAR_CONTRASEÑA</title>
    <link rel="stylesheet" href="../../css/recuperar.css">
</head>
<body>
    <div class="container">
        <form action="recuperar.php" method="post" id="miFormulario">
            <h1>¡Has olvidado tu contraseña!</h1>
            <h3>¡No te preocupes, te ayudaremos a recuperar tu cuenta!</h3>
            <div class="formulario">
                <h2>Ingresa tu correo</h2>
                <input type="email" name="email" required>
            </div>
            <input type="submit" value="Enviar">
        </form>   
    </div>
    <?php
// Iniciar sesión
session_start();

// Incluir las clases de PHPMailer
require("../PHPMailer-master/PHPMailer-master/src/PHPMailer.php");
require("../PHPMailer-master/PHPMailer-master/src/SMTP.php");

// Configuración de la conexión a la base de datos
$servidor = "localhost";
$usuarioBd = "root";
$password = "";
$database = "EASYGENZ";

// Crear conexión
$conn = mysqli_connect($servidor, $usuarioBd, $password, $database);

// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Verificar si se envió el formulario y si se recibió el correo electrónico
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        $correo_usuario = $_POST['email'];

        // Preparar la consulta SQL con sentencias preparadas
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $correo_usuario);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        // Verificar si se encontró algún usuario con ese correo electrónico
        if (mysqli_num_rows($resultado) > 0) {
            // Guardar el correo electrónico en la sesión
            $_SESSION['reset_email'] = $correo_usuario;

            // Configurar PHPMailer para enviar correo
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP(); // Habilitar SMTP
            $mail->SMTPAuth = true; // Habilitar autenticación SMTP
            $mail->SMTPSecure = 'ssl'; // SSL es requerido para Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // Puerto SSL
            $mail->IsHTML(true);
            $mail->Username = "easygenz45@gmail.com";
            $mail->Password = "aiwi lrnn dsto lmfa";
            $mail->SetFrom("easygenz45@gmail.com");
            $mail->Subject = "Restablecer Contraseña";
            $mail->Body = 'Haz clic en este <a href="http://localhost/proyecto%20(1)/proyecto/html/nuevaC.php">enlace</a> para restablecer tu contraseña.';
            $mail->AddAddress($correo_usuario);

            // Enviar el correo
            if (!$mail->Send()) {
                echo "<script>alert('No se pudo enviar el correo.')</script>";
            } else {
                echo "<script>alert('Mensaje enviado con éxito.')</script>";
            }
        } else {
            echo "<script>alert('El correo $correo_usuario no existe en la base de datos.')</script>";
        }

        // Liberar el resultado de la consulta
        mysqli_stmt_close($stmt);
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>


</body>
</html>
