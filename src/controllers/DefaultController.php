<?php

require_once 'AppController.php';

class DefaultController extends AppController{

    public function login()
    {
        $this->render("login");
    }

    public function register()
    {
        $this->render("register");
        
    }

    public function home()
    {
        $this->render("home");
    }

    public function room_dashboard()
    {
        $this->render("room-dashboard");
    }

    public function room_event_info()
    {
        $this->render("room-event-info");
    }

    public function room_event_plan()
    {
        $this->render("room-event-plan");
    }

    public function room_event_settlements()
    {
        $this->render("room-event-settlements");
    }

    public function room_chat()
    {
        $this->render("room-chat");
    }

    public function room_gallery()
    {
        $this->render("room-gallery");
    }

    public function room_team()
    {
        $this->render("room-team");
    }

    public function room_settings()
    {
        $this->render("room-settings");
    }


}