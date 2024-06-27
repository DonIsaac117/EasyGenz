<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div>
        <form action="principal.html" method="post">
            <h1>Login</h1>
            <div class="formulario">
                <h2>Documento</h2>
                <input type="number" required>
                <h2>Contraseña</h2>
                <input type="password" required>
                <div class="olvide">
                    <a href="olvideMiContraseña"><h4>Olvide mi contraseña</h4></a>
                </div>
                <input type="submit" value="Ingresar">
        </form>
            <div class="registro"> 
                <h4 class="cuenta">¿No tienes una cuenta?👇</h4>
                <a href="views/usuario/form.html" class="boton-registrese">Registrese</a>
            </div>
    </div>
</body>
</html>