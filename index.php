<?php
 require_once("./config/Enrutador.php");
 require_once("./controllers/usuariosController.php");
 require_once("./controllers/programasController.php");
 require_once("./controllers/ingresoSalidaController.php");
 require_once("./controllers/NumeroFichaController.php");
 $UsuarioController = new UsuarioController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $numero_documento = $_POST['documento'];
 $contrasena = $_POST['contrasena'];
 

 $UsuarioController->login($numero_documento, $contrasena);
}


 $enrutador = new Enrutador();
 if(isset($_GET["vista"])){
     $enrutador->CargarVista($_GET["vista"]);
 }else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Login</title>
 <link rel="stylesheet" href="./css/login.css">
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
                 <a href="index.php?vista=usuario/recuperar"><h4>Olvide mi contraseña</h4></a>
             </div>
             <input type="submit" value="Ingresar">
             <?php
             if (isset($error)) {
                 echo "<script>alert('$error');</script>";
             }
             ?>
     </form>
     <div class="registro"> 
         <h4 class="cuenta">¿No tienes una cuenta?👇</h4>
         <a href="index.php?vista=usuario/registrar" class="boton-registrese">Registrese</a>
     </div>

     </div>
 </div>
</body>
</html>
<?php
 }
 ?>