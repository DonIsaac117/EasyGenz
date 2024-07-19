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
            $fecha = $row['fecha'];
            $hora_entrada = $row['hora_entrada'];
            $hora_salida = $row['hora_salida'];
    
           
            $ingreso = $fecha . 'T' . $hora_entrada;
            $salida = $fecha . 'T' . $hora_salida;
    
            $events[] = [
                'title' => 'Entrada: ' . $hora_entrada,
                'start' => $ingreso, 
                'allDay' => false,
                'className' => 'entrada'
            ];
    
            $events[] = [
                'title' => 'Salida: ' . $hora_salida,
                'start' => $salida, 
                'allDay' => false,
                'className' => 'salida'
            ];
        }
    
        header('Content-Type: application/json');
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
