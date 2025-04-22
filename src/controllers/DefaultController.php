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

    public function create_event()
    {
        $this->render('create-event');
    }

    public function user_profile()
    {
        $this->render('user-profile');
    }

    public function user_profile_friends()
    {
        $this->render('user-profile-friends');
    }

    public function forum()
    {
        $this->render('forum');
    }

    
    public function user_rooms()
    {
        $this->render('user-rooms');
    }

    
    public function user_events()
    {
        $this->render('user-events');
    }

    public function home_logged()
    {
        $this->render('home-logged');
    }
    

}