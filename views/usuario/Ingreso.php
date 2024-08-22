<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Acceso</title>
    <link rel="stylesheet" href="./css/Ingreso.css?v=<?php echo time(); ?>">
</head>
<body>
    <form action="index.php?vista=usuario/Ingreso" method="post">
        <h1>Control de Ingreso y Salida</h1>
        <label for="contrasena">Ingrese su Contraseña</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <button type="submit">Enviar</button>
    </form>

</body>
</html>