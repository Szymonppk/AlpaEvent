<?php

class Event
{
    private $event_name;
    private $event_date;
    private $event_location;
    private $event_type;
    private $photo;
    private $description;

    public function __construct($event_name, $event_date, $event_location, $event_type, $photo, $description)
    {
        $this->event_name = $event_name;
        $this->event_date = $event_date;
        $this->event_location = $event_location;
        $this->event_type = $event_type;
        $this->photo = $photo;
        $this->description = $description;
    }

    public function getName() { return $this->event_name; }
    public function getDate() { return $this->event_date; }
    public function getLocation() { return $this->event_location; }
    public function getType() { return $this->event_type; }
    public function getPhoto() { return $this->photo; }
    public function getDescription() { return $this->description; }
}
