<?php
date_default_timezone_set('America/Bogota');
require_once("./config/Enrutador.php");
require_once("./controllers/usuariosController.php");

$enrutador = new Enrutador();
if (isset($_GET["vista"])) {
    $enrutador->CargarVista($_GET["vista"]);
    exit(); // Detiene cualquier salida adicional
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>index</title>
        <link rel="stylesheet" href="./css/index.css?v=<?php echo time(); ?>">
    </head>
    <body>
    <main>
        <div class="container">
        <img src="./imagenes/easygenz.jpg" alt="Easygenz-logo">
            <h3>Seleccione el botón correspondiente <br> para dirigirse al lugar que solicite</h3>
            <label for="login">Login / funcionarios</label>
            <input type="button" id="login" value="Login" onclick="redireccionLogin()">

            <label for="ingreso">Ingreso y Salida de Usuarios</label>
            <input type="button" id="ingreso" value="Ingreso y Salida" onclick="redireccionIngreso()">

            <label for="ingreso">Registrese</label>
            <a href="index.php?vista=usuario/registrar"><button type="button" id="ingreso" value="Ingreso y Salida">Registrese</button></a>

        </div>
    </main>



    <script>
        function redireccionLogin() {
            window.location.href = "index.php?vista=usuario/login";
        }

        function redireccionIngreso() {
            window.location.href = "index.php?vista=usuario/ingreso";
        }
    </script>
    </body>
    </html>

    <?php
}
?>
