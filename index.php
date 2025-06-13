<?php

require "Router.php";

$path = trim($_SERVER['REQUEST_URI'],'/');
$path = parse_url($path,PHP_URL_PATH);

$paths =
['login','register','home','room-dashboard','room-event-info',        
'room-event-info','room-event-settlements','room-event-plan',
 'room-chat', 'room-gallery','room-team', 'room-settings',
 'create-event','home-logged','forum','user-profile',
 'user-profile-friends','create-event','user-rooms','user-events'
 ,'home-logged','admin-panel'
];

for($i=0;$i<count($paths);$i++)
{
    Router::get($paths[$i],'DefaultController');
}

Router::post('login','SecurityController');
Router::post('register','SecurityController');
Router::get('search-user', 'FriendController');
Router::post('add-friend','FriendController');
Router::get('get-friends','FriendController');
Router::post('create-event','EventController');
Router::get('get-events','EventController');
Router::post('logout','SecurityController');
Router::post('create-room', 'RoomController');
Router::get('room','RoomController');
Router::get('get-first-room','RoomController');
Router::get("get-rooms","RoomController");
Router::get("get-room-by-id","RoomController");
Router::get("home-logged","HomeController");
Router::get("get-participants","RoomController");
Router::post("add-user","RoomController");
Router::post("upload-photo","RoomController");
Router::get("get-photos","RoomController");
Router::post("add-plan-point","RoomController");
Router::get("delete-plan-point","RoomController");
Router::post("get-plans","RoomController");
Router::post("add-note","RoomController");
Router::get("get-note","RoomController");
Router::post("update-note","RoomController");
Router::post("update-user","SecurityController");
Router::post("delete-user","SecurityController");
Router::post("delete-user","SecurityController");
Router::post("delete-user-by-admin","SecurityController");
// Router::get('login','DefaultController');
// Router::get('register','DefaultController');
// Router::get('home','DefaultController');
// Router::get('room-dashboard','DefaultController');
// Router::get('room-event-info','DefaultController');
// Router::get('room-event-settlements','DefaultController');
// Router::get('room-event-plan','DefaultController');
// Router::get('room-chat','DefaultController');
// Router::get('room-gallery','DefaultController');
// Router::get('room-team','DefaultController');
// Router::get('room-settings','DefaultController');

Router::run($path);

