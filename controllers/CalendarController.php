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
        $events = [];


        if (!$stmt) {
            echo json_encode(['error' => 'Error al obtener eventos']);
            return;
        }

        while ($row = $stmt->fetch_assoc()) {
            $hora_entrada = date("H:i", strtotime($row['hora_entrada']));
            $hora_salida = date("H:i", strtotime($row['hora_salida']));
            $events[] = [
                'title' => 'Entrada: ' . $hora_entrada,
                'start' => $row['fecha'] ,
                'allDay' => false,
                'className' => 'entrada'
            ];

            $events[] = [
                'title' => 'Salida: ' . $hora_salida,
                'start' => $row['fecha'] ,
                'allDay' => false,
                'className' => 'salida'
            ];
        }

        $json_events = json_encode($events);

        if (json_last_error() != JSON_ERROR_NONE) {
            echo json_last_error_msg(); // Imprime cualquier error de JSON
        } else {
            echo $json_events;
        }
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



