<?php
require_once './../controllers/CalendarController.php';
require_once './../controllers/usuariosController.php';

// Simulate JSON data for debugging
echo json_encode([
    [
        'title' => 'Entrada: 08:00 AM',
        'start' => '2024-07-01T08:00:00',
        'allDay' => false,
        'className' => 'entrada'
    ],
    [
        'title' => 'Salida: 05:00 PM',
        'start' => '2024-07-01T17:00:00',
        'allDay' => false,
        'className' => 'salida'
    ]
]);

$id_usuario = $_SESSION['id_usuario'];

$controller = new CalendarController();
$controller->loadEvents($id_usuario);
