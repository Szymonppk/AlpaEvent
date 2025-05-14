<?php

require_once "AppController.php";
require_once __DIR__."/../models/Event.php";
require_once __DIR__."/../models/EventDAO.php";

class EventController extends AppController
{
    public function create_event()
    {   
        

        if(!$this->isPost())
        {
            return $this->render("create-event");
        }


        $event_name = $_POST["event_name"];
        $event_date = $_POST["event_date"];
        $event_location = $_POST["event_location"];
        $event_type = $_POST["event_type"];
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
        $description = $_POST["description"];
        $user_id = $_SESSION["user"]["user_id"];
        $action = $_POST["save"] ?? "event";

        $event = new Event($event_name,$event_date,$event_location,$event_type,$photo,$description);
        $saved = EventDAO::create_event($event,$user_id);

        if(!$saved)
        {
            echo "Couldn't save";
        }

        $url = "http://".$_SERVER['HTTP_HOST'];

        if($action === 'event_and_room')
        {
            header("Location: {$url}/room-dashboard");
        }
        else
        {
            header("Location: {$url}/user-events");
        }
        exit();
    }

}