<?php

require_once './../models/Events.php';

header('Content-Type: application/json');

class CalendarController
{

    private $event;

    public function __construct()
    {
        $this->event = new Event();
    }

    public function loadEvents($id_usuario)
    {
        $stmt = $this->event->getByUserId($id_usuario);
    
        if (!$stmt) {
            echo json_encode(['error' => 'Error al obtener eventos']);
            return;
        }
    
        $eventsByDate = [];
    
        while ($row = $stmt->fetch_assoc()) {
            $fecha = $row['fecha'];
            $hora_entrada = date("H:i", strtotime($row['hora_entrada']));
            $hora_salida = date("H:i", strtotime($row['hora_salida']));
            $observacion = $row['observacion'];
    
            if (!isset($eventsByDate[$fecha])) {
                $eventsByDate[$fecha] = ['entrada' => [], 'salida' => []];
            }
    
            if ($hora_entrada) {
                $eventsByDate[$fecha]['entrada'][] = [
                    'title' => 'Entrada',
                    'start' => $fecha . 'T' . $hora_entrada,
                    'allDay' => false,
                    'className' => 'entrada',
                    'observations' => $observacion
                ];
            }
    
            if ($hora_salida) {
                $eventsByDate[$fecha]['salida'][] = [
                    'title' => 'Salida',
                    'start' => $fecha . 'T' . $hora_salida,
                    'allDay' => false,
                    'className' => 'salida',
                    'observations' => $observacion
                ];
            }
        }
    
        $calendarEvents = [];
        foreach ($eventsByDate as $date => $events) {
            if (!empty($events['entrada'])) {
                usort($events['entrada'], function($a, $b) {
                    return strcmp($a['start'], $b['start']);
                });
                $calendarEvents[] = $events['entrada'][0]; // Primera entrada
            }
            if (!empty($events['salida'])) {
                usort($events['salida'], function($a, $b) {
                    return strcmp($b['start'], $b['start']);
                });
                $calendarEvents[] = $events['salida'][count($events['salida']) - 1]; // Última salida
            }
        }
    
        echo json_encode([
            'calendarEvents' => $calendarEvents,
            'allEvents' => array_merge(...array_values($eventsByDate))
        ]);
        exit();
    }
    
    


    public function registerEvent($data)
    {
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
