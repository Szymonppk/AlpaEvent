<?php

require_once "AppController.php";
require_once __DIR__ . "/../models/Event.php";
require_once __DIR__ . "/../repository/EventDAO.php";
require_once __DIR__ . "/../repository/RoomDAO.php";

class EventController extends AppController
{
    private $upload_dir ='./uploads';

    public function create_event()
    {


        if (!$this->isPost()) {
            return $this->render("create-event");
        }


        $event_name = $_POST["event_name"];
        $event_date = $_POST["event_date"];
        $event_location = $_POST["event_location"];
        $event_type = $_POST["event_type"];
        
        $original_name = basename($_FILES['photo']['name']);

        $target = $this->upload_dir.'/'.uniqid().'_'.$original_name;

        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            die("Couldn't save file");
        }
        
        $photo = $target;
        $description = $_POST["description"];
        $user_id = $_SESSION["user"]["user_id"];
        $action = $_POST["save"] ?? "event";

        $event = new Event($event_name, $event_date, $event_location, $event_type, $photo, $description);
        $event_id = EventDAO::create_event($event, $user_id);

        if (!$event_id) {
            echo "Couldn't save";
        }

        $url = "http://" . $_SERVER['HTTP_HOST'];

        if ($action === 'event_and_room') {
            $room_id = RoomDAO::create_room($event_id,$user_id);
            header("Location: {$url}/room/{$room_id}/room-dashboard");
        } 
        else {
            header("Location: {$url}/user-events");
        }
        exit();
    }

    public function get_events()
    {
       

        $user_id = $_SESSION["user"]["user_id"];

        header('Content-Type: application/json');

        if (!isset($_SESSION["user"]["user_id"])) {
            http_response_code(401); 
            echo json_encode(["error" => "User not logged in"]);
            return;
        }

        $user_id = $_SESSION["user"]["user_id"];

        $events = EventDAO::get_events($user_id);

        if ($events === false) {
        http_response_code(500);
        echo json_encode(["error" => "Database error"]);
        return;
        }

        error_log("get_events: user_id=$user_id");
        error_log("Zwracane eventy: " . json_encode($events));

        echo json_encode($events ?? []);

    }
}
