<?php
require_once './../controllers/CalendarController.php';
require_once './../controllers/usuariosController.php';
session_start();

$id_usuario = $_SESSION['id_usuario'];

$controller = new CalendarController();
$controller->loadEvents($id_usuario);
