<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECUPERAR_CONTRASEÑA</title>
    <link rel="stylesheet" href="./css/recuperar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container">
        <form action="index.php?vista=usuario/recuperar" method="post" id="miFormulario">
            <h1>¡Has olvidado tu contraseña!</h1>
            <h3>¡No te preocupes, te ayudaremos a recuperar tu cuenta!</h3>
            <div class="formulario">
                <h2>Ingresa tu correo</h2>
                <input type="email" name="email" required>
            </div>
            <input type="submit" value="Enviar">
        </form>   
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.js"></script>
</body>
</html>
