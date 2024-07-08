<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="">
</head>
<body>

<?php
 
    require_once("./config/Enrutador.php");
    require_once("./controllers/usuariosController.php");
    require_once("./controllers/programasController.php");

    $enrutador = new Enrutador();
    if(isset($_GET["vista"])){
        $enrutador->CargarVista($_GET["vista"]);
    }else{
        echo "Me carga el index principal";
        ?>
        <a href="index.php?vista=usuario/inicio">inicio</a> <br>
        <a href="index.php?vista=usuario/login">Login</a> <br>
        <a href="index.php?vista=usuario/registrar">formulario</a> <br>
        <a href="index.php?vista=config/enrutador">enrutador</a><br>
        <a href="index.php?vista=programa/inicio">Programa</a><br>
        <?php 
    }
?>
    
</body>
</html>




