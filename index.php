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

<h1>hola </h1>



<?php

    require_once("./config/Enrutador.php");
    require_once("./controllers/usuariosController.php");

    

    //recibir por get la ruta

    $enrutador = new Enrutador();
    if(isset($_GET["vista"])){
        $enrutador->CargarVista($_GET["vista"]);
    }else{
        echo "Me carga el index principal";
        ?>
        <a href="index.php?vista=usuario/inicio">inicio</a> <br>
        <a href="index.php?vista=usuario/registrar">registrar</a> <br>
        <a href="views/usuario/form.php">formulario</a> <br>
        <a href="index.php?vista=config/enrutador">enrutador</a>
        <?php
    }
?>
    
</body>
</html>




