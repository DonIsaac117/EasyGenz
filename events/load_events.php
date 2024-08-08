<?php
session_start();
require_once './../controllers/CalendarController.php';


$id_usuario = $_SESSION['id_usuario'];

$controller = new CalendarController();
$controller->loadEvents($id_usuario);




