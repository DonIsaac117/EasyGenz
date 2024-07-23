<?php
    require_once('cmv/controllers/clienteControllers.php');
    $ClienteController = new ClienteController();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_submit'])) {
        $numero_documento = $_POST['documento'];
        $contrasena = $_POST['contrasena'];
        $ClienteController->login($numero_documento, $contrasena);
    }
    ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/LOGIN.css">
    <style>
    </style>
</head>
<body>
    <div>
        <form action="index.php" method="post">
            <h1>Login</h1>
            <div class="formulario">
                <h2>Documento</h2>
                <input type="number" name="documento" required>
                <h2>Contraseña</h2>
                <input type="password" name="contrasena" required>
                <div class="olvide">
                    <a href="html/recuperar.php"><h4>Olvidé mi contraseña</h4></a>
                </div>
                <input type="submit" name="login_submit" value="Ingresar">
        </form>
        <div class="registro"> 
            <h4 class="cuenta">¿No tienes una cuenta?👇</h4>
            <a href="html/form.php" class="boton-registrese">Regístrate</a>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if ($error == 'credenciales_incorrectas') {
                    echo 'Credenciales incorrectas';
                } elseif ($error == 'usuario_no_existe') {
                    echo 'El usuario no existe en la base de datos';
                } else {
                    echo 'Error desconocido';
                }
            }
            ?>
            <span class="close">&times;</span>
        </div>
    </div>

    <script>
       
       document.addEventListener('DOMContentLoaded', function() {
           var modal = document.getElementById('myModal');

           <?php
           if (isset($_GET['error'])) {
               echo "modal.style.display = 'block';";
           }
           ?>

            var closeBtn = document.querySelector('.close');
                    closeBtn.addEventListener('click', function() {
                        modal.style.display = 'none';
                    });

          
           window.addEventListener('click', function(event) {
               if (event.target === modal) {
                   modal.style.display = 'none';
               }
           });
       });
   </script>
</body>
</html>
