<!-- views/usuario/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/EasyGenz/css/login.css">
</head>
<body>
    <div>
        <form action="index.php?vista=usuario/login" method="post">
            <h1>Login</h1>
            <div class="formulario">
                <h2>Documento</h2>
                <input type="number" name="documento" required>
                <h2>Contraseña</h2>
                <input type="password" name="contrasena" required>
                <div class="olvide">
                    <a href="recuperar.php"><h4>Olvide mi contraseña</h4></a>
                </div>
                <input type="submit" value="Ingresar">
                <?php
                if (isset($error)) {
                    echo "<script>alert('$error');</script>";
                }
                ?>
            </div>
        </form>
        <div class="registro"> 
            <h4 class="cuenta">¿No tienes una cuenta?👇</h4>
            <a href="index.php?vista=usuario/registrar" class="boton-registrese">Registrese</a>
        </div>

        </div>
    </div>
</body>
</html>
