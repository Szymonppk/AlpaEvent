<?php

require_once "AppController.php";
require_once __DIR__ . "/../models/Room.php";
require_once __DIR__ . "/../models/RoomDAO.php";
require_once __DIR__ . "/../models/EventDAO.php";

class RoomController extends AppController  
{
    public function room($params)
    {
        $room_id = $params[0] ?? null;
        $subpage = $params[1] ?? 'dashboard';
        $user_id = $_SESSION['user']['user_id'];

        if (!$room_id) {
            die("Missing room id!");
        }

        $access = RoomDAO::findById($user_id, $room_id);

        if (!$access) {
            die("No privilages");
        }

        // switch ($subpage) {
        // }
    }

    public function create_room()
    {
        header('Content-Type: application/json');
        $user_id = $_SESSION["user"]["user_id"];
        $event_id = $_GET['event_id'] ?? null;
        

        if (!$event_id || !$user_id) {
            http_response_code(400);
            echo json_encode(['error' => 'Brak danych wejściowych']);
            return;
        }
        $reference_event = EventDAO::get_event_by_id($event_id);

        $room_id = RoomDAO::createRoom($event_id, $user_id);

        if (!$room_id) {
            http_response_code(500);
            echo json_encode(['error' => 'Nie udało się utworzyć pokoju']);
            return;
        }

        echo json_encode(['room_id' => $room_id]);
    }
}
