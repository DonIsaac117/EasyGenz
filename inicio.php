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
    require_once("./controllers/ingresoSalidaController.php");
    require_once("./controllers/numeroFichaController.php");

    $enrutador = new Enrutador();
    if(isset($_GET["vista"])){
        $enrutador->CargarVista($_GET["vista"]);
    }else{
        echo "Me carga el index principal";
        ?>
        <h2>Tablas y su CRUD</h2>
        <a href="index.php?vista=usuario/inicio">Usuarios</a> <br>
        <a href="index.php">Login</a> <br>
        <a href="index.php?vista=usuario/registrar">formulario</a> <br>
        <a href="index.php?vista=programa/inicio">Programa</a><br>
        <a href="index.php?vista=ingresoSalida/inicio">IngresoSalida</a><br>
        <a href="index.php?vista=numeroFicha/inicio">Numero de Ficha</a><br>
        <?php 
    }
?>
    
</body>
</html>
