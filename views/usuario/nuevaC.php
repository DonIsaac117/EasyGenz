<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva contraseña</title>
    <link rel="stylesheet" href="./css/nuevaC.css">
</head>
<body>
    <div class="formularrio">
        <form action="index.php?vista=usuario/nuevaC" method="post">
            <h1>Ingresa tu nueva contraseña</h1>
            <div class="formulario">
                <h2>Nueva contraseña</h2>
                <input type="password" name="contra" required>
                <h2>Repite la contraseña</h2>
                <input type="password" name="contra2" required>
                <div class="registro">
                    <input type="submit" name="cambiar" value="Cambiar" class="boton-registrese">
                </div>
            </div>
        </form>   
    </div>

</body>
</html>
