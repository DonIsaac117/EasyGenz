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

date_default_timezone_set('America/Bogota');

 
    require_once("./config/Enrutador.php");
    require_once("./controllers/usuariosController.php");
    require_once("./controllers/programasController.php");
    require_once("./controllers/ingresoSalidaController.php");

    $enrutador = new Enrutador();
    if(isset($_GET["vista"])){
        $enrutador->CargarVista($_GET["vista"]);
    }else{

        header("Location: index.php?vista=usuario/login");
        ?>
        <a href="index.php?vista=usuario/TYC">TYC</a> <br>
        <a href="index.php?vista=usuario/Ingreso">Ingreso</a> <br>

        <a href="index.php?vista=usuario/inicio">inicio</a> <br>
        <a href="index.php?vista=usuario/login">Login</a> <br>
        <a href="index.php?vista=usuario/registrar">formulario</a> <br>
        <a href="index.php?vista=programa/inicio">Programa</a><br>
        <a href="index.php?vista=ingresoSalida/inicio">IngresoSalida</a><br>
        <?php
Facilito
    }
?>
    
</body>
</html>




