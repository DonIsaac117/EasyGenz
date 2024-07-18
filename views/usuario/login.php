<!-- views/usuario/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.css">
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
                    <a href="index.php?vista=usuario/recuperar"><h4>Olvide mi contraseña</h4></a>
                </div>
                <input type="submit" value="Ingresar">
        </form>
        
        <div class="registro"> 
            <h4 class="cuenta">¿No tienes una cuenta?👇</h4>
            <a href="index.php?vista=usuario/registrar" class="boton-registrese">Registrese</a>
        </div>

        </div>
    </div>

    <!-- Incluyendo la librería de SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.js"></script>

    <!-- Prueba de alerta de SweetAlert2 -->
    <script>
        Swal.fire('SweetAlert2 está funcionando');
    </script>
</body>
</html>
