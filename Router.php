<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/FriendController.php';
require_once 'src/controllers/EventController.php';
require_once 'src/controllers/RoomController.php';

class Router
{
    public static $routes;

    public static function get($url,$controller)
    {
        if(strpos($url,'-') !== false)
        {
            $url = str_replace('-','_',$url);
        }

        self::$routes[$url] = $controller;

    }

    public static function post($url,$controller)
    {
        if(strpos($url,'-') !== false)
        {
            $url = str_replace('-','_',$url);
        }

        self::$routes[$url] = $controller;

    }

    public static function run($url)
    {
        if(strpos($url,'-') !== false)
        {
            $url = str_replace('-','_',$url);
        }
    
        $parts= explode('/',$url);

        $action = $parts[0];
        $params = array_slice($parts, 1);

        if(!array_key_exists($action,self::$routes))
        {
            die("Wrong url");
        }

        $controller = self::$routes[$action];
        $object = new $controller;


        if(!empty($params))
        {
            $object->$action($params);
        }
        else
        {

            $object->$action();
        }
        

        
    }

}