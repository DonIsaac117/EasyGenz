<?php
session_start();
require_once './../controllers/CalendarControllerIns.php';


$id_usuario = $_SESSION['id_usuario'];

$controller = new CalendarController();
$controller->instructor_events($id_usuario);