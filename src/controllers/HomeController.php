<?php

require_once "AppController.php";
require_once __DIR__."/../repository/EventDAO.php";

class HomeController extends AppController
{
    public function home_logged()
    {
        $user_id = $_SESSION["user"]["user_id"];

        $events = EventDAO::get_events($user_id);

        if(!$events)
        {
            error_log("Wrong user id");
        }
        
        $this->render("home-logged",$events);
        
    }
}