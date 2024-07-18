<?php


require_once '../models/Events.php';

class CalendarController {

    private $event;

    public function __construct() {
        $this->event = new Event();
    }

    public function loadEvents($id_usuario) {
        $stmt = $this->event->getByUserId($id_usuario);
        $events = [];
        

        while ($row = $stmt->fetch_assoc()) {
            // Evento de entrada
            $events[] = [
                'title' => 'Entrada: ' . $row['hora_entrada'],
                'start' => $row['fecha'],
                'allDay' => false,
                'className' => 'entrada'
            ];

            // Evento de salida
            $events[] = [
                'title' => 'Salida: ' . $row['hora_salida'],
                'start' => $row['fecha'],
                'allDay' => false,
                'className' => 'salida'
            ];
        }

        echo json_encode($events);
    }

    
    public function registerEvent($data) {
        $this->event->id_usuario = $data['id_usuario'];
        $this->event->fecha = $data['fecha'];
        $this->event->hora_entrada = $data['hora_entrada'];
        $this->event->hora_salida = $data['hora_salida'];

        if ($this->event->create()) {
            return true;
        }

        return false;
    }
} 
