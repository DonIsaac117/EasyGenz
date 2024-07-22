<?php
$funcionController = new FuncionController();
if (isset($_POST["crear"])){
    echo "Se creo correctamente";

    $id_usuario = $_POST["id_usuario"];
    $fecha = $_POST["fecha"];
    $hora_entrada = $_POST["hora_entrada"];
    $hora_salida = $_POST["hora_salida"];
    $observacion = $_POST["observacion"];
    $estado = $_POST["estado"];

    FuncionController->crear($id_usuario, $fecha, $hora_entrada, $hora_salida, $observacion, $estado);
}